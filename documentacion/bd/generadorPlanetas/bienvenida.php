<?php
	set_time_limit(6000);

	define('CORRECTO',true);
	require_once('class.Excepcion.php');
	require_once('class.Mysql.php');

	$mysql = Mysql::getInstancia();

	//Mensaje de bienvenida para todos los usuarios
	$mysql->query("INSERT INTO dev.mensaje (idJugador, idTipoMensaje, nombreUsuario, asunto, fecha, contenido)
						VALUES (2, 1, 'damarte', '03/03/2011 - Nuevas mejoras', NOW(), 
'
Nuevas cosas:
 - Ahora al conquistar se produce una batalla al final de la conquista (PROBAR)
 - Arreglada plantilla replicantes
 - Arreglado bug de la tabla naranja de SoldadoModel->crear
 - Eliminadas todas las apariciones de Sin Alianza
 - Arreglados especiales y unidades de planetas
 - Actualizada traduccion al ingles.
 - Arreglos diversos de estilos.

Saludos.


damarte
');
						");

	$mysql->query("INSERT INTO dev.recibeMensaje (idMensaje, idJugador, nombreUsuario)
						SELECT 1, id, nombre FROM usuario;");