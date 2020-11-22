<?php
	/**
	 * Vista de la actualizacion de eventos
	 *
	 * @author David & Jose
	 * @package views
	 * @since 19/04/2009
	 */
	
	
	
	/**
	 * Vista de la actualizacion de eventos
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 19/04/2009
	 */
	class ResumirEventosView
	    extends ViewBase
	{
	    /**
	     * Muestra el JS necesario para actualizar la interfaz
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer datos
	     * @return mixed
	     * @since 15/01/2010
	     */
	    public function actualizarJS($datos, $planetas, $idGalaxiaSel, $idPlanetaSel)
	    {
	        //Actualizamos los recursos
	        $this->actualizarRecursos($datos[0]['cantidad'], $datos[1]['cantidad'], $datos[2]['cantidad']);
	        
	        //Actualizamos las producciones
	        $this->actualizarProducciones($datos[0]['produccion'], $datos[1]['produccion'], $datos[2]['produccion']);
	        
	        //Actualizamos la lista de planetas
	        $this->actualizarPlanetas($planetas, $idGalaxiaSel, $idPlanetaSel);
	        
	    }
	
	}
?>