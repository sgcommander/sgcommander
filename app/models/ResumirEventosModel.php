<?php
	/**
	 * Gestiona los datos de los eventos
	 *
	 * @author David & Jose
	 * @package models
	 * @since 19/04/2009
	 */
	
	
	/**
	 * Librerias necesarias
	 */
	//include_once('../libs/Mision/Mision.php');
	
	/**
	 * Gestiona los datos de los eventos
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 19/04/2009
	 */

	class ResumirEventosModel
	    extends ModelBase
	{
		/**
	     * Constructor de la clase
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 21/01/2009
	     */
	    public function __construct()
	    {
	        //Obtengo la abstraccion de la base de datos con transacciones
	        $this->db = SPDO::singleton(TRUE);
	        
			$this->db->connect('p:'.$_ENV['config']->get( 'dbHost' ));
	    }
		
	    /**
	     * Devuelve la ultima actualizacion del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 19/04/2009
	     */
	    public function ultimaActualizacion($idJugador)
	    {
	    	//Si lo que se ha pasado es un vector, se obtienen todas las
	    	//ultimas actualizaciones de todos los jugadores
	        if(is_array($idJugador)){
	        	$consulta = $this->db->query('
					SELECT idUsuario, UNIX_TIMESTAMP(ultimaActualizacion) AS tiempo
					FROM jugador
					WHERE idUsuario IN (\''.implode('\',\'', $idJugador).'\')
				');
				
	        	$datos=Array();
	        	while($row=$consulta->fetch_assoc()){
		        	$datos[$row['idUsuario']]=$row['tiempo'];
	        	}
	        }
	        //Si solo se ha pasado un identificador de un solo jugador, solo se obtiene
	        //la ultima actualizacion de dicho jugador
	        else{
		        $consulta = $this->db->query('
					SELECT UNIX_TIMESTAMP(ultimaActualizacion)
					FROM jugador
					WHERE idUsuario='.$idJugador.' 
					LIMIT 1
				');
		
		        list($datos)=$consulta->fetch_row();
	        }
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	    
	    /**
	     * Obtiene las alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 19/04/2009
	     */
		public function obtenerAlianza($idJugador){
	    	$consulta = $this->db->query('
	    		SELECT idAlianza
	    		FROM jugador
	    		WHERE idUsuario=\''.$idJugador.'\'
	    	');
	    
	    	$datos = $consulta->fetch_row();
	    
	    	$consulta->close();
	    
	    	return $datos;
	    }
	
	    /**
	     * Actualiza los recursos del usuario logueado a una fecha
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer tTranscurrido
	     * @param  Integer produccion
	     * @return mixed
	     * @since 19/04/2009
	     */
	    public function actualizarRecursos($idJugador, $tTranscurrido, $produccion)
	    {
	    	//Compruebo que haya transcurrido al menos un segundo de tiempo para actualizar los recursos
	    	if($tTranscurrido > 0){
	    		//System_Daemon::info('-Actualizando recursos del jugador %s',$idJugador);
		        //Actualiza el recurso primario
		    	foreach($produccion as $key => $value){
		    		if($key!=2)
		    			$this->db->query('
				    		UPDATE tipoRecursoUsuario 
							SET cantidad=cantidad+('.$produccion[$key]['produccion'].'*'.$tTranscurrido.')
							WHERE idJugador='.$idJugador.' AND idTipoRecurso='.($key+1));
		    	}
	    	}
	        
	    }
	
	    /**
	     * Actualiza la ultima actualizacion del usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer fecha
	     * @return mixed
	     * @since 19/04/2009
	     */
	    public function actualizarTiempo($idJugador, $fecha)
	    {
	        //Actualiazmos el valor en la base de datos
	    	$this->db->query('
	    		UPDATE jugador
	    		SET ultimaActualizacion=FROM_UNIXTIME('.$fecha.')
	    		WHERE idUsuario=\''.$idJugador.'\'
	    	');
	    }
	
	    /**
	     * Busca el siguiente evento a resolver
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 19/04/2009
	     */
	    public function buscarSiguienteEvento()
	    {
	    	//Obtenemos el proximo evento
			$sql='SELECT idEvento, tipo, idGalaxia, idPlaneta, idJugador, UNIX_TIMESTAMP(tiempo) AS tiempo, id
				FROM evento 
				WHERE tiempo <= NOW()
				ORDER BY tiempo ASC
				LIMIT 0,1';
				
			$consulta = $this->db->query($sql);
	       	$evento=$consulta->fetch_assoc();
	    	
	    	return $evento;
	        
	    }
	    
	    public function eventoMision($idJugador, $mision, $idGalaxia, $idPlaneta, $tiempoActual){
	    	$conquista=False;
	    
	    	//si la mision es una conquista y el tiiempo de fin conquista, no esta dentro del evento
	    	//, por lo cual no se ha resuelto, pero si que esta dentro del tiempo actual, generamos
	    	//un nuevo evento para resolverlo en el momento que toque
	    	$finConquista=$mision->tiempoMision()+$_ENV['config']->get('tiempoConquista'); 
	    	if($mision->tipoMision()=='conquistar' && $tiempoActual >= $finConquista  &&  $mision->tiempoEvento < $finConquista ){
	    		
	    		/**
	    		 * Evento donde se producirá la conquista
	    		 */
	    		$conquista = Array('idJugador' => $idJugador,
    								'tiempo' => $finConquista,
    								'tipo' => 'mision',
    								'id' => $mision->getIdMision(),
    								'idGalaxia' => $idGalaxia,
    								'idPlaneta' => $idPlaneta);
	    	}
	    
	    	return $conquista;
	    }
	
	    /**
	     * Short description of method terminarMejora
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @param  Integer idJugador
	     * @param  Integer idMejora
	     * @return mixed
	     */
	    public function terminarMejora($idJugador, $idMejora)
	    {
	        System_Daemon::info('-Terminando mejora %s del jugador %s',$idMejora,$idJugador);
	        $this->db->query('
	    		DELETE FROM jugadorMejoraInvestiga
	    		WHERE idJugador=\''.$idJugador.'\' 
	    		AND idMejora=\''.$idMejora.'\''
	    	);
	        
	    }
	
	    /**
	     * Short description of method terminarConstruccion
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idUnidad
	     * @return mixed
	     */
	    public function terminarConstruccion($idUnidad, $idGalaxia, $idPlaneta)
	    {
	        System_Daemon::info('-Terminando construccion de unidad %s en el planeta %s de la galaxia %s',$idUnidad,$idPlaneta,$idGalaxia);
	        $this->db->query('
	    		DELETE FROM unidadConstruir
	    		WHERE idGalaxia=\''.$idGalaxia.'\' 
	    		AND idPlaneta=\''.$idPlaneta.'\' 
	    		AND idUnidad=\''.$idUnidad.'\'
	    	');
	        
	    }
	
	    /**
	     * Short description of method terminarEspecialActivo
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @param  Integer idJugador
	     * @param  Integer idEspecial
	     * @return mixed
	     */
	    public function terminarEspecialActivo($idJugador, $idEspecial)
	    {
	        
	        $this->db->query('
	    		DELETE FROM jugadorEspecialActivo
	    		WHERE idJugador=\''.$idJugador.'\' 
	    		AND idEspecial=\''.$idEspecial.'\'
	    	');
	        
	    }
	
	    /**
	     * Short description of method terminarEspecialEspera
	     *
	     * @access public
	     * @author firstname and lastname of author, <author@example.org>
	     * @param  Integer idJugador
	     * @param  Integer idEspecial
	     * @return mixed
	     */
	    public function terminarEspecialEspera($idJugador, $idEspecial)
	    {
	        
	        $this->db->query('
	    		DELETE FROM jugadorEspecialEspera
	    		WHERE idJugador=\''.$idJugador.'\' 
	    		AND idEspecial=\''.$idEspecial.'\'
	    	');
	        
	    } 
	    
	    public function eventoEspera($idJugador, $idEspecial, $tiempoFin){
	    	$consulta = $this->db->query('
	    		SELECT *
	    		FROM jugadorEspecialEspera
	    		WHERE idEspecial='.$idEspecial.' 
	    				AND idJugador='.$idJugador.'
	    				AND tiempoFinalEspera <= FROM_UNIXTIME(\''.$tiempoFin.'\')
	    		FOR UPDATE'
	    	);
	    	
	    	if($consulta->num_rows==1){
		    	$row = $consulta->fetch_assoc();
		    	
		    	return Array('idJugador' => $idJugador,
    						'tiempo' => $row['tiempoFinalEspera'],
    						'tipo' => 'finEspecialEspera',
    						'id' => $idEspecial,
    						'idGalaxia' => 0,
    						'idPlaneta' => 0);
	    	}
	    	else{
	    		return FALSE;
	    	}
	    }
	    
	    //Elimina las posibles unidades que da un especial y queden en un planeta del jugador
	    //al volver de una mision
	    public function eliminarUnidadesEspecialEspera($idJugador, $idEspecial){
	    	$consulta = $this->db->query('
	    		SELECT idUnidad, cantidadEnMision = 0 AS eliminar 
	    		FROM unidadJugadorPlaneta
	    		WHERE idJugador='.$idJugador.' AND idUnidad IN (SELECT idUnidad
							FROM especialUnidad
							WHERE idEspecial='.$idEspecial.')
					   
	    	');
	    
	    	while($row=$consulta->fetch_assoc()){
	    		if($row['eliminar']){
	    			//En esta sentencia se desactiva el trigger de unidadJugadorPlaneta, para que el efecto de borrar las unidades
	    			//sea solo ese, borrarlas y no tenga en cuenta, puntuaciones, energia, numTipoUnidad....
			    	$this->db->query('
			    		DELETE FROM unidadJugadorPlaneta 
			    		WHERE idUnidad = '.$row['idUnidad'].' 
			    			AND idJugador='.$idJugador.';
			    	');
	    		}
	    		else{
	    			//En esta sentencia se desactiva el trigger de unidadJugadorPlaneta, para que el efecto de actualizar las unidades
	    			//sea solo ese, actualizarlas y no tenga en cuenta, puntuaciones, energia, numTipoUnidad....
	    			$this->db->query('
			    		UPDATE unidadJugadorPlaneta 
			    		SET cantidad=0
			    		WHERE idUnidad = '.$row['idUnidad'].' 
			    			AND idJugador='.$idJugador.';
					');
	    		}
	    	}
	    
	    	$consulta->close();
	    }
	    
	    //Esta funcion comprueba si el especial en espera puede proseguir con su recarga, al haber podido
	    //eliminar todas las unidades pendientes
	    public function comprobarEspecialEspera($idJugador, $idEspecial){
	    	$consulta=$this->db->query('
	    		SELECT COUNT(*)
	    		FROM unidadJugadorPlaneta
	    		WHERE idUnidad IN (
	    				SELECT idUnidad
						FROM especialUnidad
						WHERE idEspecial='.$idEspecial.'
	    			) 
	    			AND idJugador='.$idJugador
	    		);
	    
	    	list($res)=$consulta->fetch_row();
	    
	    	$consulta->close();
	    
	    	return !$res;
	    }
	    
	    public function actualizarTiempoRecargaEspecialEspera($idJugador, $idEspecial, $tiempoFin){
	    	$this->db->query('
	    		UPDATE jugadorEspecialEspera
	    		SET tiempoFinalEspera = DATE_ADD(NOW(), INTERVAL (SELECT tiempoRecarga FROM especial WHERE idEspecial='.$idEspecial.') SECOND),
	    			unidadesPendientes=False
	    		WHERE idEspecial='.$idEspecial.' 
	    			AND idJugador='.$idJugador
	    	);
	    }
	
	    public function actualizarTiempoEvento($mision, $tiempo){
	    	$this->db->query('
	    		UPDATE evento
	    		SET tiempo=FROM_UNIXTIME('.($tiempo+1).')
	    		WHERE idJugador='.$mision->getIdJugador().' 
		    		AND tipo="mision" 
		    		AND id='.$mision->getIdMision().' 
		    		AND idGalaxia='.$mision->getIdGalaxiaDestino().' 
		    		AND idPlaneta='.$mision->getIdPlanetaDestino()
	    	);
	    }
	    
	    public function terminarMision($mision)
	    {
	    	//Finalizo la mision
	    	$mision->terminarMision();
	    }
	    
	    public function rollback(){
	    	$this->db->rollback();
	    }
	    
	    public function commit(){
	    	System_Daemon::info('-Guardando cambios');
	    	$this->db->commit();
	    }

		public function connect(){
	    	$this->db->connect();
	    }
		
		public function close(){
	    	$this->db->close();
	    }
		
		public function change_user(){
	    	$this->db->change_user($_ENV['config']->get( 'dbUser' ),$_ENV['config']->get( 'dbPass' ),$_ENV['config']->get( 'dbName' ));
	    }
	}
?>
