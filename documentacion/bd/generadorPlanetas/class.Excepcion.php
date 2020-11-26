<?php
	//Comprueba que no se accese directamente a la pagina
	if(!defined('CORRECTO')){
		//Incluir las excepciones y lanzar una
		header("Location: /404.php");
		die();
	}

	//Esto se debe poner despues de todos los includes junto al session_start();
	//set_error_handler(array('Excepcion', 'errorHandler'), E_ALL);
//Controla los errores de php y los filtra para almacenar un log
//con los errores y mostrar una pantalla apropiada al usuario
class Excepcion extends Exception {
  //Manejador de errores asignado al php para obtener los errores
  public static function errorHandler($errno, $errstr, $errfile, $errline)
  {
    // Bouml preserved body begin 0001FF02

		    $e = new self();
		    $e->message = $errstr;
		    $e->code = $errno;
		    $e->file = $errfile;
		    $e->line = $errline;
		    
		    throw $e;
    // Bouml preserved body end 0001FF02
  }

  //Almacena en un fichero todos los datos relacionados con el error
  //que progujo la excepcion
  public function grabarExcepcion()
  {
    // Bouml preserved body begin 0001FF82

			//Formato de la cadena a almacenar
			$mensaje=date('d-m-Y H:i:s')."\t".$this->code."\t".$this->file.':'.$this->line."\t\t".$this->message."\n";

			echo $mensaje;
    // Bouml preserved body end 0001FF82
  }

  //Ejecuta el procedimiento de la excepcion.
  public function enviarExcepcion()
  {
    // Bouml preserved body begin 00020002

			//Guardo el error en el fichero LOG
			$this->grabarExcepcion();
				
			//Salgo de la pagina actual y carga la pagina correspondiente al error
			//header('Location: /error.php?codigo='.$this->code);
			die();//Mata el proceso por haber encontrado un error critico
    // Bouml preserved body end 00020002
  }

}

 // end of misExcepciones

	/********************
	 * TEST de la clase
	 ********************/
	/*try{
		mysql_connect("127.0.0.1", "r'oot", "123");
	}
	catch(Excepcion $e){ // Captura la excepcion y la almaceno
		$e->enviarExcepcion();
	}*/
?>
