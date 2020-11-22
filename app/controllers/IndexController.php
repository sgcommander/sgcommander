<?php
	/**
	 * Controlador de la pagina de inicio
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 27/01/2009
	 */

	

	/**
	 * Controlador de la pagina de inicio
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 27/01/2009
	 */
	class IndexController
	    extends ControllerBase
	{
	    /**
	     * Metodo que carga la pagina principal completa
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function index()
	    {
			//Creamos el centro
	        ob_start();
			$this->principal();
			$buffer = ob_get_contents();
	    	ob_clean();

	   		//Sacamos los datos de la raza
	   		$razaModel = new RazaModel();
	        $raza=$razaModel->raza($_SESSION['infoJugador']['idRaza']);

	        //Sacamos los datos del logotipo
	   		$logotipoModel = new LogotipoModel();
	        $logotipo=$logotipoModel->logotipo($_SESSION['infoJugador']['idLogotipo']);
	        
	        //Sacamos los recursos
	        $recursosModel = new RecursosModel();
	        
	        //Sacamos los nombres de los recursos y los almacenamos en sesion
	        $nombreRecursos=$recursosModel->nombreRecursos($_SESSION['infoJugador']['idRaza']);
	        foreach($nombreRecursos as $row)
	        	$_SESSION['infoRecursos'][($row['idTipoRecurso']-1)]['nombre']=$row['nombre'];
	        
	        //Sacamos la lista de planetas y el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   
	        $planetas=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);
	        
	  		//Almacenamos los datos del planeta seleccionado (El principal)
	  		$_SESSION['infoJugador']['planetaSel']=$planetas[0]['idPlaneta'];
	  		$_SESSION['infoJugador']['galaxiaSel']=$planetas[0]['idGalaxia'];
			$_SESSION['infoJugador']['galaxiasGalaxiaSel']=$planetas[0]['idGalaxia'];
			$_SESSION['infoJugador']['galaxiasSectorSel']=$planetas[0]['idSector'];
			$_SESSION['infoJugador']['galaxiasCuadranteSel']=$planetas[0]['idCuadrante'];
	        
	        //Sacamos los datos de construcciones
	        $naveModel = new NaveModel();
	        $soldadoModel = new SoldadoModel();
	        $defensaModel = new DefensaModel();
	        $consTropa=$soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);
	        $consNave=$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);
	        $consDefensa=$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);

			//Sacamos los mensajes nuevos
			$mensajesModel = new MensajesModel();
			$numMensajesNuevos=$mensajesModel->numMensajesNuevos($_SESSION['infoJugador']['idUsuario']);

	        //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->show($raza, $_SESSION['infoRecursos'], $planetas, $consTropa, $consNave, $consDefensa, $logotipo, $numMensajesNuevos,$buffer, $_SESSION['infoUnidades']['stargateIntergalactico'] );
	        
	    }

	    /**
	     * Devuelve los datos del planeta
	     * seleccionado actualmente
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function planetaDatos()
	    {
			//Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   
	   		if($planetaModel->planetaPropio($_REQUEST['idGalaxia'],$_REQUEST['idPlaneta'],$_SESSION['infoJugador']['idUsuario'])){
		    	$planeta=$planetaModel->planeta($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
		        
				//Guardamos el actual planeta seleccionado en session
		        $_SESSION['infoJugador']['planetaSel']=$_REQUEST['idPlaneta'];
		        $_SESSION['infoJugador']['galaxiaSel']=$_REQUEST['idGalaxia'];
		        
		        //Pasamos los datos a la vista
		        $this->view = new IndexView();
		        $this->view->planetaDatos($planeta);
	   		}
	        
	    }

	    /**
	     * Devuelve la  construccion actual de
	     *  en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function construccionPlaneta()
	    {
	        //Sacamos los datos de construcciones
	        $naveModel = new NaveModel();
	        $soldadoModel = new SoldadoModel();
	        $defensaModel = new DefensaModel();
	        $consTropa=$soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);
	        $consNave=$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);
	        $consDefensa=$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel']);
	        
	        //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->construccionPlaneta($consTropa, $consNave, $consDefensa);
	        
	    }

	    /**
	     * Devuelve la cantidad actual de recursos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function cantidad()
	    {
			//Sacamos los recursos
	        $recursosModel = new RecursosModel();
	        $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza']);
	        
	         //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->cantidad($recursos);
	        
	    }

	    /**
	     * Cambia el nombre a un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function cambiarNombre()
	    {
			//Sacamos el planeta seleccionado
	   		$planetaModel = new PlanetaModel();
	   		$planeta=$planetaModel->planeta($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
	   		$nombreSGC=$planeta['nombreSGC'];
	   		$nombre=$_REQUEST['nombre'];

	   		//Comprueba si el nombre respecta el maximo y minimo de caracteres, despues comrpeuba si el planeta el nuestro
	   		//y finalmente intenta cambiar el nomre. En caso de que se realice el cambio, se devuelve el nuevo nombre, en caso
	   		//contrario, se setea el viejo nombre
	   		if(!$planetaModel->planetaPropio($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $_SESSION['infoJugador']['idUsuario']) || !((mb_strlen($nombre, 'UTF-8') >= $_ENV['config']->get('minNomPlaneta')  && mb_strlen($nombre, 'UTF-8') <= $_ENV['config']->get('maxNomPlaneta')) || mb_strlen($nombre, 'UTF-8')==0)){
	       		$nombre=$planeta['nombrePlaneta'];
	       
	       		//Enviamos un error
	   			$this->view = new MensajeView();
	        	$this->view->error(_('El nombre no debe estar vacio y debe tener entre '.$_ENV['config']->get('minNomPlaneta').' y '.$_ENV['config']->get('maxNomPlaneta').' caracteres.'));
	   		}
	   		elseif($planetaModel->planetaEspecial($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'])){
	   			$nombre=$planeta['nombrePlaneta'];
	       
	       		//Enviamos un error
	   			$this->view = new MensajeView();
	        	$this->view->error(_('No puedes cambiar el nombre a un planeta especial.'));
	   		}
	   		else{
	   			if(!$planetaModel->cambiarNombre($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'], $nombre)){
	   				$nombre=$planeta['nombrePlaneta'];
	       
		       		//Enviamos un error
		   			$this->view = new MensajeView();
		        	$this->view->error(_('Se ha producido un error al cambiar el nombre del planeta.'));
	   			}
	   			else{
		   			//Pasamos los datos a la vista
		   			$this->view = new IndexView();
		        	$this->view->planetaCambiarNombre($nombre,$nombreSGC);
	   			}
	   		}
	        
	    }

	    /**
	     * Comprueba si hay mensajes nuevos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 03/12/2009
	     */
	    public function comprobarMensajes()
	    {
			//Sacamos los mensajes nuevos
			$mensajesModel = new MensajesModel();
			$numMensajesNuevos=$mensajesModel->numMensajesNuevos($_SESSION['infoJugador']['idUsuario']);

	        //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->comprobarMensajes($numMensajesNuevos);
	        
	        
	    }

	    /**
	     * Metodo que carga el modulo principal
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 05/02/2009
	     */
	    public function principal()
	    {	        
	        //Sacamos las estadisticas para el modulo principal
	        $estadisticasModel = new EstadisticasModel();
	        $estadisticas=$estadisticasModel->puntuaciones($_SESSION['infoJugador']['idUsuario']);
			$posicion=$estadisticasModel->posicion($_SESSION['infoJugador']['idUsuario'],$estadisticas['puntuacion']);

			//Sacamos la lista de planetas y sus construcciones y unidades
	   		$planetaModel = new PlanetaModel();
	   		$naveModel = new NaveModel();
	        $soldadoModel = new SoldadoModel();
	        $defensaModel = new DefensaModel();
	        $planetas=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);
	        $i=0;
	        foreach($planetas as $p){
	        	$consTropa[$i]=$soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$consNave[$i]=$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$consDefensa[$i]=$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$numSoldados[$i]=$planetaModel->numSoldados($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$numNaves[$i]=$planetaModel->numNaves($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$numDefensas[$i]=$planetaModel->numDefensas($_SESSION['infoJugador']['idUsuario'], $p['idGalaxia'], $p['idPlaneta']);
	        	$i++;
	        }

			//Sacamos la mejora actual
			$mejoraModel = new MejoraModel();
			$mejora=$mejoraModel->investigando($_SESSION['infoJugador']['idUsuario']);

	        //Sacamos las misiones del usuario
			$misionModel = new MisionModel();
			$misionesPropias=$misionModel->misionesPropias($_SESSION['infoJugador']['idUsuario']);
			$misionesAjenas=$misionModel->misionesAjenas($_SESSION['infoJugador']['idUsuario']);

			//Obtengo las unidades usadas en mision, en caso de que hayan
			//El parametro pasado son todos los ids de mision obtenidos en formato array
			if(!empty($misionesPropias) || !empty($misionesAjenas))
				$unidadesMision=$misionModel->unidades(array_merge(array_keys($misionesPropias), array_keys($misionesAjenas)));
			else
				$unidadesMision=Array();
				
			//Actualizamos los recursos
		    $recursosModel = new RecursosModel();
		    $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
				
			$this->view = new IndexView();
			$this->view->principal($estadisticas,$posicion,$misionesPropias,$misionesAjenas,$unidadesMision,$mejora,$planetas,$consTropa,$consNave,$consDefensa,$numSoldados,$numNaves,$numDefensas,$_SESSION['infoJugador']['idRaza'],$recursos,$_SESSION['infoJugador']['idAlianza']);
	        
	    }

	    /**
	     * Muestra la pantalla de cuenta en modo vacaciones.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function vacaciones()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->vacaciones($_SESSION['infoJugador']['vacaciones'],$_SESSION['infoJugador']['idRaza']);
	        
	    }

	    /**
	     * Muestra la pantalla de cuenta bloqueada.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function bloqueado()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new IndexView();
	        $this->view->bloqueado($_SESSION['infoJugador']['bloqueado'],$_SESSION['infoJugador']['idRaza']);
	        
	    }

	}
?>