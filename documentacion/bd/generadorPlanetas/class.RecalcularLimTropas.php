<?php
		define('CORRECTO',true);
		require_once('class.Excepcion.php');
		require_once('class.Mysql.php');
		//require_once('../../../constants.php');

		$mysql = Mysql::getInstancia();

		//Recorremos todos los usuarios
		$sql='SELECT idUsuario, idRaza FROM jugador';
		$result=$mysql->query($sql);
		if($mysql->numRows($result)>0){
			//Recorremos la lista
			while($row = $mysql->fetchAssoc($result)){
				//Calculamos los puntos de naves
				$result2=$mysql->query('SELECT limiteSoldados FROM  `raza`  WHERE id ='.$row['idRaza'].'');

				$row2 = $mysql->fetchAssoc($result2);
				$limiteBase=$row2['limiteSoldados'];
				$result3=$mysql->query('select j.nivel, g.porcentaje from mejoraTipoMejoraGeneral as g LEFT JOIN jugadorMejora as j on g.idMejora=j.idMejora
										where g.idTipoMejora=5 AND j.idJugador='.$row['idUsuario']);

				$row3 = $mysql->fetchAssoc($result3);
				$porcentaje=$row3['porcentaje'];
				for($i=0;$i<$row3['nivel'];$i++){
					$limiteBase=ceil($limiteBase*(($porcentaje/100)+1));
				}

				$mysql->query('UPDATE jugadorInfoGeneral SET limiteSoldados='.$limiteBase.' WHERE idJugador='.$row['idUsuario']);
				
				//Mostramos el resultado
				echo $row['idUsuario'].'---->'.$limiteBase.PHP_EOL;
			}
		}

?>
