<?php

/**
 * Gestiona los datos de los comercios
 *
 * @author David & Jose
 * @package models
 * @since 13/02/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * Modelo base del que heredan el resto de modelos
 *
 * @author David & Jose
 * @since 21/01/2009
 */
include_once('../libs/ModelBase.php');

/**
 * Gestiona los datos de los comercios
 *
 * @access public
 * @author David & Jose
 * @package models
 * @since 13/02/2009
 */
class MisionViewLib
    extends ViewBase
{
    public function recolectar($primario, $secundario, $riqueza, $unidades, $planeta, $raza, $idJugador){
    	//Cargamos la plantilla
		$this->tpl->loadTemplateFile('reportes/recolectar.tpl');

		//Idioma
		$this->tpl->setVariable('_PLANETAMISION',_('Planeta de la misi&#243;n'));
        $this->tpl->setVariable('PLANETARIQ',$riqueza);
        $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
        if($planeta['nombrePlaneta']==NULL)
        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
        else
        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
       	if($planeta['propietario']==NULL)
       	 	 $this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
        else
        	 $this->tpl->setVariable('PLANETAUSR',$planeta['propietario']);
        if($planeta['alianza']!=NULL)
			$this->tpl->setVariable('PLANETAALZ','('.$planeta['alianza'].')');
		$this->tpl->setVariable('_RECURSOSMISION',_('Recursos ganados'));
		$this->tpl->setVariable('RECURSOPRINOM',$raza['primario']);
		$this->tpl->setVariable('RECURSOSECNOM',$raza['secundario']);
		$this->tpl->setVariable('RECURSOPRIIMG',$_ENV['config']->get('recursoImgFolder').$raza['idRaza'].'/1.png');
		$this->tpl->setVariable('RECURSOSECIMG',$_ENV['config']->get('recursoImgFolder').$raza['idRaza'].'/2.png');
		$this->tpl->setVariable('CANTIDADPRIMARIO',intval($primario));
		$this->tpl->setVariable('CANTIDADSECUNDARIO',intval($secundario));

    	//Dibujamos las coordenadas
        $this->tpl->setCurrentBlock('tDibCoordenadas');
		for ($i=1;$i<=7;$i++) {
			$c=$planeta['coord'.$i];
		    $this->tpl->setVariable('COORD', $c);
		    $this->tpl->setVariable('IDSIMBOLO', $i);
		    $this->tpl->setVariable('IMGCOORD', $_ENV['config']->get('simbolosImgFolder').$planeta['idGalaxia'].'/'.str_pad($c, 2, "0", STR_PAD_LEFT).'.gif');
		    $this->tpl->parseCurrentBlock();
		}

		$this->tpl->setVariable('_UNIDADESMISION',_('Unidades enviadas a la misi&#243;n'));

		//Mostramos las undiades de la mision
    	if(count($unidades)){
			foreach($unidades as $jugador){
				if(count($jugador)){
					foreach($jugador as $unidad){
						if($unidad->getCantidad()>0 && $unidad->getJugador()->soy($idJugador)){
							$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$unidad->getId().'.jpg');
							$this->tpl->setVariable('UNIDAD',$unidad->getNombre());
							$this->tpl->setVariable('_CANTIDAD',_('Cantidad'));
							$this->tpl->setVariable('NUMUNIDAD',$unidad->getCantidad());
							$this->tpl->parse('tUnidad');
						}
					}
				}
			}
		}
		foreach($unidades as $unidad){

		}

		//Generamos el reporte a una variable
        ob_start();
		$this->tpl->show();
		$buffer = ob_get_contents();
    	ob_clean();

		return $buffer;
    }
    
	public function explorar($planeta, $unidadesPlaneta, $idJugador){
    	//Cargamos la plantilla
		$this->tpl->loadTemplateFile('reportes/explorar.tpl');

		//Idioma
		$this->tpl->setVariable('_PLANETAMISION',_('Planeta de la misi&#243;n'));
        $this->tpl->setVariable('PLANETARIQ',$planeta['riqueza']);
        $this->tpl->setVariable('PLANETAIMG',$_ENV['config']->get('planetaImgFolder').$planeta['imagen']);
        if($planeta['nombrePlaneta']==NULL)
        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombreSGC']);
        else
        	 $this->tpl->setVariable('PLANETANOM',$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')');
       	if($planeta['propietario']==NULL)
       	 	 $this->tpl->setVariable('PLANETAUSR',_('Sin propietario'));
        else
        	 $this->tpl->setVariable('PLANETAUSR',$planeta['propietario']);
        if($planeta['alianza']!=NULL)
			$this->tpl->setVariable('PLANETAALZ','('.$planeta['alianza'].')');
		$this->tpl->setVariable('_RECURSOSMISION',_('Recursos ganados'));

    	//Dibujamos las coordenadas
        $this->tpl->setCurrentBlock('tDibCoordenadas');
		for ($i=1;$i<=7;$i++) {
			$c=$planeta['coord'.$i];
		    $this->tpl->setVariable('COORD', $c);
		    $this->tpl->setVariable('IDSIMBOLO', $i);
		    $this->tpl->setVariable('IMGCOORD', $_ENV['config']->get('simbolosImgFolder').$planeta['idGalaxia'].'/'.str_pad($c, 2, "0", STR_PAD_LEFT).'.gif');
		    $this->tpl->parseCurrentBlock();
		}

		$this->tpl->setVariable('_UNIDADESMISION',_('Unidades en el planeta'));

		//Mostramos las undiades de la mision
		if(count($unidadesPlaneta)>1){
			$enMision=true;
			foreach($unidadesPlaneta as $jugador){
				if(count($jugador)){
					foreach($jugador as $unidad){
						//Comprobamos si estan todas en mision
						if($unidad->getJugador()->getId() != $idJugador && $enMision && $unidad->getCantidad()>0)
							$enMision=false;
							
						if($unidad->getCantidad()>0 && !$unidad->getJugador()->soy($idJugador)){
							if($unidad->getInvisible()){
								$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').'0.jpg');
								$this->tpl->setVariable('UNIDAD','?');
								$this->tpl->setVariable('NUMUNIDAD','?');
							}
							else{
								$this->tpl->setVariable('UNIDADIMG',$_ENV['config']->get('unidadImgFolder').$unidad->getId().'.jpg');
								$this->tpl->setVariable('UNIDAD',$unidad->getNombre());
								$this->tpl->setVariable('NUMUNIDAD',$unidad->getCantidad());
							}
							$this->tpl->setVariable('_CANTIDAD',_('Cantidad'));
							$this->tpl->parse('tUnidad');
						}
					}
				}
			}
		}
		
		if(count($unidadesPlaneta)<=1 || $enMision){
			$this->tpl->setVariable('_NOUNIDADES',_('No hay unidades'));
		}

		//Generamos el reporte a una variable
		return $this->tpl->get();;
    }
    
}

?>