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
				//calculamos las tropas gastada
				$result2=$mysql->query('select sum(p.cantidad) as gastada from unidadJugadorPlaneta as p
join unidad as u on p.idUnidad=u.id and idtipoUnidad=2
where p.idJugador='.$row['idUsuario'].' and u.id not in(select idUnidad from especialUnidad)');

				$row2 = $mysql->fetchAssoc($result2);
				$cantidadGastada=$row2['gastada'];

				//calculamos las tropas construyendo
				$result2=$mysql->query('select sum(c.cantidad) as construir from unidadConstruir as c
join unidad as u on c.idUnidad=u.id and idtipoUnidad=2
where c.idJugador='.$row['idUsuario']);

				$row2 = $mysql->fetchAssoc($result2);
				$cantidadConstruir=$row2['construir'];

				//Actualizamos
				$mysql->query('UPDATE jugadorInfoGeneral SET numSoldados='.($cantidadGastada+$cantidadConstruir).' WHERE idJugador='.$row['idUsuario']);

				//Mostramos el resultaod
				echo $row['idUsuario'].' Total de tropas---->'.($cantidadGastada+$cantidadConstruir).'</br>';
			}
		}

?>
