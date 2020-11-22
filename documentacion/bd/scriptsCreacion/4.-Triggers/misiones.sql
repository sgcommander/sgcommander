#############################################################################
#############################################################################
##                         TRIGGERS de MISIONES
##
## En este fichero sql se recogen todos los disparadores necesarios para la
## buena estabilidad de la base de datos (Mysql 5) y para controlar que una
## mala programacion no la inestabilice.
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 08/12/08
##
#############################################################################
#############################################################################
DROP TRIGGER IF EXISTS mision_BI;
DROP TRIGGER IF EXISTS mision_AI;
DROP TRIGGER IF EXISTS mision_AU;
DROP TRIGGER IF EXISTS mision_AD;
DROP TRIGGER IF EXISTS recursosObtenidos_AD;
DROP TRIGGER IF EXISTS unidadJugadorPlanetaMision_BI;
DROP TRIGGER IF EXISTS unidadJugadorPlanetaMision_BU;
DROP TRIGGER IF EXISTS unidadJugadorPlanetaMision_AD;


DELIMITER |

##INSERT mision:
####
####
CREATE TRIGGER mision_BI
BEFORE INSERT ON mision
FOR EACH ROW BEGIN
	DECLARE _numMisiones TINYINT UNSIGNED;
	DECLARE _limMisiones TINYINT UNSIGNED;

	#Sacamos el numero de misiones actuales del usuario
	SELECT
		COUNT(*) INTO _numMisiones
	FROM
		mision
	WHERE
		idJugador=NEW.idJugador;

	#Sacamos el limite de misiones del usuario
	SELECT
		limiteMisiones INTO _limMisiones
	FROM
		jugadorInfoGeneral
	WHERE
		idJugador=NEW.idJugador;


	#Comprobamos que no se supere el limite con la nueva mision
	IF _numMisiones>=_limMisiones THEN
		CALL LIMITEMISIONES;
    END IF;
    
    #Si es un despliegue actualizamos el planeta de despliegue
    IF NEW.idTipoMision = 2 THEN
    	SET NEW.idGalaxiaDespliegue=NEW.idGalaxiaDestino;
    	SET NEW.idPlanetaDespliegue=NEW.idPlanetaDestino;
    END IF;
END;
|

CREATE TRIGGER mision_AI
AFTER INSERT ON mision
FOR EACH ROW BEGIN
	#Anyado el evento a la lista
	INSERT INTO evento
		(tipo, idJugador, id, idGalaxia, idplaneta, tiempo) VALUES
		(5, NEW.idJugador, NEW.id, NEW.idGalaxiaDestino, NEW.idPlanetaDestino, DATE_ADD(NEW.fechaSalida, INTERVAL NEW.tiempoTrayecto SECOND));
END;
|

CREATE TRIGGER mision_AU
AFTER UPDATE ON mision
FOR EACH ROW BEGIN
    DECLARE _existe BIT DEFAULT 0;

    #Obtenemos el evento
    SELECT 1 INTO _existe FROM evento WHERE idJugador=NEW.idJugador
    AND tipo=5
    AND id=OLD.id;

    IF _existe THEN
	#Actualizo el tiempo del evento, por si se manda la mision de regreso
    	UPDATE evento
	SET
	    tiempo=DATE_ADD(NEW.fechaSalida, INTERVAL NEW.tiempoTrayecto SECOND),
    	    idGalaxia=NEW.idGalaxiaDestino,
    	    idPlaneta=NEW.idPlanetaDestino
	WHERE
	    idJugador=NEW.idJugador
	    AND tipo=5
	    AND id=OLD.id;
    ELSE
	#Si es una mision de despliegue que regresa o una nueva mision insertamos el evento
	INSERT INTO evento
		(tipo, idJugador, id, idGalaxia, idplaneta, tiempo) VALUES
		(5, NEW.idJugador, NEW.id, NEW.idGalaxiaDestino, NEW.idPlanetaDestino, DATE_ADD(NEW.fechaSalida, INTERVAL NEW.tiempoTrayecto SECOND));
    END IF;
END;
|

CREATE TRIGGER mision_AD
AFTER DELETE ON mision
FOR EACH ROW BEGIN
    #Elimino el evento de la tabla
    DELETE FROM evento
    WHERE
	idJugador=OLD.idJugador
	AND tipo=5
	AND id=OLD.id;
END;
|

####
#### Si en una mision se han recolectado recursos, este trigger
#### traspasa los recursos de la mision a tu cuenta
####
CREATE TRIGGER recursosObtenidos_AD
AFTER DELETE ON recursosObtenidos
FOR EACH ROW BEGIN
	UPDATE
		tipoRecursoUsuario
	SET
		cantidad = cantidad + OLD.cantidad
	WHERE
		idTipoRecurso = OLD.idTipoRecurso
		AND idJugador = OLD.idJugador;
END;
|

##INSERT unidadJugadorPlanetaMision:
####
####
CREATE TRIGGER unidadJugadorPlanetaMision_BI
BEFORE INSERT ON unidadJugadorPlanetaMision
FOR EACH ROW BEGIN
    DECLARE _cantActual INT UNSIGNED;
    DECLARE _especial	BIT;

    #Sacamos la cantidad maxima que podemos enviar en mision
    SELECT
	cantidad-cantidadEnMision INTO _cantActual
    FROM
	unidadJugadorPlaneta
    WHERE
	idUnidad=NEW.idUnidad
	AND idPlaneta=NEW.idPlaneta
    	AND idGalaxia=NEW.idGalaxia
	AND idJugador=NEW.idJugador;

    #Si tenemos suficientes unidades
    IF NEW.cantidadEnviada > _cantActual THEN
        CALL NOSUFICIENTESUNIDADES;
    ELSE
    	#Actualizo los valores de unidadJugadorPlaneta, para que aumente la cantidad de unidades
    	#enviadas en mision y disminuya la cantidad en planeta
        UPDATE
		unidadJugadorPlaneta
        SET
		cantidadEnMision=cantidadEnMision+NEW.cantidadEnviada
        WHERE
		idUnidad=NEW.idUnidad
		AND idPlaneta=NEW.idPlaneta
        	AND idGalaxia=NEW.idGalaxia
		AND idJugador=NEW.idJugador;

		#Indico si la unidad debe ser contada o no
		SET _especial = 0;
		SELECT 1 INTO _especial
		FROM especialUnidad
		WHERE idUnidad=NEW.idUnidad;
		
		SET NEW.contable = NOT _especial;
		
		#La cantidad inicial es la mima que la actual en un inicio
		SET NEW.cantidadActual = NEW.cantidadEnviada;
	END IF;
END;

|

##UPDATE unidadJugadorPlanetaMision:
####
####
CREATE TRIGGER unidadJugadorPlanetaMision_BU
BEFORE UPDATE ON unidadJugadorPlanetaMision
FOR EACH ROW BEGIN
    DECLARE _especial BIT;

	#Indico si la unidad debe ser contada o no
	SET _especial = 0;
	SELECT 1 INTO _especial
	FROM especialUnidad
	WHERE idUnidad=NEW.idUnidad;
	
	SET NEW.contable = NOT _especial;
END;

|

##DELETE unidadJugadorPlanetaMision:
####
####
CREATE TRIGGER unidadJugadorPlanetaMision_AD
AFTER DELETE ON unidadJugadorPlanetaMision
FOR EACH ROW
BEGIN
	DECLARE _cantidad, _enMision INT UNSIGNED;
	DECLARE _vuelta, _disponible, _eliminar BIT DEFAULT FALSE;

	DECLARE _miPlaneta, _traslado BIT;
	DECLARE _idGalaxiaDestino TINYINT UNSIGNED;
	DECLARE _idPlanetaDestino MEDIUMINT UNSIGNED;

	SELECT m.vuelta, COALESCE(pc.idJugador=OLD.idJugador, FALSE) AS miPlaneta, tm.traslado, m.idPlanetaDestino, m.idGalaxiaDestino
	INTO _vuelta, _miPlaneta, _traslado, _idPlanetaDestino, _idGalaxiaDestino
	FROM mision AS m
			LEFT JOIN tipoMision AS tm
				ON m.idTipoMision=tm.id
			LEFT JOIN planetaColonizado AS pc
				ON m.idGalaxiaDestino = pc.idGalaxia AND m.idPlanetaDestino = pc.idPlaneta
	WHERE m.id=OLD.idMision;

	#Si es una mision de traslado, el planeta destino es mio y no se ha dado la vuelta, es que debo de realizarlo
	IF _traslado AND NOT _vuelta AND _miPlaneta THEN
		#Actualizamos los datos en origen, para eliminar o actualizar dicha unidad
		SELECT
			cantidad INTO _cantidad
		FROM
			unidadJugadorPlaneta
		WHERE
			idUnidad=OLD.idUnidad
			AND idPlaneta=OLD.idPlaneta
			AND idGalaxia=OLD.idGalaxia;

		#Si se debe de actualizar
		IF _cantidad > OLD.cantidadEnviada THEN
			UPDATE
				unidadJugadorPlaneta
			SET
				cantidad=cantidad-OLD.cantidadEnviada,
				cantidadEnMision=cantidadEnMision-OLD.cantidadEnviada
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=OLD.idPlaneta
				AND idGalaxia=OLD.idGalaxia;
		#Sino, se debe eliminar
		ELSE
			DELETE FROM unidadJugadorPlaneta
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=OLD.idPlaneta
				AND idGalaxia=OLD.idGalaxia;
		END IF;

		#Compruebo si esa unidad ya existe en el planeta de destino
		#No hace falta poner en el where si el planeta de destino es mio, ya que eso lo
		#sabemos gracias a la varaible miPlaneta

		#En principio consideramos que la unidad no existe en el planeta
		SET _disponible = FALSE;

		SELECT
			TRUE INTO _disponible
		FROM
			unidadJugadorPlaneta
		WHERE
			idUnidad=OLD.idUnidad
			AND idPlaneta=_idPlanetaDestino
			AND idGalaxia=_idGalaxiaDestino;

		#Si existe, la actualizamos
		IF _disponible THEN
			UPDATE
				unidadJugadorPlaneta
			SET
				cantidad=cantidad+OLD.cantidadActual
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=_idPlanetaDestino
				AND idGalaxia=_idGalaxiaDestino;

		#Sino la insertamos
		ELSE
			INSERT INTO unidadJugadorPlaneta VALUES
				(OLD.idUnidad, _idPlanetaDestino, _idGalaxiaDestino, OLD.idJugador, OLD.cantidadActual, 0, OLD.contable);
		END IF;

	#Si no es un traslado de tropas, finalizo la mision de forma normal
	ELSE
		#Si han muerto todas las unidades en la batalla, es posible que se tenga que
		#eliminar el tipo de unidad del planeta de origen
		IF OLD.cantidadActual = 0 THEN
			#Recojo la cantidad disponible de esa unidad en el planeta y cuanta hay en mision
			SELECT
				cantidad, cantidadEnMision INTO _cantidad, _enMision
			FROM
				unidadJugadorPlaneta
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=OLD.idPlaneta
				AND idGalaxia=OLD.idGalaxia
				AND idJugador=OLD.idJugador;

			#Si no hay cantidad disponible en el planeta y las que hay en mision, coindiden con el
			#numero de cantidad enviada (de la cual no ha vuelto ninguna unidad), es que no me quedan
			#comandos de dicha unidad, por lo que se debe de eliminar
			IF OLD.cantidadActual = 0 AND _enMision = OLD.cantidadEnviada AND _cantidad = OLD.cantidadEnviada THEN
				SET _eliminar = TRUE;
			END IF;
		END IF;

		#Si no se ha de eliminar se actualiza (lo mas comun)
		IF NOT _eliminar THEN
			#Ajustamos las cantidades
			UPDATE
				unidadJugadorPlaneta
			SET
				cantidadEnMision=cantidadEnMision-OLD.cantidadEnviada,
				cantidad=cantidad-(OLD.cantidadEnviada-OLD.cantidadActual)
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=OLD.idPlaneta
				AND idGalaxia=OLD.idGalaxia
				AND idJugador=OLD.idJugador;
		#Si no se elimina
		ELSE
			DELETE FROM unidadJugadorPlaneta
			WHERE
				idUnidad=OLD.idUnidad
				AND idPlaneta=OLD.idPlaneta
				AND idGalaxia=OLD.idGalaxia
				AND idJugador=OLD.idJugador;
		END IF;
	END IF;
END;
|

DELIMITER ;
