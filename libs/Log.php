<?php
	/**
	 * Esta clase es una abstraccion del log
	 * ten los metodos cesarios paraescribir 
	 * lineas en el log
	 */
	class Log {
		private $ruta;
		private $info;
		
		public function Log($ruta){
			$this->info='';
			$this->ruta=$ruta;
		}
		
		public function write($datos){
			$this->info.='['.date('M d H:i:s').'] '.implode(' ', $datos).PHP_EOL;
		}
		
		public function __destruct(){
			$f = fopen($this->ruta, 'a');
			if($f !== false) {
				fwrite($f, $this->info);
				fclose($f);
			}
		}
	}