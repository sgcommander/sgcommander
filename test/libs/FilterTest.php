<?php
	Class FilterTest Extends PHPUnit_Framework_TestCase
	{
		public function setUp()
		{
			$this->filter = new Filter();
		}
		
		/**
		 * @dataProvider provider
		 */
		public function testClean($original, $result, $message)
		{
			$this->filter->clean($original);
			$this->assertEquals($original, $result, $message);
		}
		
		public function provider(){
			return	array(
						array(
							'Hola', 
							'Hola', 
							'Comprobación de letras ANSII'
						),
						array(
							'áéíóúàèìòù', 
							'áéíóúàèìòù', 
							'Comprobación de acentos'
						),
						array(
							'"\'<>', 
							'&#34;&#39;&#60;&#62;', 
							'Comrobación carácteres a transformar en entidades'
						),
						array(
							array(
								'hola',
								array(
									'adios',
									array(
										'<ñaño>'
									),
									'camión',
									'coche'
								)
							),
							array('hola',
								array(
									'adios',
									array(
										'&#60;ñaño&#62;'
									),
									'camión',
									'coche'
								)
							),
							'Comprobación de limpieza en matrices'
						)
					);
		}
	}
?>
