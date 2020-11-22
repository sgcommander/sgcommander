############################################################################
#############################################################################
##                         TRIGGERS de UNIDADES
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
## -Implementados los disparadores relacionados con unidades.
##
#############################################################################
#############################################################################

DROP TRIGGER IF EXISTS unidadConstruir_BI;
DROP TRIGGER IF EXISTS unidadConstruir_AI;
DROP TRIGGER IF EXISTS unidadConstruir_AD;
DROP TRIGGER IF EXISTS unidadJugadorPlaneta_AI;
DROP TRIGGER IF EXISTS unidadJugadorPlaneta_AU;
DROP TRIGGER IF EXISTS unidadJugadorPlaneta_AD;

DELIMITER |

##INSERT ON unidadConstruir:
####
####Se restan los recursos necesarios del usuario que construye las unidades
####
CREATE TRIGGER unidadConstruir_BI
BEFORE INSERT ON unidadConstruir
FOR EACH ROW
BEGIN
		DECLARE _fin BIT;
		DECLARE _existe BIT DEFAULT 0;
		DECLARE _tipoRecurso TINYINT UNSIGNED;
		DECLARE _cantidadRestar DECIMAL(16,6) UNSIGNED DEFAULT 0;
		DECLARE _tiempoFinal MEDIUMINT UNSIGNED;
		DECLARE _unidad SMALLINT UNSIGNED;
		DECLARE _cantidadEnPlaneta INT UNSIGNED;
		DECLARE _cantidadMision INT UNSIGNED;
		DECLARE _velocidad SMALLINT UNSIGNED;
		DECLARE _actual,_limite INT UNSIGNED;
		DECLARE _tipoUnidad TINYINT UNSIGNED;

		#Calcula los recursos a quitar del jugador al crear las unidades (recursosUsuario#(costeUnidad*cantidad))
		DECLARE recursosDescontar CURSOR FOR
					SELECT ru.idtipoRecurso, ru.cantidad*NEW.cantidad
					FROM `recursoUnidad` AS ru
					WHERE ru.idUnidad=NEW.idUnidad;

		#Comnprueba que no se este realizando una construccion del mismo tipo
		DECLARE construccionTipo CURSOR FOR
					SELECT COUNT(*)
					FROM unidad
					WHERE id=NEW.idUnidad AND idTipoUnidad IN (SELECT idTipoUnidad
										   FROM unidad AS u JOIN unidadConstruir AS uc ON u.id=uc.idUnidad
										   WHERE
											idGalaxia=NEW.idGalaxia
											AND idPlaneta=NEW.idPlaneta
											AND idJugador=NEW.idJugador);

		#Comprueba si la construccion de la unidad requiere del consumo de otras unidades
		DECLARE unidadesRequeridas CURSOR FOR
					SELECT ur.idUnidadRequiere, COALESCE(ujp.cantidad-ujp.cantidadEnMision, 0)-(ur.cantidad*NEW.cantidad) AS _cantidadEnPlaneta, cantidadEnMision
					FROM
						unidadRequerida AS ur
						LEFT JOIN
						unidadJugadorPlaneta AS ujp
						ON ujp.idUnidad=ur.idUnidadRequiere
						AND ujp.idGalaxia=NEW.idGalaxia
						AND ujp.idPlaneta=NEW.idPlaneta
						AND ujp.idJugador=NEW.idJugador
					WHERE ur.idUnidadRequerida=NEW.idUnidad;

		DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marca la variable fin

		#Comprueba si ya se estan construyendo, defensas/soldados/naves en ese planeta
		SET _fin=0;
		OPEN construccionTipo;

		FETCH construccionTipo INTO _existe;
			IF NOT _fin
			THEN
				IF _existe = 1 THEN
					CALL YASEESTACONSTRUYENDO;
				END IF;
			END IF;
		CLOSE construccionTipo;

		#Comprueba que los recursos que le queden al usuario no sean negativos
		SET _fin=0;
		OPEN recursosDescontar;

		REPEAT
			FETCH recursosDescontar INTO _tipoRecurso,_cantidadRestar; #Captura la primera fila
				IF NOT _fin
				THEN
					UPDATE tipoRecursoUsuario SET cantidad=cantidad-_cantidadRestar WHERE idJugador=NEW.idJugador AND idTipoRecurso=_tipoRecurso;
				END IF;
		UNTIL _fin END REPEAT;
		CLOSE recursosDescontar;

		#Comprueba que se tengan todas las unidades requeridas y se descuentan
		SET _fin=0;
		OPEN unidadesRequeridas;

		REPEAT
			FETCH unidadesRequeridas INTO _unidad, _cantidadEnPlaneta, _cantidadMision; #Captura la primera fila
				IF NOT _fin
				THEN
					IF _cantidadEnPlaneta < 0
					THEN
						CALL NOTIENESLASUNIDADESREQUERIDAS;
					ELSE
						IF _cantidadEnPlaneta=0 AND _cantidadMision=0
						THEN
							DELETE FROM unidadJugadorPlaneta
							WHERE idUnidad=_unidad AND idPlaneta=NEW.idPlaneta AND idGalaxia=NEW.idGalaxia AND idJugador=NEW.idJugador;
						ELSE
							UPDATE unidadJugadorPlaneta SET cantidad=_cantidadEnPlaneta+_cantidadMision WHERE idUnidad=_unidad AND idGalaxia=NEW.idGalaxia AND idPlaneta=NEW.idPlaneta AND idJugador=NEW.idJugador;
						END IF;
					END IF;
				END IF;
		UNTIL _fin END REPEAT;
		CLOSE unidadesRequeridas;

		#Aumentamos el numero de unidades del tipo que se ha construido, para saber cuantas tenemos
		SELECT idTipoUnidad INTO _tipoUnidad FROM unidad WHERE id = NEW.idUnidad; #Obtengo el tipo

		IF _tipoUnidad=2
		THEN
			SELECT numSoldados,limiteSoldados INTO _actual,_limite FROM jugadorInfoGeneral WHERE idJugador=NEW.idJugador LIMIT 1;
			IF (_actual+NEW.cantidad) > _limite THEN
				CALL LIMITEDETROPAS;
			END IF;
		END IF;

		#Actualizo su numero
		CASE _tipoUnidad
	        WHEN 1 THEN
	            UPDATE jugadorInfoGeneral SET numNaves = numNaves + NEW.cantidad WHERE idJugador=NEW.idJugador;
	        WHEN 2 THEN
	            UPDATE jugadorInfoGeneral SET numSoldados = numSoldados + NEW.cantidad WHERE idJugador=NEW.idJugador;
	        WHEN 3 THEN
	            UPDATE jugadorInfoGeneral SET numDefensas = numDefensas + NEW.cantidad WHERE idJugador=NEW.idJugador;
	    END CASE;

		#Averigua cuanto tiempo cuesta en construirse la unidad
		SELECT tiempo INTO _tiempoFinal
		FROM unidad
		WHERE id=NEW.idUnidad;

		#Averigua la bonificacion que tenemos en construcciones
		SELECT construccionVelocidad INTO _velocidad
		FROM jugadorInfoGeneral
		WHERE idJugador=NEW.idJugador;

		#Ponemos el tiempo de finalizacion de la construccion
		SET NEW.fechaConstruccionFinal = ADDDATE(NEW.fechaConstruccionInicial,INTERVAL ROUND(_tiempoFinal/((_velocidad/100)+1)*NEW.cantidad) SECOND);
END;
|

#
# Una vez anyadida la construccion, anyado el evento
# en a la lista de eventos del jugador.
#
CREATE TRIGGER unidadConstruir_AI
AFTER INSERT ON unidadConstruir
FOR EACH ROW
BEGIN
	#Inserto el nuevo evento
	INSERT INTO evento (tipo, idJugador, id, idGalaxia, idPlaneta, tiempo)
	VALUES (2, NEW.idJugador, NEW.idUnidad, NEW.idGalaxia, NEW.idPlaneta, NEW.fechaConstruccionFinal);
END;
|

##DELETE ON unidadConstruir:
####
####Dependiendo si el tiempo de construccion ha sido sobrepasado o no, se le devolveran los
####recursos al usuario o se le asignara las unidades construidas
####
CREATE TRIGGER unidadConstruir_AD
AFTER DELETE ON unidadConstruir
FOR EACH ROW BEGIN
	DECLARE _fin BIT;
	DECLARE _heroe BIT DEFAULT 0;
	DECLARE _construible BIT;
	DECLARE _especial BIT;
	DECLARE _cantidadRecurso DECIMAL(16,6) UNSIGNED;
	DECLARE _tipoRecurso TINYINT UNSIGNED;
	DECLARE _idMejoraHeroe SMALLINT UNSIGNED;
	DECLARE _idUnidad SMALLINT UNSIGNED;
	#DECLARE _cantidadUnidadDevolver SMALLINT UNSIGNED;
	DECLARE _tipoUnidad TINYINT UNSIGNED;

	DECLARE recursosDevolver CURSOR FOR
					SELECT idtipoRecurso, cantidad*OLD.cantidad
					FROM `recursoUnidad`
					WHERE idUnidad=OLD.idUnidad;

	#DECLARE unidadesDevolver CURSOR FOR
	#				SELECT ur.idUnidadRequiere, uh.idUnidad, ur.cantidad*OLD.cantidad
	#				FROM unidadRequerida AS ur
	#					LEFT JOIN unidadHeroe AS uh ON (ur.idUnidadRequiere=uh.idUnidad)
	#				WHERE ur.idUnidadRequerida=OLD.idUnidad;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	#Elimino el evento
	DELETE FROM evento
	WHERE idJugador=OLD.idJugador AND evento.tipo=2
	AND evento.id=OLD.idUnidad AND evento.idGalaxia=OLD.idGalaxia
	AND evento.idPlaneta=OLD.idPlaneta;

	#Compruebo si la unidad es heroe
	SELECT 1 INTO _heroe FROM unidadHeroe WHERE idUnidad=OLD.idUnidad;

	#Inicialmente la unidad es construible
	SET _construible=1;

	#Si es un heroe debo comprobar que no este ya disponible
	IF _heroe AND EXISTS(SELECT * FROM unidadJugadorPlaneta WHERE idJugador=OLD.idJugador AND idUnidad=OLD.idUnidad) THEN
		SET _construible = 0;
	END IF;


	#Si el tiempo de construccion ha finalizado, creo la unidad
	IF OLD.fechaConstruccionFinal <= CURRENT_TIMESTAMP AND _construible
	THEN
		SELECT cantidad*OLD.cantidad INTO _cantidadRecurso
		FROM `recursoUnidad`
		WHERE idUnidad=OLD.idUnidad AND idtipoRecurso=3;

		IF COALESCE(_cantidadRecurso, 0)>0
		THEN
			UPDATE tipoRecursoUsuario SET cantidad=cantidad+_cantidadRecurso WHERE idTipoRecurso=3 AND idJugador=OLD.idJugador;
		END IF;

		#Anyadimos las unidades al planeta que toca, en modo protegido, ya que los puntos y demas ya son contados en este trigger
		INSERT INTO unidadJugadorPlaneta
		VALUES (OLD.idUnidad, OLD.idPlaneta, OLD.idGalaxia, OLD.idJugador, OLD.cantidad, 0, 1 )
		ON DUPLICATE KEY UPDATE cantidad=cantidad+OLD.cantidad;
	ELSE
		#Si la unidad es cancelada, devuelvo los recursos consumidos al jugador
		SET _fin=0;
		OPEN recursosDevolver;
		REPEAT
			FETCH recursosDevolver INTO _tipoRecurso, _cantidadRecurso;

			IF NOT _fin
			THEN
				IF _tipoRecurso!=3
				THEN
					SET _cantidadRecurso=cantidadProporcional(0.8,OLD.fechaConstruccionInicial, OLD.fechaConstruccionFinal,_cantidadRecurso);
				END IF;
				UPDATE tipoRecursoUsuario SET cantidad=cantidad+_cantidadRecurso WHERE idTipoRecurso=_tipoRecurso AND idJugador=OLD.idJugador;

			END IF;
		UNTIL _fin END REPEAT;

		CLOSE recursosDevolver;

		#Se devuelven todas las unidades que se han quitado, en caso de ser cierto
		#SET _fin=0;
		#OPEN unidadesDevolver;

		#REPEAT
		#	FETCH unidadesDevolver INTO _idUnidad, _heroe, _cantidadUnidadDevolver; #Captura la primera fila
		#		IF NOT _fin
		#		THEN
		#			#Si ya en la primera pasada la consulta no ha devuelto filas, nos saltamos la sentencia y salimos del bucle
		#			IF _cantidadUnidadDevolver IS NOT NULL
		#			THEN
		#				#Si tengo que devolver un heroe, pero ya esta construido, no lo devuelvo
		#				IF _heroe IS NULL OR NOT EXISTS(SELECT * FROM unidadJugadorPlaneta WHERE idJugador=OLD.idJugador AND idUnidad=_idUnidad) THEN
		#					#Si las unidades no existen, se insertan y sino se actualiza su cantidad
		#					#Aqui el tema de las puntuaciones y cantidades, se encarga el trigger de unidadJugadorPlaneta
		#					INSERT INTO unidadJugadorPlaneta
		#					VALUES(_idUnidad, OLD.idPlaneta, OLD.idGalaxia, OLD.idJugador, _cantidadUnidadDevolver, 0, 1)
		#					ON DUPLICATE KEY UPDATE cantidad=cantidad+_cantidadUnidadDevolver;
		#				END IF;
		#			END IF;
		#		END IF;
		#UNTIL _fin END REPEAT;
		#CLOSE unidadesDevolver;
	END IF;

	#Decrementamos el numero de unidades del tipo que se ha construido, para mantener coherencia en el contador
	#Aunuqe la unidad se construya, el trigger de unidadJugadorPlaneta, se encargara de mantener los contadores
	SELECT idTipoUnidad INTO _tipoUnidad FROM unidad WHERE id = OLD.idUnidad; #Obtengo el tipo

	CASE _tipoUnidad
		WHEN 1 THEN
			UPDATE jugadorInfoGeneral SET numNaves = numNaves - OLD.cantidad WHERE idJugador=OLD.idJugador;
		WHEN 2 THEN
			UPDATE jugadorInfoGeneral SET numSoldados = numSoldados - OLD.cantidad WHERE idJugador=OLD.idJugador;
		WHEN 3 THEN
			UPDATE jugadorInfoGeneral SET numDefensas = numDefensas - OLD.cantidad WHERE idJugador=OLD.idJugador;
	END CASE;
END;
|

##########################################################
# En este trigger se trata unicamente el caso de
# licenciar/desmantelar unidades, ya que para los casos
# de contruccion y perdidas en mision, se encargan
# unidadConstruir y las tablas de mision.
##########################################################
CREATE TRIGGER unidadJugadorPlaneta_AU
AFTER UPDATE ON unidadJugadorPlaneta
FOR EACH ROW BEGIN
	DECLARE _energia DECIMAL(16,6);
	DECLARE _tipoUnidad TINYINT UNSIGNED;
	DECLARE _cantidadMayor INT UNSIGNED;
	DECLARE _cantidadMenor INT UNSIGNED;
	DECLARE _restarEnergia BIT;

	#Si al actualizar las cantidades, las dos quedana 0, se debera borrar la tupla
	IF NEW.cantidad=0
	THEN
		CALL SEDEBEBORRAR;
	ELSE
		#Si no la unidad debe ser contabilizada
		IF OLD.contable THEN
			IF OLD.cantidad != NEW.cantidad THEN
				#Obtengo cual es la cantidad mayor y cual la menor
				IF OLD.cantidad > NEW.cantidad THEN
					SET _restarEnergia = FALSE;
					SET _cantidadMayor=OLD.cantidad;
					SET _cantidadMenor=NEW.cantidad;
				ELSE
					SET _restarEnergia = TRUE;
					SET _cantidadMayor=NEW.cantidad;
					SET _cantidadMenor=OLD.cantidad;
				END IF;

				#Se consume la energia requerida por las unidades
				SELECT cantidad*(_cantidadMayor-_cantidadMenor) INTO _energia
				FROM `recursoUnidad`
				WHERE idUnidad=NEW.idUnidad AND idTipoRecurso=3;

				#Si se debe devolver energia
				IF COALESCE(_energia, 0)!=0
				THEN
					#Actualiza la energia del jugador
					IF _restarEnergia THEN
						UPDATE tipoRecursoUsuario SET cantidad=cantidad-_energia WHERE idTipoRecurso=3 AND idJugador=NEW.idJugador;
					ELSE
						UPDATE tipoRecursoUsuario SET cantidad=cantidad+_energia WHERE idTipoRecurso=3 AND idJugador=NEW.idJugador;
					END IF;
				END IF;

				#Disminuimos el numero de unidades del tipo que se ha eliminado, para saber cuantas tenemos
				SELECT idTipoUnidad INTO _tipoUnidad FROM unidad WHERE id = OLD.idUnidad; #Obtengo el tipo

				#Actualizo su numero
				CASE _tipoUnidad
				    WHEN 1 THEN
					UPDATE jugadorInfoGeneral SET numNaves = numNaves + NEW.cantidad - OLD.cantidad WHERE idJugador=NEW.idJugador;
				    WHEN 2 THEN
					UPDATE jugadorInfoGeneral SET numSoldados = numSoldados + NEW.cantidad - OLD.cantidad WHERE idJugador=NEW.idJugador;
				    WHEN 3 THEN
					UPDATE jugadorInfoGeneral SET numDefensas = numDefensas + NEW.cantidad - OLD.cantidad WHERE idJugador=NEW.idJugador;
				END CASE;

				#Aumenta la puntuacion del jugador
				IF NEW.cantidad > OLD.cantidad THEN
					CALL incPuntosUnidad(NEW.idJugador, NEW.idUnidad, NEW.cantidad - OLD.cantidad);
				ELSE
					CALL decPuntosUnidad(NEW.idJugador, NEW.idUnidad, OLD.cantidad - NEW.cantidad);
				END IF;
			END IF;
		END IF;
	END IF;
END;
|

CREATE TRIGGER unidadJugadorPlaneta_AD
AFTER DELETE ON unidadJugadorPlaneta
FOR EACH ROW BEGIN
	DECLARE _energiaDevolver DECIMAL(16,6);
	DECLARE _fin BIT;
	DECLARE _idMejoraHeroe SMALLINT UNSIGNED;
	DECLARE _tipoUnidad TINYINT UNSIGNED;

	DECLARE mejorasHeroe CURSOR FOR
					SELECT idMejora FROM unidadHeroeMejora
					WHERE idUnidadHeroe=OLD.idUnidad;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	#Si no se ha pedido desactivar el trigger, paso al proceso de contabilizacion de las unidades, si es que hay de eliminadas
	IF OLD.contable THEN

		#Se devuelve la energia y la puntuacion a restar.
		SELECT cantidad*OLD.cantidad INTO _energiaDevolver
		FROM `recursoUnidad`
		WHERE idUnidad=OLD.idUnidad AND idTipoRecurso=3;

		#Si se debe devolver energia
		IF COALESCE(_energiaDevolver, 0)>0
		THEN
			#Actualiza la energia del jugador
			UPDATE tipoRecursoUsuario SET cantidad=cantidad+_energiaDevolver WHERE idTipoRecurso=3 AND idJugador=OLD.idJugador;
		END IF;

		#Disminuimos el numero de unidades del tipo que se ha eliminado, para saber cuantas tenemos
		SELECT idTipoUnidad INTO _tipoUnidad FROM unidad WHERE id = OLD.idUnidad; #Obtengo el tipo

		#Actualizo su numero
		CASE _tipoUnidad
			WHEN 1 THEN
			    UPDATE jugadorInfoGeneral SET numNaves = numNaves - OLD.cantidad WHERE idJugador=OLD.idJugador;
			WHEN 2 THEN
			    UPDATE jugadorInfoGeneral SET numSoldados = numSoldados - OLD.cantidad WHERE idJugador=OLD.idJugador;
			WHEN 3 THEN
			    UPDATE jugadorInfoGeneral SET numDefensas = numDefensas - OLD.cantidad WHERE idJugador=OLD.idJugador;
	    	END CASE;

		#Actualiza la puntuacion del jugador
		CALL decPuntosUnidad(OLD.idJugador, OLD.idUnidad, OLD.cantidad);
	END IF;

	#Insertamos las mejoras de heroe
	IF EXISTS(SELECT * FROM unidadHeroe WHERE idUnidad=OLD.idUnidad) THEN
		SET _fin=0;
		OPEN mejorasHeroe;

		REPEAT
			FETCH mejorasHeroe INTO _idMejoraHeroe;

			IF NOT _fin
			THEN
				DELETE FROM jugadorMejora WHERE `idMejora`=_idMejoraHeroe AND `idJugador`=OLD.idJugador;
			END IF;
		UNTIL _fin END REPEAT;

		CLOSE mejorasHeroe;
	END IF;
END;
|

###
### Despues de insertar una nueva unidad e@insertandon un planeta,
### esta debe contabilizarse.
###
CREATE TRIGGER unidadJugadorPlaneta_AI
AFTER INSERT ON unidadJugadorPlaneta
FOR EACH ROW BEGIN
	DECLARE _fin BIT;
	DECLARE _energia DECIMAL(16,6);
	DECLARE _idMejoraHeroe SMALLINT UNSIGNED;
	DECLARE _tipoUnidad TINYINT UNSIGNED;

	DECLARE mejorasHeroe CURSOR FOR
					SELECT idMejora FROM unidadHeroeMejora
					WHERE idUnidadHeroe=NEW.idUnidad;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	IF NEW.contable THEN
		#Se decrementa la energia consumida
		SELECT cantidad*NEW.cantidad INTO _energia
		FROM `recursoUnidad`
		WHERE idUnidad=NEW.idUnidad AND idTipoRecurso=3;

		#Si se debe devolver energia
		IF COALESCE(_energia, 0)>0
		THEN
			#Actualiza la energia del jugador
			UPDATE tipoRecursoUsuario SET cantidad=cantidad-_energia WHERE idTipoRecurso=3 AND idJugador=NEW.idJugador;
		END IF;

		#Aumentamos el numero de unidades del tipo que se ha construido, para saber cuantas tenemos
		SELECT idTipoUnidad INTO _tipoUnidad FROM unidad WHERE id = NEW.idUnidad; #Obtengo el tipo
		#Actualizo su numero
		CASE _tipoUnidad
	        WHEN 1 THEN
	            UPDATE jugadorInfoGeneral SET numNaves = numNaves + NEW.cantidad WHERE idJugador=NEW.idJugador;
	        WHEN 2 THEN
	            UPDATE jugadorInfoGeneral SET numSoldados = numSoldados + NEW.cantidad WHERE idJugador=NEW.idJugador;
	        WHEN 3 THEN
	            UPDATE jugadorInfoGeneral SET numDefensas = numDefensas + NEW.cantidad WHERE idJugador=NEW.idJugador;
	    END CASE;

		#Aumenta la puntuacion del jugador
		CALL incPuntosUnidad(NEW.idJugador, NEW.idUnidad, NEW.cantidad);
	END IF;

	#Insertamos las mejoras de heroe
	IF EXISTS(SELECT * FROM unidadHeroe WHERE idUnidad=NEW.idUnidad) THEN
		SET _fin=0;
		OPEN mejorasHeroe;

		REPEAT
			FETCH mejorasHeroe INTO _idMejoraHeroe;

			IF NOT _fin
			THEN
				INSERT INTO jugadorMejora (`idMejora`, `idJugador`, `nivel`) VALUES (_idMejoraHeroe, NEW.idJugador, 1);
			END IF;
		UNTIL _fin END REPEAT;

		CLOSE mejorasHeroe;
	END IF;
END;
|

DELIMITER ;
