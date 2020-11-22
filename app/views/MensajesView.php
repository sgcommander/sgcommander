<?php
	/**
	 * Vista del modulo de mensajeria
	 *
	 * @author David & Jose
	 * @package views
	 * @since 18/02/2009
	 */
	
	
	
	/**
	 * Vista del modulo de mensajeria
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 18/02/2009
	 */
	class MensajesView
	    extends ViewBase
	{
	    /**
	     * Lista los mensajes del ususario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer mensajes
	     * @param  Integer numMensajesPag
	     * @param  Integer numMensajesTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function entrada($mensajes, $numMensajesPag, $numMensajesTotal, $pag)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajes/entrada.tpl');
	        
	        //Idioma
			$this->tpl->setVariable('_ASUNTO',_('Asunto'));
	        $this->tpl->setVariable('_ENVIADOPOR',_('Enviado por'));
	        $this->tpl->setVariable('_FECHA',_('Fecha'));
	        $this->tpl->setVariable('_HORA',_('Hora'));
	        $this->tpl->setVariable('_CONFBORRARMSG',_('&#191;Realmente desea borrar todos sus mensajes?'));
	        
	        if(count($mensajes)==0){
				$this->tpl->setVariable('_NOMENSAJES',_('No hay mensajes'));
				$this->tpl->parse('tNoMensajes');
				$this->tpl->hideBlock('tMensajes');
			}
			else{
				$this->tpl->hideBlock('tNoMensajes');
				$this->tpl->parse('tMensajes');
	
				//Paginamos
				$paginas=ceil($numMensajesTotal/$numMensajesPag);
				$this->tpl->setCurrentBlock('tPagMsg');
	
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numMensajesPag));
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tMensaje');
				foreach($mensajes as $datos){
					$this->tpl->setVariable('MSGIDBORRAR',$datos['id']);
					$this->tpl->setVariable('MSGID',$datos['id']);
					$this->tpl->setVariable('MSGASUNTO',$datos['asunto']);
					$this->tpl->setVariable('MSGEMISOR',$datos['nombreUsuario']);
					$this->tpl->setVariable('MSGTIPO',$datos['idTipoMensaje']);
					$this->tpl->setVariable('MSGFECHA',date('d/m/Y',strtotime($datos['fecha'])));
					$this->tpl->setVariable('MSGHORA',date('H:i',strtotime($datos['fecha'])));
	
					//Segun el tipo de mensaje arreglamos el enlace
					switch($datos['idTipoMensaje']){
						case MENSAJEBATALLA:
							$this->tpl->parse('tBatalla');
							$this->tpl->hideBlock('tNormal');
							$this->tpl->hideBlock('tReporte');
							break;
						case MENSAJEREPORTE:
							$this->tpl->parse('tReporte');
							$this->tpl->hideBlock('tNormal');
							$this->tpl->hideBlock('tBatalla');
							break;
						default:
							$this->tpl->parse('tNormal');
							$this->tpl->hideBlock('tReporte');
							$this->tpl->hideBlock('tBatalla');
					}
	
					//Colocamos el icono correcto
					if($datos['leido']){
						$this->tpl->setVariable('_LEIDO',_('Leido'));
						$this->tpl->parse('tLeido');
					}
					else{
						$this->tpl->setVariable('_NOLEIDO',_('Sin leer'));
						$this->tpl->parse('tNoLeido');
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el formulario para escribir mensajes
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String asunto
	     * @param  String contenido
	     * @param  String destino
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function escribir($asunto = '', $contenido = '', $destino = '')
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajes/escribir.tpl');
	
			//Comprobamos la accion
			if($asunto != '' &&  $contenido != '')
				$this->tpl->setVariable('_ACCIONMENSAJE',_('Reenviar mensaje'));
			elseif($destino != '' && $asunto != '')
				$this->tpl->setVariable('_ACCIONMENSAJE',_('Responder mensaje'));
			else
				$this->tpl->setVariable('_ACCIONMENSAJE',_('Nuevo mensaje'));
	
			//Idioma
			$this->tpl->setVariable('_ASUNTO',_('Asunto'));
	        $this->tpl->setVariable('_DESTINATARIOS',_('Destinatarios'));
	        $this->tpl->setVariable('_CONTENIDO',_('Contenido'));
	        $this->tpl->setVariable('_ENVIAR',_('Enviar'));
	        
	        //Parametros
	        $this->tpl->setVariable('ASUNTO',$asunto);
	        $this->tpl->setVariable('DESTINATARIOS',$destino);
	        $this->tpl->setVariable('CONTENIDO',$contenido);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Menu del modulo de planetas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function show()
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajes/mensajes.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_BANDEJAENTRADA',_('Bandeja entrada'));
	        $this->tpl->setVariable('_ESCRIBIRMENSAJE',_('Escribir mensaje'));
	        $this->tpl->setVariable('_BORRARMARCADOS',_('Borrar marcados'));
	        $this->tpl->setVariable('_BORRARTODOS',_('Borrar todos'));
	        $this->tpl->setVariable('_CERRAR',_('Cerrar'));
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra un mensaje
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer mensaje
	     * @return mixed
	     * @since 18/02/2009
	     */
	    public function mensaje($mensaje)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajes/mensaje.tpl');
	        
	        //Idioma
	        $this->tpl->setVariable('_BORRAR',_('Borrar'));
	        $this->tpl->setVariable('_RESPONDER',_('Responder'));
	        $this->tpl->setVariable('_REENVIAR',_('Reenviar'));
			$this->tpl->setVariable('_ASUNTO',_('Asunto'));
	        $this->tpl->setVariable('_ENVIADOPOR',_('enviado por'));
	        $this->tpl->setVariable('_ELDIA',_('el dia'));
	        $this->tpl->setVariable('_ALAS',_('a las'));
	        $this->tpl->setVariable('_CONFBORRARMSG',_('&#191;Realmente desea borrar el mensaje?')); 
	        
	        $this->tpl->setVariable('MSGID',$mensaje['id']);
	        
			$this->tpl->setVariable('MSGASUNTO',$mensaje['asunto'].'...');
			$this->tpl->setVariable('MSGEMISOR',$mensaje['nombreEmisor']);
			$this->tpl->setVariable('MSGFECHA',date('d/m/Y',strtotime($mensaje['fecha'])));
			$this->tpl->setVariable('MSGHORA',date('H:i',strtotime($mensaje['fecha'])));
	        $this->tpl->setVariable('MSGCONTENIDO',$mensaje['contenido']);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra un reporte de mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer mensaje
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function reporte($mensaje)
	    {
	        
	        echo $mensaje;
	        
	    }
	
	    /**
	     * Muestra un reporte de batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer jugadores
	     * @param  Integer unidadesIniciales
	     * @param  Integer unidadesDestruidas
	     * @param  Integer planeta
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function batalla($jugadores, $unidadesIniciales, $unidadesAtacadas, $planeta)
	    {
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('reportes/batalla.tpl');
	
	        //Idioma
	        $this->tpl->setVariable('_GENERAL',_('General'));
	        $this->tpl->setVariable('_GENERALTROPAS',_('Tropas'));
	        $this->tpl->setVariable('_GENERALNAVES',_('Naves'));
			$this->tpl->setVariable('_GENERALDEFENSAS',_('Defensas'));
			$this->tpl->setVariable('_GENERALJUGADOR',_('Jugador'));
			$this->tpl->setVariable('_GENERALTOTAL',_('Total'));
	
			//Sumamos los puntos
			//Totales
			$puntosInicial=0;
			$puntosFinal=0;
			//Totales por tipo
			$puntosTipo=Array(
							NAVE => Array('inicial' => 0, 'final' => 0),
							SOLDADO => Array('inicial' => 0, 'final' => 0),
							DEFENSA => Array('inicial' => 0, 'final' => 0)
						);
			//Totales por jugador
			$puntosJugador=Array();
			//Unidades por jugador
			$unidadesJugador=Array();
			//Unidades destruidas y capturadas
			$unidadesDestruidasJugador=Array();
			$unidadesCapturadasJugador=Array();
	
			//Procesamos las unidades iniciales
			if(count($unidadesIniciales)>0){
				foreach($unidadesIniciales as $datos){
					//Calculamos los puntos iniciales y los finales de la unidad
					$puntosInicialUnidad = $datos['cantidadInicial']*$datos['puntosUnidad'];
					$puntosFinalUnidad = $datos['cantidadFinal']*$datos['puntosUnidad'];
	
					//Sumamos los puntos iniciales y finales totales
					$puntosInicial += $puntosInicialUnidad;
					$puntosFinal += $puntosFinalUnidad;
	
					//Sumamos los puntos segun el tipo
					$puntosTipo[$datos['idTipoUnidad']]['inicial'] += $puntosInicialUnidad;
					$puntosTipo[$datos['idTipoUnidad']]['final'] += $puntosFinalUnidad;
	
					//Creamos la estructura de datos del jugador, en caso de no estar creada
					if(!isset($puntosJugador[$datos['idJugador']])){
						$puntosJugador[$datos['idJugador']] = Array('inicial' => 0,
																	'final' => 0,
																	NAVE => Array('inicial' => 0, 'final' => 0),
																	SOLDADO => Array('inicial' => 0, 'final' => 0),
																	DEFENSA =>  Array('inicial' => 0, 'final' => 0)
																);
					}
	
					//Sumamos los puntos segun jugador
					$puntosJugador[$datos['idJugador']]['inicial']+=$puntosInicialUnidad;
					$puntosJugador[$datos['idJugador']]['final']+=$puntosFinalUnidad;
					$puntosJugador[$datos['idJugador']][$datos['idTipoUnidad']]['inicial']+=$puntosInicialUnidad;
					$puntosJugador[$datos['idJugador']][$datos['idTipoUnidad']]['final']+=$puntosFinalUnidad;
	
					//Sumamos las unidades por jugador
					$unidadesJugador[$datos['idJugador']][$datos['idTipoUnidad']][$datos['idUnidad']]=$datos;
				}
			}
	
	    	//Procesamos las unidades destruidas
			if(count($unidadesAtacadas)>0){
				//Recorro las unidades de los jugadores
				foreach($unidadesAtacadas as $datos){
					//Sumamos los puntos iniciales y finales totales
					$puntosFinal+=$datos['puntosObtenidos'];
	
					//Sumamos los puntos segun el tipo
					$puntosTipo[$datos['idTipoUnidad']]['final']+=$datos['puntosObtenidos'];
	
					//Sumamos los puntos segun jugador
					$puntosJugador[$datos['idJugador']]['final']+=$datos['puntosObtenidos'];
					$puntosJugador[$datos['idJugador']][$datos['idTipoUnidad']]['final']+=$datos['puntosObtenidos'];
	
					//Almacenamos la informacion de las unidades, segun se han destruido o capturado
					switch($datos['tipo']){
						case DESTRUIDA:
							$unidadesDestruidasJugador[$datos['idJugador']][$datos['idTipoUnidad']][$datos['idUnidad']]=$datos;
							break;
						case CAPTURADA:
							$unidadesCapturadasJugador[$datos['idJugador']][$datos['idTipoUnidad']][$datos['idUnidad']]=$datos;
							break;
						default:
							trigger_error(_('Error inespedado 1: Envie este mensaje a un administrador lo antes posible, gracias.'), E_USER_ERROR);
					}
				}
			}
			
			//Compruebo si gracias a las capturas, el maximo de puntos de cada tipo a aumentado
			//Con respecto al inicial. Por ejemplo inicialmente habia 200 puntos en tropas, pero al
			//transformar dos unidades a otras tropas con mas puntuacion,a hroa el maximo es de 220
			foreach($puntosJugador AS $info){
				if($info[SOLDADO]['final'] > $puntosTipo[SOLDADO]['inicial']){
					$puntosTipo[SOLDADO]['inicial'] = $info[SOLDADO]['final']; 
				}
				if($info[NAVE]['final'] > $puntosTipo[NAVE]['inicial']){
					$puntosTipo[NAVE]['inicial'] = $info[NAVE]['final']; 
				}
				if($info[DEFENSA]['final'] > $puntosTipo[DEFENSA]['inicial']){
					$puntosTipo[DEFENSA]['inicial'] = $info[DEFENSA]['final']; 
				}
			}
	
	        //Pestana general
	    	if(count($jugadores)>0){
				$this->tpl->setCurrentBlock('tUsuario');
				$tipo=false;
				foreach($jugadores as $datos){
					//Cambiamos de color cada linea
					if($tipo){
						$this->tpl->setVariable('TIPO','tablaSegundoNivel');
					}
					$tipo=!$tipo;
	
					//Datos
					$this->tpl->setVariable('JUGADOR',$datos['nombreJugador']);
					$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('RAZA',$datos['nombreRaza']);
					if($datos['nombreAlianza']!=''){
						$this->tpl->setVariable('ALIANZA',$datos['nombreAlianza']);
					}
						
					if(!isset($puntosJugador[$datos['idJugador']])){
						$puntosJugador[$datos['idJugador']]['inicial']=0;
						$puntosJugador[$datos['idJugador']]['final']=0;
						$puntosJugador[$datos['idJugador']][NAVE]['inicial']=0;
						$puntosJugador[$datos['idJugador']][NAVE]['final']=0;
						$puntosJugador[$datos['idJugador']][SOLDADO]['inicial']=0;
						$puntosJugador[$datos['idJugador']][SOLDADO]['final']=0;
						$puntosJugador[$datos['idJugador']][DEFENSA]['inicial']=0;
						$puntosJugador[$datos['idJugador']][DEFENSA]['final']=0;
					}
	
					//Calculos de tropas
					if($puntosTipo[SOLDADO]['inicial']>0){
						$tropasPorcentaje=intval(($puntosJugador[$datos['idJugador']][SOLDADO]['inicial']/$puntosTipo[SOLDADO]['inicial'])*98);
						$tropasPuntos=$puntosJugador[$datos['idJugador']][SOLDADO]['final']-$puntosJugador[$datos['idJugador']][SOLDADO]['inicial'];
						$tropas=intval($tropasPuntos/$puntosTipo[SOLDADO]['inicial']*98);
					}
					else{
						$tropasPorcentaje=0;
						$tropasPuntos=0;
						$tropas=0;
					}
					//Calculos de naves
					if($puntosTipo[NAVE]['inicial']>0){
						$navesPorcentaje=intval(($puntosJugador[$datos['idJugador']][NAVE]['inicial']/$puntosTipo[NAVE]['inicial'])*98);
						$navesPuntos=$puntosJugador[$datos['idJugador']][NAVE]['final']-$puntosJugador[$datos['idJugador']][NAVE]['inicial'];
						$naves=intval($navesPuntos/$puntosTipo[NAVE]['inicial']*98);
					}
					else{
						$navesPorcentaje=0;
						$navesPuntos=0;
						$naves=0;
					}
					//Calculos de defensas
					if($puntosTipo[DEFENSA]['inicial']>0){
						$defensasPorcentaje=intval(($puntosJugador[$datos['idJugador']][DEFENSA]['inicial']/$puntosTipo[DEFENSA]['inicial'])*98);
						$defensasPuntos=$puntosJugador[$datos['idJugador']][DEFENSA]['final']-$puntosJugador[$datos['idJugador']][DEFENSA]['inicial'];
						$defensas=intval($defensasPuntos/$puntosTipo[DEFENSA]['inicial']*98);
					}
					else{
						$defensasPorcentaje=0;
						$defensasPuntos=0;
						$defensas=0;
					}
					//Calculos de total
					if($puntosInicial == 0){
						$totalPorcentaje=0;
						$totalPuntos=0;
						$total=0;
					}else{
						$totalPorcentaje=intval(($puntosJugador[$datos['idJugador']]['inicial']/$puntosInicial)*98);
						$totalPuntos=$puntosJugador[$datos['idJugador']]['final']-$puntosJugador[$datos['idJugador']]['inicial'];
						$total=intval($totalPuntos/$puntosInicial*98);
					}
	
					//Barra de tropas
					$this->tpl->setVariable('PUNTOSTROPAS',$tropasPuntos);
					if($tropasPuntos>0){
						$this->tpl->setVariable('TROPASGANADO',$tropas);
						$this->tpl->setVariable('TROPASPERDIDO','0');
						$this->tpl->setVariable('TROPASPERDIDOLEFT',$tropasPorcentaje);
						$this->tpl->setVariable('TOOLTIPTROPAS',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][SOLDADO]['inicial'].' | '._('Puntos ganados').': '.$tropasPuntos);
					}
					else{
						$this->tpl->setVariable('TROPASGANADO','0');
						$this->tpl->setVariable('TROPASPERDIDO',-($tropas));
						$this->tpl->setVariable('TROPASPERDIDOLEFT',$tropasPorcentaje+$tropas);
						$this->tpl->setVariable('TOOLTIPTROPAS',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][SOLDADO]['inicial'].' | '._('Puntos perdidos').': '.(-$tropasPuntos));
					}
	
					//Barra de naves
					$this->tpl->setVariable('PUNTOSNAVES',$navesPuntos);
					if($navesPuntos>0){
						$this->tpl->setVariable('NAVESGANADO',$naves);
						$this->tpl->setVariable('NAVESPERDIDO','0');
						$this->tpl->setVariable('NAVESPERDIDOLEFT',$navesPorcentaje);
						$this->tpl->setVariable('TOOLTIPNAVES',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][NAVE]['inicial'].' | '._('Puntos ganados').': '.$navesPuntos);
					}
					else{
						$this->tpl->setVariable('NAVESGANADO','0');
						$this->tpl->setVariable('NAVESPERDIDO',-($naves));
						$this->tpl->setVariable('NAVESPERDIDOLEFT',$navesPorcentaje+$naves);
						$this->tpl->setVariable('TOOLTIPNAVES',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][NAVE]['inicial'].' | '._('Puntos perdidos').': '.(-$navesPuntos));
					}
	
					//Barra de defensas
					$this->tpl->setVariable('PUNTOSDEFENSAS',$defensasPuntos);
					if($defensasPuntos>0){
						$this->tpl->setVariable('DEFENSASGANADO',$defensas);
						$this->tpl->setVariable('DEFENSASPERDIDO','0');
						$this->tpl->setVariable('DEFENSASPERDIDOLEFT',$defensasPorcentaje);
						$this->tpl->setVariable('TOOLTIPDEFENSAS',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][DEFENSA]['inicial'].' | '._('Puntos ganados').': '.$defensasPuntos);
					}
					else{
						$this->tpl->setVariable('DEFENSASGANADO','0');
						$this->tpl->setVariable('DEFENSASPERDIDO',-($defensas));
						$this->tpl->setVariable('DEFENSASPERDIDOLEFT',$defensasPorcentaje+$defensas);
						$this->tpl->setVariable('TOOLTIPDEFENSAS',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']][DEFENSA]['inicial'].' | '._('Puntos perdidos').': '.(-$defensasPuntos));
					}
	
					//Barra de total
					$this->tpl->setVariable('PUNTOSTOTALES',$totalPuntos);
					if($totalPuntos>0){
						$this->tpl->setVariable('TOTALGANADO',$total);
						$this->tpl->setVariable('TOTALPERDIDO','0');
						$this->tpl->setVariable('TOTALPERDIDOLEFT',$totalPorcentaje);
						$this->tpl->setVariable('TOOLTIPTOTAL',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']]['inicial'].' | '._('Puntos ganados').': '.$totalPuntos);
					}
					else{
						$this->tpl->setVariable('TOTALGANADO','0');
						$this->tpl->setVariable('TOTALPERDIDO',-($total));
						$this->tpl->setVariable('TOTALPERDIDOLEFT',$totalPorcentaje+$total);
						$this->tpl->setVariable('TOOLTIPTOTAL',_('Puntos iniciales').': '.$puntosJugador[$datos['idJugador']]['inicial'].' | '._('Puntos perdidos').': '.(-$totalPuntos));
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
	    	//Pestana tropas
	    	if(count($jugadores)>0){
				$this->tpl->setCurrentBlock('tUsuarioTropas');
				$this->tpl->setVariable('_TROPAS',_('Tropas'));
				$mostrarPestana=false;
				foreach($jugadores as $datos){
					//Datos
					$this->tpl->setVariable('TROPASJUGADOR',$datos['nombreJugador']);
					$this->tpl->setVariable('TROPASRAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('TROPASRAZA',$datos['nombreRaza']);
					if($datos['nombreAlianza']!='')
						$this->tpl->setVariable('TROPASALIANZA',$datos['nombreAlianza']);
	
					//Compobamos que sea necesario mostrar al jugador
					if((isset($unidadesJugador[$datos['idJugador']][SOLDADO]) && count($unidadesJugador[$datos['idJugador']][SOLDADO])>0) || (isset($unidadesDestruidasJugador[$datos['idJugador']][SOLDADO]) && count($unidadesDestruidasJugador[$datos['idJugador']][SOLDADO])>0) || (isset($unidadesCapturadasJugador[$datos['idJugador']][SOLDADO]) && count($unidadesCapturadasJugador[$datos['idJugador']][SOLDADO])>0)){
						//Iniciales
						if(isset($unidadesJugador[$datos['idJugador']][SOLDADO]) && count($unidadesJugador[$datos['idJugador']][SOLDADO])>0){
							$this->tpl->setVariable('_TROPASINICIALES',_('Iniciales'));
							$this->tpl->setVariable('_TROPASFINALES',_('Finales'));
							foreach($unidadesJugador[$datos['idJugador']][SOLDADO] as $unidad){
								//Si la cantidad inicial es diferente de 0
								if($unidad['cantidadInicial']>0){
									$this->tpl->setVariable('TROPAINICIALIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
									$this->tpl->setVariable('TROPAINICIAL',$unidad['nombreUnidad']);
									$this->tpl->setVariable('_CANTIDADINICIAL',_('Cantidad inicial'));
									$this->tpl->setVariable('_CANTIDADFINAL',_('Cantidad final'));
									$this->tpl->setVariable('NUMTROPAINICIAL',$unidad['cantidadInicial']);
									$this->tpl->setVariable('NUMTROPAFINAL',$unidad['cantidadFinal']);
									$this->tpl->parse('tTropaInicial');
								}
							}
						}
						else{
							$this->tpl->hideBlock('tTropasIniciales');
						}
	
						//Destruidas
						if(array_key_exists($datos['idJugador'], $unidadesDestruidasJugador) && array_key_exists(SOLDADO, $unidadesDestruidasJugador[$datos['idJugador']])){
							foreach($unidadesDestruidasJugador[$datos['idJugador']][SOLDADO] as $unidad){
								$this->tpl->setVariable('TROPADESTRUIDAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('TROPADESTRUIDA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADDESTRUIDA',_('Cantidad'));
								$this->tpl->setVariable('NUMTROPADESTRUIDA',$unidad['cantidad']);
								$this->tpl->parse('tTropaDestruida');
							}
							$this->tpl->setVariable('_TROPASDESTRUIDAS',_('Destruidas'));
						}
						else{
							$this->tpl->hideBlock('tTropasDestruidas');
						}
	
						//Capturada
						if(array_key_exists($datos['idJugador'], $unidadesCapturadasJugador) && array_key_exists(SOLDADO, $unidadesCapturadasJugador[$datos['idJugador']])){
							foreach($unidadesCapturadasJugador[$datos['idJugador']][SOLDADO] as $unidad){
								$this->tpl->setVariable('TROPACAPTURADAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('TROPACAPTURADA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADCAPTURADA',_('Cantidad'));
								$this->tpl->setVariable('NUMTROPACAPTURADA',$unidad['cantidad']);
								$this->tpl->parse('tTropaCapturada');
							}
							$this->tpl->setVariable('_TROPASCAPTURADAS',_('Capturadas'));
						}
						else{
							$this->tpl->hideBlock('tTropasCapturadas');
						}
	
						$mostrarPestana=true;
			        	$this->tpl->parseCurrentBlock();
					}
					else{
						$this->tpl->hideBlock('tUsuarioTropas');
					}
				}
				$this->tpl->parse('tPestanaTropas');
				$this->tpl->parse('tContenidoTropas');
	    	}
	    	if(!$mostrarPestana){
	    		$this->tpl->hideBlock('tPestanaTropas');
	    		$this->tpl->hideBlock('tContenidoTropas');
	    	}
	    
	    	//Pestana naves
	    	if(count($jugadores)>0){
				$this->tpl->setCurrentBlock('tUsuarioNaves');
				$this->tpl->setVariable('_NAVES',_('Naves'));
				$mostrarPestana=false;
				foreach($jugadores as $datos){
					//Datos
					$this->tpl->setVariable('NAVESJUGADOR',$datos['nombreJugador']);
					$this->tpl->setVariable('NAVESRAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('NAVESRAZA',$datos['nombreRaza']);
					if($datos['nombreAlianza']!='')
						$this->tpl->setVariable('NAVESALIANZA',$datos['nombreAlianza']);
	
					//Compobamos que sea necesario mostrar al jugador
					if((isset($unidadesJugador[$datos['idJugador']][NAVE]) && count($unidadesJugador[$datos['idJugador']][NAVE])>0) || (isset($unidadesDestruidasJugador[$datos['idJugador']][NAVE]) && count($unidadesDestruidasJugador[$datos['idJugador']][NAVE])>0) || (isset($unidadesCapturadasJugador[$datos['idJugador']][NAVE]) && count($unidadesCapturadasJugador[$datos['idJugador']][NAVE])>0)){
						//Iniciales
						if(isset($unidadesJugador[$datos['idJugador']][NAVE]) && count($unidadesJugador[$datos['idJugador']][NAVE])>0){
							$this->tpl->setVariable('_NAVESINICIALES',_('Iniciales'));
							$this->tpl->setVariable('_NAVESFINALES',_('Finales'));
							foreach($unidadesJugador[$datos['idJugador']][NAVE] as $unidad){
								//Si la cantidad inicial es diferente de 0
								if($unidad['cantidadInicial']>0){
									$this->tpl->setVariable('NAVEINICIALIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
									$this->tpl->setVariable('NAVEINICIAL',$unidad['nombreUnidad']);
									$this->tpl->setVariable('_CANTIDADINICIAL',_('Cantidad inicial'));
									$this->tpl->setVariable('_CANTIDADFINAL',_('Cantidad final'));
									$this->tpl->setVariable('NUMNAVEINICIAL',$unidad['cantidadInicial']);
									$this->tpl->setVariable('NUMNAVEFINAL',$unidad['cantidadFinal']);
									$this->tpl->parse('tNaveInicial');
								}
							}
						}
						else{
							$this->tpl->hideBlock('tNavesIniciales');
						}
	
						//Destruidas
						if(array_key_exists($datos['idJugador'], $unidadesDestruidasJugador) && array_key_exists(NAVE, $unidadesDestruidasJugador[$datos['idJugador']])){
							foreach($unidadesDestruidasJugador[$datos['idJugador']][NAVE] as $unidad){
								$this->tpl->setVariable('NAVEDESTRUIDAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('NAVEDESTRUIDA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADDESTRUIDA',_('Cantidad'));
								$this->tpl->setVariable('NUMNAVEDESTRUIDA',$unidad['cantidad']);
								$this->tpl->parse('tNaveDestruida');
							}
							
							$this->tpl->setVariable('_NAVESDESTRUIDAS',_('Destruidas'));
						}
						else{
							$this->tpl->hideBlock('tNavesDestruidas');
						}
	
						//Capturada
						if(array_key_exists($datos['idJugador'], $unidadesCapturadasJugador) && array_key_exists(NAVE, $unidadesCapturadasJugador[$datos['idJugador']])){
							foreach($unidadesCapturadasJugador[$datos['idJugador']][NAVE] as $unidad){
								$this->tpl->setVariable('NAVECAPTURADAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('NAVECAPTURADA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADCAPTURADA',_('Cantidad'));
								$this->tpl->setVariable('NUMNAVECAPTURADA',$unidad['cantidad']);
								$this->tpl->parse('tNaveCapturada');
							}
							$this->tpl->setVariable('_NAVESCAPTURADAS',_('Capturadas'));
						}
						else{
							$this->tpl->hideBlock('tNavesCapturadas');
						}
	
						$mostrarPestana=true;
			        	$this->tpl->parseCurrentBlock();
					}
					else{
						$this->tpl->hideBlock('tUsuarioNaves');
					}
				}
				$this->tpl->parse('tPestanaNaves');
				$this->tpl->parse('tContenidoNaves');
	    	}
	    	if(!$mostrarPestana){
	    		$this->tpl->hideBlock('tPestanaNaves');
	    		$this->tpl->hideBlock('tContenidoNaves');
	    	}
	    
	    	//Pestana defensas
	    	if(count($jugadores)>0){
				$this->tpl->setCurrentBlock('tUsuarioDefensas');
				$this->tpl->setVariable('_DEFENSAS',_('Defensas'));
				$mostrarPestana=false;
				foreach($jugadores as $datos){
					//Datos
					$this->tpl->setVariable('DEFENSASJUGADOR',$datos['nombreJugador']);
					$this->tpl->setVariable('DEFENSASRAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('DEFENSASRAZA',$datos['nombreRaza']);
					if($datos['nombreAlianza']!='')
						$this->tpl->setVariable('DEFENSASALIANZA',$datos['nombreAlianza']);
	
					//Compobamos que sea necesario mostrar al jugador
					if((isset($unidadesJugador[$datos['idJugador']][DEFENSA]) && count($unidadesJugador[$datos['idJugador']][DEFENSA])>0) || (isset($unidadesDestruidasJugador[$datos['idJugador']][DEFENSA]) && count($unidadesDestruidasJugador[$datos['idJugador']][DEFENSA])>0)){
						//Iniciales
						if(isset($unidadesJugador[$datos['idJugador']][DEFENSA]) && count($unidadesJugador[$datos['idJugador']][DEFENSA])>0){
							$this->tpl->setVariable('_DEFENSASINICIALES',_('Iniciales'));
							$this->tpl->setVariable('_DEFENSASFINALES',_('Finales'));
							foreach($unidadesJugador[$datos['idJugador']][DEFENSA] as $unidad){
								//Si la cantidad inicial es diferente de 0
								if($unidad['cantidadInicial']>0){
									$this->tpl->setVariable('DEFENSAINICIALIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
									$this->tpl->setVariable('DEFENSAINICIAL',$unidad['nombreUnidad']);
									$this->tpl->setVariable('_CANTIDADINICIAL',_('Cantidad inicial'));
									$this->tpl->setVariable('_CANTIDADFINAL',_('Cantidad final'));
									$this->tpl->setVariable('NUMDEFENSAINICIAL',$unidad['cantidadInicial']);
									$this->tpl->setVariable('NUMDEFENSAFINAL',$unidad['cantidadFinal']);
									$this->tpl->parse('tDefensaInicial');
								}
							}
						}
						else{
							$this->tpl->hideBlock('tDefensasIniciales');
						}
	
						//Destruidas
						if(array_key_exists($datos['idJugador'], $unidadesDestruidasJugador) && array_key_exists(DEFENSA, $unidadesDestruidasJugador[$datos['idJugador']])){
							foreach($unidadesDestruidasJugador[$datos['idJugador']][DEFENSA] as $unidad){
								$this->tpl->setVariable('DEFENSADESTRUIDAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('DEFENSADESTRUIDA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADDESTRUIDA',_('Cantidad'));
								$this->tpl->setVariable('NUMDEFENSADESTRUIDA',$unidad['cantidad']);
								$this->tpl->parse('tDefensaDestruida');
							}
							$this->tpl->setVariable('_DEFENSASDESTRUIDAS',_('Destruidas'));
						}
						else{
							$this->tpl->hideBlock('tDefensasDestruidas');
						}
	
						//Capturada
						if(array_key_exists($datos['idJugador'], $unidadesCapturadasJugador) && array_key_exists(DEFENSA, $unidadesCapturadasJugador[$datos['idJugador']])){
							foreach($unidadesCapturadasJugador[$datos['idJugador']][DEFENSA] as $unidad){
								$this->tpl->setVariable('DEFENSACAPTURADAIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidad'].'.jpg');
								$this->tpl->setVariable('DEFENSACAPTURADA',$unidad['nombreUnidad']);
								$this->tpl->setVariable('_CANTIDADCAPTURADA',_('Cantidad'));
								$this->tpl->setVariable('NUMDEFENSACAPTURADA',$unidad['cantidad']);
								$this->tpl->parse('tDefensaCapturada');
							}
							$this->tpl->setVariable('_DEFENSASCAPTURADAS',_('Capturadas'));
						}
						else{
							$this->tpl->hideBlock('tDefensasCapturadas');
						}
	
						$mostrarPestana=true;
						$this->tpl->parseCurrentBlock();
					}
					else{
						$this->tpl->hideBlock('tUsuarioDefensas');
					}
				}
				$this->tpl->parse('tPestanaDefensas');
				$this->tpl->parse('tContenidoDefensas');
	    	}
	    	if(!$mostrarPestana){
	    		$this->tpl->hideBlock('tPestanaDefensas');
	    		$this->tpl->hideBlock('tContenidoDefensas');
	    	}
	    
	    	//Planeta de la batalla
	    	if($planeta!=null){
	    		$this->tpl->setVariable('_PLANETA',_('Planeta'));
		    	$this->tpl->setVariable('_PLANETAMISION',_('Planeta'));
		        $this->tpl->setVariable('PLANETARIQ',$planeta['riqueza']);
		        $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
		        if($planeta['nombrePlaneta']==NULL)
		        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
		        else
		        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
		       	if($planeta['propietario']==NULL)
		       	 	 $this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
		        else
		        	 $this->tpl->setVariable('PLANETAUSR',$planeta['propietario']);
		        if($planeta['alianza']!=NULL)
					$this->tpl->setVariable('PLANETAALZ','('.$planeta['alianza'].')');
	
		    	//Dibujamos las coordenadas
		        $this->tpl->setCurrentBlock('tDibCoordenadas');
				for ($i=1;$i<=7;$i++) {
					$c=$planeta['coord'.$i];
				    $this->tpl->setVariable('COORD', $c);
				    $this->tpl->setVariable('IDSIMBOLO', $i);
				    $this->tpl->setVariable('IMGCOORD', $_ENV['config']->get('simbolosImgFolder').$planeta['idGalaxia'].'/'.str_pad($c, 2, "0", STR_PAD_LEFT).'.gif');
				    $this->tpl->parseCurrentBlock();
				}
	    	}
	    	else{
	    		$this->tpl->hideBlock('tPestanaPlaneta');
	    		$this->tpl->hideBlock('tContenidoPlaneta');
	    	}
	    
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>