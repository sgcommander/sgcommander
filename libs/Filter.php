<?php

/**
 * Recibe una matriz a la cual le aplica los filtros
 * especificos para evitar la mayoria de inyecciones
 *
 * @author David & Jose
 * @package libs
 * @since 27/01/2009
 */

/**
 * Recibe una matriz a la cual le aplica los filtros
 * especificos para evitar la mayoria de inyecciones
 *
 * @access public
 * @author David & Jose
 * @package libs
 * @since 27/01/2009
 */
class Filter{
    /**
     * Lista de equivalencias entre entidades
     * html y xhtml
     *
     * @access private
     * @since 16/01/2010
     * @var Integer
     */
    private static $xhtmlTable = null;


    /**
     * Constructor de la clase
     *
     * @access public
     * @author David & Jose
     * @param  Integer arreglo
     * @since 27/01/2009
     */
    public function __construct(&$variable = NULL){
		//Cargo las tablas XHTML
    	$this->loadXHTMLTables();
    }

    /**
     * Filtro para configuracion sin magic_quotes
     *
     * @access private
     * @author David & Jose
     * @param  String valor
     * @return mixed
     * @since 27/01/2009
     */
    public function clean(&$variable){
    	//Comprobamos que la tabla de simbolos no sea nula
    	if(self::$xhtmlTable){
	        //Si el valor no es una matriz, asegura las variables
	        if(!is_array($variable)){
				$variable = addslashes($this->xhtmlEntities(trim($variable)));
	
			//Si no es ni vector ni objeto, se llama a asegurar para que asegure el array
	    	}elseif(!is_object($variable)){
				foreach($variable AS &$val){
	        		$this->clean($val);
				}
			}
		}
    }

    /**
     * Sustituye en una cadena por la entidades de
     * xhtml
     *
     * @access public
     * @author David & Jose
     * @param  String cadena
     * @return mixed
     * @since 16/01/2010
     */
    private function xhtmlEntities($cadena){
       	return strtr($cadena, self::$xhtmlTable);
    }

    /**
     * Carga las tablas XHTML para poder realizar el parser
     */
    private function loadXHTMLTables(){
    	//Extraigo la tabla de la cache
    	self::$xhtmlTable = apc_fetch('Filter_xhtml_table', $cached);

    	//Si no estaba en cache, la genero ahora
    	if(!$cached){
    		$this->generateXTMLTables();
    	}
    }

    /**
     * Genera las tablas de sustitucion para xhtml en vez de html
     *
     * @return unknown_type
     */
    private function generateXTMLTables(){

    	//Recorro todas las traducciones de htmlentities para generar un vector con entidades xhtml.
    	foreach (get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES, 'UTF-8') as $character => $entity) {

    		//Las entidades XHTML son los caracteres &# seguidos del numero que representa dicho caracter
    		self::$xhtmlTable[$character] = '&#' . ord($character) . ';';
        }
        
        //Almaceno la tabla en cache, para evitar tenerla que generar cada vez
        apc_add('Filter_xhtml_table', self::$xhtmlTable);
    }

}

?>