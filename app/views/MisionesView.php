<?php
	/**
	 * Vista del modulo de misiones
	 *
	 * @author David & Jose
	 * @package views
	 * @since 03/09/2009
	 */
	
	
	
	/**
	 * Vista del modulo de misiones
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 03/09/2009
	 */
	class MisionesView
	    extends ViewBase
	{
	    /**
	     * Muestra los datos de un planeta y las opciones 
	     * disponibles
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planeta
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planeta($planeta)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/destino.tpl');
	
			//Idioma
			$this->tpl->setVariable('_VELOCIDAD',_('Velocidad'));
			$this->tpl->setVariable('_TIPOMISION',_('Tipo de misi&#243;n'));
	        $this->tpl->setVariable('_SELECCIONATIPOMISION',_('Selecciona misi&#243;n'));
	        
	        //Planeta
	        $this->tpl->setVariable('PLANETAIDGALAXIA',$planeta['idGalaxia']);
			$this->tpl->setVariable('PLANETAID',$planeta['idPlaneta']);
	
			//Si esta explorado mostramos unas cosas si no otras
			if($planeta['explorado']){
				if($planeta['nombrePlaneta']=='')
					$this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
				else
					$this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
			      
			    $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
			    $this->tpl->setVariable('PLANETARIQ',$planeta['riqueza']);
			        
			    if($planeta['idPropietario']==''){
					$this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
					$this->tpl->setVariable('PLANETAALZ','');
			    }
				else{
					$this->tpl->setVariable('PLANETAUSR',$planeta['propietario']);
					if($planeta['alianza']!='')
						$this->tpl->setVariable('PLANETAALZ','('.$planeta['alianza'].')');
				}
	
				//Misiones
				$this->tpl->setVariable('_DESPLEGAR',_('Desplegar'));
				if($planeta['neutral']){
					$this->tpl->setVariable('_RECOLECTAR',_('Recolectar'));
					$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					$this->tpl->setVariable('_ESTABLECERBASE',_('Establecer base'));
				}
				else if($planeta['aliado']){
					$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					$this->tpl->setVariable('_CONTRATACAR',_('Contratacar'));
				}
				else if($planeta['enemigo'] && !$planeta['principal']){
					$this->tpl->setVariable('_ATACAR',_('Atacar'));
					$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					//Comprobamos si es fuerte para poder conquistar
					/*if($_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil')){
						$this->tpl->setVariable('_CONQUISTAR',_('Conquistar'));
					}*/
				}
				else if($planeta['enemigo']){
					$this->tpl->setVariable('_ATACAR',_('Atacar'));
					$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
				}
				else if($planeta['propio']){
					$this->tpl->setVariable('_CONTRATACAR',_('Contratacar'));
				}
			}
			else{
				$this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
				$this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').'sinexplo.jpg');
	
				//Misiones
				$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	    
		/**
	     * Muestra los datos de un planeta y las opciones 
	     * disponibles para una nueva mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planeta
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetaNueva($planeta, $tipoUnidadMision)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/destino.tpl');
	
			//Idioma
			$this->tpl->setVariable('_VELOCIDAD',_('Velocidad'));
			$this->tpl->setVariable('_TIPOMISION',_('Tipo de misi&#243;n'));
	        $this->tpl->setVariable('_SELECCIONATIPOMISION',_('Selecciona misi&#243;n'));
	        
	        //Planeta
	        $this->tpl->setVariable('PLANETAIDGALAXIA',$planeta['idGalaxia']);
			$this->tpl->setVariable('PLANETAID',$planeta['idPlaneta']);
	
			//Si esta explorado mostramos unas cosas si no otras
			if($planeta['explorado']){
				if($planeta['nombrePlaneta']=='')
					$this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
				else
					$this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
			      
			    $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
			    $this->tpl->setVariable('PLANETARIQ',$planeta['riqueza']);
			        
			    if($planeta['idPropietario']==''){
					$this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
					$this->tpl->setVariable('PLANETAALZ','');
			    }
				else{
					$this->tpl->setVariable('PLANETAUSR',$planeta['propietario']);
					if($planeta['alianza']!='')
						$this->tpl->setVariable('PLANETAALZ','('.$planeta['alianza'].')');
				}
	
				//Misiones
				//$this->tpl->setVariable('_DESPLEGAR',_('Desplegar'));
				if($planeta['neutral']){
					$this->tpl->setVariable('_RECOLECTAR',_('Recolectar'));
					if($tipoUnidadMision==NAVE){
						$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					}
					$this->tpl->setVariable('_ESTABLECERBASE',_('Establecer base'));
				}
				else if($planeta['aliado']){
					if($tipoUnidadMision==NAVE){
						$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					}
					$this->tpl->setVariable('_CONTRATACAR',_('Contratacar'));
				}
				else if($planeta['enemigo'] && !$planeta['principal']){
					$this->tpl->setVariable('_ATACAR',_('Atacar'));
					//Comprobamos que es nave para poder explorar
					if($tipoUnidadMision==NAVE){
						$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					}
					//Comprobamos si es fuerte para poder conquistar
					/*if($_SESSION['infoPuntuacion']['puntosTecnologias'] >= $_ENV['config']->get('puntuacionDebil')){
						$this->tpl->setVariable('_CONQUISTAR',_('Conquistar'));
					}*/
				}
				else if($planeta['enemigo']){
					$this->tpl->setVariable('_ATACAR',_('Atacar'));
					if($tipoUnidadMision==NAVE){
						$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					}
				}
				else if($planeta['propio']){
					//$this->tpl->setVariable('_DESPLEGAR',_('Desplegar'));
					$this->tpl->setVariable('_CONTRATACAR',_('Contratacar'));
				}
				
				$this->tpl->setVariable('_DESPLEGAR',_('Desplegar'));
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Short description of method tiempoMision
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @param  Integer tiempo
	     * @param  Integer idRaza
	     * @return mixed
	     */
	    public function tiempoMision($tiempo, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/tiempoMision.tpl');
	
			$this->tpl->setVariable('TIEMPOIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/tiempo.png');
			$this->tpl->setVariable('_TIEMPODEMISION',_('Tiempo de misi&#243;n'));
			$this->tpl->setVariable('TIEMPO',Funciones::dhms($tiempo));
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	    
		/**
	     * Muestra el formulario apra una nueva mision
	     *
	     * @since 12/06/2009
	     */
	    public function nuevaMision($unidades, $mision, $tipoMision, $mejoras, $idRaza, $planetas, $recursos = null, $stargateIntergalactico = null, $viajesIntergalacticos = null)
	    {
	        //Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad'], $recursos[2]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/nuevaMision.tpl');
	
			switch($tipoMision){
				case NAVE:
					$this->tpl->setVariable('_UNIDADESMISION',_('Naves de la misi&#243;n'));
					$this->tpl->setVariable('_UNIDAD',_('Nave'));
					break;
				case SOLDADO:
					$this->tpl->setVariable('_UNIDADESMISION',_('Soldados de la misi&#243;n'));
					$this->tpl->setVariable('_UNIDAD',_('Soldado'));
					break;
			}
			
			$this->tpl->setVariable('_DISPONIBLES',_('Disponibles'));
			$this->tpl->setVariable('_ENVIARMISION',_('Enviar en misi&#243;n'));
			
			$this->tpl->setVariable('IDTIPOUNIDADMISION', $tipoMision);
			$this->tpl->setVariable('IDMISION', $mision['id']);
			$this->tpl->setVariable('IDGALAXIAORIGEN', $mision['idGalaxiaDestino']);
			$this->tpl->setVariable('IDPLANETAORIGEN', $mision['idPlanetaDestino']);

			$this->tpl->setCurrentBlock('tUnidad');
			foreach($unidades[$mision['id']] as $datos){
				$this->tpl->setVariable('IDUNIDAD',$datos['idUnidad']);
				$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$datos['idUnidad'].'.jpg');
				$this->tpl->setVariable('NOMUNIDAD',$datos['nombre']);
				$this->tpl->setVariable('CANTIDAD',$datos['cantidadActual']);
				
	        	$this->tpl->parseCurrentBlock();
			}
	
	    	//Planetas de destino
			$this->tpl->setCurrentBlock('tPlaneta');
			$this->tpl->setVariable('_SELECCIONAPLANETADESTINO',_('Selecciona el planeta de destino'));
			$this->tpl->setVariable('_DESTINODELAMISION',_('Destino de la misi&#243;n'));

			$listaDestino=Array();
			foreach($planetas as $datos){
				//Si el planeta es diferente del origen y del destino
				if(($mision['idGalaxiaOrigen']!=$datos['idGalaxia'] || $mision['idPlanetaOrigen']!=$datos['idPlaneta']) && ($mision['idGalaxiaDestino']!=$datos['idGalaxia'] || $mision['idPlanetaDestino']!=$datos['idPlaneta'])){
					//Comprobamos si se puede viajar al planeta desde el origen
					if($mision['idGalaxiaDestino']==$datos['idGalaxia'] || ($stargateIntergalactico && $tipoMision==SOLDADO) || ($viajesIntergalacticos && $tipoMision==NAVE)){
						$listaDestino[0][count($listaDestino)]=$datos['idGalaxia'];
						$listaDestino[1][count($listaDestino)]=$datos['idPlaneta'];
						$this->tpl->setVariable('IDGALAXIA',$datos['idGalaxia']);
						$this->tpl->setVariable('IDPLANETA',$datos['idPlaneta']);
	
						if($datos['idPropietario']==''){
							if($datos['nombrePlaneta']=='')
								$this->tpl->setVariable('PLANETA',$datos['nombreSGC'].' '._('Riqueza').': '.$datos['riqueza'].'%');
							else
								$this->tpl->setVariable('PLANETA',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].') '._('Riqueza').': '.$datos['riqueza'].'%');
						}
						else{
							if($datos['nombrePlaneta']=='')
								$this->tpl->setVariable('PLANETA',$datos['nombreSGC'].' '._('Controlado por').': '.$datos['propietario']);
							else
								$this->tpl->setVariable('PLANETA',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].') '._('Controlado por').': '.$datos['propietario']);
						}
						$datosplaneta=$datos['idGalaxia'].'|'.$datos['idPlaneta'];
			        	$this->tpl->setVariable('DATOSPLANETA',$datosplaneta);
			        	
				       	$this->tpl->parseCurrentBlock();
					}
				}
			}

			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	    }
	    
		/**
	     * Muestra el modulo de nuevaMision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer pestana
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function mision($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/misiones.tpl');
	
			$this->tpl->setVariable('_NUEVAMISION',_('Nueva misi&#243;n'));
	
			$this->tpl->setVariable('CONTROLADOR','Misiones');
			$this->tpl->setVariable('ACCION','mision');
	
			//Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>