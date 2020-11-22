<?php
	/**
	 * Vista del index
	 *
	 * @author David & Jose
	 * @package views
	 * @since 27/01/2009
	 */



	/**
	 * Vista del index
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 27/01/2009
	 */
	class IndexView
	    extends ViewBase
	{
	    /**
	     * Carga las variables en la plantilla y la muestra
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer raza
	     * @param  Integer recursos
	     * @param  Integer planetas
	     * @param  Integer consTropa
	     * @param  Integer consNave
	     * @param  Integer consDefensa
	     * @param  Integer logotipo
	     * @param  Integer numMensajesNuevos
	     * @param  String centro
	     * @since 27/01/2009
	     */
	    public function show(&$raza, $recursos, $planetas = null, $consTropa = null, $consNave = null, $consDefensa = null, $logotipo = null, $numMensajesNuevos = null, $centro = null, $stargateIntergalactico = null)
	    {
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('index/index.tpl');

			//Asignamos los datos de raza
			$vars['IDRAZA']=$raza['id'];
			$vars['RAZA']=strtolower(strtr($raza['nombre'], Array('\'' => '')));
	        $vars['RAZANOM']=$raza['nombre'];

	        //Asignamos los datos del logotipo
			$vars['LOGOTIPO']=$_ENV['config']->get('logotipoImgFolder').$logotipo['ruta'];
	        $vars['LOGOTIPONOM']=$logotipo['nombre'];

			//Asignamos los recursos
			//Nombres //1 -> Primario, 2 -> Secundario, 3 -> Energia
			$vars['RECURSOPRINOM']=$recursos[0]['nombre'];
	        $vars['RECURSOSECNOM']=$recursos[1]['nombre'];
	        $vars['ENERGIANOM']=$recursos[2]['nombre'];

			$vars['RECURSOPRI']=floor($recursos[0]['cantidad']);
	        $vars['RECURSOSEC']=floor($recursos[1]['cantidad']);
	        $vars['ENERGIA']=floor($recursos[2]['cantidad']);
	        $vars['RECURSOPRICANT']=$recursos[0]['cantidad'];
	        $vars['RECURSOSECCANT']=$recursos[1]['cantidad'];
	        //Producciones
	        $vars['RECURSOPRIPRO']=$recursos[0]['produccion'];
	        $vars['RECURSOSECPRO']=$recursos[1]['produccion'];
	        $vars['ENERGIATOTAL']=floor($recursos[2]['produccion']);

	        //Asignamos el JS
	        $vars['STARGATEINTERGALACTICO']=intval($stargateIntergalactico);

	        //Asignamos los planetas
			//Planeta seleccionado
			$this->tpl->addBlockfile('PLANETA','tPlanetaDatos','index/planetaDatos.tpl');
			$vars['PLANETASELIMG']=$_ENV['config']->get('planetaImgFolder').$planetas[0]['imagen'];
			$vars['IDPLANETASEL']=$planetas[0]['idPlaneta'];
			$vars['IDGALAXIASEL']=$planetas[0]['idGalaxia'];
			$vars['IDSECTORSEL']=$planetas[0]['idSector'];
			$vars['IDCUADRANTESEL']=$planetas[0]['idCuadrante'];
			$vars['PLANETASELNOMUSUARIO']=$planetas[0]['nombrePlaneta'];
			if($planetas[0]['nombrePlaneta']==NULL)
	        	$vars['PLANETASELNOM']=$planetas[0]['nombreSGC'];
	        else
	        	$vars['PLANETASELNOM']=$planetas[0]['nombrePlaneta'].' ('.$planetas[0]['nombreSGC'].')';
	        //Asignamos los datos javascript para el planeta seleccionado
	        $vars['IDPLANETA']=$planetas[0]['idPlaneta'];
	        $vars['IDGALAXIA']=$planetas[0]['idGalaxia'];
	        //Dibujamos las coordenadas
	        $this->tpl->setCurrentBlock('tDibCoordenadas');
			for ($i=1;$i<=7;$i++) {
			    $this->tpl->setVariable('COORD', $planetas[0]['coord'.$i]);
			    $this->tpl->setVariable('IDSIMBOLO', $i);
			    $this->tpl->setVariable('IMGCOORD', $_ENV['config']->get('simbolosImgFolder').$planetas[0]['idGalaxia'].'/'.str_pad($planetas[0]['coord'.$i], 2, "0", STR_PAD_LEFT).'.gif');
			    $this->tpl->parseCurrentBlock();
			}
			//Lista de planetas
			$this->tpl->addBlockfile('PLANETALISTA','tPlanetaLista','index/planetaLista.tpl');
			$this->tpl->setCurrentBlock('tListaPlaneta');

			$numPlanetas=count($planetas);

			for($i=1; $i<$numPlanetas; ++$i){
				if($planetas[$i]['nombrePlaneta']=='')
					$this->tpl->setVariable('PNOMBRELST',$planetas[$i]['nombreSGC']);
				else
					$this->tpl->setVariable('PNOMBRELST',$planetas[$i]['nombrePlaneta'].' ('.$planetas[$i]['nombreSGC'].')');
	        	$datosplaneta=$planetas[$i]['idGalaxia'].'|'.$planetas[$i]['idPlaneta'].'|'.$_ENV['config']->get('planetaImgFolder').$planetas[$i]['imagen'];
	        	$this->tpl->setVariable('DATOSPLANETALST',$datosplaneta);
			    $this->tpl->parseCurrentBlock();
			}

			//Construcciones actuales
			$this->tpl->addBlockfile('CONSTRUCCIONPLANETA','tConstruccionPlaneta','index/construccionPlaneta.tpl');
			$this->tpl->parse('tConstruccionPlaneta');
			//Bloque de no hay construcciones
			$this->tpl->addBlockfile('NOCONSTRUCCIONES','tNoConstrucciones','index/noConstrucciones.tpl');
			$this->tpl->setVariable('_NOCONSTRUCCIONES',_('No hay construcciones'));
			//Bloque de construcciones
			$this->tpl->addBlockfile('CONSTRUCCIONES','tConstrucciones','index/construcciones.tpl');
			//$this->tpl->parse('tConstrucciones');
			if($consTropa==null && $consNave==null && $consDefensa==null){
				$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','none');
				$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','block');
				$this->tpl->setVariable('DISPLAYTROPA','none');
				$this->tpl->setVariable('DISPLAYNAVE','none');
				$this->tpl->setVariable('DISPLAYDEFENSA','none');
			}
			else{
				$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','block');
				$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','none');
				//Tropa en construccion
				if($consTropa!=null){
					$this->tpl->setVariable('DISPLAYTROPA','block');
					$this->tpl->addBlockfile('CONSTROPA','tConsTropa','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consTropa['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consTropa['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consTropa['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consTropa['tiempoTotal']-$consTropa['tiempo'])/$consTropa['tiempoTotal'])*100);
					$this->tpl->parse('tConsTropa');
				}
				else
					$this->tpl->setVariable('DISPLAYTROPA','none');
				//Nave en construccion
				if($consNave!=null){
					$this->tpl->setVariable('DISPLAYNAVE','block');
					$this->tpl->addBlockfile('CONSNAVE','tConsNave','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consNave['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consNave['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consNave['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consNave['tiempoTotal']-$consNave['tiempo'])/$consNave['tiempoTotal'])*100);
					$this->tpl->parse('tConsNave');
				}
				else
					$this->tpl->setVariable('DISPLAYNAVE','none');
				//Defensa en construccion
				if($consDefensa!=null){
					$this->tpl->setVariable('DISPLAYDEFENSA','block');
					$this->tpl->addBlockfile('CONSDEFENSA','tConsDefensa','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consDefensa['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consDefensa['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consDefensa['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consDefensa['tiempoTotal']-$consDefensa['tiempo'])/$consDefensa['tiempoTotal'])*100);
					$this->tpl->parse('tConsDefensa');
				}
				else
					$this->tpl->setVariable('DISPLAYDEFENSA','none');
				/*$tiempoRestante=$consTropa['tiempo'];
				$idUnidadActual=$consTropa['idUnidad'];
				$cantidad=$consTropa['cantidad'];*/
			}

			//Cargamos el modulo principal
			$this->tpl->setVariable('CONTENIDO',$centro);


			//Mensajes nuevos
	        $this->tpl->setVariable('_TIENES',_('Tienes'));
			$this->tpl->setVariable('MENSAJESNUEVOS',$numMensajesNuevos);
			$this->tpl->setVariable('_MENSAJESNUEVOS',_('mensajes nuevos'));

	        //Idioma
	        $this->tpl->setVariable('_CARGANDO',_('Cargando'));
	        $this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));
	        $this->tpl->setVariable('_SELECCIONAPLANETA',_('Seleccionar Planeta'));
	        $this->tpl->setVariable('_INICIO',_('Inicio'));
	        $this->tpl->setVariable('_PLANETAS',_('Planetas'));
	        $this->tpl->setVariable('_GALAXIAS',_('Galaxias'));
	        $this->tpl->setVariable('_RECURSOS',_('Recursos'));
	        $this->tpl->setVariable('_TROPAS',_('Tropas'));
	        $this->tpl->setVariable('_NAVES',_('Naves'));
	        $this->tpl->setVariable('_DEFENSAS',_('Defensas'));
	        $this->tpl->setVariable('_ESPECIALES',_('Especiales'));
	        $this->tpl->setVariable('_MEJORAS',_('Mejoras'));
	        $this->tpl->setVariable('_FORO',_('Foro'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_MENSAJES',_('Mensajes'));
	        $this->tpl->setVariable('_RANKING',_('Ranking'));
	        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        $this->tpl->setVariable('_SALIR',_('Salir'));

			//Si hay variables para asignar, las pasamos
			if(is_array($vars))
			{
	            $this->tpl->setVariable($vars);
	        }

	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();

	    }

	    /**
	     * Construye los datos del planeta seleccionado
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer planeta
	     * @return mixed
	     * @since 31/01/2009
	     */
	    public function planetaDatos($planeta)
	    {

	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('index/planetaDatos.tpl');

			$this->tpl->setVariable('PLANETASELIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
			$this->tpl->setVariable('IDPLANETASEL',$planeta['idPlaneta']);
			$this->tpl->setVariable('IDGALAXIASEL',$planeta['idGalaxia']);
			$this->tpl->setVariable('IDSECTORSEL',$planeta['idSector']);
			$this->tpl->setVariable('IDCUADRANTESEL',$planeta['idCuadrante']);
			$this->tpl->setVariable('PLANETASELNOMUSUARIO',$planeta['nombrePlaneta']);
			if($planeta['nombrePlaneta']==NULL)
	        	$this->tpl->setVariable('PLANETASELNOM',$planeta['nombreSGC']);
	        else
	        	$this->tpl->setVariable('PLANETASELNOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
	        //Asignamos los datos hidden para el planeta seleccionado
	        $this->tpl->setVariable('IDPLANETA',$planeta['idPlaneta']);
	        $this->tpl->setVariable('IDGALAXIA',$planeta['idGalaxia']);
	        //Dibujamos las coordenadas
	        $this->tpl->setCurrentBlock('tDibCoordenadas');
			for ($i=1;$i<=7;$i++) {
			    $this->tpl->setVariable('COORD', $planeta['coord'.$i]);
			    $this->tpl->setVariable('IDSIMBOLO', $i);
			    $this->tpl->setVariable('IMGCOORD', $_ENV['config']->get('simbolosImgFolder').$planeta['idGalaxia'].'/'.str_pad($planeta['coord'.$i], 2, "0", STR_PAD_LEFT).'.gif');
			    $this->tpl->parseCurrentBlock();
			}
			$this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));
			$this->tpl->show();

	    }

	    /**
	     * Devuelve el nombre del planeta una
	     * vez cambiado
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer nombre
	     * @param  Integer nombreSGC
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function planetaCambiarNombre($nombre, $nombreSGC)
	    {

	        //Construye el nombre completo del planeta
	        !empty($nombre) ? $nombreCompleto=$nombre.' ('.$nombreSGC.')' : $nombreCompleto=$nombreSGC;

	        //Compone el html (NO es CORRECTO, deberia ser un TEMPLATE)
	        $html ='<script type="text/javascript">indexNombreSel=\''.$nombre.'\';';
	        $html.= 'indexNomCompletoSel=\''.$nombreCompleto.'\';</script>'.$nombreCompleto;

	        //Imprime el codigo html
	        echo $html;

	    }

	    /**
	     * Devuelve un JSON con las cantidades de recursos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer recursos
	     * @return mixed
	     * @since 16/02/2009
	     */
	    public function cantidad($recursos)
	    {

	        echo json_encode($recursos);

	    }

	    /**
	     * Muestra las construcciones de un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer consTropa
	     * @param  Integer consNave
	     * @param  Integer consDefensa
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function construccionPlaneta($consTropa, $consNave, $consDefensa)
	    {

	        //Construcciones actuales
			$this->tpl->loadTemplateFile('index/construccionPlaneta.tpl');
			//Bloque de no hay construcciones
			$this->tpl->addBlockfile('NOCONSTRUCCIONES','tNoConstrucciones','index/noConstrucciones.tpl');
			$this->tpl->setVariable('_NOCONSTRUCCIONES',_('No hay construcciones'));
			//Bloque de construcciones
			$this->tpl->addBlockfile('CONSTRUCCIONES','tConstrucciones','index/construcciones.tpl');
			if($consTropa==null && $consNave==null && $consDefensa==null){
				$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','none');
				$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','block');
				$this->tpl->setVariable('DISPLAYTROPA','none');
				$this->tpl->setVariable('DISPLAYNAVE','none');
				$this->tpl->setVariable('DISPLAYDEFENSA','none');
			}
			else{
				$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','block');
				$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','none');
				//Tropa en construccion
				if($consTropa!=null){
					$this->tpl->setVariable('DISPLAYTROPA','block');
					$this->tpl->addBlockfile('CONSTROPA','tConsTropa','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consTropa['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consTropa['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consTropa['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consTropa['tiempoTotal']-$consTropa['tiempo'])/$consTropa['tiempoTotal'])*100);
					$this->tpl->parse('tConsTropa');
				}
				else
					$this->tpl->setVariable('DISPLAYTROPA','none');
				//Nave en construccion
				if($consNave!=null){
					$this->tpl->setVariable('DISPLAYNAVE','block');
					$this->tpl->addBlockfile('CONSNAVE','tConsNave','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consNave['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consNave['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consNave['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consNave['tiempoTotal']-$consNave['tiempo'])/$consNave['tiempoTotal'])*100);
					$this->tpl->parse('tConsNave');
				}
				else
					$this->tpl->setVariable('DISPLAYNAVE','none');
				//Defensa en construccion
				if($consDefensa!=null){
					$this->tpl->setVariable('DISPLAYDEFENSA','block');
					$this->tpl->addBlockfile('CONSDEFENSA','tConsDefensa','index/construccion.tpl');
					$this->tpl->setVariable('TIEMPOTOTAL',$consDefensa['tiempoTotal']);
					$this->tpl->setVariable('TIEMPORESTANTE',$consDefensa['tiempo']);
					$this->tpl->setVariable('INDEXUNIDADIMG',$_ENV['config']->get('unidadImgFolder').$consDefensa['idUnidad'].'.jpg');
					$this->tpl->setVariable('INDEXUNIDADBARRA',(($consDefensa['tiempoTotal']-$consDefensa['tiempo'])/$consDefensa['tiempoTotal'])*100);
					$this->tpl->parse('tConsDefensa');
				}
				else
					$this->tpl->setVariable('DISPLAYDEFENSA','none');
			}
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();

	    }

	    /**
	     * Escribe el numero de mensajes nuevos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer numMensajes
	     * @return mixed
	     * @since 03/12/2009
	     */
	    public function comprobarMensajes($numMensajes)
	    {

			echo $numMensajes;

	    }

	    /**
	     * Lista misiones en su bloque
	     *
	     * @access private
	     * @author David & Jose
	     * @param  String titulo
	     * @param  Integer misiones
	     * @param  Integer unidadesMision
	     * @param  Boolean propias
	     * @return mixed
	     * @since 18/01/2010
	     */
	    private function bloqueMision($titulo, $misiones = null, $unidadesMision = null, $propias = true, $idAlianza = null)
	    {

	    	//Idioma
			$this->tpl->setVariable('_MISIONESTIPO', $titulo);
	        $this->tpl->setVariable('_MISION',_('Misi&#243;n'));
	        $this->tpl->setVariable('_ORIGEN',_('Origen'));
	        $this->tpl->setVariable('_DESTINO',_('Destino'));
	        $this->tpl->setVariable('_TIEMPO',_('Tiempo'));

	        if($propias)
	        	$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        else
	        	$this->tpl->setVariable('_OPCIONES',_('Usuario'));

	        //Listamos las misiones
	        $this->tpl->setCurrentBlock('tMision');

	        foreach($misiones as $idMision => $datos){
	        	//Comprobamos si todas las unidades son invisibles
	        	if(!((($this->invisibles($unidadesMision[$idMision]) || $datos['invisible']) && !$propias) && (!isset($datos['idAlianza']) || $datos['idAlianza']!=$idAlianza))){
					$this->tpl->setVariable('MISION',$datos['tipoMision']);
					if($datos['vuelta'])
						$this->tpl->setVariable('_REGRESO','Regreso');
					if($datos['tiempo']<=0){
						if($datos['idTipoMision']==CONQUISTAR){
							$this->tpl->setVariable('TIEMPO',$_ENV['config']->get('tiempoConquista')+$datos['tiempo']);
							$this->tpl->setVariable('_CONQUISTANDO',_('Conquistando'));
						}
						else
							$this->tpl->setVariable('TIEMPO','-');
					}
					else
						$this->tpl->setVariable('TIEMPO',$datos['tiempo']);
					//Planeta origen
					$this->tpl->setVariable('IDGALAXIAORIGEN',$datos['idGalaxiaOrigen']);
					$this->tpl->setVariable('IDSECTORORIGEN',$datos['idSectorOrigen']);
					$this->tpl->setVariable('IDCUADRANTEORIGEN',$datos['idCuadranteOrigen']);
					if($datos['planetaOrigenNombre']=='')
						$this->tpl->setVariable('ORIGEN',$datos['planetaOrigenSGC']);
					else
						$this->tpl->setVariable('ORIGEN',$datos['planetaOrigenNombre'].' ('.$datos['planetaOrigenSGC'].')');
		        	//Planeta destino
		        	$this->tpl->setVariable('IDGALAXIADESTINO',$datos['idGalaxiaDestino']);
					$this->tpl->setVariable('IDSECTORDESTINO',$datos['idSectorDestino']);
					$this->tpl->setVariable('IDCUADRANTEDESTINO',$datos['idCuadranteDestino']);
		        	if($datos['planetaDestinoNombre']=='' || !$datos['destinoExplorado'])
						$this->tpl->setVariable('DESTINO',$datos['planetasDestinoSGC']);
					else
						$this->tpl->setVariable('DESTINO',$datos['planetaDestinoNombre'].' ('.$datos['planetasDestinoSGC'].')');

					//Botones de opcion o usuario
					if($propias){
						$this->tpl->setVariable('IDMISION',$datos['id']);

						if(!$datos['vuelta'])
							$this->tpl->setVariable('_REGRESAR',_('Regresar'));

						if($datos['tiempo']<=0 && $datos['idTipoMision']==DESPLEGAR && !$datos['nuevaMision'])
							$this->tpl->setVariable('_NUEVAMISION',_('Nueva misi&#243;n'));
					}
					else
						$this->tpl->setVariable('USUARIO',$datos['propietario']);

		        	//Unidades
		        	$todasInvisibles=true;
					foreach($unidadesMision[$idMision] as $unidad){
						if($unidad['cantidadActual']!=0){
							//Si la unidad es invisible o todas las unidades son invisibles
							if((($unidad['invisible'] || $datos['invisible']) && !$propias) && (!isset($datos['idAlianza']) || $datos['idAlianza']!=$idAlianza)){
								$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').'0.jpg');
								$this->tpl->setVariable('NOMUNIDAD','?');
								$this->tpl->setVariable('CANTIDAD','?');
							}
							else{
								$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('NOMUNIDAD',$unidad['nombre']);
								$this->tpl->setVariable('CANTIDAD',$unidad['cantidadActual'].' / '.$unidad['cantidadEnviada']);
							}

							$this->tpl->parse('tMisionUnidad');
						}

						//Comprobacion de si todas son invisibles
						if($todasInvisibles){
							$todasInvisibles=$todasInvisibles && $unidad['invisible'];
						}
					}

					$this->tpl->parseCurrentBlock();
	        	}
	        }

	    }

	    /**
	     * Devuelve TRUE si las undiades son invisibles, FALSE en caso contario
	     *
	     * @access private
	     * @author David & Jose
	     * @param  String titulo
	     * @param  Integer misiones
	     * @param  Integer unidadesMision
	     * @param  Boolean propias
	     * @return mixed
	     * @since 18/01/2010
	     */
	    private function invisibles($unidadesMision)
	    {
    		$todasInvisibles=true;
			foreach($unidadesMision as $unidad){
				//Comprobacion de si todas son invisibles
				if($todasInvisibles){
					$todasInvisibles=$todasInvisibles && $unidad['invisible'];
				}
			}

			return $todasInvisibles;
	    }

		/**
	     * Devuelve TRUE si todas las misiones son invisibles, FALSE en caso contrario
	     *
	     * @access private
	     * @author David & Jose
	     * @param  String titulo
	     * @param  Integer misiones
	     * @param  Integer unidadesMision
	     * @param  Boolean propias
	     * @return mixed
	     * @since 18/01/2010
	     */
	    private function misionesInvisibles($misiones, $unidadesMision, $idAlianza)
	    {
    		$todasInvisibles=true;
    		foreach($misiones as $idMision => $datos){
    			if($todasInvisibles){
    				$todasInvisibles=($this->invisibles($unidadesMision[$idMision]) || $datos['invisible']) && (!isset($datos['idAlianza']) || $datos['idAlianza']!=$idAlianza);
    			}
			}

			return $todasInvisibles;
	    }

	    /**
	     * Carga las variables en la plantilla y la muestra
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer estadisticas
	     * @param  Integer posicion
	     * @param  Integer misionesPropias
	     * @param  Integer misionesAjenas
	     * @param  Integer unidadesMision
	     * @param  Integer destinos
	     * @param  Integer mejora
	     * @param  Integer planetas
	     * @param  Integer consTropa
	     * @param  Integer consNave
	     * @param  Integer consDefensa
	     * @return mixed
	     * @since 05/02/2009
	     */
	    public function principal($estadisticas, $posicion, $misionesPropias, $misionesAjenas, $unidadesMision, $mejora = 0, $planetas = null, $consTropa = null, $consNave = null, $consDefensa = null, $numSoldados = null, $numNaves = null, $numDefensas = null, $idRaza = null, $recursos = null, $idAlianza = null)
	    {
	    	//Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad'], $recursos[2]['cantidad']);

	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('index/principal.tpl');

	       	$vars['POSICION']=$posicion;

	       	$vars['PUNTOS']=floor($estadisticas['puntuacion']);
	       	$vars['PUNTOSNAVES']=floor($estadisticas['puntosNaves']);
	       	$vars['PUNTOSSOLDADOS']=floor($estadisticas['puntosSoldados']);
	       	$vars['PUNTOSDEFENSAS']=floor($estadisticas['puntosDefensas']);
	       	$vars['PUNTOSTECNOLOGIAS']=floor($estadisticas['puntosTecnologias']);

			//Bloque de misiones
			//Si existen misiones, anyado el bloque

			if(!empty($misionesPropias) || (!empty($misionesAjenas) && !$this->misionesInvisibles($misionesAjenas,$unidadesMision,$idAlianza))){
				$this->tpl->setVariable('_MISIONES',_('Misiones'));
				$this->tpl->addBlockfile('BLOQUEMISIONES','tMisiones','bloques/misiones.tpl');

				//Si existen misiones propias
				if(!empty($misionesPropias)){
					$this->tpl->addBlockfile('MISIONESPROPIAS','tMisionesPropias','bloques/misionesLista.tpl');
					$this->bloqueMision(_('Propias'), $misionesPropias, $unidadesMision);
					$this->tpl->parse('tMisionesPropias');
				}

				//Si existen misiones ajenas que me afecten y no son invisibles
				if(!empty($misionesAjenas) && !$this->misionesInvisibles($misionesAjenas,$unidadesMision,$idAlianza)){
					$this->tpl->addBlockfile('MISIONESAJENAS','tMisionesAjenas','bloques/misionesLista.tpl');
					$this->bloqueMision(_('Aliadas/Enemigas'), $misionesAjenas, $unidadesMision,false,$idAlianza);
					$this->tpl->parse('tMisionesAjenas');
				}

				$this->tpl->parse('tMisionesBlock');
			}

	    	//Bloque de mejora actual
	       	if($mejora!=0){
	       		$this->tpl->addBlockfile('BLOQUEMEJORACTUAL','tMejora','bloques/mejora.tpl');
	       		$this->tpl->setVariable('_INVESTIGANDO',_('Investigando'));
	       		$this->tpl->setVariable('_MEJORA',_('Mejora'));
	       		$this->tpl->setVariable('_TIEMPOMEJORA',_('Tiempo'));
	       		$this->tpl->setVariable('MEJORANOM',$mejora['nombre'].' '._('nivel').' '.$mejora['nivel']);
	       		$this->tpl->setVariable('MEJORAIMG',$_ENV['config']->get('mejoraImgFolder').$mejora['id'].'.jpg');
	       		$this->tpl->setVariable('MEJORATIEMPO',$mejora['tiempo']);
	       	}

	       	//Bloque de planetas
	       	$this->tpl->setCurrentBlock('tPlanetaCentro');
	       	$i=0;
	       	foreach($planetas as $planeta){
	       		if($planeta['nombrePlaneta']=='')
					$this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
				else
					$this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');

			    $this->tpl->setVariable('IDRAZA',$idRaza);
			    $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
			    $this->tpl->setVariable('PLANETARIQ',$planeta['riqueza']);
			    $this->tpl->setVariable('IDGALAXIACENTRO',$planeta['idGalaxia']);
			    $this->tpl->setVariable('IDSECTORCENTRO',$planeta['idSector']);
			    $this->tpl->setVariable('IDCUADRANTECENTRO',$planeta['idCuadrante']);
			    $this->tpl->setVariable('_VERPLANETA',_('Ver planeta'));

			    //Unidades
			    $this->tpl->setVariable('_TROPAS',_('Soldados'));
			    $this->tpl->setVariable('_NAVES',_('Naves'));
			    $this->tpl->setVariable('_DEFENSAS',_('Defensas'));

			    $this->tpl->setVariable('NUMTROPAS',$numSoldados[$i]);
			    $this->tpl->setVariable('NUMNAVES',$numNaves[$i]);
			    $this->tpl->setVariable('NUMDEFENSAS',$numDefensas[$i]);

		       	//Construcciones actuales
				//Bloque de no hay construcciones
				$this->tpl->setVariable('_NOCONSTRUCCIONES',_('No hay construcciones'));

				if($consTropa[$i]==null && $consNave[$i]==null && $consDefensa[$i]==null){
					$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','none');
					$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','block');
					$this->tpl->setVariable('DISPLAYTROPA','none');
					$this->tpl->setVariable('DISPLAYNAVE','none');
					$this->tpl->setVariable('DISPLAYDEFENSA','none');
				}
				else{
					$this->tpl->setVariable('DISPLAYCONSTRUCCIONES','block');
					$this->tpl->setVariable('DISPLAYNOCONSTRUCCIONES','none');
					//Tropa en construccion
					if($consTropa[$i]!=null){
						$this->tpl->setVariable('DISPLAYTROPA','block');
						$this->tpl->setVariable('TIEMPOTOTALTROPA',$consTropa[$i]['tiempoTotal']);
						$this->tpl->setVariable('TIEMPORESTANTETROPA',$consTropa[$i]['tiempo']);
						$this->tpl->setVariable('INDEXTROPAIMG',$_ENV['config']->get('unidadImgFolder').$consTropa[$i]['idUnidad'].'.jpg');
						$this->tpl->setVariable('INDEXTROPABARRA',(($consTropa[$i]['tiempoTotal']-$consTropa[$i]['tiempo'])/$consTropa[$i]['tiempoTotal'])*100);
					}
					else
						$this->tpl->setVariable('DISPLAYTROPA','none');
					//Nave en construccion
					if($consNave[$i]!=null){
						$this->tpl->setVariable('DISPLAYNAVE','block');
						$this->tpl->setVariable('TIEMPOTOTALNAVE',$consNave[$i]['tiempoTotal']);
						$this->tpl->setVariable('TIEMPORESTANTENAVE',$consNave[$i]['tiempo']);
						$this->tpl->setVariable('INDEXNAVEIMG',$_ENV['config']->get('unidadImgFolder').$consNave[$i]['idUnidad'].'.jpg');
						$this->tpl->setVariable('INDEXNAVEBARRA',(($consNave[$i]['tiempoTotal']-$consNave[$i]['tiempo'])/$consNave[$i]['tiempoTotal'])*100);
					}
					else
						$this->tpl->setVariable('DISPLAYNAVE','none');
					//Defensa en construccion
					if($consDefensa[$i]!=null){
						$this->tpl->setVariable('DISPLAYDEFENSA','block');
						$this->tpl->setVariable('TIEMPOTOTALDEFENSA',$consDefensa[$i]['tiempoTotal']);
						$this->tpl->setVariable('TIEMPORESTANTEDEFENSA',$consDefensa[$i]['tiempo']);
						$this->tpl->setVariable('INDEXDEFENSAIMG',$_ENV['config']->get('unidadImgFolder').$consDefensa[$i]['idUnidad'].'.jpg');
						$this->tpl->setVariable('INDEXDEFENSABARRA',(($consDefensa[$i]['tiempoTotal']-$consDefensa[$i]['tiempo'])/$consDefensa[$i]['tiempoTotal'])*100);
					}
					else
						$this->tpl->setVariable('DISPLAYDEFENSA','none');
				}
			    $this->tpl->parseCurrentBlock();
			    $i++;
	       	}

			//Idioma
			$this->tpl->setVariable('_PLANETAS',_('Planetas'));
			$this->tpl->setVariable('_PLANETA',_('Planeta'));
			$this->tpl->setVariable('_CONSTRUCCIONES',_('Construcciones'));
			$this->tpl->setVariable('_UNIDADES',_('Unidades'));
			$this->tpl->setVariable('_ESTADISTICAS',_('Estad&#237;sticas'));
	        $this->tpl->setVariable('_TECNOLOGIA',_('Tecnolog&#237;as'));
	        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
	        $this->tpl->setVariable('_POSICION',_('Posici&#243;n'));
			$this->tpl->setVariable('_TROPAS',_('Tropas'));
	        $this->tpl->setVariable('_NAVES',_('Naves'));
	        $this->tpl->setVariable('_DEFENSAS',_('Defensas'));

			//Si hay variables para asignar, las pasamos
			if(is_array($vars))
			{
	            $this->tpl->setVariable($vars);
	        }

	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();

	    }

	    /**
	     * Muestra la pantalla del modo vacaciones activado
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Boolean desactivar
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function vacaciones($desactivar, $idRaza)
	    {

	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('index/vacaciones.tpl');
			$tiempo=new DateTime($desactivar);
			$actual=new DateTime();
			//Si la fecha de terminar es menor que la actual
			if($tiempo < $actual){
				$this->tpl->setVariable('_QUITARVACACIONES','Desactivar modo vacaciones');
			}

			$this->tpl->setVariable('TITULO',_('Modo vacaciones'));
			$this->tpl->setVariable('IDRAZA',$idRaza);
			$this->tpl->setVariable('MENSAJE',_('El modo vacaciones est&#225; activado, pasadas 48 horas aparecer&#225; un bot&#243;n para desactivarlo'));

			//Finalmente, mostramos la plantilla.
			$this->tpl->show();

	    }

	    /**
	     * Muestra la pantalla de cuenta bloqueada
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer fecha
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function bloqueado($fecha, $idRaza)
	    {

	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('index/vacaciones.tpl');

			$this->tpl->setVariable('TITULO',_('Cuenta bloqueada'));
			$this->tpl->setVariable('IDRAZA',$idRaza);
			$tiempo=new DateTime( '@' . $fecha );
			$this->tpl->setVariable('MENSAJE',_('Su cuenta a sido bloqueada por los administradores hasta el '.$tiempo->format('d-m-Y').' a las '.$tiempo->format('H:i')));

			//Finalmente, mostramos la plantilla.
			$this->tpl->show();

	    }

	}
?>