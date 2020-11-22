<?php
	//Muestro el maximo de errores posible (NO APTO PARA PRODUCCION)
	error_reporting(E_ALL | E_STRICT);

	//Inicio de sesion
	session_start();
	
	//Cargamos la configuracion del juego
	include '../config.php';
	
	//Archivo de constantes
	include '../constants.php';
	
	//Arrancamos el controlador de registro
	include '../app/RegisterController.php';
	$app = new RegisterController();
	$app->main();
?>
