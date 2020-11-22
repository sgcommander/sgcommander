<?php

/**
 * Clase que gestiona la finalizacion de misiones
 *
  * @author David & Jose
 * @package libs
 * @since 27/08/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include_once('../libs/ModelBase.php');
include_once('../libs/Mision/MisionModelLib.php');
include_once('../libs/Mision/MisionViewLib.php');
include_once('../libs/Mision/BatallaMision.php');

class Mision
	extends ModelBase
{



	 /**
     * Variable SPDO
     *
     * @access protected
     * @since 26/01/2009
     */
    protected $view = null;
    private $idMision = null;
	private $mision = null;

	/**
	 * Obtiene información de los bandos
	 *
	 * @var BatallaMision
	 */
	private $infoBandos = null;
	private $datos = null;

    /**
     * Constructor de la clase, que permite obtener toda la informacion de la mision
     * y realizar cualquier accion sobre ella
     *
     * @param integer $idJugadorActivo Jugador en sesion
     * @param integer $idMision Identificador de la mision
     * @param integer $tiempoEvento Solo se requiere en el caso de conquistas
     */
    public function Mision($idJugadorActivo, $idMision, $tiempoEvento = NULL){

    	$this->datos = new MisionModelLib();

    	//Creamos la vista de misiones
    	$this->view=new MisionViewLib();

    	//Indica el id de mision a resolver
    	$this->idMision = $idMision;

    	//Indica el tiempo en que nos encontramos en este momento
    	$this->tiempoEvento = $tiempoEvento;

    	//Indica el jugador que ha llamado a la clase mision
    	$this->idJugadorActivo = $idJugadorActivo;

    	//Obtengo los datos de la mision
		$this->mision = $this->datos->obtenerDatosMision($this->idMision);
    }

    public function getIdJugador(){
    	return $this->mision['idJugador'];
    }

    public function exists(){
    	return isset($this->mision);
    }

    public function getIdMision(){
    	return $this->idMision;
    }

    public function getIdPlanetaDestino(){
    	return $this->mision['idPlanetaDestino'];
    }

    public function getIdGalaxiaDestino(){
    	return $this->mision['idGalaxiaDestino'];
    }

	//Esta funcion es la que hace las acciones oportunas en el planeta de destino de la mision (ataque, recolecta...)
	private function resolverMision(){
		//Clasifico el tipo de mision
		switch($this->mision['idTipoMision']){
			case DESPLEGAR:
				$this->desplegar();
				break;
			case ATACAR:
				$this->atacar();
				break;
			case RECOLECTAR:
				$this->recolectar();
				break;
			case EXPLORAR:
				$this->explorar();
				break;
			case CONQUISTAR:
				$this->conquistar();
				break;
			case CONTRATACAR:
				$this->contratacar();
				break;
			case ESTABLECERBASE:
				$this->establecerBase();
				break;
		}
	}

 	public function desplegar()
    {
    	System_Daemon::info('-Terminando mision de desplegar en el planeta %s de la galaxia %s',$this->mision['idPlanetaDestino'],$this->mision['idGalaxiaDestino']);
        if($this->mision['permanente'] && !$this->mision['vuelta']){
        	//Si el jugador es el propietario del planeta, la finalizo (hago el traslado)
        	if($this->datos->esPropietarioPlaneta($this->mision['idJugador'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'])){
        		$this->datos->borrarMision($this->idMision);
        	}
        	//Si era un traslado de defensas, pero ya no es mi planeta, devuelvo la mision de despliegue
        	elseif($this->datos->misionTipo($this->idMision) == DEFENSA){
        		//el desplegar de defensas se comporta como no permanente, ya que las defensas no se pueden
        		//estacionar en planetas neutrales
        		$this->datos->volver($this->idMision, FALSE);
        	}
			//Despliego las unidades en el paneta
			else{
				$this->datos->borrarMisionDesplegar($this->idMision, $this->mision['idJugador']);
			}
        }
    }

    /**
     * Libera la batalla y genera los resultados de lates misma
     *
     * @access private
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    private function atacar()
    {
		$this->infoBandos->realizarBatalla();
    }

    /**
     * Finaliza la recoleccion
     *
     * @access private
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    private function recolectar(){
    	System_Daemon::info('-Terminando mision de recolectar en el planeta %s de la galaxia %s',$this->mision['idPlanetaDestino'],$this->mision['idGalaxiaDestino']);
    	//Comprobamos si hay usuarios enemigos y se produce batalla
    	if($this->infoBandos->posibleBatalla()){
    		System_Daemon::info('-Se produce una batalla');
    		$this->atacar();
    	}
    	//Si no se produce batalla recolectamos
    	else{
	    	//Calculo la cantidad de carga total que tengo
	    	$carga = 0;

	    	//Obtengo las unidades de la mision de recoleccion
        	$unidadesPlaneta = $this->infoBandos->obtenerUnidades();
        	$unidades = Array();//Unidades de mi mision

	    	if(count($unidadesPlaneta)){
				foreach($unidadesPlaneta as $jugador){
					if(count($jugador)){
						foreach($jugador as $idJugador => $unidad){
							if($unidad->getIdMision() == $this->idMision){
								$carga += $unidad->getCarga()*$unidad->getCantidad();
								$unidades[$idJugador][]=$unidad;
							}
						}
					}
				}
			}

	        /**
	         * Calculo los porcentjaes para obtener los recursos obtenidos
	         */
	        //Porcentaje aleatorio de recoleccion
	        $porcentajeLocal = mt_rand($_ENV['config']->get('minRecoleccion'),$_ENV['config']->get('maxRecoleccion'));

	        //Riqueza del planeta
	        list($porcentajePlaneta) = $this->datos->obtenerRiqueza($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);

	        //Porcentaje de recoleccion por recurso
	        list($primario, $secundario) = $this->datos->obtenerPorcentajeRecoleccion($this->mision['idJugador']);

	        //Calculamos las cantidades de recursos que hemos recolectado
	        $primario = $carga*(($porcentajeLocal/100)*($porcentajePlaneta/100)*($primario/100));
	        $secundario = $carga*(($porcentajeLocal/100)*($porcentajePlaneta/100)*($secundario/100));
			System_Daemon::info('-Recolecta %s de primario y %s de secundario',$primario,$secundario);

	        /**
	         * Insertamos estos recursos como los conseguidos en la mision
	         */
	        $this->datos->almacenarRecursos($this->idMision, $this->mision['idJugador'], $primario, $secundario);

	        //Generamos el reporte
	        $planeta=$this->datos->planeta($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);
	        $raza=$this->datos->raza($this->mision['idJugador']);
	        $html=$this->view->recolectar($primario, $secundario, $porcentajePlaneta, $unidades, $planeta, $raza, $this->mision['idJugador']);

	        //Enviamos un reporte de la mision
	        $this->datos->enviarReporteMision(_('Informe de recolecci&#243;n'),Array($this->mision['idJugador']),$html);
    	}
    }

    public function explorar(){
    	System_Daemon::info('-Terminando mision de explorar en el planeta %s de la galaxia %s',$this->mision['idPlanetaDestino'],$this->mision['idGalaxiaDestino']);
    	$this->datos->nuevoPlanetaExplorado($this->mision['idJugador'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);
		
    	//Generamos el reporte
        $planeta=$this->datos->planeta($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);

        //Obtengo las unidades que hay en el planeta
        $unidades = $this->infoBandos->obtenerUnidades();

        //Obtenemos la informacion completa de las unidades para los jugadores
    	$html=$this->view->explorar($planeta, $unidades, $this->mision['idJugador']);

        //Enviamos un reporte de la mision
        $this->datos->enviarReporteMision(_('Informe de exploraci&#243;n'),Array($this->mision['idJugador']),$html);
    }

	/**
     * Resuelve la conquista
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function conquistar()
    {
    	//Tiempo en el que debe terminar la conquista:
    	//
    	//FechaSalida + Viaje + Tiempo de conquista
    	//
    	$finConquista = $this->mision['fechaSalida']+$this->mision['tiempoTrayecto']+$_ENV['config']->get('tiempoConquista');

    	//Si la mision ha finalizado
    	if($this->tiempoEvento >= $finConquista){

    		//Desencadenamos una batalla para ver si sobervive el conquistador, siempre que sea posible
	    	if($this->infoBandos->posibleBatalla()){
	    		$this->atacar();
	    	}

    		//Si ha sobrevivido (la mision actual sigue existiendo), entonces procedo a la conquista
    		if($this->noDestruida()){
	    		//Obtenemos los datos del planeta
				$planeta=$this->datos->planeta($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);
				$propietario=$planeta['propietario'];
				$idPropietario=$planeta['idPropietario'];
		        if($planeta['nombrePlaneta']!=''){
					$nombrePlaneta=$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')';
		        }
		        else{
					$nombrePlaneta=$planeta['nombreSGC'];
		        }

		        //Hacemos que el planeta de destino pase a ser del usuario que realiza la conquista
		    	if($this->datos->conquistar($this->mision['idJugador'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'], $finConquista)){
		    		//Si he conseguido conquistar el planeta (no me pasaba del limite), paso al traslado con el
		    		//borrado de la mision
					$this->datos->borrarMision($this->idMision);

					//Enviamos un mensaje de aviso de la conquista
					if($idPropietario){//Si el planeta conquistado tenia propietario
		        		$this->datos->enviarAviso(_('Alerta de conquista'),Array($this->mision['idJugador']),_('Has conquistado el planeta ').$nombrePlaneta._(' al jugador ').$propietario);
			    		$this->datos->enviarAviso(_('Alerta de conquista'),Array($idPropietario),_('Tu planeta ').$nombrePlaneta._(' ha sido conquistado por un jugador enemigo.'));
					}
					//Si el planeta conquistado no tenia propietario (abandono durante la conquista)
					else{
						$this->datos->enviarAviso(_('Alerta de conquista'),Array($this->mision['idJugador']),_('Has conquistado el planeta ').$nombrePlaneta);
					}
		    	}
		    	else{
		    		//Si a la mision le ha dado tiempo de ir, esperar su tiempo de conquista y de volver, finalizo la mision
	        		if($this->mision['fechaSalida']+($this->mision['tiempoTrayecto']*2)+$_ENV['config']->get('tiempoConquista') <= time()){
	        			$this->datos->borrarMision($this->idMision);
	        		}
	        		//Si la mision aun tiene tiempo de vuelta, se lo asigno para que espere a llegar al planeta de origen
	        		//Teneindo en cuenta de que ha estado un tiempo extra en permanencia, que es el tiempo que dura la conquista
	        		else{
	        			$this->datos->volver($this->idMision, FALSE, $_ENV['config']->get('tiempoConquista'));
	        		}
    			}
    		}
    	}

    }

	/**
     * Hace efectivo el contraataque
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function contratacar()
    {
    	//Transformamos la mision en un ataque
    	$this->atacar();

    }

/**
     * Anyade un nuevo planeta colonizado al usuario en caso de ser necesario
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function establecerBase()
    {

        //Obtenemos los datos del planeta
		$planeta=$this->datos->planeta($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino']);
        if($planeta['nombrePlaneta']!='')
			$nombrePlaneta=$planeta['nombrePlaneta'].' ('.$planeta['nombreSGC'].')';
		else
			$nombrePlaneta=$planeta['nombreSGC'];

        #Ademas el planeta de destino, sera del jugador
        if(!$this->datos->estaColonizado($this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'])){
        	//Obtenemos cuantos planetas posee el jugador
        	$numColonizados = $this->datos->numPlanetasColonizados($this->mision['idJugador']);

			//Obtenemos el maximo de planetas que permite la raza del jugador
			$maxColonizados = $this->datos->numMaxPlanetasColonizados($this->mision['idJugador']);

			//Si puedo seguir colonizando planetas, lo colonizo
			if($numColonizados < $maxColonizados){
				$this->datos->colonizarPlaneta($this->mision['idJugador'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'], $this->mision['fechaSalida']+$this->mision['tiempoTrayecto']);
        		$this->datos->borrarMision($this->idMision);

        		//Mensaje del reporte
				$mensaje=_('El planeta').' '.$nombrePlaneta.' '._('esta bajo tu control, puedes seleccionarlo en tu lista de planetas para realizar acciones en el.');
			}
			//Sino, lo envio de vuelta
			else{
				//Mensaje del reporte
				$mensaje=_('El planeta').' '.$nombrePlaneta.' '._('no se pudo colonizar porque ya controlas tu m&#225;ximo de planetas.');
			}
        }
        //Si el planeta ya esta colonizado, vuelven todos
        else{
        	//Mensaje del reporte
			$mensaje=_('El planeta').' '.$nombrePlaneta.' '._('no se pudo colonizar porque esta bajo el control de').' '.$planeta['propietario'].'.';
        }

        //Enviamos el reporte de mision
        $this->datos->enviarAviso(_('Alerta de establecer base'),Array($this->mision['idJugador']),$mensaje);

    }

    public function volverManual($permanencia){
    	//Si la mision es mia la puedo hacer volver
    	if($this->getIdJugador()==$this->idJugadorActivo){
			//Tiempo a anyadir por penalizacion
    		$penalizacion = 0;

    		//Si estoy en una nueva mision y doy a volver antes de llegar al nuevo destino, debo volver por el planeta anterior
    		//para llegar al destino original (a---->b---<   c)
			if($this->mision['nuevaMision'] && ($this->mision['fechaSalida']+$this->mision['tiempoTrayecto'] > time() || $this->mision['idTipoMision']==DESPLEGAR)){
				//Creamos el modelo
		   		$naveModel = new NaveModel();
				
				//Obtenemos los datos del propietariod e la mision
				$infoJugador=$this->datos->obtenerDatosJugadorMision($this->mision['idJugador']);
				
				//Obtenemos las unidades de la mision
				$unidades=$this->datos->obtenerUnidadesMision($this->idMision, $this->mision['idJugador']);
				
				//Si la mision es de naves calculamos el tiempo de viaje
				if($this->datos->misionTipo($this->idMision)==1 && !$naveModel->viajanStargate($this->mision['idGalaxiaOrigen'], $this->mision['idGalaxiaDespliegue'], $infoJugador['stargateIntergalactico'], $unidades)){
		   			$penalizacion = $naveModel->tiempoMision($this->mision['idGalaxiaOrigen'],$this->mision['idPlanetaOrigen'],$this->mision['idGalaxiaDespliegue'],$this->mision['idPlanetaDespliegue'],DESPLEGAR,$unidades,$infoJugador['navesVelocidad'],100,$infoJugador['stargateIntergalactico']);
				}
				else{ //Si la mision es por el stargate no penalizamos
					$penalizacion=0;
				}
			}

			//Hago que la mision vuelva
			$this->datos->volver($this->idMision, $permanencia, 0, $penalizacion);
		}
    }

    public function obtenerUnidadesPlaneta($idJugador){
    	foreach($this->bandos AS $bando){
    		$unidades = $bando->obtenerUnidadesPlaneta($idJugador);

    		//Si encuentro las unidades, termino de buscarlas
    		if($unidades)
    			break;
    	}

    	return $unidades;
    }

    /**
     * Devuelve el tipo de mision actual
     *
     * @return unknown_type
     */
    public function tipoMision(){
    	return $this->mision['tipo'];
    }

    /**
     * Obtengo el tiempo en el que llego la mision
     *
     * @return unknown_type
     */
    public function tiempoMision(){
    	return $this->mision['fechaSalida']+$this->mision['tiempoTrayecto'];
    }

    /**
     * Permite finalizar cualquier tipo de mision, ya sea de ida o de vuelta
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function terminarMision()
    {

        //Compruebo si la mision sigue existiendo para proceder a su calculo
        //
        //Ej: un evento de fin especial activo puede eliminar una mision siguiente
        if($this->mision){
	        //Si la mision no esta marcada como que estaba de vuelta, es que ha llegado al planeta destino
	        if($this->mision['vuelta']==false){
	        	//Tiempo de llegada de la mision al planeta de destino
	        	$tiempoLlegada = $this->mision['fechaSalida']+$this->mision['tiempoTrayecto'];

	        	//Si soy una conquista que va a finalizar, la finalizo
                if($this->mision['tipo']=='conquistar' && ($tiempoLlegada+$_ENV['config']->get('tiempoConquista')) <= $this->tiempoEvento){
                   $this->infoBandos = new BatallaMision($this->mision['idJugador'], $this->mision['id'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'], $tiempoLlegada+$_ENV['config']->get('tiempoConquista'));
                }
				
                //Si soy un despliegue que acaba de llegar u otra misión distinta a despliegue y conquista, obtengo los datos
                /*elseif($this->mision['tipo']!='conquistar' && ($this->mision['tipo']!='desplegar' || ($this->mision['tipo']=='desplegar' && $tiempoLlegada==$this->tiempoEvento))){

                   	$this->infoBandos = new BatallaMision($this->mision['idJugador'], $this->mision['id'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'], $tiempoLlegada);

                }*/
				elseif($this->mision['tipo']!='conquistar'){

                   	$this->infoBandos = new BatallaMision($this->mision['idJugador'], $this->mision['id'], $this->mision['idGalaxiaDestino'], $this->mision['idPlanetaDestino'], $tiempoLlegada);

                }
                //Si soy un despliegue o una conquista que no debe de finalizar, aborto la terminacion
                else{
                	//No hace falta terminar un mision de despliegue o de
                	//conquista, que no vaya a conquistar
                	return FALSE;
                }
				
	        	//Resolvemos la mision (despliegue, batalla, recolecta...)
	        	$this->resolverMision();

	        	//Si la mision no permite permanencia, fuerzo a que vuelva
	        	if($this->mision['permanente']==false){
	        		//Creamos el modelo
			   		$naveModel = new NaveModel();
					
					//Obtenemos los datos del propietariod e la mision
					$infoJugador=$this->datos->obtenerDatosJugadorMision($this->mision['idJugador']);
					
					//Obtenemos las unidades de la mision
					$unidades=$this->datos->obtenerUnidadesMision($this->idMision, $this->mision['idJugador']);
					
					//Si es una nueva mision de naves que no va por el stargate
	        		if($this->mision['nuevaMision'] && $this->datos->misionTipo($this->idMision)==1 && !$naveModel->viajanStargate($this->mision['idGalaxiaOrigen'], $this->mision['idGalaxiaDespliegue'], $infoJugador['stargateIntergalactico'], $unidades)){
						$penalizacion = $naveModel->tiempoMision($this->mision['idGalaxiaOrigen'],$this->mision['idPlanetaOrigen'],$this->mision['idGalaxiaDespliegue'],$this->mision['idPlanetaDespliegue'],DESPLEGAR,$unidades,$infoJugador['navesVelocidad'],100,$infoJugador['stargateIntergalactico']);
						
						//Si a la mision le ha dado tiempo de ir y de volver, finalizo la mision
		        		if($this->mision['fechaSalida']+($this->mision['tiempoTrayecto']*2)+$penalizacion <= time()){
		        			$this->datos->borrarMision($this->idMision);
		        		}
		        		//Si la mision aun tiene tiempo de vuelta, se lo asigno para que espere a llegar al planeta de origen
		        		else{
		        			$this->datos->volver($this->idMision, $this->mision['permanente'],0,$penalizacion);
		        		}
					}
					else{ //Si es una mision normal o nueva mision de tropas o naves por stargate
						//Si a la mision le ha dado tiempo de ir y de volver, finalizo la mision
		        		if($this->mision['fechaSalida']+($this->mision['tiempoTrayecto']*2) <= time()){
		        			$this->datos->borrarMision($this->idMision);
		        		}
		        		//Si la mision aun tiene tiempo de vuelta, se lo asigno para que espere a llegar al planeta de origen
		        		else{
		        			$this->datos->volver($this->idMision, $this->mision['permanente']);
		        		}
					}
	        		
	        	}
	        }
	        //Si la mision ha vuelto hacia nuestro planeta
	        else{
	        	$this->datos->borrarMision($this->idMision);
	        }
        }

    }

    /**
     * Comprueba si la mision actual ha sido destruida o no (ej: un ataque)
     */
    private function noDestruida(){
    	//Si los datos de la mision siguen en la base de datos es que no se ha destruido
    	if($this->datos->obtenerDatosMision($this->idMision)){
    		return TRUE;
    	}
    	//Si no, es que ya no existe
    	else{
    		return FALSE;
    	}
    }
}

?>
