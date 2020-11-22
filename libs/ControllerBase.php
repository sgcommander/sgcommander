<?php

/**
 * Controlador base del que heredan el resto de
 * controladores
 *
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */

/**
 * Controlador base del que heredan el resto de
 * controladores
 *
 * @abstract
 * @access public
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */
abstract class ControllerBase
{
    
    // generateAssociationEnd : ControllerBase

    

    /**
     * Vista del controlador
     *
     * @access protected
     * @since 23/01/2006
     */
    protected $view = null;
    protected $model = null;
    
    /**
     * comrpeuba que el controlador y la accion sean correctas
     * 
     * @param $controlador
     * @param $accion
     * @return unknown_type
     */
    public function testController($controllerName, $action){
    	$controllerPath = $_ENV['config']->get('appPath').$_ENV['config']->get('controllerPath').$controllerName.'.php';
    	
    	//Compruebo que el contolador exista
		if(!is_file($controllerPath)){
			trigger_error(_('El controlador no existe - 404 not found'), E_USER_ERROR);
		}

		//Si no existe la clase que buscamos y su accion, tiramos un error 404
		if (!method_exists($controllerName, $action)) 
		{
			trigger_error ($controllerName . '->' . $action . '` no existe', E_USER_ERROR);
		}
    }
    
    /**
     * Ejecuta la accion de un controlador
     * 
     * @param $controlador
     * @param $accion
     * @return unknown_type
     */
    public function executeController($controller, $action = NULL){
    	//Formamos el nombre del fichero del controlador
    	$controllerName = $controller.$_ENV['config']->get('sufixController');
    	
    	//Si la accion no esta definida, ejecuto la de por defecto
    	if(empty($action)){
    		$action = $_ENV['config']->get('defaultAction');
    	}
    	
    	$this->testController($controllerName, $action);
    	
    	//Si el controlador y la accion es correcta, paso a su ejecucion
		$controller = new $controllerName();
		$controller->$action();
    }
}

?>