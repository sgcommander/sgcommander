<?php
	/**
	 * Vista del modulo de defensas
	 *
	 * @author David & Jose
	 * @package views
	 * @since 12/06/2009
	 */
	
	
	
	/**
	 * Vista del modulo de defensas
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 12/06/2009
	 */
	class DefensasView
	    extends ViewBase
	{
	    /**
	     * Muestra la pantalla despues de cancelar
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer recursos
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function cancelar($recursos)
	    {
	        
	        //Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad'], $recursos[2]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/noConstruyendo.tpl');
	
			$this->tpl->setVariable('_CONSTRUIR',_('Construir'));
			$this->tpl->setVariable('_MAXIMO',_('M&#225;ximo'));
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Listado de defensas construibles
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer defensas
	     * @param  Integer mejoras
	     * @param  Integer recursos
	     * @param  Integer construccionActual
	     * @param  Integer costeRecursos
	     * @param  Integer costeUnidades
	     * @param  Integer idRaza
	     * @param  Integer mejoraConstruccion
	     * @param  Integer mejorasUnidad
	     * @param  Integer construidas
	     * @param  Boolean hayDefensaStargate
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function construibles($defensas, $mejoras, $recursos, $construccionActual, $costeRecursos, $costeUnidades, $idRaza, $mejoraConstruccion, $mejorasUnidad, $construidas, $hayDefensaStargate,$fuegoRapido)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/construibles.tpl');
	
			if(count($defensas)==0){
				$this->tpl->setVariable('IDRAZANOUNIDADES',$idRaza);
				$this->tpl->setVariable('_NOUNIDADES',_('No puedes construir defensas, consulta la secci&#243;n requisitos'));
				$this->tpl->parse('tNoUnidades');
				$this->tpl->hideBlock('tUnidad');
			}
			else{
				$this->tpl->hideBlock('tNoUnidades');
				$this->tpl->setCurrentBlock('tUnidad');
	
				if($construccionActual!=null){
					$tiempoRestante=$construccionActual['tiempo'];
					$idUnidadActual=$construccionActual['idUnidad'];
					$cantidad=$construccionActual['cantidad'];
				}
				else{
					$tiempoRestante=0;
					$idUnidadActual=0;
					$cantidad=0;
				}
	
				foreach($defensas as $datos){
					$this->tpl->setVariable('IDUNIDAD',$datos['id']);
					$this->tpl->setVariable('NOMUNIDAD',$datos['nombre']);
					$this->tpl->setVariable('TIPOUNIDAD',$datos['tipo']);
					$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$datos['id'].'.jpg');
					$this->tpl->setVariable('UNIDADDESC',$datos['descripcion']);
	
					//Atributos de la unidad
					if($datos['ataque']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['ataque'];
						$mejora=floor(($mejoras['defensasAtaque']/100)*$base);
						$this->tpl->setVariable('ATAQUE',$base+$mejora);
						$this->tpl->setVariable('_ATAQUE',_('Ataque'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tAtaque');
					}
					if($datos['resistencia']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['resistencia'];
						$mejora=floor(($mejoras['defensasResistencia']/100)*$base);
						$this->tpl->setVariable('RESISTENCIA',$base+$mejora);
						$this->tpl->setVariable('_RESISTENCIA',_('Resistencia'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tResistencia');
					}
					if($datos['escudo']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['escudo'];
						$mejora=floor(($mejoras['defensasEscudo']/100)*$base);
						$this->tpl->setVariable('ESCUDOS',$base+$mejora);
						$this->tpl->setVariable('_ESCUDOS',_('Escudos'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tEscudos');
					}
					if($datos['autodestruye']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_AUTODESTRUCCION',_('Se autodestruye al atacar'));
						$this->tpl->parse('tAutodestruccion');
					}
					if($datos['invisible'] || $mejoras['invisible']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_CAMUFLAJE',_('Camuflaje'));
						$this->tpl->parse('tCamuflaje');
					}
					if($datos['atraviesaEscudo']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_ATRAVIESAESCUDOS',_('Atraviesa escudos'));
						$this->tpl->parse('tAtraviesa');
					}
					
					//Fuego rapido
					if(array_key_exists($datos['idTipo'], $fuegoRapido) && $datos['ataque']>0){
						$this->tpl->setVariable('_FUEGORAPIDO',_('Fuego rápido'));
						$this->tpl->setVariable('_NUMDISPAROS',_('Nº disparos'));

						foreach($fuegoRapido[$datos['idTipo']] as $fuego){
							switch($fuego['tipo']){
								case NAVE:
									$tipo=_('Nave');
									break;
								case SOLDADO:
									$tipo=_('Soldado');
									break;
								case DEFENSA:
									$tipo=_('Defensa');
									break;
							}
							
							$this->tpl->setVariable('DISPAROS',$fuego['porcentaje']/100);
							$this->tpl->setVariable('UNIDADDEFIENDE',$tipo.' '.$fuego['subtipo']);
	
							$this->tpl->parse('tFuego');
						}
						$this->tpl->parse('tFuegoRapido');
					}
	
					//Costes de recursos
					$this->tpl->setVariable('RECURSOPRICANT',0);
					$this->tpl->setVariable('RECURSOSECCANT',0);
					$this->tpl->setVariable('ENERGIACANT',0);
					foreach($costeRecursos[$datos['id']] as $recurso){
						$this->tpl->setVariable('RECURSONOM',$recursos[$recurso['idTipoRecurso']-1]['nombre']);
						$this->tpl->setVariable('RECURSOIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/'.$recurso['idTipoRecurso'].'.png');
						$this->tpl->setVariable('RECURSOCANT',$recurso['cantidad']);
						switch($recurso['idTipoRecurso']){
							case 1:
								$this->tpl->setVariable('RECURSOPRICANT',$recurso['cantidad']);
								break;
							case 2:
								$this->tpl->setVariable('RECURSOSECCANT',$recurso['cantidad']);
								break;
							case 3:
								$this->tpl->setVariable('ENERGIACANT',$recurso['cantidad']);
								break;
						}
	
						$this->tpl->parse('tRecurso');
					}
	
					$this->tpl->setVariable('TIEMPOIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/tiempo.png');
					$this->tpl->setVariable('_TIEMPO',_('Tiempo'));
	
					//Calculamos el tiempo con las mejoras de construccion
					$tiempo=(($datos['tiempo']) / (($mejoraConstruccion/100)+1));
					$this->tpl->setVariable('TIEMPODHMS',Funciones::dhms($tiempo));
	
					//Costes de unidades
					if(array_key_exists($datos['id'], $costeUnidades)){
						$unidadesConstruibles=array();
						foreach($costeUnidades[$datos['id']] as $unidad){
							$this->tpl->setVariable('UNIDADREQNOM',$unidad['nombre']);
							$this->tpl->setVariable('UNIDADREQIMG',$_ENV['config']->get('unidadImgFolder').$unidad['idUnidadRequiere'].'.jpg');
							$this->tpl->setVariable('UNIDADREQCANT',$unidad['cantidad']);
	
							$this->tpl->parse('tUnidadReq');
	
							//Comprobamos cual es el maximo de unidades que podemos construir
							$unidadesConstruibles[]=intval($unidad['disponibles']/$unidad['cantidad']);
						}
	
						//Ponemos en la plantilla el maximo numero construible
						if(count($unidadesConstruibles)==0){
							$this->tpl->setVariable('MAXUNIDADESCONS',-1);
						}
						else
							$this->tpl->setVariable('MAXUNIDADESCONS',min($unidadesConstruibles));
					}
					else
						$this->tpl->setVariable('MAXUNIDADESCONS',-1);
	
					//Si es un heroe o una defensa de stargate
					if($datos['heroe'] || $datos['idTipo']==STARGATE)
						$this->tpl->setVariable('HEROE',1);
					else
						$this->tpl->setVariable('HEROE',0);
	
					//Mejoras de heroe
					if(array_key_exists($datos['id'], $mejorasUnidad)){
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$unidadesConstruibles=array();
						foreach($mejorasUnidad[$datos['id']] as $mejora){
							$signoPorcentaje='';
							if($mejora['porcentaje']>0)
								$signoPorcentaje='+';
							$this->tpl->setVariable('PORCENTAJE',$signoPorcentaje.$mejora['porcentaje'].'% ');
							$this->tpl->setVariable('MEJORA',$mejora['atributo'].' '.$mejora['unidad']);
	
							$this->tpl->parse('tMejora');
						}
						$this->tpl->parse('tMejoras');
					}
	
					$this->tpl->setVariable('TIEMPOTOTAL',$tiempo);
					$this->tpl->setVariable('_CONSTRUIR',_('Construir'));
					$this->tpl->setVariable('_MAXIMO',_('M&#225;ximo'));
					$this->tpl->setVariable('TIEMPO',$tiempoRestante);
					$this->tpl->setVariable('_CONSTRUYENDO',_('Construyendo'));
					$this->tpl->setVariable('_UNIDADES',_('unidades'));
					$this->tpl->setVariable('CANTIDAD',$cantidad);
					$this->tpl->setVariable('_CANCELAR',_('Cancelar'));
	
					if($idUnidadActual==$datos['id']){//Si es la undiad construida
						$this->tpl->setVariable('DISPLAYCONSTRUIR','none');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDOACTUAL','block');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDO','none');
					}
					elseif($idUnidadActual==0 && (!$datos['heroe'] || !in_array($datos['id'],$construidas)) && ($datos['idTipo']!=STARGATE || !$hayDefensaStargate)){//Si no se esta construyendo y se puede construir
						$this->tpl->hideBlock('tConstruyendoActual');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDOACTUAL','none');
						$this->tpl->setVariable('DISPLAYCONSTRUIR','block');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDO','none');
					}
					else{//Si no es la unidad construida
						$this->tpl->hideBlock('tConstruyendoActual');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDOACTUAL','none');
						$this->tpl->setVariable('DISPLAYCONSTRUIR','none');
						$this->tpl->setVariable('DISPLAYCONSTRUYENDO','block');
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra la pantalla construyendo
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer construccionActual
	     * @param  Integer recursos
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function construir($construccionActual, $recursos)
	    {
	        
	        //Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad'], $recursos[2]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/construyendo.tpl');
	
			if($construccionActual!=null){
				$tiempoRestante=$construccionActual['tiempo'];
				$cantidad=$construccionActual['cantidad'];
			}
			else{
				$tiempoRestante=0;
				$cantidad=0;
			}
	
			$this->tpl->setVariable('TIEMPO',$tiempoRestante);
			$this->tpl->setVariable('_CONSTRUYENDO',_('Construyendo'));
			$this->tpl->setVariable('_UNIDADES',_('unidades'));
			$this->tpl->setVariable('CANTIDAD',$cantidad);
			$this->tpl->setVariable('_CANCELAR',_('Cancelar'));
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Lista defensas disponibles
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer defensas
	     * @param  Integer mejoras
	     * @param  Integer usuario
	     * @param  Integer idRaza
	     * @param  Integer planetas
	     * @param  Integer destino
	     * @param  Integer numMisiones
	     * @param  Integer limiteMisiones
	     * @param  String mejoraLimiteMisiones
	     * @param  Integer recursos
	     * @param  Integer idGalaxiaOrigen
	     * @param  Integer stargateIntergalactico
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function disponibles($defensas, $mejoras, $usuario, $idRaza, $planetas, $destino, $numMisiones = null, $limiteMisiones = null, $mejoraLimiteMisiones = null, $recursos = null, $idGalaxiaOrigen = null, $stargateIntergalactico = null)
	    {
	        
	        //Actualizamos los recursos
	        $this->actualizarRecursos($recursos[0]['cantidad'], $recursos[1]['cantidad'], $recursos[2]['cantidad']);
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/disponibles.tpl');
	
			if($numMisiones>=$limiteMisiones)
				$this->tpl->setVariable('_UNIDADESPLANETA',_('Defensas disponibles'));
			else
				$this->tpl->setVariable('_UNIDADESPLANETA',_('Nueva misi&#243;n').': '._('Defensas disponibles'));
			$this->tpl->setVariable('_UNIDAD',_('Defensa'));
			$this->tpl->setVariable('_DISPONIBLES',_('Disponibles'));
			$this->tpl->setVariable('_TODAS',_('Todas'));
			$this->tpl->setVariable('_NINGUNA',_('Ninguna'));
			$this->tpl->setVariable('_ENVIARMISION',_('Enviar en misi&#243;n'));
			$this->tpl->setVariable('_LICENCIAR',_('Desmantelar'));
	
			if(count($defensas)==0){
				$this->tpl->setVariable('IDRAZANOUNIDADES',$idRaza);
				$this->tpl->setVariable('NOMUNIDADES','defensas');
				$this->tpl->setVariable('_NOUNIDADES',_('No hay defensas disponibles'));
				$this->tpl->parse('tNoUnidades');
				$this->tpl->hideBlock('tUnidades');
				$this->tpl->hideBlock('tLimite');
			}
			else{
				$this->tpl->hideBlock('tNoUnidades');
	
				//Mostramos el mensaje sobre el limite de misiones
				$this->tpl->setVariable('_LIMITEMISIONES',_('L&#237;mite de misiones'));
				$this->tpl->setVariable('IDRAZALIMITE',$idRaza);
				if($numMisiones>=$limiteMisiones)
					$this->tpl->setVariable('_MENSAJELIMITE',_('Ha alcanzado su l&#237;mite de misiones').' ('.$limiteMisiones.'), '._('investigue la mejora').' '.$mejoraLimiteMisiones.' '._('para aumentarlo'));
				else
					$this->tpl->setVariable('_MENSAJELIMITE',_('Actualmente esta realizando').' '.$numMisiones.'/'.$limiteMisiones.' '._('misiones').', '._('investigue la mejora').' '.$mejoraLimiteMisiones.' '._('para aumentar su l&#237;mite de misiones'));
				$this->tpl->parse('tLimite');
	
				//Traduccion del mensaje de confirmacion de licenciar
				$this->tpl->setVariable('_CONFLICENCIAR',_('&#191;Realmente desea desmantelar estas defensas&#63; Las defensas ser&#225;n destruidas'));
	
				$this->tpl->setCurrentBlock('tUnidad');
				foreach($defensas as $datos){
					$this->tpl->setVariable('IDUNIDAD',$datos['id']);
					$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$datos['id'].'.jpg');
					$this->tpl->setVariable('NOMUNIDAD',$datos['nombre']);
					$this->tpl->setVariable('TIPOUNIDAD',$datos['tipoDefensa']);
					$this->tpl->setVariable('CANTIDAD',$datos['cantidad']-$datos['cantidadEnMision']);
					$this->tpl->setVariable('CANTIDADTOTAL',$datos['cantidad']);
	
					//Atributos de la unidad
					if($datos['ataque']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['ataque'];
						$mejora=floor(($mejoras['defensasAtaque']/100)*$base);
						$this->tpl->setVariable('ATAQUE',$base+$mejora);
						$this->tpl->setVariable('_ATAQUE',_('Ataque'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tAtaque');
					}
					if($datos['resistencia']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['resistencia'];
						$mejora=floor(($mejoras['defensasResistencia']/100)*$base);
						$this->tpl->setVariable('RESISTENCIA',$base+$mejora);
						$this->tpl->setVariable('_RESISTENCIA',_('Resistencia'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tResistencia');
					}
					if($datos['escudo']>0){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$base=$datos['escudo'];
						$mejora=floor(($mejoras['defensasEscudo']/100)*$base);
						$this->tpl->setVariable('ESCUDOS',$base+$mejora);
						$this->tpl->setVariable('_ESCUDOS',_('Escudos'));
						$this->tpl->setVariable('_BASE',_('Base'));
						$this->tpl->setVariable('_MEJORAS',_('Mejoras'));
						$this->tpl->setVariable('BASE',$base);
						$this->tpl->setVariable('MEJORAS',$mejora);
						$this->tpl->parse('tEscudos');
					}
					if($datos['autodestruye']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_AUTODESTRUCCION',_('Se autodestruye al atacar'));
						$this->tpl->parse('tAutodestruccion');
					}
					if($datos['invisible'] || $mejoras['invisible']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_CAMUFLAJE',_('Camuflaje'));
						$this->tpl->parse('tCamuflaje');
					}
					if($datos['atraviesaEscudo']){
						$this->tpl->setVariable('IDRAZA',$idRaza);
						$this->tpl->setVariable('_ATRAVIESAESCUDOS',_('Atraviesa escudos'));
						$this->tpl->parse('tAtraviesa');
					}
	
					//Opciones de enviar
					if($datos['tiempoMover']){
						$this->tpl->setVariable('_NOSEPUEDEMOVER',_('Esta defensa no puede moverse'));
						//$this->tpl->parse('tOpciones');
						$this->tpl->hideBlock('tNoOpciones');
					}
					else{
						$this->tpl->setVariable('_NOSEPUEDEMOVER',_('Esta defensa no puede moverse'));
						$this->tpl->setVariable('_LICENCIARDEFENSASTARGATE',_('Desmantelar defensa'));
						//$this->tpl->parse('tNoOpciones');
						$this->tpl->hideBlock('tOpciones');
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
			//Ocultamos el destino si se ha superado el limite de misiones
			if($numMisiones>=$limiteMisiones){
				$this->tpl->hideBlock('tDestino');
			}
			else{
		    	//Planetas de destino
				$this->tpl->setCurrentBlock('tPlaneta');
				$this->tpl->setVariable('_SELECCIONAPLANETADESTINO',_('Selecciona el planeta de destino'));
				$this->tpl->setVariable('_DESTINODELAMISION',_('Destino de la misi&#243;n'));
	
				$listaDestino=Array();
				foreach($planetas as $datos){
					//Comprobamos si se puede viajar al planeta desde el origen
					if($idGalaxiaOrigen==$datos['idGalaxia'] || $stargateIntergalactico){
						$listaDestino[0][count($listaDestino)]=$datos['idGalaxia'];
						$listaDestino[1][count($listaDestino)]=$datos['idPlaneta'];
						$this->tpl->setVariable('IDGALAXIA',$datos['idGalaxia']);
						$this->tpl->setVariable('IDPLANETA',$datos['idPlaneta']);
	
						if($datos['nombrePlaneta']=='')
							$this->tpl->setVariable('PLANETA',$datos['nombreSGC'].' '._('Controlado por').': '.$usuario);
						else
							$this->tpl->setVariable('PLANETA',$datos['nombrePlaneta'].' ('.$datos['nombreSGC'].') '._('Controlado por').': '.$usuario);
	
						$datosplaneta=$datos['idGalaxia'].'|'.$datos['idPlaneta'];
			        	$this->tpl->setVariable('DATOSPLANETA',$datosplaneta);
	
						//Si es el planeta de destino lo marcamos como seleccionado
						if($destino!=null && $destino['idGalaxia']==$datos['idGalaxia'] && $destino['idPlaneta']==$datos['idPlaneta'])
							$this->tpl->setVariable('SELECTED','selected="selected"');
	
				       	$this->tpl->parseCurrentBlock();
					}
				}
	
				//Si hay destino se coloca por defecto
				if($destino!=null){
					//Cargamos la plantilla
					$this->tpl->addBlockfile('MISIONPLANETA','tMisionDestino','unidades/destino.tpl');
	
					//Idioma
					$this->tpl->setVariable('_VELOCIDAD',_('Velocidad'));
					$this->tpl->setVariable('_TIPOMISION',_('Tipo de misi&#243;n'));
			        $this->tpl->setVariable('_SELECCIONATIPOMISION',_('Selecciona misi&#243;n'));
			        
			        //Planeta
			        $this->tpl->setVariable('PLANETAIDGALAXIA',$destino['idGalaxia']);
					$this->tpl->setVariable('PLANETAID',$destino['idPlaneta']);
	
					//Anadimos el destino a la lista si no esta
					if(!(in_array($destino['idGalaxia'],$listaDestino[0]) && in_array($destino['idPlaneta'],$listaDestino[1]))){
						$this->tpl->setCurrentBlock('tPlaneta');
						$datosplaneta=$destino['idGalaxia'].'|'.$destino['idPlaneta'];
			        	$this->tpl->setVariable('DATOSPLANETA',$datosplaneta);
						if($destino['explorado']){
							if($destino['idPropietario']==''){
								if($destino['nombrePlaneta']=='')
									$this->tpl->setVariable('PLANETA',$destino['nombreSGC'].' '._('Riqueza').': '.$destino['riqueza'].'%');
								else
									$this->tpl->setVariable('PLANETA',$destino['nombrePlaneta'].' ('.$destino['nombreSGC'].') '._('Riqueza').': '.$destino['riqueza'].'%');
							}
							else{
								if($destino['nombrePlaneta']=='')
									$this->tpl->setVariable('PLANETA',$destino['nombreSGC'].' '._('Controlado por').': '.$destino['propietario']);
								else
									$this->tpl->setVariable('PLANETA',$destino['nombrePlaneta'].' ('.$destino['nombreSGC'].') '._('Controlado por').': '.$destino['propietario']);
							}
						}
						else
							$this->tpl->setVariable('PLANETA',$destino['nombreSGC']);
	
						$this->tpl->setVariable('SELECTED','selected="selected"');
	
						$this->tpl->parseCurrentBlock();
					}
	
					//Si esta explorado mostramos unas cosas si no otras
					if($destino['explorado']){
						if($destino['nombrePlaneta']=='')
							$this->tpl->setVariable('PLANETANOM',$destino['nombreSGC']);
						else
							$this->tpl->setVariable('PLANETANOM',$destino['nombrePlaneta'].' ('.$destino['nombreSGC'].')');
					      
					    $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$destino['imagen']);
					    $this->tpl->setVariable('PLANETARIQ',$destino['riqueza']);
					        
					    if($destino['idPropietario']==''){
							$this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
							$this->tpl->setVariable('PLANETAALZ','');
					    }
						else{
							$this->tpl->setVariable('PLANETAUSR',$destino['propietario']);
							if($destino['alianza']!=''){
								$this->tpl->setVariable('PLANETAALZ','('.$destino['alianza'].')');
							}
							else{
								$this->tpl->setVariable('PLANETAALZ','');
							}
						}
	
						//Misiones
						$this->tpl->setVariable('_DESPLEGAR',_('Desplegar'));
						$this->tpl->setVariable('_CONTRATACAR',_('Contratacar'));
					}
					else{
						$this->tpl->setVariable('PLANETANOM',$destino['nombreSGC']);
						$this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').'sinexplo.jpg');
	
						//Misiones
						$this->tpl->setVariable('_EXPLORAR',_('Explorar'));
					}
				}
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el modulo de defensas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer pestana
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function defensas($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/unidades.tpl');
	
			$this->tpl->setVariable('_DISPONIBLESPLANETA',_('En el planeta'));
			$this->tpl->setVariable('_CONSTRUIR',_('Construir'));
			$this->tpl->setVariable('_REQUISITOS',_('Requisitos'));
	
			$this->tpl->setVariable('CONTROLADOR','Defensas');
			$this->tpl->setVariable('ACCION','defensas');
	
			//Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra los requisitos de las defensas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer defensas
	     * @param  Integer requisitos
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function requisitos($defensas, $requisitos)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('unidades/requisitos.tpl');
	
			$this->tpl->setVariable('_UNIDAD',_('Defensa'));
			$this->tpl->setVariable('_REQUISITOS',_('Requisitos'));
	
			//Volcamos los requisitos
			if(count($defensas)==0){
				$this->tpl->setVariable('_NOUNIDADES',_('No hay defensas construibles'));
				$this->tpl->parse('tNoUnidades');
				$this->tpl->hideBlock('tUnidades');
			}
			else{
				$this->tpl->hideBlock('tNoUnidades');
	
				$this->tpl->setCurrentBlock('tUnidad');
				foreach($defensas as $datos){
					$this->tpl->setVariable('IDUNIDAD',$datos['id']);
					$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$datos['id'].'.jpg');
					$this->tpl->setVariable('NOMUNIDAD',$datos['nombre']);
	
					//Requisitos
					foreach($requisitos[$datos['id']] as $requisito){
						$this->tpl->setVariable('NOMMEJORA',$requisito['nombre']);
						$this->tpl->setVariable('_NIVEL',_('Nivel'));
						$this->tpl->setVariable('NIVEL',$requisito['nivel']);
						if($requisito['cumple'])
							$this->tpl->parse('tRequisitoCumplido');
						else
							$this->tpl->parse('tRequisitoNoCumplido');
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>