<?php
	/**
	 * Modelo que gestiona la información
	 * de razas de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 30/01/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de razas de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 30/01/2009
	 */
	class RazaModel
	    extends ModelBase
	{
	    /**
	     * Devuelve la informacion de la raza 
	     * pasada como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 30/01/2009
	     */
	    public function raza($idRaza)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT id, nombre, maxPlanetas
						FROM raza
						WHERE id=\''.$idRaza.'\'');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	}
?>