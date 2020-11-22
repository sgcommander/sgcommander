<?php
	/**
	 * Modelo que gestiona la informaci�n
	 * de misiones de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 01/10/2009
	 */
	
	
	
	/**
	 * Liberrias necesarias
	 */
	require_once('../libs/Mision/Mision.php');
	
	/**
	 * Modelo que gestiona la informacion
	 * de misiones de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 01/10/2009
	 */
	class MisionModel
	    extends ModelBase
	{
	    /**
	     * Lista las misiones de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 01/10/2009
	     */
	    public function misionesPropias($idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT m.id, m.idTipoMision, m.idGalaxiaOrigen, m.idGalaxiaDestino,
							m.idPlanetaOrigen, m.idPlanetaDestino, 
							TIMESTAMPDIFF(SECOND,NOW(),FROM_UNIXTIME(UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto)) AS tiempo,
							m.vuelta, m.nuevaMision, t.nombre AS tipoMision, UNIX_TIMESTAMP(m.fechaSalida) AS fechaSalida,
							po.nombrePlaneta AS planetaOrigenNombre, po.nombreSGC AS planetaOrigenSGC,
							pd.nombrePlaneta AS planetaDestinoNombre, pd.nombreSGC AS planetasDestinoSGC,
							pex.idPlaneta IS NOT NULL AS destinoExplorado, FALSE AS invisible,
							po.idGalaxia AS idGalaxiaOrigen, pd.idGalaxia AS idGalaxiaDestino
						FROM mision m JOIN tipoMision t ON m.idTipoMision=t.id
							JOIN planeta po ON po.idPlaneta=m.idPlanetaOrigen AND po.idGalaxia=m.idGalaxiaOrigen
							JOIN planeta pd ON pd.idPlaneta=m.idPlanetaDestino AND pd.idGalaxia=m.idGalaxiaDestino
							LEFT JOIN planetaExplorado pex ON pd.idPlaneta=pex.idPlaneta AND pd.idGalaxia=pex.idGalaxia AND pex.idJugador=m.idJugador
						WHERE m.idJugador=\''.$idJugador.'\'');
	
			$datos=array();
	
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['id']]=$info;
	        	
	        	$datos[$info['id']]['idSectorOrigen']=intval((($datos[$info['id']]['idPlanetaOrigen']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas'))+1);
				$datos[$info['id']]['idCuadranteOrigen']= intval((($datos[$info['id']]['idPlanetaOrigen']-1-(intval((($datos[$info['id']]['idPlanetaOrigen']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas')))*$_ENV['config']->get('numPlanetas')*$_ENV['config']->get('numCuadrantes')))/$_ENV['config']->get('numPlanetas'))+1);
	      		$datos[$info['id']]['idSectorDestino']=intval((($datos[$info['id']]['idPlanetaDestino']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas'))+1);
				$datos[$info['id']]['idCuadranteDestino']= intval((($datos[$info['id']]['idPlanetaDestino']-1-(intval((($datos[$info['id']]['idPlanetaDestino']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas')))*$_ENV['config']->get('numPlanetas')*$_ENV['config']->get('numCuadrantes')))/$_ENV['config']->get('numPlanetas'))+1);
	       
			}
	        
	        $consulta->close();

	        //Ordenamos por fecha de salida
	        krsort($datos, SORT_NUMERIC);
	        
	        return $datos;
	        
	    }
	
	    /**
	     * Inserta una mision en la bbdd
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer galaxiaOrigen
	     * @param  Integer planetaOrigen
	     * @param  Integer galaxiaDestino
	     * @param  Integer planetaDestino
	     * @param  Integer tipoMision
	     * @param  Integer idUnidad
	     * @param  Integer cantidad
	     * @param  Integer tiempo
	     * @return mixed
	     * @since 30/09/2009
	     */
	    public function mision($idJugador, $galaxiaOrigen, $planetaOrigen, $galaxiaDestino, $planetaDestino, $tipoMision, $idUnidad, $cantidad, $tiempo)
	    {
	        
			//Insertamos la mision
		    $this->db->query('INSERT INTO mision (idJugador,idTipoMision,idGalaxiaOrigen,idGalaxiaDestino,
		      										idPlanetaOrigen,idPlanetaDestino, fechaSalida, tiempoTrayecto)
		       								VALUES (\''.$idJugador.'\', \''.$tipoMision.'\', \''.$galaxiaOrigen.'\', \''.$galaxiaDestino.'\', \''.$planetaOrigen.'\', \''.$planetaDestino.'\', FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].'),\''.$tiempo.'\')');
		        
		    //Realizamos el lote de consultas
		    $sql='INSERT INTO unidadJugadorPlanetaMision (idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadEnviada) VALUES ';
		    for($i=0;$i<count($idUnidad);$i++)
		     	$sql.='(LAST_INSERT_ID(), \''.$idUnidad[$i].'\', \''.$idJugador.'\', \''.$galaxiaOrigen.'\', \''.$planetaOrigen.'\', \''.$cantidad[$i].'\'), ';    
	
		    //Elimino los caracteres ", " del final de la cadena
		    $sql=substr($sql, 0, -2);
		       
		    $this->db->query($sql);
		       
		    return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve las unidades de las misiones
	     * pasadas como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMisiones
	     * @return mixed
	     * @since 02/10/2009
	     */
	    public function unidades($idMisiones)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT m.idMision, m.idUnidad, m.idGalaxia, m.idPlaneta,
						m.cantidadActual, m.cantidadEnviada, u.nombre, u.invisible
						FROM unidadJugadorPlanetaMision m 
							JOIN unidad u ON m.idUnidad=u.id
						WHERE m.idMision IN (\''.implode('\',\'',$idMisiones).'\')');
	
			$datos=array();
	
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['idMision']][]=$info;
			}
	        
	        $consulta->close();
	        
	        return $datos;
	        
	    }
	
	    /**
	     * Pone una mision en regreso
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idMision Pone una mision en regreso
	     * @return mixed
	     * @since 05/11/2009
	     */
	    public function regresar($idJugador, $idMision)
	    {
	        
			$mision = new Mision($idJugador, $idMision);
	
			//Obtengo si la mision es de tipo permanencia o no
			$consulta = $this->db->query('
							SELECT tm.permanencia
							FROM mision AS m 
								JOIN tipoMision AS tm ON (m.idTipoMision=tm.id)
							WHERE m.id=\''.$idMision.'\'
							LIMIT 1
						');
			list($permanencia) = $consulta->fetch_row();
	
			//Hago regresar a la mision, pasandole el tipo de mision
			$mision->volverManual($permanencia);
	        
	    }
	
	    /**
	     * Lista las misiones de otros usuarios que afectan
	     * a un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 18/01/2010
	     */
	    public function misionesAjenas($idJugador)
	    {
	        
	        /* 
	         * En la primera parte del where se comprueban misiones que vayan dirigidas hacia planetas donde tu tienes
	         * unidades ya estacionadas.
	         * La segunda parte del where afecta a las misiones que van dirigidas de otros usuarios hacia planetas que son
	         * de tu propiedad
	         */
	    	//TODO Optimizar cuando crezca el numero de jugadores
	        $consulta = $this->db->query(
						'SELECT m.id, m.idTipoMision, m.idGalaxiaOrigen, m.idGalaxiaDestino,
						m.idPlanetaOrigen, m.idPlanetaDestino, m.idJugador,
						TIMESTAMPDIFF(SECOND,NOW(),FROM_UNIXTIME(UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto)) AS tiempo,
						m.vuelta, m.nuevaMision, t.nombre AS tipoMision, u.nombre AS propietario,
						po.nombrePlaneta AS planetaOrigenNombre, po.nombreSGC AS planetaOrigenSGC,
						pd.nombrePlaneta AS planetaDestinoNombre, pd.nombreSGC AS planetasDestinoSGC,
						TRUE AS destinoExplorado, i.invisible, a.id AS idAlianza,
						po.idGalaxia AS idGalaxiaOrigen, pd.idGalaxia AS idGalaxiaDestino
						FROM (((mision m JOIN tipoMision t ON m.idTipoMision=t.id)
						JOIN planeta po ON po.idPlaneta=m.idPlanetaOrigen AND po.idGalaxia=m.idGalaxiaOrigen)
						JOIN planeta pd ON pd.idPlaneta=m.idPlanetaDestino AND pd.idGalaxia=m.idGalaxiaDestino)
						JOIN usuario AS u ON u.id=m.idJugador
						JOIN jugadorInfoUnidades AS i ON i.idJugador=u.id
						JOIN jugador AS j ON j.idUsuario=u.id
						LEFT JOIN alianza AS a ON a.id=j.idAlianza
						WHERE m.id IN(  
				        			SELECT id
				        			FROM mision
				        			WHERE idJugador!=\''.$idJugador.'\' AND 
				        				(idPlanetaDestino, idGalaxiaDestino) IN (
				        					SELECT m.idPlanetaDestino, m.idGalaxiaDestino
				        					FROM mision AS m JOIN tipoMision AS tm ON (m.idTipoMision = tm.id)
				        					WHERE m.idJugador=\''.$idJugador.'\'
				        							AND tm.permanencia=True 
				        							AND (UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto)<=UNIX_TIMESTAMP(NOW())
				        							AND m.vuelta=False
				        			))
	        					OR ((pd.idPlaneta, pd.idGalaxia) IN(
									SELECT idPlaneta, idGalaxia
									FROM planetaColonizado
									WHERE idJugador=\''.$idJugador.'\') AND m.idJugador!=\''.$idJugador.'\')');
	
			$datos=array();
			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();

	        	//Si las misiones son de tropas no aliadas y no conquistas las ocultamos
	        	if($this->misionTipo($info['id'])!=SOLDADO || $this->aliados($idJugador,$info['idJugador']) || $info['idTipoMision']==CONQUISTAR){
	        		$datos[$info['id']]=$info;
	        	
	        		$datos[$info['id']]['idSectorOrigen']=intval((($datos[$info['id']]['idPlanetaOrigen']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas'))+1);
					$datos[$info['id']]['idCuadranteOrigen']= intval((($datos[$info['id']]['idPlanetaOrigen']-1-(intval((($datos[$info['id']]['idPlanetaOrigen']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas')))*$_ENV['config']->get('numPlanetas')*$_ENV['config']->get('numCuadrantes')))/$_ENV['config']->get('numPlanetas'))+1);
		      		$datos[$info['id']]['idSectorDestino']=intval((($datos[$info['id']]['idPlanetaDestino']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas'))+1);
					$datos[$info['id']]['idCuadranteDestino']= intval((($datos[$info['id']]['idPlanetaDestino']-1-(intval((($datos[$info['id']]['idPlanetaDestino']-1)/$_ENV['config']->get('numCuadrantes')/$_ENV['config']->get('numPlanetas')))*$_ENV['config']->get('numPlanetas')*$_ENV['config']->get('numCuadrantes')))/$_ENV['config']->get('numPlanetas'))+1);
	        	}
	        		
	        	
			}
	        
	        $consulta->close();
	        
	        //Ordenamos por fecha de salida
	        krsort($datos, SORT_NUMERIC);
	        
	        return $datos;
	        
	    }
	
	    /**
	     * Devuelve informacion de  la mejora
	     * del limite de misiones de una raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 25/01/2010
	     */
	    public function mejoraLimiteMisiones($idRaza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT m.nombre
						FROM mejora m 
							JOIN mejoraNormal n ON m.id=n.idMejora
							JOIN mejoraTipoMejoraGeneral t ON m.id=t.idMejora
						WHERE t.idTipoMejora=\''.MEJORALIMITEMISIONES.'\' 
							AND n.idRaza=\''.$idRaza.'\' LIMIT 1');
	
			list($nombre)=$consulta->fetch_row();
	
			$consulta->close();
	
			return $nombre;
	        
	    }
	
	    /**
	     * Devuelve el numero de misiones actuales
	     * de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/01/2010
	     */
	    public function numMisionesActuales($idJugador)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT count(*)
						FROM mision
						WHERE idJugador=\''.$idJugador.'\' 
						LIMIT 1');
	
	        list($numMisiones)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numMisiones;
	        
	    }
	
	    /**
	     * Devuelve TRUE si todas las undiades pasadas como parametro son
	     * del tipo pasado como parametro. FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUnidad
	     * @param  Integer tipo
	     * @return mixed
	     * @since 21/03/2010
	     */
	    public function unidadesCorrectas($idUnidad, $tipo)
	    {
	        
	        //Comprobamos que todas las undiades sean del tipo pasado
	        $consulta=$this->db->query('SELECT DISTINCT idtipoUnidad
										FROM unidad
										WHERE id IN(\''.implode('\',\'', $idUnidad).'\')');
	        $ret=false;
	        if($consulta->num_rows==1){
	        	list($tipoUnidad)=$consulta->fetch_row();
	        	$ret=$tipoUnidad==$tipo;
	        }
	        else
	        	$ret=false;
	        
	        return $ret;
	        
	    }
	
	    /**
	     * Realiza una nueva mision a partir de un despliegue
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMision
	     * @param  Integer idJugador
	     * @param  Integer galaxiaDestino
	     * @param  Integer planetaDestino
	     * @param  Integer tipoMision
	     * @param  Integer tiempo1
	     * @param  Integer tiempo2
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function nueva($idMision, $idJugador, $galaxiaDestino, $planetaDestino, $tipoMision, $tiempo1, $tiempo2)
	    {
	        //Insertamos la mision
		    $this->db->query('UPDATE mision SET 
		    					idTipoMision=\''.$tipoMision.'\',
		    					idGalaxiaDestino=\''.$galaxiaDestino.'\',
		      					idPlanetaDestino=\''.$planetaDestino.'\',
		       					tiempoTrayecto=\''.$tiempo1.'\',
		       					fechaSalida=FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].'),
		       					nuevaMision=TRUE
		       				WHERE idJugador=\''.$idJugador.'\' AND id=\''.$idMision.'\' 
		       					AND idTipoMision='.DESPLEGAR.'
		       					AND NOT vuelta
		       					AND UNIX_TIMESTAMP(NOW())-(UNIX_TIMESTAMP(fechaSalida)+tiempoTrayecto) > 0
		       				');

		    return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve el tipo de unidades de la mision.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMision
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function misionTipo($idMision)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT u.idTipoUnidad
						FROM unidadJugadorPlanetaMision m 
						JOIN unidad u ON m.idUnidad=u.id
						WHERE m.idMision=\''.$idMision.'\'
						LIMIT 1');
	
			list($tipoUnidad)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
	        return $tipoUnidad;
	        
	    }
	
	    /**
	     * Devuelve los datos de una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMision
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function datosMision($idMision)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT m.id, m.idJugador, m.idTipoMision, m.idGalaxiaOrigen, m.idGalaxiaDestino,
							m.idPlanetaOrigen, m.idPlanetaDestino, 
							TIMESTAMPDIFF(SECOND,NOW(),FROM_UNIXTIME(UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto)) AS tiempo,
							m.vuelta, m.nuevaMision, t.nombre AS tipoMision,
							po.nombrePlaneta AS planetaOrigenNombre, po.nombreSGC AS planetaOrigenSGC,
							pd.nombrePlaneta AS planetaDestinoNombre, pd.nombreSGC AS planetasDestinoSGC
						FROM mision m JOIN tipoMision t ON m.idTipoMision=t.id
							JOIN planeta po ON po.idPlaneta=m.idPlanetaOrigen AND po.idGalaxia=m.idGalaxiaOrigen
							JOIN planeta pd ON pd.idPlaneta=m.idPlanetaDestino AND pd.idGalaxia=m.idGalaxiaDestino
						WHERE m.id=\''.$idMision.'\' LIMIT 1');
	
	        $datos=Array();
			if($consulta->num_rows>0){
	        	$datos=$consulta->fetch_assoc();
			}
	        
	        $consulta->close();
	        
	        return $datos;
	        
	    }
	
	    /**
	     * Devuelve los ID de undiades de una
	     * mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMision
	     * @return mixed
	     * @since 27/05/2010
	     */
	    public function unidadesMision($idMision)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idUnidad, cantidadActual, cantidadEnviada
						FROM unidadJugadorPlanetaMision
						WHERE idMision=\''.$idMision.'\'');
	
			$datos=array();
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el planeta pasado como
	     * parametro tiene defensa de stargate. FALSE
	     * en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 28/06/2010
	     */
	    public function defensaStargate($idGalaxia, $idPlaneta)
	    {
	        
	        $sql='SELECT count(*)
				FROM unidadJugadorPlaneta AS u 
					JOIN defensa AS d ON u.idUnidad=d.idUnidad
					LEFT JOIN jugador AS j ON (j.idUsuario = u.idJugador)
				WHERE u.idGalaxia=\''.$idGalaxia.'\'
					AND u.idPlaneta=\''.$idPlaneta.'\'
					AND d.idTipoDefensa=\''.STARGATE.'\'
					AND j.vacaciones IS NULL
					AND (j.bloqueado IS NULL OR j.bloqueado < NOW())
				LIMIT 1';
	
	        $consulta = $this->db->query($sql);
	
	        list($numDefensas)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numDefensas>0;
	        
	    }
	    
		/**
	     * Devuelve TRUE si el planeta pasado como
	     * parametro tiene defensa de stargate. FALSE
	     * en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 28/06/2010
	     */
	    public function propietarioDebil($idGalaxia, $idPlaneta)
	    {
	        
	        $sql='SELECT puntosTecnologias
	        	FROM planetaColonizado AS p 
					LEFT JOIN jugadorInfoPuntuaciones AS j ON p.idJugador=j.idJugador  
				WHERE p.idGalaxia=\''.$idGalaxia.'\'
					AND p.idPlaneta=\''.$idPlaneta.'\'
				LIMIT 1';
	
	        $consulta = $this->db->query($sql);
	        
	    	if($consulta->num_rows>0){
	        	list($puntosTecnologias)=$consulta->fetch_row();
				$esDebil=$puntosTecnologias <= $_ENV['config']->get('puntuacionDebil');
	    	}
			else{
				$esDebil=false;
			}

	        $consulta->close();
	        
			return $esDebil;  
	    }
	
	    /**
	     * Devuelve TRUE si los dos jugadores son aliados.
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador1
	     * @param  Integer idJugador2
	     * @return mixed
	     * @since 10/07/2010
	     */
	    public function aliados($idJugador1, $idJugador2)
	    {
	        
	        $consulta=$this->db->query('SELECT COALESCE(j1.idAlianza=j2.idAlianza, FALSE)
										FROM jugador AS j1
											JOIN jugador AS j2 ON j1.idUsuario=\''.$idJugador1.'\' AND j2.idUsuario=\''.$idJugador2.'\'
										LIMIT 1');
	
	        list($res)=$consulta->fetch_row();
	        
	        return $res;
	        
	    }
	
	    /**
	     * Elimina una mision
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMision
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 11/10/2010
	     */
	    public function eliminarMision($idMision, $idJugador)
	    {
	        
	        //TODO ATENCION! Esto se debe hacer por culpa de un bug de mysql, que al ejecutar el DELETE CASCADE desde la tabla mision
			//el trigger de unidadJugadorPlanetaMision_BD no lo detecta, con lo que no se ejecuta y forma una inconsistencia de datos.
			//Eliminando manualmente las entradas de unidadJugadorPlanetaMision se fuerza a dispararse el trigger y los datos se mantienen integros.
			$this->db->query('
				UPDATE unidadJugadorPlanetaMision SET cantidadActual=0 WHERE idMision='.$idMision
			);
	
	        $this->db->query('
				DELETE FROM unidadJugadorPlanetaMision WHERE idMision='.$idMision
			);
	
			$this->db->query('
				DELETE FROM recursosObtenidos WHERE idMision='.$idMision
			);
	
	        //Eliminamos la mision
		    $this->db->query('DELETE FROM mision WHERE idJugador=\''.$idJugador.'\' AND id=\''.$idMision.'\' AND idTipoMision='.DESPLEGAR);
		       
		    return $this->db->errno==0;
	        
	    }
	
	}
?>
