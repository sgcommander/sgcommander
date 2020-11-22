<?php

class Funciones
{
	const SECONDS_PER_DAY 		= 86400;
	const SECONDS_PER_HOUR 		= 3600;
	const SECONDS_PER_MINUTE 	= 60;

	/**
	 * Funcion que formatea un tiempo en segundos a ad xh ym zs
	 *
	 * @param integer $tiempo
	 */
	static function dhms($tiempo){
		$segundos	= $tiempo % self::SECONDS_PER_MINUTE;
		$minutos	= ($tiempo/ self::SECONDS_PER_MINUTE) % self::SECONDS_PER_MINUTE;
		$horas		= ($tiempo/ self::SECONDS_PER_HOUR)%24;
		$dias		= floor($tiempo/ self::SECONDS_PER_DAY);

		$cadena='';
		if($dias)
			$cadena = $dias.' '._('Dias').' ';

		$cadena .= sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);

		return $cadena;
	}

	/**
	 * Funcion que convierte un color de hex a rgb
	 *
	 * @param string $color Color en hexadecimal  #FFFFFF, #FFF o sin #
	 * @return array
	 */
	static function html2rgb($color)
	{
		if ($color[0] == '#'){
			$color = substr($color, 1);
		}

		$hexLength = mb_strlen($color, 'UTF-8');

		switch ($hexLength)
		{
			case 6:
				$red = hexdec($color[0].$color[1]);
				$green = hexdec($color[2].$color[3]);
				$blue = hexdec($color[4].$color[5]);
				break;
			case 3:
				$red = hexdec($color[0].$color[0]);
				$green = hexdec($color[1].$color[1]);
				$blue = hexdec($color[2].$color[2]);
				break;
			default:
				$red = 0;
				$green = 0;
				$blue = 0;
		}

		return array($red, $green, $blue);
	}

	/**
	 * Busca en un array ordenada el valor dado o donde se situa el valor
	 * más aproximado al dado. La busqueda es sobre vecotres por lo que
	 * se debe elegir la $key que se desea comparar con el valor dado.
	 * Esta busqueda se realiza de forma lineal. Mejor que la binario con menos
	 * de 40 elementos.
	 *
	 * @param mixed $needle Valor a buscar
	 * @param array $haystack Vector donde buscar
	 * @param mixed $key Indice a comprar del vector
	 * @return integer
	 */
	function linealSearch($value, $haystack, $key)
	{
		$total = sizeof($haystack);
		$i = 0;

		while($value > $haystack[$i++][$key] && $i < $total)
		{
			//VOID
		}

		return $i - 1;
	}

	/**
	 * Devuelve el sector de un planeta teniendo en cuenta los parametros
	 * de configuración
	 *
	 * @param integer $idPlaneta
	 * @return number
	 */
	static function calcularSector($idPlaneta){
		return intval((($idPlaneta-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas'))+1);
	}

	/**
	 * Devuelve el cuadrante del planeta teniendo en cuenta los parametros
	 * de configuración.
	 *
	 * @param integer $idPlaneta
	 * @return number
	 */
	static function calcularCuadrante($idPlaneta){
		return intval((($idPlaneta-1-(intval((($idPlaneta-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas')))*$_ENV['config']->get('numPlanetas')*$_ENV['config']->get('numCuadrantes')))/$_ENV['config']->get('numPlanetas')))+1;
	}
}
?>