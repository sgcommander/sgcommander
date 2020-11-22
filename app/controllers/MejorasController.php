<?php
	/**
	 * Controlador de mejoras
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 15/04/2009
	 */

	

	/**
	 * Controlador de mejoras
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 15/04/2009
	 */
	class MejorasController
	    extends ControllerBase
	{
	    /**
	     * Muestra el modulo de mejoras
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function mejoras()
	    {
	        
	        //Creamos el modelo
	   		$mejoraModel = new MejoraModel();
	   
	   		$grupos=$mejoraModel->grupos($_SESSION['infoJugador']['idRaza']);
	   
	   		//Creamos la primera pestana
	        ob_start();
	        $_REQUEST['idGrupo']=$grupos[0]['id'];
			$this->mejorasLista();
			$buffer = ob_get_contents();
	    	ob_clean();
	   
	        //Pasamos los datos a la vista
	        $this->view = new MejorasView();
	        $this->view->mejoras($grupos,$buffer);
	        
	    }

	    /**
	     * Muestra las una lista de mejoras de un grupo
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function mejorasLista()
	    {
	        
			//Creamos el modelo
	   		$mejoraModel = new MejoraModel();
	   		$recursosModel = new RecursosModel();
	   
	   		//Obtengo el listado de mejoras para la raza del jugador, correspondiente al grupo elegido
	   		if(!array_key_exists('idGrupo',$_REQUEST) || empty($_REQUEST['idGrupo'])){
	   			$_REQUEST['idGrupo']=1;
	   		}
		    $mejoras=$mejoraModel->mejoras($_SESSION['infoJugador']['idRaza'],$_REQUEST['idGrupo']);
		    
		    $i=0;
		    foreach($mejoras as $datos){
		    	$idMejoras[$i]=$datos['id'];
		    	$i++;
		    }
		    
		    //Si se han encontrado mejoras
		    if(isset($idMejoras)){
			    
		    	//Obtenemos los niveles de las mejoras
			    $niveles=$mejoraModel->nivel($idMejoras,$_SESSION['infoJugador']['idUsuario']);

			    //Obtenemos si se esta realizando alguna mejora en este instante
				$mejoraActual=$mejoraModel->mejoraActual($_SESSION['infoJugador']['idUsuario']);

				//Si se esta investigando algo, se calcula el tiempo en finalizar
				if($mejoraActual)
					$tiempoRestante=$mejoraModel->tiempoRestante($_SESSION['infoJugador']['idUsuario']);
				//Sino, el tiempo en finalizar de nada es 0
				else
					$tiempoRestante=0;

				//Mejoras que aportan las mejoras
				$mejorasMejora=$mejoraModel->mejorasMejora($idMejoras,$_SESSION['infoJugador']['idRaza']);

				//Nivel a partir del cual se optiene el viaje intergalactico
				$nivelMinimoHiperpropulsion=$mejoraModel->nivelMinimoIntergalactico($_SESSION['infoJugador']['idRaza']);

				//Indica la cantidad en que se aumenta el limite de soldados cada vez, que se investiga la mejora correspondiente
				$aumentoLimiteSoldados=$mejoraModel->aumentoLimiteSoldados($_SESSION['infoJugador']['idRaza']);

				//Indica la cantidad en que se aumenta el limite de misiones cada vez, que se investiga la mejora correspondiente
				$aumentoLimiteMisiones=$mejoraModel->aumentoLimiteMisiones($_SESSION['infoJugador']['idRaza']);

				//Recursos
				$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
				
			    //Pasamos los datos a la vista
			    $this->view = new MejorasView();
			    $this->view->mejorasLista($mejoras,$niveles,$_SESSION['infoRecursos'],$mejoraActual,$tiempoRestante,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['investigacionVelocidad'],$mejorasMejora,$nivelMinimoHiperpropulsion,$aumentoLimiteSoldados,$aumentoLimiteMisiones,$recursos);
		    }
	        
	    }

	    /**
	     * Investiga una mejora
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function investigar()
	    {
	        
	        //Creamos el modelo
	   		$mejoraModel = new MejoraModel();
	   		$res=$mejoraModel->investigar($_REQUEST['idMejora'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza']);
	        if($res==true){
	        	$tiempo=$mejoraModel->tiempoRestante($_SESSION['infoJugador']['idUsuario']);
	        
	        	$recursosModel = new RecursosModel();
	        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	        
		        //Pasamos los datos a la vista
			    $this->view = new MejorasView();
			    $this->view->investigar($tiempo,$recursos);
	        }
	        else{
		        //Pasamos los datos a la vista
			    $this->view = new MensajeView();
			    $this->view->error('Error al intentar investigar la mejora.');
	        }
	        
	    }

	    /**
	     * Cancela la investigacion de una mejora
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function cancelar()
	    {
	        
	        $mejoraModel = new MejoraModel();
	   		$res=$mejoraModel->cancelar($_SESSION['infoJugador']['idUsuario']);
	   
	   		if($res==true){
	        	$this->executeController('Mejoras', 'mejorasLista');
	        } 
	    }

	}
?>