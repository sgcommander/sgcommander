<?php
	/**
	 * Controlador de defensas
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 12/06/2009
	 */

	

	/**
	 * Controlador de defensas
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 12/06/2009
	 */
	class DefensasController
	    extends ControllerBase
	{
	    /**
	     * Cancela la construccion de defensas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function cancelar()
	    {
	        
	        $defensaModel = new DefensaModel();
	   		$res=$defensaModel->cancelar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
	   		if($res==true){
	        	$recursosModel = new RecursosModel();
	        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
	        
		        //Pasamos los datos a la vista
			    $this->view = new DefensasView();
				$this->view->cancelar($recursos);
	        }
	        else{
		        //Pasamos los datos a la vista
			    $this->view = new MensajeView();
			    $this->view->show('Error',true);
	        }
	        
	    }

	    /**
	     * Lista las defensas construibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function construibles()
	    {
	        
	        //Creamos el modelo
	   		$defensaModel = new DefensaModel();
	   		$misionModel = new MisionModel();
	   
	   		$defensas=$defensaModel->construibles($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		//Hacemos una lista de las unidades construibles y sacamos sus atributos propios
			if(count($defensas)>0){
				for($i=0; $i<count($defensas); $i++)
		        	$idDefensas[$i]=$defensas[$i]['id'];
		        	
				$atributosDefensas=$defensaModel->atributos($idDefensas);
				
				//Anadimos los atributos al array
				for($i=0; $i<count($defensas); $i++)
					$defensas[$i]=array_merge($defensas[$i],$atributosDefensas[$defensas[$i]['id']]);
					
				unset($atributosDefensas);
			}

			$defensaActual=$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   
			$idDefensas=array();

			foreach($defensas as $defensa)
				array_push($idDefensas,$defensa['id']);

			$costesRecursos=$defensaModel->costeRecursos($idDefensas);
			$costesUnidades=$defensaModel->costeUnidades($idDefensas,$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);

			$mejorasUnidad=$defensaModel->mejorasUnidad($idDefensas);

			$fuegoRapido=$defensaModel->fuegoRapido();
			
			//Unidades ya construidas
	        $construidas=$defensaModel->construidas($_SESSION['infoJugador']['idUsuario'],$idDefensas);
	        
	        //Comprobamos si hay ya una defensa de stargate en el planeta
	        $hayDefensaStargate=$misionModel->defensaStargate($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);

	        //Pasamos los datos a la vista
	        $this->view = new DefensasView();
	        $this->view->construibles($defensas,$_SESSION['infoUnidades'],$_SESSION['infoRecursos'],$defensaActual,$costesRecursos,$costesUnidades,$_SESSION['infoJugador']['idRaza'],$_SESSION['infoJugador']['construccionVelocidad'],$mejorasUnidad,$construidas,$hayDefensaStargate,$fuegoRapido);
	        
	    }

	    /**
	     * Contruye defensas
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
	        
	        //Comprobamos la cantidad
	        if($_REQUEST['cantidad']>0){
		        //Comprobamos si el planeta sigue siendo nuestro
	        	$planetaModel = new PlanetaModel();
	        	if($planetaModel->planetaPropio($_SESSION['infoJugador']['galaxiaSel'], $_SESSION['infoJugador']['planetaSel'], $_SESSION['infoJugador']['idUsuario'])){
			        //Creamos el modelo
			   		$defensaModel = new DefensaModel();
			   		$misionModel = new MisionModel();
			   
			   		//Comprobamos si es una defensa de stargate y si la cantidad es 1 y no hay ya una defensa de stargate en el planeta
			   		$atributos=$defensaModel->atributos(array($_REQUEST['idUnidad']));
			   		if(is_array($atributos) && $atributos[$_REQUEST['idUnidad']]['idTipo']!=STARGATE || ($_REQUEST['cantidad']==1 && !$misionModel->defensaStargate($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']))){
			   			$res=$defensaModel->construir($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza'], $_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['cantidad'],$_REQUEST['idUnidad']);
				        if($res==true){
				        	$defensaActual=$defensaModel->construccionActual($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
				        
				        	$recursosModel = new RecursosModel();
				        	$recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
				        
					        //Pasamos los datos a la vista
						    $this->view = new DefensasView();
						    $this->view->construir($defensaActual,$recursos);
				        }
			   		}
	        	}
	        }
	        
	    }

	    /**
	     * Lista las defensas disponibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function disponibles()
	    {
	        
	        //Creamos los modelos
	   		$defensaModel = new DefensaModel();
	   		$planetaModel=new PlanetaModel();
	   		$misionModel=new MisionModel();
	   
	   		//Sacamos los soldados disponibles y la lista de planetas
	   		$defensas=$defensaModel->disponibles($_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
	   		$planetas=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);

	   		//Limite de misiones
	        $mejoraLimiteMisiones=$misionModel->mejoraLimiteMisiones($_SESSION['infoJugador']['idRaza']);
	        $numMisiones=$misionModel->numMisionesActuales($_SESSION['infoJugador']['idUsuario']);
	        
	        //Pasamos los datos a la vista
	        $this->view = new DefensasView();
	        
	        //Comprobamos si se esta pasando un destino
			if(isset($_REQUEST['idPlanetaDestino']) && $_REQUEST['idPlanetaDestino']!=0 && isset($_REQUEST['idGalaxiaDestino']) && $_REQUEST['idGalaxiaDestino']!=0)
				$destino=$planetaModel->planeta($_REQUEST['idGalaxiaDestino'], $_REQUEST['idPlanetaDestino'],$_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['idAlianza']);
			else
	        	$destino=null;
	        
	        //Actualizamos los recursos
		    $recursosModel = new RecursosModel();
		    $recursos=$recursosModel->recursos($_SESSION['infoJugador']['idUsuario']);
		    
	        $this->view->disponibles($defensas,$_SESSION['infoUnidades'],$_SESSION['infoJugador']['usuario'],$_SESSION['infoJugador']['idRaza'],$planetas,$destino,$numMisiones,$_SESSION['infoUnidades']['limiteMisiones'],$mejoraLimiteMisiones,$recursos,$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoUnidades']['stargateIntergalactico']);
	        
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
			   		$defensaModel = new DefensaModel();
			   		$numUnidades=count($_REQUEST['idUnidad']);
			   
			   		//Comprobamos si son especiale sapra desactivar triggers
			   		$especial=$defensaModel->unidadDeEspecial($_REQUEST['idUnidad']);
			   
			   		for($i=0;$i<$numUnidades;$i++){
			   			$defensaModel->licenciar($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['idUnidad'][$i],$_REQUEST['cantidad'][$i]);
			   
			   			//Actualizo la variable referente al numero de soldados del entorno si es necesario
			   			if(!$especial[$_REQUEST['idUnidad'][$i]])
		        			$_SESSION['infoUnidades']['numDefensas'] -= $_REQUEST['cantidad'][$i];
		        			
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
	        
	        //Mostramos las defensas disponibles
	        $this->disponibles();
	        
	    }

	    /**
	     * Envia defensas a una mision
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
	   		$defensaModel = new DefensaModel();

	        //Validamos los valores
	        $velocidades=array(10,20,30,40,50,60,70,80,90,100);

	        if(isset($_REQUEST['cantidad']) && is_array($_REQUEST['cantidad']) && count($_REQUEST['cantidad'])>0 && isset($_REQUEST['idUnidad']) && is_array($_REQUEST['idUnidad']) && count($_REQUEST['idUnidad'])>0 && in_array($_REQUEST['velocidad'],$velocidades)){
	        	//Validamos que las unidades sean defensas
	        	if($misionModel->unidadesCorrectas($_REQUEST['idUnidad'],DEFENSA)){
	        		//Validamos cada cantidad del array
		        	$correctas=true;
		        	foreach($_REQUEST['cantidad'] as $cantidad){
		        		if($cantidad<=0)
		        			$correctas=false;
		        	}
		        
		        	//Si todas las cantidades son validas
	        		if($correctas && $defensaModel->moviles($_REQUEST['idUnidad'])){
			        	//Validamos que el usuario pueda hacer viajes interestelares
				   		if(($_REQUEST['galaxiaDestino']==$_SESSION['infoJugador']['galaxiaSel']) || $_SESSION['infoUnidades']['stargateIntergalactico']){
				        	//Validamos el destino y el tipo de mision
							if($planetaModel->planetaPropio($_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_SESSION['infoJugador']['idUsuario'])
								&& ($_REQUEST['tipoMision']==DESPLEGAR || $_REQUEST['tipoMision']==CONTRATACAR)){
								//Calculamos el tiempo de la mision
						   		$tiempo = $defensaModel->tiempoMision($_REQUEST['idUnidad'],$_REQUEST['velocidad']);
						   
						   		//Insertamos la mision
						   		$misionModel->mision($_SESSION['infoJugador']['idUsuario'],$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel'],$_REQUEST['galaxiaDestino'],$_REQUEST['planetaDestino'],$_REQUEST['tipoMision'],$_REQUEST['idUnidad'],$_REQUEST['cantidad'],$tiempo);
							}
				   		}
	        		}
	        	}
			}
			
			$this->executeController('Index', 'principal');
	    }

	    /**
	     * Muestra el modulo de defensas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function defensas()
	    {
	        
	        //Creamos la primera pestana
	        ob_start();
			$this->disponibles();
			$buffer = ob_get_contents();
	    	ob_clean();
	    
	        //Pasamos los datos a la vista
	        $this->view = new DefensasView();
	        $this->view->defensas($buffer);
	        
	    }

	    /**
	     * Muestra los requisitos de las defensas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function requisitos()
	    {
	        
	        //Creamos el modelo
	   		$defensaModel = new DefensaModel();
	   
	   		$defensas=$defensaModel->listaRaza($_SESSION['infoJugador']['idRaza']);
	   		$requisitos=$defensaModel->requisitos($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['idRaza']);
	   
	        //Pasamos los datos a la vista
	        $this->view = new DefensasView();
	        $this->view->requisitos($defensas,$requisitos);
	        
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
		   	$defensaModel = new DefensaModel();
		   
		   	$tiempo = $defensaModel->tiempoMision($_REQUEST['idUnidad'],$_REQUEST['velocidad']);
		   
		   	//Pasamos los datos a la vista
	        $this->view = new MisionesView();
	        $this->view->tiempoMision($tiempo,$_SESSION['infoJugador']['idRaza']);
	        
	    }

	}
?>