<?php
	/**
	 * Vista del modulo de planetas
	 *
	 * @author David & Jose
	 * @package views
	 * @since 06/02/2009
	 */
	
	
	
	/**
	 * Vista del modulo de planetas
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 06/02/2009
	 */
	class PlanetasView
	    extends ViewBase
	{
	    /**
	     * Carga las variables en la plantilla y la muestra
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String pestana
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function show($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetas.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_TULISTA',_('Tu lista'));
	        $this->tpl->setVariable('_PROPIOS',_('Propios'));
	        $this->tpl->setVariable('_ALIADOS',_('Aliados'));
	        $this->tpl->setVariable('_ENEMIGOS',_('Enemigos'));
			$this->tpl->setVariable('_NEUTRALES',_('Neutrales'));
	        $this->tpl->setVariable('_NAVES',_('Naves'));
	        $this->tpl->setVariable('_DEFENSAS',_('Defensas'));
	        
	        //Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra la lista personalizada del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer planetas
	     * @param  Integer numPlanetasPag
	     * @param  Integer numPlanetasTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function tuLista($idJugador, $planetas, $numPlanetasPag, $numPlanetasTotal = null, $pag = null, $idRaza = null)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Idioma
	        $this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	        
			$this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PLANETA',_('Planeta'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_OPCIONES',_('Opciones'));       
	        $this->tpl->setVariable('_PLANETASOCULTOS',_('planetas ocultos'));
	        $this->tpl->setVariable('_PLANETAS',_('Planetas'));
	
			if(count($planetas)==0){
				$this->tpl->setVariable('IDRAZANOPLANETAS',$idRaza);
				$this->tpl->setVariable('_NOPLANETAS',_('No hay planetas en Tu Lista'));
				$this->tpl->hideBlock('tIconos');
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
			}
			else{
				$this->tpl->hideBlock('tNoPlanetas');
	
				//Mensaje de confirmacion
				$this->tpl->setVariable('_CONFABANDONAR',_('&#191;Realmente desea abandonar el planeta&#63; Este proceso es irreversible y perder&#225;s los h&#233;roes construidos en el planeta.'));
	
				//Paginamos
				$paginas=ceil($numPlanetasTotal/$numPlanetasPag);
				$this->tpl->setCurrentBlock('tPagPlaneta');
	
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numPlanetasPag));
					$this->tpl->setVariable('ACCION','tuLista');
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tPlaneta');
	
				foreach($planetas as $datos){
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
						if($datos['alianza']!='')
							$this->tpl->setVariable('PLANETAALZ','('.$datos['alianza'].')');
					}
		        
		        	$this->tpl->setVariable('PLANETANOTA',$datos['nota']);
		        
		        	$this->tpl->setVariable('_ENVIARTROPAS',_('Enviar tropas'));
	        		$this->tpl->setVariable('_ENVIARNAVES',_('Enviar naves'));
					$this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));
					/*if($datos['idPropietario']==$idJugador)
						$this->tpl->setVariable('_ABANDONAR',_('Abandonar'));*/
	        		$this->tpl->setVariable('_ELIMINARTULISTA',_('Eliminar de Tu Lista'));
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Lista los planetas propios
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @param  String jugador
	     * @param  Integer limitePlanetas
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasPropios($planetas, $jugador, $limitePlanetas, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Idioma
			$this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PLANETA',_('Planeta'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        
			//Organizamos los bloques
			$this->tpl->hideBlock('tPaginacion');
			$this->tpl->hideBlock('tIconos');
	
			if(count($planetas)==0){
				$this->tpl->setVariable('IDRAZANOPLANETAS',$idRaza);
				$this->tpl->setVariable('_NOPLANETAS',_('No hay planetas propios'));
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
				$this->tpl->hideBlock('tLimite');
			}
			else{
				$this->tpl->hideBlock('tNoPlanetas');
	
				//Mostramos el limite de planetas
				$this->tpl->setVariable('IDRAZALIMITE',$idRaza);
				$this->tpl->setVariable('_MENSAJELIMITE',_('Actualmente controlas').' <span class="tropasCantidad">'.count($planetas).'</span>/'.$limitePlanetas.' '._('planetas').'.');
				$this->tpl->parse('tLimite');
	
				//Mensaje de confirmacion
				$this->tpl->setVariable('_CONFABANDONAR',_('&#191;Realmente desea abandonar el planeta&#63; Este proceso es irreversible.'));
	
				$this->tpl->setCurrentBlock('tPlaneta');
	
				foreach($planetas as $datos){
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
		        
		        	$this->tpl->setVariable('PLANETAUSR',$jugador);
					$this->tpl->setVariable('PLANETAALZ','');
		        
		        	$this->tpl->setVariable('PLANETANOTA',$datos['nota']);
		        
		        	$this->tpl->setVariable('_ENVIARTROPAS',_('Enviar tropas'));
	        		$this->tpl->setVariable('_ENVIARNAVES',_('Enviar naves'));
					$this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));
					if(!$datos['principal'])
						$this->tpl->setVariable('_ABANDONAR',_('Abandonar'));
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
	
	    /**
	     * Lista los planetas aliados
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @param  Integer numPlanetasPag
	     * @param  Integer numPlanetasTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasAliados($planetas, $numPlanetasPag, $numPlanetasTotal, $pag, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Idioma
			$this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	
			$this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PLANETA',_('Planeta'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	
			if(count($planetas)==0){
				$this->tpl->setVariable('IDRAZANOPLANETAS',$idRaza);
				$this->tpl->setVariable('_NOPLANETAS',_('No hay planetas aliados'));
				$this->tpl->hideBlock('tIconos');
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
			}
			else{
				$this->tpl->hideBlock('tNoPlanetas');
	
				//Paginamos
				$paginas=ceil($numPlanetasTotal/$numPlanetasPag);
				$this->tpl->setCurrentBlock('tPagPlaneta');
	
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numPlanetasPag));
					$this->tpl->setVariable('ACCION','planetasAliados');
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tPlaneta');
	
				foreach($planetas as $datos){
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
	
	    /**
	     * Lista los planetas enemigos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @param  Integer numPlanetasPag
	     * @param  Integer numPlanetasTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasEnemigos($planetas, $numPlanetasPag, $numPlanetasTotal, $pag, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Idioma
			$this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	
			$this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PLANETA',_('Planeta'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	
			if(count($planetas)==0){
				$this->tpl->setVariable('IDRAZANOPLANETAS',$idRaza);
				$this->tpl->setVariable('_NOPLANETAS',_('No hay planetas enemigos'));
				$this->tpl->hideBlock('tIconos');
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
			}
			else{
				$this->tpl->hideBlock('tNoPlanetas');
	
				//Paginamos
				$paginas=ceil($numPlanetasTotal/$numPlanetasPag);
				$this->tpl->setCurrentBlock('tPagPlaneta');
	
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numPlanetasPag));
					$this->tpl->setVariable('ACCION','planetasEnemigos');
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tPlaneta');
	
				foreach($planetas as $datos){
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
	
	    /**
	     * Lista los planetas neutrales
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planetas
	     * @param  Integer numPlanetasPag
	     * @param  Integer numPlanetasTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 06/02/2009
	     */
	    public function planetasNeutrales($planetas, $numPlanetasPag, $numPlanetasTotal, $pag, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('planetas/planetasLista.tpl');
	
			//Idioma
			$this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PLANETA',_('Planeta'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_RIQUEZA',_('Riqueza'));
			$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        
			//Organizamos los bloques
			$this->tpl->hideBlock('tIconos');
	
			if(count($planetas)==0){
				$this->tpl->setVariable('IDRAZANOPLANETAS',$idRaza);
				$this->tpl->setVariable('_NOPLANETAS',_('No hay planetas neutrales'));
				$this->tpl->parse('tNoPlanetas');
				$this->tpl->hideBlock('tPlanetas');
			}
			else{
				$this->tpl->hideBlock('tNoPlanetas');
	
				//Paginamos
				$paginas=ceil($numPlanetasTotal/$numPlanetasPag);
				$this->tpl->setCurrentBlock('tPagPlaneta');
	
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numPlanetasPag));
					$this->tpl->setVariable('ACCION','planetasNeutrales');
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tPlaneta');
	
				foreach($planetas as $datos){
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
		        
		        	$this->tpl->setVariable('PLANETAUSR','-');
					$this->tpl->setVariable('PLANETAALZ','');
		        
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