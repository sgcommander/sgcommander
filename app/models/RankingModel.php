<?php
	/**
	 * Modelo que gestiona la información
	 * del ranking de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 12/08/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * del ranking de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 12/08/2009
	 */
	class RankingModel
	    extends ModelBase
	{
		/**
	     * Devuelve el ranking de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @param  Integer puntuacion
	     * @param  Integer tipoPuntuacion
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function usuarios($inicio, $cantidad, $puntuacion, $tipoPuntuacion)
	    {
	        
	        $consulta=false;
	        
	        if(is_numeric($inicio) && is_numeric($cantidad)){//Comprobaciones de seguridad, que el tipo sea numerico
	        	if($inicio>=0){//Comprobando que los rangos elegidos sean los correctos
	        		$sql='SELECT u.id, u.nombre AS usuario, j.idRaza, r.nombre AS raza, a.id AS idAlianza, a.titulo AS alianza,
	        									p.puntosNaves, p.puntosSoldados, p.puntosDefensas, p.puntosTecnologias, p.puntosTotales,
	        									j.vacaciones IS NOT NULL AS vacaciones,
	        									COALESCE(TIMESTAMPDIFF(WEEK,NOW(),u.ultimoAcceso), 0) AS inactivo, p.puntosTecnologias
	        									FROM usuario AS u JOIN jugador AS j ON u.id=j.idUsuario
	        									LEFT JOIN alianza AS a ON a.id=j.idAlianza
	        									JOIN jugadorInfoPuntuaciones AS p ON p.idJugador=j.idUsuario
	        									JOIN raza AS r ON r.id=j.idRaza ';
	        		if($tipoPuntuacion=='naves')
			        	$sql.='ORDER BY p.puntosNaves';
			        elseif($tipoPuntuacion=='tropas')
			        	$sql.='ORDER BY p.puntosSoldados';
			        elseif($tipoPuntuacion=='defensas')
			        	$sql.='ORDER BY p.puntosDefensas';
			        elseif($tipoPuntuacion=='investigacion')
			        	$sql.='ORDER BY p.puntosTecnologias';
			        else
			        	$sql.='ORDER BY p.puntosTotales';
	        		$sql.=' DESC, u.id ASC LIMIT '.$inicio.','.$cantidad;

	        		$consulta=$this->db->query($sql);
	        	}
	        }
	        $datos=Array();
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Es debil
	        	$datos[$i]['debil']= $datos[$i]['puntosTecnologias'] < $_ENV['config']->get('puntuacionDebil');
	        }
	        	
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve el ranking de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @param  Integer tipoPuntuacion
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function alianzas($inicio, $cantidad, $tipoPuntuacion)
	    {
	        $datos=Array();
	        
	        if(is_numeric($inicio) && is_numeric($cantidad)){//Comprobaciones de seguridad, que el tipo sea numerico
	        	if($inicio>=0){//Comprobando que los rangos elegidos sean los correctos
	        		$sql='SELECT a.id, a.titulo AS alianza, a.foro, u.nombre AS fundador, COUNT(u.id) AS numMiembros, SUM(puntosTotales)/COUNT(u.id) AS puntosMedia,
        					SUM(p.puntosNaves) AS puntosNaves, SUM(p.puntosSoldados) AS puntosSoldados, SUM(p.puntosDefensas) AS puntosDefensas, SUM(p.puntosTecnologias) AS puntosTecnologias, SUM(p.puntosTotales) AS puntosTotales
        				FROM usuario AS u JOIN alianza AS a ON a.idFundador=u.id
        					JOIN jugador AS j ON a.id=j.idAlianza
        					JOIN jugadorInfoPuntuaciones AS p ON p.idJugador=j.idUsuario
        				GROUP BY a.id, a.titulo, a.foro, u.nombre ';
	        		if($tipoPuntuacion=='naves')
			        	$sql.='ORDER BY puntosNaves';
			        elseif($tipoPuntuacion=='tropas')
			        	$sql.='ORDER BY puntosSoldados';
			        elseif($tipoPuntuacion=='defensas')
			        	$sql.='ORDER BY puntosDefensas';
			        elseif($tipoPuntuacion=='investigacion')
			        	$sql.='ORDER BY puntosTecnologias';
			        elseif($tipoPuntuacion=='total')
			        	$sql.='ORDER BY puntosTotales';
			        else
			        	$sql.='ORDER BY SUM(puntosTotales)/COUNT(u.id)';
	        		$sql.=' DESC, a.id DESC LIMIT '.$inicio.','.$cantidad;
	        
	        		$consulta=$this->db->query($sql);
	        		
	        		for($i=0; $i<$consulta->num_rows; $i++)
	        			$datos[$i]=$consulta->fetch_assoc();
	        
	        		$consulta->close();
	        	}
	        }

			return $datos;
	        
	    }
	
	    /**
	     * Devuelve el numero de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function numUsuarios()
	    {
	        
	        //TODO mirar el trigger para usar esta
	        /*$consulta = $this->db->query(
	        			'SELECT SUM(nCuentas) AS numeroUsuarios
						FROM galaxia');*/
	    	$consulta = $this->db->query(
	        			'SELECT COUNT(*) AS numeroUsuarios
						FROM usuario');
	
	        list($numUsuarios)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numUsuarios;
	        
	    }
	
	    /**
	     * Devuelve el numero de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function numAlianzas()
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT COUNT(*) AS numeroAlianzas
						FROM alianza');
	
	        list($numAlianzas)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numAlianzas;
	        
	    }
	
	    /**
	     * Busca un usuario en el ranking
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String usuario
	     * @return mixed
	     * @since 29/08/2010
	     */
	    public function buscar($usuario)
	    {
	        $consulta=$this->db->query('SELECT u.id, u.nombre, j.idRaza, r.nombre as raza , IFNULL(a.titulo,"-") AS alianza, j.idAlianza,
		        	p.puntosNaves, p.puntosSoldados, p.puntosDefensas, p.puntosTecnologias, p.puntosTotales,
		        	j.vacaciones IS NOT NULL AS vacaciones,
		        	COALESCE(TIMESTAMPDIFF(WEEK,NOW(),u.ultimoAcceso), 0) AS inactivo, p.puntosTecnologias
	        	FROM usuario AS u JOIN jugador AS j ON u.id=j.idUsuario
	        		JOIN raza AS r ON r.id=j.idRaza
	        		JOIN jugadorInfoPuntuaciones AS p ON u.id=p.idJugador
	        		LEFT JOIN alianza AS a ON j.idAlianza=a.id
	        	WHERE UPPER(u.nombre) LIKE \'%'.strtoupper($usuario).'%\'');
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$datos[$i]=$consulta->fetch_assoc();
	        	
	        	//Es debil
	        	$datos[$i]['debil']= $datos[$i]['puntosTecnologias'] < $_ENV['config']->get('puntuacionDebil');
	        }	
	        
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>