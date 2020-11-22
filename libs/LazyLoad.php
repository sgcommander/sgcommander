<?php
	/**
	 * Permite la carga dinamica de clases sin encesidad de
	 * realizar require_once a mano.
	 */
	function LazyLoad($className){
		//Si es un modelo estara en la carpeta de moles
		if(strpos($className, 'Model'))
			require_once(dirname(__FILE__).'/'.$_ENV['config']->get('appPath').$_ENV['config']->get('modelPath').$className.'.php');

		//Si la clase es un controlador, estara en la carpeta de controladores
		elseif(strpos($className, 'Controller'))
			require_once(dirname(__FILE__).'/'.$_ENV['config']->get('appPath').$_ENV['config']->get('controllerPath').$className.'.php');
			
		//y si es una vista, estara en la carpeta de vistas
		elseif(strpos($className, 'View'))
			require_once(dirname(__FILE__).'/'.$_ENV['config']->get('appPath').$_ENV['config']->get('viewPath').$className.'.php');
		//Si no es que es una libreria
		else
			require_once(dirname(__FILE__).'/'.$className.'.php');
	}
	
	spl_autoload_register('LazyLoad');
?>