<?php

/**
 * Controlador principal por el que pasan todos los
 * datos
 *
 * @author David & Jose
 * @package libs
 * @since 26/01/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * Clase base para la creacion de controladores
 * @author David & Jose
 * @since 27/01/2009
 */
include('../libs/ControllerBase.php');

/**
 * Clase base para la creacion de modelos
 * @author David & Jose
 * @since 27/01/2009
 */
include('../libs/ModelBase.php');

/**
 * Clase que se encarga de asignar las variables en
 * las vistas y devolver el HTML formateado
 *
 * @author David & Jose
 * @since 21/01/2009
 */
include('../libs/ViewBase.php');

/**
 * Clase con variadas funciones para dar soporte.
 * @author David & Jose
 * @since 27/01/2009
 */
include('../libs/Funciones.php');

/**
 * Permite la carga dinamica de clases
 *
 * @author David & Jose
 * @since 27/01/2009
 */
include('../libs/LazyLoad.php');

/**
 * Controlador principal por el que pasan todos los
 * datos
 *
 * @access public
 * @author David & Jose
 * @package libs
 * @since 26/01/2009
 */
class MainController
	extends ControllerBase
{
    /**
     * Metodo principal
     *
     * @access public
     * @author David & Jose
     * @since 26/01/2009
     */
    public function main()
    {
        //Comprobamos que el proceso del juego esta corriendo
        $existe=exec('pgrep php');

        if (!$existe) {
            //Si no esta corriendo deslogueamos
    		session_destroy();
			echo 'Se ha producido un error grave en el juego, comuniqueselo a los administradores.';
    		//header('Location: '.$_ENV['config']->get('urlLogin'));
			exit;
        }
		
		//Limpiamos el array de entrada
		$sanitize = new Filter();
		$sanitize->clean($_REQUEST);
		unset($sanitize);

		/***************************************
		 * ELECCION DE CONTROLADOR Y ACCION
		 ***************************************/
		if(empty($_REQUEST['controlador'])){
			$controller = $_ENV['config']->get('defaultController');
		}
		else{
			$controller = $_REQUEST['controlador'];
		}
 
		//Elegimos la accion a ejecutar
		if(empty($_REQUEST['accion'])){
			$action = $_ENV['config']->get('defaultAction');
		}
		else{
			$action = $_REQUEST['accion'];
		}
		
		/***************************************
		 * LOG DE ACCIONES
		 ***************************************/
		//$_ENV['log']= new Log($_ENV['config']->get('logPath').date('dmY', $_SERVER['REQUEST_TIME']));
		//$_ENV['log']->write(array(@$_SESSION['infoJugador']['idUsuario'],$_SERVER['REMOTE_ADDR'],$_SERVER['REQUEST_METHOD'],@$_SERVER['HTTP_REFERER'],@$_SERVER['HTTP_USER_AGENT'],$_SERVER['REQUEST_TIME'],ACCION,$_SERVER['QUERY_STRING'],file_get_contents('php://input')));
		
		/*************************************************
		 * COMPRUEBA QUE ESTE LOGEADO
		 *************************************************/
    	if(!($controller != $_ENV['config']->get('authController') && $action != $_ENV['config']->get('authLogin'))){
	    	//Ejecuto la autenticacion
    		$this->executeController($controller, $action);
	    	
	    	//Indico el controlador y accion iniciales
	    	$controller = $_ENV['config']->get('defaultController');
	    	$action = $_ENV['config']->get('defaultAction');
    	}
    	
    	//Compruebo realmente si estoy autenticado o si lo estoy y tengo la proteccion de ip activada, que conserve la IP
    	if(!array_key_exists('infoJugador', $_SESSION) || ($_SESSION['infoJugador']['proteccionIP'] && $_SESSION['infoJugador']['ip']!=$_SERVER['REMOTE_ADDR'])){
    		//Si la sesion es robada, se destruye y se redirige al login
    		session_destroy();
    		header('Location: '.$_ENV['config']->get('urlLogin'));
			exit;
    	}

    	/********************************************
    	 * JUGADOR BANEADO DEL JUEGO
    	 ********************************************/
		if($_SESSION['infoJugador']['bloqueado']!='' && $_SESSION['infoJugador']['bloqueado'] > $_SERVER['REQUEST_TIME']){
			$controller=$_ENV['config']->get('defaultController');
			$action='bloqueado';
			
			//Si estoy bloqueado no hace falta resumir los eventos
			$this->executeController($controller, $action);
			exit;
		}

		/*********************************************
		 * JUGADOR EN MODO VACACIONES
		 *********************************************/
		elseif($_SESSION['infoJugador']['vacaciones']!='' && ($controller!='Opciones' || $action!='quitarVacaciones')){
			$controller=$_ENV['config']->get('defaultController');
			$action='vacaciones';
			
			//Si estoy de vacaciones no hace falta resumir los eventos
			$this->executeController($controller, $action);
			exit;
		}
		
		/***********************************************
		 * ACTUALIZO LA SESSION Y EL JS
		 ***********************************************/
		//Actualizamos los recursos del jugador
	    $recursos = new RecursosModel();

	    //Inicializamos el array
		$infoJugador = Array();

		$producciones = $recursos->obtenerProduccion($_SESSION['infoJugador']['idUsuario']);
		$infoJugador[0]['produccion']=$producciones['produccionPrimario'];
		$infoJugador[1]['produccion']=$producciones['produccionSecundario'];
		
		$resumirModel = new ResumirEventosModel();

		$resumirModel->actualizarRecursos($_SESSION['infoJugador']['idUsuario'], time()-$resumirModel->ultimaActualizacion($_SESSION['infoJugador']['idUsuario']), $infoJugador);
		$resumirModel->actualizarTiempo($_SESSION['infoJugador']['idUsuario'], time());
		 
		//Cargamos todos los datos secundarios del usuario en sesion
		$info = new InfoJugadorModel();

		//Cargando tabla jugadorInfoGeneral
		list($_SESSION['infoJugador']['investigacionVelocidad'], $_SESSION['infoJugador']['construccionVelocidad'], $_SESSION['infoJugador']['numeroMensajes'], $_SESSION['infoUnidades']['limiteMisiones'], 
		$_SESSION['infoUnidades']['numNaves'], $_SESSION['infoUnidades']['numSoldados'], $_SESSION['infoUnidades']['limiteSoldados'], 
		$_SESSION['infoUnidades']['numDefensas'], $_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'],
		$_SESSION['infoRecursos'][2]['produccion']) = $info->infoGeneral($_SESSION['infoJugador']['idUsuario']);
		
		//Actualizamos la alianza
		list($_SESSION['infoJugador']['idAlianza']) = $info->infoAlianza($_SESSION['infoJugador']['idUsuario']);
		
		//Volcamos las cantidades de recursos a la sesion
		if(array_key_exists(0, $_SESSION['infoRecursos']) && array_key_exists(1, $_SESSION['infoRecursos']) && array_key_exists(2, $_SESSION['infoRecursos'])){
			list($_SESSION['infoRecursos'][0]['cantidad'],$_SESSION['infoRecursos'][1]['cantidad'],$_SESSION['infoRecursos'][2]['cantidad']) = $info->cantidadRecursos($_SESSION['infoJugador']['idUsuario']);
		}

		//Cargando tabla jugadorInfoUnidades
		$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);

		//Actualizo las mejoras para las unidades en sesion
        list($_SESSION['infoUnidades']['soldadosCarga'], $_SESSION['infoUnidades']['soldadosAtaque'], $_SESSION['infoUnidades']['soldadosResistencia'],
        $_SESSION['infoUnidades']['soldadosEscudo'], $_SESSION['infoUnidades']['navesCarga'], $_SESSION['infoUnidades']['navesAtaque'],
        $_SESSION['infoUnidades']['navesResistencia'], $_SESSION['infoUnidades']['navesEscudo'], $_SESSION['infoUnidades']['navesVelocidad'],
        $_SESSION['infoUnidades']['defensasAtaque'], $_SESSION['infoUnidades']['defensasResistencia'], $_SESSION['infoUnidades']['defensasEscudo'],
        $_SESSION['infoUnidades']['invisible'], $_SESSION['infoUnidades']['atraviesaIris'], $_SESSION['infoUnidades']['viajeIntergalactico'], 
        $_SESSION['infoUnidades']['stargateIntergalactico']) = $info->infoUnidades($_SESSION['infoJugador']['idUsuario']);

		//Actualizo el JS
		//Comprobamos si es la carga inicial de la web
		$cargaInicial = $controller==$_ENV['config']->get('defaultController') && $action==$_ENV['config']->get('defaultAction');
		
		#Genera una vista para actualizar el contenido de las variables javascript del cliente, en caso de que
		#se tenga uqe actualizar el javascript y no se trate de la carga inicial de la pagina
    	if(!$cargaInicial){
			//Refrescamos la lista de planetas por si hemos eliminado uno
			$planetaModel=new PlanetaModel();
	        $planetasPropios=$planetaModel->planetasUsuario($_SESSION['infoJugador']['idUsuario']);

    		//Refrescamos el JS
    		$this->view = new ResumirEventosView();
    		$this->view->actualizarJS($_SESSION['infoRecursos'], $planetasPropios,$_SESSION['infoJugador']['galaxiaSel'],$_SESSION['infoJugador']['planetaSel']);
    	}
					
		/***********************************************
		 * Ejecuto la accion del controlador
		 ***********************************************/		
		$this->executeController($controller, $action);
    }
}
?>