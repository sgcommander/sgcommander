<?php

	/**
	 * Controlador de la actualizacion
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 19/04/2009
	 */

	/**
	 * Controlador de la actualizacion
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 19/04/2009
	 */
	class ResumirEventosController
	    extends ControllerBase
	{
	    /**
	     * De aqui se extraen y se insertan datos a la bd
	     *
	     * @access protected
	     * @since 19/04/2009
	     * @var Integer
	     */
	    protected $almacen = null;

	    /**
	     * Constructor de la clase
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer recursos
	     * @param  Integer fechaFin
	     * @return mixed
	     * @since 19/04/2009
	     */

	    /*
	     * $idJugador -> Identificador del jugador al cual se le quieren resumir los eventos (integer)
	     * $fechaFin -> Fecha limite para la resolucion de eventos, normalmente sera el tiempo actual (time())
	     * $salidaJS -> Indica si se esta cargando el entorno completo (la priemra vez que se accede a la web), esto sirve por que en dicho caso
	     * 					no se debe de mostrar javascript generado por resumirEventos, ya que el propio entorno lo genera.
	     */
	    public function ResumirEventosController()
	    {
	        //Obtengo la ultima actualizacion de la base de datos
	    	$this->almacen = new ResumirEventosModel();
	    }

	    /**
	     * Resuelve los eventos
	     *
	     * Resuelve el siguiente evento cronologicamente
	     * y verdadero en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String controllerName
	     * @return mixed
	     * @since 19/04/2009
	     */
	    public function resolverEventoSiguiente()
	    {
	    	//Conectamos a la bbdd
	    	$this->almacen->connect();
	    	
	        //Captura el siguiente evento por fecha y hora
	    	$evento = $this->almacen->buscarSiguienteEvento();
			
			//Si existe un evento lo resolvemos
			if($evento){
				System_Daemon::info('Evento %s encontrado de tipo %s del jugador %s',$evento['id'],$evento['tipo'],$evento['idJugador']);
				
				//Actualizo los recursos
				$infoJugador=$this->obtenerInfoJugador($evento['idJugador']);
				$this->almacen->actualizarRecursos($evento['idJugador'], $evento['tiempo']-$this->almacen->ultimaActualizacion($evento['idJugador']), $infoJugador);
	    		$this->almacen->actualizarTiempo($evento['idJugador'], $evento['tiempo']);

	    		//Resuelvo el evento
	    		$this->resuelveEvento($evento);
				
				//Actualizo la firma
				$firma=new Firma();
				$firma->generar($evento['idJugador']);
				
				//Guardo los cambios
	    	   	$this->almacen->commit();
			}
			
			//Limpiamos la conexion persistente de mysqli
			$this->almacen->change_user($_ENV['config']->get( 'dbUser' ),$_ENV['config']->get( 'dbPass' ),$_ENV['config']->get( 'dbName' ));

			//Cerramos la conexion
			$this->almacen->close();

			return True;
	    }
		
		/**
   		 * Obtiene la informacion del jugador
   		 *
   		 * @param mixed $idJugadores
   		 */
   		private function obtenerInfoJugador($idJugador){
   			//Generamos el modelo para sacar los datos de recursos
		    $recursos = new RecursosModel();

		    //Inicializamos el array
   			$infoJugador = Array();

			$producciones = $recursos->obtenerProduccion($idJugador);
			$infoJugador[0]['produccion']=$producciones['produccionPrimario'];
			$infoJugador[1]['produccion']=$producciones['produccionSecundario'];

   			return $infoJugador;
   		}

   		/**
   		 * Resuelve un evento
   		 *
   		 * @param mixed $datosEvento
   		 * @param mixed $infoJugador
   		 */
   		private function resuelveEvento($datosEvento){
   			
   			//Miro el tipo de evento y lo ejecuto
    		switch($datosEvento['tipo']){
    			case EVENTOMEJORAR:
    				//Resuelvo el evento
    				$this->almacen->terminarMejora($datosEvento['idJugador'], $datosEvento['id']);
					break;
    			case EVENTOCONSTRUIR:
    				//Resuelvo el evento
    				$this->almacen->terminarConstruccion($datosEvento['id'], $datosEvento['idGalaxia'], $datosEvento['idPlaneta']);
    				break;
    			case EVENTOMISION:
    				$mision = new Mision($datosEvento['idJugador'], $datosEvento['id'], $datosEvento['tiempo']);

    				//Si la mision no ha sido resuelta por otro usuario
					if($mision->exists()){
    					//Resuelvo el evento. Una mision puede

	    				$this->almacen->terminarMision($mision);

    				}
    				break;
    			case EVENTOFINESPECIALACTIVO:
    				//Resuelvo el evento
    				$this->almacen->terminarEspecialActivo($datosEvento['idJugador'], $datosEvento['id']);
    				break;
    			case EVENTOFINESPECIALESPERA:
    				$this->almacen->terminarEspecialEspera($datosEvento['idJugador'], $datosEvento['id']);
    		}
   		}
	}
?>
