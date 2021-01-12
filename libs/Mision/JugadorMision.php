<?php

/**
 * Clase que gestiona la informacion de un jugador involucrado en batalla
 *
  * @author David & Jose
 * @package libs
 * @since 27/08/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include_once('../libs/ModelBase.php');
include_once('../libs/Mision/UnidadMision.php');

class JugadorMision
	extends ModelBase
{
	private $id;

	private $mejoras;

	private $unidades = Array();

	private $unidadesActivas;

	private $bando;

	private $cantUnidades;

	private $capturas = Array();

	private $propietario = False;

	private $infoGeneral = Array();

	private $tropasDisponibles;

	/**
	 * FUNCIONES PUBLICAS
	 */

	public function __construct($bando, $idJugador, $situacion){
		//Uso el constructor padre
		parent::__construct();

		//Almaceno el identificador
		$this->id = $idJugador;

		//Almaceno el bando al que pertenezco
		$this->bando = $bando;

		//Almaceno la informacion del jugador
		$this->obtenerMejoras();

		//Obtengo las posibles capturas que puedo hacer
		$this->obtenerCapturas();

		//Obtengo las unidades del jugador
		$this->obtenerUnidades($situacion);

		//Cantidad de unidades activas que tiene el jugador
		$this->unidadesActivas = count($this->unidades);

		//Huecos libres para capturar tropas
		$this->tropasDisponibles = $this->getNumTropasDisponibles();
	}

	/**
	 * Ataca aleatoriamente a otros jugadores
	 *
	 * @param unknown_type $bandos
	 * @return unknown_type
	 */
	public function ataqueAleatorio($bandos){
		if($this->jugadorDerrotado()){
			return FALSE;
		}
		else{
			//System_Daemon::info('-Ataca jugador '.$this->id);
			//Ataco con cada una mis unidades
			foreach($this->unidades AS $unidadAtacante){
				//Si la unidad no esta destruida, puedo atacar con ella
				if(!$unidadAtacante->estaDestruida()){
					//Cantidad total para el ataque
					$cantidadAtacante = $unidadAtacante->getCantidad();

					//Inicializamos las unidades compatibles del bando
					$unidadesCompatibles=Array();
					$cantidadCompatibles=0;

					//Recorremos los bandos
					foreach($bandos AS &$bando){
						//Si no es nuestro bando
						if($bando != $this->bando){
							$unidadesBando=$bando->obtenerUnidades();
							//Recorremos las unidades del bando
							foreach($unidadesBando AS &$unidadesDefensor){
								//Recorremos las unidades de uno de los defensores
								foreach($unidadesDefensor AS &$unidadDefensor){
									//Si la unidad es atacable la introducimos en el vector
									if(!$unidadDefensor->estaDestruida() && $unidadAtacante->compatible($unidadDefensor)){
										$unidadesCompatibles[]=&$unidadDefensor;
										$cantidadCompatibles+=$unidadDefensor->getCantidad();
									}
								}
							}
						}
					}

					//echo 'Atacante: '.$cantidadAtacante.'<br/>';
					//Recorremos las undiades compatbiles y vamos atacando
					if($cantidadCompatibles){
						//System_Daemon::info('--Atacan '.$cantidadAtacante.' unidades '.$unidadAtacante->getId());
						foreach($unidadesCompatibles AS &$unidadDefensor){
							//Calculo el porcentaje de unidades que enviaré a atacar a esa unidad defensora
							$porcentaje = ($unidadDefensor->getCantidad()/$cantidadCompatibles) + ($unidadDefensor->getCantidad()/$cantidadCompatibles)*(mt_rand(-$_ENV['config']->get('porcentajeDesviacion'), $_ENV['config']->get('porcentajeDesviacion'))/100); //Porcentaje sobre la cantidad total a enviar

							//Si el porcentaje supera el 100%, asigno el 100%
							if($porcentaje > 1){
								$porcentaje = 1;
							}

							//Obtenemos la cantida concreta a enviar a atacar
							$cantidad = round($cantidadAtacante*$porcentaje);

							//Disminuimos las cantidades con los valores obtenidos
							$cantidadCompatibles-=$unidadDefensor->getCantidad();
							$cantidadAtacante-=$cantidad;

							//Realizo el ataque si ataco con almenos una unidad
							if($cantidad){
								//System_Daemon::info('----Atacan '.$cantidad.' a '.$unidadDefensor->getCantidad().' de unidad '.$unidadDefensor->getId());
								$unidadAtacante->atacar($unidadDefensor,$cantidad);
							}

							//Si no me quedan unidades para atacar, dejo de buscar unidades defensoras
							if(!$cantidadAtacante){
								break;
							}
						}
					}
				}
			}
			return TRUE;
		}
	}

	/**
	 * Devuelve el identificador del jugador
	 *
	 * @return unknown_type
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Indica si el jugador ha sido derrotado o no
	 *
	 * @return unknown_type
	 */
	public function jugadorDerrotado(){
		return $this->unidadesActivas == 0;
	}

	/**
	 * Indica que se ha eliminado una unidad del jugador
	 *
	 * @return unknown_type
	 */
	public function unidadEliminada(){
		$this->unidadesActivas--;
	}

	/**
	 * Indica si este jugador es el propietario del planeta
	 */
	public function propietario(){
		return $this->propietario;
	}

	public function getMejoras(){
		return $this->mejoras;
	}

	/**
	 * Comprueba si soy el jugador indicado por el identificador
	 *
	 * @param unknown_type $id
	 * @return unknown_type
	 */
	public function soy($id){
		return $this->id == $id;
	}

	/**
	 * Obtiene las unidades del jugador, que se situan en el planeta
	 *
	 * @return unknown_type
	 */
	public function getUnidades(){
		$unidades = Array($this->id => Array());
		if(count($this->unidades)>0){
			foreach($this->unidades AS &$unidad){
					$unidades[$this->id][]=$unidad;
			}
		}

		return $unidades;
	}

	/**
	 * Esta funcion permite almacenar los datos de las batallas,
	 * actualizando las cantidades de todas las unidades en BD
	 *
	 * @return unknown_type
	 */
	public function guardarBatalla(){
		//Almaceno los datos de las unidades modificadas
		foreach($this->unidades AS $unidad){
			$unidad->almacenarDatos();
		}

		//Elimino las unidades de las misiones
		$this->eliminarResiduos();
	}

	/**
	 * Realiza las capturas de un tipo de unidad
	 *
	 * @param mixed $unidad
	 * @param integer $cantidad
	 * @return mixed
	 */
	public function capturar(&$unidad, $cantidad){
		//Comprueba si existe la unidad
		/*if(array_key_exists($unidad->getId(), $this->capturas)){
			//En esta varaible se almacenan las transformaciones obtenidas
			$transformacion = Array();

			//Energia disponible para las capturas
			$energia=$this->getEnergiaDisponible();

			//Energia que consume cada unidad que es posible capturar
			$consumo=$this->getEnergiaConsumen($this->capturas);

			//Recorro las opciones de transformacion
			foreach($this->capturas[$unidad->getId()] AS $trans){

				//Obtengo los valores de la transformacion
				$porcentaje = $trans['porcentaje']; //Procentaje para transformar/capturar
				$convertida = $trans['convertida']; //Identificador de la unidad a la que se transforma
				$cantidadCapturada=0;

				//Cuando se captura unaunica unidad (heroes) se hace el calculo real
				if($cantidad == 1){
					if(mt_rand(0,100) < $trans['porcentaje']){
						$cantidadCapturada = 1;
					}
				}
				else{
					//Capturo unidades
					$cantidadCapturada = round((mt_rand($trans['porcentaje']/2, $trans['porcentaje'])/100)*$cantidad);
				}

				//Si hemos capturado alguna unidad
				if($cantidadCapturada){
					//Comprobamos la energia
					if(array_key_exists($trans['convertida'],$consumo) &&  $consumo[$trans['convertida']]>0 && $consumo[$trans['convertida']]*$cantidadCapturada > $energia){
						$cantidadCapturada=floor($energia/$consumo[$trans['convertida']]);
					}

					//Si las unidades son soldados, entonces no puedo capturar mas de los huecos que tengo libres
					if($unidad->getTipo() == SOLDADO){
						if($this->tropasDisponibles < $cantidadCapturada){
							$cantidadCapturada = $this->tropasDisponibles;
						}

						//Actualizamos los huecos que quedan para capturar soldados
						$this->tropasDisponibles -= $cantidadCapturada;
					}

					//Si finalmente hemos capturado algo, despues de comprobar los limites,
					//anyado la captura a la lista
					if($cantidadCapturada){
						//Creamos el array
						$transformacion[] = Array('unidad' => $convertida,
											'cantidad' => $cantidadCapturada
											);
					}
				}

				//La cantidad que es posible transformar en la siguiente iteracion,, son las unidades que quedan
				//despues de transformar las actuales
				$cantidad-=$cantidadCapturada;
			}

			//Compruebo si se ha realizado alguna transformacion
			if(count($transformacion))
				return $transformacion;
		}*/

		return False;
	}

	//Envia el reporte del jugador
	public function enviarReporte($idMensaje){
		$this->obtenerInfoGeneral();

		//Inserto los destinatarios del mensaje
		$this->db->query('
			INSERT INTO recibeMensaje
				(idMensaje, idJugador, nombreUsuario, leido)
				VALUES
				(\''.$idMensaje.'\', \''.$this->id.'\', \''.$this->infoGeneral['nombreJugador'].'\', FALSE)
		');

		//Insertamos la informacion del jugador que ha participado en la batalla
		$this->db->query('
			INSERT INTO infoJugadoresBatalla
				(idMensaje, idJugador, idRaza, idAlianza, nombreJugador, nombreRaza, nombreAlianza)
				VALUES
				(\''.$idMensaje.'\', \''.$this->id.'\', \''.$this->infoGeneral['idRaza'].'\',
					'.($this->infoGeneral['idAlianza'] === '' ? 'NULL' : ("'".$this->infoGeneral['idAlianza']."'")).', \''.$this->infoGeneral['nombreJugador'].'\',
					"'.$this->infoGeneral['nombreRaza'].'", \''.$this->infoGeneral['nombreAlianza'].'\')
		');

		//Genero el reporte de las unidades del jugador
		foreach($this->unidades AS $unidad){
			$unidad->enviarReporte($idMensaje);
		}

		return $this;
	}

	/**
	 * FUNCIONES PRIVADAS
	 */

	/**
	 * Obtengo informacion generica sobre el jugador para usarla por ejemplo en los reportes
	 *
	 * @return unknown_type
	 */
	private function obtenerInfoGeneral(){
		$consulta = $this->db->query('
			SELECT u.nombre AS nombreJugador, j.idRaza, r.nombre AS nombreRaza, j.idAlianza, a.titulo AS nombreAlianza
			FROM usuario AS u JOIN jugador AS j ON (u.id=j.idUsuario)
				 JOIN raza AS r ON (r.id = j.idRaza)
				 LEFT JOIN alianza AS a ON (j.idAlianza=a.id)
			WHERE u.id=\''.$this->id.'\'
		');

		$this->infoGeneral = $consulta->fetch_assoc();

		$consulta->close();

		return $this;
	}

	/**
	 * Elimino los posibles residuos de las batallas, como misiones
	 * sin unidades o unidades totalmente destruidas
	 *
	 * @return unknown_type
	 */
	private function eliminarResiduos(){
		//Elimino las unidades en mision que han sido totalmente eliminadas
		$this->db->query('
			DELETE FROM unidadJugadorPlanetaMision
			WHERE idJugador = \''.$this->id.'\' AND cantidadActual=0
		');
		
		return $this;
	}

	//Obtengo los datos genericos del jugador
	private function obtenerMejoras(){
		$consulta = $this->db->query('
			SELECT jiu.soldadosCarga, jiu.soldadosAtaque, jiu.soldadosResistencia, jiu.soldadosEscudo,
					jiu.navesCarga, jiu.navesAtaque, jiu.navesResistencia, jiu.navesEscudo, jiu.navesVelocidad,
					jiu.defensasAtaque, jiu.defensasResistencia, jiu.defensasEscudo, jiu.invisible, jiu.atraviesaIris
			FROM jugadorInfoUnidades AS jiu
			WHERE idJugador=\''.$this->id.'\'
			LIMIT 1
		');

		$this->mejoras = $consulta->fetch_assoc();

		$consulta->close();

		return $this;
	}

	private function obtenerCapturas(){
    	//Consulto las capturas que puede realizar cada jugador
    	$consulta = $this->db->query('
    		SELECT ecu.idUnidad AS idCaptura, ecu.idUnidadConvertir AS idConvertida, ecu.probabilidad AS porcentaje
    		FROM jugadorEspecialActivo AS jea JOIN especialCapturaUnidad AS ecu ON (jea.idEspecial=ecu.idEspecial)
    		WHERE jea.idJugador = \''.$this->id.'\'

    		UNION

    		SELECT rcu.idUnidadCapturada AS idCaptura, rcu.idUnidadConvertida AS idConvertida, porcentaje
    		FROM jugador AS j JOIN razaCapturaUnidad AS rcu ON (j.idRaza = rcu.idRaza)
    		WHERE j.idUsuario = \''.$this->id.'\'
    	');

    	//Varaible dodne se almacenara la informacion de las posibles capturas
    	$infoCapturas = Array();


    	//Vuelco el contenido en la variable
    	while($row = $consulta->fetch_assoc()){
    		//Almaceno los valores en la estructura
    		if(!array_key_exists($row['idCaptura'], $this->capturas)){
	    		//Alamaceno la estructura
	    		$this->capturas[$row['idCaptura']] = Array(
    													0 => Array(
    															'convertida' => $row['idConvertida'],
    															'porcentaje' => $row['porcentaje']
    														)
    												);
    		}
    		else{
    			//Anyado la conversion
	    		$this->capturas[$row['idCaptura']][] = Array(
    														'convertida' => $row['idConvertida'],
    														'porcentaje' => $row['porcentaje']
	    											);
    		}
    	}
	}

	private function obtenerUnidades($situacion){
		//
		//Genero la parte del WHERE de la consulta para obtener todas las unidades de golpe
		//
		$misiones = Array();
		$planetas = Array();

		foreach($situacion AS $info){
			//Si no es un vector se trata de una mision
			if(!is_array($info)){
				$misiones[] = $info;
			}
			//Si es un vector es trata de una coordenada galaxia/planeta,
			//lo preparo para despues poderlo procesar como un par en la consulta Ej: (1, 15)
			else{
				$planetas[] = '('.$info['galaxia'].','.$info['planeta'].')';
			}
		}

		//Si existen unidades en misiones, las obtengo
		if(count($misiones)>0)
			$this->obtenerUnidadesMision($misiones);

		//Si existen unidades en planeta, las obtengo
		if(count($planetas)>0)
			$this->obtenerUnidadesPlaneta($planetas);

		return $this;
	}

	private function obtenerUnidadesMision($misiones){
		$consulta = $this->db->query('
						SELECT idMision, idUnidad, cantidadActual
						FROM unidadJugadorPlanetaMision
						WHERE idMision IN ('.implode(',', $misiones).') AND idJugador=\''.$this->id.'\'
					');
		//System_Daemon::info('-Jugador '.$this->id);
		while($row = $consulta->fetch_assoc()){
			//System_Daemon::info('----Unidad '.$row['idUnidad'].' | Cantidad: '.$row['cantidadActual'].' | Mision: '.$row['idMision']);
			$this->unidades[] = new UnidadMision($this, $row['idUnidad'], $row['cantidadActual'], $this->mejoras, $row['idMision']);
		}

		return $this;
	}

	private function obtenerUnidadesPlaneta($coord){
		$sql='
						SELECT idUnidad, (CAST(cantidad AS SIGNED)-CAST(cantidadEnMision AS SIGNED)) AS cantidadActual, idGalaxia, idPlaneta
						FROM unidadJugadorPlaneta
						WHERE idJugador=\''.$this->id.'\'
								AND (idGalaxia,idPlaneta) IN ('.implode(',', $coord).')';

		$consulta = $this->db->query($sql);
		//System_Daemon::info('-Jugador '.$this->id);
		while($row = $consulta->fetch_assoc()){
			//System_Daemon::info('----Unidad '.$row['idUnidad'].' | Cantidad: '.$row['cantidadActual'].' | En el planeta');
			if($row['cantidadActual']>0){
			$this->unidades[] = new UnidadMision($this,$row['idUnidad'], $row['cantidadActual'], $this->mejoras);
			$this->unidades[count($this->unidades)-1]->asignarPlaneta($row['idGalaxia'], $row['idPlaneta']);
			$this->propietario=TRUE;
			}
		}

		return $this;
	}

	private function getEnergiaConsumen($idUnidad){
		$unidad=Array();
		foreach($idUnidad as $u){
			$unidad[]=$u[0]['convertida'];
		}

		$consulta = $this->db->query('
						SELECT idUnidad, cantidad
						FROM recursoUnidad
						WHERE idTipoRecurso=3 AND idUnidad IN ('.implode(',', $unidad).')
					');
		$consumo=Array();
		while($row = $consulta->fetch_assoc()){
			$consumo[$row['idUnidad']]=$row['cantidad'];
		}

		return $consumo;
	}

	private function getEnergiaDisponible(){
		$consulta = $this->db->query('
						SELECT cantidad
						FROM tipoRecursoUsuario
						WHERE idTipoRecurso=3 AND idJugador=\''.$this->id.'\'
					');

		list($cantidad) = $consulta->fetch_row();

		return $cantidad;
	}

	private function getNumTropasDisponibles(){
		$consulta = $this->db->query('
						SELECT limiteSoldados-numSoldados AS cantidad
						FROM jugadorInfoGeneral
						WHERE idJugador=\''.$this->id.'\'
					');

		list($cantidad) = $consulta->fetch_row();

		return $cantidad;
	}

	/**
	 * Recarga los escudos de todas las unidades del jugador
	 */
	public function recargarEscudosJugador(){
		foreach($this->unidades AS $unidad){
			$unidad->recargarEscudo();
		}
	}

}

?>
