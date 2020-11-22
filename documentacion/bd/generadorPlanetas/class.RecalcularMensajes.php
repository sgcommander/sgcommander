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
				//calculamos los mensajes no leidos
				$result2=$mysql->query('select count(*) as mensajes from recibeMensaje where leido=0 and idJugador='.$row['idUsuario']);

				$row2 = $mysql->fetchAssoc($result2);
				$mensajes=$row2['mensajes'];

				//Actualizamos
				$mysql->query('UPDATE jugadorInfoGeneral SET numeroMensajes='.$mensajes.' WHERE idJugador='.$row['idUsuario']);

				//Mostramos el resultaod
				echo $row['idUsuario'].' Mensajes sin leer ---->'.$mensajes.'</br>';
			}
		}

?>
