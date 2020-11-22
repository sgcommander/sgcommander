<?php
	/**
	 * Modelo que gestiona la información
	 * de planetas de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 27/01/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de planetas de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 27/01/2009
	 */
	class PlanetaModel
	    extends ModelBase
	{
	    /**
	     * Devuelve la información de un planeta
	     * dado su idGalaxia y su idPlaneta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function planeta($idGalaxia, $idPlaneta, $idJugador, $idAlianza)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT p.idPlaneta,p.idGalaxia,pe.idPropietario,
							p.nombrePlaneta,p.nombreSGC,p.riqueza, pes.imagen,
							pe.visible, pe.nota, IFNULL(a.id,-1) AS idAlianza, a.titulo AS alianza, u.nombre as propietario,
							p.coord1,p.coord2,p.coord3,p.coord4,p.coord5,p.coord6,p.coord7,
							pe.idPlaneta IS NOT NULL  AS explorado,
							COALESCE(pc.principal,0) AS principal
						FROM planeta AS p 
							LEFT JOIN planetaExplorado AS pe ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia AND pe.idJugador=\''.$idJugador.'\'
							LEFT JOIN jugador AS g ON g.idUsuario=pe.idPropietario
							LEFT JOIN usuario AS u ON u.id=g.idUsuario
							LEFT JOIN alianza AS a ON a.id=g.idAlianza
							LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
							LEFT JOIN planetaColonizado pc ON p.idPlaneta=pc.idPlaneta AND p.idGalaxia=pc.idGalaxia
						WHERE p.idGalaxia=\''.$idGalaxia.'\'
							AND p.idPlaneta=\''.$idPlaneta.'\'
						LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	    	//Imagen del planeta
        	if(!$datos['imagen']){
        		$datos['imagen']=$datos['idGalaxia'].'_'.$datos['riqueza'].'.jpg';
        	}

        	//Posicion del planeta
	        $datos['idSector']=Funciones::calcularSector($datos['idPlaneta']);
			$datos['idCuadrante']= Funciones::calcularCuadrante($datos['idPlaneta']);
			
			//Datos sobre la propiedad del planeta
	        $datos['propio']=$datos['idPropietario']==$idJugador;
	        $datos['neutral']=empty($datos['idPropietario']);
	        $datos['aliado']=(!$datos['propio'] && $datos['idAlianza']==$idAlianza);
	        $datos['enemigo']=(!$datos['propio'] && ($datos['idAlianza']!=$idAlianza || (!$datos['neutral'] && $datos['idAlianza']!=null)));

	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Dado un idUsuario devuelve los planetas
	     * bajo su control
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function planetasUsuario($idUsuario)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT p.idPlaneta,p.idGalaxia,pc.idJugador,
						pc.principal,p.nombrePlaneta,p.nombreSGC,
						p.coord1,p.coord2,p.coord3,p.coord4,p.coord5,p.coord6,p.coord7,
						p.riqueza, pe.imagen, pex.visible, pex.nota
						FROM planetaColonizado AS pc 
							JOIN planeta AS p ON pc.idPlaneta=p.idPlaneta AND pc.idGalaxia=p.idGalaxia
							LEFT JOIN planetaEspecial pe ON p.idPlaneta=pe.idPlanetaEsp AND p.idGalaxia=pe.idGalaxia
							JOIN planetaExplorado pex ON pc.idPlaneta=pex.idPlaneta AND pc.idGalaxia=pex.idGalaxia AND pex.idJugador=pc.idJugador
						WHERE pc.idJugador=\''.$idUsuario.'\'');
	
	        $datos=Array();
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	
	        	//Posicion del planeta
		        $datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
			}
	        
	        $consulta->close();
	        
	        usort($datos, function($a,$b){$ret = $a['principal'] <= $b['principal'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Dado un idUsuario devuelve la
	     * lista personalizada de planetas
	     * explorados de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function tuLista($idUsuario, $inicio, $cantidad = null)
	    {
	        
	        //Realizamos la consulta
			$sql='SELECT p.idPlaneta,p.idGalaxia,pe.idPropietario,
						p.nombrePlaneta,p.nombreSGC,p.riqueza, pes.imagen,
						pe.visible, pe.nota, IFNULL(a.id,-1) AS idAlianza, a.titulo AS alianza, u.nombre as propietario
					FROM planetaExplorado AS pe 
						JOIN planeta AS p ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia
						LEFT JOIN jugador AS g ON g.idUsuario=pe.idPropietario
						LEFT JOIN usuario AS u ON u.id=g.idUsuario
						LEFT JOIN alianza AS a ON a.id=g.idAlianza
						LEFT JOIN planetaEspecial pes ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
					WHERE pe.idJugador=\''.$idUsuario.'\' 
						AND pe.visible=1 
					ORDER BY propietario, p.idGalaxia, p.idPlaneta
					LIMIT '.$inicio.','.$cantidad;
	
			$consulta = $this->db->query($sql);
	
			$datos=Array();
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	
	        	//Posicion del planeta
		        $datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
			}
	        
	        $consulta->close();
	        
			return $datos;
	    }
	
	    /**
	     * Devuelve los planetas aliados explorados
	     * por un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function planetasAliados($idUsuario, $inicio, $cantidad)
	    {
	    	//TODO optimizar pasando el idAlianza
	    	$datos = array();
	    	$idUsuarios = array();
	    	
	    	$consulta = $this->db->query(
	    				'SELECT ju.idUsuario 
							FROM jugador AS j 
							JOIN jugador AS ju ON j.idAlianza=ju.idAlianza 
						WHERE j.idUsuario=\''.$idUsuario.'\' 
						AND ju.idUsuario!=\''.$idUsuario.'\'');
	    	
	    	while($row=$consulta->fetch_row()){
	    		$idUsuarios[]=$row[0];
	    	}
	    	
	    	$consulta->close();
	        
	    	if(count($idUsuarios)){
		        $consulta = $this->db->query(
							'SELECT p.idPlaneta,p.idGalaxia,pe.idJugador, p.riqueza,
								pe.idPropietario,p.nombrePlaneta,p.nombreSGC, px.imagen,
								pe.nota, pe.visible, a.id AS idAlianza, a.titulo AS alianza, u.nombre AS propietario
							FROM planetaExplorado AS pe 
								JOIN planeta AS p ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia
								JOIN jugador AS g ON g.idUsuario=pe.idPropietario
								JOIN usuario AS u ON u.id=g.idUsuario
								LEFT JOIN alianza AS a ON a.id=g.idAlianza
								LEFT JOIN planetaEspecial AS px ON p.idPlaneta=px.idPlanetaEsp AND p.idGalaxia=px.idGalaxia
							WHERE pe.idPropietario IN 
								(\''.implode('\',\'',$idUsuarios).'\') 
								AND pe.idJugador=\''.$idUsuario.'\'
							ORDER BY propietario, p.idGalaxia, p.idPlaneta
							LIMIT '.$inicio.','.$cantidad);
		
				for($i=0; $i<$consulta->num_rows; $i++){
		        	$datos[$i]=$consulta->fetch_assoc();
		        	
		        	//Imagen del planeta
		        	if(!$datos[$i]['imagen']){
		        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
		        	}
		
		        	//Posicion del planeta
			        $datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
					$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
				}
		        
		        $consulta->close();
	    	}
	        
			return $datos; 
	    }
	
	    /**
	     * Devuelve los planetas enemigos 
	     * explorados por un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function planetasEnemigos($idUsuario, $inicio, $cantidad)
	    {
	    	//TODO optimizar pasando el idAlianza
	    	$datos = array();
	    	$idUsuarios = array();
	    	
	    	$consulta = $this->db->query(
	    				'SELECT ju.idUsuario 
							FROM jugador AS j 
							JOIN jugador AS ju ON j.idAlianza=ju.idAlianza 
						WHERE j.idUsuario=\''.$idUsuario.'\'
						AND ju.idUsuario!=\''.$idUsuario.'\'');
	    	
	    	while($row=$consulta->fetch_row()){
	    		$idUsuarios[]=$row[0];
	    	}
	    	$idUsuarios[]=$idUsuario;
	    	
	    	$consulta->close();
	        
	        $consulta = $this->db->query(
						'SELECT p.idPlaneta,p.idGalaxia,pe.idJugador,
							pe.idPropietario,p.nombrePlaneta,p.nombreSGC, p.riqueza, px.imagen,
							pe.nota, pe.visible, a.id AS idAlianza, a.titulo AS alianza, u.nombre AS propietario
						FROM planetaExplorado AS pe 
							JOIN planeta AS p ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia
							JOIN jugador AS g ON g.idUsuario=pe.idPropietario
							JOIN usuario AS u ON u.id=g.idUsuario
							LEFT JOIN alianza AS a ON a.id=g.idAlianza
							LEFT JOIN planetaEspecial AS px ON p.idPlaneta=px.idPlanetaEsp AND p.idGalaxia=px.idGalaxia
						WHERE pe.idPropietario NOT IN 
							(\''.implode('\',\'',$idUsuarios).'\') 
							AND pe.idJugador=\''.$idUsuario.'\'
						ORDER BY propietario, p.idGalaxia, p.idPlaneta
						LIMIT '.$inicio.','.$cantidad);
	
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	
	        	//Posicion del planeta
		        $datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
			}
	        
	        $consulta->close();
	        
			return $datos;
	    }
	
	    /**
	     * Devuelve los planetas neutrales
	     * explorados por un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function planetasNeutrales($idUsuario, $inicio, $cantidad)
	    {
	        //TODO optimizar pasando el idAlianza
	    	$datos = array();

	        $consulta = $this->db->query(
						'SELECT p.idPlaneta,p.idGalaxia,pe.idJugador, p.riqueza,p.nombrePlaneta,
							p.nombreSGC, px.imagen, pe.nota, pe.visible
						FROM planetaExplorado AS pe 
							JOIN planeta AS p ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia
							LEFT JOIN planetaEspecial AS px ON p.idPlaneta=px.idPlanetaEsp AND p.idGalaxia=px.idGalaxia
						WHERE pe.idPropietario IS NULL
							AND pe.idJugador=\''.$idUsuario.'\'
						ORDER BY p.idGalaxia, p.idPlaneta
						LIMIT '.$inicio.','.$cantidad);
	
	    	$datos=Array();
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Imagen del planeta
	        	if(!$datos[$i]['imagen']){
	        		$datos[$i]['imagen']=$datos[$i]['idGalaxia'].'_'.$datos[$i]['riqueza'].'.jpg';
	        	}
	
	        	//Posicion del planeta
		        $datos[$i]['idSector']=Funciones::calcularSector($datos[$i]['idPlaneta']);
				$datos[$i]['idCuadrante']= Funciones::calcularCuadrante($datos[$i]['idPlaneta']);
			}
	        
	        $consulta->close();
	        
			return $datos; 
	    }
	
	    /**
	     * Cambia el nombre del planeta
	     * por el nombre pasado como
	     * parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  String nombre
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function cambiarNombre($idGalaxia, $idPlaneta, $nombre)
	    {
	        
	    	$this->db->query(
						'UPDATE planeta SET nombrePlaneta=\''.$nombre.'\'
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'');
	
			return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Dado un planeta y un usuario
	     * elimina el planeta de Tu lista
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idUsuario
	     * @since 27/01/2009
	     */
	    public function eliminar($idGalaxia, $idPlaneta, $idUsuario)
	    {
	        
	        $this->db->query(
						'UPDATE planetaExplorado SET visible=0
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idUsuario.'\'');
	
			return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Dado un planeta y un usuario
	     * anade el planeta a Tu lista
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idUsuario
	     * @since 27/01/2009
	     */
	    public function anadir($idGalaxia, $idPlaneta, $idUsuario)
	    {
	        
	        $this->db->query(
						'UPDATE planetaExplorado SET visible=1
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idUsuario.'\'');
	        
			return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Abandona un planeta que estaba
	     * colonizado
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 27/01/2009
	     */
	    public function abandonar($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
	        $this->db->query(
						'DELETE FROM planetaColonizado
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idJugador.'\'
							AND principal <> 1');
			
			$this->db->query(
						'UPDATE planeta SET nombrePlaneta=\'\'
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND (idGalaxia,idPlaneta) NOT IN (
							SELECT idGalaxia, idPlanetaEsp 
							FROM planetaEspecial)');
	        
			return $this->db->errno==0; 
	    }
	
	    /**
	     * Cambia la nota de un planeta
	     * explorado de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idUsuario
	     * @param  String nota
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function cambiarNota($idGalaxia, $idPlaneta, $idUsuario, $nota)
	    {
	        
	        $this->db->query(
						'UPDATE planetaexplorado SET nota=\''.$nota.'\'
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idUsuario.'\'');
	        
			return $this->db->errno==0;
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado 
	     * como parametro pertence al usuario, 
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function planetaPropio($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM planetaColonizado
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idJugador.'\' 
						LIMIT 1');
	
			list($propio)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $propio!=0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado 
	     * como parametro a sido explorado por 
	     * el usuario, FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 18/11/2009
	     */
	    public function planetaExplorado($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
			$consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM planetaExplorado
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idJugador.'\' 
						LIMIT 1');
	
			list($explorado)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $explorado>0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado 
	     * como parametro es enemigo del usuario, 
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 18/11/2009
	     */
	    public function planetaEnemigo($idGalaxia, $idPlaneta, $idJugador, $idAlianza)
	    {
	        
			$consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM planetaColonizado p 
							JOIN jugador j ON p.idJugador=j.idUsuario
						WHERE p.idGalaxia=\''.$idGalaxia.'\'
							AND p.idPlaneta=\''.$idPlaneta.'\'
							AND p.idJugador!=\''.$idJugador.'\'
							AND IFNULL(j.idAlianza,-1)!=\''.$idAlianza.'\' 
						LIMIT 1');
	
			list($enemigo)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $enemigo!=0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado 
	     * como parametro no tiene usuario
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 18/11/2009
	     */
	    public function planetaNeutral($idGalaxia, $idPlaneta)
	    {
	        
			$consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM planetaColonizado
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\' 
						LIMIT 1');
	
			list($neutral)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $neutral==0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado 
	     * como parametro es aliado del usuario, 
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 18/11/2009
	     */
	    public function planetaAliado($idGalaxia, $idPlaneta, $idJugador, $idAlianza)
	    {
	        
			$consulta = $this->db->query(
						'SELECT COUNT(*)
						FROM planetaColonizado p 
							JOIN jugador j ON p.idJugador=j.idUsuario
						WHERE p.idGalaxia=\''.$idGalaxia.'\'
							AND p.idPlaneta=\''.$idPlaneta.'\'
							AND p.idJugador!=\''.$idJugador.'\'
							AND IFNULL(j.idAlianza,-1)=\''.$idAlianza.'\' 
						LIMIT 1');
	
			list($aliado)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $aliado!=0;
	        
	    }
	
	    /**
	     * Devuelve el numero de planetas
	     * en tu lista
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numPlanetasTuLista($idJugador)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT count(*)
						FROM planetaExplorado
						WHERE idJugador=\''.$idJugador.'\'  
							AND visible=1 
						LIMIT 1');
	
	        list($numPlanetas)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numPlanetas;
	        
	    }
	
	    /**
	     * Devuelve el numero de planetas
	     * enemigos explorados
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numPlanetasEnemigos($idJugador)
	    {
	        $numPlanetasEnemigos=0;
	        $idUsuarios = array();
	    	
	    	$consulta = $this->db->query(
	    				'SELECT ju.idUsuario 
							FROM jugador AS j 
							JOIN jugador AS ju ON j.idAlianza=ju.idAlianza 
						WHERE j.idUsuario=\''.$idJugador.'\'
						AND ju.idUsuario!=\''.$idJugador.'\'');

	    	while($row=$consulta->fetch_row()){
	    		$idUsuarios[]=$row[0];
	    	}
	    	$idUsuarios[]=$idJugador;
	    	
	    	$consulta->close();
	        
	        $consulta = $this->db->query(
						'SELECT COUNT(*)
						FROM planetaExplorado AS pe
						WHERE pe.idPropietario NOT IN 
							(\''.implode('\',\'',$idUsuarios).'\') 
							AND pe.idJugador=\''.$idJugador.'\'
							AND pe.idPropietario IS NOT NULL');

	        list($numPlanetasEnemigos)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numPlanetasEnemigos;
	    }
	
	    /**
	     * Devuelve el numero de planetas
	     * explorados aliados
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numPlanetasAliados($idJugador)
	    {
	        $numPlanetasAliados=0;
	        $idUsuarios = array();
	    	
	    	$consulta = $this->db->query(
	    				'SELECT ju.idUsuario 
							FROM jugador AS j 
							JOIN jugador AS ju ON j.idAlianza=ju.idAlianza 
						WHERE j.idUsuario=\''.$idJugador.'\'');
	    	
	    	while($row=$consulta->fetch_row()){
	    		$idUsuarios[]=$row[0];
	    	}
	    	
	    	$consulta->close();
	        
	    	if(count($idUsuarios)){
		        $consulta = $this->db->query(
							'SELECT COUNT(*)
							FROM planetaExplorado AS pe
							WHERE pe.idPropietario IN 
								(\''.implode('\',\'',$idUsuarios).'\') 
								AND pe.idJugador=\''.$idJugador.'\'
								AND pe.idPropietario IS NOT NULL');
		        
		        list($numPlanetasAliados)=$consulta->fetch_row();
		        
		        $consulta->close();
	    	}
	        
			return $numPlanetasAliados;
	    }
	
	    /**
	     * Devuelve el numero de planetas
	     * explorados neutrales
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numPlanetasNeutrales($idJugador)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT count(*)
						FROM planetaExplorado
						WHERE idPropietario IS NULL 
							AND idJugador=\''.$idJugador.'\' 
						LIMIT 1');
	
	        list($numPlanetasNeutrales)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numPlanetasNeutrales;
	        
	    }
	
	    /**
	     * Devuelve el numero de planetas
	     * colonizados
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numPlanetasUsuario($idJugador)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT count(*)
						FROM planetaColonizado
						WHERE idJugador=\''.$idJugador.'\' 
						LIMIT 1');
	
	        list($numPlanetas)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numPlanetas;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el jugador esta construyendo 
	     * alguna unidad en el planeta. FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/03/2010
	     */
	    public function construyendo($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT COUNT(*)
						FROM unidadConstruir
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idJugador.'\'');
	
			list($construyendo)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $construyendo!=0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si hay alguna unidad del jugador
	     * en el planeta. FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/03/2010
	     */
	    public function hayUnidades($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
	        //Comprobamos si hay unidades en el planeta o saliendo de el
	    	$consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM unidadJugadorPlaneta
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idJugador=\''.$idJugador.'\'');
	
			list($cantUnidades)=$consulta->fetch_row();
	
			$consulta->close();
	
			//Comprobamos si hay unidades que van hacia el planeta
			$consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM mision
						WHERE idGalaxiaDestino=\''.$idGalaxia.'\'
							AND idPlanetaDestino=\''.$idPlaneta.'\'
							AND (idTipoMision=\''.DESPLEGAR.'\' OR idTipoMision=\''.CONTRATACAR.'\')
							AND vuelta=0
							AND idJugador=\''.$idJugador.'\'');
	
			list($cantMisiones)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $cantUnidades!=0 || $cantMisiones!=0;
	        
	    }
	    
		/**
	     * Devuelve el id de la tropa exploradora o false si no hay tropas exploradoras en el planeta
	     * en el planeta. FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/03/2010
	     */
	    public function hayExplorador($idGalaxia, $idPlaneta, $idJugador)
	    {
	        
	        //Comprobamos si hay unidades en el planeta o saliendo de el
	    	$consulta = $this->db->query(
						'SELECT u.idUnidad
						FROM unidadJugadorPlaneta AS u LEFT JOIN soldado AS s ON s.idUnidad=u.idUnidad
						WHERE u.idGalaxia=\''.$idGalaxia.'\'
							AND u.idPlaneta=\''.$idPlaneta.'\'
							AND u.idJugador=\''.$idJugador.'\'
							AND s.idTipoSoldado=\''.EXPLORACION.'\'
							AND u.cantidad > u.cantidadEnMision 
						LIMIT 1');
	
			list($idUnidad)=$consulta->fetch_row();
	
			$consulta->close();

			return $idUnidad;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta es especial. 
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 08/04/2010
	     */
	    public function planetaEspecial($idGalaxia, $idPlaneta)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT 1
						FROM planetaEspecial
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlanetaEsp=\''.$idPlaneta.'\'
						LIMIT 1');
	
			list($esEspecial)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $esEspecial;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta e sun planeta principal.
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 22/07/2010
	     */
	    public function planetaPrincipal($idGalaxia, $idPlaneta)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT COUNT(*) 
						FROM planetaColonizado
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND principal=1 
						LIMIT 1');
	
			list($esPrincipal)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $esPrincipal;
	        
	    }
	
		/**
	     * Devuelve el numero de soldado de un usuario en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numSoldados($idJugador,$idGalaxia, $idPlaneta)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT IFNULL(sum(p.cantidad-p.cantidadEnMision),0)
						FROM unidadJugadorPlaneta AS p
							JOIN soldado AS s ON p.idUnidad=s.idUnidad
						WHERE idJugador=\''.$idJugador.'\'
							AND idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\' 
						LIMIT 1');
	
	        list($numSoldados)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numSoldados;
	        
	    }
	    
		/**
	     * Devuelve el numero de naves de un usuario en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numNaves($idJugador,$idGalaxia, $idPlaneta)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT IFNULL(sum(p.cantidad-p.cantidadEnMision),0)
						FROM unidadJugadorPlaneta AS p
							JOIN nave AS s ON p.idUnidad=s.idUnidad
						WHERE idJugador=\''.$idJugador.'\'
							AND idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\' 
						LIMIT 1');
	
	        list($numNaves)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numNaves;
	        
	    }
	    
		/**
	     * Devuelve el numero de naves de un usuario en un planeta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numDefensas($idJugador,$idGalaxia, $idPlaneta)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT IFNULL(sum(p.cantidad-p.cantidadEnMision),0)
						FROM unidadJugadorPlaneta AS p
							JOIN defensa AS s ON p.idUnidad=s.idUnidad
						WHERE idJugador=\''.$idJugador.'\'
							AND idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\' 
						LIMIT 1');
	
	        list($numDefensas)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numDefensas;
	        
	    }
	}
?>
