<?php
	/**
	 * Controlador de galaxias
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 14/06/2009
	 */

	

	/**
	 * Controlador de galaxias
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 14/06/2009
	 */
	class GalaxiasController
	    extends ControllerBase
	{
		/**
	     * Página principal del modulo de galaxia
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 14/06/2009
	     */
	    public function galaxias()
	    {
			//Compobamos los parametros
			if(array_key_exists('idGalaxia',$_REQUEST) && !empty($_REQUEST['idGalaxia']))
				$_SESSION['infoJugador']['galaxiasGalaxiaSel']=$_REQUEST['idGalaxia'];
			if(array_key_exists('idSector',$_REQUEST) && !empty($_REQUEST['idSector']))
				$_SESSION['infoJugador']['galaxiasSectorSel']=$_REQUEST['idSector'];
			if(array_key_exists('idCuadrante',$_REQUEST) && !empty($_REQUEST['idCuadrante']))
				$_SESSION['infoJugador']['galaxiasCuadranteSel']=$_REQUEST['idCuadrante'];

			//Creamos la primera pestana
	        ob_start();
			$this->galaxiasLista();
			$buffer = ob_get_contents();
	    	ob_clean();

	        //Pasamos los datos a la vista
	        $this->view = new GalaxiasView();
	        $this->view->galaxias($buffer);
	        
	    }

	    /**
	     * Muestra la lista de galaxias, sectores y cuadrantes
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 14/06/2009
	     */
	    public function galaxiasLista()
	    {
	        //Compobamos la sesion
			if(!array_key_exists('galaxiasGalaxiaSel',$_SESSION['infoJugador']) || empty($_SESSION['infoJugador']['galaxiasGalaxiaSel']))
				$_SESSION['infoJugador']['galaxiasGalaxiaSel']=0;
			if(!array_key_exists('galaxiasSectorSel',$_SESSION['infoJugador']) || empty($_SESSION['infoJugador']['galaxiasSectorSel']))
				$_SESSION['infoJugador']['galaxiasSectorSel']=0;
			if(!array_key_exists('galaxiasCuadranteSel',$_SESSION['infoJugador']) || empty($_SESSION['infoJugador']['galaxiasCuadranteSel']))
				$_SESSION['infoJugador']['galaxiasCuadranteSel']=0;

	        //Creamos el modelo
	   		$galaxiaModel = new GalaxiaModel();
	   		$planetaModel = new PlanetaModel();
	   		$misionModel = new MisionModel();
	   		
	   		$hayExplorador=$planetaModel->hayExplorador($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_SESSION['infoJugador']['idUsuario']);
	   
	   		//Limite de mision
	       	$numMisiones=$misionModel->numMisionesActuales($_SESSION['infoJugador']['idUsuario']);
	       		
	   		$galaxias=$galaxiaModel->galaxias();
	   
	   		$planetas=null;
	   		if($_SESSION['infoJugador']['galaxiasGalaxiaSel']!=0 && $_SESSION['infoJugador']['galaxiasSectorSel']!=0 && $_SESSION['infoJugador']['galaxiasCuadranteSel']!=0)
	   			$planetas=$galaxiaModel->planetas($_SESSION['infoJugador']['galaxiasGalaxiaSel'],$_SESSION['infoJugador']['galaxiasSectorSel'],$_SESSION['infoJugador']['galaxiasCuadranteSel'],$_SESSION['infoJugador']['idUsuario']);
	        
	        //Pasamos los datos a la vista
	        $this->view = new GalaxiasView();
	        $this->view->galaxiasLista($galaxias,$_SESSION['infoJugador']['galaxiasGalaxiaSel'],$_SESSION['infoJugador']['galaxiasSectorSel'],$_SESSION['infoJugador']['galaxiasCuadranteSel'],$planetas,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoUnidades']['viajeIntergalactico'],$_SESSION['infoUnidades']['stargateIntergalactico'], $hayExplorador,$numMisiones,$_SESSION['infoUnidades']['limiteMisiones']);
	        
	    }

	    /**
	     * Muestra los planetas de un cuadrante
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/06/2009
	     */
	    public function cuadrante()
	    {
	    	if(!isset($_REQUEST['idCuadrante'])){
	    		$_REQUEST['idCuadrante']=$_SESSION['infoJugador']['galaxiasCuadranteSel'];
	    	}
	    	
	    	if(!isset($_REQUEST['idGalaxiaExplorado'])){
	    		$_REQUEST['idGalaxiaExplorado']=null;
	    	}
	    	
	    	if(!isset($_REQUEST['idPlanetaExplorado'])){
	    		$_REQUEST['idPlanetaExplorado']=null;
	    	}
	        
	        if($_REQUEST['idCuadrante']!=0){
	        	//Guardamos el sector
	        	$_SESSION['infoJugador']['galaxiasCuadranteSel']=$_REQUEST['idCuadrante'];
	        
	        	//Creamos el modelo
	   			$galaxiaModel = new GalaxiaModel();
	   			$planetaModel = new PlanetaModel();
	   			$misionModel = new MisionModel();
	   
	   			//Sacamos los planetas
	   			$planetas=$galaxiaModel->planetas($_SESSION['infoJugador']['galaxiasGalaxiaSel'],$_SESSION['infoJugador']['galaxiasSectorSel'],$_SESSION['infoJugador']['galaxiasCuadranteSel'],$_SESSION['infoJugador']['idUsuario']);
	        	$hayExplorador=$planetaModel->hayExplorador($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_SESSION['infoJugador']['idUsuario']);
	   			
	        	//Limite de mision
	       		$numMisiones=$misionModel->numMisionesActuales($_SESSION['infoJugador']['idUsuario']);
	        	
	        	//Pasamos los datos a la vista
	        	$this->view = new GalaxiasView();
	        	$this->view->cuadrante($planetas,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoUnidades']['viajeIntergalactico'],$_SESSION['infoUnidades']['stargateIntergalactico'],$hayExplorador,$numMisiones,$_SESSION['infoUnidades']['limiteMisiones'],$_REQUEST['idGalaxiaExplorado'],$_REQUEST['idPlanetaExplorado']);
	        }
	        else{
	        	unset($_SESSION['infoJugador']['galaxiasCuadranteSel']);
	        }
	        
	    }

	    /**
	     * Elige una galaxia
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 01/07/2009
	     */
	    public function elegirGalaxia()
	    {
	        
	        if($_REQUEST['idGalaxia']!=0){
	        	//Guardamos la galaxia elegida
	        	$_SESSION['infoJugador']['galaxiasGalaxiaSel']=$_REQUEST['idGalaxia'];
		   
		   		//Sacamos el numero de sectores de la galaxia
		   		$numSectores = $_ENV['config']->get('numSectores');
		   		$numSectores = $numSectores[$_REQUEST['idGalaxia']];
		   
		        //Pasamos los datos a la vista
		        $this->view = new GalaxiasView();
		        $this->view->elegir($numSectores,_('Sector'));
	        }
	        else
	        	unset($_SESSION['infoJugador']['galaxiasGalaxiaSel']);      
	        
	    }

	    /**
	     * Elige un sector
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 01/07/2009
	     */
	    public function elegirSector()
	    {
	        
	        if($_REQUEST['idSector']!=0){
	        	//Guardamos el sector
	        	$_SESSION['infoJugador']['galaxiasSectorSel']=$_REQUEST['idSector'];
		   
		        //Pasamos los datos a la vista
		        $this->view = new GalaxiasView();
		        $this->view->elegir($_ENV['config']->get('numCuadrantes'),_('Cuadrante'));
	        }
	        else
	        	unset($_SESSION['infoJugador']['galaxiasSectorSel']);
	        
	    }

	    /**
	     * Muestra el buscador de planetas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscador()
	    {
	        
	        //Creamos el modelo
	   		$galaxiaModel = new GalaxiaModel();
	   
	   		//Sacamos las galaxias
	   		$galaxias=$galaxiaModel->galaxias();
	   
	        //Pasamos los datos a la vista
	        $this->view = new GalaxiasView();
	        $this->view->buscador($galaxias,$_SESSION['infoJugador']['idRaza']);
	        
	    }

	    /**
	     * Busca planetas en tu galaxia conocida
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscar()
	    {
	        
	        $planetas=Array();
	    	if($_REQUEST['buscado']!=""){
		        //Creamos el modelo
		   		$galaxiaModel = new GalaxiaModel();
		   
		   		//Sacamos los planetas segun criterio
		   		switch($_REQUEST['busqueda']){
		   			case 2:
		   				$planetas=$galaxiaModel->buscarNombre($_SESSION['infoJugador']['idUsuario'],$_REQUEST['buscado'],$_REQUEST['idGalaxia']);
		   				break;
		   			case 3:
		   				$planetas=$galaxiaModel->buscarNombreSGC($_SESSION['infoJugador']['idUsuario'],$_REQUEST['buscado'],$_REQUEST['idGalaxia']);
		   				break;
		   			case 4:
		   				//Comprobamos que la cantidad sea correcta
		   				if($_REQUEST['buscado'] >= 0 && ctype_digit($_REQUEST['buscado']))
		   					$planetas=$galaxiaModel->buscarRiqueza($_SESSION['infoJugador']['idUsuario'],$_REQUEST['buscado'],$_REQUEST['idGalaxia']);
		   				break;
		   			default:
		   				$planetas=$galaxiaModel->buscarPropietario($_SESSION['infoJugador']['idUsuario'],$_REQUEST['buscado'],$_REQUEST['idGalaxia']);
		   				break;
		   		}
	        }
	        //Pasamos los datos a la vista
	        $this->view = new GalaxiasView();
	        $this->view->buscar($planetas);
	        
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
	   		$this->executeController('Galaxias', 'cuadrante');
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
	   		$this->executeController('Galaxias', 'cuadrante');
	    }

	}
?>