<?php
	/**
	 * Modelo que gestiona la información
	 * de naves
	 *
	 * @author David & Jose
	 * @package models
	 * @since 13/05/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de naves
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 13/05/2009
	 */
	class NaveModel
	    extends UnidadModel
	{
	    /**
	     * Representa la tabla de naves
	     *
	     * @access protected
	     * @since 01/06/2009
	     * @var String
	     */
	    protected $tabla = 'nave';
	
	    
	
	    /**
	     * Devuelve las naves disponibles en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function disponibles($idGalaxia, $idPlaneta)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT u.id, u.nombre, t.nombre AS tipoNave, n.idTipoNave, cantidadEnMision, cantidad, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo, n.carga, n.stargate, n.hiperespacio, n.velocidad, n.cazas
						FROM unidadJugadorPlaneta up 
							JOIN unidad u ON u.id=up.idUnidad
							JOIN nave n ON u.id=n.idUnidad
							JOIN tipoNave t ON n.idTipoNave=t.idTipoNave
						WHERE up.idGalaxia=\''.$idGalaxia.'\' 
							AND up.idPlaneta=\''.$idPlaneta.'\'');
	
			$datos=array();
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
	        //Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idTipoNave'] <= $b['idTipoNave'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve los atributos de una nave
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @return mixed
	     * @since 01/06/2009
	     */
	    public function atributos($unidades)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT n.idUnidad, t.idTipoNave AS idTipo, t.nombre AS tipo, n.carga, n.stargate, n.hiperespacio, n.velocidad, n.cazas
						FROM nave n 
							JOIN tipoNave t ON n.idTipoNave=t.idTipoNave 
						WHERE n.idUnidad IN (\''.implode('\',\'',$unidades).'\')');
	
	        $datos = Array();
	       
	    	for($i=0; $i<$consulta->num_rows; $i++){
	        	$row=$consulta->fetch_assoc();
	        	$datos[$row['idUnidad']]=$row;
			}
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Calcula el tiempo de mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer galaxiaOrigen
	     * @param  Integer planetaOrigen
	     * @param  Integer galaxiaDestino
	     * @param  Integer planetaDestino
	     * @param  Integer tipoMision
	     * @param  Integer unidades
	     * @param  Integer mejoraVelocidad
	     * @param  Integer porcentajeVelocidad
	     * @param  Boolean stargateIntergalactico
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function tiempoMision($galaxiaOrigen, $planetaOrigen, $galaxiaDestino, $planetaDestino, $tipoMision, $unidades, $mejoraVelocidad, $porcentajeVelocidad, $stargateIntergalactico)
	    {
	        
			//Sacamos el tiempo de la mision
			$consulta = $this->db->query(
					'SELECT tiempo
					FROM tipoMision
					WHERE id=\''.$tipoMision.'\' LIMIT 1');
	
			$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			$tiempoMision=$datos['tiempo'];
	
	        /*
	         * Obtenemos la velocidad de la nave mas lenta
	         */
	        $consulta = $this->db->query(
						'SELECT velocidad, stargate
						FROM nave
						WHERE idUnidad IN (\''.implode('\',\'',$unidades).'\')
						AND (hiperespacio=1 OR stargate=1)
						');
	
	        $velocidad=-1;
	        $stargate=true;
	
	       	for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Comprobamos si todas las naves viajan por el stargate
	        	if(!$datos[$i]['stargate'] && $stargate)
	        		$stargate=false;
	        		
	        	//Comprobamos la velocidad de la mas lenta que no sea 0 y no viaje por el stargate
	        	if(!$datos[$i]['stargate']){
		        	if($velocidad > intval($datos[$i]['velocidad']) && intval($datos[$i]['velocidad'])!=0){
		        		$velocidad=intval($datos[$i]['velocidad']);
		        	}
		        	elseif($velocidad == -1 ){
		        		$velocidad=$datos[$i]['velocidad'];
		        	}
				}
	       	}
	       	$consulta->close();
	       
	       	//Comprobamos si pueden realizarse viajes intergalacticos por stargate
	        if($galaxiaOrigen!=$galaxiaDestino && !$stargateIntergalactico){
	        	$stargate=false;
	        }
	        
	        //Si las naves viajan por el hiperespacio
	        if(!$stargate && $velocidad > 0){
	        	//Aplicamos las mejoras de velocidad
	        	$velocidad+=$velocidad*$mejoraVelocidad/100;
	        
		        //Obtenemos los datos de los planetas
		        $cuadranteOrigen=intval(($planetaOrigen-1)/$_ENV['config']->get('numPlanetas'));
		        $sectorOrigen=intval(($cuadranteOrigen-1)/$_ENV['config']->get('numCuadrantes'));
		        $cuadranteDestino=intval(($planetaDestino-1)/$_ENV['config']->get('numPlanetas'));
		        $sectorDestino=intval(($cuadranteDestino-1)/$_ENV['config']->get('numCuadrantes'));
		        
		        //Calculamos el tiempo
		        if($galaxiaDestino==$galaxiaOrigen){
		        	if($sectorOrigen==$sectorDestino){
		        		if($cuadranteOrigen==$cuadranteDestino){
		        			$distancia=$_ENV['config']->get('distanciaCuadrante');
		        		}
		        		else{
		        			$distancia=$_ENV['config']->get('distanciaSector')+$_ENV['config']->get('distanciaCuadrante');
		        		}
		        	}
		        	else{
		        		$distancia=$_ENV['config']->get('distanciaGalaxia')+$_ENV['config']->get('distanciaSector')+$_ENV['config']->get('distanciaCuadrante');
		        	}
		        }
		        else{
		        	$distancia=$_ENV['config']->get('distanciaInterGalactica')+$_ENV['config']->get('distanciaGalaxia')+$_ENV['config']->get('distanciaSector')+$_ENV['config']->get('distanciaCuadrante');
		        }
	
				//Si las naves viajan por hiperespacio sumamos el viaje y el tiempo de la mision
		        $tiempo=intval(($distancia/$velocidad)*60)+$tiempoMision;
	        }
	        else{//Si las naves viajan por el stargate el tiempo es el tiempo de la mision
	        	$tiempo=$tiempoMision;
	        }
	        
	        //Calculamos el porcentaje de tiempo al que se desea viajar
			return $tiempo/($porcentajeVelocidad/100);
	        
	    }
	
	    /**
	     * Dados unos id de naves devuelve
	     * TRUE si hay suficiente capacidad de
	     * cazas. FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idNaves
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 09/01/2009
	     */
	    public function capacidadCazas($idNaves, $cantidad)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idUnidad, idTipoNave, cazas, stargate, hiperespacio
						FROM nave
						WHERE idUnidad IN (\''.implode('\',\'',$idNaves).'\')');
	
	        $cazas = 0;
	        $capacidadCazas = 0;
	        $stargate = true;
	       
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos=$consulta->fetch_assoc();
	        	//Aumentamos el contador de capacidad de cazas
	        	$capacidadCazas+=$datos['cazas']*$cantidad[array_search($datos['idUnidad'],$idNaves)];
	        	//Aumentamos el contador de cazas si son cazas y no tienen hiperespacio
	        	if($datos['idTipoNave']==CAZA || $datos['idTipoNave']==CAZAPESADO && !$datos['hiperespacio'])
	        		$cazas+=$cantidad[array_search($datos['idUnidad'],$idNaves)];
	        	//Comprobamos que viaja por stargate
	        	if($stargate)
	        		$stargate=$datos['stargate'];
			}
	        
	        $consulta->close();
	        
			return $capacidadCazas>=$cazas || $stargate;
	        
	    }
	
	    /**
	     * Devuelve TRUE si todas las naves pasadas
	     * como parametro viajan por stargate. FALSE
	     * en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer galaxiaOrigen
	     * @param  Integer galaxiaDestino
	     * @param  Boolean stargateIntergalactico
	     * @param  Integer unidades
	     * @return mixed
	     * @since 28/06/2010
	     */
	    public function viajanStargate($galaxiaOrigen, $galaxiaDestino, $stargateIntergalactico, $unidades)
	    {
	        //Si existen unidades establezco que incialmente se puede 
	        //viajar por stargate, si no ya seguro qeu no se puede
			$stargate=(count($unidades)) ? true : false;
	    	
	    	if($stargate){
		    	//Obtenemos el stargate de las naves
		        $consulta = $this->db->query(
							'SELECT stargate
							FROM nave
							WHERE idUnidad IN (\''.implode('\',\'',$unidades).'\')');
		        
				while($row=$consulta->fetch_row()){
					//Solo con que una unidad no pueda viajar por stargate,
					//ninguna puede
					if($row[0]==0){
						$stargate=false;
						break;
					}
				}
	
				$consulta->close();
	    	}

			return $stargate;
	        
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
						FROM fuegoNaveNave AS f 
						JOIN tipoNave AS t ON t.idTipoNave=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.SOLDADO.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoNaveSoldado AS f 
						JOIN tipoSoldado AS t ON t.idTipoSoldado=f.idDefiende)
						UNION
						(SELECT idAtaca AS idSubtipo, '.DEFENSA.' AS tipo, t.nombre AS subtipo, porcentaje
						FROM fuegoNaveDefensa AS f 
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