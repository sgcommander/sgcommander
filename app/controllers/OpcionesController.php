<?php
	/**
	 * Controlador de opciones
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 28/09/2009
	 */
	
	
	
	/**
	 * Controlador de opciones
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 28/09/2009
	 */
	class OpcionesController
	    extends ControllerBase
	{
	    /**
	     * Menu de opciones
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function opciones()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->datos();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new OpcionesView();
	        $this->view->show($buffer);
	        
	    }
	
	    /**
	     * Opciones de datos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function datos()
	    {
	        
	        //Creamos el modelo
	   		$opcionesModel = new OpcionesModel();
	   
	   		$email=$opcionesModel->email($_SESSION['infoJugador']['idUsuario']);
	   		
	   		$idiomas=$opcionesModel->idiomas();
	   
	        //Pasamos los datos a la vista
	        $this->view = new OpcionesView();
	        $this->view->datos($_SESSION['infoJugador'],$email,$idiomas);
	        
	    }
	
	    /**
	     * Muestra las opciones de personalizacion
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function personalizar()
	    {
	        
	        //Creamos el modelo
	   		$logotipoModel = new LogotipoModel();
	   		$firmaModel = new FirmaModel();
	   
	   		$logotipos=$logotipoModel->logotipos($_SESSION['infoJugador']['idRaza']);
	   		$firmas=$firmaModel->firmas($_SESSION['infoJugador']['idRaza']);
	   
	        //Pasamos los datos a la vista
	        $this->view = new OpcionesView();
	        $this->view->personalizar($logotipos,$firmas,$_SESSION['infoJugador']['idLogotipo'],$_SESSION['infoJugador']['idFirma'],$_SESSION['infoJugador']['idUsuario']);
	        
	    }
	
	    /**
	     * Actualiza los datos de usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function cambiarDatos()
	    {
	        
	        //Creamos el modelo
	   		$opcionesModel = new OpcionesModel();
	   
	   		$error=true;
	   
	   		if(empty($_REQUEST['pass']))
	   			$_REQUEST['pass']='';
	   
	   		if($_REQUEST['email']=="")
				$mensaje=_('Email no v&#225;lido');
			elseif($_REQUEST['pass']!='' && (mb_strlen($_REQUEST['pass'], 'UTF-8')>$_ENV['config']->get('maxPass') || mb_strlen($_REQUEST['pass'], 'UTF-8')<$_ENV['config']->get('minPass')))
				$mensaje=_('Contrase&#241;a no v&#225;lida, debe tener entre '.$_ENV['config']->get('minPass').' y '.$_ENV['config']->get('maxPass').' car&#225;cteres.');
			elseif($_REQUEST['pass']!='' && $_REQUEST['pass']!=$_REQUEST['pass2'])
				$mensaje=_('Las contrase&#241;as son diferentes');
			else{
		   		if($opcionesModel->cambiarDatos($_SESSION['infoJugador']['idUsuario'],$_REQUEST['pass'],$_REQUEST['email'])){
		   			$mensaje=_('Datos cambiados');
		   			$error=false;
		   		}
		   		else
		   			$mensaje=_('Error');
			}
	    
		    //Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	    
		/**
	     * Cambia el idioma del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function cambiarIdioma()
	    {
	        
	        //Creamos el modelo
	   		$opcionesModel = new OpcionesModel();
	   
	   		$error=true;
	   		if($_REQUEST['idioma']=="")
				$mensaje=_('Idioma no v&#225;lido');
			else{
		   		if($opcionesModel->cambiarIdioma($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idioma'])){
		   			$mensaje=_('Idioma cambiado, desconecte y vuelva a conectar para aplicar los cambios.');
		   			$error=false;
		   		}
		   		else
		   			$mensaje=_('Error');
			}
	    
		    //Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Activa el modo vacaciones
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function vacaciones()
	    {
	        //Creamos el modelo
	   		$opcionesModel = new OpcionesModel();
	   		$mejoraModel = new MejoraModel();
	   		$misionModel = new MisionModel();
	   		$planetaModel = new PlanetaModel();
	   		$soldadoModel = new SoldadoModel();
	   		$naveModel = new NaveModel();
	   		$defensaModel = new DefensaModel();
	   
	   		//Comprobamos las construcciones
	   		$construyendo=false;
	   		$planetas=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);
	   		foreach($planetas as $p){
	   			if($soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$p['idGalaxia'],$p['idPlaneta'])!=null ||
	   			$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$p['idGalaxia'],$p['idPlaneta'])!=null || 
	   			$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$p['idGalaxia'],$p['idPlaneta'])!=null)
	   				$construyendo=true;
	   		}
	   
	   		//Comprobamos si te est�n conquistando
	   		$conquistando=false;
	   		$misiones=$misionModel->misionesAjenas($_SESSION['infoJugador']['idUsuario']);
	    	foreach($misiones as $m){
	   			if($m['idTipoMision']==CONQUISTAR)
	   				$conquistando=true;
	   		}
	   
	   		if($mejoraModel->mejoraActual($_SESSION['infoJugador']['idUsuario'])){
	   			//Comprobamos las investigaciones
	   			$mensaje=_('No puede activar el modo vacaciones si tiene alguna investigaci&#243;n en curso, cancele la investigaci&#243;n antes de activar el modo vacaciones');
	   		}
	   		elseif(count($misionModel->misionesPropias($_SESSION['infoJugador']['idUsuario']))){
	   			//Comprobamos las misiones propias
	   			$mensaje=_('No puede activar el modo vacaciones si tiene alguna misi&#243;n en curso, cancele las misiones antes de activar el modo vacaciones');
	   		}
	   		elseif($construyendo){
	   			$mensaje=_('No puede activar el modo vacaciones si tiene alguna construcci&#243;n en curso, cancele las construcciones antes de activar el modo vacaciones');
	   		}
	    	elseif($conquistando){
	   			$mensaje=_('No puede activar el modo vacaciones si le est&#225;n conquistando, abandone el planeta antes de activar el modo vacaciones');
	   		}
	   		else{
		   		if($opcionesModel->vacaciones($_SESSION['infoJugador']['idUsuario'])){
		   			$mensaje=_('Modo vacaciones activado');
		   			//Destruimos el array de la sesion
					unset($_SESSION);
					//Eliminamos la session con todos sus datos
					session_destroy();
			   		$error=false;
			   	}
			   	else
			   		$mensaje=_('Error');
	   		}
	   
	   		//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Borra la cuenta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function borrar()
	    {
	        
	        //Creamos el modelo
	   		$opcionesModel = new OpcionesModel();
	   
	   		if($opcionesModel->borrar($_SESSION['infoJugador']['idUsuario'], $_ENV['config']->get('firmaJugadorImgFolder').$_SESSION['infoJugador']['idUsuario'].'.jpg')){
	   			$mensaje=_('Cuenta borrada');
		   		$error=false;
		   
		   		//Destruimos el array de la sesion
				unset($_SESSION);
				//Eliminamos la session con todos sus datos
				session_destroy();
		   	}
		   	else
		   		$mensaje=_('Error');
	   
	   		//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Short description of method cambiarLogotipo
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @return mixed
	     */
	    public function cambiarLogotipo()
	    {
	        
	        //Creamos el modelo
	   		$logotipoModel = new LogotipoModel();
	   
	   		$error=true;
	   		//Comprobamos la raza
	   		$logotipo=$logotipoModel->logotipo($_REQUEST['idLogotipo']);
	   
	   		if($logotipo['idRaza']==$_SESSION['infoJugador']['idRaza'] && $logotipoModel->cambiarLogotipo($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idLogotipo'])){
				//Modificamos la session
				$_SESSION['infoJugador']['idLogotipo']=$_REQUEST['idLogotipo'];
	   
				$mensaje=_('Logotipo cambiado');
	   			$error=false;
	   		}
	   		else
	   			$mensaje=_('Error');
	    
		    //Pasamos los datos a la vista
		    $this->view = new MensajeView();
			if($error)
				$this->view->error($mensaje);
			else
		    	$this->view->info($mensaje);
	        
	    }
	
	    /**
	     * Short description of method cambiarFirma
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @return mixed
	     */
	    public function cambiarFirma()
	    {
	        
	        //Creamos el modelo
	   		$firmaModel = new FirmaModel();
	   
	   		$error=true;
	   		//Comprobamos la raza
	   		$firma=$firmaModel->firma($_REQUEST['idFirma']);
	   
	   		if($firma['idRaza']==$_SESSION['infoJugador']['idRaza'] && $firmaModel->cambiarFirma($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idFirma'])){
				//Modificamos la session
				$_SESSION['infoJugador']['idFirma']=$_REQUEST['idFirma'];
	   
				$mensaje=_('Firma cambiada');
	   			$error=false;
	   
	   			//Generamos la firma
	   			$firma=new Firma();
	        	$firma->generar($_SESSION['infoJugador']['idUsuario']);
	   		}
	   		else
	   			$mensaje=_('Error');
	    
		    //Pasamos los datos a la vista
		    $this->view = new MensajeView();
			if($error)
				$this->view->error($mensaje);
			else
		    	$this->view->info($mensaje);
	        
	    }
	
	    /**
	     * Muestra como quedaria la firma
	     * de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 03/07/2010
	     */
	    public function verFirma()
	    {
	        
	        $firma=new Firma();
	        $firma->mostrar($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idFirma']);
	        
	    }
	
	    /**
	     * Sale del modo vacaciones
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function quitarVacaciones()
	    {
	    	$tiempo=new DateTime($_SESSION['infoJugador']['vacaciones']);
			$actual=new DateTime();
			//Si la fecha de terminar es menor que la actual
			if($tiempo < $actual){
		        //Creamos el modelo
		   		$opcionesModel = new OpcionesModel();
		   
		   		if($opcionesModel->quitarVacaciones($_SESSION['infoJugador']['idUsuario'])){
		   			$_SESSION['infoJugador']['vacaciones']=null;
			   	}
			}
			
			$this->executeController('Index', 'index');
	    }
	    
	    /**
	     * Activa o desactiva la proteccion de IP
	     * sobre la cuenta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 14/01/2011
	     */
	    public function proteccionIP()
	    {
	    	//Creamos el modelo
	    	$opcionesModel = new OpcionesModel();
	    	
	    	//Cambio la proteccion IP "1 -> 0" o "0 -> 1", segun convenga tanto en la bd como en session
	    	$opcionesModel->cambiarProteccionIP($_SESSION['infoJugador']['idUsuario']);
	    	$_SESSION['infoJugador']['proteccionIP'] = !$_SESSION['infoJugador']['proteccionIP'];
	    }
	
	}
?>