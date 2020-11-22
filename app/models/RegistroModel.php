<?php
	/**
	 * Gestiona los datos de registro de nuevo usuario
	 *
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */
	
	
	
	/**
	 * Gestiona los datos de registro de nuevo usuario
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */
	class RegistroModel
	    extends ModelBase
	{
	    /**
	     * Da de alta un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer usuario
	     * @param  Integer pass
	     * @param  Integer email
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function registro($usuario, $pass, $email, $idRaza)
	    {
			//Generamos un token para validacion por correo
			$correoConfirmacion = $_ENV['config']->get('correoConfirmacion');
			if($correoConfirmacion) {
				$token = sha1(md5(microtime().$_ENV['config']->get('secretWordToken').$usuario));
			} else {
				$token = null;
			}
	    	
	    	
	    	//Enviamos el correo de confirmacion
	    	$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
	    	$message.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
	    	$message.='<title>Stargate Galactic Commander</title><link rel="shortcut icon" href="favicon.ico" /></head>';
	    	$message.='<body style="background-repeat:no-repeat; background-image: url(\'http://img851.imageshack.us/img851/3546/fondok.jpg\');">';
	    	$message.='<div style="width:520px;height:194px;padding:20px;margin-top:125px;margin-left:109px;"><p>Bienvenido comandante,</p><p>Para confirmar su cuenta de Stargate Galactic Commander solo tiene que hacer click en el siguiente enlace en las 24 horas siguientes a su registro:</p>';
			$message.='<a href="'.$_ENV['config']->get('urlServidor').'/registro.php?controlador=Registro&accion=confirmar&token='.$token.'">'.$_ENV['config']->get('urlServidor').'/registro.php?controlador=Registro&accion=confirmar&token='.$token.'</a>';
	    	$message.='</div></body></html>';

			//Preparamos las cabeceras
			$headers = 'From: ' . $_ENV['config']->get('emailRegistro') . "\r\n";
		   	$headers .= 'Reply-To: ' . $_ENV['config']->get('emailRegistro') . "\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			
			//Enviamos el correo
			if(!$correoConfirmacion || mail($email, 'Stargate Galactic Commander: Confirmación de cuenta', $message, $headers)){
				//Insertamos el usuario
		        $this->db->query('INSERT INTO usuario (nombre, pass, email, valido)
		        								VALUES (\''.$usuario.'\', \''.hash('sha256', $pass).'\', \''.$email.'\', \''.$token.'\')');
		        
		        $id=$this->db->insert_id;
		        
		        //Insertamos el jugador
		        $this->db->query('INSERT INTO jugador (idUsuario, idRaza)
		        								VALUES (LAST_INSERT_ID(), \''.$idRaza.'\')');
				$errorCorreo=false;
			}    
			else{
				$errorCorreo=true;
			}
	        
			if($this->db->errno==0 && !$errorCorreo)
	        	return $id;
	        else
	        	return 0;
	    }
	
	    /**
	     * Devuelve TRUE si el usuario existe en la BBDD.
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer usuario
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function comprobarUsuario($usuario)
	    {
	        
	        $consulta=false;
	        $consulta = $this->db->query(
						'SELECT id 
						FROM usuario 
						WHERE UPPER(nombre)=\''.strtoupper($usuario).'\' 
						LIMIT 1');
	        
	        $datos=$consulta->num_rows;
	        
	        //Elimina el resultado de la consulta
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve TRUE si el email existe en la BBDD.
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer email
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function comprobarEmail($email)
	    {
	        
	        $consulta=false;
	        $consulta = $this->db->query(
						'SELECT id 
						FROM usuario 
						WHERE email=\''.$email.'\' 
						LIMIT 1');
	        
	        $datos=$consulta->num_rows;
	        
	        //Elimina el resultado de la consulta
	        $consulta->close();
	        
			return $datos;
	        
	    }
	    
		/**
	     * Devuelve TRUE si el token existe
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer email
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function comprobarToken($token)
	    {
	        $consulta = $this->db->query(
						'SELECT id 
						FROM usuario 
						WHERE valido=\''.$token.'\' 
						LIMIT 1');
	        
	        if($consulta->num_rows)
	        	list($id)=$consulta->fetch_row();
	        else
	        	$id=false;
	        
	        //Elimina el resultado de la consulta
	        $consulta->close();
	        
			return $id;
	        
	    }
	    
		/**
	     * Devuelve el numero de usuarios
	     * sel servidor
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @return mixed
	     * @since 02/12/2009
	     */
	    public function numUsuarios()
	    {
	        
			$consulta = $this->db->query(
	        			'SELECT count(*) AS numUsuarios
						FROM usuario 
						LIMIT 1');
	
	        list($numUsuarios)=$consulta->fetch_row();
	        
	        $consulta->close();
	        
			return $numUsuarios;
	        
	    }
	    
		/**
	     * Confirma un usuario
	     *
	     * @access public
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function confirmar($id, $token)
	    {
			//Confirmamos el usuario
	        $this->db->query('UPDATE usuario SET valido = NULL 
	        				WHERE id=\''.$id.'\' 
	        				AND valido=\''.$token.'\'');
	       
			return $this->db->errno==0;
	    }
	
	}
?>