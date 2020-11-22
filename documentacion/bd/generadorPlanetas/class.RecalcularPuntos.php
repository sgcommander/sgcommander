<?php
		define('CORRECTO',true);
		require_once('class.Excepcion.php');
		require_once('class.Mysql.php');
		//require_once('../../../constants.php');

		$mysql = Mysql::getInstancia();

		//Recorremos todos los usuarios
		$sql='SELECT idUsuario FROM jugador';
		$result=$mysql->query($sql);
		if($mysql->numRows($result)>0){
			//Recorremos la lista
			while($row = $mysql->fetchAssoc($result)){
				//Mostramos el resultado
				echo '</br>'.$row['idUsuario'].'----></br>';
				//Calculamos los puntos de naves
				$result2=$mysql->query('select IFNULL(sum(u.puntos*p.cantidad),0) as puntosNaves from unidadJugadorPlaneta as p
										join unidad as u on p.idUnidad=u.id and idtipoUnidad=1
										where p.idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosNaves=$row2['puntosNaves'];

				$result2=$mysql->query('select puntosNaves from jugadorInfoPuntuaciones 
										where idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosNavesTotal=$row2['puntosNaves'];

				$malNaves=$puntosNaves>$puntosNavesTotal;

				if($malNaves){
					//Actualizamos
					$mysql->query('UPDATE jugadorInfoPuntuaciones SET puntosNaves='.$puntosNaves.' WHERE idJugador='.$row['idUsuario']);
					echo '          Naves: Corregido</br>';
				}
				//Calculamos los puntos de tropas
				$result2=$mysql->query('select IFNULL(sum(u.puntos*p.cantidad),0) as puntosTropas from unidadJugadorPlaneta as p
										join unidad as u on p.idUnidad=u.id and idtipoUnidad=2
										where p.idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosTropas=$row2['puntosTropas'];

				$result2=$mysql->query('select puntosSoldados from jugadorInfoPuntuaciones 
										where idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosTropasTotal=$row2['puntosSoldados'];

				$malTropas=$puntosTropas>$puntosTropasTotal;

				if($malTropas){
					//Actualizamos
					$mysql->query('UPDATE jugadorInfoPuntuaciones SET puntosSoldados='.$puntosTropas.' WHERE idJugador='.$row['idUsuario']);
					echo '          Tropas: Corregido</br>';
				}

				//Calculamos los puntos de defensas
				$result2=$mysql->query('select IFNULL(sum(u.puntos*p.cantidad),0) as puntosDefensas from unidadJugadorPlaneta as p
										join unidad as u on p.idUnidad=u.id and idtipoUnidad=3
										where p.idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosDefensas=$row2['puntosDefensas'];

				$result2=$mysql->query('select puntosDefensas from jugadorInfoPuntuaciones 
										where idJugador='.$row['idUsuario'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$puntosDefensasTotal=$row2['puntosDefensas'];

				$malDefensas=$puntosDefensas>$puntosDefensasTotal;

				if($malDefensas){
					//Actualizamos
					$mysql->query('UPDATE jugadorInfoPuntuaciones SET puntosDefensas='.$puntosDefensas.' WHERE idJugador='.$row['idUsuario']);
					echo '          Defensas: Corregido</br>';
				}

			}
		}

?>
