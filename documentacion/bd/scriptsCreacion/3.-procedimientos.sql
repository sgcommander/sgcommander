#############################################################################
#############################################################################
##                                PROCEDIMIENTOS
##
## En este fichero sql se recogen todos los procedimientos
## que serán utilizados por el resto de disparadores y procesos
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 03/11/08
##
#############################################################################
#############################################################################

DROP PROCEDURE IF EXISTS `incPuntosUnidad`;
DROP PROCEDURE IF EXISTS `decPuntosUnidad`;
DROP PROCEDURE IF EXISTS `eliminarUnidadMision`;
DROP FUNCTION IF EXISTS `cantidadProporcional`;

delimiter |

#############################################################################
## Este procedimiento incrementa los puntos de una unidad a un usuario
#############################################################################
CREATE PROCEDURE `incPuntosUnidad` (IN idJugadorConstruye INTEGER UNSIGNED, IN idUnidad INTEGER UNSIGNED, IN cantidad INTEGER UNSIGNED)
BEGIN
	DECLARE idTipo TINYINT UNSIGNED;
    DECLARE puntuacion INTEGER UNSIGNED;

	#Calculo de los puntos obtenidos
	SELECT idTipoUnidad, puntos INTO idTipo, puntuacion FROM unidad WHERE id=idUnidad;
	SET puntuacion=puntuacion*cantidad;

	#Asignando los puntos obtenidos
	CASE idTipo
		WHEN 1 THEN
 			UPDATE jugadorInfoPuntuaciones SET puntosNaves=puntosNaves+puntuacion WHERE idJugador=idJugadorConstruye;
		WHEN 2 THEN
			UPDATE jugadorInfoPuntuaciones SET puntosSoldados=puntosSoldados+puntuacion WHERE idJugador=idJugadorConstruye;
		WHEN 3 THEN
			UPDATE jugadorInfoPuntuaciones SET puntosDefensas=puntosDefensas+puntuacion WHERE idJugador=idJugadorConstruye;
	END CASE;
END;
|

#############################################################################
## Este procedimiento decrementa los puntos de una unidad a un usuario
#############################################################################
CREATE PROCEDURE `decPuntosUnidad` (IN idJugadorConstruye INTEGER UNSIGNED, IN idUnidad INTEGER UNSIGNED, IN cantidad INTEGER UNSIGNED)
BEGIN
    DECLARE idTipo TINYINT UNSIGNED;
    DECLARE puntuacion INTEGER UNSIGNED;

	#Calculo de los puntos obtenidos
	SELECT idTipoUnidad, puntos INTO idTipo, puntuacion FROM unidad WHERE id=idUnidad;
	SET puntuacion=puntuacion*cantidad;

	#Asignando los puntos obtenidos
	CASE idTipo
		WHEN 1 THEN
 			UPDATE jugadorInfoPuntuaciones SET puntosNaves=puntosNaves-puntuacion WHERE idJugador=idJugadorConstruye;
		WHEN 2 THEN
			UPDATE jugadorInfoPuntuaciones SET puntosSoldados=puntosSoldados-puntuacion WHERE idJugador=idJugadorConstruye;
		WHEN 3 THEN
			UPDATE jugadorInfoPuntuaciones SET puntosDefensas=puntosDefensas-puntuacion WHERE idJugador=idJugadorConstruye;
	END CASE;
END;
|

#############################################################################
#
# Este procedimiento, permite eliminar de cualquier mision, una unidad
# que esta contenga. Teniendo en cuenta que si solo habia ese tipo de unidad
# la mision sera eliminada definitivamente, mientras que si existian mas
# tipos de unidades, la mision proseguira, pero sin la unidad eliminada
#
#############################################################################
CREATE PROCEDURE eliminarUnidadMision (IN idUnd INT, IN idJug INT)
BEGIN
	DECLARE fin INT;
	DECLARE otrasUnidades INT;
	DECLARE idMis INT;

	#Obtenemos los identificadores de mision y la cantidad de distitnas unidades que hay en ellas
	DECLARE misionesAfectadas CURSOR FOR
		SELECT COUNT(*)>1, idMision
		FROM unidadJugadorPlanetaMision
		WHERE idMision IN(
				SELECT id FROM mision AS m
				JOIN unidadJugadorPlanetaMision AS u ON m.id=u.idMision
				WHERE u.idUnidad=idUnd AND m.idJugador=idJug
			)
		GROUP BY idMision;

	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

	SET fin=0;

	OPEN misionesAfectadas;

	REPEAT
		FETCH misionesAfectadas INTO otrasUnidades, idMis;

		IF NOT fin THEN
			#Eliminamos las unidades especiales de la mision
			DELETE FROM unidadJugadorPlanetaMision WHERE idUnidad=idUnd AND idJugador=idJug AND idMision=idMis;

			#Si no hay otras unidades a parte de las especiales, se elimina la mision
			IF NOT otrasUnidades THEN
				DELETE FROM mision WHERE id=idMis;
			END IF;
		END IF;
	UNTIL fin END REPEAT;
END
|


#############################################################################
## Esta funcion permite calcular los recursos devueltos a los usuarios con
## respecto al coste inicial de la construccion o investigacion, teniendo en
## cuenta cuando se inicio la construccion/investigacion y cuando termina.
##
## Ademas tiene como parametro un valor porcentual, el cual indica la
## cantidad maxima que se puede quitar en total a los recursos.
##
##  Ej: 0.8 (proporcionalidad)
##      justo cuando llegue al final del tiempo, si se cancela y el usuario
##      pag� 100 de recursos, solo se le devolveran 19.9......
#############################################################################
CREATE FUNCTION `cantidadProporcional` (proporcion FLOAT, tiempoInicial TIMESTAMP, tiempoFinal TIMESTAMP, cantidad FLOAT)
RETURNS FLOAT
BEGIN
	SET cantidad = cantidad-(((proporcion*cantidad)/(UNIX_TIMESTAMP(tiempoFinal)-UNIX_TIMESTAMP(tiempoInicial)))*(UNIX_TIMESTAMP(CURRENT_TIMESTAMP)-UNIX_TIMESTAMP(tiempoInicial)));
	IF cantidad < 0 THEN
		SET cantidad = 0;
	END IF;

	RETURN cantidad;
END;
|

DELIMITER ;
