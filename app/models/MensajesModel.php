<?php
	/**
	 * Modelo que gestiona la información
	 * de mensajes de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 01/02/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de mensajes de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 01/02/2009
	 */
	class MensajesModel
	    extends ModelBase
	{
	    /**
	     * Devuelve los mensajes de la entrada del 
	     * usuario entre inicio y fin
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer inicio
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function entrada($idJugador, $inicio, $cantidad)
	    {
	        
	        $consulta=false;
	        
	        if(is_numeric($inicio) && is_numeric($cantidad))//Comprobaciones de seguridad, que el tipo sea numerico
	        	if($inicio>=0)//Comprobando que los rangos elegidos sean los correctos
	        		$consulta=$this->db->query('SELECT m.id, m.nombreUsuario, m.asunto, m.fecha, m.contenido, rm.leido, m.idTipoMensaje 
	        									FROM mensaje AS m LEFT JOIN recibeMensaje AS rm ON m.id=rm.idMensaje
	        									WHERE rm.idJugador=\''.$idJugador.'\' ORDER BY m.fecha DESC
	        									LIMIT '.$inicio.','.$cantidad);
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Borra los mensajes pasados como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idMensajes
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function borrar($idJugador, &$idMensajes)
	    {
	        
	        //Elimina un mensaje siempre y cuando sea del usuario
	       	$this->db->query('DELETE FROM recibeMensaje
	        							WHERE idMensaje IN (\''.implode('\',\'',$idMensajes).'\') AND idJugador=\''.$idJugador.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	    
		/**
	     * Borra todos los mensajes de un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idMensajes
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function borrarTodos($idJugador)
	    {
	        
	        //Elimina un mensaje siempre y cuando sea del usuario
	       	$this->db->query('DELETE FROM recibeMensaje
	        							WHERE idJugador=\''.$idJugador.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Marca como leidos los mensajes 
	     * pasados como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idMensajes
	     * @param  Integer leido
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function marcarLeidos($idJugador, $idMensajes, $leido)
	    {
	        
	    	$this->db->query('UPDATE recibeMensaje SET leido=\''.$leido.'\'
	    					WHERE idMensaje IN (\''.implode('\',\'',$idMensajes).'\')
	    						AND idJugador=\''.$idJugador.'\'');
	    	return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve la informacion de un mensaje
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function mensaje($idMensaje, $idJugador)
	    {
	        
	        $consulta=$this->db->query('SELECT m.id, asunto, contenido, fecha, m.nombreUsuario AS nombreEmisor, m.idJugador AS idEmisor, m.idTipoMensaje
	        								FROM mensaje m 
	        									JOIN recibeMensaje r ON m.id=r.idMensaje
	        								WHERE id=\''.$idMensaje.'\'
	        									AND r.idJugador=\''.$idJugador.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Envia un mensaje a los receptores 
	     * pasados como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idEmisor
	     * @param  Integer destinatarios
	     * @param  String asunto
	     * @param  String contenido
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function enviar($idEmisor, $destinatarios, $asunto, $contenido)
	    {
	        
	        $this->db->query('INSERT INTO mensaje (idJugador, asunto, contenido, idTipoMensaje)
	        								VALUES (\''.$idEmisor.'\', \''.$asunto.'\', \''.$contenido.'\', \''.MENSAJENORMAL.'\')');
	        
	        $consulta = $this->db->query('SELECT id 
	        									FROM usuario 
	        									WHERE nombre IN(\''.implode('\',\'', $destinatarios).'\')');
	        
	        //Realizamos el lote de consultas (asignamos a los destinatarios el mensaje)
	        $sql='INSERT INTO recibeMensaje (idMensaje, idJugador) VALUES ';
	        while(list($idReceptor)=$consulta->fetch_row())
	        	$sql.='(LAST_INSERT_ID(), \''.$idReceptor.'\'), ';    
	
	        //Elimino los caracteres ", " del final de la cadena
	       	$sql=substr($sql, 0, -2);
	       
	       	$this->db->query($sql);
	       
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Reenvia un mensaje a los usuarios
	     * pasados como parametro añadiendo 
	     * contenido extra
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idEmisor
	     * @param  Integer idMensaje
	     * @param  Integer idReceptores
	     * @param  String extra
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function reenviar($idEmisor, $idMensaje, $idReceptores, $extra)
	    {
	        
	        $consulta=$this->db->query('SELECT asunto, contenido
	        								FROM mensaje
	        								WHERE id=\''.$idMensaje.'\'
	        								AND idTipoMensaje='.MENSAJENORMAL);
	        
	        if($consulta->num_rows==1){
	        	$datos=$consulta->fetch_assoc();
	        
	        	//Anadimos el mensaje del reenviador del mensaje
		        $datos['contenido']=$extra.'<br><br>Mensaje Original:<br>'.$datos['contenido'];
		        
		        return $this->enviar($idEmisor, $idReceptores, $datos['asunto'], $datos['contenido']);
	        }
	        
	        return false;
	        
	    }
	
	    /**
	     * Envia un mensaje de respuesta a su emisor
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  String contenido
	     * @return mixed
	     * @since 01/02/2009
	     */
	    public function responder($idMensaje, $contenido)
	    {
	        
	        $consulta=$this->db->query('SELECT asunto, idJugador
	        								FROM mensaje
	        								WHERE id=\''.$idMensaje.'\'
	        								AND idTipoMensaje='.MENSAJENORMAL);
	         
	        if($consulta->num_rows==1){
	   	    	$datos=$consulta->fetch_assoc();
	   	    
	   	    	$consulta->close();
	   	    
	   	    	$datos['asunto']='RE:&#160;'.$datos['asunto'];
		        
		        return $this->enviar($idEmisor, $idReceptores, $datos['asunto'], $datos['contenido']);
	    	}
	        else
	        	return false;
	        
	        
	    }
	
	    /**
	     * Devuelve el numero de mensajes de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 14/03/2009
	     */
	    public function numMensajes($idJugador)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT count(*) AS numeroMensajes
						FROM recibeMensaje
						WHERE idJugador=\''.$idJugador.'\' LIMIT 1');
	
	        list($numMensajes)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numMensajes;
	        
	    }
	
	    /**
	     * Devuelve TRUE si todo los destinatarios son correctos 
	     * FALSE en caso contrario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer destinatarios
	     * @return mixed
	     * @since 15/03/2009
	     */
	    public function destinatariosValidos($destinatarios)
	    {
	        
	        $consulta = $this->db->query('SELECT count(1) AS destinatarios 
	        									FROM usuario 
	        									WHERE nombre IN(\''.implode('\',\'', $destinatarios).'\') LIMIT 1');
	
	        list($destintariosEncontrados)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
	        return count($destinatarios)==$destintariosEncontrados;
	        
	    }
	
	    /**
	     * Devuelve el numero de mensajes
	     * sin leer del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 03/12/2009
	     */
	    public function numMensajesNuevos($idJugador)
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT numeroMensajes
						FROM jugadorInfoGeneral
						WHERE idJugador=\''.$idJugador.'\' LIMIT 1');
	
	        list($numeroMensajes)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numeroMensajes;
	        
	    }
	
	    /**
	     * Devuelve el numero de sengundos
	     * desde el anterior mesaje del jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 24/03/2010
	     */
	    public function ultimoEnvio($idJugador)
	    {
	        
	        $consulta=$this->db->query('SELECT UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(fecha) 
	        							FROM mensaje
	        							WHERE idJugador=\''.$idJugador.'\' ORDER BY fecha DESC LIMIT 1');
	
	        //Obtengo el tiempo en segundos desde el ultimo mensaje
	        list($segundos)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
	        //Si no se ha enviado ningun mensaje anterior, el tiempo entre mensajes es el maximo
	        if(!$segundos)
	        	$segundos=time();
	        
			return $segundos;
	        
	    }
	
	    /**
	     * Devuelve la informacion de jugadores de
	     * un reporte de batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function batallaJugadores($idMensaje, $idJugador)
	    {
	        
	        $consulta=false;
	        $consulta=$this->db->query('SELECT b.idJugador, b.nombreJugador, b.nombreRaza, b.nombreAlianza, b.idRaza, b.idAlianza
	        							FROM infoJugadoresBatalla AS b 
	        							JOIN recibeMensaje AS rm ON b.idMensaje=rm.idMensaje
	        							WHERE rm.idJugador=\''.$idJugador.'\' 
	        							AND rm.idMensaje=\''.$idMensaje.'\'');
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
	        //Ordenamos por alianza
	        usort($datos, function($a,$b){$ret = $a['idAlianza'] >= $b['idAlianza'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve la informacion de unidades iniciales
	     * de un reporte de batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 22/05/2010
	     */
	    public function batallaUnidadesIniciales($idMensaje, $idJugador)
	    {
	        
	        $consulta=false;
	        $consulta=$this->db->query('SELECT u.idJugador, u.idUnidad, u.idTipoUnidad, u.nombreUnidad, u.cantidadInicial, u.cantidadFinal, u.puntosUnidad
	        							FROM infoMisUnidades AS u 
	        							JOIN recibeMensaje AS rm ON u.idMensaje=rm.idMensaje
	        							WHERE rm.idJugador=\''.$idJugador.'\' AND rm.idMensaje=\''.$idMensaje.'\'
	        							ORDER BY u.idJugador, u.idTipoUnidad, u.idUnidad');
	        
	        $datos=Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve la informacion de unidades finales o capturadas
	     * de un reporte de batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 06/06/2010
	     */
	    public function batallaUnidadesAtacadas($idMensaje, $idJugador)
	    {
	        $consulta=$this->db->query('SELECT u.idJugador, u.idUnidad, u.idTipoUnidad, u.tipo, u.nombreUnidad, u.cantidad, u.puntosObtenidos
	        							FROM infoUnidadesAtacadas AS u 
	        							JOIN recibeMensaje AS rm ON u.idMensaje=rm.idMensaje
	        							WHERE rm.idJugador=\''.$idJugador.'\' AND rm.idMensaje=\''.$idMensaje.'\'
	        							ORDER BY u.idJugador, u.idTipoUnidad, u.idUnidad');
	        
	        $datos=Array();
	        
	        while($row = $consulta->fetch_assoc()){
	        	$datos[]=$row;
	        }	
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve el html de un reporte
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 08/06/2010
	     */
	    public function reporte($idMensaje, $idJugador)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT html
						FROM reporte AS r 
							JOIN recibeMensaje AS m ON r.idMensaje=m.idMensaje
						WHERE r.idMensaje=\''.$idMensaje.'\' 
							AND m.idjugador=\''.$idJugador.'\' LIMIT 1');
	
	        list($html)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $html;
	        
	    }
	
	    /**
	     * Envia un mensaje de sistema a
	     * una lista de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer destinatarios
	     * @param  String asunto
	     * @param  String contenido
	     * @param  Integer tipo
	     * @return mixed
	     * @since 28/06/2010
	     */
	    public function enviarSistema($destinatarios, $asunto, $contenido, $tipo)
	    {
	        
	        $this->db->query('INSERT INTO mensaje (idJugador, asunto, contenido, idTipoMensaje)
	        								VALUES (NULL, \''.$asunto.'\', \''.$contenido.'\', \''.$tipo.'\')');
	        
	        //Realizamos el lote de consultas (asignamos a los destinatarios el mensaje)
	        $sql='INSERT INTO recibeMensaje (idMensaje, idJugador) VALUES ';
	        foreach($destinatarios as $destintario)
	        	$sql.='(LAST_INSERT_ID(), \''.$destintario.'\'), ';    
	
	        //Elimino los caracteres ", " del final de la cadena
	       	$sql=substr($sql, 0, -2);
	       
	       	$this->db->query($sql);
	       
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve los datos del planeta de una batalla
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idMensaje
	     * @return mixed
	     * @since 31/07/2010
	     */
	    public function batallaPlaneta($idMensaje)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idPlaneta, idGalaxia 
						FROM infoGeneralBatalla 
						WHERE idMensaje=\''.$idMensaje.'\' 
						LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	}
?>