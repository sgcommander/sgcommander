<?php
	/**
	 * Controlador del modulo de planetas
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 06/02/2009
	 */
	
	
	
	/**
	 * Controlador del modulo de planetas
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 06/02/2009
	 */
	class PlanetasController
	    extends ControllerBase
	{
	    /**
	     * Carga la página principal del modulo de 
	     * planetas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetas()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->tuLista();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new PlanetasView();
	        $this->view->show($buffer);
	        
	    }
	
	    /**
	     * Muestra la lista personalizada del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function tuLista()
	    {
	        
			//Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   		//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=15;
	   
	   		$planetas=$planetaModel->tuLista($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
	   
		    $numPlanetas=$planetaModel->numPlanetasTuLista($_SESSION['infoJugador']['idUsuario']);
		    
		    //Pasamos los datos a la vista
		    $this->view = new PlanetasView();
		    $this->view->tuLista($_SESSION['infoJugador']['idUsuario'],$planetas,$cantidadPag,$numPlanetas,($_REQUEST['inicio']/$cantidadPag)+1,$_SESSION['infoJugador']['idRaza']);   
	        
	    }
	
	    /**
	     * Lista los planetas propios
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasPropios()
	    {
	        
	        //Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   		$razaModel = new RazaModel();
	   
	   		//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=15;
	   
	   		$planetas=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
	   
	   		$raza=$razaModel->raza($_SESSION['infoJugador']['idRaza']);
	   
	   		//Pasamos los datos a la vista
		    $this->view = new PlanetasView();
	   
		    $this->view->planetasPropios($planetas,$_SESSION['infoJugador']['usuario'],$raza['maxPlanetas'],$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Lista los planetas aliados
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasAliados()
	    {
	        
	        //Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   		//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=15;
	   
	   		$planetas=$planetaModel->planetasAliados($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
	   
		    $numPlanetas=$planetaModel->numPlanetasAliados($_SESSION['infoJugador']['idUsuario']);
		    
		    //Pasamos los datos a la vista
		    $this->view = new PlanetasView();
		    $this->view->planetasAliados($planetas,$cantidadPag,$numPlanetas,($_REQUEST['inicio']/$cantidadPag)+1,$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Lista los planetas enemigos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasEnemigos()
	    {
	        
	        //Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   
			//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=15;
	   
	   		$planetas=$planetaModel->planetasEnemigos($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
	   
		    $numPlanetas=$planetaModel->numPlanetasEnemigos($_SESSION['infoJugador']['idUsuario']);
		    
		    //Pasamos los datos a la vista
		    $this->view = new PlanetasView();
		    $this->view->planetasEnemigos($planetas,$cantidadPag,$numPlanetas,($_REQUEST['inicio']/$cantidadPag)+1,$_SESSION['infoJugador']['idRaza']);  
	        
	    }
	
	    /**
	     * Lista los planetas neutrales
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasNeutrales()
	    {
	        
	        //Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   		//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=15;
	   
	   		$planetas=$planetaModel->planetasNeutrales($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
	   
		    $numPlanetas=$planetaModel->numPlanetasNeutrales($_SESSION['infoJugador']['idUsuario']);
		    
		    //Pasamos los datos a la vista
		    $this->view = new PlanetasView();
		    $this->view->planetasNeutrales($planetas,$cantidadPag,$numPlanetas,($_REQUEST['inicio']/$cantidadPag)+1,$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Añade un planeta a Tu lista
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function anadir()
	    {
	        //Mostramos el planeta
	   		$planetaModel = new PlanetaModel();
	   		$planetas=$planetaModel->anadir($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario']);
	        
	   		//Recargamos
	   		$this->executeController('Planetas', $_REQUEST['accionRecargar']);
	    }
	
	    /**
	     * Elimina un planeta a Tu lista
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function eliminar()
	    {
	        //Ocultamos el planeta
	   		$planetaModel = new PlanetaModel();
	   		$planetas=$planetaModel->eliminar($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario']);
	        
	   		//Recargamos
	   		$this->executeController('Planetas', $_REQUEST['accionRecargar']);
	    }
	
	    /**
	     * Descoloniza un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function abandonar()
	    {
	        
	        //Creamos el modelo
	   		$planetaModel = new PlanetaModel();
	   
	   		//Comprobamos que no haya construcciones o unidades en el planetas
	   		if($planetaModel->construyendo($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario'])){
	   			$mensaje=_('No puedes abandonar un planeta con construcciones. Cancela todas las construcciones antes de abandonarlo.');
	   		}
	   		elseif($planetaModel->hayUnidades($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario'])){
	   			$mensaje=_('No puedes abandonar un planeta con unidades o misiones activas. Cancela todas las misiones y licencia o traslada las unidades antes de abandonarlo.');
	   		}
	   		else{
				//Abandonamos el planeta
				$result=true;
		   		$result=$planetaModel->abandonar($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario']);
		   		
			    if($result==false){
			    	$mensaje=_('Error al abandonar');
			    }
			    else{
			    	//
			   		//Actualizo los datos de sesion, por si algun heroe ha sido eliminado de algun otro planeta
			   		//y asi reestablecer los valores de las mejoras
			   		//
		    		$info = new InfoJugadorModel();
		    		
			   		//Actualizo las mejoras para las unidades en sesion
					list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
	                    $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
	                    $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
	                    $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
	                    $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
	                    $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);
			    	
			    	$mensaje=_('Has abandonado el planeta');
			    }
	   		}
	
	   		//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        
	        //Refrescamos la lista de planetas por si hemos eliminado uno
	        $planetasPropios=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);
			$this->view->actualizarPlanetas($planetasPropios,$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
			
			//Mostramos el mensaje
	        $this->view->mensaje($mensaje);   
	    }
	
	    /**
	     * Cambia el nombre de un planeta colonizado
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function cambiarNombre()
	    {
	        
	        
	    }
	
	    /**
	     * Cambia la nota de un planeta explorado
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function cambiarNota()
	    {
	        
	        
	    }
	
	}
?>