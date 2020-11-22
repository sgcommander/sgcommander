#############################################################################
#############################################################################
##                         TRIGGERS de ALIANZA
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
##
## Changelog
## v0.2
## -Añadido triggers para la alianza
## -Arreglado cambios en nombres de campos en la mensajeria
##
## v0.1
## -Añadidos los triggers para el control de las variables desnormalizadas
##  de las tablas mensaje y recibeMensaje.
#############################################################################
#############################################################################

DROP TRIGGER IF EXISTS alianza_AI;

DELIMITER |

CREATE TRIGGER alianza_AI
AFTER INSERT ON alianza
FOR EACH ROW BEGIN
	UPDATE 
		jugador 
	SET 
		idAlianza=NEW.id 
	WHERE 
		idUsuario=NEW.idFundador;
END;
|

DELIMITER ;
