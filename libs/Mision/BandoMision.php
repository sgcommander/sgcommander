<?php

/**
 * Clase que gestiona la informacion de un bando
 *
  * @author David & Jose
 * @package libs
 * @since 27/08/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include_once('../libs/ModelBase.php');
include_once('../libs/Mision/JugadorMision.php');

class BandoMision
	extends ModelBase
{
	private $id;
	private $jugadores;
	private $nJugadores=0;

	public function __construct($id, $jugadores){
		//Uso el constructor padre
		parent::__construct();

		//Almaceno el identificador de bando
		$this->id = $id;

		//Genero los jugadores de este bando y los contabilizo
		foreach($jugadores AS $idJugador => $situacion){
			$this->jugadores[] = new JugadorMision($this, $idJugador, $situacion);

			$this->nJugadores++;
		}
	}
	
	/**
	 * Devuelve el identificador del bando
	 *
	 * @return unknown_type
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Realiza un ataque a algun enemigo
	 * 
	 * @param $posJugador
	 * @param $bandos
	 * @return unknown_type
	 */
	public function ataqueAleatorio($posJugador, $bandos){
		//Mando al jugador que realice un ataque al azar entre los otros bandos
		return $this->jugadores[$posJugador]->ataqueAleatorio($bandos);
	}

	/**
	 * Devuelve el numero de jugadores
	 * 
	 * @return unknown_type
	 */
	public function numJugadores(){
		return $this->nJugadores;
	}
	
	/**
	 * Obtiene los jugadores de un bando
	 *
	 * @return unknown_type
	 */
	public function getJugadores(){
		$jugadores = Array($this->id => Array());
		if(count($this->jugadores)>0){
			foreach($this->jugadores AS &$jugador){
				$jugadores[$this->id][]=$jugador;
			}
		}

		return $jugadores;
	}

	/**
	 * Devuelve los identificadores de los jugadores que son externos al planeta
	 * 
	 * @return unknown_type
	 */
	public function jugadoresExternos(){
		$idJugadores = Array();

		foreach($this->jugadores AS $jugador){
			if(!$jugador->propietario()){
				$idJugadores[]=$jugador->getId();
			}
		}

		return $idJugadores;
	}

	//Obtiene todas las unidades de los jugadores, ordenadas por jugador
	public function obtenerUnidades(){
		$unidades = Array();

		//Recorro todos los jugadores para anyadir sus unidades a la lista
		foreach($this->jugadores AS $jugador){
			//Si el jugador no esta muerto, anyado todas sus unidades a la lista
			if(!$jugador->jugadorDerrotado()){
				$unidades = array_merge($unidades, $jugador->getUnidades());
			}
		}

		return $unidades;
	}

	//Almacena la informacion de las batallas
	public function guardarBatalla(){
		foreach($this->jugadores AS $jugador){
			//Guardamos los datos del usuario
			$jugador->guardarBatalla();
			
			//Eliminamos residuos
			$this->eliminarResiduos();
		}

		return $this;
	}
	
	/**
	 * Elimino los posibles residuos de las batallas, como misiones
	 * sin unidades o unidades totalmente destruidas
	 *
	 * @return unknown_type
	 */
	private function eliminarResiduos(){
		//
		//Elimino las misiones que no contienen unidades
		//

		//Busco las misiones sin unidades
		$consulta = $this->db->query('
			SELECT m.id
			FROM mision AS m LEFT JOIN unidadJugadorPlanetaMision AS ujpm ON (m.id = ujpm.idMision)
			WHERE ujpm.idMision IS NULL');

		//Obtnego sus id
		$idMisiones = Array();
		while($row = $consulta->fetch_row()){
			$idMisiones[] = $row[0];
		}

		//Si he encontrado algun id, lo elimino
		if(count($idMisiones)){
			$this->db->query('
				DELETE FROM mision
				WHERE id IN ('.implode(',',$idMisiones).')
			');
		}

		return $this;
	}
	

	//Indico a los jugadores que generar un reporte
	public function enviarReporte($idMensaje){
		foreach($this->jugadores AS $jugador){
			$jugador->enviarReporte($idMensaje);
		}

		return $this;
	}
	
	/**
	 * Permite realizar recarga de escudos a todos los jugadores del bando
	 */
	public function recargarEscudosBando(){
		foreach($this->jugadores AS $jugador){
			$jugador->recargarEscudosJugador();
		}
	}
}
?>
