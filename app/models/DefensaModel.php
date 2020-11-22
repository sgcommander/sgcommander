<?php
	/**
	 * Modelo que gestiona la información
	 * de defensas
	 *
	 * @author David & Jose
	 * @package models
	 * @since 12/06/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de defensas
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 12/06/2009
	 */
	class DefensaModel
	    extends UnidadModel
	{
		/**
	     * Representa la tabla de defensas
	     *
	     * @access protected
	     * @since 12/06/2009
	     * @var String
	     */
	    protected $tabla = 'defensa';
		
	    /**
	     * Devuelve los atributos de una defensa
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
						'SELECT d.idUnidad, t.idTipoDefensa AS idTipo, t.nombre AS tipo, d.autodestruye
						FROM defensa d 
							JOIN tipoDefensa t ON d.idTipoDefensa=t.idTipoDefensa
						WHERE d.idUnidad IN (\''.implode('\',\'',$unidades).'\')');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$row=$consulta->fetch_assoc();
	        	$datos[$row['idUnidad']]=$row;
			}
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve las defensas disponibles en un planeta
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
						'SELECT u.id, u.nombre, t.nombre AS tipoDefensa, d.idTipoDefensa, cantidadEnMision, cantidad, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo, d.autodestruye, d.tiempoMover
						FROM unidadJugadorPlaneta up 
							JOIN unidad u ON u.id=up.idUnidad 
							JOIN defensa d ON u.id=d.idUnidad
							JOIN tipoDefensa t ON d.idTipoDefensa=t.idTipoDefensa
						WHERE up.idGalaxia=\''.$idGalaxia.'\' 
							AND up.idPlaneta=\''.$idPlaneta.'\'');
	
			$datos=array();
	
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
	        //Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idTipoDefensa'] <= $b['idTipoDefensa'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Calcula el tiempo de mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @param  Integer porcentajeVelocidad
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function tiempoMision($unidades, $porcentajeVelocidad)
	    {
	        
	        //Obtenemos la velocidad de la defensa mas lenta
	        $consulta = $this->db->query(
						'SELECT tiempoMover
						FROM defensa
						WHERE idUnidad IN (\''.implode('\',\'',$unidades).'\')');
	
	        $tiempoMover=null;
	
	       	for($i=0; $i<$consulta->num_rows; $i++){
	        	list($tiempo)=$consulta->fetch_row();
	        	//Comprobamos la velocidad de la mas lenta
	        	if($tiempoMover==null || $tiempoMover<$tiempo)
	        		$tiempoMover=$tiempo;
	       	}
	       
	        $consulta->close();
	        
	        $tiempo=$tiempoMover;
	        
	        //Calculamos el porcentaje de tiempo al que se desea viajar
			return $tiempo/($porcentajeVelocidad/100);
	        
	    }
	
	    /**
	     * Devuelve TRUE si todas las defensas
	     * pasadas como parametro pueden
	     * realizar misiones.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idDefensas
	     * @return mixed
	     * @since 27/06/2010
	     */
	    public function moviles($idDefensas)
	    {
	        
	        //Obtenemos la velocidad de la defensa mas lenta
	        $consulta = $this->db->query(
						'SELECT tiempoMover
						FROM defensa
						WHERE idUnidad IN (\''.implode('\',\'',$idDefensas).'\')');
	
	        $moviles=true;
	
	       	for($i=0; $i<$consulta->num_rows && $moviles; $i++){
	        	list($tiempo)=$consulta->fetch_row();
	        	//Comprobamos si se puede mover
	        	if($tiempo==null || $tiempo==0)
	        		$moviles=false;
	       	}
	       
	        $consulta->close();
	        
	        return $moviles;
	        
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
						FROM fuegoDefensaNave AS f 
						JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.SOLDADO.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoDefensaSoldado AS f 
						JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.DEFENSA.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoDefensaDefensa AS f 
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