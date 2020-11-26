<?php

/**
 * Esta clase es una abstraccion de la clase Mysqli,
 * la cual implementa el patron Singleton ademas de
 * permitir un sistema de cache a traves de APC y
 * conexion bajo demanda con posibilidad de usar transacciones
 * con auto rollback en caso de errores para mantener la
 * integridad de la base de datos
 */
class SPDO extends mysqli
{

	//Instancia de esta propia clase
	private static $instancia;
	private static $connected;
	private static $transaction;

	/**
	 * Funcion constructora privada, para evitar crear la clase.
	 *
	 * Por defecto el objeto se construye para usar las transacciones
	 * proporcionadas por el motor INNODB
	 */

	private function __construct( $transaction )
	{
		//Establece si habra o no transacciones
		self::$transaction = $transaction;
	}

	/**
	 * Destructor de la clase
	 */

	public function __destruct( )
	{
		//En el momento que se destruye el objeto, se hace COMMIT
		//para actualizar realmente la base de datos con los ultimos
		//cambios realizados.
		//
		//Esto solo funciona si se ha elegido el modo transaccion y si
		//se ha conectado a la base de datos.
		if ( self::$connected && self::$transaction )
			$this->commit( );
	}

	/**
	 * Funcion que implementa el metodo singleton,
	 * por el cual solo habra una instancia de
	 * SPDO durante toda la ejecucion
	 */

	public static function singleton( $transaction = TRUE )
	{
		if ( !isset( self::$instancia ) )
		{
			//Conecto con la base de datos
			self::$instancia = new self( $transaction);
		}

		return self::$instancia;
	}

	/**
	 * Evita clonar la funcion
	 */

	public function __clone( )
	{
		trigger_error( 'No está permitido clonar la clase.', E_USER_ERROR );
	}

	/**
	 * Conecta a la base de datos comprobando que todo hata sido correcto
	 */

	public function connect( $dbHost = NULL, $dbUser = NULL, $dbPass = NULL,
			$dbName = NULL, $dbPort = NULL, $dbSocket = NULL )
	{
		//Si no se han pasado las opciones por parametro, obtengo las de la configuracion por defecto
		if ( empty( $dbHost ) )
			$dbHost = $_ENV['config']->get( 'dbHost' );
		if ( empty( $dbUser ) )
			$dbUser = $_ENV['config']->get( 'dbUser' );
		if ( empty( $dbPass ) )
			$dbPass = $_ENV['config']->get( 'dbPass' );
		if ( empty( $dbName ) )
			$dbName = $_ENV['config']->get( 'dbName' );
		if ( empty( $dbPort ) )
			$dbPort = $_ENV['config']->get( 'dbPort' );
		if ( empty( $dbSocket ) )
			$dbSocket = $_ENV['config']->get( 'dbSocket' );

		//Realizo la conexion real con el servidor
		parent::connect( $dbHost, $dbUser, $dbPass, $dbName, $dbPort, $dbSocket );

		//Si la conexion falla, envio un error
		if ( $this->connect_error )
		{
			trigger_error('Connect Error (' . $this->connect_errno . ') ' . $this->connect_error, E_USER_ERROR );
		}

		//Si las transacciones estan activas,
		//desactivo el autocommit
		if ( self::$transaction )
		{
			$this->autocommit( FALSE );
		}

		//Cambio el charset
		self::set_charset("utf8");
		
		//Indico que ya estamos conectados con el servidor
		self::$connected = true;
	}

	/**
	 * Abstraccion de mysqli::query
	 *
	 * Permite comprobar errores en las peticiones para realizar logs,
	 * aplicar cache a consultas y realizar rollbacks de forma automatica
	 * en el momento que se produzca un error
	 *
	 *
	 * ¡¡ATENCION!! El cacheo aun no esta implementado
	 */

	public function query( $sql )
	{
		//Si aun no he conectado con la base de datos, realizo la conexion
		if ( empty( self::$connected ) )
		{
			$this->connect( );
		}

		//Ejecuto al consulta
		$result = parent::query( $sql );

		//Si la ejecucion ha sido un exito, devuelvo el resultado
		if ( $result )
		{
			return $result;
		}
		//Si no, disparo un mensaje de error
		else
		{
			//Genero el mensaje de error
			$error = 'Query Error (' . $this->errno . ') ' . $this->error
					. '----------------------------' . $sql;

			//Si las transacciones estan activas,
			//deshago toda la transaccion actual
			if ( self::$transaction )
			{
				$this->rollback( );
			}

			//Muestro el error al usuario
			trigger_error( $error, E_USER_ERROR );
		}
	}
}
?>