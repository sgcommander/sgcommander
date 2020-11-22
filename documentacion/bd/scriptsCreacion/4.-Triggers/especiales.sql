#############################################################################
#############################################################################
##                         TRIGGERS de ESPECIALES
##
## En este fichero sql se recogen todos los disparadores necesarios para la
## buena estabilidad de la base de datos (Mysql 5) y para controlar que una
## mala programacion no la inestabilice.
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 24/11/08
##
#############################################################################
#############################################################################

DROP TRIGGER IF EXISTS jugadorEspecialActivo_BI;
DROP TRIGGER IF EXISTS jugadorEspecialActivo_AD;
DROP TRIGGER IF EXISTS jugadorEspecialEspera_AD;

DELIMITER |

####
####Se realizan las acciones del especial
####
CREATE TRIGGER jugadorEspecialActivo_BI
BEFORE INSERT ON jugadorEspecialActivo
FOR EACH ROW
BEGIN
    DECLARE _idUnidad SMALLINT UNSIGNED;
    DECLARE _idMejora SMALLINT UNSIGNED;
    DECLARE _recargando BIT;
    DECLARE _porcentajeUnidades TINYINT UNSIGNED;
    DECLARE _cantidadUnidades SMALLINT UNSIGNED;
    DECLARE _puntosTecnologia MEDIUMINT UNSIGNED;
    DECLARE _fin BIT;
    DECLARE _duracion MEDIUMINT UNSIGNED;

    #Cursor para recorrer las unidades
    DECLARE unidadesEspecial CURSOR FOR
                SELECT
			idUnidad,
			cantidad
                FROM
			`especialUnidad`
                WHERE
			idEspecial=NEW.idEspecial;

    #Cursor para recorrer las mejoras
    DECLARE mejorasEspecial CURSOR FOR
                SELECT
			idMejora
                FROM
			`especialMejora`
                WHERE
			idEspecial=NEW.idEspecial;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    #Comprobamos si existe el especial para este jugador en la tabla de espera
    #ATENCION! Esta sentencia en algunos casos modifica la varaible fin a 1 a traves del handler
    SET _recargando = FALSE;

    SELECT
	TRUE INTO _recargando
    FROM
	jugadorEspecialEspera
    WHERE
	idEspecial=NEW.idEspecial
	AND idJugador=NEW.idJugador;

    #Si se esta recargando el especial, no se puede insertar
    IF _recargando THEN
        CALL ESPECIALRECARGANDO;
    END IF;

    #Comprobamos que haya pasado el tiempo de recarga
    SELECT
	tiempoDuracion INTO _duracion
    FROM
	especial
    WHERE
	idEspecial=NEW.idEspecial;

    #Establecemos la fecha en la que el especial dejara de estar activo
    SET NEW.finEspecial := DATE_ADD(NOW() ,INTERVAL (_duracion) SECOND);

    #Sacamos los puntos de tecnologias
    SELECT
	puntosTecnologias INTO _puntosTecnologia
    FROM
	jugadorInfoPuntuaciones
    WHERE
	idJugador=NEW.idJugador;


    #Ponemos el flag fin a 0 para que el bucle funcione (requerido solo en algunso casos)
    SET _fin=0;
    #Hago que las unidades otorgadas por los especiales no contabilicen
    OPEN unidadesEspecial;

    REPEAT
        FETCH unidadesEspecial INTO _idUnidad, _porcentajeUnidades;

        IF NOT _fin THEN
	    SET _cantidadUnidades=_puntosTecnologia*_porcentajeUnidades/100;

            #Si es un heroe insertamos solo uno
	    IF _porcentajeUnidades IS NULL OR _cantidadUnidades=0 THEN
		SET _cantidadUnidades=1;
            END IF;

	    INSERT INTO unidadJugadorPlaneta
		(idUnidad,idPlaneta,idGalaxia,idJugador,cantidad, contable) VALUES
		(_idUnidad,NEW.idPlaneta,NEW.idGalaxia,NEW.idJugador,_cantidadUnidades, 0);
	END IF;
    UNTIL _fin END REPEAT;

    CLOSE unidadesEspecial;

    #Insertamos las mejoras del especial
    SET _fin=0;
    OPEN mejorasEspecial;

    REPEAT
        FETCH mejorasEspecial INTO _idMejora;

        IF NOT _fin THEN
            INSERT INTO jugadorMejora
		(idMejora, idJugador, nivel) VALUES
		(_idMejora, NEW.idJugador,1);
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE mejorasEspecial;

    #Anyado el evento a la lista
    INSERT INTO evento
	(tipo, idJugador, id, tiempo) VALUES
	(3, NEW.idJugador, NEW.idEspecial, NEW.finEspecial);
END;
|



####
####Se deshacen las acciones del especial
####
CREATE TRIGGER jugadorEspecialActivo_AD
AFTER DELETE ON jugadorEspecialActivo
FOR EACH ROW
BEGIN
    DECLARE _idUnidad SMALLINT UNSIGNED;
    DECLARE _idMejora SMALLINT UNSIGNED;
    DECLARE _cantidadEnMision INT UNSIGNED;
    DECLARE _fin BIT;
    DECLARE _tiempoFinal TIMESTAMP;

    #Cursor para recorrer las unidades
    DECLARE unidadesEspecial CURSOR FOR
                SELECT
			eu.idUnidad,
			ujp.cantidadEnMision
		FROM `especialUnidad` AS eu
			LEFT JOIN `unidadJugadorPlaneta` AS ujp ON (eu.idUnidad = ujp.idUnidad)
		WHERE
			eu.idEspecial=OLD.idEspecial
			AND ujp.idJugador=OLD.idJugador;

    #Cursor para recorrer las mejoras
    DECLARE mejorasEspecial CURSOR FOR
                SELECT
			idMejora
                FROM
			`especialMejora`
                WHERE
			idEspecial=OLD.idEspecial;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    #Ponemos el flag fin a 0 para que el bucle funcione
    SET _fin=0;

    OPEN unidadesEspecial;

    REPEAT
        FETCH unidadesEspecial INTO _idUnidad, _cantidadEnMision;

        IF NOT _fin THEN
            #Si hay unidades en mision
			IF _cantidadEnMision > 0 THEN
				CALL eliminarUnidadMision(_idUnidad, OLD.idJugador);
			END IF;

			#Eliminamos las unidades del especial del planeta
			DELETE FROM unidadJugadorPlaneta WHERE idUnidad=_idUnidad AND idJugador=OLD.idJugador;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE unidadesEspecial;

    #Borramos las mejoras del especial
    SET _fin=0;
    OPEN mejorasEspecial;

    REPEAT
        FETCH mejorasEspecial INTO _idMejora;

        IF NOT _fin THEN
            DELETE FROM jugadorMejora WHERE idMejora=_idMejora AND idJugador=OLD.idJugador;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE mejorasEspecial;

    #Tiempo de finalizacion de la espera
    SET _tiempoFinal=DATE_ADD(OLD.finEspecial ,INTERVAL (SELECT tiempoRecarga FROM especial WHERE idEspecial=OLD.idEspecial) SECOND);

    #Insertamos el especial en la lista de espera
    INSERT INTO jugadorEspecialEspera
    (idEspecial, idJugador, tiempoFinalEspera)
    VALUES
    (OLD.idEspecial,OLD.idJugador, _tiempoFinal);

    #Anyado un evento
    INSERT INTO evento
	(tipo, idJugador, id, tiempo) VALUES
	(4, OLD.idJugador, OLD.idEspecial, _tiempoFinal);

    #Elimino un evento
    DELETE FROM evento
    WHERE
	idJugador=OLD.idJugador
	AND tipo=3
	AND id=OLD.idEspecial;
END;
|


CREATE TRIGGER jugadorEspecialEspera_AD
AFTER DELETE ON jugadorEspecialEspera
FOR EACH ROW
BEGIN
    #Elimino un evento
    DELETE FROM evento
    WHERE
	idJugador=OLD.idJugador
	AND tipo=4
	AND id=OLD.idEspecial;
END;
|

DELIMITER ;
