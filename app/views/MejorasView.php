<?php
	/**
	 * Vista del modulo de mejoras
	 *
	 * @author David & Jose
	 * @package views
	 * @since 15/04/2009
	 */
	
	
	
	/**
	 * Vista del modulo de mejoras
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 15/04/2009
	 */
	class MejorasView
	    extends ViewBase
	{
	    /**
	     * Muestra el menu de mejoras
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer grupos
	     * @param  String pestana
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function mejoras($grupos, $pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mejoras/mejoras.tpl');
	
			//Mostramos los grupos
			$primero=true;
	        foreach($grupos as $datos){
	        	if($primero){
	        		$this->tpl->setVariable('PESTANA',$pestana);
	        		$primero=false;
	        	}
				$this->tpl->setVariable('IDGRUPO',$datos['id']);
				$this->tpl->setVariable('NOMGRUPO',$datos['nombre']);
		       	$this->tpl->parse('tGrupo');
		       	$this->tpl->setVariable('IDGRUPO',$datos['id']);
		       	$this->tpl->parse('tGrupoPanel');
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra las una lista de mejoras
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer mejoras
	     * @param  Integer niveles
	     * @param  Integer recursos
	     * @param  Integer idMejoraActual
	     * @param  Integer tiempoRestante
	     * @param  Integer idRaza
	     * @param  Integer mejoraInvestigacion
	     * @param  Integer mejorasMejora
	     * @param  Integer nivelMinimoHiperpropulsion
	     * @param  Integer aumentoLimiteSoldados
	     * @param  Integer aumentoLimiteMisiones
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function mejorasLista($mejoras, $niveles, $recursos, $idMejoraActual, $tiempoRestante, $idRaza, $mejoraInvestigacion, $mejorasMejora, $nivelMinimoHiperpropulsion, $aumentoLimiteSoldados, $aumentoLimiteMisiones, $recursosActuales)
	    {
	    	//Actualizamos los recursos
	        $this->actualizarRecursos($recursosActuales[0]['cantidad'], $recursosActuales[1]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mejoras/mejorasLista.tpl');
	
	        if(count($mejoras)==0){
				$this->tpl->setVariable('_NOMEJORAS',_('No hay mejoras'));
				$this->tpl->parse('tNoMejoras');
				$this->tpl->hideBlock('tMejora');
			}
			else{
				$this->tpl->hideBlock('tNoMejoras');
				$this->tpl->setCurrentBlock('tMejora');
	
				$nivelMejora=array();
				if(count($niveles)>0){
					foreach($niveles as $datos){
						$nivelMejora[$datos['idMejora']]=$datos['nivel'];
					}
				}
	
				foreach($mejoras as $datos){
					//Si existe en el array es que no es nivel 0
					if(array_key_exists($datos['id'],$nivelMejora))
						$nivel=$nivelMejora[$datos['id']];
					else
						$nivel=0;
	
					$costePrimario=$datos['primario']*pow(2,$nivel);
					$costeSecundario=$datos['secundario']*pow(2,$nivel);
	
					$this->tpl->setVariable('_NIVELACTUAL',_('Nivel actual'));
					$this->tpl->setVariable('NIVEL',$nivel);
					$this->tpl->setVariable('NIVELSIG',$nivel+1);
					$this->tpl->setVariable('IDMEJORA',$datos['id']);
					$this->tpl->setVariable('NOMMEJORA',$datos['nombre']);
					$this->tpl->setVariable('MEJORAIMG',$_ENV['config']->get('mejoraImgFolder').$datos['id'].'.jpg');
					$this->tpl->setVariable('MEJORADESC',$datos['descripcion']);
					$this->tpl->setVariable('RECURSOPRINOM',$recursos[0]['nombre']);
					$this->tpl->setVariable('RECURSOSECNOM',$recursos[1]['nombre']);
					$this->tpl->setVariable('RECURSOPRIIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/1.png');
					$this->tpl->setVariable('RECURSOSECIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/2.png');
					$this->tpl->setVariable('TIEMPOIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/tiempo.png');
					$this->tpl->setVariable('_TIEMPO',_('Tiempo'));
					$this->tpl->setVariable('RECURSOPRICANT',$costePrimario);
					$this->tpl->setVariable('RECURSOSECCANT',$costeSecundario);
	
					//Mejoras de la mejora
					if(array_key_exists($datos['id'], $mejorasMejora)){
						$this->tpl->setVariable('_MEJORAS',_('Mejoras por nivel'));
						$unidadesConstruibles=array();
						foreach($mejorasMejora[$datos['id']] as $mejora){
							if($mejora['idTipo']==6){
								//Si es la mejora de viajes intergalacticos
								$this->tpl->setVariable('MEJORANOPOR',$mejora['atributo'].' '._('a nivel').' '.$nivelMinimoHiperpropulsion);
							}
							elseif($mejora['idTipo']==7){
								//Si es la mejora de limite de tropas
								$this->tpl->setVariable('PORCENTAJE','+'.$aumentoLimiteMisiones);
								$this->tpl->setVariable('MEJORA',$mejora['atributo']);
							}
							/*elseif($mejora['idTipo']==5){
								//Si es la mejora de limite de tropas
								$this->tpl->setVariable('PORCENTAJE','+'.$aumentoLimiteSoldados);
								$this->tpl->setVariable('MEJORA',$mejora['atributo']);
							}*/
							else{
								if($mejora['porcentaje']!=""){
									if($mejora['porcentaje']<0)
										$signoPorcentaje='-';
									else
										$signoPorcentaje='+';
									$this->tpl->setVariable('PORCENTAJE',$signoPorcentaje.$mejora['porcentaje'].'% ');
									$this->tpl->setVariable('MEJORA',$mejora['atributo'].' '.$mejora['unidad']);
								}
								else
									$this->tpl->setVariable('MEJORANOPOR',$mejora['atributo']);
							}
	
							$this->tpl->parse('tMejoraActual');
						}
					}
	
					//Calculamos el tiempo con las mejoras de investigacion
					//$tiempo=(round(($datos['tiempo']) / (($mejoraInvestigacion/100)+1)))*pow(2,$nivel); //Antigua formula de mejoras
					if($nivel>25)
						$nivel=25;
					$tiempo=(round(($datos['tiempo']) / (($mejoraInvestigacion/100)+1)))*pow(1+(1/pow($nivel+1,(1/4))),$nivel); //Nueva formula
					$this->tpl->setVariable('TIEMPODHMS',Funciones::dhms($tiempo));
	
					$this->tpl->setVariable('_INVESTIGAR',_('Investigar'));
					$this->tpl->setVariable('_NIVEL',_('Nivel'));
					$this->tpl->setVariable('TIEMPO',$tiempoRestante);
					$this->tpl->setVariable('_INVESTIGANDO',_('Investigando'));
					$this->tpl->setVariable('_CANCELAR',_('Cancelar'));
					$this->tpl->setVariable('ESTADOMEJ','-');
	
					if($idMejoraActual==$datos['id']){//Si es la mejora investigada
						$this->tpl->setVariable('DISPLAYINVESTIGAR','none');
						$this->tpl->setVariable('DISPLAYINVESTIGANDOACTUAL','block');
						$this->tpl->setVariable('DISPLAYINVESTIGANDO','none');
					}
					elseif($idMejoraActual==0 && ($costePrimario <= $recursos[0]['cantidad'] && $costeSecundario <= $recursos[1]['cantidad'])){//Si no se esta investigando y alcanzan los recursos
						$this->tpl->hideBlock('tInvestigandoActual');
						$this->tpl->setVariable('DISPLAYINVESTIGANDOACTUAL','none');
						$this->tpl->setVariable('DISPLAYINVESTIGAR','block');
						$this->tpl->setVariable('DISPLAYINVESTIGANDO','none');
					}
					else{//Si no es la mejora investigada
						if($idMejoraActual==0 && !($costePrimario <= $recursos[0]['cantidad'] && $costeSecundario <= $recursos[1]['cantidad'])){
							$this->tpl->setVariable('_RECURSOSINS',_('Recursos insuficientes'));
							$this->tpl->setVariable('ESTADOMEJ','');
						}
						$this->tpl->hideBlock('tInvestigandoActual');
						$this->tpl->setVariable('DISPLAYINVESTIGANDOACTUAL','none');
						$this->tpl->setVariable('DISPLAYINVESTIGAR','none');
						$this->tpl->setVariable('DISPLAYINVESTIGANDO','block');
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra la cuenta atras
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer tiempoRestante
	     * @param  Integer recursos
	     * @return mixed
	     * @since 15/04/2009
	     */
	    public function investigar($tiempoRestante, $recursos)
	    {
	        //Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mejoras/investigando.tpl');
	
			$this->tpl->setVariable('TIEMPO',$tiempoRestante);
			$this->tpl->setVariable('_INVESTIGANDO',_('Investigando'));
			$this->tpl->setVariable('_CANCELAR',_('Cancelar'));
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	    }
	}
?>