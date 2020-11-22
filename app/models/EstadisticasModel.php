<?php
	/**
	 * Gestiona los datos estadisticos de los usuarios
	 *
	 * @author David & Jose
	 * @package models
	 * @since 05/02/2009
	 */
	
	
	
	/**
	 * Gestiona los datos estadisticos de los usuarios
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 05/02/2009
	 */
	class EstadisticasModel
	    extends ModelBase
	{
	    /**
	     * Devuelve un array con las puntuaciones 
	     * de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 05/02/2009
	     */
	    public function puntuaciones($idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT puntosTotales AS puntuacion,
						puntosNaves, puntosSoldados, puntosDefensas, puntosTecnologias
						FROM jugadorInfoPuntuaciones
						WHERE idJugador=\''.$idJugador.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve la posicion de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer puntuacion
	     * @param  Integer tipoPuntuacion
	     * @return mixed
	     * @since 05/02/2009
	     */
	    public function posicion($idJugador, $puntuacion, $tipoPuntuacion = 'total')
	    {
	        
	        switch($tipoPuntuacion){
	        	case 'naves':
	        		$puntos='puntosNaves';
	        		break;
	        	case 'tropas':
	        		$puntos='puntosSoldados';
	        		break;
	        	case 'defensas':
	        		$puntos='puntosDefensas';
	        		break;
	        	case 'investigacion':
	        		$puntos='puntosTecnologias';
	        		break;
	        	default:
	        		$puntos='puntosTotales';
	        }

	        $consulta = $this->db->query(
	        			'SELECT count(*) AS posicion
						FROM jugadorInfoPuntuaciones
						WHERE '.$puntos.' > \''.$puntuacion.'\'
						OR ('.$puntos.' = \''.$puntuacion.'\' AND idJugador <= \''.$idJugador.'\') LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos['posicion'];
	        
	    }
	
	    /**
	     * Devuelve un array con el numero de unidades 
	     * y los limites de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 16/02/2009
	     */
	    public function unidades($idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT numNaves, numSoldados, numDefensas, limiteSoldados
						FROM jugadorInfoGeneral
						WHERE idJugador=\''.$idJugador.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>