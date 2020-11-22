<?php
	/**
	 * Controlador de soldados
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 12/06/2009
	 */
	
	
	
	/**
	 * Controlador de soldados
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 12/06/2009
	 */
	class SoldadosController
	    extends ControllerBase
	{
	    /**
	     * Cancela la construccion de naves
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function cancelar()
	    {
	        
	        $soldadoModel = new SoldadoModel();
	   		$res=$soldadoModel->cancelar($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
	   		if($res==true){
	        	$recursosModel = new RecursosModel();
	        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	        
		        //Pasamos los datos a la vista
			    $this->view = new SoldadosView();
				$this->view->cancelar($recursos);
	        }
	        else{
		        //Pasamos los datos a la vista
			    $this->view = new MensajeView();
			    $this->view->show('Error',true);
	        }
	        
	    }
	
	    /**
	     * Lista las tropas construibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function construibles()
	    {
	        
	        //Creamos el modelo
	   		$soldadoModel = new SoldadoModel();
	   
	   		$soldados=$soldadoModel->construibles($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		//Hacemos una lista de las unidades construibles y sacamos sus atributos propios
			if(count($soldados)>0){
				for($i=0; $i<count($soldados); $i++)
		        	$idSoldados[$i]=$soldados[$i]['id'];
				$atributosSoldados=$soldadoModel->atributos($idSoldados);
				//Anyadimos los atributos al array
				for($i=0; $i<count($soldados); $i++)
					$soldados[$i]=array_merge($soldados[$i],$atributosSoldados[$soldados[$i]['id']]);
			}
	
			$soldadoActual=$soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
			$idSoldados=array();
	
			foreach($soldados as $soldado)
				array_push($idSoldados,$soldado['id']);
	
			$costesRecursos=$soldadoModel->costeRecursos($idSoldados);
			$costesUnidades=$soldadoModel->costeUnidades($idSoldados,$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	
	        $mejorasUnidad=$soldadoModel->mejorasUnidad($idSoldados);
	        
	        $mejoraLimiteSoldados=$soldadoModel->mejoraLimiteSoldados($_SESSION['infoJugador']['idRaza']);
	        
	        $fuegoRapido=$soldadoModel->fuegoRapido();
	        
	        //Unidades ya construidas
	        $construidas=$soldadoModel->construidas($_SESSION['infoJugador']['idUsuario'],$idSoldados);
	
			//Pasamos los datos a la vista
	        $this->view = new SoldadosView();
	        $this->view->construibles($soldados,$_SESSION['infoUnidades'],$_SESSION['infoRecursos'],$soldadoActual,$costesRecursos,$costesUnidades,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['construccionVelocidad'],$mejorasUnidad,$_SESSION['infoUnidades']['numSoldados'],$_SESSION['infoUnidades']['limiteSoldados'],$mejoraLimiteSoldados,$construidas,$fuegoRapido);
	        
	    }
	
	    /**
	     * Contruye tropas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
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
			   		$soldadoModel = new SoldadoModel();
			   		$res=$soldadoModel->construir($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza'], $_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['cantidad'],$_REQUEST['idUnidad']);
			        if($res==true){
			        	$soldadoActual=$soldadoModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
			        
			        	$recursosModel = new RecursosModel();
			        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
			        
				        //Pasamos los datos a la vista
					    $this->view = new SoldadosView();
					    $this->view->construir($soldadoActual,$recursos);
			        }
	        	}
	        }
	        
	    }
	
	    /**
	     * Lista las tropas disponibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function disponibles()
	    {
	        
	        //Creamos los modelos
	   		$soldadoModel = new SoldadoModel();
	   		$planetaModel=new PlanetaModel();
	   		$misionModel=new MisionModel();
	   
	   		//Sacamos los soldados disponibles y la lista de planetas
	   		$soldados=$soldadoModel->disponibles($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		$planetas=$planetaModel->tuLista($_SESSION['infoJugador']['idUsuario'],0,$planetaModel->numPlanetasTuLista($_SESSION['infoJugador']['idUsuario']));
	
	   		//Limite de misiones
	        $mejoraLimiteMisiones=$misionModel->mejoraLimiteMisiones($_SESSION['infoJugador']['idRaza']);
	        $numMisiones=$misionModel->numMisionesActuales($_SESSION['infoJugador']['idUsuario']);
	        
	        //Pasamos los datos a la vista
	        $this->view = new SoldadosView();
	        
	        //Comprobamos si se esta pasando un destino
			if(isset($_REQUEST['idPlanetaDestino']) && $_REQUEST['idPlanetaDestino']!=0 && isset($_REQUEST['idGalaxiaDestino']) && $_REQUEST['idGalaxiaDestino']!=0)
				$destino=$planetaModel->planeta($_REQUEST['idGalaxiaDestino'], $_REQUEST['idPlanetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
			else
	        	$destino=null;
	
	        //Actualizamos los recursos
		    $recursosModel = new RecursosModel();
		    $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	        
		    $this->view->disponibles($soldados,$_SESSION['infoUnidades'],$_SESSION['infoJugador']['idRaza'],$planetas,$destino,$numMisiones,$_SESSION['infoUnidades']['limiteMisiones'],$mejoraLimiteMisiones,$recursos,$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoUnidades']['stargateIntergalactico']);
	        
	    }
	
	    /**
	     * Elimina unidades de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function licenciar()
	    {
	        
	        //Validamos la cantidad
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
			   		$soldadoModel = new SoldadoModel();
			   		$numUnidades=count($_REQUEST['idUnidad']);
			   
			   		//Comprobamos si son especiale sapra desactivar triggers
			   		$especial=$soldadoModel->unidadDeEspecial($_REQUEST['idUnidad']);
	
			   		for($i=0;$i<$numUnidades;$i++){
			   			//Elimino los soldados
			   			$soldadoModel->licenciar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idUnidad'][$i],$_REQUEST['cantidad'][$i]);
			   
			   			//Actualizo la variable referente al numero de soldados del entorno si es necesario
			   			if(!$especial[$_REQUEST['idUnidad'][$i]])
		        			$_SESSION['infoUnidades']['numSoldados'] -= $_REQUEST['cantidad'][$i];
		        			
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
	        
	        //Mostramos las unidades disponibles
	        $this->disponibles();
	        
	    }
	
	    /**
	     * Envia tropas a una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function mision()
	    {
	        
	    	//Creamos los modelos
	   		$planetaModel = new PlanetaModel();
	   		$misionModel = new MisionModel();
	   		$soldadoModel = new SoldadoModel();
	
	        //Validamos los valores
	        $velocidades=array(10,20,30,40,50,60,70,80,90,100);
	
	        if(isset($_REQUEST['cantidad']) && is_array($_REQUEST['cantidad']) && count($_REQUEST['cantidad'])>0 && isset($_REQUEST['idUnidad']) && is_array($_REQUEST['idUnidad']) && count($_REQUEST['idUnidad'])>0 && in_array($_REQUEST['velocidad'],$velocidades)){
	        	//Validamos que las unidades sean soldados
	        	if($misionModel->unidadesCorrectas($_REQUEST['idUnidad'],SOLDADO)){
		        	//Validamos cada cantidad del array
		        	$correctas=true;
		        	foreach($_REQUEST['cantidad'] as $cantidad){
		        		if($cantidad<=0)
		        			$correctas=false;
		        	}
	
		        	//Si todas las cantidades son validas
	        		if($correctas){
			        	//Validamos que el usuario pueda hacer viajes interestelares
				   		if(($_REQUEST['galaxiaDestino']==$_SESSION['infoJugador']['galaxiaSel']) || $_SESSION['infoUnidades']['stargateIntergalactico']){
				   			//Validamos el destino y el tipo de mision
							if(
								(!$planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==EXPLORAR && $soldadoModel->exploradores($_REQUEST['idUnidad'])) ||
								($planetaModel->planetaExplorado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && 
									(
										($planetaModel->planetaNeutral($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino']) && ($_REQUEST['tipoMision']==RECOLECTAR || $_REQUEST['tipoMision']==ESTABLECERBASE || $_REQUEST['tipoMision']==DESPLEGAR)) ||
										($planetaModel->planetaEnemigo($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']) && ($_REQUEST['tipoMision']==ATACAR || $_REQUEST['tipoMision']==DESPLEGAR || ($_REQUEST['tipoMision']==CONQUISTAR && $_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil') && !$planetaModel->planetaPrincipal($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'])))) ||
										(($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) || $planetaModel->planetaAliado($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza'])) && ($_REQUEST['tipoMision']==CONTRATACAR || $_REQUEST['tipoMision']==DESPLEGAR)) ||
										($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==DESPLEGAR) ||
										(!$planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario']) && $_REQUEST['tipoMision']==EXPLORAR && $soldadoModel->exploradores($_REQUEST['idUnidad']))
									)
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
							   		$misionModel->mision($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$_REQUEST['idUnidad'],$_REQUEST['cantidad'],$tiempo);
								}
								else{
									//Comprobamos si son especiale sapra desactivar triggers
			   						$especial=$soldadoModel->unidadDeEspecial($_REQUEST['idUnidad']);
			   
									//Eliminamos las unidades
									for($i=0;$i<count($_REQUEST['idUnidad']);$i++){
							   			//Elimino los soldados
							   			$soldadoModel->licenciar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idUnidad'][$i],$_REQUEST['cantidad'][$i],$especial[$_REQUEST['idUnidad'][$i]]);
							   
							   			//Actualizo la variable referente al numero de soldados del entorno si es necesario
							   			if(!$especial[$_REQUEST['idUnidad'][$i]])
						        			$_SESSION['infoUnidades']['numSoldados'] -= $_REQUEST['cantidad'][$i];
	
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
							    	$contenido=_('Tus tropas han sido eliminadas por una defensa de stargate al cruzar hacia el planeta').' '.$nombrePlaneta.'.';
							    	$mensajesModel->enviarSistema(Array($_SESSION['infoJugador']['idUsuario']),_('Perdida de tropas'),$contenido,MENSAJEAVISO);
								}
							}
				   		}
	        		}
	        	}
			}
			
			$this->executeController('Index', 'principal');
	    }
	
	    /**
	     * Muestra el modulo de soldados
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function soldados()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->disponibles();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new SoldadosView();
	        $this->view->soldados($buffer);
	        
	    }
	
	    /**
	     * Muestra los requisitos de las tropas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function requisitos()
	    {
	        
	        //Creamos el modelo
	   		$soldadoModel = new SoldadoModel();
	   
	   		$soldados=$soldadoModel->listaRaza($_SESSION['infoJugador']['idRaza']);
	   		$requisitos=$soldadoModel->requisitos($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza']);
	   
	        //Pasamos los datos a la vista
	        $this->view = new SoldadosView();
	        $this->view->requisitos($soldados,$requisitos);
	        
	    }
	
	    /**
	     * Short description of method tiempoMision
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @return mixed
	     */
	    public function tiempoMision()
	    {
	        
	        //Creamos el modelo
		   	$soldadoModel = new SoldadoModel();
		   
		   	$tiempo = $soldadoModel->tiempoMision($_REQUEST['tipoMision'],$_REQUEST['velocidad']);
		   
		   	//Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->tiempoMision($tiempo,$_SESSION['infoJugador']['idRaza']);
	        
	    }
	
	}
?>