<?php

define('CORRECTO',true);

require '../../bd/generadorPlanetas/class.Excepcion.php';
require '../../bd/generadorPlanetas/class.Mysql.php';

$mysql = Mysql::getInstancia();

/**
 * FUNCIONES
 */
//Crea los textos para todas las unidades
function crearTexto($datos){
	//No tengo informacion nueva
	$info = Array();

	//Obtengo toda la informacion de todas las unidades
	foreach($datos AS $unidad){
		//empieza una nueva unidad
		$texto = '{{Unidad |';

		//Genero las claves valor para la unidad con respecto a sus datos
		$texto .= obtenerInfoText($unidad);

		//Finalizo la unidad
		$texto = $texto . '}}';

		//almaceno la informacion de la unidad en el vector info
		$info[$unidad['nombre']] = $texto;
	}

	return $info;
}

//Paso el vector de datos a un texto con informacion
function obtenerInfoText($info, $prefijo=''){
	//Al inicio no existe texto
	$texto = '';

	foreach($info AS $clave => $valor){
		//Si es la primera vez que acceso, no interpongo el caracter |
		if($texto!=''){
			$texto .=' | ';
		}

		//Si el valor obtenido es un vector, llamo recursivamente, agregando el prefijo necesario
		if(is_array($valor)){
			$texto .= obtenerInfoText($valor, $prefijo.$clave);
		}
		//si el valor no es un vector obtengo la clave como el prefijo + clave y asigno su valor
		else{
			if($clave == 'costetiempo'){
				$sec = $valor % 60;
				$minutos = floor($valor / 60);

				if($minutos == 0){
					$valor = $sec.' segundos';
				}
				elseif($sec == 0){
					$valor = $minutos.' minutos';
				}
				elseif($minutos!=0 && $sec!=0){
					$valor = $minutos.' minutos '.$sec.' segundos';
				}
				else{
					$valor = 'Inmediato';
				}
			}
			$texto .= $prefijo.$clave.'='.$valor;
		}
	}

	//Devuelvo el texto con todas las clave = valor del vector
	return $texto;
}

//Permite editar la informacion de la wiki segun un titulo, su contenido y la seccion
function editar($titulo, $contenido, $seccion, $token='+\\'){
	$post = Array(
				'title' => utf8_encode(strtr($titulo, Array(' ' => '_'))),
				'section' => $seccion,
				'text' => utf8_encode($contenido),
				'token' => $token,
				'summary' => utf8_encode($titulo),
				'notminor' => '1',
				'bot' => '1'
			);

	return llamar('http://wiki.sgcommander.net/api.php?action=edit', $post);
}

//Realiza llamadas a una url pudiendo pasar parametros post
function llamar($url, $post=null){
	$ch = curl_init($url);
	$encoded = '';

	//Si se quieren enviar datos por post, generamos la cadena concreta y colocamos las opciones correspondientes
	if($post != null){
		//Codificamos las variables a enviar
		foreach($post as $name => $value) {
		  $encoded .= urlencode($name).'='.urlencode($value).'&';
		}

		//Eliminamos el ultimo ampersand
		$encoded = substr($encoded, 0, mb_strlen($encoded, 'UTF-8')-1);

		//Decimos que la peticion es de tipo post
		curl_setopt($ch, CURLOPT_POST, 1);
	}

	//Indicamos los campos a enviar
	curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
	//La cabecera
	curl_setopt($ch, CURLOPT_HEADER, 0);

	//Ejecutamos la peticion
	$result = curl_exec($ch);
	//Cerramos la conexion
	curl_close($ch);

	//Devolvemos el resultado
	return $result;
}

/**
 * INFORMACION DE UNIDADES
 */
/********************* NAVES *********************************/
$result = $mysql->query('
				SELECT u.id, tu.nombre AS categoria, 
					u.nombre, u.descripcion, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo,
					u.tiempo AS costetiempo,
					r.id AS idraza, r.nombre AS raza,
					tn.nombre AS subcategoria,
					n.carga, n.stargate, n.velocidad, n.cazas, n.hiperespacio
				FROM unidad AS u LEFT JOIN raza AS r ON(u.idRaza = r.id)
					JOIN tipoUnidad AS tu ON (u.idTipoUnidad = tu.id)
					JOIN nave AS n ON (n.idUnidad = u.id)
					JOIN tipoNave AS tn ON (tn.idTipoNave = n.idTipoNave)
				WHERE tu.nombre=\'Nave\' AND u.idRaza IS NOT NULL
		');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]= $row;
}

/********************* SOLDADOS *********************************/
$result = $mysql->query('
				SELECT u.id, tu.nombre AS categoria, 
					u.nombre, u.descripcion, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo,
					u.tiempo AS costetiempo,
					r.id AS idraza, r.nombre AS raza,
					ts.nombre AS subcategoria,
					s.carga
				FROM unidad AS u LEFT JOIN raza AS r ON(u.idRaza = r.id)
					JOIN tipoUnidad AS tu ON (u.idTipoUnidad = tu.id)
					JOIN soldado AS s ON (s.idUnidad = u.id)
					JOIN tipoSoldado AS ts ON (ts.idTipoSoldado = s.idTipoSoldado)
				WHERE tu.nombre=\'Soldado\' AND u.idRaza IS NOT NULL
		');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]= $row;
}

/********************* DEFENSAS *********************************/
$result = $mysql->query('
				SELECT u.id, tu.nombre AS categoria, 
					u.nombre, u.descripcion, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo,
					u.tiempo AS costetiempo,
					r.id AS idraza, r.nombre AS raza,
					td.nombre AS subcategoria,
					d.autodestruye, d.tiempoMover
				FROM unidad AS u LEFT JOIN raza AS r ON(u.idRaza = r.id)
					JOIN tipoUnidad AS tu ON (u.idTipoUnidad = tu.id)
					JOIN defensa AS d ON (d.idUnidad = u.id)
					JOIN tipoDefensa AS td ON (td.idTipoDefensa = d.idTipoDefensa)
				WHERE tu.nombre=\'Defensa\' AND u.idRaza IS NOT NULL
		');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]= $row;
}

//Obtengo los recursos que consume la unidad y su nombre
$result = $mysql->query('
				SELECT DISTINCT u.id, ru.cantidad , rr.idTipoRecurso, rr.nombre
				FROM recursoUnidad AS ru JOIN unidad AS u ON (ru.idUnidad = u.id)
					   JOIN recursoRaza AS rr ON (rr.idRaza = u.idRaza AND rr.idTipoRecurso = ru.idTipoRecurso)
				WHERE u.id IN ('.implode(', ', array_keys($datos)).')
');

//Vuelco los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['recurso'][$row['idTipoRecurso']]=Array('nombre' => $row['nombre'], 'cantidad' => $row['cantidad']);
}

//Obtengo las mejoras que requiere la unidad
$result = $mysql->query('
				SELECT um.idUnidad AS id, m.nombre, um.nivel
				FROM unidadMejora AS um JOIN mejora AS m ON (um.idMejora = m.id)
				WHERE um.idUnidad IN ('.implode(', ', array_keys($datos)).')
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['requisito'][]=Array('nombre' => $row['nombre'], 'nivel' => $row['nivel']);
}

//Obtengo las mejoras de heroe para unidades
$result = $mysql->query('
				SELECT u.idUnidadHeroe AS id, tm.nombre AS mejora, tu.nombre AS unidad, m.porcentaje
				FROM unidadHeroeMejora AS u
				JOIN mejoraTipoUnidadTipoMejora AS m ON m.idMejora=u.idMejora
				JOIN tipoUnidad AS tu ON tu.id=m.idTipoUnidad
				JOIN tipoMejora AS tm ON (m.idTipoMejora = tm.id)
				WHERE u.idUnidadHeroe IN ('.implode(', ', array_keys($datos)).')
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['mejoraUnidad'][]=Array('nombre' => $row['mejora'].' '.$row['unidad'], 'porcentaje' => $row['porcentaje']);
}

//Obtengo las mejoras de heroe generales
$result = $mysql->query('
				SELECT u.idUnidadHeroe AS id, tm.nombre AS nombre, m.porcentaje AS porcentaje
				FROM unidadHeroeMejora AS u
				JOIN mejoraTipoMejoraGeneral AS m ON m.idMejora=u.idMejora
				JOIN tipoMejoraGeneral AS tm ON (m.idTipoMejora = tm.id)
				WHERE u.idUnidadHeroe IN ('.implode(', ', array_keys($datos)).')
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['mejoraGeneral'][]=Array('nombre' => $row['nombre'], 'porcentaje' => $row['porcentaje']);
}

//Obtengo el fuego rapido soldados
$result = $mysql->query('
				(SELECT u.id, CONCAT("Soldado ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN soldado AS s ON u.id=s.idUnidad 
				JOIN fuegoSoldadoSoldado AS f ON f.idAtaca=s.idTipoSoldado
				JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT u.id, CONCAT("Nave ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN soldado AS s ON u.id=s.idUnidad 
				JOIN fuegoSoldadoNave AS f ON f.idAtaca=s.idTipoSoldado
				JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT u.id, CONCAT("Defensa ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN soldado AS s ON u.id=s.idUnidad 
				JOIN fuegoSoldadoDefensa AS f ON f.idAtaca=s.idTipoSoldado
				JOIN tipoDefensa AS t ON t.idTipoDefensa=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['fuegoRapidoSoldado'][]=Array('nombre' => $row['nombre'], 'disparos' => $row['disparos']);
}

//Obtengo el fuego rapido naves
$result = $mysql->query('
				(SELECT u.id, CONCAT("Soldado ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN nave AS s ON u.id=s.idUnidad 
				JOIN fuegoNaveSoldado AS f ON f.idAtaca=s.idTipoNave
				JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT u.id, CONCAT("Nave ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN nave AS s ON u.id=s.idUnidad 
				JOIN fuegoNaveNave AS f ON f.idAtaca=s.idTipoNave
				JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT u.id, CONCAT("Defensa ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN nave AS s ON u.id=s.idUnidad 
				JOIN fuegoNaveDefensa AS f ON f.idAtaca=s.idTipoNave
				JOIN tipoDefensa AS t ON t.idTipoDefensa=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['fuegoRapidoNave'][]=Array('nombre' => $row['nombre'], 'disparos' => $row['disparos']);
}

//Obtengo el fuego rapido defensas
$result = $mysql->query('
				(SELECT u.id, CONCAT("Soldado ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN defensa AS s ON u.id=s.idUnidad 
				JOIN fuegoDefensaSoldado AS f ON f.idAtaca=s.idTipoDefensa
				JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT u.id, CONCAT("Nave ",t.nombre) AS nombre, porcentaje/100 AS disparos
				FROM unidad AS u JOIN defensa AS s ON u.id=s.idUnidad 
				JOIN fuegoDefensaNave AS f ON f.idAtaca=s.idTipoDefensa
				JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende
				WHERE u.id IN ('.implode(', ', array_keys($datos)).'))
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['fuegoRapidoDefensa'][]=Array('nombre' => $row['nombre'], 'disparos' => $row['disparos']);
}


/**
 * GENERANDO LA INFORMACION E INSERTANDOLA EN LA WIKI
 */
//Creo los textos para insertar en la wiki
$plantillas = crearTexto($datos);

//Introduzco toda la informacion de unidades en la wiki
foreach($plantillas AS $nombreUnidad => $info){
	editar($nombreUnidad, $info, 0);
}

//Muestro cuantas paginas se han actualizado/creado
echo 'Insertadas/Modificadas un total de '.count($plantillas).' p&aacute;ginas';
?>