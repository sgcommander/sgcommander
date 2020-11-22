<?php

	//Esta funcion devuelve el listado de ficheros js que hay dentro de un directorio (RECURSIVO)
	function listar($dir){
		$directorio=opendir($dir); 
		$listado = Array();

		while ($archivo = readdir($directorio)) {
		$ext = end(explode(".", $archivo));
		  if(is_dir($dir.'/'.$archivo) and $archivo[0]!='.')
		    array_merge($listado, listar($dir.'/'.$archivo)); 
		  elseif ($ext == 'js'){
		  	array_push($listado, $dir.'/'.$archivo); 
		  }
		} 
		closedir($directorio);

		return $listado;
	}

	//Recojo todos los ficheros js de la carpeta js
	$archivosJS = listar('../../../js');

	//Comprimo todos los archivos
	foreach($archivosJS as $direccion){
		//Hacemos la peticion a google
		$script = file_get_contents('http://dev.sgcommander.com/documentacion/Scripts/compactar/'.$direccion);
		$ch = curl_init('http://closure-compiler.appspot.com/compile');
		 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'output_info=compiled_code&output_format=text&compilation_level=SIMPLE_OPTIMIZATIONS&js_code=' . urlencode($script));

		//Obtenemos el resultado de la compresi�n
		$output = curl_exec($ch);

		//Cerramos la conexion
		curl_close($ch);

		//Vamos a escribir el js comprimido
		$fp = fopen($direccion, 'w');
		fwrite($fp, $output);
		fclose($fp);
	}
?>