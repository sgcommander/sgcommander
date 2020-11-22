<?php
	define('CORRECTO',true);
	require_once('class.Excepcion.php');
	require_once('class.Mysql.php');
	$mysql = Mysql::getInstancia();
	
	//Bajamos los tiempos
	$mysql->query("UPDATE unidad SET tiempo=tiempo/10");
	$mysql->query("UPDATE mejoraNormal SET tiempo=tiempo/10");
	$mysql->query("UPDATE tipoMision SET tiempo=tiempo/10");
	$mysql->query("UPDATE tipoMision SET tiempo=60 WHERE id=7");
	$mysql->query("UPDATE especial SET tiempoRecarga=tiempoRecarga/10, tiempoDuracion=tiempoDuracion/10");

	//Consulta
	/*$sql='SELECT idUsuario, idRaza FROM jugador ORDER BY idUsuario';

	// Ejecutamos la consulta que nos devuelve los jugadores.
	$result=$mysql->query($sql);

	// Comprobamos que hay algun jugador
	if($mysql->numRows($result)>0){

		// Recorremos todos los jugadores
		while($row = $mysql->fetchAssoc($result)){
			// Capturamos el idUsuario y el idRaza de cada jugador
			$usuario=$row['idUsuario'];
			$raza=$row['idRaza'];
			
			//Cambiamos la pass
			$mysql->query("UPDATE usuario SET pass='b28da40fb13920fcac612972ab298fe30686128aca722472d3b1cdfcf635a095' WHERE id='" . $usuario . "'");
			

			// Le ponemos los recusos altos a ese jugador. Cantidad 10 millones a los recursos primario y secundario.
			$mysql->query("UPDATE tipoRecursoUsuario SET cantidad=100000 WHERE idJugador='" . $usuario . "' AND (idTipoRecurso=1 OR idTipoRecurso=2)");

			// Cogemos las mejoras de la raza del usuario
			$sqlRaza="SELECT idMejora FROM mejoraNormal WHERE idRaza='" . $raza . "'";
			$resultRaza=$mysql->query($sqlRaza);

			// Comprobamos que la consulta se ha ejecutado con exito
			if($mysql->numRows($resultRaza)>0){
				// Recorremos todas las mejoras de la raza que tiene ese jugador
				while($rowRaza = $mysql->fetchAssoc($resultRaza)){
					$mejora=$rowRaza['idMejora'];

					// Insertamos las mejoras de la raza del usuario con nivel 1
					$mysql->query("INSERT INTO jugadorMejora(idMejora, idJugador, nivel) VALUES ('" . $mejora . "', '" . $usuario . "' , 1)");

					// Le ponemos nivel a la mejora del usuario, en nuestro caso nivel 10.
					$mysql->query("UPDATE jugadorMejora SET nivel=21 WHERE idMejora='" . $mejora . "' AND idJugador='" . $usuario . "'");
				}
			}

			// Miramos cual es el planeta principal del usuario
			$sqlPlaneta="SELECT idPlaneta, idGalaxia FROM planetaColonizado WHERE idJugador='" . $usuario . "' AND principal=1";
			$resultPlaneta=$mysql->query($sqlPlaneta);

			// Comprobamos que la consulta se ha ejecutado con exito
			if($mysql->numRows($resultPlaneta)>0){
				// Capturamos los valores de la consulta
				$rowPlaneta = $mysql->fetchAssoc($resultPlaneta);

				$planeta=$rowPlaneta['idPlaneta'];
				$galaxia=$rowPlaneta['idGalaxia'];
				
				//Guardamos el planeta de despliegue
				if($usuario==15){
					$planetaDespliegue=$rowPlaneta['idPlaneta'];
					$galaxiaDespliegue=$rowPlaneta['idGalaxia'];
				}
				elseif($usuario==26){
					//Insertamos el planeta como explorado
					$mysql->query('INSERT IGNORE INTO planetaExplorado (idPlaneta, idGalaxia, idJugador, visible)
        			VALUES('.$planetaDespliegue.', '.$galaxiaDespliegue.', '.$usuario.', 1);');
					
					//Insertamos la mision de tropas
			    	$mysql->query('INSERT INTO mision (idJugador,idTipoMision,idGalaxiaOrigen,idGalaxiaDestino,
						idPlanetaOrigen,idPlanetaDestino, fechaSalida, tiempoTrayecto)
						VALUES (\''.$usuario.'\', 1, \''.$galaxia.'\', \''.$galaxiaDespliegue.'\', \''.$planeta.'\', \''.$planetaDespliegue.'\', FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].'-60),60)');

					$misionSoldados=$mysql->lastID();
					
					//Insertamos la mision de naves
			    	$mysql->query('INSERT INTO mision (idJugador,idTipoMision,idGalaxiaOrigen,idGalaxiaDestino,
						idPlanetaOrigen,idPlanetaDestino, fechaSalida, tiempoTrayecto)
						VALUES (\''.$usuario.'\', 2, \''.$galaxia.'\', \''.$galaxiaDespliegue.'\', \''.$planeta.'\', \''.$planetaDespliegue.'\', FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].'-60),60)');

					$misionNaves=$mysql->lastID();
				}

				// Cogemos todas las unidades de la raza
				$sqlUnidades="SELECT id, idTipoDefensa, idTipoUnidad FROM unidad AS u LEFT JOIN defensa AS d ON d.idUnidad=u.id WHERE idRaza='" . $raza . "' AND (idTipoUnidad=1 OR idTipoUnidad=2 OR idTipoUnidad=3) AND id NOT IN (SELECT idUnidad FROM unidadHeroe)";
				$resutlUnidades=$mysql->query($sqlUnidades);

				// Comprobamos que la consulta se ha ejecutado con exito
				if($mysql->numRows($resutlUnidades)>0){

					// Recorremos todas las unidades
					while($rowUnidades = $mysql->fetchAssoc($resutlUnidades)){
						$unidad=$rowUnidades['id'];
						if($rowUnidades['idTipoDefensa']==1)
							$cantidad=1;
						else
							$cantidad=50;
						// Insertamos unidades de ese tipo a ese usuario en su planeta principal
						$mysql->query("INSERT INTO unidadJugadorPlaneta(idUnidad,idPlaneta,idGalaxia,idJugador,cantidad,cantidadEnMision,contable) VALUES ('" . $unidad . "', '" . $planeta . "', '" . $galaxia . "', '" . $usuario . "', '" . $cantidad . "', 0,1)");
						
						//Metemos als undiades en la mision
						/*if($usuario>26){
							switch($rowUnidades['idTipoUnidad']){
								case 1:
									//Insertamos unidades de las misiones
									$mysql->query('INSERT INTO unidadJugadorPlanetaMision (idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadEnviada) VALUES
													(\''.$misionNaves.'\',\''.$unidad.'\',\''.$usuario.'\',\''.$galaxia.'\',\''.$planeta.'\',50)');
									break;
								case 2:
									//Insertamos unidades de las misiones
									$mysql->query('INSERT INTO unidadJugadorPlanetaMision (idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadEnviada) VALUES
													(\''.$misionSoldados.'\',\''.$unidad.'\',\''.$usuario.'\',\''.$galaxia.'\',\''.$planeta.'\',50)');
									break;
							}
						}
					}
				}

				if($usuario==15){
					$mysql->query("INSERT INTO unidadJugadorPlaneta(idUnidad,idPlaneta,idGalaxia,idJugador,cantidad,cantidadEnMision,contable) VALUES ('196', '" . $planeta . "', '" . $galaxia . "', '" . $usuario . "', '5000', 0,1)");
					$mysql->query("INSERT INTO unidadJugadorPlaneta(idUnidad,idPlaneta,idGalaxia,idJugador,cantidad,cantidadEnMision,contable) VALUES ('198', '" . $planeta . "', '" . $galaxia . "', '" . $usuario . "', '273', 0,1)");
				}
				elseif($usuario==26){
					$mysql->query("INSERT INTO unidadJugadorPlaneta(idUnidad,idPlaneta,idGalaxia,idJugador,cantidad,cantidadEnMision,contable) VALUES ('198', '" . $planeta . "', '" . $galaxia . "', '" . $usuario . "', '687', 0,1)");
					
					//Insertamos unidades de las misiones
					$mysql->query('INSERT INTO unidadJugadorPlanetaMision (idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadEnviada) VALUES
									(\''.$misionSoldados.'\',\'198\',\''.$usuario.'\',\''.$galaxia.'\',\''.$planeta.'\',687)');
				}
			}
		}
	}*/

?>