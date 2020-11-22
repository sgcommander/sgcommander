<?php
	/**
	 * Controlador del modulo de misiones
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 03/09/2009
	 */
	
	
	
	/**
	 * Controlador del modulo de misiones
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 03/09/2009
	 */
	class MisionesController
	    extends ControllerBase
	{
	    /**
	     * Muestra los datos de un planeta de destino
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 03/09/2009
	     */
	    public function planeta()
	    {	
			$planetaModel = new PlanetaModel();
	   		$planeta=$planetaModel->planeta($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
	   
	   		//Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->planeta($planeta);
	        
	    }
	    
		/**
	     * Muestra los datos de un planeta de destino para una nueva mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 03/09/2009
	     */
	    public function planetaNueva()
	    {	
			$planetaModel = new PlanetaModel();
	   		$planeta=$planetaModel->planeta($_REQUEST['idGalaxia'], $_REQUEST['idPlaneta'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
	   
	   		$misionModel = new MisionModel();
	   		$tipo = $misionModel->misionTipo($_REQUEST['idMision']);
	   		
	   		//Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->planetaNueva($planeta,$tipo);
	        
	    }
	
	    /**
	     * Pone una misión en regreso.
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 05/11/2009
	     */
	    public function regresar()
	    {
			//Creamos el modelo
	   		$misionModel = new MisionModel();
	
			$misionModel->regresar($_SESSION['infoJugador']['idUsuario'],$_REQUEST['idMision']);
	        
	    }
	
	    /**
	     * Cambia el destino de una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function nueva()
	    {
			//Creamos el modelo
	   		$misionModel = new MisionModel();
	   		$planetaModel = new PlanetaModel();
	   
	   		$mensaje='';
	   
	   		//Sacamos los datos de la mision original
	   		$mision=$misionModel->datosMision($_REQUEST['idMision']);
	   
	   		//Validamos los valores
	        $velocidades=array(10,20,30,40,50,60,70,80,90,100);
	        
	        //Comprobamos que la misiónde origen sea correcta
	        if(!$mision['vuelta'] && $mision['idTipoMision']==DESPLEGAR && $mision['tiempo']<0){
	        	if(!$mision['nuevaMision']){
			        //Comprobamos la velocidad
			        if(in_array($_REQUEST['velocidad'],$velocidades)){
			        	//Validamos que el destino sea diferente del origen porque eso es regresar
						if($mision['idGalaxiaOrigen']!=$_REQUEST['galaxiaDestino'] || $mision['idPlanetaOrigen']!=$_REQUEST['planetaDestino']){
							//Sacamos las unidades de la mision
							$unidades=$misionModel->unidadesMision($_REQUEST['idMision']);
							$idUnidades=array();
							$cantidad=array();
							foreach($unidades as $unidad){
								$idUnidades[count($idUnidades)]=$unidad['idUnidad'];
								$cantidad[count($cantidad)]=$unidad['cantidadActual'];
							}
			
							//Segun el tipo de mision calculamos el tiempo
							$tipo = $misionModel->misionTipo($_REQUEST['idMision']);
							switch($tipo){
								case NAVE:
									//Creamos el modelo
								   	$naveModel = new NaveModel();
								   	 
			        				//Comprobamos si se viajara por el stargate
			        				$stargate=$naveModel->viajanStargate($mision['idGalaxiaDestino'],$_REQUEST['galaxiaDestino'],$_SESSION['infoUnidades']['stargateIntergalactico'],$idUnidades);
			        
						        	//Validamos que el usuario pueda hacer viajes interestelares
							   		if(($_REQUEST['galaxiaDestino']==$mision['idGalaxiaDestino']) || 
							   			(!$stargate && $_SESSION['infoUnidades']['viajeIntergalactico']) || ($stargate && $_SESSION['infoUnidades']['stargateIntergalactico'])
							   		){
							   			//Validamos el destino y el tipo de mision
										if(
										($planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && 
											(
												($planetaModel->planetaNeutral($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && ($_REQUEST['tipoMision']==RECOLECTAR || $_REQUEST['tipoMision']==ESTABLECERBASE || $_REQUEST['tipoMision']==DESPLEGAR)) ||
												($planetaModel->planetaEnemigo($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) && ($_REQUEST['tipoMision']==ATACAR || $_REQUEST['tipoMision']==DESPLEGAR || ($_REQUEST['tipoMision']==CONQUISTAR && $_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil') && !$planetaModel->planetaPrincipal($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'])))) ||
												(($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) || $planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza'])) && ($_REQUEST['tipoMision']==CONTRATACAR || $_REQUEST['tipoMision']==DESPLEGAR)) ||
												(!$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && ($_REQUEST['tipoMision']==EXPLORAR || $_REQUEST['tipoMision']==DESPLEGAR)))
											)
										){
											//Comprobamos si las unidades chocan contra una defensa de stargate
											if(!$stargate || !$misionModel->defensaStargate($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) || 
												$_SESSION['infoUnidades']['atraviesaIris'] ||
												$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) ||
												$planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) || 
												($misionModel->propietarioDebil($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && $_ENV['config']->get('puntuacionDebil') <= $_SESSION['infoPuntuacion']['puntosTecnologias'])
											){
												//Calculamos el tiempo de la mision hasta aqui
										   		$tiempo1 = $naveModel->tiempoMision($mision['idGalaxiaDestino'],$mision['idPlanetaDestino'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$idUnidades,$_SESSION['infoUnidades']['navesVelocidad'],$_REQUEST['velocidad'],$_SESSION['infoUnidades']['stargateIntergalactico']);
										  
										   		//Calculamos el tiempo de la mision al nuevo planeta
										   		$tiempo2 = $naveModel->tiempoMision($mision['idGalaxiaOrigen'],$mision['idPlanetaOrigen'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$idUnidades,$_SESSION['infoUnidades']['navesVelocidad'],$_REQUEST['velocidad'],$_SESSION['infoUnidades']['stargateIntergalactico']);
			
										   		//Insertamos la mision
										   		$misionModel->nueva($_REQUEST['idMision'],$_SESSION['infoJugador']['idUsuario'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$tiempo1, $tiempo2);
											}
											else{
												//Eliminamos la mision
												$misionModel->eliminarMision($_REQUEST['idMision'], $_SESSION['infoJugador']['idUsuario']);
			
												//Comprobamos si son especiale sapra desactivar triggers
					   							$especial=$naveModel->unidadDeEspecial($idUnidades);
					   
												//Eliminamos las unidades
												for($i=0;$i<count($idUnidades);$i++){
										   			//Actualizo la variable referente al numero de soldados del entorno si es necesario
										   			if(!$especial[$idUnidades[$i]])
									        			$_SESSION['infoUnidades']['numNaves'] -= $cantidad[$i];
										   		}
										   
												//Marcamos el planeta como explorado
										   		$planeta=$planetaModel->planeta($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
										   
												//Enviamos mensajes de aviso de la muerte de las unidades
										    	$mensajesModel = new MensajesModel();
										    	if($planeta['nombrePlaneta']!='')
										    		$nombrePlaneta=$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')';
												else
													$nombrePlaneta=$planeta['nombreSGC'];
										    	$contenido=_('Tus naves han sido eliminadas por una defensa de stargate al cruzar hacia el planeta').' '.$nombrePlaneta.'.';
										    	$mensajesModel->enviarSistema(Array($_SESSION['infoJugador']['idUsuario']),_('Perdida de naves'),$contenido,MENSAJEAVISO);
											}
										}
										else
											$mensaje=_('No puedes realizar este tipo de misi&#243;n con estas naves');
							   		}
							   		else
							   			$mensaje=_('No puedes realizar viajes intergal&#225;cticos con estas naves');
									break;
								case SOLDADO:
									//Creamos el modelo
								   	$soldadoModel = new SoldadoModel();
								   
									//Validamos que el usuario pueda hacer viajes interestelares
						   			if(($_REQUEST['galaxiaDestino']==$mision['idGalaxiaDestino']) || $_SESSION['infoUnidades']['stargateIntergalactico']){
						        		//Validamos el destino y el tipo de mision
										if(
										($planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && 
											(
												($planetaModel->planetaNeutral($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && ($_REQUEST['tipoMision']==RECOLECTAR || $_REQUEST['tipoMision']==ESTABLECERBASE || $_REQUEST['tipoMision']==DESPLEGAR)) ||
												($planetaModel->planetaEnemigo($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) && ($_REQUEST['tipoMision']==ATACAR || $_REQUEST['tipoMision']==DESPLEGAR || ($_REQUEST['tipoMision']==CONQUISTAR && $_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil') && !$planetaModel->planetaPrincipal($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'])))) ||
												(($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) || $planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza'])) && ($_REQUEST['tipoMision']==CONTRATACAR || $_REQUEST['tipoMision']==DESPLEGAR)) ||
												(!$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && (($_REQUEST['tipoMision']==EXPLORAR && $soldadoModel->exploradores($idUnidades)) || $_REQUEST['tipoMision']==DESPLEGAR)))
											)
										){
											//Comprobamos si las unidades chocan contra una defensa de stargate
											if(!$misionModel->defensaStargate($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) || 
												$_SESSION['infoUnidades']['atraviesaIris'] ||
												$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) ||
												$planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) || 
												($misionModel->propietarioDebil($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && $_ENV['config']->get('puntuacionDebil') <= $_SESSION['infoPuntuacion']['puntosTecnologias'])
											){
										   		//Calculamos el tiempo de la mision
								   				$tiempo = $soldadoModel->tiempoMision($_REQUEST['tipoMision'],$_REQUEST['velocidad']);
			
								   				//Insertamos la mision
								   				$misionModel->nueva($_REQUEST['idMision'],$_SESSION['infoJugador']['idUsuario'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$tiempo,$tiempo);
											}
											else{
												//Eliminamos la mision
												$misionModel->eliminarMision($_REQUEST['idMision'], $_SESSION['infoJugador']['idUsuario']);
			
												//Comprobamos si son especiale sapra desactivar triggers
					   							$especial=$soldadoModel->unidadDeEspecial($idUnidades);
					   
												//Eliminamos las unidades
												for($i=0;$i<count($idUnidades);$i++){
										   			//Actualizo la variable referente al numero de soldados del entorno si es necesario
										   			if(!$especial[$idUnidades[$i]])
									        			$_SESSION['infoUnidades']['numSoldados'] -= $cantidad[$i];
										   		}
										   
										   		//Marcamos el planeta como explorado
										   		$planeta=$planetaModel->planeta($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
										   
												//Enviamos mensajes de aviso de la muerte de las unidades
										    	$mensajesModel = new MensajesModel();
										    	if($planeta['nombrePlaneta']!='')
										    		$nombrePlaneta=$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')';
												else
													$nombrePlaneta=$planeta['nombreSGC'];
										    	$contenido=_('Tus tropas han sido eliminadas por una defensa de stargate al cruzar hacia el planeta').' '.$nombrePlaneta.'.';
										    	$mensajesModel->enviarSistema(Array($_SESSION['infoJugador']['idUsuario']),_('Perdida de tropas'),$contenido,MENSAJEAVISO);
											}
										}else
											$mensaje=_('No puedes realizar este tipo de misi&#243;n con estas tropas');
							   		}
							   		else
							   			$mensaje=_('No puedes realizar viajes intergal&#225;cticos con estas tropas');
									break;
							}
						}
						else
							$mensaje=_('El origen no puede ser igual que el destino');
			        }
			        else
			        	$mensaje=_('No se puede desplegar despues de un segundo despliegue');
		        }
		        else
		        	$mensaje=_('La velocidad no es correcta');
	        }
	        else
	        	$mensaje=_('No se puede iniciar una nueva misi&#243;n desde esta misi&#243;n');
	        
	        //Pasamos los datos a la vista
	        $this->view = new MensajeView();
	        $this->view->mensaje($mensaje); 
	    }
	    
	    /**
	     * Muestra el contenedor de nueva mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 27/05/2010
	     */
		public function mision()
	    {
	        //Creamos la primera pestana
	        ob_start();
			$this->nuevaMision();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->mision($buffer);
	    }
	    
	    /**
	     * Muestra el formulario de nueva mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function nuevaMision()
	    {
	    	
	    	//Creamos el modelo
	   		$misionModel=new MisionModel();
	   		
	   		//Sacamos los datos de la mision original
	   		$mision=$misionModel->datosMision($_REQUEST['idMision']);
	   		
	   		//Comprobamos si se es el dueño de la mision
	   		if($_SESSION['infoJugador']['idUsuario']==$mision['idJugador']){
	   			//Sacamos el resto de datos
	   			$planetaModel=new PlanetaModel();
		   		$tipoMision=$misionModel->misionTipo($_REQUEST['idMision']);
		   		$unidades=$misionModel->unidades(Array($_REQUEST['idMision']));
		   
		   		//Sacamos la lista de planetas
		   		$planetas=$planetaModel->tuLista($_SESSION['infoJugador']['idUsuario'],0,$planetaModel->numPlanetasTuLista($_SESSION['infoJugador']['idUsuario']));
		        
		        //Pasamos los datos a la vista
		        $this->view = new MisionesView();
		        
		        //Actualizamos los recursos
			    $recursosModel = new RecursosModel();
			    $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
		        
			    $this->view->nuevaMision($unidades,$mision,$tipoMision,$_SESSION['infoUnidades'],$_SESSION['infoJugador']['idRaza'],$planetas,$recursos,$_SESSION['infoUnidades']['stargateIntergalactico'],$_SESSION['infoUnidades']['viajeIntergalactico']);
	   		}
			
	    }
	
	}
?>
