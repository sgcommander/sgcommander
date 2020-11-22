<?php
	/**
	 * Controlador del modulo de recursos
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 12/02/2009
	 */
	
	
	
	/**
	 * Controlador del modulo de recursos
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 12/02/2009
	 */
	class RecursosController
	    extends ControllerBase
	{
	    /**
	     * Carga la página principal del modulo
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function recursos()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->info();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new RecursosView();
	        $this->view->show($buffer);
	        
	    }
	
	    /**
	     * Lista los comercios enviados y recibidos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function comercios()
	    {	
			//Creamos el modelo
	   		$comercioModel = new ComercioModel();
	   
	   		//Filtramos los comercios que superen las 24 horas
	   		$comercioModel->filtrarComercios();
	   
	   		//Sacamos los comercios
	   		$comerciosRecibidos=$comercioModel->comerciosRecibidos($_SESSION['infoJugador']['idUsuario']);
		    $comerciosEnviados=$comercioModel->comerciosEnviados($_SESSION['infoJugador']['idUsuario']);
	
		    //Pasamos los datos a la vista
		    $this->view = new RecursosView();
		    $this->view->comercios($comerciosRecibidos, $comerciosEnviados,$_SESSION['infoRecursos'][0]['nombre'],$_SESSION['infoRecursos'][1]['nombre'],$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Acepta un comercio que haya recibido el usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function aceptarComercio()
	    {	
			//Creamos el modelo
	   		$comercioModel = new ComercioModel();
	   		$recursosModel = new RecursosModel();
	   
	   		//Comprobamos los recursos de ambos jugadores
	   		$comercio=$comercioModel->comercio($_REQUEST['idComercio']);
	   
	   		$recursosPropios=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	   		$recursosEnvia=$recursosModel->recursos($comercio['idJugadorOrig']);
	   
	   		if($comercio['cantidadOfrecePri']>$recursosEnvia['0']['cantidad'] || $comercio['cantidadOfreceSec']>$recursosEnvia['1']['cantidad'])
	   			$mensaje=_('El usuario que ha enviado el comercio no tiene recursos para llevarlo a cabo');
	   		elseif($comercio['cantidadPidePri']>$recursosPropios['0']['cantidad'] || $comercio['cantidadPideSec']>$recursosPropios['1']['cantidad'])
	   			$mensaje=_('No tienes recursos para llevar a cabo el comercio');
	   		else{
		   		if($comercioModel->aceptarComercio($_REQUEST['idComercio'],$_SESSION['infoJugador']['idUsuario'])){
		   			$mensaje=_('El comercio ha sido aceptado');
		   
		   			//Enviamos mensajes de aviso del comercio
					$mensajesModel = new MensajesModel();
					$contenido=_('El usuario').' '.$_SESSION['infoJugador']['usuario'].' '._('ha aceptado tu oferta de comercio').'.';
					$mensajesModel->enviarSistema(Array($comercio['idJugadorOrig']),_('Comercio aceptado'),$contenido,MENSAJEAVISO);
		   		}
		   		else{
		   			$mensaje=_('Error al aceptar el comercio');
		   		}
	   		}
	
	   		//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Rechaza o cancela un comercio
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function rechazarComercio()
	    {
			//Sacamos el planeta seleccionado
	   		$comercioModel = new ComercioModel();
	   		$comercio=$comercioModel->comercio($_REQUEST['idComercio']);
	   
	   		$result=$comercioModel->borrarComercio($_REQUEST['idComercio'],$_SESSION['infoJugador']['idUsuario']);
		    if($result==false){
		    	$mensaje=_('Error al rechazar');
		    }
		    else{
		    	$mensaje=_('Comercio rechazado');
		    
		    	//Enviamos mensajes de aviso del comercio
				$mensajesModel = new MensajesModel();
				$contenido=_('El usuario').' '.$_SESSION['infoJugador']['usuario'].' '._('ha rechazado tu oferta de comercio').'.';
				$mensajesModel->enviarSistema(Array($comercio['idJugadorOrig']),_('Comercio rechazado'),$contenido,MENSAJEAVISO);
		    }
	
			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Intercambia recurso primario por secundario 
	     * o viceversa
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function intercambiar()
	    {	
			//Creamos el modelo
	   		$recursosModel = new RecursosModel();
	   
	   		if($_REQUEST['modo']==0)
	   			$modo=false;
	   		else
	   			$modo=true;
	   
	   		$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza']);
	   
	   		$error=true;
	   		if($_REQUEST['cantidad']=="")
				$mensaje=_('Cantidad no valida');
			elseif($_REQUEST['cantidad'] < 0 || !ctype_digit($_REQUEST['cantidad']))
				$mensaje=_('Cantidad no valida');
			elseif($_REQUEST['modo'] && $_REQUEST['cantidad'] > $recursos[0]['cantidad'])
				$mensaje=_('Te faltan recursos para aceptar el intercambio');
			elseif(!$_REQUEST['modo'] && $_REQUEST['cantidad'] > $recursos[1]['cantidad'])
				$mensaje=_('Te faltan recursos para aceptar el intercambio');
			else{
	   			if($recursos=$recursosModel->intercambiar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza'], $_REQUEST['cantidad'], $modo)){
					//Modificamos las cantidades de session
					if($modo){
			        	$idTipoRecursoRestar=0;
			        	$idTipoRecursoSumar=1;
			        }
			        else{
			        	$idTipoRecursoRestar=1;
			        	$idTipoRecursoSumar=0;
			        }
					$cantidad=$recursosModel->calcularIntercambio($_SESSION['infoJugador']['idRaza'], $modo, intval($_REQUEST['cantidad']));
	
					$_SESSION['infoRecursos'][$idTipoRecursoRestar]['cantidad']=$_SESSION['infoRecursos'][$idTipoRecursoRestar]['cantidad']-$_REQUEST['cantidad'];
					$_SESSION['infoRecursos'][$idTipoRecursoSumar]['cantidad']=$_SESSION['infoRecursos'][$idTipoRecursoSumar]['cantidad']+$cantidad;
	
					$mensaje=_('Intercambio realizado');
	   				$error=false;
	   			}
	   			else
	   				$mensaje=_('Error');
	    	}
		    //Pasamos los datos a la vista
		    $this->view = new MensajeView();
			if($error)
				$this->view->error($mensaje);
			else
		    	$this->view->info($mensaje);
	        
	    }
	
	    /**
	     * Muestra informacion sobre los recursos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function info()
	    {
	        
		    //Pasamos los datos a la vista
		    $this->view = new RecursosView();
		    $this->view->info($_SESSION['infoRecursos'],$_SESSION['infoUnidades'],$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Muestra el formulario para enviar nuevos comercios
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/02/2010
	     */
	    public function nuevoComercio()
	    {
	        
	        //Comprobamos los parametros
	    	if(!array_key_exists('destino',$_REQUEST) || empty($_REQUEST['destino']))
				$_REQUEST['destino']='';
	
	        //Pasamos los datos a la vista
	        $this->view = new RecursosView();
	        $this->view->nuevoComercio($_REQUEST['destino'],$_REQUEST['idDestino'],$_SESSION['infoRecursos'][0]['nombre'],$_SESSION['infoRecursos'][1]['nombre']);
	        
	    }
	
	    /**
	     * Envia un comercio a un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/02/2010
	     */
	    public function enviarComercio()
	    {
	        //Creamos el modelo
	    	$comercioModel = new ComercioModel();
	    
	    	//Comporbamos si las razas son compatibles
	    	$comercioPosible=$comercioModel->comercioPosible($_SESSION['infoJugador']['idRaza'],array($_REQUEST['destino']));
	
	        //Las cantidades nulas las ponemos a 0
	        if(empty($_REQUEST['primarioOfreces']))
	        	$_REQUEST['primarioOfreces']=0;
	        if(empty($_REQUEST['secundarioOfreces']))
	        	$_REQUEST['secundarioOfreces']=0;
	        if(empty($_REQUEST['primarioPides']))
	        	$_REQUEST['primarioPides']=0;
	        if(empty($_REQUEST['secundarioPides']))
	        	$_REQUEST['secundarioPides']=0;
	    
	        //Comprobamos los parametros
	    	if($_REQUEST['primarioOfreces']=='0' && $_REQUEST['secundarioOfreces']=='0' && $_REQUEST['primarioPides']=='0' && $_REQUEST['secundarioPides']=='0')
	    		$mensaje=_('Todas las cantidades no pueden ser 0');
	    	elseif((!ctype_digit($_REQUEST['primarioOfreces']) && $_REQUEST['primarioOfreces']!='0') || (!ctype_digit($_REQUEST['secundarioOfreces']) && $_REQUEST['secundarioOfreces']!='0') || (!ctype_digit($_REQUEST['primarioPides']) && $_REQUEST['primarioPides']!='0') || (!ctype_digit($_REQUEST['secundarioPides']) && $_REQUEST['secundarioPides']!='0'))
	    		$mensaje=_('Las cantidades son incorrectas');
	    	elseif(empty($_REQUEST['destino']))
				$mensaje=_('Destino no v&#225;lido');
			elseif($_REQUEST['destino']==$_SESSION['infoJugador']['idUsuario'])
				$mensaje=_('No puedes enviarte comercios a ti mismo');
			elseif(!$comercioPosible[$_REQUEST['destino']])
				$mensaje=_('No puedes enviar un comercio a ese usuario');
	    	else{
		    	$result=$comercioModel->enviarComercio($_SESSION['infoJugador']['idUsuario'],$_REQUEST['destino'],$_REQUEST['primarioOfreces'],$_REQUEST['secundarioOfreces'],$_REQUEST['primarioPides'],$_REQUEST['secundarioPides']);
			    if($result==false){
			    	$mensaje=_('Error al enviar');
			    }
			    else{
			    	$mensaje=_('Comercio enviado');
			    
			    	//Enviamos mensajes de aviso del comercio
					$mensajesModel = new MensajesModel();
					$contenido=_('El usuario').' '.$_SESSION['infoJugador']['usuario'].' '._('te ha ofrecido un comercio').'.';
					$mensajesModel->enviarSistema(Array($_REQUEST['destino']),_('Nueva oferta de comercio'),$contenido,MENSAJEAVISO);
			    }
	    	}
	    
			//Pasamos los datos a la vista
		    $this->view = new MensajeView();
			$this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Cancela un comercio enviado por el usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/02/2009
	     */
	    public function cancelarComercio()
	    {
			//Sacamos el planeta seleccionado
	   		$comercioModel = new ComercioModel();
	   
	   		$result=$comercioModel->borrarComercio($_REQUEST['idComercio'],$_SESSION['infoJugador']['idUsuario']);
		    if($result==false){
		    	$mensaje=_('Error al cancelar');
		    }
		    else{
		    	$mensaje=_('Comercio cancelado');
		    }
	
			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	}
?>