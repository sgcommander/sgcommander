<?php
	/**
	 * Vista para mensajes de error y de informacion
	 *
	 * @author David & Jose
	 * @package views
	 * @since 16/02/2009
	 */
	
	
	
	/**
	 * Vista para mensajes de error y de informacion
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 16/02/2009
	 */
	class MensajeView
	    extends ViewBase
	{
	    /**
	     * Muestra el mensaje de error
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String mensaje
	     * @return mixed
	     * @since 16/02/2009
	     */
	    public function error($mensaje)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajeError.tpl');
	
	        $this->tpl->setVariable('MENSAJE',$mensaje);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra un mensaje de informacion
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String mensaje
	     * @return mixed
	     * @since 02/10/2009
	     */
	    public function info($mensaje)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('mensajeInfo.tpl');
	
	        $this->tpl->setVariable('MENSAJE',$mensaje);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra un mensaje sin aspecto
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String mensaje
	     * @return mixed
	     * @since 02/10/2009
	     */
	    public function mensaje($mensaje)
	    {
	        
	        echo $mensaje;
	        
	    }
	
	}
?>