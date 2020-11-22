<?php
	/**
	 * Controlador de acceso
	 *
	 * @author David & Jose
	 * @package controllers
	 * @since 02/02/2009
	 */

	

	/**
	 * Controlador de acceso
	 *
	 * @access public
	 * @author David & Jose
	 * @package controllers
	 * @since 02/02/2009
	 */
	class AccesoController
	    extends ControllerBase
	{
	    /**
	     * Recoge los datos de login, comprueba y redirige
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 02/02/2009
	     */
	    public function login()
	    {	        
	        //Se comprueba si se quiere hacer login
			if(! empty($_REQUEST['usuario']) && ! empty($_REQUEST['pass'])){
				//Creamos una instancia del modelo de acceso
				$acceso = new AccesoModel();
				$datos=$acceso->comprobar($_REQUEST['usuario'], $_REQUEST['pass']);

				if(count($datos)){
					$sesionActual = session_id();//Sesion actual
					session_destroy();

					//Eliminamos la sesion anterior (si existe) y la marcamos como expulsada
					if(mb_strlen($datos['sessId'], 'UTF-8')){
						session_id($datos['sessId']);
						session_start();
						$_SESSION = array();
						$_SESSION['expulsado']=True;
						session_destroy();
						session_commit();
					}

					//Volvemos a la sesion inicial
					session_id($sesionActual);
					session_start();

					//Creamos las variables de sesion
					$_SESSION['expulsado']=False;
					$_SESSION['infoJugador']=$datos;
					$_SESSION['infoJugador']['usuario']=$datos['nombre'];
					$_SESSION['infoJugador']['ip']=$_SERVER['REMOTE_ADDR'];//IP del usuario

					//Actualizamos los datos de login
					$acceso->registrarLogin($_SESSION['infoJugador']['idUsuario'], $_SESSION['infoJugador']['ip'], $sesionActual);

					//Cargamos todos los datos secundarios del usuario en sesion
					$info = new InfoJugadorModel();

					//Cargando tabla jugadorInfoGeneral
					list($_SESSION['infoJugador']['investigacionVelocidad'], $_SESSION['infoJugador']['construccionVelocidad'], $_SESSION['infoJugador']['numeroMensajes'], $_SESSION['infoUnidades']['limiteMisiones'], 
					$_SESSION['infoUnidades']['numNaves'], $_SESSION['infoUnidades']['numSoldados'], $_SESSION['infoUnidades']['limiteSoldados'], 
					$_SESSION['infoUnidades']['numDefensas'], $_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'],
					$_SESSION['infoRecursos'][2]['produccion']) = $info->infoGeneral($_SESSION['infoJugador']['idUsuario']);
					

					//Volcamos las cantidades de recursos a la sesion
		    		list($_SESSION['infoRecursos'][0]['cantidad'],$_SESSION['infoRecursos'][1]['cantidad'],$_SESSION['infoRecursos'][2]['cantidad']) = $info->cantidadRecursos($_SESSION['infoJugador']['idUsuario']);

					//Cargando tabla jugadorInfoUnidades
					$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);

					//Actualizo las mejoras para las unidades en sesion
                    list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
                    $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
                    $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
                    $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
                    $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
                    $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);
				}
				else{
					//Si el acceso no ha sido el correcto, volvemos al formulario de acceso
					header('Location: '.$_ENV['config']->get('urlLogin'));
					exit;
				}
			}
			else{
				//Si el acceso no ha sido el correcto, volvemos al formulario de acceso
				header('Location: '.$_ENV['config']->get('urlLogin'));
				exit;				
			}
	    }

	    /**
	     * Termina la sesion de juego
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 02/02/2009
	     */
	    public function logout()
	    {   
			//Destruimos el array de la sesion
			unset($_SESSION);
			//Eliminamos la session con todos sus datos
			session_destroy();
			//Redirigimos a la url inicial
			echo '<script language="javascript">document.location="'.$_ENV['config']->get('urlLogin').'";</script>';
			exit;
	        
	    }
	}

?>