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
	foreach($datos AS $raza){
		//empieza una nueva unidad
		$texto = '{{Raza |';

		//Genero las claves valor para la unidad con respecto a sus datos
		$texto .= obtenerInfoText($raza);

		//Finalizo la unidad
		$texto = $texto . '}}';

		//almaceno la informacion de la unidad en el vector info
		$info[$raza['nombre']] = $texto;
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
 * INFORMACION DE RAZAS
 */
/********************* RAZAS *********************************/
$result = $mysql->query('
				SELECT r.id, r.nombre, r.nivelMinimoHiperpropulsion, r.stargateTropasIntergalactico, 
					r.maxPlanetas, r.limiteSoldados, r.limiteMisiones
				FROM raza AS r
		');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]= $row;
}

//SOLDADOS
$result = $mysql->query('
				SELECT idRaza AS id, id AS idUnidad, nombre
				FROM unidad
				WHERE idRaza IN ('.implode(', ', array_keys($datos)).')
				AND idTipoUnidad=2
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['tropa'][]=Array('id' => $row['idUnidad'],'nombre' => $row['nombre']);
}

//NAVES
$result = $mysql->query('
				SELECT idRaza AS id, id AS idUnidad, nombre
				FROM unidad
				WHERE idRaza IN ('.implode(', ', array_keys($datos)).')
				AND idTipoUnidad=1
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['nave'][]=Array('id' => $row['idUnidad'],'nombre' => $row['nombre']);
}

//DEFENSAS
$result = $mysql->query('
				SELECT idRaza AS id, id AS idUnidad, nombre
				FROM unidad
				WHERE idRaza IN ('.implode(', ', array_keys($datos)).')
				AND idTipoUnidad=3
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['defensa'][]=Array('id' => $row['idUnidad'],'nombre' => $row['nombre']);
}

//MEJORAS
$result = $mysql->query('
				SELECT n.idRaza AS id, m.nombre
				FROM mejora AS m JOIN mejoraNormal AS n ON m.id=n.idMejora
				WHERE n.idRaza IN ('.implode(', ', array_keys($datos)).')
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['mejora'][]=Array('nombre' => $row['nombre']);
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