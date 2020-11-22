<?php
	/**
	 * Controlador de especiales
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 15/07/2009
	 */

	

	/**
	 * Controlador de especiales
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 15/07/2009
	 */
	class EspecialesController
	    extends ControllerBase
	{
	    /**
	     * Lista los especiales de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/07/2009
	     */
	    public function especiales()
	    {
	        
	        //Creamos el modelo
	   		$especialModel = new EspecialModel();
		    $especiales=$especialModel->especiales($_SESSION['infoJugador']['idUsuario']);
		    
		    //Sacamos los planetas de destino
	   		$planetaModel = new PlanetaModel();
	   		$planetas=$planetaModel->planetasEnemigos($_SESSION['infoJugador']['idUsuario'],0,$planetaModel->numPlanetasEnemigos($_SESSION['infoJugador']['idUsuario']));
	   
	        //Pasamos los datos a la vista
	        $this->view = new EspecialesView();
	        $this->view->especiales($especiales, $planetas);
	        
	    }

	    /**
	     * Activa un especial
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/07/2009
	     */
	    public function activar()
	    {
	        //Compobamos los parametros
			if(!array_key_exists('idGalaxiaDestino',$_REQUEST) || empty($_REQUEST['idGalaxiaDestino']))
				$_REQUEST['idGalaxiaDestino']='';
			if(!array_key_exists('idPlanetaDestino',$_REQUEST) || empty($_REQUEST['idPlanetaDestino']))
				$_REQUEST['idPlanetaDestino']='';
	        //Creamos el modelo
	   		$especialModel = new EspecialModel();
	   
	   		//Extraigo los especiales disponibles
	   		$disponibles = $especialModel->especiales($_SESSION['infoJugador']['idUsuario']);
	   
	   		//Busco si el especial a activar esta entre los disponibles
	   		$activar = False;
	   		foreach($disponibles AS $especial){
	   			if($especial['idEspecial']==$_REQUEST['idEspecial'] && $especial['activo']){
	   				$activar = True;
	   				break;
	   			}
	   		}
	   
	   		//Si se debe activar el especial, se activa
	   		if($activar){
			    $especiales = $especialModel->activar($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idEspecial'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idGalaxiaDestino'],$_REQUEST['idPlanetaDestino']);
		        
			    //Cargo la clase que me permite tener actualizadas las variables de session, para que se actualicen todos los cambios
		    	$info = new InfoJugadorModel();
			    
		        //Actualizo las mejoras para recursos y varios en sesion
		    	list($_SESSION['infoJugador']['investigacionVelocidad'], $_SESSION['infoJugador']['construccionVelocidad'], $_SESSION['infoJugador']['numeroMensajes'], $_SESSION['infoUnidades']['limiteMisiones'],
				$_SESSION['infoUnidades']['numNaves'], $_SESSION['infoUnidades']['numSoldados'], $_SESSION['infoUnidades']['limiteSoldados'], 
				$_SESSION['infoUnidades']['numDefensas'], $_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'],
				$_SESSION['infoRecursos'][2]['produccion']) = $info->infoGeneral($_SESSION['infoJugador']['idUsuario']);
		    
				//Actualizo las mejoras para las unidades en sesion
				list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
                    $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
                    $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
                    $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
                    $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
                    $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);

				//Genero la vista de especiales
				$this->view = new EspecialesView();
				$this->view->actualizarDatos($_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'], $_SESSION['infoRecursos'][2]['produccion']);
	   		}
	        
	    }

	}
?>