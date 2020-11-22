<?php
	/**
	 * Vista del modulo de recursos
	 *
	 * @author David & Jose
	 * @package views
	 * @since 12/02/2009
	 */
	
	
	
	/**
	 * Vista del modulo de recursos
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 12/02/2009
	 */
	class RecursosView
	    extends ViewBase
	{
	    /**
	     * Carga las variables en la plantilla y la muestra
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String pestana
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function show($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('recursos/recursos.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_RECURSOS',_('Recursos'));
	        $this->tpl->setVariable('_COMERCIOS',_('Comercios'));
	        
	        //Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra informacion de los recursos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer recursos
	     * @param  Integer unidades
	     * @return mixed
	     * @since 12/02/2009
	     */
	    public function info($recursos, $unidades, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('recursos/infoRecursos.tpl');
			
			$this->tpl->setVariable('IDRAZA',$idRaza);
	
			//Idioma
	        $this->tpl->setVariable('_RECURSO',_('Recurso'));
	        $this->tpl->setVariable('_PRODUCCION',_('Producci&#243;n'));
	        $this->tpl->setVariable('_DISPONIBLE',_('Disponible'));
	        
	        $this->tpl->setVariable('_UNIDADES',_('Unidades'));
	        $this->tpl->setVariable('_MAXIMO',_('M&#225;ximo'));
	        $this->tpl->setVariable('_ACTUAL',_('Disponible'));
	        $this->tpl->setVariable('_TROPAS',_('Tropas'));
	        $this->tpl->setVariable('_NAVES',_('Naves'));
	        $this->tpl->setVariable('_DEFENSAS',_('Defensas'));
	        
	        $this->tpl->setVariable('_INTERCAMBIAR',_('Intercambiar'));
	        $this->tpl->setVariable('_RECURSOS',_('Recursos'));
	        $this->tpl->setVariable('_DE',_('de'));
	        $this->tpl->setVariable('_POR',_('por'));
	
			$this->tpl->setCurrentBlock('tInfoRecursos');
	
			//Recorremos la informacion de recursos
			for($i=0;$i < 3;$i++){
				$this->tpl->setVariable('_UND',_('und'));
				$this->tpl->setVariable('INFORECURSOIMG',$_ENV['config']->get('recursoImgFolder').$idRaza.'/'.($i+1).'.png');
				$this->tpl->setVariable('INFORECURSOCANTIDAD',floor($recursos[$i]['cantidad']));
				$this->tpl->setVariable('INFORECURSONOM', $recursos[$i]['nombre']);
	
				if($i==0){
					$this->tpl->setVariable('RECURSOPRINOM',$recursos[0]['nombre']);
					$this->tpl->setVariable('SPANRECNOM','recursoPriCant');
				}
	
				if($i==1){
					$this->tpl->setVariable('RECURSOSECNOM',$recursos[1]['nombre']);
					$this->tpl->setVariable('SPANRECNOM','recursoSecCant');
				}
	
				if($i==2){
					$this->tpl->setVariable('SPANRECNOM','energiaCant');
				}
	
				//Ajustamos la produccion segun el tipo de recurso
				if($i!=2)
					$this->tpl->setVariable('INFORECURSOPRODUCCION',(round($recursos[$i]['produccion']*3600)).' '._('und').' / h');
				else
					$this->tpl->setVariable('INFORECURSOPRODUCCION',floor($recursos[$i]['produccion']).' '._('und'));
	
		        $this->tpl->parseCurrentBlock();
			}
	
			//Recorremos la informacion de unidades
			$this->tpl->setVariable('_UND',_('und'));
			$this->tpl->setVariable('TROPASLIM',$unidades['limiteSoldados']);
			$this->tpl->setVariable('TROPASACTUAL',$unidades['numSoldados']);
			$this->tpl->setVariable('NAVESACTUAL',$unidades['numNaves']);
			$this->tpl->setVariable('DEFENSASACTUAL',$unidades['numDefensas']);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Lista los comercios enviados y recibidos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer comerciosRecibidos
	     * @param  Integer comerciosEnviados
	     * @param  String nomRecPri
	     * @param  String nomRecSec
	     * @return mixed
	     * @since 14/02/2009
	     */
	    public function comercios($comerciosRecibidos, $comerciosEnviados, $nomRecPri, $nomRecSec, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('recursos/comercios.tpl');
	
	        //Mostramos los bloques correctos
	        if(count($comerciosRecibidos)==0 && count($comerciosEnviados)==0){
	        	$this->tpl->touchBlock('tNoComercios');
	        	$this->tpl->setVariable('IDRAZA',$idRaza);
	        	$this->tpl->setVariable('_NOCOMERCIOS',_('No hay comercios'));
	        }
	        else{
	        	if(count($comerciosRecibidos)>0){
	        		//Idioma
	        		$this->tpl->setVariable('_RECIBIDOS',_('Recibidos'));
			        $this->tpl->setVariable('_ENVIADOPOR',_('Enviado por'));
			        $this->tpl->setVariable('_OFRECE',_('Ofrece'));
			        $this->tpl->setVariable('_PIDE',_('Pide'));
			        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
			        
		        	//Datos de los comercios
		        	$this->tpl->setCurrentBlock('tComercioRecibido');
		        	foreach($comerciosRecibidos as $datos){
		        		$this->tpl->setVariable('IDCOMERCIO',$datos['id']);
		        		$this->tpl->setVariable('COMRECUSUARIO',$datos['jugadorOrig']);
		        		$this->tpl->setVariable('RECCANTIDADPRIOFRECIDA',$datos['cantidadOfrecePri']);
		        		$this->tpl->setVariable('RECCANTIDADSECOFRECIDA',$datos['cantidadOfreceSec']);
		        		$this->tpl->setVariable('RECCANTIDADPRIPEDIDA',$datos['cantidadPidePri']);
		        		$this->tpl->setVariable('RECCANTIDADSECPEDIDA',$datos['cantidadPideSec']);
		        		$this->tpl->setVariable('PRIMARIO',$nomRecPri);
		        		$this->tpl->setVariable('SECUNDARIO',$nomRecSec);
	
		        		$this->tpl->setVariable('_ACEPTAR',_('Aceptar'));
			        	$this->tpl->setVariable('_RECHAZAR',_('Rechazar'));
			        	$this->tpl->parseCurrentBlock();
		        	}
	        	}
	        	else
	        		$this->tpl->hideBlock('tComerciosRecibidos');
	        
				if(count($comerciosEnviados)>0){
	        		//Idioma
	        		$this->tpl->setVariable('_ENVIADOS',_('Enviados'));
			        $this->tpl->setVariable('_ENVIADOA',_('Enviado a'));
			        $this->tpl->setVariable('_OFRECES',_('Ofreces'));
			        $this->tpl->setVariable('_PIDES',_('Pides'));
			        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
			        
		        	//Datos
		        	$this->tpl->setCurrentBlock('tComercioEnviado');
		        	foreach($comerciosEnviados as $datos){
		        		$this->tpl->setVariable('IDCOMERCIO',$datos['id']);
		        		$this->tpl->setVariable('COMENVUSUARIO',$datos['jugadorDest']);
		        		$this->tpl->setVariable('ENVCANTIDADPRIOFRECIDA',$datos['cantidadOfrecePri']);
		        		$this->tpl->setVariable('ENVCANTIDADSECOFRECIDA',$datos['cantidadOfreceSec']);
		        		$this->tpl->setVariable('ENVCANTIDADPRIPEDIDA',$datos['cantidadPidePri']);
		        		$this->tpl->setVariable('ENVCANTIDADSECPEDIDA',$datos['cantidadPideSec']);
		        		$this->tpl->setVariable('PRIMARIO',$nomRecPri);
		        		$this->tpl->setVariable('SECUNDARIO',$nomRecSec);
		        
		        		$this->tpl->setVariable('_CANCELAR',_('Cancelar'));
		        		$this->tpl->parseCurrentBlock();
		        	}
	        	}
	        	else
	        		$this->tpl->hideBlock('tComerciosEnviados');
	        }
	         
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el formulario de enviar nuevo comercio
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer usuario
	     * @param  Integer idUsuario
	     * @param  Integer nomRecPri
	     * @param  Integer nomRecSec
	     * @return mixed
	     * @since 03/03/2010
	     */
	    public function nuevoComercio($usuario, $idUsuario, $nomRecPri, $nomRecSec)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('recursos/nuevoComercio.tpl');
	
			//Idioma
			$this->tpl->setVariable('_OFRECES',_('Ofreces'));
			$this->tpl->setVariable('_PIDES',_('Pides'));
			$this->tpl->setVariable('_DESTINATARIO',_('Enviar comercio a'));
			$this->tpl->setVariable('_ENVIARCOMERCIO',_('Enviar comercio'));
	
			$this->tpl->setVariable('IDDESTINO',$idUsuario);
			$this->tpl->setVariable('DESTINO',$usuario);
			$this->tpl->setVariable('PRIMARIO',$nomRecPri);
			$this->tpl->setVariable('SECUNDARIO',$nomRecSec);
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>