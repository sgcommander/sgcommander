<?php
		set_time_limit(6000);

		define('CORRECTO',true);
		define('PLANETASESPECIALESPORGALAXIA', '');
		require_once('class.Excepcion.php');
		require_once('class.Mysql.php');
		require_once('../../../constants.php');
		require_once('../../../config.php');

		function microtime_float()
		{
		    list($useg, $seg) = explode(" ", microtime());
		    return ((float)$useg + (float)$seg);
		}

		$tiempo_inicio = microtime_float();

		$sectores='ABCDEFGHIJKL0123456789MNOPQRSTUVWXYZ';
		//$riquezas=Array(10,10,10,20,20,20,30,30,30,40,40,40,60,60,60,60,60,70,70,70,70,80,80,90,100); //Descomentar para empobrecer la galaxia
		$riquezas=Array(10,20,30,40,40,60,60,60,70,70,80,80,90,100);
		$letra=Array('V','P','A');
		$nRiquezas=count($riquezas)-1;

		$mysql = Mysql::getInstancia();

		//Preaparamos las tablas
		$mysql->query('TRUNCATE planetaExplorado');
		$mysql->query('TRUNCATE planetaColonizado');
		$mysql->query('TRUNCATE planetaEspecial');
		$mysql->query('TRUNCATE planeta');
		//Seteamos el tamano de la tabla en RAM a un valor suficientemente alto
		$mysql->query('set max_heap_table_size=1048576000');
		//Reconstruimos la tabla para que acepte la neuva cantidad de tuplas 
		$mysql->query('ALTER TABLE tPlanetaMem ENGINE MEMORY;');

		$numSectores = $_ENV['config']->get('numSectores');
		
		//Creamos las galaxias
		for($i=1;$i<=$_ENV['config']->get('numGalaxias');$i++){
			$idp=1;
			//Creamos los sectores
			for($s=1;$s<=$numSectores[$i];$s++){
				//Creamos los cuadrantes
				for($c=1;$c<=$_ENV['config']->get('numCuadrantes');$c++){
					//Creamos los planetas
					for($p=1;$p<=$_ENV['config']->get('numPlanetas');$p++){
						$alea=mt_rand(0,$nRiquezas);
						$riqueza=$riquezas[$alea];
						$nombreSGC=$letra[$i-1].$s.substr($sectores,$s-1,1).'-'.str_pad($c, 2, '0', STR_PAD_LEFT).str_pad($p, 2, '0', STR_PAD_LEFT);
						$coordenadas=get_rand_num(7, false, $_ENV['config']->get('numGalaxias'), mb_strlen($sectores, 'UTF-8')+$_ENV['config']->get('numGalaxias'));
						$result=$mysql->query(
								'INSERT INTO tPlanetaMem VALUES ('.$idp.','.$i.',NULL,\''.$nombreSGC.'\','.$coordenadas[0].','.$coordenadas[1].','.$coordenadas[2].','.$coordenadas[3].','.$coordenadas[4].','.$coordenadas[5].','.$coordenadas[6].','.$riqueza.')'
						);
						$idp++;
					}
				}
			}

			$mysql->query('INSERT INTO planeta SELECT * FROM tPlanetaMem');
			$mysql->query('DELETE FROM tPlanetaMem');

			//Insertamos aleatoriamente los planetas especiales de la galaxia actual
			$sql='SELECT idPlaneta, idGalaxia, nombrePlaneta, imagen, riqueza '. 
										'FROM tPlaneta '. 
										'WHERE idGalaxia=\''.$i.'\' '.
										'ORDER BY RAND()';
			//Si hay limite de planetas por galaxia
			if(PLANETASESPECIALESPORGALAXIA!='')
				$sql.=' LIMIT '.PLANETASESPECIALESPORGALAXIA;

			$result=$mysql->query($sql);
			if($mysql->numRows($result)>0){
				//Generamos posiciones aleatorias para todos los planetas especiales
				$posiciones=get_rand_num($q = $mysql->numRows($result), $rep = false, $min = 1, $max = $numSectores[$i]*$_ENV['config']->get('numCuadrantes')*$_ENV['config']->get('numPlanetas'));

				//Recorremos la lista
				$posPlaneta=0;
				while($row = $mysql->fetchAssoc($result)){
					$idp=$posiciones[$posPlaneta];
					$idpant=$row['idPlaneta'];
					//echo $idp.' - '.$row['nombrePlaneta'].PHP_EOL;
					$result2=$mysql->query(
						'INSERT INTO planetaEspecial (idPlanetaEsp, idGalaxia, imagen) VALUES ('.$idp.','.$i.',\''.$row['imagen'].'\')'
					);
					$result2=$mysql->query(
						'UPDATE planeta SET nombrePlaneta=\''.$row['nombrePlaneta'].'\', riqueza='.$row['riqueza'].' WHERE idGalaxia='.$i.' AND idPlaneta='.$idp
					);

					//Insertamos las unidades del planeta
					$result2=$mysql->query('SELECT idUnidad '. 
										'FROM tPlanetaUnidad '. 
										'WHERE idGalaxia=\''.$i.'\' '.
										'AND idPlanetaEsp='.$idpant);
					if($mysql->numRows($result2)>0){
						//Recorremos la lista
						while($row2 = $mysql->fetchAssoc($result2)){
							//echo '    '.$row2['idUnidad'].PHP_EOL;
							$result3=$mysql->query(
								'INSERT INTO planetaUnidad (idUnidad, idPlanetaEsp, idGalaxia) VALUES ('.$row2['idUnidad'].','.$idp.','.$i.')'
							);
						}
					}

					//Insertamos los especiales del planeta
					$result2=$mysql->query('SELECT idEspecial '. 
										'FROM tEspecialRequierePlaneta '. 
										'WHERE idGalaxia=\''.$i.'\' '.
										'AND idPlanetaEsp='.$idpant);
					if($mysql->numRows($result2)>0){
						//Recorremos la lista
						while($row2 = $mysql->fetchAssoc($result2)){
							//echo '    '.$row2['idEspecial'].PHP_EOL;
							$result3=$mysql->query(
								'INSERT INTO especialRequierePlaneta (idEspecial, idGalaxia, idPlanetaEsp) VALUES('.$row2['idEspecial'].','.$i.','.$idp.')'
							);
						}
					}

					//Pasamos a la siguiente posicion
					$posPlaneta++;
				}
			}
		}

		//Insertamos midway
		$coordenadas=get_rand_num(6, false, $_ENV['config']->get('numGalaxias')+2, mb_strlen($sectores, 'UTF-8')+$_ENV['config']->get('numGalaxias'));
		$result=$mysql->query(
			'INSERT INTO planeta VALUES (1,4,\'Midway\',\'M1A-11\','.$coordenadas[0].','.$coordenadas[1].','.$coordenadas[2].','.$coordenadas[3].','.$coordenadas[4].','.$coordenadas[5].',4,0)'
		);
		$result2=$mysql->query(
			'INSERT INTO planetaEspecial (idPlanetaEsp, idGalaxia, imagen) VALUES (1,4,\'midway.jpg\')'
		);

		//Enlazamos midway con su especial
		$result2=$mysql->query(
			'INSERT INTO especialRequierePlaneta (idEspecial, idGalaxia, idPlanetaEsp) VALUES (556, 4, 1)'
		);

		$mysql->query('DROP TABLE tPlaneta');
		$mysql->query('DROP TABLE tPlanetaUnidad');
		$mysql->query('DROP TABLE tEspecialRequierePlaneta');
		$mysql->query('DROP TABLE tPlanetaMem');

		$tiempo_final = microtime_float();
		$tiempo = $tiempo_final - $tiempo_inicio;

		//Generando los usuarios del sistema
		/*Generado para el sistema de testeo, jugadores predeterminados y juego dopado*/
		//Dopando el juego
		/*$mysql->query("UPDATE recursoRaza SET produccionBase=produccionBase*100 WHERE idTipoRecurso=1 || idTipoRecurso=2");
		$mysql->query("UPDATE recursoRaza SET cantidadBase=cantidadBase*100 WHERE idTipoRecurso=1 || idTipoRecurso=2");
		$mysql->query("UPDATE mejoraNormal SET tiempo=tiempo/100");
		$mysql->query("UPDATE unidad SET tiempo=tiempo/100");
		$mysql->query("UPDATE tipoMision SET tiempo=tiempo/10");*/

		echo "Y dios hizo el universo en: $tiempo segundos".PHP_EOL;

/*
* get_rand_num()
* Sintaxis: array get_rand_num(int cantidad, bool repetidos, int minimo, int maximo)
*
* Objetivo de la funcion: Generar una matriz con números aleatorios con posibilidad de
* elegir que se puedan o no repetir. Si el segundo párametro vale false (por defecto)
* los números que contenga la matriz resultante serán todos diferentes (no se repetirán)
*
* Todos los parámetros son opcionales
*
* Parámetro cantidad: Establece la cantidad de números devueltos
* Parámetro repetidos: Establece si se podrán repetir o no (false por defecto, o sea,
*    que no se pueden repetir)
* Parámetro minimo: Número mínimo desde el que se empezarán a obtener números aleatorios
* Parámetro maximo: Número máximo desde hasta el que se obtendrán números aleatorios
*
*     Función por Diego Agulló (Aeoris)
*     aeoris@gmail.com - http://www.aeoris.net
*
*     http://www.php-hispano.net
*     #php_para_torpes en el IRC-Hispano
*
*     AVISO: No puedes hacer pasar la función como tuya, ni publicarla en otra web
*     que no sea http://www.php-hispano.net sin mi previa autorizacion.
*
* Gracias a {Arias} por corregir algunos fallos y ayudar en la optimizacion de la funcion
* Gracias a DarkSoldier por reportar algunos fallos
*/

function get_rand_num($q = 1, $rep = false, $min = null, $max = null)
{
    $min = (int)$min;
    $max = (int)$max;

    if ($q < 1) {
        trigger_error("The quantity must be greater than 1\n", E_USER_WARNING);
        return false;
    }

    if ((!is_null($min) && is_null($max)) || (is_null($min) && !is_null($max))) {
        trigger_error("You must especify the min and max values\n", E_USER_WARNING);
        return false;
    }

    if (!is_null($min)) {
        if ($min >= $max) {
            trigger_error("The max number must be greater than the min\n", E_USER_WARNING);
            return false;
        }

        if (!$rep && $q - 1 > $max - $min) {
            trigger_error("The difference between the min and max parameters must be greater than the quantity\n", E_USER_WARNING);
            return false;
        }
    }

    $nums = array();
    mt_srand((double)microtime() * 10000000);

    do {
        $num = !is_null($min) ? mt_rand($min, $max) : mt_rand();

        if (!$rep && in_array($num, $nums))
            continue;

        $nums[] = $num;

    } while ($q > count($nums));

    return $nums;
} 
?>
