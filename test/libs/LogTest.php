<?php
	Class LogTest Extends PHPUnit_Framework_TestCase
	{
		public function setUp()
		{
			$this->ruta='../log/log'.date('dmY', $_SERVER['REQUEST_TIME']);
			$this->log = new Log($this->ruta);
			return $this->log;
		}
		
		public function testWrite(){
			//Destruimos el fichero
			unlink($this->ruta);
			//Escribimos y destruimos
			$this->log->write(array('a','b'));
			unset($this->log);
			//Comprobamos que existe
			$this->assertFileExists($this->ruta, 'Comprobación de creación de archivo');
			//Abrimos el fichero y leemos la primera linea
			$f = fopen ($this->ruta, "r");
			$contenido=fread($f, filesize($this->ruta));
			$this->assertEquals($contenido,'a;b|','Comprobación del contenido del fichero');
		}
		
	}
?>
