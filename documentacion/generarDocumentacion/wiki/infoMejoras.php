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
	foreach($datos AS $mejora){
		//empieza una nueva unidad
		$texto = '{{Mejora |';

		//Genero las claves valor para la unidad con respecto a sus datos
		$texto .= obtenerInfoText($mejora);

		//Finalizo la unidad
		$texto = $texto . '}}';

		//almaceno la informacion de la unidad en el vector info
		$info[$mejora['nombre']] = $texto;
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
				SELECT m.id, g.nombre AS categoria, 
					m.nombre, n.descripcion,
					n.tiempo AS costetiempo,
					r.id AS idraza, r.nombre AS raza
				FROM mejora AS m JOIN mejoraNormal n ON m.id=n.idMejora
					LEFT JOIN raza AS r ON n.idRaza = r.id
					JOIN grupoMejora AS g ON g.id=n.idGrupo
		');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]= $row;
}

//Obtengo los recursos que consume la mejora y su nombre
$result = $mysql->query('
				SELECT DISTINCT u.idMejora AS id, ru.cantidad , rr.idTipoRecurso, rr.nombre
				FROM recursoMejora AS ru JOIN mejoraNormal AS u ON (ru.idMejora = u.idMejora)
				JOIN recursoRaza AS rr ON (rr.idRaza = u.idRaza AND rr.idTipoRecurso = ru.idTipoRecurso)
				WHERE u.idMejora IN ('.implode(', ', array_keys($datos)).') AND ru.cantidad!=0
');

//Vuelco los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['recurso'][$row['idTipoRecurso']]=Array('nombre' => $row['nombre'], 'cantidad' => $row['cantidad']);
}

//Obtengo las mejoras de recursos y unidades que da la mejora
$result = $mysql->query('
				(SELECT m.idMejora AS id, r.nombre, m.porcentaje
				FROM mejoraTipoRecurso AS m
				JOIN mejoraNormal AS n ON m.idMejora=n.idMejora
				JOIN recursoRaza AS r ON r.idTipoRecurso=m.idTipoRecurso AND r.idRaza=n.idRaza
				WHERE m.idMejora IN ('.implode(', ', array_keys($datos)).'))
				UNION
				(SELECT m.idMejora AS id, CONCAT(CONCAT(t.nombre," "),u.nombre) AS nombre, m.porcentaje
				FROM mejoraTipoUnidadTipoMejora AS m
				JOIN tipoMejora AS t ON m.idTipoMejora=t.id
				JOIN tipoUnidad AS u ON m.idTipoUnidad=u.id
				WHERE m.idMejora IN ('.implode(', ', array_keys($datos)).'))
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['bonificador'][]=Array('nombre' => $row['nombre'], 'porcentaje' => $row['porcentaje']);
}

//Obtengo las mejoras generales que da la mejora
$result = $mysql->query('
				SELECT m.idMejora AS id, IF(m.idTipoMejora=5,CONCAT(CONCAT(CONCAT("+",r.limiteSoldados)," "),t.nombre),IF(m.idTipoMejora=6,CONCAT(CONCAT(t.nombre," a nivel "),r.nivelMinimoHiperpropulsion),CONCAT(CONCAT(CONCAT("+",r.limiteMisiones)," "),t.nombre))) AS nombre
				FROM mejoraTipoMejoraGeneral AS m
				JOIN mejoraNormal AS n ON m.idMejora=n.idMejora
				JOIN tipoMejoraGeneral AS t ON m.idTipoMejora=t.id
				JOIN raza AS r ON r.id=n.idRaza
				WHERE m.idMejora IN ('.implode(', ', array_keys($datos)).')
			');

//Vuelco todos los datos
while($row = $mysql->fetchAssoc($result)){
	$datos[$row['id']]['bonificadorGeneral'][]=Array('nombre' => $row['nombre']);
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