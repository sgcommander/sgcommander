<?php
	/**
	 * Contorlador de alianza
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 29/01/2010
	 */

	

	/**
	 * Contorlador de alianza
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 29/01/2010
	 */
	class AlianzaController
	    extends ControllerBase
	{
	    /**
	     * Muestra la pagina principal del modulo
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function alianza()
	    {
	        
	        //Creamos el modelo
	   		$alianzaModel = new AlianzaModel();
	   
	   		if($_SESSION['infoJugador']['idAlianza']==null){
	   			$tieneAlianza=false;
	   			$esLider=false;
	   
	   			//Creamos la primera pestana
		        ob_start();
				$this->buscador();
				$buffer = ob_get_contents();
		    	ob_clean();
	   		}
	   		else{
	   			$tieneAlianza=true;
	   			$esLider=$alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario']);
	   
	   			//Creamos la primera pestana
		        ob_start();
				$this->tuAlianza();
				$buffer = ob_get_contents();
		    	ob_clean();
	   		}
	   
	        //Pasamos los datos a la vista
	        $this->view = new AlianzaView();
	        $this->view->alianza($tieneAlianza,$esLider,$buffer);
	        
	    }

	    /**
	     * Muestra el formulario de busqueda de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscador()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new AlianzaView();
	        $this->view->buscador($_SESSION['infoJugador']['idRaza']);
	        
	    }

	    /**
	     * Muestra la pantalla principal de tu alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function tuAlianza()
	    {
	        
	        //Comprobamos que se tiene alianza
	    	if($_SESSION['infoJugador']['idAlianza']!=null){
		        //Creamos el modelo
		   		$alianzaModel = new AlianzaModel();
		   
		   		//Sacamos los datos de la alianza
		   		$alianza=$alianzaModel->alianza($_SESSION['infoJugador']['idAlianza']);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->tuAlianza($alianza['titulo'], $alianza['imagen'], $alianza['texto'], $alianza['foro']);
	    	}
	        
	    }

	    /**
	     * Muestra los miembros de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function miembros()
	    {
	        
	    	//Comprobamos que se tiene alianza
	    	if($_SESSION['infoJugador']['idAlianza']!=null){
		        //Creamos los modelo
		   		$alianzaModel = new AlianzaModel();
	        	$comercioModel=new ComercioModel();
		   
		   		//Compobamos los parametros
				if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
					$_REQUEST['inicio']=0;

				$cantidadPag=50;

				//Sacamos los miembros de la alianza
		   		$miembros=$alianzaModel->miembros($_SESSION['infoJugador']['idAlianza'],$_REQUEST['inicio'],$cantidadPag);
		   		$numMiembros=$alianzaModel->numMiembros($_SESSION['infoJugador']['idAlianza']);
		   
		   		//Comprobamos si se es el lider de la alianza
		   		$esLider=$alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario']);
		   
		   		//Sacamos los datos de comercio
		   		$idJugador=array();
				foreach($miembros as $usuario)
					$idJugador[count($idJugador)]=$usuario['id'];
				$comercioPosible=$comercioModel->comercioPosible($_SESSION['infoJugador']['idRaza'],$idJugador);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->miembros($miembros,$cantidadPag,$numMiembros,($_REQUEST['inicio']/$cantidadPag)+1,$esLider,$_SESSION['infoJugador']['idUsuario'],$comercioPosible,$_SESSION['infoJugador']['idRaza']);
	    	}
	        
	    }

	    /**
	     * Busca entre las alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscar()
	    {
	        
	        $alianzas=Array();
	    	if($_REQUEST['buscado']!=""){
		        //Creamos el modelo
		   		$alianzaModel = new AlianzaModel();
		   
		   		//Sacamos los planetas segun criterio
		   		switch($_REQUEST['busqueda']){
		   			case 2:
		   				$alianzas=$alianzaModel->buscarPropietario($_REQUEST['buscado']);
		   				break;
		   			default:
		   				$alianzas=$alianzaModel->buscarNombre($_REQUEST['buscado']);
		   				break;
		   		}
	        }
	        //Pasamos los datos a la vista
	        $this->view = new AlianzaView();
	        $this->view->buscar($alianzas,$_SESSION['infoJugador']['idRaza']);
	        
	    }

	    /**
	     * Muestra el formulario para cambiar los datos
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function datos()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
		   		//Sacamos los datos de la alianza
		   		$alianza=$alianzaModel->alianza($_SESSION['infoJugador']['idAlianza']);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->datos($alianza['titulo'], $alianza['imagen'], $alianza['texto'], $alianza['foro']);
	    	}
	        
	    }

	    /**
	     * Actualiza los datos de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function cambiarDatos()
	    {
	        
	        //Creamos el modelo
	   		$alianzaModel = new AlianzaModel();
	   
	   		//Comprobamos los parametros
	   		//IMAGEN
	   		if(empty($_REQUEST['imagen']) || !array_key_exists('imagen',$_REQUEST))
	   			$_REQUEST['imagen']='';
	   		else{
	    		//Comprobamos si la url del foro lleva el http://, en caso de no ser asi, se la anyade
	   			if(strtolower(substr($_REQUEST['imagen'], 0, 7))!='http://'){
	   				$_REQUEST['imagen']='http://'.$_REQUEST['imagen'];
	   			}
	   		}
	   
	   		//FORO
	   		if(empty($_REQUEST['foro']) || !array_key_exists('foro',$_REQUEST))
	   			$_REQUEST['foro']='';
	   		else{
	    		//Comprobamos si la url del foro lleva el http://, en caso de no ser asi, se la anyade
	   			if(strtolower(substr($_REQUEST['foro'], 0, 7))!='http://'){
	   				$_REQUEST['foro']='http://'.$_REQUEST['foro'];
	   			}
	   		}
	   
	   		if($_SESSION['infoJugador']['idAlianza']==null || !$alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
	   			$mensaje=_('No eres l&#237;der de una alianza');
	   		}
	   		elseif(empty($_REQUEST['titulo']) || $_REQUEST['titulo']=='' || mb_strlen($_REQUEST['titulo'], 'UTF-8') > $_ENV['config']->get('maxNomAlianza') || mb_strlen($_REQUEST['titulo'], 'UTF-8') < $_ENV['config']->get('minNomAlianza')){
		    	$mensaje=_('El t&#237;tulo no es correcto');
		    }
	    	elseif(!preg_match("/^[[:alnum:][:space:]]+$/", $_REQUEST['titulo'])){
	   			$mensaje=_('El t&#237;tulo contiene caracteres no permitidos');
	   		}
		    elseif(mb_strlen($_REQUEST['imagen'], 'UTF-8')>255){
		    	$mensaje=_('La URL de la imagen no es correcta');
		    }
		    elseif(mb_strlen($_REQUEST['foro'], 'UTF-8')>255){
		    	$mensaje=_('La URL del foro/web no es correcta');
		    }
	   		elseif(empty($_REQUEST['texto']) || $_REQUEST['texto']==''){
		    	$mensaje=_('El texto no es correcto');
		    }
	   		else{   
	   			$result=$alianzaModel->cambiarDatos($_SESSION['infoJugador']['idAlianza'],trim($_REQUEST['titulo']),$_REQUEST['imagen'],nl2br($_REQUEST['texto']),$_REQUEST['foro']);
		    	if($result!=true){
		    		$mensaje=_('Error al cambiar los datos');
		    	}
		    	else{
		    		$mensaje=_('Datos cambiados con &#233;xito');
		    	}
	    	}

			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }

	    /**
	     * Acepta una solicitud
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function aceptarSolicitud()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
	    		$result=$alianzaModel->aceptarSolicitud($_REQUEST['idJugador'],$_SESSION['infoJugador']['idAlianza']);
		    	if($result!=true)
		    		$mensaje=_('Error al aceptar la solicitud de entrada');
		    	else{
		    		$mensaje=_('Solicitud de entrada aceptada');
		    		
		    		//Enviamos mensajes de aviso
			    	$mensajesModel = new MensajesModel();
			    	$alianza=$alianzaModel->alianza($_SESSION['infoJugador']['idAlianza']);
			    	$contenido=_('Tu solicitud de entrada para la alianza').' '.$alianza['titulo'].' '._('ha sido aceptada.');
			    	$mensajesModel->enviarSistema(Array($_REQUEST['idJugador']),_('Solicitud aceptada'),$contenido,MENSAJEALIANZA);
			    
			    	$miembros=$alianzaModel->miembros($_SESSION['infoJugador']['idAlianza'],0,$alianzaModel->numMiembros($_SESSION['infoJugador']['idAlianza']));
			    	$idMiembros=Array();
					foreach($miembros as $miembro){
					 	//El nuevo lider y el actual no reciben el mensaje
					   	if($miembro['id']!=$_SESSION['infoJugador']['idUsuario'] && $miembro['id']!=$_REQUEST['idJugador'])
					   		$idMiembros[]=$miembro['id'];
					   	//Sacamos el nombre del nuevo lider
					   	if($miembro['id']==$_REQUEST['idJugador'])
					   		$nuevo=$miembro['usuario'];
					}
					//Si hay que mandar el mensaje al resto
					if(count($idMiembros)>0){
						$contenido=$nuevo.' '._('se ha unido a la alianza.');
						$mensajesModel->enviarSistema($idMiembros,_('Nuevo miembro'),$contenido,MENSAJEALIANZA);
					}
	
					//Pasamos los datos a la vista
			        $this->view = new MensajeView();
			        $this->view->mensaje($mensaje);
		    	}
	    	}
	        
	    }

	    /**
	     * Rechaza una solicitud de entrada
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function rechazarSolicitud()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
		   		$result=$alianzaModel->rechazarSolicitud($_SESSION['infoJugador']['idAlianza'],$_REQUEST['idJugador']);
		    	if($result!=true)
		    		$mensaje=_('Error al rechazar la solicitud de entrada');
		    	else{
		    		$mensaje=_('Solicitud de entrada rechazada');
		    
		    		//Enviamos mensajes de aviso
			    	$mensajesModel = new MensajesModel();
			    	$alianza=$alianzaModel->alianza($_SESSION['infoJugador']['idAlianza']);
			    	$contenido=_('Tu solicitud de entrada para la alianza').' '.$alianza['titulo'].' '._('ha sido rechazada.');
			    	$mensajesModel->enviarSistema(Array($_REQUEST['idJugador']),_('Solicitud rechazada'),$contenido,MENSAJEALIANZA);
		    	}

				//Pasamos los datos a la vista
		        $this->view = new MensajeView();
		        $this->view->mensaje($mensaje);
	    	}
	        
	    }

	    /**
	     * Envia una solicitud a una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function enviarSolicitud()
	    {
	        
	        //Creamos el modelo
	   		$alianzaModel = new AlianzaModel();
	   
	   		//Comprobamos los parametros
	   		if(empty($_REQUEST['mensaje']) || !array_key_exists('mensaje',$_REQUEST))
	   			$_REQUEST['mensaje']='';
	   
	   		if($_SESSION['infoJugador']['idAlianza']!=null){
	   			$mensaje=_('Ya perteneces a una alianza');
	   		}
	   		elseif($alianzaModel->yaSolicitado($_SESSION['infoJugador']['idUsuario'], $_REQUEST['idAlianza'])){
	   			$mensaje=_('Ya has enviado una solicitud de entrada a esta alianza');
	   		}
	   		else{
	   			$result=$alianzaModel->enviarSolicitud($_REQUEST['idAlianza'],$_SESSION['infoJugador']['idUsuario'],nl2br($_REQUEST['mensaje']));
		    	if($result!=true){
		    		$mensaje=_('Error al enviar la solicitud de entrada');
		    	}
		    	else{
		    		$mensaje=_('Solicitud de entrada enviada con &#233;xito');
		    
		    		//Enviamos mensajes de aviso
			    	$mensajesModel = new MensajesModel();
			    	$alianza=$alianzaModel->alianza($_REQUEST['idAlianza']);
			    	$contenido=_('Tienes una nueva solicitud de entrada a la alianza');
			    	$mensajesModel->enviarSistema(Array($alianza['idFundador']),_('Nueva solicitud entrada'),$contenido,MENSAJEALIANZA);
		    	}
	    	}

			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }

	    /**
	     * Expulsa a un jugador de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function expulsar()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider o que estamos intentando abandonar la alianza y no somos el lider
	        $esLider = $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario']);
	    	if($_SESSION['infoJugador']['idAlianza']!=null && ($esLider==($_REQUEST['idJugador']!=$_SESSION['infoJugador']['idUsuario']))){
		   		//Guardamos los datos de la alianza antes de quitar al jugador
	    		$miembros=$alianzaModel->miembros($_SESSION['infoJugador']['idAlianza'],0,$alianzaModel->numMiembros($_SESSION['infoJugador']['idAlianza']));
				$idMiembros=Array();
	    		foreach($miembros as $miembro){
				 	//El nuevo lider y el jugador actual no reciben el mensaje
				   	if($miembro['id']!=$_SESSION['infoJugador']['idUsuario'] && $miembro['id']!=$_REQUEST['idJugador'])
				   		$idMiembros[]=$miembro['id'];
				   	//Sacamos el nombre del expulsado
				   	if($miembro['id']==$_REQUEST['idJugador'])
				   		$expulsado=$miembro['usuario'];
				}

				//Eliminamos al jugador
	    		$result=$alianzaModel->expulsar($_REQUEST['idJugador'],$_SESSION['infoJugador']['idAlianza']);
		    	if($result!=true)
		    		$mensaje=_('Error al expulsar al jugador');
		    	else{
		    		$mensaje=_('El jugador ya no pertenece a la alianza');
		    
		    		//Enviamos mensajes de aviso
				    $mensajesModel = new MensajesModel();
				    
		    		//Si estamos intentando abandonar la alianza actualizamos la session
		    		if($_REQUEST['idJugador']==$_SESSION['infoJugador']['idUsuario']){
		    			$_SESSION['infoJugador']['idAlianza']=null;
		    			$asunto=_('Abandono de alianza');
		    		}
		    		else{
				    	$contenido=_('Has sido expulsado de tu alianza.');
				    	$mensajesModel->enviarSistema(Array($_REQUEST['idJugador']),_('Expulsi&#243;n de alianza'),$contenido,MENSAJEALIANZA);
				    	$asunto=_('Expulsi&#243;n de alianza');
		    		}

		    		//Si hay usuarios para recibir el mensaje
		    		if(count($idMiembros)>0){
						$contenido=$expulsado.' '._('ya no pertenece a la alianza.');
						$mensajesModel->enviarSistema($idMiembros,$asunto,$contenido,MENSAJEALIANZA);
		    		}
		    	}

				//Pasamos los datos a la vista
		        $this->view = new MensajeView();
		        $this->view->mensaje($mensaje);
	    	}	        
	    }

	    /**
	     * Borra una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function borrar()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
		   		//Guardamos los datos de la alianza antes de borrarla
	    		$miembros=$alianzaModel->miembros($_SESSION['infoJugador']['idAlianza'],0,$alianzaModel->numMiembros($_SESSION['infoJugador']['idAlianza']));
				$idMiembros=Array();
	    		foreach($miembros as $miembro){
				 	//El lider no recibe el mensaje
				   	if($miembro['id']!=$_SESSION['infoJugador']['idUsuario'])
				   		$idMiembros[]=$miembro['id'];
				}
				//Borramos la alianza
	    		$result=$alianzaModel->borrar($_SESSION['infoJugador']['idAlianza']);
		    	if($result!=true)
		    		$mensaje=_('Error al eliminar la alianza');
		    	else{
		    		$mensaje=_('Alianza eliminada con &#233;xito');
		    
		    		//Actualizamos la session
		    		$_SESSION['infoJugador']['idAlianza']=null;
		    
		    		//Enviamos mensajes de aviso
		    		//Si hay usuarios para recibir el mensaje
		    		if(count($idMiembros)>0){
				    	$mensajesModel = new MensajesModel();
						$contenido=_('Tu alianza ha sido borrada, ya no perteneces a ninguna alianza.');
						$mensajesModel->enviarSistema($idMiembros,_('Alianza borrada'),$contenido,MENSAJEALIANZA);
		    		}
		    	}
		    
				//Pasamos los datos a la vista
		        $this->view = new MensajeView();
		        $this->view->mensaje($mensaje);
	    	}
	        
	    }

	    /**
	     * Formulario para crear una nueva alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function crear()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new AlianzaView();
	        $this->view->crear();
	        
	    }

	    /**
	     * Crea una nueva alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function enviarDatos()
	    {
	        
	        //Creamos el modelo
	   		$alianzaModel = new AlianzaModel();
	   
	   		//Comprobamos los parametros
	   		//IMAGEN
	   		if(empty($_REQUEST['imagen']) || !array_key_exists('imagen',$_REQUEST))
	   			$_REQUEST['imagen']='';
	   		else{
	    		//Comprobamos si la url del foro lleva el http://, en caso de no ser asi, se la anyade
	   			if(strtolower(substr($_REQUEST['imagen'], 0, 7))!='http://'){
	   				$_REQUEST['imagen']='http://'.$_REQUEST['imagen'];
	   			}
	   		}
	   
	   		//FORO
	   		if(empty($_REQUEST['foro']) || !array_key_exists('foro',$_REQUEST))
	   			$_REQUEST['foro']='';
	   		else{
	    		//Comprobamos si la url del foro lleva el http://, en caso de no ser asi, se la anyade
	   			if(strtolower(substr($_REQUEST['foro'], 0, 7))!='http://'){
	   				$_REQUEST['foro']='http://'.$_REQUEST['foro'];
	   			}
	   		}
	   		
	    	if($alianzaModel->existeAlianza($_REQUEST['titulo'])){
	   			$mensaje=_('Ya existe una alianza con ese nombre');
	   		}
	   		elseif($_SESSION['infoJugador']['idAlianza']!=null){
	   			$mensaje=_('Ya perteneces a una alianza, debes abandonarla antes de crear una');
	   		}
	   		elseif(empty($_REQUEST['titulo']) || $_REQUEST['titulo']=='' || mb_strlen($_REQUEST['titulo'], 'UTF-8') > $_ENV['config']->get('maxNomAlianza') || mb_strlen($_REQUEST['titulo'], 'UTF-8') < $_ENV['config']->get('minNomAlianza')){
		    	$mensaje=_('El t&#237;tulo no es correcto');
		    }
	    	elseif(!preg_match("/^[[:alnum:][:space:]]+$/", $_REQUEST['titulo'])){
	   			$mensaje=_('El t&#237;tulo contiene caracteres no permitidos');
	   		}
		    elseif(mb_strlen($_REQUEST['imagen'], 'UTF-8')>255){
		    	$mensaje=_('La URL de la imagen no es correcta');
		    }
		    elseif(mb_strlen($_REQUEST['foro'], 'UTF-8')>255){
		    	$mensaje=_('La URL del foro/web no es correcta');
		    }
	   		elseif(empty($_REQUEST['texto']) || $_REQUEST['texto']==''){
		    	$mensaje=_('El texto no es correcto');
		    }
	   		else{
	   			$result=$alianzaModel->enviarDatos($_SESSION['infoJugador']['idUsuario'],trim($_REQUEST['titulo']),$_REQUEST['imagen'],nl2br($_REQUEST['texto']),$_REQUEST['foro']);
		    	if($result==null)
		    		$mensaje=_('Error al crear');
		    	else{
		    		$mensaje=_('Alianza creada con &#233;xito');
		    		//Actualizamos la session
		    		$_SESSION['infoJugador']['idAlianza']=$result;
		    	}
	    	}

			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }

	    /**
	     * Cambia el lider de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function cambiarLider()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider y el jugador que recibe el liderazgo no es el lider,ni es el mismo actual y si pertenece a la alianza
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['idJugador']!=$_SESSION['infoJugador']['idUsuario'] && $alianzaModel->perteneceAlianza($_SESSION['infoJugador']['idAlianza'],$_REQUEST['idJugador'])){
		   		$result=$alianzaModel->cambiarLider($_SESSION['infoJugador']['idAlianza'],$_REQUEST['idJugador']);
		    	if($result!=true)
		    		$mensaje=_('Error al ceder el liderazgo');
		    	else{
		    		$mensaje=_('Has cedido el liderazgo al jugador');
		    
		    		//Enviamos mensajes de aviso al nuevo lider y al resto de la alianza
				    $mensajesModel = new MensajesModel();
				    $contenido=_('Ahora eres el lider de la alianza.');
				    $mensajesModel->enviarSistema(Array($_REQUEST['idJugador']),_('Cambio de liderazgo'),$contenido,MENSAJEALIANZA);
				    
				    $miembros=$alianzaModel->miembros($_SESSION['infoJugador']['idAlianza'],0,$alianzaModel->numMiembros($_SESSION['infoJugador']['idAlianza']));
				    $idMiembros=Array();
				    foreach($miembros as $miembro){
				    	//El nuevo lider y el actual no reciben el mensaje
				    	if($miembro['id']!=$_SESSION['infoJugador']['idUsuario'] && $miembro['id']!=$_REQUEST['idJugador'])
				    		$idMiembros[]=$miembro['id'];
				    	//Sacamos el nombre del nuevo lider
				    	if($miembro['id']==$_REQUEST['idJugador'])
				    		$nuevoLider=$miembro['usuario'];
				    }
				    //Si hay usuarios para recibir el mensaje
		    		if(count($idMiembros)>0){
					    $contenido=$nuevoLider.' '._('es el nuevo lider de la alianza.');
					    $mensajesModel->enviarSistema($idMiembros,_('Cambio de liderazgo'),$contenido,MENSAJEALIANZA);
		    		}    
		    	}

				//Pasamos los datos a la vista
		        $this->view = new MensajeView();
		        $this->view->mensaje($mensaje);
	    	}
	        
	    }

	    /**
	     * Devuelve las solicitudes pendientes de
	     * la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 06/02/2010
	     */
	    public function solicitudes()
	    {
	        
	    	//Creamos el modelo
		   	$alianzaModel = new AlianzaModel();
		   
	        //Comprobamos que se tiene alianza y se es el lider
	    	if($_SESSION['infoJugador']['idAlianza']!=null && $alianzaModel->esLider($_SESSION['infoJugador']['idAlianza'],$_SESSION['infoJugador']['idUsuario'])){
	    		//Sacamos las solicitudes de la alianza
		   		$solicitudes=$alianzaModel->solicitudes($_SESSION['infoJugador']['idAlianza']);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->solicitudes($solicitudes,$_SESSION['infoJugador']['idRaza']);
	    	}
	        
	    }

	    /**
	     * Muestra la pagina principal para ver otra
	     * alianza.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/04/2010
	     */
	    public function verAlianza()
	    {
	        
	    	//Comprobamos que se tiene alianza
	     	if($_SESSION['infoJugador']['idAlianza']!=null && $_REQUEST['idAlianza']!=null && $_SESSION['infoJugador']['idAlianza']==$_REQUEST['idAlianza']){
	     		//Si la alianza es la propia mostramos la pagina de nuestra alianza
	     		$this->alianza();
	     	}
	     	else{
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        
		        //Creamos la primera pestana
		        ob_start();
				$this->otraAlianza();
				$buffer = ob_get_contents();
		    	ob_clean();
		    
		        $this->view->verAlianza($_REQUEST['idAlianza'],$buffer);
	     	}
	        
	    }

	    /**
	     * Muestra la pagina de inicio de otra alianza.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/04/2010
	     */
	    public function otraAlianza()
	    {
	        
	     	//Comprobamos que se tiene alianza
	    	if($_REQUEST['idAlianza']!=null){
		        //Creamos el modelo
		   		$alianzaModel = new AlianzaModel();
		   
		   		//Sacamos los datos de la alianza
		   		$alianza=$alianzaModel->alianza($_REQUEST['idAlianza']);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->tuAlianza($alianza['titulo'], $alianza['imagen'], $alianza['texto'], $alianza['foro']);
	    	}
	        
	    }

	    /**
	     * Muestra los miembros de otra alianza.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/04/2010
	     */
	    public function otraMiembros()
	    {
	        
	    	//Comprobamos que se tiene alianza
	    	if($_REQUEST['idAlianza']!=null){
		        //Creamos el modelo
		   		$alianzaModel = new AlianzaModel();
		   
		   		//Compobamos los parametros
				if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
					$_REQUEST['inicio']=0;

				$cantidadPag=50;

				//Sacamos los miembros de la alianza
		   		$miembros=$alianzaModel->miembros($_REQUEST['idAlianza'],$_REQUEST['inicio'],$cantidadPag);
		   		$numMiembros=$alianzaModel->numMiembros($_REQUEST['idAlianza']);
		   
		        //Pasamos los datos a la vista
		        $this->view = new AlianzaView();
		        $this->view->otraMiembros($miembros,$_REQUEST['idAlianza'],$cantidadPag,$numMiembros,($_REQUEST['inicio']/$cantidadPag)+1);
	    	}
	        
	    }

	}
?>