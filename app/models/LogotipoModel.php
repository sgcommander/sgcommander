<?php
	/**
	 * Gestiona los datos de logotipos
	 *
	 * @author David & Jose
	 * @package models
	 * @since 11/02/2009
	 */
	
	
	
	/**
	 * Gestiona los datos de logotipos
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 11/02/2009
	 */
	class LogotipoModel
	    extends ModelBase
	{
	    /**
	     * Devuelve la informacion del logotipo 
	     * pasado como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idLogotipo
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function logotipo($idLogotipo)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT id, idRaza, nombre, ruta '.
						'FROM logotipo '.
						'WHERE id=\''.$idLogotipo.'\' LIMIT 1');
	
			$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Cambia el logoipo de un jugador por el logotipo 
	     * pasado como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idLogotipo
	     * @return mixed
	     * @since 11/02/2009
	     */
	    public function cambiarLogotipo($idJugador, $idLogotipo)
	    {
	        
	        $this->db->query('UPDATE jugador SET idLogotipo=\''.$idLogotipo.'\'
	    								WHERE idUsuario=\''.$idJugador.'\'');
	    	return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve los logos de la raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 30/01/2009
	     */
	    public function logotipos($idRaza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT id, nombre, ruta 
						FROM logotipo
						WHERE idRaza=\''.$idRaza.'\'');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>