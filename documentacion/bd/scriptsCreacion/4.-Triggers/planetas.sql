#############################################################################
#############################################################################
##                         TRIGGERS de PLANETA
##
## En este fihcero sql se recogen todos los disparadores necesarios para la
## buena estabilidad de la base de datos (Mysql 5) y para controlar que una
## mala programacion no la inestabilice.
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 07/11/08
##
#############################################################################
#############################################################################

DROP TRIGGER IF EXISTS planeta_BI;
DROP TRIGGER IF EXISTS planeta_BD;
DROP TRIGGER IF EXISTS planetaColonizado_BI;
DROP TRIGGER IF EXISTS planetaColonizado_BU;
DROP TRIGGER IF EXISTS planetaColonizado_AD;
DROP TRIGGER IF EXISTS planetaExplorado_BI;

DELIMITER |

##INSERT planeta:
####
####Se incrementa el numero de planetas de la galaxia
####
CREATE TRIGGER planeta_BI
BEFORE INSERT ON planeta
FOR EACH ROW BEGIN
	UPDATE galaxia SET nPlanetas=nPlanetas+1 WHERE id=NEW.idGalaxia;
END;

|

##DELETE planeta:
####
####Se decrementa el numero de planetas de la galaxia
####
CREATE TRIGGER planeta_BD
BEFORE DELETE ON planeta
FOR EACH ROW BEGIN
	UPDATE galaxia SET nPlanetas=nPlanetas-1 WHERE id=OLD.idGalaxia;
END;

|

##INSERT planetaColonizado:
####
####Se decrementa el numero de planetas de la galaxia
####
CREATE TRIGGER planetaColonizado_BI
BEFORE INSERT ON planetaColonizado
FOR EACH ROW BEGIN
	DECLARE _maximoPlanetas TINYINT UNSIGNED;
	DECLARE _totalPlanetas TINYINT UNSIGNED;

	#Sacamos cuantos planetas posee el jugador
	SELECT COUNT(*) INTO _totalPlanetas FROM planetaColonizado
	WHERE idJugador=NEW.idJugador;

	#Sacamos el maximo de planetas que permite la raza del jugador
	SELECT maxPlanetas INTO _maximoPlanetas FROM raza r INNER JOIN jugador j ON j.idRaza=r.id AND j.idUsuario=NEW.idJugador;

	#Si no se supera el limite de planetas
	IF _totalPlanetas < _maximoPlanetas THEN
		#Si se inserta un principal y ya se tiene un principal
	 	IF NEW.principal=1 AND _totalPlanetas!=0 THEN
	 		CALL YATIENEPRINCIPAL;
		ELSE
			#Actualizamos las cuentas en la galaxia

			IF _totalPlanetas=0 THEN
				SET NEW.principal=1;
				UPDATE galaxia SET nCuentas=nCuentas+1 WHERE id=NEW.idGalaxia;
			END IF;

			#Actualizamos el propietario
			UPDATE planetaExplorado SET idPropietario=NEW.idJugador
			WHERE idGalaxia=NEW.idGalaxia AND idPlaneta=NEW.idPlaneta;
		END IF;
	ELSE
		CALL MAXPLANETASSOBREPASADO;
	END IF;
END;

|

##UPDATE planetaColonizado:
####
####Se comprueba el planeta principal
####
CREATE TRIGGER planetaColonizado_BU
BEFORE UPDATE ON planetaColonizado
FOR EACH ROW BEGIN
	SET NEW.principal=OLD.principal;
END;

|

##DELETE planetaColonizado:
####
####Se decrementa el numero de cuentas de la galaxia y se borra el nombre del planeta
####
CREATE TRIGGER planetaColonizado_AD
AFTER DELETE ON planetaColonizado
FOR EACH ROW BEGIN
	DECLARE _fin, _especial BIT;
	DECLARE _idUnidad SMALLINT UNSIGNED;
	DECLARE _cantidadEnMision INT UNSIGNED;

	DECLARE _planetaHeroes CURSOR FOR
                SELECT pu.idUnidad, IFNULL(ujp.cantidadEnMision,0) AS cantidad
                FROM planetaUnidad AS pu
                	LEFT JOIN unidadJugadorPlaneta AS ujp ON pu.idUnidad=ujp.idUnidad AND ujp.idJugador=OLD.idJugador
                	JOIN unidadHeroe AS uh ON pu.idUnidad=uh.idUnidad
                WHERE pu.idPlanetaEsp=OLD.idPlaneta
                	AND pu.idGalaxia=OLD.idGalaxia;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	SELECT 1 INTO _especial FROM planetaEspecial
	WHERE idPlanetaEsp=OLD.idPlaneta AND idGalaxia=OLD.idGalaxia;

	#Borramos el nombre si no es especial
	IF NOT _especial THEN
		UPDATE planeta SET nombrePlaneta='' WHERE idPlaneta=OLD.idPlaneta AND idGalaxia=OLD.idGalaxia;
	ELSE
		#Eliminamos los heroes del jugador propietario
	    SET _fin=0;
	    OPEN _planetaHeroes;
	    REPEAT
        	FETCH _planetaHeroes INTO _idUnidad, _cantidadEnMision;
	        IF NOT _fin THEN
	            #Si hay unidades en mision
		    IF _cantidadEnMision > 0 THEN
			CALL eliminarUnidadMision(_idUnidad, OLD.idJugador);
		    END IF;

		    #Eliminamos las unidades del especial del planeta
		    DELETE FROM unidadJugadorPlaneta WHERE idUnidad=_idUnidad AND idJugador=OLD.idJugador;
	        END IF;
	    UNTIL _fin END REPEAT;

    	CLOSE _planetaHeroes;
	END IF;

	#Actualizamos las cuentas en la galaxia
	IF OLD.principal=1 THEN
		UPDATE galaxia SET nCuentas=nCuentas-1 WHERE id=OLD.idGalaxia;
	END IF;

	#Actualizamos el propietario
	UPDATE planetaExplorado SET idPropietario=NULL
	WHERE idGalaxia=OLD.idGalaxia
		AND idPlaneta=OLD.idPlaneta;
END;
|

##INSERT planetaExplorado:
####
####Actualiza el campo idPropietario
####
CREATE TRIGGER planetaExplorado_BI
BEFORE INSERT ON planetaExplorado
FOR EACH ROW BEGIN
	DECLARE propietario SMALLINT UNSIGNED;

	#Sacamos el propietario del planeta
	SELECT idJugador INTO propietario FROM planetaColonizado
	WHERE idGalaxia=NEW.idGalaxia AND idPlaneta=NEW.idPlaneta;

	#Actualizamos el campo
	SET NEW.idPropietario=propietario;
END;

|

DELIMITER ;
