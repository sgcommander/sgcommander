#############################################################################
#############################################################################
##                         TRIGGERS de MENSAJERIA
## 
## En este fihcero sql se recogen todos los disparadores necesarios para la
## buena estabilidad de la base de datos (Mysql 5) y para controlar que una
## mala programacion no la inestabilice.
##
## Version: 0.1
## Autores: David & Jose
## Fecha: 20/05/08
##
## Changelog
## v0.3
## Separados los triggers en distintos ficheros por categorias
## A�adidos nuevos triggers
##
## Changelog
## v0.2
## �A�adido triggers para la alianza
## �Arreglado cambios en nombres de campos en la mensajeria
##
## v0.1
## �A�adidos los triggers para el control de las variables desnormalizadas
##  de las tablas mensaje y recibeMensaje.
#############################################################################
#############################################################################

#############################################################################
## Borramos los triggers existentes
#############################################################################
DROP TRIGGER IF EXISTS recibeMensaje_BI;
DROP TRIGGER IF EXISTS recibeMensaje_AI;
DROP TRIGGER IF EXISTS recibeMensaje_AU;
DROP TRIGGER IF EXISTS recibeMensaje_AD;
DROP TRIGGER IF EXISTS mensaje_BI;
DROP TRIGGER IF EXISTS usuario_BU;

DELIMITER |

################
## MENSAJERIA ##
################
#############################################################################
## Este trigger permite la desnormalizacion de la tabla recibeMensaje, ya que
## se asegura de que el campo nombreUsuario, el cual esta desnormalizado, sea
## consistente con la informacion de la base de datos.
#############################################################################
CREATE TRIGGER recibeMensaje_BI
BEFORE INSERT ON recibeMensaje
FOR EACH ROW BEGIN
	SET NEW.nombreUsuario = (SELECT nombre FROM usuario WHERE id=NEW.idJugador);
END;
|
#############################################################################
## Este trigger permite la desnormalizacion de la tabla jugador, ya que
## se asegura de que el campo numeroMensajes, el cual esta desnormalizado, sea
## consistente con la informacion de la base de datos (Numero de mensajes no
## leidos en la bandeja de entrada).
#############################################################################
CREATE TRIGGER recibeMensaje_AI
AFTER INSERT ON recibeMensaje
FOR EACH ROW BEGIN
	UPDATE jugadorInfoGeneral SET numeroMensajes=numeroMensajes+1 WHERE idJugador=NEW.idJugador;
END;
|
#############################################################################
## Este trigger permite la desnormalizacion de la tabla jugador, ya que
## se asegura de que el campo numeroMensajes, el cual esta desnormalizado, sea
## consistente con la informacion de la base de datos (Numero de mensajes no
## leidos en la bandeja de entrada).
#############################################################################
CREATE TRIGGER recibeMensaje_AU
AFTER UPDATE ON recibeMensaje
FOR EACH ROW BEGIN
	IF OLD.leido != NEW.leido
	THEN
		IF NEW.leido=0
		THEN
			UPDATE jugadorInfoGeneral SET numeroMensajes=numeroMensajes+1 WHERE idJugador=OLD.idJugador;
		ELSE
			UPDATE jugadorInfoGeneral SET numeroMensajes=numeroMensajes-1 WHERE idJugador=OLD.idJugador;
		END IF;
	END IF;
END;
|

#############################################################################
## Elimina todos los mensajes de la tabla "mensajes" los cuales ya no tienen
## ninguna entrada en "recibeMensaje", o sea que no tienen ya ningun 
## destinatario, ya que estos han borrado el mensaje.
#############################################################################
CREATE TRIGGER recibeMensaje_AD
AFTER DELETE ON recibeMensaje
FOR EACH ROW BEGIN
	DECLARE num BIT DEFAULT 0;
	
	#Resta el numero de mensajes en bandeja de entrada del ususario
	#si el mensaje figuraba como no leido
	IF OLD.leido=0
	THEN
		UPDATE jugadorInfoGeneral SET numeroMensajes=numeroMensajes-1 WHERE idJugador=OLD.idJugador;
	END IF;
	
	#Elimina el mensaje si no quedan mas destinatarios
	SELECT 1 INTO num FROM recibeMensaje WHERE idMensaje=OLD.idMensaje LIMIT 1;
	IF num = 0 THEN
		DELETE FROM mensaje WHERE id=OLD.idMensaje;
	END IF;
END;
|

#############################################################################
## Elimina todos los mensajes de la tabla "mensajes" los cuales ya no tienen
## ninguna entrada en "recibeMensaje", o sea que no tienen ya ningun 
## destinatario, ya que estos han borrado el mensaje.
#############################################################################
CREATE TRIGGER mensaje_BI
BEFORE INSERT ON mensaje
FOR EACH ROW BEGIN
	IF NEW.idJugador IS NOT NULL THEN
		SET NEW.nombreUsuario = (SELECT nombre FROM usuario WHERE id=NEW.idJugador);
	ELSE
		SET NEW.nombreUsuario='Sistema';
	END IF;
END;
|

#############################################################################
## Este trigger permite mantener la consistencia de los nombres de usuario
## entre la tabla usuario y los campos nombre de la tabla mensaje y
## la tabla recibeMensaje los cuales estan desnormalizados.
#############################################################################
CREATE TRIGGER usuario_BU
BEFORE UPDATE ON usuario
FOR EACH ROW BEGIN
	IF NEW.nombre != OLD.nombre THEN
		UPDATE mensaje SET nombreUsuario=NEW.nombre WHERE idUsuario=OLD.id;
		UPDATE recibeMensaje SET nombreUsuario=NEW.nombre WHERE idUsuario=OLD.id;
	END IF;
END;
|

DELIMITER ;
