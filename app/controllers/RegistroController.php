<?php
	/**
	 * Controlador de registro
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 02/02/2009
	 */

	

	/**
	 * Controlador de registro
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 02/02/2009
	 */
	class RegistroController
	    extends ControllerBase
	{
		/**
	     * Da de alta un nuevo usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function registro()
	    {
	        //Creamos una instancia del modelo de acceso
			$registro = new RegistroModel();
	        
	    	if(empty($_REQUEST['email']) || !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_REQUEST['email']))
				$error=1;
			elseif($registro->comprobarEmail($_REQUEST['email']))
				$error=2;
			elseif(empty($_REQUEST['usuario']) || !preg_match('/^[a-z\d_]{'.$_ENV['config']->get('minUser').','.$_ENV['config']->get('maxUser').'}$/i', $_REQUEST['usuario']))
				$error=3;
			elseif(empty($_REQUEST['pass']) || mb_strlen($_REQUEST['pass'], 'UTF-8')>$_ENV['config']->get('maxPass') || mb_strlen($_REQUEST['pass'], 'UTF-8')<$_ENV['config']->get('minPass'))
				$error=4;
			elseif($registro->comprobarUsuario($_REQUEST['usuario']))
				$error=5;
			elseif(empty($_REQUEST['idRaza']))
				$error=7;
			elseif($registro->numUsuarios() >= $_ENV['config']->get('maxUsuarios'))
				$error=8;
			else{
				$id=$registro->registro($_REQUEST['usuario'],$_REQUEST['pass'],$_REQUEST['email'],$_REQUEST['idRaza']);
		   		if($id){
		   			$error=0;
		   
		   			//Generamos la firma
		   			$firma=new Firma();
	        		$firma->generar($id);
		   		}
		   		else
		   			$error=6;
			}

			//Mostramos el resultado
			echo $error;
	        
	   	}

	    /**
	     * Indica si un nombre de usuario ya existe o no
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function comprobarUsuario()
	    {
	        //Creamos una instancia del modelo de acceso
			$registro = new RegistroModel();
			$datos=$registro->comprobarUsuario($_REQUEST['usuario']);

			//Mostramos el resultado
			echo $datos;
	        
	    }
	    
		/**
	     * Confirma una cuenta a traves de un token
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 24/07/2010
	     */
	    public function confirmar()
	    {
	        //Creamos una instancia del modelo de acceso
			$registro = new RegistroModel();
			
			$id=$registro->comprobarToken($_REQUEST['token']);
			
			if($id){
				if($registro->confirmar($id, $_REQUEST['token']))
					echo 'Tu cuenta ha sido confirmada';
				else
					echo 'Error al validar la cuenta';
			}
			else{
				echo 'Este enlace ha caducado o la cuenta ha sido borrada';
			}
	        
	    }

	}

?>