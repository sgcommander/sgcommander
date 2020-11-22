<?php

require_once './libs/Funciones.php';

Class FuncionesTest Extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider dhmsProvider
	 */
	public function testDhms($seconds, $string, $message){
		$this->assertEquals(Funciones::dhms($seconds), $string, $message);
	}

	public function dhmsProvider()
	{
		return array(
					array(3600, '01:00:00', 'Hora en punto'),
					array(5400, '01:30:00', 'Minuto en punto'),
					array(3599, '00:59:59', 'Tiempo límite'),
					array(86400, '1 Dias 00:00:00', 'Más de 24 horas'),
					array(31749336, '367 Dias 11:15:36', 'Más de un año')
				);
	}

	/**
	 * @dataProvider html2rgbProvider
	 */
	public function testHtml2rgb( $hexColor, $rgbColor, $message )
	{
		$this->assertEquals(Funciones::html2rgb($hexColor), $rgbColor, $message);
	}

	public function html2rgbProvider()
	{
		return array(
					array('#FF00FF', array(255,0,255), 'Hex de 6 carácteres con # delante'),
					array('FF00FF', array(255,0,255), 'Hex de 6 carácteres sin # delante'),
					array('#F0F', array(255,0,255), 'Hex de 3 carácteres con # delante'),
					array('F0F', array(255,0,255), 'Hex de 3 carácteres sin # delante'),
					array('Hola!', array(0,0,0), 'Hexadecimal incorrecto'),
				);
	}

	/**
	* @dataProvider searchProvider
	*/
	public function testLinealSearch($info, $result, $message)
	{
		$this->assertEquals(
							Funciones::linealSearch($info['buscar'],
													$info['vector'],
													$info['key']),
							$result,
							$message
		);
	}

	public function searchProvider()
	{
		return array(
					array(
						array(
							'vector' 	=> array(
												array('clave' => 0),
												array('clave' => 1),
												array('clave' => 2),
												array('clave' => 3),
												array('clave' => 4)
							),
							'buscar' 	=> 0,
							'key' 		=> 'clave'
						),
						0,
						'Elemento existente al inicio en vector impar'
					),
					array(
						array(
							'vector' 	=> array(
													array('clave' => 0),
													array('clave' => 1),
													array('clave' => 2),
													array('clave' => 3),
													array('clave' => 4)
							),
							'buscar' 	=> 4,
							'key' 		=> 'clave',
						),
						4,
						'Elemento existente el ultimo en vector impar'
					),
					array(
						array(
							'vector' 	=> array(
													array('clave' => 0),
													array('clave' => 1),
													array('clave' => 2),
													array('clave' => 3),
													array('clave' => 4)
							),
							'buscar' 	=> 2,
							'key' 		=> 'clave',
						),
						2,
						'Elemento existente en medio en vector impar'
					),
					array(
						array(
							'vector' 	=> array(
												array('clave' => 1),
												array('clave' => 1),
												array('clave' => 2),
												array('clave' => 3),
												array('clave' => 4)
							),
							'buscar' 	=> 0,
							'key' 		=> 'clave'
						),
						0,
						'Elemento inexistente al inicio en vector impar'
					),
					array(
						array(
							'vector' 	=> array(
													array('clave' => 0),
													array('clave' => 1),
													array('clave' => 3),
													array('clave' => 3),
													array('clave' => 3)
							),
							'buscar' 	=> 4,
							'key' 		=> 'clave',
						),
						4,
						'Elemento inexistente el ultimo en vector impar'
					),
					array(
						array(
							'vector' 	=> array(
													array('clave' => 0),
													array('clave' => 1),
													array('clave' => 3),
													array('clave' => 3),
													array('clave' => 4)
							),
							'buscar' 	=> 2,
							'key' 		=> 'clave',
						),
						2,
						'Elemento inexistente en medio en vector impar'
					)
		);
	}
}
?>
