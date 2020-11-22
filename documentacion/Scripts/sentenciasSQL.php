<?php
	#Extraer todas las consultas sql del proyecto
	function buscarArchivos($ruta, $ext){
		//Vector de archivos
		$archivo=Array();

		// abrir un directorio y listarlo recursivo
		if (is_dir($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
					#muestra el contenido
					$ext=explode('.', $file);
					if($ext[count($ext)-1]=='php'){
						$archivo[]=Array($ruta . $file, $file);
						//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
					}

					if (is_dir($ruta . $file) && $file!="." && $file!=".." && $file!=".svn"){
						//solo si el archivo es un directorio, distinto que "." y ".."
						//echo "<br>Directorio: $ruta$file";
						$archivo=array_merge($archivo, buscarArchivos($ruta . $file . "/", $ext));
					}
				}
				closedir($dh);
			}
		}else
			echo "No es ruta valida";

		return $archivo;
	}

	$listado=buscarArchivos('../../models/', 'php');

	//Abro el log donde guardare las sentencias
	$log=fopen('sentencias.txt', 'w');

	$coincidencias=Array();
	$total=0;
	//Recorro todos los ficheros en busca de coincidencias y las almaceno
	foreach($listado as $ruta){
		$texto=file_get_contents($ruta[0], FILE_TEXT);

		$num=preg_match_all('/consulta\(.*\);/smU', $texto, $coincidencias);

		//En caso de haber encotnrado coincidencias
		if($num>0){
			$total+=$num;

			//Escribo el nombre del fichero
			fwrite($log, "/*********************************************\n*\t".$ruta[1]."\n*********************************************/\n");

			//Almaceno las coincidencias
			foreach($coincidencias[0] as $key => $val){
				//Formatea la sentencia sql y la almacena
				fwrite($log, implode("\n", array_map("trim", explode("\n", str_replace("\t", '', substr($val, 10, -2)))))."\n\n");
			}

			//Pongo espacios para separarlo del siguiente archivo
			fwrite($log, "\n\n\n");
		}
	}

	//Cierro el log
	fclose($log);

	echo $total.' Sentencias SQL encontradas.<br>';
	echo 'Archivo generado: <a href="./sentencias.txt">Aqui</a>';
?>