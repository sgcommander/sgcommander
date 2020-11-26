<?php
  require_once('../../../constants.php');
  require_once('../../../config.php');

	//Comprueba que no se accese directamente a la pagina
	//define('CORRECTO',1);
	if(!defined('CORRECTO')){
		//Incluir las excepciones y lanzar una
		header('Location: /404.php');
		die();
	}
//
//Esta clase controla todo el acceso de la base de datos
//y evita los errores a traves de excepciones
//
//Ejemplo de uso:
//- <code>$c = Mysql::getInstancia('baseDeDatos','servidor','usuario','password');</code>
//- <code>$res = $c->query("SELECT * FROM tabla") </code>
//- <code>print_r $c->fetchAssoc($res)</code>
//
//
//Changelog:
//
//0.1r2 - Implementacion del lastID y nueva varaible conectionID para el control
//        de las conexiones. (23/05/08)
//
//0.1r1 - Implementacion de transacciones
//
//0.1 - Implementacion de la clase junto todos sus metodos
//
//
//@author Jose & David
//@version 0.1r2
//@since 15/05/08

class Mysql {
  //Atributos
  //
  //Guarda el objeto instanciado
  //
  //@since 23/05/08
  //@version 0.1
  //
  //<strong>Tipo:</strong> class Mysql

  private static $instancia =  NULL;

  //
  //Almacena el ID de conexion.
  //
  //@since 23/05/08
  //@version 0.1
  //
  //<strong>Tipo:</strong> mysql_id

  public $conectionID =  NULL;

  //
  //Registra si se ha producido algun error durante la ejecucion
  //de sentencias sql y obtencion de datos.
  //
  //@since 23/05/08
  //@version 0.1
  //
  //<strong>Tipo:</strong> bool

  private $error =  false;

  //Metodos
  //
  //Devuelve la instancia ya creada o en caso de no estar aun creada, la crea.
  //
  //Esto evita que se puedan declarar mas de dos objetos mysql en una misma ejecucion. (SINGLETON)
  //
  //@since 19/05/08
  //@version 0.1
  //
  //@param string $bd Nombre de la base de datos
  //@param string $servidor Direccion del servidor mysql
  //@param string $usuario Usuario para autentificacion
  //@param string $clave Password del usuario
  //@return self

  public static function getInstancia()
  {
    // Bouml preserved body begin 00023602

			//Comprueba si se ha instanciado ya la clase
			if (self::$instancia == NULL) {
        self::$instancia = new self($_ENV['config']->get('dbName'), $_ENV['config']->get('dbHost'), $_ENV['config']->get('dbUser'), $_ENV['config']->get('dbPass'));//Crea una instancia de la clase
      }

			//Devuelve la clase
			return self::$instancia;
    // Bouml preserved body end 00023602
  }

  //
  //Realiza una conexion a la base de datos y inicia
  //una transaccion para consultas seguras.
  //
  //@since 15/05/08
  //@version 0.1
  //@param string $bd Nombre de la base de datos
  //@param string $servidor Direccion del servidor mysql
  //@param string $usuario Usuario para autentificacion
  //@param string $clave Password del usuario

  private function __construct($bd, $servidor, $usuario, $clave)
  {
    // Bouml preserved body begin 00023682
        
			try {
				//No se han producido errores de momento
				$this->error=false;

        //Realiza la conexion y selecciona la bd
        $this->conectionID = mysqli_connect($servidor, $usuario, $clave);
        if (!$this->conectionID) {
          Excepcion::errorHandler(mysqli_errno($this->conectionID), mysqli_error($this->conectionID), __FILE__, __LINE__);
        }

        $result = mysqli_select_db($this->conectionID, $bd);
        if (!$result) {
          Excepcion::errorHandler(mysqli_errno($this->conectionID), mysqli_error($this->conectionID), __FILE__, __LINE__);
        }
			} catch(Exception $e) {
				//Si se ha producido un error se ejecuta su excepcion
				//y se marca para denegar la transaccion
        $this->error=true;

        $e = new Excepcion(mysqli_error($this->conectionID), mysqli_errno($this->conectionID));
        $e->enviarExcepcion();
			}

			//Inicio de la transaccion
			$this->query('START TRANSACTION');
    // Bouml preserved body end 00023682
  }

  //
  //Elimino la posibilidad de usar clone desde fuera de la clase

  private function __clone()
  {
    // Bouml preserved body begin 00023702
    // Bouml preserved body end 00023702
  }

  //
  //Cierra la conexion a la base de datos y dependiendo
  //si se ha producido un error durante la transaccion
  //esta se devuelve, de lo contrario se acepta y se
  //fijan los cambios permanentemente
  //
  //@version 0.1
  //@since 15/05/08

  public function __destruct()
  {
    // Bouml preserved body begin 00023782

			//Comprueba si ha ocurrido un error durante la conexion
			//para saber si aceptar la transaccion o rechazarla
			if($this->error)
				$this->query('ROLLBACK');//Podria ser omitido, pero se mantiene por seguridad
			else
				$this->query('COMMIT');

			//Cierra la conexion a la BD
			mysqli_close($this->conectionID);
    // Bouml preserved body end 00023782
  }

  //
  //Realiza la peticion de un comando a la base de datos
  //
  //@version 0.1
  //@since 15/05/08
  //@param string $sql Comando SQL
  //@return mysql_result

  public function query($sql)
  {
    // Bouml preserved body begin 00023802

    try {
      $result = mysqli_query($this->conectionID, $sql);
      
      if (!$result) {
        Excepcion::errorHandler(mysqli_errno($this->conectionID), mysqli_error($this->conectionID) . ' - ' . $sql, __FILE__, __LINE__);
      }
    } catch(Exception $e) {
      //Si se ha producido un error se ejecuta su excepcion
      //y se marca para denegar la transaccion
      $this->error=true;

      $e = new Excepcion(mysqli_error($this->conectionID) . ' - ' . $sql, mysqli_errno($this->conectionID));
      $e->enviarExcepcion();
    }

    return $result;
      
    // Bouml preserved body end 00023802
  }

  //
  //Extrae una tupla del resultado obtenido de la base de datos y la volca
  //en un vector asociativo por campos.
  //
  //@version 0.1
  //@since 15/05/08
  //@pre Debes haber obtenido un identificador de Mysql::consulta
  //@param mysql_result $resultado Identificador de consulta (Mysql::consulta) a la Base de datos
  //@return array

  public function fetchAssoc($resultado)
  {
    // Bouml preserved body begin 00023882

			try{
				return mysqli_fetch_assoc($resultado);
			}
			catch(Exception $e){
				//Si se ha producido un error se ejecuta su excepcion
				//y se marca para denegar la transaccion
        $this->error = true;

        $e = new Excepcion(mysqli_error($this->conectionID), mysqli_errno($this->conectionID));
				$e->enviarExcepcion();
			}
    // Bouml preserved body end 00023882
  }

  //
  //Extrae una tupla del resultado obtenido de la base de datos y la volca
  //en un vector numerico.
  //
  //@version 0.1
  //@since 15/05/08
  //@pre Debes haber obtenido un identificador de Mysql::consulta
  //@param mysql_result $resultado Identificador de consulta (Mysql::consulta) a la Base de datos
  //@return array

  public function fetchRow($resultado)
  {
    // Bouml preserved body begin 00023902

			try{
				return mysqli_fetch_row($resultado);
			}
			catch(Exception $e){
				//Si se ha producido un error se ejecuta su excepcion
				//y se marca para denegar la transaccion
        $this->error = true;
        
        $e = new Excepcion(mysqli_error($this->conectionID), mysqli_errno($this->conectionID));
        $e->enviarExcepcion();
			}
    // Bouml preserved body end 00023902
  }

  //
  //Devuelve el numero de resultados que se obtuvo en la consulta.
  //
  //@version 0.1
  //@since 15/05/08
  //@pre Debes haber obtenido un identificador de Mysql::consulta
  //@param mysql_result $resultado Identificador de consulta (Mysql::consulta) a la Base de datos
  //@return int

  public function numRows($resultado)
  {
    // Bouml preserved body begin 00023982
			try{
				return mysqli_num_rows($resultado);
			}
			catch(Exception $e){
				//Si se ha producido un error se ejecuta su excepcion
				//y se marca para denegar la transaccion
        $this->error = true;
        
        $e = new Excepcion(mysqli_error($this->conectionID), mysqli_errno($this->conectionID));
        $e->enviarExcepcion();
			}
    // Bouml preserved body end 00023982
  }

  //
  //Devuelve el ultimo ID insertado en lamisma conexion. Es muy util
  //para cuando se utiliza un campo auto_increment y no sabes con que
  //id se ha insertado la tupla.
  //
  //Devuelve 0 si no se ha insertado ningun id en la actual conexion.
  //
  //@version 0.1
  //@since 23/05/08
  //
  //@return int

  public function lastID()
  {
    // Bouml preserved body begin 00023A02

			return mysqli_insert_id($this->conectionID);
    // Bouml preserved body end 00023A02
  }

  public function getIdConection(){
  	return $this->conectionID;
  }

}

 //fin de la Clase mysql

?>