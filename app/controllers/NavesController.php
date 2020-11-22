<?php
	/**
	 * Controlador de naves
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 13/05/2009
	 */
	
	
	
	/**
	 * Controlador de naves
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 13/05/2009
	 */
	class NavesController
	    extends ControllerBase
	{
	    /**
	     * Muestra el modulo de naves
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function naves()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->disponibles();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new NavesView();
	        $this->view->naves($buffer);
	        
	    }
	
	    /**
	     * Lista las naves disponibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function disponibles()
	    {
	        
			//Creamos los modelos
	   		$naveModel = new NaveModel();
	   		$planetaModel=new PlanetaModel();
	   		$misionModel=new MisionModel();
	   
			//Sacamos la naves disponibles y la lista de planetas
	   		$naves=$naveModel->disponibles($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		$planetas=$planetaModel->tuLista($_SESSION['infoJugador']['idUsuario'],0,$planetaModel->numPlanetasTuLista($_SESSION['infoJugador']['idUsuario']));
	
			//Limite de misiones
	        $mejoraLimiteMisiones=$misionModel->mejoraLimiteMisiones($_SESSION['infoJugador']['idRaza']);
	        $numMisiones=$misionModel->numMisionesActuales($_SESSION['infoJugador']['idUsuario']);
	        
	   		//Pasamos los datos a la vista
	        $this->view = new NavesView();
	
			//Comprobamos si se esta pasando un destino
			if(isset($_REQUEST['idPlanetaDestino']) && $_REQUEST['idPlanetaDestino']!=0 && isset($_REQUEST['idGalaxiaDestino']) && $_REQUEST['idGalaxiaDestino']!=0)
				$destino=$planetaModel->planeta($_REQUEST['idGalaxiaDestino'], $_REQUEST['idPlanetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
			else
	        	$destino=null;
	        
	        //Actualizamos los recursos
		    $recursosModel = new RecursosModel();
		    $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
		    
	        $this->view->disponibles($naves,$_SESSION['infoUnidades'],$_SESSION['infoJugador']['idRaza'],$planetas,$destino,$numMisiones,$_SESSION['infoUnidades']['limiteMisiones'],$mejoraLimiteMisiones,$recursos,$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoUnidades']['viajeIntergalactico']);
	        
	    }
	
	    /**
	     * Contruye naves
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function construir()
	    {
	        
	        //Validamos la cantidad
	        $_REQUEST['cantidad']=intval($_REQUEST['cantidad']);
	        
	        if($_REQUEST['cantidad']>0){
		        //Comprobamos si el planeta sigue siendo nuestro
	        	$planetaModel = new PlanetaModel();
	        	if($planetaModel->planetaPropio($_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel'], $_SESSION['infoJugador']['idUsuario'])){
			        //Creamos el modelo
			   		$naveModel = new NaveModel();
			   		$res=$naveModel->construir($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza'], $_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['cantidad'],$_REQUEST['idUnidad']);
			        if($res==true){
			        	$naveActual=$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
			        
			        	$recursosModel = new RecursosModel();
			        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
			        
				        //Pasamos los datos a la vista
					    $this->view = new NavesView();
					    $this->view->construir($naveActual,$recursos);
			        }
	        	}
	        }
	        
	    }
	
	    /**
	     * Muestra los requisitos de las naves
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function requisitos()
	    {
	        
	        //Creamos el modelo
	   		$naveModel = new NaveModel();
	   
	   		$naves=$naveModel->listaRaza($_SESSION['infoJugador']['idRaza']);
	   		$requisitos=$naveModel->requisitos($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza']);
	   
	        //Pasamos los datos a la vista
	        $this->view = new NavesView();
	        $this->view->requisitos($naves,$requisitos);
	        
	    }
	
	    /**
	     * Lista las naves construibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function construibles()
	    {
	        
	        //Creamos el modelo
	   		$naveModel = new NaveModel();
	   
	   		$naves=$naveModel->construibles($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		//Hacemos una lista de las unidades construibles y sacamos sus atributos propios
			if(count($naves)>0){
				for($i=0; $i<count($naves); $i++)
		        	$idNaves[$i]=$naves[$i]['id'];
				$atributosNaves=$naveModel->atributos($idNaves);
				//A�adimos los atributos al array
				for($i=0; $i<count($naves); $i++)
					$naves[$i]=array_merge($naves[$i],$atributosNaves[$naves[$i]['id']]);
			}
	
			$naveActual=$naveModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
			$idNaves=array();
	
			foreach($naves as $nave)
				array_push($idNaves,$nave['id']);
	
			$costesRecursos=$naveModel->costeRecursos($idNaves);
			$costesUnidades=$naveModel->costeUnidades($idNaves,$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
			
			$mejorasUnidad=$naveModel->mejorasUnidad($idNaves);
			
			$fuegoRapido=$naveModel->fuegoRapido();
	
			//Unidades ya construidas
	        $construidas=$naveModel->construidas($_SESSION['infoJugador']['idUsuario'],$idNaves);
	
	        //Pasamos los datos a la vista
	        $this->view = new NavesView();
	        $this->view->construibles($naves,$_SESSION['infoUnidades'],$_SESSION['infoRecursos'],$naveActual,$costesRecursos,$costesUnidades,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['construccionVelocidad'],$mejorasUnidad,$construidas,$fuegoRapido);
	        
	    }
	
	    /**
	     * Cancela la construccion de naves
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function cancelar()
	    {
	        
	        $naveModel = new NaveModel();
	   		$res=$naveModel->cancelar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
	   		if($res==true){
	        	$recursosModel = new RecursosModel();
	        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	        
		        //Pasamos los datos a la vista
			    $this->view = new NavesView();
				$this->view->cancelar($recursos);
	        }
	        else{
		        //Pasamos los datos a la vista
			    $this->view = new MensajeView();
			    $this->view->show('Error',true);
	        }
	        
	    }
	
	    /**
	     * Elimina unidades de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 08/06/2009
	     */
	    public function licenciar()
	    {
	        
	        //Validamos la cantidad y licenciamos las unidades en caso de ser correcto
	        if(is_array($_REQUEST['cantidad']) && is_array($_REQUEST['idUnidad'])){
	        	//Validamos cada cantidad del array
	        	$correctas=true;
	        	foreach($_REQUEST['cantidad'] as $cantidad){
	        		if($cantidad<=0)
	        			$correctas=false;
	        	}
	        
	        	//Si todas las cantidades son validas
	        	if($correctas){
			        //Creamos el modelo
			   		$naveModel = new NaveModel();
			   		$numUnidades=count($_REQUEST['idUnidad']);
			   
			   		//Comprobamos si son especiale sapra desactivar triggers
			   		$especial=$naveModel->unidadDeEspecial($_REQUEST['idUnidad']);
			   
			   		for($i=0;$i<$numUnidades;$i++){
			   			$naveModel->licenciar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idUnidad'][$i],$_REQUEST['cantidad'][$i]);
			   
			   			//Actualizo la variable referente al numero de naves del entorno si es necesario
			   			if(!$especial[$_REQUEST['idUnidad'][$i]])
		        			$_SESSION['infoUnidades']['numNaves'] -= $_REQUEST['cantidad'][$i];
		        		
		        		//Cargo la clase que me permite tener actualizadas las variables de session, para que se actualicen todos los cambios
	    				$info = new InfoJugadorModel();
	    				
		        		//Actualizo la puntuacion del jugador en la sesion actual
						$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);
						
						//Actualizo las mejoras para las unidades en sesion
						list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
	                    $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
	                    $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
	                    $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
	                    $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
	                    $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);
		        	}
		        
		        	//Genero la firma del usuario
					$firma=new Firma();
					$firma->generar($_SESSION['infoJugador']['idUsuario']);
	        	}
	        }  
	        
	        //Mostramos las naves disponibles
	        $this->disponibles();
	        
	    }
	
	    /**
	     * Devuelve el tiempo total de una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function tiempoMision()
	    {
	        
	        //Creamos el modelo
		   	$naveModel = new NaveModel();
		   	
		   	//Comprobamos los parametros
		   	if(!array_key_exists('galaxiaOrigen', $_REQUEST) || !$_REQUEST['galaxiaOrigen'])
		   		$_REQUEST['galaxiaOrigen']=$_SESSION['infoJugador']['galaxiaSel'];
		   		
		   	if(!array_key_exists('planetaOrigen', $_REQUEST) || !$_REQUEST['planetaOrigen'])
		   		$_REQUEST['planetaOrigen']=$_SESSION['infoJugador']['planetaSel'];
		   
		   	$tiempo = $naveModel->tiempoMision($_REQUEST['galaxiaOrigen'],$_REQUEST['planetaOrigen'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$_REQUEST['idUnidad'],$_SESSION['infoUnidades']['navesVelocidad'],$_REQUEST['velocidad'],$_SESSION['infoUnidades']['stargateIntergalactico']);
		   
		   	//Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->tiempoMision($tiempo,$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	    /**
	     * Envia uidades a una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function mision()
	    {
	        
			//Creamos los modelos
	   		$planetaModel = new PlanetaModel();
	   		$misionModel = new MisionModel();
	   		$naveModel = new NaveModel();
	
	        //Validamos los valores
	        $velocidades=array(10,20,30,40,50,60,70,80,90,100);
	
	        if(isset($_REQUEST['cantidad']) && is_array($_REQUEST['cantidad']) && count($_REQUEST['cantidad'])>0 && isset($_REQUEST['idUnidad']) && is_array($_REQUEST['idUnidad']) && count($_REQUEST['idUnidad'])>0 && in_array($_REQUEST['velocidad'],$velocidades)){
	        	//Validamos que las unidades sean naves
	        	if($misionModel->unidadesCorrectas($_REQUEST['idUnidad'],NAVE)){
	        		//Validamos cada cantidad del array
		        	$correctas=true;
		        	foreach($_REQUEST['cantidad'] as $cantidad){
		        		if($cantidad<=0)
		        			$correctas=false;
		        	}
	
		        	//Si todas las cantidades son validas y caben los cazas
	        		if($correctas && $naveModel->capacidadCazas($_REQUEST['idUnidad'],$_REQUEST['cantidad'])){
	        			//Comprobamos si se viajara por el stargate
	        			$stargate=$naveModel->viajanStargate($_SESSION['infoJugador']['galaxiaSel'],$_REQUEST['galaxiaDestino'],$_SESSION['infoUnidades']['stargateIntergalactico'],$_REQUEST['idUnidad']);
			        	//Validamos que el usuario pueda hacer viajes interestelares
				   		if(($_REQUEST['galaxiaDestino']==$_SESSION['infoJugador']['galaxiaSel']) || 
				   			(!$stargate && $_SESSION['infoUnidades']['viajeIntergalactico']) || ($stargate && $_SESSION['infoUnidades']['stargateIntergalactico'])
				   		){
				        	//Validamos el destino y el tipo de mision
							if(
							(!$planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==EXPLORAR) ||
							($planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && 
								(
									($planetaModel->planetaNeutral($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && ($_REQUEST['tipoMision']==RECOLECTAR || $_REQUEST['tipoMision']==ESTABLECERBASE || $_REQUEST['tipoMision']==DESPLEGAR)) ||
									($planetaModel->planetaEnemigo($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) && ($_REQUEST['tipoMision']==ATACAR || $_REQUEST['tipoMision']==DESPLEGAR || ($_REQUEST['tipoMision']==CONQUISTAR && $_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil') && !$planetaModel->planetaPrincipal($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'])))) ||
									(($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) || $planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza'])) && ($_REQUEST['tipoMision']==CONTRATACAR || $_REQUEST['tipoMision']==DESPLEGAR)) ||
									($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==DESPLEGAR) || 
									(!$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==EXPLORAR))
								)
							){
								//Comprobamos si las unidades chocan contra una defensa de stargate
								if(!$stargate || !$misionModel->defensaStargate($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) || 
									$_SESSION['infoUnidades']['atraviesaIris'] ||
									$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) ||
									$planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) || 
									($misionModel->propietarioDebil($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && $_ENV['config']->get('puntuacionDebil') <= $_SESSION['infoPuntuacion']['puntosTecnologias'])
								){
							   		//Calculamos el tiempo de la mision
							   		$tiempo = $naveModel->tiempoMision($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$_REQUEST['idUnidad'],$_SESSION['infoUnidades']['navesVelocidad'],$_REQUEST['velocidad'],$_SESSION['infoUnidades']['stargateIntergalactico']);

							   		//Insertamos la mision
							   		$misionModel->mision($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$_REQUEST['idUnidad'],$_REQUEST['cantidad'],$tiempo);
								}
								else{
									//Comprobamos si son especiale sapra desactivar triggers
			   						$especial=$naveModel->unidadDeEspecial($_REQUEST['idUnidad']);
			   
									//Eliminamos las unidades
									for($i=0;$i<count($_REQUEST['idUnidad']);$i++){
							   			//Elimino las naves
							   			$naveModel->licenciar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idUnidad'][$i],$_REQUEST['cantidad'][$i],$especial[$_REQUEST['idUnidad'][$i]]);
							   
							   			//Actualizo la variable referente al numero de naves del entorno si es necesario
							   			if(!$especial[$_REQUEST['idUnidad'][$i]])
						        			$_SESSION['infoUnidades']['numNaves'] -= $_REQUEST['cantidad'][$i];
						        			
						        		//Cargo la clase que me permite tener actualizadas las variables de session, para que se actualicen todos los cambios
					    				$info = new InfoJugadorModel();
					    				
						        		//Actualizo la puntuacion del jugador en la sesion actual
										$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);
										
										//Actualizo las mejoras para las unidades en sesion
										list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
					                    $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
					                    $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
					                    $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
					                    $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
					                    $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);
							   		}
							   		
							   		//Genero la firma del usuario
									$firma=new Firma();
									$firma->generar($_SESSION['infoJugador']['idUsuario']);
							   
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
				   		}
	        		}
	        	}
			}
			
			$this->executeController('Index', 'principal');
	    }
	
	}
?>