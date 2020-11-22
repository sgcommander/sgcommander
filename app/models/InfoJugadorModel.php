<?php
	/**
	 * Modelo de mejoras y sesion
	 *
	 * @author David & Jose
	 * @package models
	 * @since 16/04/2009
	 */
	
	
	
	/**
	 * Modelo de mejoras y sesion
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 16/04/2009
	 */
	class InfoJugadorModel
	    extends ModelBase
	{
		/**
	     * Vuelca el valor de las mejoras en la SESSION
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 16/04/2009
	     */
	    public function infoGeneral($idJugador)
	    {
	        
	        //Buscamos todas las mejoras
	        $consulta = $this->db->query('
	        	SELECT investigacionVelocidad, construccionVelocidad, numeroMensajes, limiteMisiones, numNaves, numSoldados, 
	        	limiteSoldados, numDefensas, produccionPrimario, produccionSecundario, produccionEnergia
	        	FROM jugadorInfoGeneral WHERE idJugador='.$idJugador.' LIMIT 1
	        ');
	        
	        //Devuelve la informacion en un array
	        $datos=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	    
	    public function infoPuntuacion($idJugador)
	    {
	    	$consulta = $this->db->query('
	    		SELECT puntosNaves, puntosSoldados, puntosDefensas, puntosTecnologias, puntosTotales
				FROM jugadorInfoPuntuaciones
				WHERE idJugador='.$idJugador.' LIMIT 1
	    	');
	    
	    	//Devuelve la informacion en un array
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	    }
	    
	    public function infoUnidades($idJugador){
	    	$consulta = $this->db->query('
	    		SELECT soldadosCarga, soldadosAtaque, soldadosResistencia, soldadosEscudo, navesCarga, navesAtaque, 
	    		navesResistencia, navesEscudo, navesVelocidad, defensasAtaque, defensasResistencia, 
	    		defensasEscudo, invisible, atraviesaIris, viajeIntergalactico, stargateIntergalactico
				FROM jugadorInfoUnidades
				WHERE idJugador='.$idJugador.' LIMIT 1
			');
	    
	    	//Devuelve la informacion en un array
	        $datos=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $datos;
	    }
	    
		public function infoProduccion($idJugador)
	    {
	        
	        //Buscamos todas las mejoras
	        $consulta = $this->db->query('
	        	SELECT produccionPrimario, produccionSecundario
	        	FROM jugadorInfoGeneral WHERE idJugador='.$idJugador.' LIMIT 1
	        ');
	        
	        //Devuelve la informacion en un array
	        $datos=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	    
		/**
	     * Devuelve las cantidades de los recursos dispuestas para ser volcadas en
	     * sesion
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 21/05/2009
	     */
	    public function cantidadRecursos($idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT cantidad
						FROM tipoRecursoUsuario
						WHERE idJugador=\''.$idJugador.'\' LIMIT 3');
	        
	        $datos = Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	list($datos[$i])=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }

		/**
	     * Vuelca el valor de la alianza en la SESSION
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 16/04/2009
	     */
	    public function infoAlianza($idJugador)
	    {
	        
	        //Buscamos todas las mejoras
	        $consulta = $this->db->query('
	        	SELECT idAlianza FROM jugador WHERE idUsuario='.$idJugador.' LIMIT 1
	        ');
	        
	        //Devuelve la informacion en un array
	        $datos=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>