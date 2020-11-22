#!/usr/bin/php
<?php
	define('DB_HOST', 'sgcommander-db');
	define('DB_USER', 'sgcommander');
	define('DB_PASS', 'password');
	define('DB_NAME', 'dev');
	
	
	//Conexion a la base de datos
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Consulto los usuarios a eliminar
	$consulta = $db->query('
		DELETE 
		FROM mensaje 
		WHERE UNIX_TIMESTAMP(fecha) < UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL -7 DAY))
	');
?>