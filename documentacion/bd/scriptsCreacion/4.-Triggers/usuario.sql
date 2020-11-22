############################################################################
#############################################################################
##                         TRIGGERS de JUGADOR
##
## En este fihcero sql se recogen todos los disparadores necesarios para la
## buena estabilidad de la base de datos (Mysql 5) y para controlar que una
## mala programacion no la inestabilice.
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 24/11/08
##
## Changelog
##
## v0.1
## �Implementados los disparadores relacionados con jugadores.
##
#############################################################################
#############################################################################

DROP TRIGGER IF EXISTS jugador_BI;
DROP TRIGGER IF EXISTS jugador_AI;
DROP TRIGGER IF EXISTS jugador_BU;
DROP TRIGGER IF EXISTS jugadorInfoPuntuaciones_BU;

DELIMITER |

CREATE TRIGGER jugador_BI
BEFORE INSERT ON jugador
FOR EACH ROW
BEGIN
	#######Setea los atributos de la tabla jugador que se deben generar de forma automatica
	SET NEW.idLogotipo = (SELECT id FROM `logotipo` WHERE idRaza=NEW.idRaza ORDER BY RAND() LIMIT 0,1);
	SET NEW.idFirma = (SELECT id FROM `firma` WHERE idRaza=NEW.idRaza ORDER BY RAND() LIMIT 0,1);
END;
|


CREATE TRIGGER jugador_AI
AFTER INSERT ON jugador
FOR EACH ROW
BEGIN
	DECLARE _fin BIT;
	DECLARE _numGalaxia, _numGalaxiaF SMALLINT UNSIGNED;
	DECLARE _numCuentas SMALLINT UNSIGNED;
	DECLARE _numCuentasF SMALLINT UNSIGNED DEFAULT 65535;
	DECLARE _idPlanetaSeleccionado MEDIUMINT UNSIGNED;
	DECLARE _tipoRecurso TINYINT UNSIGNED;
	DECLARE _cantidadRecurso MEDIUMINT UNSIGNED;
	DECLARE _produccionRecurso DECIMAL(16,6) UNSIGNED;
	DECLARE _limiteTropas TINYINT UNSIGNED;
	DECLARE _limiteDeMisiones TINYINT UNSIGNED;
	DECLARE _stargateIntergalactico BIT;

	DECLARE galaxiaOrigen CURSOR FOR
			SELECT idGalaxia FROM razaGalaxiaOrigen WHERE idRaza=NEW.idRaza;

	DECLARE jugadorRecursos CURSOR FOR
			SELECT idTipoRecurso, cantidadBase, produccionBase
			FROM recursoRaza
			WHERE idRaza=NEW.idRaza;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	#######ASIGNANDO UN PLANETA AL JUGADOR

	#Determinamos la GALAXIA donde se situara el planeta principal del jugador

	#Comprobamos el numero de cuentas que hay en las galaxia disponibles para la raza
	SET _fin=0;
	OPEN galaxiaOrigen;

	REPEAT
		FETCH galaxiaOrigen INTO _numGalaxia; #Captura la primera fila
			IF NOT _fin #Si se ha obtenido una fila, se pasa a procesarla
			THEN
					SELECT nCuentas INTO _numCuentas FROM galaxia WHERE id=_numGalaxia;

	  			IF _numCuentas < _numCuentasF THEN
	  				SET _numCuentasF = _numCuentas;
	  				SET _numGalaxiaF = _numGalaxia;
	  			END IF;
	  		END IF;
	UNTIL _fin END REPEAT;
	CLOSE galaxiaOrigen;

	#Seleccionamos un planeta aleatorio de los disponibles para el jugador
	#(planetas que no sean especiales, esten libres y en su galaxia y que no esten como destino de una mision)
	SELECT idPlaneta INTO _idPlanetaSeleccionado
	FROM planeta
	WHERE idGalaxia=_numGalaxiaF AND
			idPlaneta NOT IN (SELECT idPlanetaEsp
						FROM planetaEspecial
						WHERE idGalaxia=_numGalaxiaF)
			AND idPlaneta NOT IN (SELECT idPlaneta
						FROM planetaColonizado
						WHERE idGalaxia=_numGalaxiaF)
			AND idPlaneta NOT IN (SELECT idPlanetaDestino
						FROM mision
						WHERE idGalaxiaDestino=_numGalaxiaF)
	ORDER BY RAND() LIMIT 0,1;

	#Actualizamos el porcentaje de riqueza del planeta seleccionado
	UPDATE planeta
	SET riqueza='50'
	WHERE idPlaneta=_idPlanetaSeleccionado AND idGalaxia=_numGalaxiaF;

	#Asignamos como planeta principal del jugador el planeta seleccionado
	INSERT INTO planetaColonizado VALUES(_idPlanetaSeleccionado, _numGalaxiaF, NEW.idUsuario, true);

	#Anyadimos el planeta a la lista de planetas explorados
	INSERT INTO planetaExplorado VALUES(_idPlanetaSeleccionado, _numGalaxiaF, NEW.idUsuario, NEW.idUsuario, true,'Tu planeta principal');

	#######PORCENTAJE de MEJORAS posicionados a 0
	SELECT limiteSoldados, limiteMisiones, stargateTropasIntergalactico INTO _limiteTropas, _limiteDeMisiones, _stargateIntergalactico FROM raza WHERE id=NEW.idRaza;
	INSERT INTO jugadorInfoGeneral (idJugador, limiteSoldados, limiteMisiones) VALUES(NEW.idUsuario, _limiteTropas, _limiteDeMisiones);
	INSERT INTO jugadorInfoUnidades (idJugador, stargateIntergalactico) VALUES(NEW.idUsuario, _stargateIntergalactico);
	INSERT INTO jugadorInfoPuntuaciones (idJugador) VALUES(NEW.idUsuario);

	#######Inicializa los recursos del usuario, los cuales varian dependiendo de la raza
	SET _fin=0;
	OPEN jugadorRecursos;

	REPEAT
		FETCH jugadorRecursos INTO _tipoRecurso, _cantidadRecurso, _produccionRecurso; #Captura la primera fila
			IF NOT _fin #Si se ha obtenido una fila, se pasa a procesarla
			THEN
				CASE _tipoRecurso
				WHEN 1 THEN
					#Introducimos la cantidad base en la tabla
					INSERT INTO tipoRecursoUsuario VALUES(_tipoRecurso, NEW.idUsuario, _cantidadRecurso);

					UPDATE jugadorInfoGeneral SET produccionPrimario = _produccionRecurso WHERE idJugador=NEW.idUsuario;
				WHEN 2 THEN
					#Introducimos la cantidad base en la tabla
					INSERT INTO tipoRecursoUsuario VALUES(_tipoRecurso, NEW.idUsuario, _cantidadRecurso);

					UPDATE jugadorInfoGeneral SET produccionSecundario = _produccionRecurso WHERE idJugador=NEW.idUsuario;
				WHEN 3 THEN
					#Introducimos la cantidad base en la tabla
					INSERT INTO tipoRecursoUsuario VALUES(_tipoRecurso, NEW.idUsuario, _cantidadRecurso);

					UPDATE jugadorInfoGeneral SET produccionEnergia = _produccionRecurso WHERE idJugador=NEW.idUsuario;
				END CASE;
			END IF;
	UNTIL _fin END REPEAT;
	CLOSE jugadorRecursos;
END;
|

CREATE TRIGGER jugador_BU
BEFORE UPDATE ON jugador
FOR EACH ROW
BEGIN
	IF IFNULL(OLD.idAlianza,0)!=IFNULL(NEW.idAlianza,0) THEN
		DELETE FROM solicitudAlianza WHERE idJugador=OLD.idUsuario;
	END IF;
END;
|

CREATE TRIGGER jugadorInfoPuntuaciones_BU
BEFORE UPDATE ON jugadorInfoPuntuaciones
FOR EACH ROW
BEGIN
	SET NEW.puntosTotales=NEW.puntosNaves+NEW.puntosSoldados+NEW.puntosDefensas+NEW.puntosTecnologias;
END;
|


DELIMITER ;
