<?php
	/**
	 * Gestiona los datos de las galaxias
	 *
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */
	
	
	
	/**
	 * Gestiona los datos de las galaxias
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */
	class GalaxiaModel
	    extends ModelBase
	{
	    /**
	     * Dada una galaxia, un sector y
	     * un cuadrante devuelve los planetas
	     * de ese cuadrante
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idSector
	     * @param  Integer idCuadrante
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function planetas($idGalaxia, $idSector, $idCuadrante, $idJugador)
	    {
	        
	        $consulta=false;
	        
	        $inicio=(($idSector-1)*$_ENV['config']->get('numCuadrantes')*$_ENV['config']->get('numPlanetas'))+(($idCuadrante-1)*$_ENV['config']->get('numPlanetas'))+1;
	        $fin=$inicio+$_ENV['config']->get('numPlanetas')-1;
	
	        $consulta=$this->db->query('
	        			SELECT p.idPlaneta,p.idGalaxia, pe.idPropietario, g.idRaza, r.nombre AS raza,
							p.nombrePlaneta, p.nombreSGC,p.riqueza, pes.imagen,
							a.id AS idAlianza, a.titulo AS alianza, u.nombre as propietario, pe.visible, pe.visible IS NOT NULL AS explorado,
							g.vacaciones IS NOT NULL AS vacaciones, COALESCE(TIMESTAMPDIFF(WEEK,NOW(),u.ultimoAcceso), 0) AS inactivo, pu.puntosTecnologias
						FROM planeta AS p 
							LEFT JOIN planetaExplorado AS pe ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia AND pe.idJugador=\''.$idJugador.'\'
							LEFT JOIN jugador AS g ON g.idUsuario=pe.idPropietario
							LEFT JOIN usuario AS u ON u.id=g.idUsuario
							LEFT JOIN alianza AS a ON a.id=g.idAlianza
							LEFT JOIN raza AS r ON g.idRaza=r.id
							LEFT JOIN jugadorInfoPuntuaciones AS pu ON pu.idJugador=pe.idPropietario
							LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
						WHERE p.idGalaxia=\''.$idGalaxia.'\' 
							AND p.idPlaneta BETWEEN \''.$inicio.'\' AND \''.$fin.'\'');
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	        	
	        	//Comprobamos si el planeta es propio
	        	$datos[$i]['propio']=$datos[$i]['idPropietario']==$idJugador;
	        	
	        	//Comprobamos si es debil
	        	$datos[$i]['debil']=$datos[$i]['puntosTecnologias'] < $_ENV['config']->get('puntuacionDebil');
	        }
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve una lista de las galaxias
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function galaxias()
	    {
	        
	        $consulta=false;
	        
	        $consulta=$this->db->query('SELECT id, nombre, nPlanetas
	        							FROM galaxia');
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve los datos de una galaxia
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @return mixed
	     * @since 17/06/2009
	     */
	    public function galaxia($idGalaxia)
	    {
	        
	        $consulta=false;
	        
	        $consulta=$this->db->query('SELECT id, nombre, nPlanetas
	        							FROM galaxia WHERE id=\''.$idGalaxia.'\' LIMIT 1');
	        
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Busca entre los planetas explorados de un usuario
	     * por su propietario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  String buscado
	     * @param  Integer idGalaxia
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscarPropietario($idJugador, $buscado, $idGalaxia = 0)
	    {
	    	$datos = Array();
	    	
	        //Obtenemos de los usuarios que coinciden con la busqueda
	        $consulta = $this->db->query(
	        				'SELECT u.id, u.nombre AS propietario, a.titulo AS alianza, a.id AS idAlianza
							FROM usuario AS u JOIN jugador AS j ON (u.id = j.idUsuario)
     							LEFT JOIN alianza AS a ON (j.idAlianza = a.id)
							WHERE UPPER(u.nombre) LIKE \'%'.strtoupper($buscado).'%\''
	       				);
	       
	       	$usuarios = Array();
	       	while($row=$consulta->fetch_assoc()){
	       		$usuarios[$row['id']]=$row;
	       	}
	       	
	       	$consulta->close();
	       	
	       	if(count($usuarios)){
	       	
		       	//Obtenemos los planetas de los usuarios
		       	$sql='SELECT idPlaneta, idGalaxia, idJugador
		       					FROM planetaColonizado 
		       					WHERE idJugador IN (\''.implode('\',\'', array_keys($usuarios)).'\')';
		       	
		       	if($idGalaxia!=0)
					$sql.=' AND idGalaxia=\''.$idGalaxia.'\' ';
					
		       	$consulta = $this->db->query($sql);
		       	
		       	$planetasBusqueda = '';
		       	while($row=$consulta->fetch_assoc()){
		       		//Construimos la cadena para la busqueda en SQL
		       		if(!empty($planetasBusqueda)){
		       			$planetasBusqueda .=' OR ';
		       		}
		       		
		       		$planetasBusqueda .='(idPlaneta='.$row['idPlaneta'].' AND idGalaxia='.$row['idGalaxia'].')';
		       	}
		       	
		       	$consulta->close();
		       				
		       	
				//Obtenemos la informacion de exploracion del planeta
				$consulta = $this->db->query(
								'SELECT idGalaxia, idPlaneta, idPropietario, visible, nota
	        					 FROM planetaExplorado
	        					WHERE ('.$planetasBusqueda.') AND idjugador=\''.$idJugador.'\'');
				
				$infoExploracion = Array();
				$planetasBusqueda ='';
				
				while($row = $consulta->fetch_assoc()){
					//Construimos la cadena para la busqueda en SQL
		       		if(!empty($planetasBusqueda)){
		       			$planetasBusqueda .=' OR ';
		       		}
		       		
		       		$planetasBusqueda .='(p.idPlaneta='.$row['idPlaneta'].' AND p.idGalaxia='.$row['idGalaxia'].')';
					
					$infoExploracion[$row['idGalaxia']][$row['idPlaneta']]=$row;
				}
				
				$consulta->close();
	       	
	       	
	       		if(!empty($planetasBusqueda)){
			
					//Obtenemos la informacion del planeta
					$consulta = $this->db->query(
									'SELECT p.idPlaneta,p.idGalaxia, g.nombre AS galaxia, p.nombrePlaneta,p.nombreSGC,
											p.riqueza, pes.imagen	
        							FROM planeta AS p JOIN galaxia AS g ON g.id=p.idGalaxia
             							 LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
        							WHERE ('.$planetasBusqueda.')'
								);

				
					for($i=0; $i<$consulta->num_rows; $i++){
						$row = $consulta->fetch_assoc();
						$datos[$i]=array_merge($row, 
											   $infoExploracion[$row['idGalaxia']][$row['idPlaneta']],
											   $usuarios[$infoExploracion[$row['idGalaxia']][$row['idPlaneta']]['idPropietario']]
									);

						//Imagen del planeta
			        	if(!$datos[$i]['imagen']){
			        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
			        	}
			        	
			        	//Comprobamos si el planeta es propio
			        	$datos[$i]['propio']=$datos[$i]['idPropietario']==$idJugador;		
						
						$datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
						$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
					}
	       		}
	       	}

	       	//Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = strtoupper($a['propietario']) >= strtoupper($b['propietario']) ? True : False; return $ret;});
						       
			return $datos;
	    }
	
	    /**
	     * Busca entre los planetas explorados de un usuario
	     * por su riqueza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer buscado
	     * @param  Integer idGalaxia
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscarRiqueza($idJugador, $buscado, $idGalaxia = 0)
	    {
	        $datos = Array();
	        
	    	//Obtenemos la informacion del planeta
	    	$sql = 'SELECT p.idPlaneta,p.idGalaxia, g.nombre AS galaxia, p.nombrePlaneta,p.nombreSGC,
									p.riqueza, pes.imagen, pe.idPropietario, pe.visible, pe.nota, u.nombre AS propietario, 
									a.titulo AS alianza, a.id AS idAlianza
        					FROM planetaExplorado AS pe 
        						LEFT JOIN planeta AS p ON p.idPlaneta=pe.idPlaneta AND p.idGalaxia=pe.idGalaxia
        						JOIN galaxia AS g ON g.id=p.idGalaxia
             					LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
             					LEFT JOIN usuario AS u ON (u.id = pe.idPropietario)
             					LEFT JOIN jugador AS j ON (u.id = j.idUsuario)
	     						LEFT JOIN alianza AS a ON (j.idAlianza = a.id)
        					WHERE p.riqueza=\''.$buscado.'\'
        					AND pe.idJugador=\''.$idJugador.'\'';
	    	//Limitamos a una sola galaxia si es necesario
			if($idGalaxia!=0)
				$sql.=' AND p.idGalaxia=\''.$idGalaxia.'\'';
				
			$consulta = $this->db->query($sql);

			$idPropietarios = Array();
			for($i=0; $i<$consulta->num_rows; $i++){
				$datos[$i] = $consulta->fetch_assoc();
				
				//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	        	
	        	//Comprobamos si el planeta es propio
	        	$datos[$i]['propio']=$datos[$i]['idPropietario']==$idJugador;		
				
				$datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
			}
	    	
	       	//Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idGalaxia'] >= $b['idGalaxia'] ? True : False; return $ret;});
						       
			return $datos;
	        
	    }
	
	    /**
	     * Busca entre los planetas explorados de un usuario
	     * por su nombre
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  String buscado
	     * @param  Integer idGalaxia
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscarNombre($idJugador, $buscado, $idGalaxia = 0)
	    {
	        
	        $consulta=false;
	        
	        $sql='SELECT p.idPlaneta,p.idGalaxia, g.nombre AS galaxia, p.nombrePlaneta,p.nombreSGC,
									p.riqueza, pes.imagen, pe.idPropietario, pe.visible, pe.nota, u.nombre AS propietario, 
									a.titulo AS alianza, a.id AS idAlianza
        					FROM planetaExplorado AS pe 
        						LEFT JOIN planeta AS p ON p.idPlaneta=pe.idPlaneta AND p.idGalaxia=pe.idGalaxia
        						JOIN galaxia AS g ON g.id=p.idGalaxia
             					LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
             					LEFT JOIN usuario AS u ON (u.id = pe.idPropietario)
             					LEFT JOIN jugador AS j ON (u.id = j.idUsuario)
	     						LEFT JOIN alianza AS a ON (j.idAlianza = a.id)
        					WHERE pe.idJugador=\''.$idJugador.'\' AND UPPER(p.nombrePlaneta) LIKE \'%'.strtoupper($buscado).'%\'';
	        //Limitamos a una sola galaxia si es necesario
			if($idGalaxia!=0)
				$sql.=' AND p.idGalaxia=\''.$idGalaxia.'\'';

	        $consulta=$this->db->query($sql);
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	        	
	        	//Comprobamos si el planeta es propio
	        	$datos[$i]['propio']=$datos[$i]['idPropietario']==$idJugador;		
				
				$datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
	        }
	        
	        $consulta->close();
	        
	        //Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idGalaxia'] >= $b['idGalaxia'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Busca entre los planetas explorados de un usuario
	     * por su nombre formato SGC
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  String buscado
	     * @param  Integer idGalaxia
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function buscarNombreSGC($idJugador, $buscado, $idGalaxia = 0)
	    {
	        
	        $consulta=false;
	        
	        $sql='SELECT p.idPlaneta,p.idGalaxia, g.nombre AS galaxia, p.nombrePlaneta,p.nombreSGC,
									p.riqueza, pes.imagen, pe.idPropietario, pe.visible, pe.nota, u.nombre AS propietario, 
									a.titulo AS alianza, a.id AS idAlianza
        					FROM planetaExplorado AS pe 
        						LEFT JOIN planeta AS p ON p.idPlaneta=pe.idPlaneta AND p.idGalaxia=pe.idGalaxia
        						JOIN galaxia AS g ON g.id=p.idGalaxia
             					LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
             					LEFT JOIN usuario AS u ON (u.id = pe.idPropietario)
             					LEFT JOIN jugador AS j ON (u.id = j.idUsuario)
	     						LEFT JOIN alianza AS a ON (j.idAlianza = a.id)
        					WHERE pe.idJugador=\''.$idJugador.'\' AND UPPER(p.nombreSGC) LIKE \'%'.strtoupper($buscado).'%\'';
	        //Limitamos a una sola galaxia si es necesario
			if($idGalaxia!=0)
				$sql.=' AND p.idGalaxia=\''.$idGalaxia.'\'';

	        $consulta=$this->db->query($sql);
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	        	
	        	//Comprobamos si el planeta es propio
	        	$datos[$i]['propio']=$datos[$i]['idPropietario']==$idJugador;		
				
				$datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
	        }
	        
	        $consulta->close();
	        
	        //Ordenamos por subtipo
	        usort($datos, function($a,$b){$ret = $a['idGalaxia'] >= $b['idGalaxia'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	}
?>