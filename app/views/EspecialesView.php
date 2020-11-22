<?php
	/**
	 * Vista del modulo de especiales
	 *
	 * @author David & Jose
	 * @package views
	 * @since 15/07/2009
	 */
	
	
	
	/**
	 * Vista del modulo de especiales
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 15/07/2009
	 */
	class EspecialesView
	    extends ViewBase
	{
	    /**
	     * Muestra los especiales de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer especiales
	     * @param  Integer planetas
	     * @return mixed
	     * @since 15/07/2009
	     */
	    public function especiales($especiales, $planetas)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('especiales/especiales.tpl');
	
	        //Idioma
	        $this->tpl->setVariable('_CERRAR',_('Cerrar'));
	        
	        if(count($especiales)==0){
				$this->tpl->setVariable('_NOESPECIALES',_('No hay especiales'));
				$this->tpl->parse('tNoEspeciales');
				$this->tpl->hideBlock('tEspecial');
			}
			else{
				$this->tpl->addBlockfile('ESPECIAL','tDatosEspecial','especiales/especial.tpl');
				$this->tpl->hideBlock('tNoEspeciales');
				$this->tpl->setCurrentBlock('tEspecial');
				foreach($especiales as $datos){
					if($datos['activo']){
						$this->tpl->setVariable('ESPECIALID',$datos['idEspecial']);
						$this->tpl->setVariable('ESPECIALNOM',$datos['nombre']);
						$this->tpl->setVariable('ESPECIALESP',$datos['especificacion']);
						$this->tpl->setVariable('ESPECIALDESC',$datos['descripcion']);
						$this->tpl->setVariable('TIEMPODURACION',$datos['tiempoDuracion']);
						$this->tpl->setVariable('TIEMPODURACIONRESTANTE',$datos['tiempoDuracionRestante']);
						$this->tpl->setVariable('TIEMPORECARGA',$datos['tiempoRecarga']);
						$this->tpl->setVariable('TIEMPORECARGARESTANTE',$datos['tiempoRecargaRestante']);
						$this->tpl->setVariable('EFECTO',_('Efecto'));
						$this->tpl->setVariable('DURACION',_('Duraci&#243;n'));
						$this->tpl->setVariable('RECARGA',_('Recarga'));
						$this->tpl->setVariable('DURACIONTIEMPO',Funciones::dhms($datos['tiempoDuracion']));
						$this->tpl->setVariable('DURACIONRECARGA',Funciones::dhms($datos['tiempoRecarga']));
						$this->tpl->setVariable('ESPECIALIMGACTIVO',$_ENV['config']->get('especialImgFolder').$datos['idEspecial'].'activo.png');
						$this->tpl->setVariable('ESPECIALIMGRECARGA',$_ENV['config']->get('especialImgFolder').$datos['idEspecial'].'inactivo.png');
						$this->tpl->setVariable('_ACTIVO',_('Activo'));
						$this->tpl->setVariable('_RECARGANDO',_('Recargando'));
						$this->tpl->setVariable('_ACTIVAR',_('Activar'));
		
						//Si el especial no esta recargando
						if($datos['tiempoRecargaRestante']!=0){
							//Si el especial no esta activo
							if($datos['tiempoDuracionRestante']!=0)
								$this->tpl->setVariable('ESPECIALIMG',$_ENV['config']->get('especialImgFolder').$datos['idEspecial'].'activo.png');
							else
								$this->tpl->setVariable('ESPECIALIMG',$_ENV['config']->get('especialImgFolder').$datos['idEspecial'].'inactivo.png');
						}
						else{
							$this->tpl->setVariable('ESPECIALIMG',$_ENV['config']->get('especialImgFolder').$datos['idEspecial'].'inactivo.png');
						}
		
						$this->tpl->parseCurrentBlock();
					}
				}
			}
	
			//Planetas
			$this->tpl->setVariable('_ELIJAPLANETADESTINO',_('Elija el planeta de destino del especial'));
			$this->tpl->setVariable('_SELECCIONAPLANETA',_('Seleccionar Planeta'));
			if(count($planetas)!=0){
				$this->tpl->setCurrentBlock('tPlanetasEnemigos');
				foreach($planetas as $datos){
					if($datos['nombrePlaneta']=='')
						$this->tpl->setVariable('PLANETANOMBRE',$datos['nombreSGC'].' '._('Controlado por').': '.$datos['propietario']);
					else
						$this->tpl->setVariable('PLANETANOMBRE',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].') '._('Controlado por').': '.$datos['propietario']);
		        	$datosplaneta=$datos['idGalaxia'].'|'.$datos['idPlaneta'];
		        	$this->tpl->setVariable('DATOSPLANETA',$datosplaneta);
				    $this->tpl->parseCurrentBlock();
				}
			}
	
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	    
	    public function actualizarDatos($primario, $secundario, $energia){
	    	$this->actualizarProducciones($primario, $secundario, $energia);
	    }
	}
?>