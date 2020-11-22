<?php
	/**
	 * Modelo que gestiona la información
	 * de opciones
	 *
	 * @author David & Jose
	 * @package models
	 * @since 28/09/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de opciones
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 28/09/2009
	 */
	class OpcionesModel
	    extends ModelBase
	{
	    /**
	     * Actualiza los datos
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  String pass
	     * @param  String email
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function cambiarDatos($idJugador, $pass, $email)
	    {
	        
	        $sql='UPDATE usuario SET email=\''.$email.'\'';
	        //Si no se cambia la contrasena solo se cambia el mail
	        if($pass!='')
	        	$sql.= ',pass=\''.hash('sha256', $pass).'\'';
	        $sql.='WHERE id=\''.$idJugador.'\'';
	
	        //Ejecutmaos la consulta
	        $this->db->query($sql);
	    	return $this->db->errno==0;
	        
	    }
	    
		/**
	     * Cambiar idioma
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  String pass
	     * @param  String email
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function cambiarIdioma($idJugador, $idioma)
	    {
	        
	        $sql='UPDATE usuario SET idIdioma=\''.$idioma.'\' 
	        		WHERE id=\''.$idJugador.'\'';
	
	        //Ejecutmaos la consulta
	        $this->db->query($sql);
	    	return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Activa el modo vacaciones
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function vacaciones($idJugador)
	    {
	        
	        $sql='UPDATE jugador SET vacaciones=TIMESTAMPADD(SECOND,'.$_ENV['config']->get('tiempoVacaciones').',NOW()) 
	        		WHERE idUsuario=\''.$idJugador.'\'';
	
	        //Ejecutamos la consulta
	        $this->db->query($sql);
	        
	    	return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Borra una cuenta
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 28/09/2009
	     */
	    public function borrar($idJugador, $firma)
	    {
	        
	        //Obtengo el planeta principal del usuario
	    	$consulta = $this->db->query('
	        	SELECT idPlaneta, idGalaxia
	        	FROM planetaColonizado
	        	WHERE idJugador=\''.$idJugador.'\' AND principal
	        	LIMIT 1
	        ');
	    
	        list($idPlaneta, $idGalaxia) = $consulta->fetch_row();
	
	        //Eliminamos la cuenta del usuario
	        $this->db->query('DELETE FROM usuario WHERE id=\''.$idJugador.'\'');
	
	        //Cambiamos el porcentaje del planeta principal y eliminamos el nombre
	        $porcentaje = Array(10,20,30,40,60,70,80,90,100);
	        $this->db->query('
	        	UPDATE planeta
	        	SET nombrePlaneta=\'\', riqueza =\''.$porcentaje[mt_rand(0,count($porcentaje)-1)].'\' 
	        	WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
	        ');
	        
	        //Actualizamos los planetas explorados
	    	$this->db->query('
		       	UPDATE planetaExplorado
		       	SET idPropietario=NULL 
		       	WHERE idPropietario=\''.$idJugador.'\'
	        ');
	        
	        //Elimino los posibles nombres de planeta de los planetas que tenia colonizados
	    	$consulta = $this->db->query('
	        	SELECT pc.idPlaneta, pc.idGalaxia
	        	FROM planetaColonizado AS pc LEFT JOIN planetaEspecial AS pe ON (pe.idGalaxia=pc.idGalaxia AND pe.idPlanetaEsp=pc.idPlaneta)
	        	WHERE idJugador=\''.$idJugador.'\' AND NOT principal AND pe.idGalaxia IS NULL
	        	LIMIT 1;
	        ');
	    
	    	while($row = $consulta->fetch_assoc()){
	    		//Actualizamos el nombre
	    		$this->db->query('
		        	UPDATE planeta
		        	SET nombrePlaneta=\'\' 
		        	WHERE idGalaxia=\''.$row['idGalaxia'].'\' AND idPlaneta=\''.$row['idPlaneta'].'\'
	        	');
	    	}
	    
	    	//Elimino la firma del usuario
	    	if(file_exists($firma)){
	    		unlink($firma);
	    	}
	        
	    	return $this->db->errno==0;
	    }
	
	    /**
	     * Devuelve el email de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 29/09/2009
	     */
	    public function email($idJugador)
	    {
	        
	        $consulta = $this->db->query(
	        			'SELECT email
						FROM usuario
						WHERE id=\''.$idJugador.'\' LIMIT 1');
	
	        list($email)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $email;
	        
	    }
	
	    /**
	     * Desactiva el modo vacaciones
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function quitarVacaciones($idJugador)
	    {
	        
	        $sql='UPDATE jugador SET vacaciones=NULL 
	        		WHERE idUsuario=\''.$idJugador.'\'';
	
	        //Ejecutamos la consulta
	        $this->db->query($sql);
	        
	    	return $this->db->errno==0;
	        
	    }
	    
		/**
	     * Devuelve los idiomas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 25/07/2010
	     */
	    public function idiomas()
	    {
	        $consulta = $this->db->query(
						'SELECT id, nombre, codigo
						FROM idioma 
						ORDER BY nombre');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	    }
	    
	    /**
	     * Activa/Desactiva la proteccion IP sobre la cuenta del jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 14/01/2011
	     */
	    public function cambiarProteccionIP($idJugador){
	    	$this->db->query(
	    		'UPDATE usuario
	    		 SET proteccionIP = NOT proteccionIP
	    		 WHERE id=\''.$idJugador.'\''
	    	);
	    }
	
	}
?>