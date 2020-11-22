<?php
		define('CORRECTO',true);
		require_once('class.Excepcion.php');
		require_once('class.Mysql.php');
		//require_once('../../../constants.php');

		$mysql = Mysql::getInstancia();

		//Recorremos todos los usuarios
		$sql='SELECT idUsuario FROM jugador ORDER BY idUsuario';
		$result=$mysql->query($sql);
		if($mysql->numRows($result)>0){
			//Recorremos la lista
			while($row = $mysql->fetchAssoc($result)){
				//calculamos la energia gastada
				$result2=$mysql->query('select SUM(IFNULL(r.cantidad,0)*p.cantidad) AS gastada 
										from recursoUnidad as r join unidadJugadorPlaneta as p ON r.idUnidad=p.idUnidad AND r.idTipoRecurso=3 
										WHERE p.idJugador='.$row['idUsuario'].' and p.idUnidad not in(select idUnidad from especialUnidad)');

				$row2 = $mysql->fetchAssoc($result2);
				$cantidadGastada=$row2['gastada'];

				//calculamos la energia construyendo
				$result2=$mysql->query('select sum(u.cantidad*c.cantidad) as construir from recursoUnidad u join unidadConstruir c on u.idUnidad=c.idUnidad and idTipoRecurso=3 where c.idJugador='.$row['idUsuario']);

				$row2 = $mysql->fetchAssoc($result2);
				$cantidadConstruir=$row2['construir'];

				//Calculamos la energia total
				$result2=$mysql->query('select produccionEnergia AS total from jugadorInfoGeneral WHERE idJugador='.$row['idUsuario']);
				$row2 = $mysql->fetchAssoc($result2);
				$cantidadTotal=$row2['total'];

				//Actualizamos
				$mysql->query('UPDATE tipoRecursoUsuario SET cantidad='.($cantidadTotal-$cantidadGastada-$cantidadConstruir).' WHERE idTipoRecurso=3 AND idJugador='.$row['idUsuario']);

				//Mostramos el resultaod
				echo $row['idUsuario'].'---->'.$cantidadTotal.'-'.$cantidadGastada.'-'.$cantidadConstruir.'='.($cantidadTotal-$cantidadGastada-$cantidadConstruir).'</br>';
			}
		}

?>
