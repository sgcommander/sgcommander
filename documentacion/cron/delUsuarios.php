#!/usr/bin/php
<?php
	define('TIEMPO_BORRADO_CUENTA', 30);
	define('TIEMPO_SIN_VALIDACION', 1);
	
	define('DB_HOST', 'sgcommander-db');
	define('DB_USER', 'sgcommander');
	define('DB_PASS', 'password');
	define('DB_NAME', 'dev');
	
	
	//Conexion a la base de datos
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Consulto los usuarios a eliminar
	$consulta = $db->query('
		SELECT j.idUsuario
			FROM usuario AS u JOIN jugador AS j ON (u.id=j.idUsuario) 
			JOIN jugadorInfoPuntuaciones AS jip ON (jip.idJugador=j.idUsuario)
			WHERE u.ultimoAcceso <= DATE_SUB(NOW(),INTERVAL '.TIEMPO_BORRADO_CUENTA.' DAY)
					OR (u.valido IS NOT NULL AND  u.fechaCreacion <= DATE_SUB(NOW(),INTERVAL '.TIEMPO_SIN_VALIDACION.' DAY));'
	);
	
	//Elimino todos los usuarios
	while(list($id) = $consulta->fetch_row()){
		borrar($id, $db);
	}
	
	//Esta funcion elimina de forma correcta un usuario
	function borrar($idJugador, $db)
	{
		//Obtengo el planeta principal del usuario
		$consulta = $db->query('
			SELECT idPlaneta, idGalaxia
			FROM planetaColonizado
			WHERE idJugador=\''.$idJugador.'\' AND principal
			LIMIT 1
		');
		    
		list($idPlaneta, $idGalaxia) = $consulta->fetch_row();
	
		//Eliminamos la cuenta del usuario
		$db->query('DELETE FROM usuario WHERE id=\''.$idJugador.'\'');
	
		//Cambiamos el porcentaje del planeta principal y eliminamos el nombre
		$porcentaje = Array(10,20,30,40,60,70,80,90,100);
		$db->query('
			UPDATE planeta
			SET nombrePlaneta=\'\', riqueza =\''.$porcentaje[rand(0,count($porcentaje)-1)].'\' 
			WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
		');
	
		//Actualizamos los planetas explorados
		$db->query('
			UPDATE planetaExplorado
			SET idPropietario=NULL 
			WHERE idPropietario=\''.$idJugador.'\'
		');
	
		// Elimino los posibles nombres de planeta de los planetas que tenia colonizados
		$consulta = $db->query('
			SELECT pc.idPlaneta, pc.idGalaxia
			FROM planetaColonizado AS pc LEFT JOIN planetaEspecial AS pe ON (pe.idGalaxia=pc.idGalaxia AND pe.idPlanetaEsp=pc.idPlaneta)
			WHERE idJugador=\''.$idJugador.'\' AND NOT principal AND pe.idGalaxia IS NULL
			LIMIT 1;
		');
		    
		while($row = $consulta->fetch_assoc()){
			//Actualizamos el nombre
			$db->query('
				UPDATE planeta
				SET nombrePlaneta=\'\' 
				WHERE idGalaxia=\''.$row['idGalaxia'].'\' AND idPlaneta=\''.$row['idPlaneta'].'\'
			');
		}
		
		//Elimino la imagen del usuario
		unlink('/var/www/web/images/firmas/jugador/'.$idJugador.'.jpg');
	
		return $db->errno==0;
}