<?php
	/**
	 * Vista del modulo de galaxias
	 *
	 * @author David & Jose
	 * @package views
	 * @since 14/06/2009
	 */
	
	
	
	/**
	 * Vista del modulo de galaxias
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 14/06/2009
	 */
	class GalaxiasView
	    extends ViewBase
	{
	    /**
	     * Página principal del modulo de galaxias
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String pestana
	     * @return mixed
	     * @since 14/06/2009
	     */
	    public function galaxias($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('galaxias/galaxias.tpl');
	
			$this->tpl->setVariable('_GALAXIAS',_('Galaxias'));
			$this->tpl->setVariable('_BUSCADOR',_('Buscador'));
	
			//Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Listados de galaxias
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer galaxias
	     * @param  Integer galaxiaSel
	     * @param  Integer sectorSel
	     * @param  Integer cuadranteSel
	     * @param  Integer planetas
	     * @param  Integer idRaza
	     * @param  Integer idGalaxiaOrigen
	     * @param  Boolean viajeIntergalactico
	     * @param  Boolean stargateIntergalactico
	     * @return mixed
	     * @since 14/06/2009
	     */
	    public function galaxiasLista($galaxias, $galaxiaSel, $sectorSel, $cuadranteSel, $planetas = null, $idRaza = null, $idGalaxiaOrigen = null, $viajeIntergalactico = null, $stargateIntergalactico = null, $hayExplorador = null, $numMisiones = null, $mejoraLimiteMisiones = null)
	    {
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('galaxias/galaxiasLista.tpl');
	
			$this->tpl->setVariable('_SELECCIONEGALAXIA',_('Seleccione una galaxia'));
			$this->tpl->setVariable('_SELECCIONESECTOR',_('Seleccione un sector'));
			$this->tpl->setVariable('_SELECCIONECUADRANTE',_('Seleccione un cuadrante'));
	
			$this->tpl->setVariable('_DEBIL',_('D&#233;bil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	        $this->tpl->setVariable('RAZAICO',$idRaza);
	        
	        $this->tpl->setVariable('_DEBILDESC',_('Los jugadores son d&#233;biles cuando tienen menos de '.$_ENV['config']->get('puntuacionDebil').' puntos de investigaci&#243;n, los jugadores d&#233;biles solo pueden atacar a jugadores d&#233;biles y solo pueden ser atacados por jugadores d&#233;biles.'));
	        $this->tpl->setVariable('_INACTIVODESC',_('El usuario lleva sin entrar al juego mas de 15 dias.'));
	        $this->tpl->setVariable('_VACACIONESDESC',_('El usuario está en modo vacaciones, no participar&#225; en las batallas y permanecer&#225; en este modo al menos 48 horas.'));
	        
			//Montamos las galaxias
			if(count($galaxias)!=0){
				$this->tpl->setCurrentBlock('tGalaxia');
	
				foreach($galaxias as $datos){
					$this->tpl->setVariable('IDGALAXIA',$datos['id']);
					$this->tpl->setVariable('NOMGALAXIA',$datos['nombre']);
					$this->tpl->setVariable('NUMPLANETAS',$datos['nPlanetas']);
	
					//Comprobamos si hay galaxia seleccionada
					if($datos['id']==$galaxiaSel){
						$this->tpl->setVariable('GALAXIASEL','selected="selected"');
						//Mostramos los sectores de la galaxia
						$numSectores=$datos['nPlanetas']/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas');
						for($s=1;$s<=$numSectores;$s++){
							$this->tpl->setVariable('IDSECTOR',$s);
							$this->tpl->setVariable('NOMSECTOR',_('Sector').' '.$s);
	
							//Comprobamos si hay sector seleccionado
							if($s==$sectorSel){
								$this->tpl->setVariable('SECTORSEL','selected="selected"');
								//Mostramos los cuadrantes del sector
								for($c=1;$c<=$_ENV['config']->get('numCuadrantes');$c++){
									$this->tpl->setVariable('IDCUADRANTE',$c);
									$this->tpl->setVariable('NOMCUADRANTE',_('Cuadrante').' '.$c);
	
									//Comprobamos si hay cuadrante seleccionado
									if($c==$cuadranteSel){
										$this->tpl->setVariable('CUADRANTESEL','selected="selected"');
									}
							       	$this->tpl->parse('tCuadrante');
								}
							}
					       	$this->tpl->parse('tSector');
						}
					}
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
			//Si hay planetas los cargamos
			if($planetas!=null && count($planetas)>0){
				$this->tpl->addBlockfile ('PLANETAS', 'tPlanetas', 'galaxias/cuadrante.tpl');
				$this->tpl->setCurrentBlock('tPlaneta');
				
				//Guardamos el id de los exploradores
				$this->tpl->setVariable('IDEXPLORADOR',$hayExplorador);
	
				foreach($planetas as $datos){
					$this->tpl->setVariable('IDGALPLANETA',$datos['idGalaxia']);
					$this->tpl->setVariable('IDPLANETA',$datos['idPlaneta']);
					//Iconos de accion
					$this->tpl->setVariable('IDRAZA',$idRaza);
					$this->tpl->setVariable('_ENVIARNAVES',_('Enviar naves'));
					$this->tpl->setVariable('_ENVIARTROPAS',_('Enviar tropas'));
					$this->tpl->setVariable('_ENVIARDEFENSAS',_('Enviar defensas'));
					$this->tpl->setVariable('_ENVIAREXPLORAR',_('Enviar exploraci&#243;n'));

					//Comprobamos si se pueden hacer viajes intergalacticos
					if($datos['idGalaxia']!=$idGalaxiaOrigen && !$viajeIntergalactico)
						$this->tpl->hideBlock('tNaves');
					if($datos['idGalaxia']!=$idGalaxiaOrigen && !$stargateIntergalactico)
						$this->tpl->hideBlock('tSoldados');
					//Si no es tu planeta
					if(!$datos['propio'] || $datos['idGalaxia']!=$idGalaxiaOrigen && !$stargateIntergalactico)
						$this->tpl->hideBlock('tDefensas');
					//Si no tienes exploradores
					if(!intval($hayExplorador) || $datos['propio'] || $numMisiones>=$mejoraLimiteMisiones)
						$this->tpl->hideBlock('tExplorar');
					//Si ya esta en la lista
					if($datos['explorado']){
						if($datos['visible'])
							$this->tpl->setVariable('_ELIMINARTULISTA',_('Eliminar de Tu Lista'));
						else
							$this->tpl->setVariable('_ANADIRTULISTA',_('A&#241;adir a Tu Lista'));
					}
					//Si tiene nombre y esta explorado
					if($datos['nombrePlaneta']!='' && $datos['explorado'])
						$this->tpl->setVariable('NOMPLANETA',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].')');
					else
						$this->tpl->setVariable('NOMPLANETA',$datos['nombreSGC']);
					//Si tiene usuario y esta explorado
					if($datos['idPropietario'] && $datos['explorado']){
						$this->tpl->setVariable('PLANETAUSR',$datos['propietario']);
						$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
						$this->tpl->setVariable('RAZA',$datos['raza']);
						if($datos['idAlianza']!='')
							$this->tpl->setVariable('PLANETAALZ','('.$datos['alianza'].')');
						//Ponemos los iconos
						if($datos['vacaciones']){
							$this->tpl->setVariable('_VACACIONESICO',_('Vacaciones'));
							$this->tpl->setVariable('IDRAZAVACACIONESICO',$idRaza);
						}
						if($datos['inactivo']){
							$this->tpl->setVariable('_INACTIVOICO',_('Inactivo'));
							$this->tpl->setVariable('IDRAZAINACTIVOICO',$idRaza);
						}
						if($datos['debil']){
							$this->tpl->setVariable('_DEBILICO',_('D&#233;bil'));
							$this->tpl->setVariable('IDRAZADEBILICO',$idRaza);
						}
					}
					//Si esta explorado
					if($datos['explorado']){
						$this->tpl->setVariable('RIQUEZA',$datos['riqueza'].'%');
						$this->tpl->setVariable('IMGPLANETA',$_ENV['config']->get('planetaImgFolder').$datos['imagen']);
					}
					else{
						$this->tpl->setVariable('IMGPLANETA',$_ENV['config']->get('planetaImgFolder').'sinexplo.jpg');
					}
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Plantilla para select
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer numero
	     * @param  String nombre
	     * @return mixed
	     * @since 17/06/2009
	     */
	    public function elegir($numero, $nombre)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('galaxias/galaxiasSelect.tpl');
	
			//Montamos los sectores
			$this->tpl->setCurrentBlock('tBloque');
	
			for($i=1;$i<=$numero;$i++){
				$this->tpl->setVariable('ID',$i);
				$this->tpl->setVariable('NOMBRE',$nombre.' '.$i);
	
		       	$this->tpl->parseCurrentBlock();
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el buscador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer galaxias
	     * @return mixed
	     * @since 01/07/2009
	     */
	    public function buscador($galaxias,$idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('galaxias/buscador.tpl');
	
			//Idioma
			$this->tpl->setVariable('_BUSCAR',_('Buscar'));
			$this->tpl->setVariable('_PROPIETARIO',_('Propietario'));
			$this->tpl->setVariable('_NOMBREPLANETA',_('Nombre planeta'));
			$this->tpl->setVariable('_NOMBREPLANETASGC',_('Nombre planeta SGC'));
			$this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_TODASGALAXIAS',_('Todas las galaxias'));
			$this->tpl->setVariable('_MENSAJEBUSCAR',_('Utilice el buscador para buscar entre sus planetas explorados'));
	
	    	//Listamos las galaxias
			$this->tpl->setCurrentBlock('tGalaxia');
			
			$this->tpl->setVariable('IDRAZA',$idRaza);
	
			foreach($galaxias as $galaxia){
				$this->tpl->setVariable('IDGALAXIA',$galaxia['id']);
				$this->tpl->setVariable('NOMGALAXIA',$galaxia['nombre']);
	
		       	$this->tpl->parseCurrentBlock();
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra los planetas de un cuadrante
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @param  Integer idRaza
	     * @param  Integer idGalaxiaOrigen
	     * @param  Boolean viajeIntergalactico
	     * @param  Boolean stargateIntergalactico
	     * @return mixed
	     * @since 01/07/2009
	     */
	    public function cuadrante($planetas, $idRaza, $idGalaxiaOrigen, $viajeIntergalactico, $stargateIntergalactico, $hayExplorador,$numMisiones,$mejoraLimiteMisiones,$idGalaxiaExplorado=null,$idPlanetaExplorado=null)
	    {
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('galaxias/cuadrante.tpl');
	
			//Montamos las galaxias
			if(count($planetas)!=0){
				$this->tpl->setCurrentBlock('tPlaneta');
	
				//Inicializamos el idGalaxia
				$idGalaxia=0;
				
				//Guardamos el id de los exploradores
				$this->tpl->setVariable('IDEXPLORADOR',$hayExplorador);
	
				//Recorremos los planetas
				foreach($planetas as $datos){
					//Identificadores del planeta
					$this->tpl->setVariable('IDGALPLANETA',$datos['idGalaxia']);
					$this->tpl->setVariable('IDPLANETA',$datos['idPlaneta']);
	
					//Iconos de accion
					$this->tpl->setVariable('IDRAZA',$idRaza);
					$this->tpl->setVariable('_ENVIARNAVES',_('Enviar naves'));
					$this->tpl->setVariable('_ENVIARTROPAS',_('Enviar tropas'));
					$this->tpl->setVariable('_ENVIARDEFENSAS',_('Enviar defensas'));
					$this->tpl->setVariable('_ENVIAREXPLORAR',_('Enviar exploraci&#243;n'));
	
					//Comprobamos si se pueden hacer viajes intergalacticos
					if($datos['idGalaxia']!=$idGalaxiaOrigen && !$viajeIntergalactico)
						$this->tpl->hideBlock('tNaves');
					if($datos['idGalaxia']!=$idGalaxiaOrigen && !$stargateIntergalactico)
						$this->tpl->hideBlock('tSoldados');
					//Si no es tu planeta
					if(!$datos['propio'] || $datos['idGalaxia']!=$idGalaxiaOrigen && !$stargateIntergalactico)
						$this->tpl->hideBlock('tDefensas');
					//Si no tienes exploradores o estas explorandolo
					if(!intval($hayExplorador) || $datos['propio'] || $numMisiones>=$mejoraLimiteMisiones || ($datos['idGalaxia']==$idGalaxiaExplorado && $datos['idPlaneta']==$idPlanetaExplorado) || $datos['idGalaxia']!=$idGalaxiaOrigen && !$stargateIntergalactico)
						$this->tpl->hideBlock('tExplorar');
					//Si ya esta en la lista
					if($datos['explorado']){
						if($datos['visible'])
							$this->tpl->setVariable('_ELIMINARTULISTA',_('Eliminar de Tu Lista'));
						else
							$this->tpl->setVariable('_ANADIRTULISTA',_('A&#241;adir a Tu Lista'));
					}
					//Si tiene nombre y esta explorado
					if($datos['nombrePlaneta']!='' && $datos['explorado'])
						$this->tpl->setVariable('NOMPLANETA',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].')');
					else
						$this->tpl->setVariable('NOMPLANETA',$datos['nombreSGC']);
					//Si tiene usuario y esta explorado
					if($datos['idPropietario']!='' && $datos['explorado']){
						$this->tpl->setVariable('PLANETAUSR',$datos['propietario']);
						$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
						$this->tpl->setVariable('RAZA',$datos['raza']);
						if($datos['idAlianza']!='')
							$this->tpl->setVariable('PLANETAALZ','('.$datos['alianza'].')');
						//Ponemos los iconos
						if($datos['vacaciones']){
							$this->tpl->setVariable('_VACACIONESICO',_('Vacaciones'));
							$this->tpl->setVariable('IDRAZAVACACIONESICO',$idRaza);
						}
						if($datos['inactivo']){
							$this->tpl->setVariable('_INACTIVOICO',_('Inactivo'));
							$this->tpl->setVariable('IDRAZAINACTIVOICO',$idRaza);
						}
						if($datos['debil']){
							$this->tpl->setVariable('_DEBILICO',_('D&#233;bil'));
							$this->tpl->setVariable('IDRAZADEBILICO',$idRaza);
						}
					}
	
					//Si esta explorado
					if($datos['explorado']){
						$this->tpl->setVariable('RIQUEZA',$datos['riqueza'].'%');
						$this->tpl->setVariable('IMGPLANETA',$_ENV['config']->get('planetaImgFolder').$datos['imagen']);
					}
					else{
						$this->tpl->setVariable('IMGPLANETA',$_ENV['config']->get('planetaImgFolder').'sinexplo.jpg');
					}
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra la lista de planetas buscados
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscar($planetas)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Ocultamos bloques innecesasios
			$this->tpl->hideBlock('tIconos');
	
			if(count($planetas)==0){
				$this->tpl->setVariable('_NOPLANETAS',_('No se han encontrado planetas'));
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
			}
			else{
				//Idioma
				$this->tpl->setVariable('_USUARIO',_('Usuario'));
		        $this->tpl->setVariable('_PLANETA',_('Planeta'));
		        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
		        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
				$this->tpl->setVariable('_OPCIONES',_('Opciones'));
		        $this->tpl->setVariable('_PLANETAS',_('Planetas'));
	
		        $this->tpl->hideBlock('tNoPlanetas');
				$this->tpl->setCurrentBlock('tPlaneta');
	
				//Inicializamos el idGalaxia
				$idGalaxia=0;
	
				foreach($planetas as $datos){
					//Mostramos la galaxia si es necesario
					if($idGalaxia!=$datos['idGalaxia']){
						$idGalaxia=$datos['idGalaxia'];
						$this->tpl->setVariable('NOMGALAXIA',$datos['galaxia']);
						$this->tpl->parse('tGalaxia');
	
					}
	
					//Datos del planeta
					$this->tpl->setVariable('PLANETAIDGALAXIA',$datos['idGalaxia']);
					$this->tpl->setVariable('PLANETAIDSECTOR',$datos['idSector']);
					$this->tpl->setVariable('PLANETAIDCUADRANTE',$datos['idCuadrante']);
					$this->tpl->setVariable('PLANETAID',$datos['idPlaneta']);
	
					if($datos['nombrePlaneta']=='')
						$this->tpl->setVariable('PLANETANOM',$datos['nombreSGC']);
					else
						$this->tpl->setVariable('PLANETANOM',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].')');
		        
		        	$this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$datos['imagen']);
		        	$this->tpl->setVariable('PLANETARIQ',$datos['riqueza']);
		        
		        	if($datos['idPropietario']==''){
						$this->tpl->setVariable('PLANETAUSR','-');
						$this->tpl->setVariable('PLANETAALZ','');
		        	}
					else{
						$this->tpl->setVariable('PLANETAUSR',$datos['propietario']);
						if($datos['idAlianza']!='')
							$this->tpl->setVariable('PLANETAALZ','('.$datos['alianza'].')');
					}
		        
		        	$this->tpl->setVariable('PLANETANOTA',$datos['nota']);
		        
		        	$this->tpl->setVariable('_ENVIARTROPAS',_('Enviar tropas'));
	        		$this->tpl->setVariable('_ENVIARNAVES',_('Enviar naves'));
					$this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));
	        		if($datos['visible'])
	        			$this->tpl->setVariable('_ELIMINARTULISTA',_('Eliminar de Tu Lista'));
					else
						$this->tpl->setVariable('_ANADIRTULISTA',_('A&#241;adir a Tu Lista'));
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>