<?php
	/**
	 * Gestiona los datos de firmas
	 *
	 * @author David & Jose
	 * @package models
	 * @since 11/02/2009
	 */
	
	
	
	/**
	 * Gestiona los datos de firmas
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 11/02/2009
	 */
	class FirmaModel
	    extends ModelBase
	{
	    /**
	     * Cambia la firma de un jugador por la firma 
	     * pasada como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idFirma
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function cambiarFirma($idJugador, $idFirma)
	    {
	        
	        $this->db->query('UPDATE jugador SET idFirma=\''.$idFirma.'\'
	    								WHERE idUsuario=\''.$idJugador.'\'');
	    	return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve la informacion de la firma 
	     * pasada como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idFirma
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function firma($idFirma)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT id, idRaza, nombre, ruta '.
						'FROM firma '.
						'WHERE id=\''.$idFirma.'\' LIMIT 1');
	
			$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve las firmas de la raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 30/01/2009
	     */
	    public function firmas($idRaza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT id, nombre, ruta 
						FROM firma
						WHERE idRaza=\''.$idRaza.'\'');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>