<?php
	/**
	 * Vista del modulo de opciones
	 *
	 * @author David & Jose
	 * @package views
	 * @since 28/09/2009
	 */
	
	
	
	/**
	 * Vista del modulo de opciones
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 28/09/2009
	 */
	class OpcionesView
	    extends ViewBase
	{
	    /**
	     * Menu de opciones
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String pestana
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function show($pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('opciones/opciones.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_TUSDATOS',_('Tus datos'));
	        $this->tpl->setVariable('_PERSONALIZAR',_('Personalizar'));
	        
	        //Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Panel de datos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer datos
	     * @param  Integer email
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function datos($datos, $email, $idiomas)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('opciones/datos.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_TUSDATOS',_('Tus datos'));
	        $this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_CONTRASENA',_('Contrase&#241;a'));
	        $this->tpl->setVariable('_REPETIRCONTRASENA',_('Repetir contrase&#241;a'));
	        $this->tpl->setVariable('_EMAIL',_('Correo electr&#243;nico'));
	        $this->tpl->setVariable('_IDIOMA',_('Idioma'));
	        $this->tpl->setVariable('_IDIOMAACTUAL',_('Idioma actual'));
	        $this->tpl->setVariable('_CAMBIARIDIOMA',_('Cambiar idioma'));
	        $this->tpl->setVariable('_CAMBIARDATOS',_('Cambiar datos'));
	        $this->tpl->setVariable('_OPCIONESCUENTA',_('Opciones de cuenta'));
	        $this->tpl->setVariable('_MODOVACIONES',_('Modo vacaciones'));
	        $this->tpl->setVariable('_BORRARCUENTA',_('Borrar cuenta'));
	        $this->tpl->setVariable('_CONFBORRAR',_('&#191;Realmente desea borrar su cuenta&#63; Este proceso es irreversible y no podr&#225; recuperar su cuenta de ningun modo.'));
	        $this->tpl->setVariable('_CONFBORRAR2',_('&#191;Esta totalmente seguro&#63;'));
	        $this->tpl->setVariable('_CONFMODOVACACIONES',_('&#191;Desea activar el modo vacaciones&#63; El tiempo m&#237;nimo del modo vacaciones es 48 horas, durante este tiempo no podr&#225; interactuar con su cuenta pero tampoco recibira ataques de otros jugadores.'));
	        //Segun si tengo la opcion de proteccion ip activada o no, debo mostrar
	        //el boton de activarla o el de desactivarla
	        if($datos['proteccionIP']){
	        	$this->tpl->setVariable('_PROTECCIONIP',_('Desactivar protecci&#243;n IP'));
	        	$this->tpl->setVariable('_CONFPROTECCIONIP', _('&#191;Desea desactivar la protecci&#243;n de IP de la cuenta&#63; (NO Recomendado)'));
	        }
	        else{
	        	$this->tpl->setVariable('_PROTECCIONIP',_('Activar protecci&#243;n IP'));
	        	$this->tpl->setVariable('_CONFPROTECCIONIP', _('&#191;Desea activar la protecci&#243;n de IP de la cuenta&#63; (Recomendado)'));
	        }
	        
	        $this->tpl->setVariable('USUARIO',$datos['usuario']);
	        $this->tpl->setVariable('EMAIL',$email);
	        
	    	//Idiomas
			$this->tpl->setCurrentBlock('tIdioma');
			foreach($idiomas as $i){
				$this->tpl->setVariable('IDIDIOMA',$i['id']);
				$this->tpl->setVariable('IDIOMA',$i['nombre']);
				$this->tpl->setVariable('IMGIDIOMA',$_ENV['config']->get('idiomasImgFolder').$i['id'].'.png');
	        	//Si es el logotipo actual
	        	if($datos['lang']==$i['codigo']){
	        		$this->tpl->setVariable('SELECTED','selected="selected"');
	        	}
				$this->tpl->parseCurrentBlock();
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Panel de personalizar
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer logotipos
	     * @param  Integer firmas
	     * @param  Integer logotipoActual
	     * @param  Integer firmaActual
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function personalizar($logotipos, $firmas, $logotipoActual, $firmaActual, $idJugador)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('opciones/personalizar.tpl');
	
			//Idioma
			$this->tpl->setVariable('_LOGOTIPO',_('Logotipo'));
			$this->tpl->setVariable('_CAMBIARLOGOTIPO',_('Cambiar logotipo'));
			$this->tpl->setVariable('_FIRMA',_('Firma'));
			$this->tpl->setVariable('_CAMBIARFIRMA',_('Cambiar firma'));
			$this->tpl->setVariable('_URL',_('URL'));
			$this->tpl->setVariable('_FOROS',_('Foros'));
			$this->tpl->setVariable('_HTML',_('HTML'));
			$this->tpl->setVariable('FIRMAURL',$_ENV['config']->get('urlFirmas').'/'.$idJugador.'.jpg');
			$this->tpl->setVariable('FIRMAFOROS','[url=http://www.sgcommander.com][img]'.$_ENV['config']->get('urlFirmas').'/'.$idJugador.'.jpg[/img][/url]');
			$this->tpl->setVariable('FIRMAHTML','&lt;a href=\'http://www.sgcommander.com\'&gt;&lt;img src=\''.$_ENV['config']->get('urlFirmas').'/'.$idJugador.'.jpg\' border=\'0\' alt=\'SGCommander.com\' /&gt;&lt;/a&gt;');
	        
			//Logotipos
			$this->tpl->setCurrentBlock('tLogotipo');
			foreach($logotipos as $datos){
				$this->tpl->setVariable('NOMLOGOTIPO',$datos['nombre']);
				$datoslogotipo=$datos['id'].'|'.$_ENV['config']->get('logotipoImgFolder').$datos['ruta'];
	        	$this->tpl->setVariable('DATOSLOGOTIPO',$datoslogotipo);
	        	//Si es el logotipo actual
	        	if($datos['id']==$logotipoActual){
	        		$this->tpl->setVariable('SELECTED','selected="selected"');
	        		$this->tpl->setVariable('IMGLOGOTIPOACTUAL',$_ENV['config']->get('logotipoImgFolder').$datos['ruta']);
	        	}
				$this->tpl->parseCurrentBlock();
			}
	
	    	//Firmas
			$this->tpl->setCurrentBlock('tFirma');
			foreach($firmas as $datos){
				$this->tpl->setVariable('NOMFIRMA',$datos['nombre']);
				$datosfirma=$datos['id'].'|'.$_ENV['config']->get('firmaImgFolder').$datos['ruta'];
	        	$this->tpl->setVariable('DATOSFIRMA',$datosfirma);
	        	//Si es el logotipo actual
	        	if($datos['id']==$firmaActual){
	        		$this->tpl->setVariable('SELECTED','selected="selected"');
	        		$this->tpl->setVariable('IMGFIRMAACTUAL',$_ENV['config']->get('firmaImgFolder').$datos['ruta']);
	        	}
				$this->tpl->parseCurrentBlock();
			}
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>