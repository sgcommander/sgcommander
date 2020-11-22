#############################################################################
#############################################################################
##                         TRIGGERS de MEJORAS
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
##DELETE jugadorMejoraInvestiga:
####Si tiempo es menos o igual que el tiempo actual,
####entonces el jugador mejora se sumara un nivel a la mejora del usuario, y si el
####tiempo es mayor entonces se devolveran los recursos que cuesta la mejora al usuario
####En caso de borrar la investigacion y que esta haya finalizado, se creara en caso de
####no haberla investigado nunca o se sumara un nivel a la mejora. Si la investigación, no
####ha finalizado, se calculan los costes de la mejora y se devuelven al jugador

DROP TRIGGER IF EXISTS jugadorMejora_AI;
DROP TRIGGER IF EXISTS jugadorMejora_AU;
DROP TRIGGER IF EXISTS jugadorMejora_BD;
DROP TRIGGER IF EXISTS jugadorMejora_AD;

DROP TRIGGER IF EXISTS jugadorMejoraInvestiga_AD;
DROP TRIGGER IF EXISTS jugadorMejoraInvestiga_BI;



DELIMITER |

CREATE TRIGGER jugadorMejora_AI
AFTER INSERT ON jugadorMejora
FOR EACH ROW BEGIN
    DECLARE _puntosTecnologicos SMALLINT UNSIGNED DEFAULT 0;
    DECLARE _aumento MEDIUMINT;
    DECLARE _tipoRecurso, _tipoUnidad SMALLINT UNSIGNED;
    DECLARE _tipoMejora SMALLINT UNSIGNED;
    DECLARE _fin BIT;
    DECLARE _nivelMinHiper TINYINT UNSIGNED;

    DECLARE unidadesMejora CURSOR FOR
                SELECT porcentaje, idTipoUnidad, idTipoMejora
                FROM mejoraTipoUnidadTipoMejora
                WHERE idMejora=NEW.idMejora;

    DECLARE recursosMejora CURSOR FOR
                SELECT porcentaje, idTipoRecurso
                FROM mejoraTipoRecurso
                WHERE idMejora=NEW.idMejora;

    DECLARE generalMejora CURSOR FOR
                SELECT porcentaje, idTipoMejora
                FROM mejoraTipoMejoraGeneral
                WHERE idMejora=NEW.idMejora;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    #Actualiza la puntuacion en los puntos sobre Tecnologias
    SELECT puntos INTO _puntosTecnologicos FROM mejoraNormal WHERE idMejora=NEW.idMejora;

    UPDATE jugadorInfoPuntuaciones SET puntosTecnologias=puntosTecnologias+_puntosTecnologicos WHERE idJugador=NEW.idJugador;

    #Actualiza los porcentajes de mejoras que afectan a unidades
    SET _fin=0;
    OPEN unidadesMejora;

    REPEAT
        FETCH unidadesMejora INTO _aumento, _tipoUnidad, _tipoMejora;

        IF NOT _fin
        THEN
            CASE _tipoUnidad
            WHEN 1 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET navesCarga = navesCarga + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET navesAtaque = navesAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET navesResistencia = navesResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET navesEscudo = navesEscudo + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 5 THEN
                        UPDATE jugadorInfoUnidades SET navesVelocidad = navesVelocidad + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            WHEN 2 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET soldadosCarga = soldadosCarga + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET soldadosAtaque = soldadosAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET soldadosResistencia = soldadosResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET soldadosEscudo = soldadosEscudo + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            WHEN 3 THEN
                CASE _tipoMejora
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET defensasAtaque = defensasAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET defensasResistencia = defensasResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET defensasEscudo = defensasEscudo + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE unidadesMejora;

    #Actualiza las nuevas producciones de los recursos
    SET _fin=0;
    OPEN recursosMejora;

    REPEAT
        FETCH recursosMejora INTO _aumento, _tipoRecurso;

        IF NOT _fin
        THEN
            #Actualizamos el porcentaje de produccion dependiendo del tipo de recurso
            CASE _tipoRecurso
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET produccionPrimario = produccionPrimario*((_aumento/100)+1) WHERE idJugador=NEW.idJugador;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET produccionSecundario = produccionSecundario*((_aumento/100)+1) WHERE idJugador=NEW.idJugador;
                WHEN 3 THEN
		    #NOTE: Possible UPDATE join
                    UPDATE jugadorInfoGeneral SET produccionEnergia = produccionEnergia+@aumentoProd WHERE idJugador=NEW.idJugador AND @aumentoProd := produccionEnergia*(_aumento/100);
                    UPDATE tipoRecursoUsuario SET cantidad=cantidad+@aumentoProd WHERE idTipoRecurso=3 AND idJugador=NEW.idJugador;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE recursosMejora;

    #Actualiza los atributos de las mejoras generales
    SET _fin=0;
    OPEN generalMejora;

    REPEAT
        FETCH generalMejora INTO _aumento, _tipoMejora;

        IF NOT _fin
        THEN
            CASE _tipoMejora
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET investigacionVelocidad = investigacionVelocidad + _aumento WHERE idJugador=NEW.idJugador;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET construccionVelocidad = construccionVelocidad + _aumento WHERE idJugador=NEW.idJugador;
                WHEN 3 THEN
                    UPDATE jugadorInfoUnidades SET invisible = true WHERE idJugador=NEW.idJugador;
                WHEN 4 THEN
                    UPDATE jugadorInfoUnidades SET atraviesaIris = true WHERE idJugador=NEW.idJugador;
                WHEN 5 THEN
                    UPDATE jugadorInfoGeneral SET limiteSoldados = CEIL( limiteSoldados * ((_aumento/100)+1) ) WHERE idJugador=NEW.idJugador;
                WHEN 6 THEN
		    SELECT r.nivelMinimoHiperpropulsion<=NEW.nivel INTO _nivelMinHiper
		    FROM raza r JOIN jugador j ON r.id=j.idRaza WHERE j.idUsuario=NEW.idJugador;

		    UPDATE jugadorInfoUnidades SET viajeIntergalactico=_nivelMinHiper WHERE idJugador=NEW.idJugador;
		WHEN 7 THEN
		    UPDATE jugadorInfoGeneral SET limiteMisiones = CEIL( limiteMisiones * ((_aumento/100)+1) ) WHERE idJugador=NEW.idJugador;
		WHEN 8 THEN
	            UPDATE jugadorInfoUnidades SET stargateIntergalactico = true WHERE idJugador=NEW.idJugador;
	    END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    #CLOSE generalMejora;
END
|

CREATE TRIGGER jugadorMejora_AU
AFTER UPDATE ON jugadorMejora
FOR EACH ROW BEGIN
    DECLARE _puntosTecnologicos SMALLINT UNSIGNED DEFAULT 0;
    DECLARE _aumento MEDIUMINT;
    DECLARE _tipoRecurso, _tipoUnidad TINYINT UNSIGNED;
    DECLARE _tipoMejora SMALLINT UNSIGNED;
    DECLARE _incremento SMALLINT UNSIGNED;
    DECLARE _fin BIT;
    DECLARE _nivelBajo TINYINT UNSIGNED;
    DECLARE _nivelAlto TINYINT UNSIGNED;
    DECLARE _nivelMinHiper TINYINT UNSIGNED;

    DECLARE unidadesMejora CURSOR FOR
                SELECT porcentaje, idTipoUnidad, idTipoMejora
                FROM mejoraTipoUnidadTipoMejora
                WHERE idMejora=NEW.idMejora;

    DECLARE recursosMejora CURSOR FOR
                SELECT porcentaje, idTipoRecurso
                FROM mejoraTipoRecurso
                WHERE idMejora=NEW.idMejora;

    DECLARE generalMejora CURSOR FOR
                SELECT porcentaje, idTipoMejora
                FROM mejoraTipoMejoraGeneral
                WHERE idMejora=NEW.idMejora;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    #Actualiza la puntuacion en los puntos sobre Tecnologias
    SELECT puntos INTO _puntosTecnologicos FROM mejoraNormal WHERE idMejora=NEW.idMejora;

    #Identifico el nivel mas bajo y el mas alto
    SET _nivelAlto=GREATEST(NEW.nivel, OLD.nivel);
    SET _nivelBajo=LEAST(NEW.nivel, OLD.nivel);

    #Calculo la diferencia de puntos
    #
    # B = puntuacion base
    # N = nivel alto
    # X = nivel Bajo
    #
    # B* (de x a n-1 -> SUM(i-1) + 10*(N-X))              (New.nivel-OLD.nivel)
    #------------------------------------------------ *  ------------------------
    #                 10                                         (N - X)
    #
    #La primera parte de la formula obtiene la diferencia entre el nivel actual y el siguiente,
    #mientras que la segunda parte de la formula descubre si ese valor debe ser positivo (NEW.nivel>OLD.nivel)
    #o negativo (OLD.nivel>NEW.nivel).
    #
    # El sumatorio se peude transformar y asi es como figura en la formula usada en el SQL
    #
    # El round se ha anyadido por que mysql no recoge todos los deimales en las consultas y fallaba el ranking cuando
    # se comparaban posiciones con decimales. Con el round evitamos eso, ya que siempre saldrá un entero.
    #
    SET _puntosTecnologicos=ROUND(((_puntosTecnologicos*(((_nivelAlto*(_nivelAlto-1))/2)+10*(_nivelAlto-_nivelBajo)))/10)*(((NEW.nivel+0.0)-(OLD.nivel+0.0))/(_nivelAlto-_nivelBajo)));

    UPDATE jugadorInfoPuntuaciones SET puntosTecnologias=puntosTecnologias+_puntosTecnologicos WHERE idJugador=NEW.idJugador;

    #Actualiza los porcentajes de mejoras que afectan a unidades
    SET _fin=0;
    OPEN unidadesMejora;

    REPEAT
        FETCH unidadesMejora INTO _aumento, _tipoUnidad, _tipoMejora;

        IF NOT _fin
        THEN

            SET _aumento = _aumento*((NEW.nivel+0.0) - (OLD.nivel+0.0));
            SET @aument = _aumento;

            CASE _tipoUnidad
            WHEN 1 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET navesCarga = navesCarga + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET navesAtaque = navesAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET navesResistencia = navesResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET navesEscudo = navesEscudo + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 5 THEN
                        UPDATE jugadorInfoUnidades SET navesVelocidad = navesVelocidad + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            WHEN 2 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET soldadosCarga = soldadosCarga + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET soldadosAtaque = soldadosAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET soldadosResistencia = soldadosResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET soldadosEscudo = soldadosEscudo + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            WHEN 3 THEN
                CASE _tipoMejora
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET defensasAtaque = defensasAtaque + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET defensasResistencia = defensasResistencia + _aumento WHERE idJugador=NEW.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET defensasEscudo = defensasEscudo + _aumento WHERE idJugador=NEW.idJugador;
                END CASE;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE unidadesMejora;

    #Actualiza las nuevas producciones de los recursos
    SET _fin=0;
    OPEN recursosMejora;

    REPEAT
        FETCH recursosMejora INTO _aumento, _tipoRecurso;

        IF NOT _fin
        THEN
            #Actualizamos el porcentaje de produccion dependiendo del tipo de recurso
            #El aumento viene calculado ya sea para subir y bajas >=1 niveles
            CASE _tipoRecurso
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET produccionPrimario = produccionPrimario*POW(((_aumento/100)+1), ((NEW.nivel+0.0) - (OLD.nivel+0.0))) WHERE idJugador=NEW.idJugador;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET produccionSecundario = produccionSecundario*POW(((_aumento/100)+1), ((NEW.nivel+0.0) - (OLD.nivel+0.0))) WHERE idJugador=NEW.idJugador;
                WHEN 3 THEN
                    UPDATE jugadorInfoGeneral SET produccionEnergia = produccionEnergia+@aumentoProd WHERE idJugador=NEW.idJugador AND @aumentoProd := produccionEnergia*POW(((_aumento/100)+1), ((NEW.nivel+0.0) - (OLD.nivel+0.0)))-produccionEnergia;
                    UPDATE tipoRecursoUsuario SET cantidad=cantidad+@aumentoProd WHERE idTipoRecurso=3 AND idJugador=NEW.idJugador;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE recursosMejora;

    #Actualiza los atributos de las mejoras generales
    SET _fin=0;
    OPEN generalMejora;

    REPEAT
        FETCH generalMejora INTO _aumento, _tipoMejora;

        IF NOT _fin
        THEN
            SET _incremento = _aumento*((NEW.nivel+0.0) - (OLD.nivel+0.0));
            CASE _tipoMejora
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET investigacionVelocidad = investigacionVelocidad + _incremento WHERE idJugador=NEW.idJugador;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET construccionVelocidad = construccionVelocidad + _incremento WHERE idJugador=NEW.idJugador;
                WHEN 3 THEN
                    UPDATE jugadorInfoUnidades SET invisible = true WHERE idJugador=NEW.idJugador;
                WHEN 4 THEN
                    UPDATE jugadorInfoUnidades SET atraviesaIris = true WHERE idJugador=NEW.idJugador;
				WHEN 5 THEN
                    UPDATE jugadorInfoGeneral SET limiteSoldados = CEIL( limiteSoldados*POW(((_aumento/100)+1), ((NEW.nivel+0.0) - (OLD.nivel+0.0))) ) WHERE idJugador=NEW.idJugador;
				WHEN 6 THEN
		            SELECT nivelMinimoHiperpropulsion<=NEW.nivel INTO _nivelMinHiper
		            FROM raza r JOIN jugador j ON r.id=j.idRaza WHERE j.idUsuario=NEW.idJugador;
		            UPDATE jugadorInfoUnidades SET viajeIntergalactico=_nivelMinHiper WHERE idJugador=NEW.idJugador;
		        WHEN 7 THEN
                    UPDATE jugadorInfoGeneral SET limiteMisiones = CEIL( limiteMisiones + ((limiteMisiones/(OLD.nivel+1))*(_incremento/100)) ) WHERE idJugador=NEW.idJugador;
            	WHEN 8 THEN
                    UPDATE jugadorInfoUnidades SET stargateIntergalactico = true WHERE idJugador=NEW.idJugador;
	    END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    #CLOSE generalMejora;
END
|

CREATE TRIGGER jugadorMejora_BD
BEFORE DELETE ON jugadorMejora
FOR EACH ROW BEGIN
    IF OLD.nivel!=1 THEN
        CALL ElNivelNoEsUno;
    END IF;
END;
|

CREATE TRIGGER jugadorMejora_AD
AFTER DELETE ON jugadorMejora
FOR EACH ROW BEGIN
    DECLARE _puntosTecnologicos SMALLINT UNSIGNED DEFAULT 0;
    DECLARE _aumento MEDIUMINT;
    DECLARE _tipoRecurso, _tipoUnidad TINYINT UNSIGNED;
    DECLARE _tipoMejora SMALLINT UNSIGNED;
    DECLARE _fin, _stargateInt BIT;

    DECLARE unidadesMejora CURSOR FOR
                SELECT porcentaje, idTipoUnidad, idTipoMejora
                FROM mejoraTipoUnidadTipoMejora
                WHERE idMejora=OLD.idMejora;

    DECLARE recursosMejora CURSOR FOR
                SELECT porcentaje, idTipoRecurso
                FROM mejoraTipoRecurso
                WHERE idMejora=OLD.idMejora;

    DECLARE generalMejora CURSOR FOR
                SELECT porcentaje, idTipoMejora
                FROM mejoraTipoMejoraGeneral
                WHERE idMejora=OLD.idMejora;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    #Actualiza la puntuacion en los puntos sobre Tecnologias
    SELECT puntos INTO _puntosTecnologicos FROM mejoraNormal WHERE idMejora=OLD.idMejora;

    UPDATE jugadorInfoPuntuaciones SET puntosTecnologias=puntosTecnologias-_puntosTecnologicos WHERE idJugador=OLD.idJugador;

    #Actualiza los porcentajes de mejoras que afectan a unidades
    SET _fin=0;
    OPEN unidadesMejora;

    REPEAT
        FETCH unidadesMejora INTO _aumento, _tipoUnidad, _tipoMejora;

        IF NOT _fin
        THEN

            SET _aumento = _aumento*-1;

            CASE _tipoUnidad
            WHEN 1 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET navesCarga = navesCarga + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET navesAtaque = navesAtaque + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET navesResistencia = navesResistencia + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET navesEscudo = navesEscudo + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 5 THEN
                        UPDATE jugadorInfoUnidades SET navesVelocidad = navesVelocidad + _aumento WHERE idJugador=OLD.idJugador;
                END CASE;
            WHEN 2 THEN
                CASE _tipoMejora
                    WHEN 1 THEN
                        UPDATE jugadorInfoUnidades SET soldadosCarga = soldadosCarga + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET soldadosAtaque = soldadosAtaque + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET soldadosResistencia = soldadosResistencia + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET soldadosEscudo = soldadosEscudo + _aumento WHERE idJugador=OLD.idJugador;
                END CASE;
            WHEN 3 THEN
                CASE _tipoMejora
                    WHEN 2 THEN
                        UPDATE jugadorInfoUnidades SET defensasAtaque = defensasAtaque + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 3 THEN
                        UPDATE jugadorInfoUnidades SET defensasResistencia = defensasResistencia + _aumento WHERE idJugador=OLD.idJugador;
                    WHEN 4 THEN
                        UPDATE jugadorInfoUnidades SET defensasEscudo = defensasEscudo + _aumento WHERE idJugador=OLD.idJugador;
                END CASE;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE unidadesMejora;

    #Actualiza las nuevas producciones de los recursos
    SET _fin=0;
    OPEN recursosMejora;

    REPEAT
        FETCH recursosMejora INTO _aumento, _tipoRecurso;

        IF NOT _fin
        THEN
            #Actualizamos el porcentaje de produccion, eliminando el porcentaje
            CASE _tipoRecurso
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET produccionPrimario = produccionPrimario/((_aumento/100)+1) WHERE idJugador=OLD.idJugador AND @pPri:=produccionPrimario AND @aum:=_aumento;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET produccionSecundario = produccionSecundario/((_aumento/100)+1) WHERE idJugador=OLD.idJugador;
                WHEN 3 THEN
                    UPDATE jugadorInfoGeneral SET produccionEnergia = produccionEnergia-@descuentoProd WHERE idJugador=OLD.idJugador AND @descuentoProd := produccionEnergia-(produccionEnergia/((_aumento/100)+1));
                    UPDATE tipoRecursoUsuario SET cantidad=cantidad-@descuentoProd WHERE idTipoRecurso=3 AND idJugador=OLD.idJugador;
            END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    CLOSE recursosMejora;

    #Actualiza los atributos de las mejoras generales
    SET _fin=0;
    OPEN generalMejora;

    REPEAT
        FETCH generalMejora INTO _aumento, _tipoMejora;

        IF NOT _fin
        THEN
            CASE _tipoMejora
                WHEN 1 THEN
                    UPDATE jugadorInfoGeneral SET investigacionVelocidad = investigacionVelocidad - _aumento WHERE idJugador=OLD.idJugador;
                WHEN 2 THEN
                    UPDATE jugadorInfoGeneral SET construccionVelocidad = construccionVelocidad - _aumento WHERE idJugador=OLD.idJugador;
                WHEN 3 THEN
                    UPDATE jugadorInfoUnidades SET invisible = false WHERE idJugador=OLD.idJugador;
                WHEN 4 THEN
                    UPDATE jugadorInfoUnidades SET atraviesaIris = false WHERE idJugador=OLD.idJugador;
				WHEN 5 THEN
				    UPDATE jugadorInfoGeneral SET limiteSoldados = FLOOR( limiteSoldados/((_aumento/100)+1) ) WHERE idJugador=OLD.idJugador;
				WHEN 6 THEN
				    UPDATE jugadorInfoUnidades SET viajeIntergalactico=0 WHERE idJugador=OLD.idJugador;
				WHEN 7 THEN
				    UPDATE jugadorInfoGeneral SET limiteMisiones = FLOOR( limiteMisiones/((_aumento/100)+1) ) WHERE idJugador=OLD.idJugador;
            	WHEN 8 THEN
				    SELECT stargateTropasIntergalactico INTO _stargateInt
				    FROM raza r JOIN jugador j ON r.id=j.idRaza WHERE j.idUsuario=OLD.idJugador;
				    UPDATE jugadorInfoUnidades SET stargateIntergalactico = _stargateInt WHERE idJugador=OLD.idJugador;
	    END CASE;
        END IF;
    UNTIL _fin END REPEAT;

    #CLOSE generalMejora;
END
|

CREATE TRIGGER jugadorMejoraInvestiga_AD
AFTER DELETE ON jugadorMejoraInvestiga
FOR EACH ROW BEGIN
    DECLARE _fin BIT;
    DECLARE _cantidadRecurso INT(16) UNSIGNED;
    DECLARE _tipoRecurso TINYINT UNSIGNED;
    DECLARE _nivelMejora TINYINT UNSIGNED;

    DECLARE consumeRecursosMejora CURSOR FOR
                SELECT rm.idtipoRecurso, rm.cantidad*POW(2, COALESCE(jm.nivel,0))
                FROM `recursoMejora` AS rm
                LEFT JOIN (SELECT idMejora, nivel FROM `jugadorMejora` WHERE idJugador=OLD.idJugador) AS jm
                USING(idMejora)
                WHERE rm.idMejora=OLD.idMejora;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

    IF OLD.tiempoFinal <= CURRENT_TIMESTAMP #Si el tiempo de investigacion a finalizado, aunmento el nivel de la mejora
    THEN
        #Comprueba el nivel actual de la investigacion del usuario
        SELECT nivel INTO _nivelMejora FROM jugadorMejora WHERE idMejora=OLD.idMejora AND idJugador=OLD.idJugador;

        IF _nivelMejora>=1
        THEN
            UPDATE jugadorMejora SET nivel=nivel+1 WHERE idMejora=OLD.idMejora AND idJugador=OLD.idJugador;
        ELSE
            INSERT INTO jugadorMejora (idMejora, idJugador) VALUES (OLD.idMejora, OLD.idJugador);
        END IF;

    ELSE     #Si la mejora es cancelada, devuelvo los recursos consumidos al jugador
        SET _fin=0;
        OPEN consumeRecursosMejora;

        REPEAT
            FETCH consumeRecursosMejora INTO _tipoRecurso, _cantidadRecurso;

            IF NOT _fin
            THEN
                UPDATE tipoRecursoUsuario SET cantidad=cantidad+cantidadProporcional(0.8, OLD.tiempoInicial, OLD.tiempoFinal, _cantidadRecurso) WHERE idTipoRecurso=_tipoRecurso AND idJugador=OLD.idJugador;
            END IF;
        UNTIL _fin END REPEAT;

        CLOSE consumeRecursosMejora;
    END IF;

    #Elimino el evento de la tabla
    DELETE FROM evento WHERE idJugador=OLD.idJugador AND tipo=1 AND id=OLD.idMejora;
END;
|

##INSERT jugadorMejoraInvestiga:
####
####Si el usuario tiene suficientes recursos, se le restan los recursos a su cuenta
####sino, no se realiza la consulta.
####
CREATE TRIGGER jugadorMejoraInvestiga_BI
BEFORE INSERT ON jugadorMejoraInvestiga
FOR EACH ROW
BEGIN
        DECLARE _fin BIT;
        DECLARE _tipoRecurso TINYINT UNSIGNED DEFAULT 1;
        DECLARE _cantidadRestar INT(16) UNSIGNED DEFAULT 0;
        DECLARE _nivelActual TINYINT UNSIGNED DEFAULT 0;
        DECLARE _tiempoFinal SMALLINT UNSIGNED;
        DECLARE _velocidad SMALLINT UNSIGNED;

        #Calcula los recursos a quitar del jugador al investigar la mejora (recursosUsuario#(costeMejora^nivel))
        DECLARE recursosDescontar CURSOR FOR
                SELECT rm.idtipoRecurso, rm.cantidad*POW(2, COALESCE(jm.nivel,0))
                FROM `recursoMejora` AS rm
                LEFT JOIN (SELECT idMejora, nivel FROM `jugadorMejora` WHERE idJugador=NEW.idJugador) AS jm
                USING(idMejora)
                WHERE rm.idMejora=NEW.idMejora;

        DECLARE CONTINUE HANDLER FOR NOT FOUND SET _fin = 1;#Cuando no se encuentran mas lineas se marcala variable fin

        #Comprueba que los recursos que le queden al usuario no sean negativos
        SET _fin=0;
        OPEN recursosDescontar;

        REPEAT
            FETCH recursosDescontar INTO _tipoRecurso,_cantidadRestar; #Captura la primera fila
                IF NOT _fin#Si se ha obtenido una fila, se pasa a procesarla
                THEN
                	UPDATE tipoRecursoUsuario SET cantidad=cantidad-_cantidadRestar WHERE idJugador=NEW.idJugador AND idTipoRecurso=_tipoRecurso;
                END IF;
        UNTIL _fin END REPEAT;
        CLOSE recursosDescontar;

        #Averigua el nivel actual de la mejora
        SELECT COALESCE(nivel,0) INTO _nivelActual
        FROM jugadorMejora
        WHERE idMejora=NEW.idMejora AND idJugador=NEW.idJugador;

        #Averigua cuanto tiempo cuesta en construirse la mejora en nivel 1
        SELECT tiempo INTO _tiempoFinal
        FROM mejoraNormal
        WHERE idMejora=NEW.idMejora;

        #Averigua la bonificacion que tenemos en construcciones
        SELECT investigacionVelocidad INTO _velocidad
        FROM jugadorInfoGeneral
        WHERE idJugador=NEW.idJugador;

        #Ponemos el tiempo de finalizacion de la mejora
        IF _nivelActual>25 THEN
        	SET _nivelActual=25;
        END IF;
        SET NEW.tiempoFinal = ADDDATE(NEW.tiempoInicial,INTERVAL ROUND(_tiempoFinal/((_velocidad/100)+1))*POW(1+(1/POW(_nivelActual+1,(1/4))), _nivelActual) SECOND); #Nueva formula

        #Anyado el evento a la lista
	    INSERT INTO evento (tipo, idJugador, id, tiempo)
	    VALUES (1, NEW.idJugador, NEW.idMejora, NEW.tiempoFinal);
END;
|

delimiter ;
