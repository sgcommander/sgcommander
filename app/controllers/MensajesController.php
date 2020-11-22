<?php
	/**
	 * Controlador de la mensajeria
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 18/02/2009
	 */
	
	
	
	/**
	 * Controlador de la mensajeria
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 18/02/2009
	 */
	class MensajesController
	    extends ControllerBase
	{
	    /**
	     * Muestra el modulo mensajes
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function mensajes()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->show();
	        
	    }
	
	    /**
	     * Lista la entrada de mensajes de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function entrada(){
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
			//Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=10;
	
			$mensajes=$mensajesModel->entrada($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
			$numMensajes=$mensajesModel->numMensajes($_SESSION['infoJugador']['idUsuario']);
			
			//Tratamos la cadena del asunto para que se ajuste al numero de caracteres deseados
			foreach($mensajes AS &$mensaje){
				$longitud = mb_strlen($mensaje['asunto'], 'UTF-8');
				
				//Recorto la caedena
				$mensaje['asunto'] = $this->substrXHTML($mensaje['asunto'], 30);
				
				//si la cadena ha sido recortada, anyado los puntos suspensivos
				if($longitud != mb_strlen($mensaje['asunto'], 'UTF-8')){
					$mensaje['asunto'].='...';
				}
				
			}
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->entrada($mensajes,$cantidadPag,$numMensajes,($_REQUEST['inicio']/$cantidadPag)+1);
	        
	    }
	
	    /**
	     * Muestra un mensaje
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function mensaje()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
			$mensaje=$mensajesModel->mensaje($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
	
			//Lo marcamos como leido
			$mensajesModel->marcarLeidos($_SESSION['infoJugador']['idUsuario'],array($_REQUEST['idMensaje']),1);
	
			//Tratamos la cadena del asunto para que se ajuste al numero de caracteres deseados
			$mensaje['asunto'] = $this->substrXHTML($mensaje['asunto'], $_ENV['config']->get('longitudAsuntoMensajeRecortar'));
			
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Muestra el formulario de escribir mensajes
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function escribir()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
	   		//Si hemos pasado un id sacamos el contenido para reenviar
	   		if(array_key_exists('idMensaje',$_REQUEST) && !empty($_REQUEST['idMensaje'])){
	   			$mensaje=$mensajesModel->mensaje($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
	   			$_REQUEST['contenido']=$mensaje['contenido'];
	   		}
	   
	   		//Compobamos los parametros
			if(!array_key_exists('asunto',$_REQUEST) || empty($_REQUEST['asunto']))
				$_REQUEST['asunto']='';
			if(!array_key_exists('contenido',$_REQUEST) || empty($_REQUEST['contenido']))
				$_REQUEST['contenido']='';
			if(!array_key_exists('destino',$_REQUEST) || empty($_REQUEST['destino']))
				$_REQUEST['destino']='';
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->escribir($_REQUEST['asunto'],$_REQUEST['contenido'],$_REQUEST['destino']);
	        
	    }
	
	    /**
	     * Envia un mensaje
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function enviar()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	   
	   		//Sacamos los destinatarios
	   		if(array_key_exists('destinatarios',$_REQUEST) || empty($_REQUEST['destinatarios'])){
		    	$destinatarios=explode(',',$_REQUEST['destinatarios']);
		    
		    	//Limpio los posibles espacios en blanco al principio y final del nombre
		    	$destinatarios=array_map('trim', $destinatarios);
		    }
		    
		    //Comprobamos los parametros
		    if($mensajesModel->ultimoEnvio($_SESSION['infoJugador']['idUsuario'])<15){
		    	//Evitamos el flood
		    	$mensaje=_('No se permiten tantos mensajes seguidos');
		    }
			elseif(count($destinatarios)==0 || empty($_REQUEST['destinatarios']) || !$mensajesModel->destinatariosValidos($destinatarios)){
		    	$mensaje=_('Los destinatarios no son correctos');
		    }
	   		elseif(empty($_REQUEST['asunto']) || $_REQUEST['asunto']=='' || mb_strlen($_REQUEST['asunto'], 'UTF-8')>255){
		    	$mensaje=_('El asunto no es correcto');
		    }
	   		elseif(empty($_REQUEST['contenido']) || $_REQUEST['contenido']==''){
		    	$mensaje=_('El contenido no es correcto');
		    }
	   		else{
	   			$result=$mensajesModel->enviar($_SESSION['infoJugador']['idUsuario'],$destinatarios, $_REQUEST['asunto'], $_REQUEST['contenido']);
		    	if($result==false){
		    		$mensaje=_('Error al enviar');
		    	}
		    	else{
		    		$mensaje=_('Mensaje enviado con &#233;xito');
		    	}
	    	}
	
			//Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje);
	        
	    }
	
	    /**
	     * Borra mensajes
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function borrar()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
			if(isset($_REQUEST['idMensaje'])){
		   		//Procesamos los datos si no son una matriz
		   		if(!is_array($_REQUEST['idMensaje']))
		   			$_REQUEST['idMensaje']=array($_REQUEST['idMensaje']);
	
				$mensajesModel->borrar($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idMensaje']);
			}
	
	        //Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=10;
	
			$mensajes=$mensajesModel->entrada($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
			$numMensajes=$mensajesModel->numMensajes($_SESSION['infoJugador']['idUsuario']);
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->entrada($mensajes,$cantidadPag,$numMensajes,($_REQUEST['inicio']/$cantidadPag)+1);
	        
	    }
	    
		/**
	     * Borra todos los mensajes
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function borrarTodos()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
			$mensajesModel->borrarTodos($_SESSION['infoJugador']['idUsuario']);
	
	        //Compobamos los parametros
			if(empty($_REQUEST['inicio']) || $_REQUEST['inicio']=='')
				$_REQUEST['inicio']=0;
	
			$cantidadPag=10;
	
			$mensajes=$mensajesModel->entrada($_SESSION['infoJugador']['idUsuario'],$_REQUEST['inicio'],$cantidadPag);
			$numMensajes=$mensajesModel->numMensajes($_SESSION['infoJugador']['idUsuario']);
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->entrada($mensajes,$cantidadPag,$numMensajes,($_REQUEST['inicio']/$cantidadPag)+1);
	        
	    }
	
	    /**
	     * Muestra un reporte de mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function reporte()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	
			$mensaje=$mensajesModel->reporte($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
	
			//Lo marcamos como leido
			$mensajesModel->marcarLeidos($_SESSION['infoJugador']['idUsuario'],array($_REQUEST['idMensaje']),1);
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->reporte($mensaje);
	        
	    }
	
	    /**
	     * Muestra un reporte de batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function batalla()
	    {
			//Creamos el modelo
	   		$mensajesModel = new MensajesModel();
	   		$planetaModel = new PlanetaModel();
	
			$jugadores=$mensajesModel->batallaJugadores($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
			$unidadesIniciales=$mensajesModel->batallaUnidadesIniciales($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
			$unidadesAtacadas=$mensajesModel->batallaUnidadesAtacadas($_REQUEST['idMensaje'],$_SESSION['infoJugador']['idUsuario']);
			$planetaBatalla=$mensajesModel->batallaPlaneta($_REQUEST['idMensaje']);
			$planeta=$planetaModel->planeta($planetaBatalla['idGalaxia'], $planetaBatalla['idPlaneta'], $_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idAlianza']);
	
			//Lo marcamos como leido
			$mensajesModel->marcarLeidos($_SESSION['infoJugador']['idUsuario'],array($_REQUEST['idMensaje']),1);
	
			//Pasamos los datos a la vista
	        $this->view = new MensajesView();
	        $this->view->batalla($jugadores,$unidadesIniciales,$unidadesAtacadas,$planeta);
	        
	    }
	    
	    //Recota una string a una longitud determinada, teniendo en cuenta las entidades XHTML (&#999;) como un solo caracter 
	    private function substrXHTML($cadena, $longitud){
	    	//Obtengo los 15 primeros caracteres de la cadena, teniendo en cuenta los caracteres codificados
	        $longitudAsunto=mb_strlen($cadena, 'UTF-8');
	        
	        //Si la longitud esta por debajo del minimo, ya no hace falta tratarla
	        if($longitudAsunto > $longitud){
	        	$aux = '';
	        	$res = '';
	        	$numLetras = 0;
	        	$estado = 0;
		        for($i=0; $i<$longitudAsunto; $i++){
		        	//Guardo el caracter actual
		        	$caracter = substr($cadena,$i,1);
		        	$aux.= $caracter; //Lo acumulo
		        			        	
		        	switch($estado){
		        		case 0:
		        			if($caracter!='&'){
		        				$numLetras+=mb_strlen($aux, 'UTF-8');
		        				$res.=$aux;
		        				$aux='';
		        				$estado = 0;
		        			}
		        			else{
		        				$estado = 1;
		        			}
		        			break;
		        		case 1:
		        			if($caracter != '#'){
		        				$numLetras+=mb_strlen($aux, 'UTF-8');
		        				$res.=$aux;
		        				$aux='';
		        				$estado = 0;
		        			}
		        			else{
		        				$estado = 2;
		        			}
		        			break;
		        		case 2:
		        			if($caracter >= '0' && $caracter <= '9'){
		        				$estado = 2;
		        			}
		        			elseif($caracter == ';'){
		        				$numLetras++;
		        				$res.=$aux;
		        				$aux='';
		        				$estado = 0;
		        			}
		        			else{
		        				$numLetras+=mb_strlen($aux, 'UTF-8');
		        				$res.=$aux;
		        				$aux='';
		        				$estado = 0;
		        			}
		        			break;
		        	}
		        	
		        	//Si tengo ya los quince caracteres, los copio y salgo del bucle
		        	if($numLetras == $longitud){
		        		$cadena=$res;
		        		unset($aux);
		        		unset($res);
		        		break;
		        	}
		        }
	        }
	        
	        return $cadena;
	    }
	
	}
?>