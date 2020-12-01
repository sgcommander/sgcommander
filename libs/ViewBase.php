<?php

/**
 * Clase que se encarga de asignar las variables en
 * las vistas y devolver el HTML formateado
 *
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */

/**
 * Clase que se encarga de asignar las variables en
 * las vistas y devolver el HTML formateado
 *
 * @abstract
 * @access public
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */
abstract class ViewBase
{
    /**
     * Plantilla de la vista
     *
     * @access protected
     * @since 27/01/2009
     */
    protected $tpl = null;

    

    /**
     * Constructor de la clase
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 09/01/2009
     */
    public function __construct($header = true)
    {
    	//Modifico la configuracion a la configuracion particular del usuario
    	if(!empty($_SESSION['infoJugador']['lang'])) {
        $_ENV['config']->set(array('lang' => $_SESSION['infoJugador']['lang']));
      }
    	
      /***************************************
       * INTERNACIONALIZACION
       ***************************************/
      //Idioma elegido
      setlocale(LC_ALL, $_ENV['config']->get('lang').'.UTF-8');

      //Eleccion del dominio
      bindtextdomain($_ENV['config']->get('moFile'), "lang");
      textdomain($_ENV['config']->get('moFile'));
      bind_textdomain_codeset($_ENV['config']->get('moFile'), 'UTF-8'); //Codificacion en UTF-8
        
      //Indicamos la ruta de las plantillas
      $this->tpl = new HTML_Template_Sigma($_ENV['config']->get('tplPath'), $_ENV['config']->get('tplCachePath'));

      //No errors are expected to happen here
      $this->tpl->setErrorHandling(PEAR_ERROR_DIE);
      
      //Set output encoding to UTF-8
      if($header) {
        header('Content-Type: text/html; charset=utf-8');
      }
    }

    /**
     * Actualiza el JS de los recursos a peticion
     * de una vista
     *
     * @access protected
     * @author David & Jose
     * @param  Integer primario
     * @param  Integer secundario
     * @param  Integer energia
     * @return mixed
     * @since 15/01/2009
     */
    protected function actualizarRecursos($primario, $secundario, $energia = null)
    {
      //Cargamos la plantilla
      $this->tpl->loadTemplateFile('actualizarRecursos.tpl');

      if($primario!=null)
        $this->tpl->setVariable('RECURSOPRICANT',$primario);
      if($secundario!=null)
        $this->tpl->setVariable('RECURSOSECCANT',$secundario);
      if($energia!=null)
        $this->tpl->setVariable('RECURSOENECANT',$energia);

      //Finalmente, mostramos la plantilla.
      $this->tpl->show();
    }

    /**
     * Actualiza el JS de las producciones a peticion
     * de una vista
     *
     * @access protected
     * @author David & Jose
     * @param  Integer primario
     * @param  Integer secundario
     * @param  Integer energia
     * @return mixed
     * @since 15/01/2010
     */
    protected function actualizarProducciones($primario, $secundario = null, $energia = null)
    {
      //Cargamos la plantilla
      $this->tpl->loadTemplateFile('actualizarProducciones.tpl');

      if($primario!=null)
        $this->tpl->setVariable('RECURSOPRIPRO',$primario);
      if($secundario!=null)
        $this->tpl->setVariable('RECURSOSECPRO',$secundario);
      if($energia!=null)
        $this->tpl->setVariable('RECURSOENEPRO',$energia);

      //Finalmente, mostramos la plantilla.
      $this->tpl->show();
    }

    /**
     * Actualiza la lista desplegable de planetas
     *
     * @access public
     * @author David & Jose
     * @param  Integer planetas
     * @param  Integer idGalaxiaSel
     * @param  Integer idPlanetaSel
     * @return mixed
     * @since 14/04/2010
     */
    public function actualizarPlanetas($planetas, $idGalaxiaSel, $idPlanetaSel)
    {
      //Cargamos la plantilla
      $this->tpl->loadTemplateFile('actualizarPlanetas.tpl');

          //Lista de planetas
      $this->tpl->setVariable('_SELECCIONAPLANETA',_('Seleccionar Planeta'));
      $this->tpl->setCurrentBlock('tPlaneta');
      $refrescarSeleccionado=true;
        foreach($planetas as $planeta){
          if($planeta['idGalaxia']!=$idGalaxiaSel || $planeta['idPlaneta']!=$idPlanetaSel){
          if($planeta['nombrePlaneta']=='')
            $this->tpl->setVariable('PNOMBRELST',$planeta['nombreSGC']);
          else
            $this->tpl->setVariable('PNOMBRELST',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
              $datosplaneta=$planeta['idGalaxia'].'|'.$planeta['idPlaneta'].'|'.$_ENV['config']->get('planetaImgFolder').$planeta['imagen'];
              $this->tpl->setVariable('DATOSPLANETALST',$datosplaneta);
            $this->tpl->parseCurrentBlock();
          }
          else{
            $refrescarSeleccionado=false;
          }
      }

      //Si el seleccionado ya no nos pertenece lo refrescamos
      if($refrescarSeleccionado && array_key_exists(0, $planetas)){
        $datosplaneta=$planetas[0]['idGalaxia'].'|'.$planetas[0]['idPlaneta'].'|'.$_ENV['config']->get('planetaImgFolder').$planetas[0]['imagen'];
        $this->tpl->setVariable('DATOSPLANETASEL',$datosplaneta);
        $this->tpl->touchBlock('tSeleccionado');
      }
      else
        $this->tpl->hideBlock('tSeleccionado');

      //Finalmente, mostramos la plantilla.
      $this->tpl->show();
    }

} /* end of abstract class View */

?>