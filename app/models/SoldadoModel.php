<?php
	/**
	 * Modelo que gestiona la información
	 * de tropas
	 *
	 * @author David & Jose
	 * @package models
	 * @since 12/06/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de tropas
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 12/06/2009
	 */
	class SoldadoModel
	    extends UnidadModel
	{
	    /**
	     * Representa la tabla de soldados
	     *
	     * @access protected
	     * @since 12/06/2009
	     * @var String
	     */
	    protected $tabla = 'soldado';
	
	    
	
	    /**
	     * Devuelve los atributos de un soldado
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function atributos($unidades)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT s.idUnidad, t.idTipoSoldado AS idTipo, t.nombre AS tipo, s.carga
						FROM soldado s 
							JOIN tipoSoldado t ON s.idTipoSoldado=t.idTipoSoldado
						WHERE s.idUnidad IN (\''.implode('\',\'',$unidades).'\')');
	        
	        $datos = Array();
	
	    	for($i=0; $i<$consulta->num_rows; $i++){
	        	$row=$consulta->fetch_assoc();
	        	$datos[$row['idUnidad']]=$row;
			}
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve las tropas disponibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 12/06/2009
	     */
	    public function disponibles($idGalaxia, $idPlaneta)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT u.id, u.nombre, t.nombre AS tipoSoldado, s.idTipoSoldado, cantidadEnMision, cantidad, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo, s.carga
						FROM unidadJugadorPlaneta up 
							JOIN unidad u ON u.id=up.idUnidad
							JOIN soldado s ON u.id=s.idUnidad
							JOIN tipoSoldado t ON s.idTipoSoldado=t.idTipoSoldado
						WHERE up.idGalaxia=\''.$idGalaxia.'\' 
						AND up.idPlaneta=\''.$idPlaneta.'\' 
						');
	
			$datos=array();
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
	        //Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idTipoSoldado'] <= $b['idTipoSoldado'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Calcula el tiempo de mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer tipoMision
	     * @param  Integer porcentajeVelocidad
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function tiempoMision($tipoMision, $porcentajeVelocidad)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT tiempo
						FROM tipoMision
						WHERE id=\''.$tipoMision.'\' LIMIT 1');
	
			list($tiempo)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
	        //Calculamos el porcentaje de tiempo al que se desea viajar
			return $tiempo/($porcentajeVelocidad/100);
	        
	    }
	
	    /**
	     * Devuelve información de  la mejora
	     * del limite de tropas de una raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 11/01/2009
	     */
	    public function mejoraLimiteSoldados($idRaza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT m.nombre
						FROM mejora m 
							JOIN mejoraNormal n ON m.id=n.idMejora
							JOIN mejoraTipoMejoraGeneral t ON m.id=t.idMejora
						WHERE t.idTipoMejora=\''.MEJORALIMITETROPAS.'\' AND n.idRaza=\''.$idRaza.'\' LIMIT 1');
	
			list($nombre)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $nombre;
	        
	    }
	
	    /**
	     * Devuelve TRUE si todos los id
	     * de soldado son exploradores.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idSoldados
	     * @return mixed
	     * @since 24/06/2010
	     */
	    public function exploradores($idSoldados)
	    {
	        $sonExploradores = true;
	    	
	        $consulta = $this->db->query(
						'SELECT idTipoSoldado
						FROM soldado
						WHERE idUnidad IN (\''.implode('\',\'',$idSoldados).'\')');
	
	   		while($row=$consulta->fetch_row()){
	   			if($row[0]!=EXPLORACION){
	   				$sonExploradores=false;
	   				break;
	   			}
	   		}
	        
	        $consulta->close();
	
			return $sonExploradores;
	        
	    }
	
		/**
	     * Obtiene los fuegos rapidos de la unidad
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/01/2010
	     */
	    public function fuegoRapido()
	    {
	        
	        $consulta = $this->db->query(
						'(SELECT idAtaca AS idSubtipo, '.NAVE.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoSoldadoNave AS f 
						JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.SOLDADO.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoSoldadoSoldado AS f 
						JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.DEFENSA.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoSoldadoDefensa AS f 
						JOIN tipoDefensa AS t ON t.idTipoDefensa=f.idDefiende)');
	
	        $datos = Array();
	       
	    	while($row=$consulta->fetch_assoc()){
				$datos[array_shift($row)][]=$row;
			}
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	}
?>
