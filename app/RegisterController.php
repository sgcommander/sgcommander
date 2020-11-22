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
 * Recibe una matriz a la cual le aplica los filtros
 * especificos para evitar la mayoria de inyecciones
 *
 * @author David & Jose
 * @since 27/01/2009
 */
include('../libs/Filter.php');

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
 * datos de registro
 *
 * @access public
 * @author David & Jose
 * @package libs
 * @since 26/01/2009
 */
class RegisterController
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
        
		//Limpiamos el array de entrada
		$filter = new Filter();
		$filter->clean($_REQUEST);
		unset($filter);

		/***************************************
		 * INTERNACIONALIZACION
		 ***************************************/
		//Idioma elegido
		setlocale(LC_ALL, $_ENV['config']->get('lang').'.UTF-8');

		//Eleccion del dominio
		bindtextdomain($_ENV['config']->get('moFile'), "lang");
		textdomain($_ENV['config']->get('moFile'));
		bind_textdomain_codeset($_ENV['config']->get('moFile'), 'UTF-8'); //Codificacion en UTF-8

		/***************************************
		 * ELECCION DE CONTROLADOR Y ACCION
		 ***************************************/
		$controller = $_ENV['config']->get('registroController');
 
		//Elegimos la accion a ejecutar
		if(empty($_REQUEST['accion'])){
			$action = $_ENV['config']->get('registroAction');
		}
		else{
			$action = $_REQUEST['accion'];
		}

		/***********************************************
		 * Ejecuto la accion del controlador
		 ***********************************************/		
		$this->executeController($controller, $action);
    }
}
?>