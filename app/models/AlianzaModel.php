<?php
	/**
	 * sgcommander - models/AlianzaModel.php
	 *
	 * $Id$
	 *
	 * This file is part of sgcommander.
	 *
	 * Automatically generated on 29.07.2010, 05:22:58 with ArgoUML PHP module 
	 * (last revised $Date: 2008-04-19 08:22:08 +0200 (sáb, 19 abr 2008) $)
	 *
	 * @author firstname and lastname of author, <author@example.org>
	 * @package models
	 */
	
	
	
	/**
	 * Short description of class AlianzaModel
	 *
	 * @access public
	 * @author firstname and lastname of author, <author@example.org>
	 * @package models
	 */
	class AlianzaModel
	    extends ModelBase
	{
	    /**
	     * Expulsa a un jugador de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function expulsar($idJugador, $idAlianza)
	    {
	        
	        $this->db->query('UPDATE jugador SET
	    						idAlianza=NULL
	    						WHERE idUsuario=\''.$idJugador.'\'
	    						AND idAlianza=\''.$idAlianza.'\'');
	        
	        return $this->db->affected_rows==1;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el jugador es lider de su alianza,
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function esLider($idAlianza, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idFundador 
						FROM alianza
						WHERE id=\''.$idAlianza.'\' LIMIT 1');
	
			$datos=$consulta->fetch_assoc();
	
			$consulta->close();
	
			return $datos['idFundador']==$idJugador;
	        
	    }
	
	    /**
	     * Aceptar la solicitud de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function aceptarSolicitud($idJugador, $idAlianza)
	    {
	        //Comprobamos si existe la solicitud
	        $consulta=$this->db->query('SELECT count(*) AS existe FROM solicitudAlianza WHERE idJugador=\''.$idJugador.'\' AND idAlianza=\''.$idAlianza.'\'');
	        $existe=$consulta->fetch_assoc();
	        
	        //Cerramos la consulta
	        $consulta->close();
	        
	        if($existe['existe']==1){
		        //Metemos el jugador a la alianza
		        $this->db->query('UPDATE jugador SET
		    						idAlianza=\''.$idAlianza.'\'
		    						WHERE idUsuario=\''.$idJugador.'\'');
		
		        //Insertamos como explorados los planetas del resto de aliados
		        $this->db->query('INSERT IGNORE INTO planetaExplorado (idPlaneta, idGalaxia, idJugador, visible)
		        				(SELECT idPlaneta, idGalaxia, \''.$idJugador.'\', 0 FROM planetaColonizado 
		        				WHERE idJugador IN(SELECT idUsuario FROM jugador WHERE idAlianza=\''.$idAlianza.'\'))');
		        
		        //Insertamos los planetas del jugador al resto de la alianza
		        $consulta=$this->db->query('SELECT idGalaxia, idPlaneta FROM planetaColonizado WHERE idJugador=\''.$idJugador.'\'');
		        
		        $planetas=Array();
		        
		        for($i=0; $i<$consulta->num_rows; $i++)
		        	$planetas[$i]=$consulta->fetch_assoc();
		        	
		        //Cerramos la consulta
	        	$consulta->close();
		        
		        //Sacamos los miembros de la alianza
		        $consulta=$this->db->query('SELECT idUsuario FROM jugador WHERE idAlianza=\''.$idAlianza.'\'');
		        
		        //Preaparamos la consulta
		        $sql='INSERT IGNORE INTO planetaExplorado (idPlaneta, idGalaxia, idJugador, visible) VALUES ';
		        for($i=0; $i<$consulta->num_rows; $i++){
		        	$datos=$consulta->fetch_assoc();
		        	foreach($planetas as $planeta){
		        		$sql.='(\''.$planeta['idPlaneta'].'\',\''.$planeta['idGalaxia'].'\',\''.$datos['idUsuario'].'\',0),';
		        	}
		        }
		        
		        //Cerramos la consulta
	        	$consulta->close();
		        
		        //Quitamos la ultima coma
		        $sql=substr($sql,0,mb_strlen($sql, 'UTF-8')-1);
		        
		        //Ejecutamos la consulta
		        $this->db->query($sql);
		        
		        return $this->db->errno==0;
	        }
	        else
	        	return false;
	    }
	
	    /**
	     * Busca alianzas por nombre
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String buscado
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscarNombre($buscado)
	    {
	        //Obtiene los datos de las alianzas
	        $consulta=$this->db->query('
	        		SELECT a.id, a.titulo AS alianza, a.foro, u.nombre AS fundador
	        		FROM usuario AS u 
	        		JOIN alianza AS a ON a.idFundador=u.id
					WHERE UPPER(a.titulo) LIKE \'%'.strtoupper($buscado).'%\'');
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$row=$consulta->fetch_assoc();
	        	$datos[$row['id']]=$row;
	        	$datos[$row['id']]['puntosTotales']=0;
	        }
	        
	        $consulta->close();
	        
	        if(count($datos)){
		        //Obtiene los datos de los integrantes de las alianzas
		        $consulta=$this->db->query('
		        		SELECT j.idAlianza, p.puntosTotales
		        		FROM jugador AS j
		        		JOIN jugadorInfoPuntuaciones AS p ON j.idUsuario=p.idJugador
						WHERE j.idAlianza IN (\''.implode('\',\'', array_keys($datos)).'\')');
		        
		        for($i=0; $i<$consulta->num_rows; $i++){
		        	$row=$consulta->fetch_assoc();
		        	$datos[$row['idAlianza']]['puntosTotales']+=$row['puntosTotales'];
		        }
		        
		        $consulta->close();
	        }
	        
	        usort($datos, function($a,$b){$ret = $a['puntosTotales'] <= $b['puntosTotales'] ? True : False; return $ret;});
	        
			return $datos;
	    }
	
	    /**
	     * Busca alianzas por propietario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String buscado
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscarPropietario($buscado)
	    {
	        //Obtiene los datos de las alianzas
	        $consulta=$this->db->query('
	        		SELECT a.id, a.titulo AS alianza, a.foro, u.nombre AS fundador
	        		FROM usuario AS u 
	        		JOIN alianza AS a ON a.idFundador=u.id
					WHERE UPPER(u.nombre) LIKE \'%'.strtoupper($buscado).'%\'');
	       
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$row=$consulta->fetch_assoc();
	        	$datos[$row['id']]=$row;
	        	$datos[$row['id']]['puntosTotales']=0;
	        }
	        
	        $consulta->close();
	        
	        if(count($datos)){
		        //Obtiene los datos de los integrantes de las alianzas
		        $consulta=$this->db->query('
		        		SELECT j.idAlianza, p.puntosTotales
		        		FROM jugador AS j
		        		JOIN jugadorInfoPuntuaciones AS p ON j.idUsuario=p.idJugador
						WHERE j.idAlianza IN (\''.implode('\',\'', array_keys($datos)).'\')');
		        
		        for($i=0; $i<$consulta->num_rows; $i++){
		        	$row=$consulta->fetch_assoc();
		        	$datos[$row['idAlianza']]['puntosTotales']+=$row['puntosTotales'];
		        }
		        
		        $consulta->close();
	        }
	        
	        usort($datos, function($a,$b){$ret = $a['puntosTotales'] <= $b['puntosTotales'] ? True : False; return $ret;});
	        
			return $datos;     
	    }
	
	    /**
	     * Cambia los datos de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  String titulo
	     * @param  String imagen
	     * @param  String texto
	     * @param  String foro
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function cambiarDatos($idAlianza, $titulo, $imagen, $texto, $foro)
	    {
	        
	    	$this->db->query('UPDATE alianza SET
	    						titulo=\''.$titulo.'\',
	    						imagen=\''.$imagen.'\', 
	    						texto=\''.$texto.'\',
	    						foro=\''.$foro.'\' WHERE id=\''.$idAlianza.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve el numero de miembros de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function numMiembros($idAlianza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT count(*) AS numeroMiembros
						FROM jugador
						WHERE idAlianza=\''.$idAlianza.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos['numeroMiembros'];
	        
	    }
	
	    /**
	     * Devuelve los datos de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function alianza($idAlianza)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT titulo, idFundador, imagen, texto, foro FROM alianza
						WHERE id=\''.$idAlianza.'\'
						LIMIT 1');
	
	        $datos = Array();
	        
			$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	    
		/**
	     * Devuelve TRUE si una alianza existe, FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function existeAlianza($nombre)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT COUNT(*) AS existe FROM alianza
						WHERE UPPER(titulo)=\''.strtoupper($nombre).'\'
						LIMIT 1');
	
	        $datos = Array();
	        
			$datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos['existe']!=0;
	        
	    }
	
	    /**
	     * Devuelve los miembros de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function miembros($idAlianza, $inicio, $cantidad)
	    {
	        
	        $consulta=false;
	        
	        if(is_numeric($inicio) && is_numeric($cantidad))//Comprobaciones de seguridad, que el tipo sea numerico
	        	if($inicio>=0)//Comprobando que los rangos elegidos sean los correctos
			        $consulta=$this->db->query('
			        		SELECT u.id, u.nombre AS usuario, j.idRaza, r.nombre AS raza, p.puntosTotales AS puntuacion, a.idFundador IS NOT NULL AS lider 
			        		FROM jugador AS j JOIN usuario AS u ON u.id=j.idUsuario
			        		JOIN raza AS r ON j.idRaza=r.id
			        		JOIN jugadorInfoPuntuaciones AS p ON j.idUsuario=p.idJugador
			        		LEFT JOIN alianza AS a ON a.idFundador=u.id
			        		WHERE j.idAlianza=\''.$idAlianza.'\' 
			        		ORDER BY p.puntosTotales DESC
			        		LIMIT '.$inicio.','.$cantidad);
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Envia una solicitud de ingreso a una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer idJugador
	     * @param  String mensaje
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function enviarSolicitud($idAlianza, $idJugador, $mensaje)
	    {
	        
	        $this->db->query('INSERT INTO solicitudAlianza (idAlianza,idJugador,mensaje)
	        					VALUES(\''.$idAlianza.'\',\''.$idJugador.'\',\''.$mensaje.'\')');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Borra una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function borrar($idAlianza)
	    {
	        
	        $this->db->query('DELETE FROM alianza WHERE id=\''.$idAlianza.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Rechaza una solicitud de ingreso
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function rechazarSolicitud($idAlianza, $idJugador)
	    {
	        
	    	$this->db->query('DELETE FROM solicitudAlianza 
	        					WHERE idAlianza=\''.$idAlianza.'\'
	        					AND idJugador=\''.$idJugador.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Crea una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idFundador
	     * @param  String titulo
	     * @param  String imagen
	     * @param  String texto
	     * @param  String foro
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function enviarDatos($idFundador, $titulo, $imagen, $texto, $foro)
	    {
	        
	        $idAlianza=null;
	    	$this->db->query('INSERT INTO alianza (idFundador, titulo, imagen, texto, foro)
	        					VALUES (\''.$idFundador.'\', \''.$titulo.'\', \''.$imagen.'\', \''.$texto.'\', \''.$foro.'\')');
	        
	        if($this->db->errno==0)
	        	$idAlianza=$this->db->insert_id;
	        
	        return $idAlianza;
	        
	    }
	
	    /**
	     * Cambia el lider de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function cambiarLider($idAlianza, $idJugador)
	    {
	        
	        $this->db->query('UPDATE alianza SET
	    						idFundador=\''.$idJugador.'\'
	    						WHERE id=\''.$idAlianza.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el jugador ya ha enviado una
	     * solicitud de entrada a la alianza.
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 06/02/2010
	     */
	    public function yaSolicitado($idJugador, $idAlianza)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT count(*) AS yaSolicitado
						FROM solicitudAlianza
						WHERE idJugador=\''.$idJugador.'\'
						AND idAlianza=\''.$idAlianza.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos['yaSolicitado']==1;
	        
	    }
	
	    /**
	     * Devuelve las solicitudes pendientes de
	     * una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 02/02/2010
	     */
	    public function solicitudes($idAlianza)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT s.idJugador, u.nombre AS usuario, r.id AS idRaza, r.nombre AS raza, s.mensaje, p.puntosTotales AS puntuacion
						FROM solicitudAlianza AS s 
						JOIN jugadorInfoPuntuaciones p ON p.idJugador=s.idJugador
						JOIN usuario u ON u.id=s.idJugador
						JOIN jugador j ON j.idUsuario=s.idJugador
						JOIN raza r ON r.id=j.idRaza
						WHERE s.idAlianza=\''.$idAlianza.'\'');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el usuario pasado como
	     * parametro pertenece a la alianza. FALSE en
	     * caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 14/02/2010
	     */
	    public function perteneceAlianza($idAlianza, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT count(*) AS pertenece
						FROM jugador
						WHERE idAlianza=\''.$idAlianza.'\' 
						AND idUsuario=\''.$idJugador.'\' 
						LIMIT 1');
	
			$datos=$consulta->fetch_assoc();
	
			$consulta->close();
	
			return $datos['pertenece']==1;
	        
	    }
	
	    /**
	     * Devuelve la puntuacion de la alianza en una categoria
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  Integer tipoPuntuacion
	     * @return mixed
	     * @since 29/07/2010
	     */
	    public function puntuacion($idAlianza, $tipoPuntuacion = 'total')
	    {
	        
	        switch($tipoPuntuacion){
	        	case 'naves':
	        		$campo='puntosNaves';
	        		break;
	        	case 'tropas':
	        		$campo='puntosSoldados';
	        		break;
	        	case 'defensas':
	        		$campo='puntosDefensas';
	        		break;
	        	default:
	        		$campo='puntosTotales';
	        		break;
	        }
	        $sql='SELECT p.'.$campo.'
	        	  FROM alianza a
	        	  JOIN jugador AS j ON a.id=j.idAlianza
	        	  JOIN jugadorInfoPuntuaciones AS p ON p.idJugador=j.idUsuario
	        	  WHERE a.id=\''.$idAlianza.'\'';
	        
	        $consulta = $this->db->query($sql);
	
	        $puntos=0;
	        while($row=$consulta->fetch_row()){
	        	$puntos+=$row[0];
	        }
	        
	        $consulta->close();
	        
			return $puntos;
	        
	    }
	
	}
?>