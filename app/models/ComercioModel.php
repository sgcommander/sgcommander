<?php
	/**
	 * Gestiona los datos de los comercios
	 *
	 * @author David & Jose
	 * @package models
	 * @since 13/02/2009
	 */
	
	
	
	/**
	 * Gestiona los datos de los comercios
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 13/02/2009
	 */
	class ComercioModel
	    extends ModelBase
	{
	    /**
	     * Envia un comercio a otro jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugadorOrig
	     * @param  Integer idJugadorDest
	     * @param  Integer cantidadO1
	     * @param  Integer cantidadO2
	     * @param  Integer cantidadD1
	     * @param  Integer cantidadD2
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function enviarComercio($idJugadorOrig, $idJugadorDest, $cantidadO1 = 0, $cantidadO2 = 0, $cantidadD1 = 0, $cantidadD2 = 0)
	    {
	        
	        $this->db->query('INSERT INTO comercio (idJugadorDest, idJugadorOrig)
	        								VALUES (\''.$idJugadorDest.'\', \''.$idJugadorOrig.'\')');
	        
	        //Capturamos el id
	        $idComercio=$this->db->insert_id;
	        
	        //Establezco las cantidades de envio, de ambos usuarios
	        if($cantidadO1!=0)
	        	$this->db->query('INSERT INTO comercioEnviaTipoRecurso (idComercio, idTipoRecurso, cantidad)
	        					VALUES (\''.$idComercio.'\',\'1\', \''.$cantidadO1.'\')');
	        if($cantidadO2!=0)
	        	$this->db->query('INSERT INTO comercioEnviaTipoRecurso (idComercio, idTipoRecurso, cantidad)
	        					VALUES (\''.$idComercio.'\',\'2\', \''.$cantidadO2.'\')');
	        if($cantidadD1!=0)
	        	$this->db->query('INSERT INTO comercioRecibeTipoRecurso (idComercio, idTipoRecurso, cantidad)
	        					VALUES (\''.$idComercio.'\',\'1\', \''.$cantidadD1.'\')');
	        if($cantidadD2!=0)
	        	$this->db->query('INSERT INTO comercioRecibeTipoRecurso (idComercio, idTipoRecurso, cantidad)
	        					VALUES (\''.$idComercio.'\',\'2\', \''.$cantidadD2.'\')');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Lista los comercios enviados por un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function comerciosEnviados($idJugador)
	    {
	        
	        $consulta = $this->db->query('SELECT c.id, idJugadorDest, u.nombre AS jugadorDest, 
	        								IFNULL(e1.cantidad,0) AS cantidadOfrecePri, IFNULL(e2.cantidad,0) AS cantidadOfreceSec,
	        								IFNULL(r1.cantidad,0) AS cantidadPidePri, IFNULL(r2.cantidad,0) AS cantidadPideSec
	        								FROM comercio c 
	        								JOIN usuario u ON c.idJugadorDest=u.id
	        								LEFT JOIN comercioEnviaTipoRecurso e1 ON e1.idComercio=c.id AND e1.idTipoRecurso=1
	        								LEFT JOIN comercioEnviaTipoRecurso e2 ON e2.idComercio=c.id AND e2.idTipoRecurso=2
	        								LEFT JOIN comercioRecibeTipoRecurso r1 ON r1.idComercio=c.id AND r1.idTipoRecurso=1
	        								LEFT JOIN comercioRecibeTipoRecurso r2 ON r2.idComercio=c.id AND r2.idTipoRecurso=2
	        								WHERE idJugadorOrig=\''.$idJugador.'\'');
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Lista los comercios recibidos por un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function comerciosRecibidos($idJugador)
	    {
	        
	        $consulta = $this->db->query('SELECT c.id, idJugadorOrig, u.nombre AS jugadorOrig, 
	        								IFNULL(e1.cantidad,0) AS cantidadOfrecePri, IFNULL(e2.cantidad,0) AS cantidadOfreceSec,
	        								IFNULL(r1.cantidad,0) AS cantidadPidePri, IFNULL(r2.cantidad,0) AS cantidadPideSec
	        								FROM comercio c 
	        								LEFT JOIN usuario u ON c.idJugadorOrig=u.id
	        								LEFT JOIN comercioEnviaTipoRecurso e1 ON e1.idComercio=c.id AND e1.idTipoRecurso=1
	        								LEFT JOIN comercioEnviaTipoRecurso e2 ON e2.idComercio=c.id AND e2.idTipoRecurso=2
	        								LEFT JOIN comercioRecibeTipoRecurso r1 ON r1.idComercio=c.id AND r1.idTipoRecurso=1
	        								LEFT JOIN comercioRecibeTipoRecurso r2 ON r2.idComercio=c.id AND r2.idTipoRecurso=2
	        								WHERE idJugadorDest=\''.$idJugador.'\'');
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Acepta un comercio
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idComercio
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function aceptarComercio($idComercio, $idJugador)
	    {
	        
	        $consulta = $this->db->query('SELECT idJugadorOrig, IFNULL(e1.cantidad,0) AS cantidadOfrecePri, IFNULL(e2.cantidad,0) AS cantidadOfreceSec,
	        								IFNULL(r1.cantidad,0) AS cantidadPidePri, IFNULL(r2.cantidad,0) AS cantidadPideSec
	        								FROM comercio c 
	        								LEFT JOIN comercioEnviaTipoRecurso e1 ON e1.idComercio=c.id AND e1.idTipoRecurso=1
	        								LEFT JOIN comercioEnviaTipoRecurso e2 ON e2.idComercio=c.id AND e2.idTipoRecurso=2
	        								LEFT JOIN comercioRecibeTipoRecurso r1 ON r1.idComercio=c.id AND r1.idTipoRecurso=1
	        								LEFT JOIN comercioRecibeTipoRecurso r2 ON r2.idComercio=c.id AND r2.idTipoRecurso=2
	        								WHERE c.id=\''.$idComercio.'\'
	        								AND c.idJugadorDest=\''.$idJugador.'\'
	        								LIMIT 1');
	        
	        //Si el comercio existe
	        if($consulta->num_rows==1){
	        	//Obtenemos los datos
	        	$datos=$consulta->fetch_assoc();
	        
	        	//Sacamos el usuario de origen
	        	$idJugadorOrig=$datos['idJugadorOrig'];
	 
	        	//Actualizamos los recursos
	        	$resultado=true;
	        	$resultado=$resultado && $this->db->query('UPDATE tipoRecursoUsuario
	        							SET cantidad=cantidad+(\''.($datos['cantidadPidePri']-$datos['cantidadOfrecePri']).'\') 
	        							WHERE idTipoRecurso=1
	        							AND idJugador=\''.$idJugadorOrig.'\'');
	        	$resultado=$resultado && $this->db->query('UPDATE tipoRecursoUsuario
	        							SET cantidad=cantidad+(\''.($datos['cantidadPideSec']-$datos['cantidadOfreceSec']).'\') 
	        							WHERE idTipoRecurso=2
	        							AND idJugador=\''.$idJugadorOrig.'\'');
	        
	        	$resultado=$resultado && $this->db->query('UPDATE tipoRecursoUsuario
	        							SET cantidad=cantidad+(\''.($datos['cantidadOfrecePri']-$datos['cantidadPidePri']).'\') 
	        							WHERE idTipoRecurso=1
	        							AND idJugador=\''.$idJugador.'\'');
	        	$resultado=$resultado && $this->db->query('UPDATE tipoRecursoUsuario
	        							SET cantidad=cantidad+(\''.($datos['cantidadOfreceSec']-$datos['cantidadPideSec']).'\') 
	        							WHERE idTipoRecurso=2
	        							AND idJugador=\''.$idJugador.'\'');
	        
	        	$this->borrarComercio($idComercio, $idJugador);
	        	
	        	return $this->db->errno==0;
	        }
	        else{
	        	return false;
	        }	        
	    }
	
	    /**
	     * Elimina un comercio
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idComercio
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function borrarComercio($idComercio, $idJugador)
	    {
	        
	        $this->db->query(
	        			'DELETE FROM comercio
	        			 WHERE id=\''.$idComercio.'\' 
	        			 AND (idJugadorDest=\''.$idJugador.'\' OR idJugadorOrig=\''.$idJugador.'\')');
	        
			return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Elimina los comercios que superen las 24 horas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 13/02/2009
	     */
	    public function filtrarComercios()
	    {
	        
	        $this->db->query(
	        			'DELETE FROM comercio
	        			 WHERE DATEDIFF(NOW(), fechaPeticion)>=1');
	
			return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve un array indexado por idJugador
	     * con TRUE si el comercio es posible y FALSE
	     * en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 11/07/2010
	     */
	    public function comercioPosible($idRaza, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idUsuario, idRaza
						FROM jugador
						WHERE idUsuario IN (\''.implode('\',\'',$idJugador).'\')');
	
	        $datos = Array();
	        
			for($i=0; $i<count($idJugador); $i++){
				$res=$consulta->fetch_assoc();
				//Comprobamos la raza
				$posible=false;
				switch($idRaza){
					case 1:
						if($res['idRaza']==4 || $res['idRaza']==5 || $res['idRaza']==1)
							$posible=true;
						break;
					case 2:
						if($res['idRaza']==6 || $res['idRaza']==8 || $res['idRaza']==2)
							$posible=true;
						break;
					case 3:
						if($res['idRaza']==3)
							$posible=true;
						break;
					case 4:
						if($res['idRaza']==4 || $res['idRaza']==5 || $res['idRaza']==1)
							$posible=true;
						break;
					case 5:
						if($res['idRaza']==4 || $res['idRaza']==5 || $res['idRaza']==1)
							$posible=true;
						break;
					case 6:
						if($res['idRaza']==6 || $res['idRaza']==8 || $res['idRaza']==2)
							$posible=true;
						break;
					case 7:
						if($res['idRaza']==7)
							$posible=true;
						break;
					case 8:
						if($res['idRaza']==6 || $res['idRaza']==8 || $res['idRaza']==2)
							$posible=true;
						break;
				}
	        	$datos[$res['idUsuario']]=$posible;
			}
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve los datos del comercio pasado
	     * como parametro.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idComercio
	     * @return mixed
	     * @since 11/07/2010
	     */
	    public function comercio($idComercio)
	    {
	        
	        $consulta = $this->db->query('SELECT c.id, idJugadorOrig, u.nombre AS jugadorOrig, 
	        								IFNULL(e1.cantidad,0) AS cantidadOfrecePri, IFNULL(e2.cantidad,0) AS cantidadOfreceSec,
	        								IFNULL(r1.cantidad,0) AS cantidadPidePri, IFNULL(r2.cantidad,0) AS cantidadPideSec
	        								FROM comercio c 
	        								LEFT JOIN usuario u ON c.idJugadorOrig=u.id
	        								LEFT JOIN comercioEnviaTipoRecurso e1 ON e1.idComercio=c.id AND e1.idTipoRecurso=1
	        								LEFT JOIN comercioEnviaTipoRecurso e2 ON e2.idComercio=c.id AND e2.idTipoRecurso=2
	        								LEFT JOIN comercioRecibeTipoRecurso r1 ON r1.idComercio=c.id AND r1.idTipoRecurso=1
	        								LEFT JOIN comercioRecibeTipoRecurso r2 ON r2.idComercio=c.id AND r2.idTipoRecurso=2
	        								WHERE c.id=\''.$idComercio.'\'');
	        
	        if($consulta->num_rows>0)
	        	$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>