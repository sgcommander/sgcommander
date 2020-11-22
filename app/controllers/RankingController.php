<?php
	/**
	 * Controlador del modulo del ranking
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 12/08/2009
	 */
	
	
	
	/**
	 * Controlador del modulo del ranking
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 12/08/2009
	 */
	class RankingController
	    extends ControllerBase
	{
	    /**
	     * Muestra las pestañas del ranking
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function ranking()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->usuarios();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new RankingView();
	        $this->view->ranking($buffer);
	        
	    }
	
	    /**
	     * Muestra el ranking de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function usuarios()
	    {
	        $rankingModel=new RankingModel();
	        $comercioModel=new ComercioModel();
	        
	        //Compobamos los parametros
	        if(empty($_REQUEST['tipoPuntuacion']) || $_REQUEST['tipoPuntuacion']=='')
				$_REQUEST['tipoPuntuacion']='total';
	
			$cantidadPag=$_ENV['config']->get('rankingUsuariosNumPag');
			//Si no se especifica una pagina enviamos a la actual del jugador
			if(!array_key_exists('inicio',$_REQUEST) || !is_numeric($_REQUEST['inicio'])){
				if($_REQUEST['tipoPuntuacion']=='naves')
			       	$puntuacion=$_SESSION['infoPuntuacion']['puntosNaves'];
			    elseif($_REQUEST['tipoPuntuacion']=='tropas')
			     	$puntuacion=$_SESSION['infoPuntuacion']['puntosSoldados'];
			    elseif($_REQUEST['tipoPuntuacion']=='defensas')
			       	$puntuacion=$_SESSION['infoPuntuacion']['puntosDefensas'];
			    elseif($_REQUEST['tipoPuntuacion']=='investigacion')
			       	$puntuacion=$_SESSION['infoPuntuacion']['puntosTecnologias'];
			    else
			       	$puntuacion=$_SESSION['infoPuntuacion']['puntosTotales'];
			       
				$estadisticasModel = new EstadisticasModel();
				$posicion=$estadisticasModel->posicion($_SESSION['infoJugador']['idUsuario'],$puntuacion,$_REQUEST['tipoPuntuacion']);
	
				$_REQUEST['inicio']=(intval(($posicion-1)/$cantidadPag))*$cantidadPag;
			}
	
			//Sacamos los datos
			$usuarios=$rankingModel->usuarios($_REQUEST['inicio'],$cantidadPag,$_SESSION['infoPuntuacion']['puntosTotales'],$_REQUEST['tipoPuntuacion']);
			$idJugador=array();
			foreach($usuarios as $usuario)
				$idJugador[count($idJugador)]=$usuario['id'];
			$numUsuarios=$rankingModel->numUsuarios();
			$comercioPosible=$comercioModel->comercioPosible($_SESSION['infoJugador']['idRaza'],$idJugador);
	
	        //Pasamos los datos a la vista
		    $this->view = new RankingView();
		    $this->view->usuarios($usuarios,$cantidadPag,$numUsuarios,($_REQUEST['inicio']/$cantidadPag)+1,$_REQUEST['tipoPuntuacion'],$_SESSION['infoJugador']['idUsuario'],$comercioPosible,$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Muestra el ranking de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function alianzas()
	    {
	        
	         //Incluimos el modelo
	        $rankingModel=new RankingModel();
	        
	        //Compobamos los parametros
	        if(empty($_REQUEST['tipoPuntuacion']) || $_REQUEST['tipoPuntuacion']=='')
				$_REQUEST['tipoPuntuacion']='media';
	
			$cantidadPag=$_ENV['config']->get('rankingAlianzasNumPag');
	
			//Si no se especifica una pagina enviamos a la actual de la alianza
			if(!array_key_exists('inicio',$_REQUEST) || !is_numeric($_REQUEST['inicio'])){
				//TODO Descomentar esto cuando se implemente un metodo de puntuacion de alianza y se desnormalice la puntuacion de estas
				/*if($_SESSION['infoJugador']['idAlianza']){
					$estadisticasModel = new EstadisticasModel();
					$alianzaModel = new AlianzaModel();
		
					$puntuacion=$alianzaModel->puntuacion($_SESSION['infoJugador']['idAlianza'], $_REQUEST['tipoPuntuacion']);
					$posicion=$estadisticasModel->posicion($_SESSION['infoJugador']['idUsuario'],$puntuacion,$_REQUEST['tipoPuntuacion']);
		
					$_REQUEST['inicio']=(intval(($posicion-1)/$cantidadPag))*$cantidadPag;
				}
				else{*/
					$_REQUEST['inicio']=0;
				//}
			}
	
			//Sacamos los datos
			$alianzas=$rankingModel->alianzas($_REQUEST['inicio'],$cantidadPag,$_REQUEST['tipoPuntuacion']);
			$numAlianzas=$rankingModel->numAlianzas();
	
	        //Pasamos los datos a la vista
		    $this->view = new RankingView();
		    $this->view->alianzas($alianzas,$cantidadPag,$numAlianzas,($_REQUEST['inicio']/$cantidadPag)+1,$_REQUEST['tipoPuntuacion'],$_SESSION['infoJugador']['idAlianza']);
	        
	    }
	
	    /**
	     * Muestra el buscador de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/08/2010
	     */
	    public function buscador()
	    {
	        
	        //Pasamos los datos a la vista
	        $this->view = new RankingView();
	        $this->view->buscador($_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Muestra los resultados de la busqueda
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer
	     * @return mixed
	     * @since 29/08/2010
	     */
	    public function buscar()
	    {
	        
	        $usuarios=Array();
	    	if($_REQUEST['buscado']!=""){
	    		//Creamos el modelo
		   		$rankingModel = new RankingModel();
		   		$comercioModel=new ComercioModel();
		   
		   		//Sacamos los usuarios segun criterio
		   		$usuarios=$rankingModel->buscar($_REQUEST['buscado']);
		   
		   		//Comprobamos el comercio
		   		$idJugador=array();
				foreach($usuarios as $usuario)
					$idJugador[count($idJugador)]=$usuario['id'];
		   		$comercioPosible=$comercioModel->comercioPosible($_SESSION['infoJugador']['idRaza'],$idJugador);
	
	        }
	        //Pasamos los datos a la vista
	        $this->view = new RankingView();
	        $this->view->buscar($usuarios,$comercioPosible,$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	}
?>