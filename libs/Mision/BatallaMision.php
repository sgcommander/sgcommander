<?php

/**
 * Clase que gestiona la informacion de batalla
 *
  * @author David & Jose
 * @package libs
 * @since 27/08/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include_once('../libs/ModelBase.php');
include_once('../libs/Mision/BandoMision.php');

class BatallaMision
	extends ModelBase
{
	/**
	 * Informacion general de la batalla
	 */
	private $galaxia;
	private $planeta;
	private $tiempo; //Momento exacto del tiempo en el que se realizara la batalla
	private $nBandos; //Numero de bandos que contiene la batalla
	private $jugadorActivo;
	private $idMision; //Mision que desencadena la batalla

	/**
	 * Bandos que interfieren en la batalla
	 */
	private $bandos;

	public function __construct($idJugador, $idMision, $idGalaxia, $idPlaneta, $tiempo){
		//Uso el constructor padre
		parent::__construct();

		//Obtengo la informacion general de batalla
		$this->idMision = $idMision;
		$this->galaxia = $idGalaxia;
		$this->planeta = $idPlaneta;
		$this->tiempo = $tiempo;
		$this->jugadorActivo = $idJugador;

		//Obtengo los bandos los cuento y altero su orden para aumentar la aleatoriedad
		$this->obtenerBandos($this->idMision);	//Los obtengo
		$this->nBandos = count($this->bandos); // Los cuento

		shuffle($this->bandos);

		return $this;
	}

	/**
	 * Realizo la batalla desencadenada por la mision
	 *
	 * @param integer $idMision Mision desencadenante
	 */
	public function realizarBatalla(){
		//System_Daemon::info('############# Comenzando batalla #############');
		
		//Obtengo la cantidad de jugadores en batalla
		$nJugadores = $this->cantidadJugadores();

		//Creo un vector desordenado con las posciones de los jugadores en el vector bandos
		$ordenAtaque = range(0, $nJugadores-1);

		//Genero el numero de rondas indicado
		for($ronda=0; $ronda<$_ENV['config']->get('numeroRondas'); $ronda++){
			//System_Daemon::info('############# Ronda '.($ronda+1).' #############');
			shuffle($ordenAtaque);

			//Recorro los jugadores atacantes para que vallan atacando
			for($p=0; $p < $nJugadores; $p++){
				//Obtengo el numero de atacante que tiene el turno
				$nAtacante = $ordenAtaque[$p];

				//Obtengo el bando que pertenece al atacante y su posicion dentro de el
				list($bando, $posAtacante) = $this->obtenerBandoPos($nAtacante);

				//Genero el ataque y compruebo si se ha podido realizar
				if(!$bando->ataqueAleatorio($posAtacante, $this->bandos)){
					//Elimino la posicion del vector
					$ordenAtaque = array_merge(array_slice($ordenAtaque, 0, $p), array_slice($ordenAtaque, $p+1));

					//Ahora el numero de jugadores es inferior y al decrementar el vector
					//de orden ataque, el puntero del vector $p, tambien se atrasa una posicion
					$nJugadores--;
					$p--;

					//Si no quedan suficientes jugadores para poder luchar, entonces se finaliza la batalla
					if($nJugadores < 2){
						break;
					}
				}
			}

			//Si no quedan suficientes jugadores para poder luchar, entonces se finaliza la batalla
			if($nJugadores < 2){
				break;
			}

			//Al finalizar la ronda, recargo los escudos de todos los bandos
			//System_Daemon::info('-Recargando escudos');
			foreach($this->bandos AS $bando){
				$bando->recargarEscudosBando();
			}
			
			//Mostramos unidades
			/*foreach($this->bandos AS $bando){
				$jugadores=$bando->getJugadores();
				foreach($jugadores[$bando->getId()] AS $jugador){
					System_Daemon::info('-Jugador '.$jugador->getId());
					$unidades=$jugador->getUnidades();
					foreach($unidades[$jugador->getId()] AS $unidad){
						if($unidad->getCantidad()>0){
							System_Daemon::info('----Unidad '.$unidad->getId().' | Cantidad: '.$unidad->getCantidad().' | Cantidad eliminada: '.$unidad->getCantidadEliminada());
						}
					}
				}
			}*/
		}

		//Se actualizan las cantidades de las unidades en la base de datos
		$this->guardarBatalla();

		//Se envia el resporte de batalla
		$this->enviarReporte();
		
		//exit();
	}

	//Indica si una batalla para esta mision es posible
	public function posibleBatalla(){
		//Una batalla solo es posible si existe mas de un bando de jugadores
		return $this->nBandos > 1;
	}

	/**
	 * FUNCIONES PRIVADAS
	 */

	//Genero un reporte
	private function enviarReporte(){
		//Genero el mensaje principal
		$this->db->query('
			INSERT INTO mensaje
				(idJugador, idTipoMensaje, nombreUsuario, asunto, fecha, contenido)
				VALUES
				(NULL, 5, \'Sistema\', \'Informe de batalla\', NOW(), \'\')
		');

		//Obtengo el identificador del mensaje
		$idMensaje = $this->db->insert_id;

		//Inserto la informacion del planeta atacado
		$this->db->query('
			INSERT INTO infoGeneralBatalla
				(idMensaje, idPlaneta, idGalaxia)
				VALUES
				(\''.$idMensaje.'\', \''.$this->planeta.'\', \''.$this->galaxia.'\')
		');

		//Recorro todos los bandos para generar el reporte
		foreach($this->bandos AS $bando){
			$bando->enviarReporte($idMensaje);
		}

		return $this;
	}

	//Almacena los datos de la batalla
	private function guardarBatalla(){
		foreach($this->bandos AS $bando){
			$bando->guardarBatalla();
		}

		return $this;
	}

	/**
	 * Obtiene el bando al que pertenece dicho numero de jugador
	 *
	 * @param unknown_type $nJugador
	 * @return unknown_type
	 */
	private function obtenerBandoPos($nJugador){
		foreach($this->bandos AS $bando){
			$cantidad = $bando->numJugadores();

			//Si el jugador esta dentro del bando, devuelvo el bando, junto con su posicion
			if($nJugador < $cantidad)
				return Array($bando, $nJugador);
			//Si el jugador no esta dentro del bando,
			//prosigo con su busqueda, habiendo descartado los N jugadores encontrados
			else
				$nJugador-=$cantidad;
		}

		return False;
	}

	/**
	 * Devuelve los jugadores afectados por la mision, excluyendo al propietario del planeta
	 * que esta siendo atacado
	 *
	 * @return unknown_type
	 */
	public function jugadoresAfectados(){
		//Identificadores de los jugadores afectados (menos el propietario del planeta)
		$idJugadores = Array();

		foreach($this->bandos AS $bando){
			$idJugadores = array_merge($idJugadores, $bando->jugadoresExternos());
		}

		return $idJugadores;
	}

	public function obtenerUnidades(){
		$unidades = Array();

		foreach($this->bandos AS $bando){
			$unidades = array_merge($unidades, $bando->obtenerUnidades());
		}

		return $unidades;
	}

	/**
	 * Obtengo la cantidad de jugadores en el bando
	 *
	 * @param $bando
	 * @return unknown_type
	 */
	private function cantidadJugadores(){
		$cantidad = 0;

		foreach($this->bandos AS $bando){
			$cantidad += $bando->numJugadores();
		}

		return $cantidad;
	}

	/**
	 * Obtiene la informacion de los bandos. También muestra quien es el que ha desencadenado el ataque.
	 *
	 * @param integer $idMision
	 */
	private function obtenerBandos($idMision){
		//Obtengo todos los jugadores que tienen misiones en el planeta y se veran afectadas por
		//la batalla, ademas del duenyo del planeta
		$consulta = $this->db->query('
						SELECT m.idJugador, m.id AS idMision, COALESCE(j.idAlianza, -1) AS idAlianza, jip.puntosTecnologias
						FROM mision AS m JOIN tipoMision t ON m.idTipoMision=t.id
							 JOIN jugador AS j ON m.idJugador=j.idUsuario
							 LEFT JOIN jugadorInfoPuntuaciones AS jip ON (jip.idJugador = j.idUsuario)
						WHERE m.idGalaxiadestino='.$this->galaxia.'
							AND j.vacaciones IS NULL
							AND (j.bloqueado IS NULL OR j.bloqueado < NOW())
							AND m.idPlanetaDestino='.$this->planeta.'
							AND m.vuelta=0 
							AND (t.permanencia AND (UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto) <= '.$this->tiempo.'
								  OR
								 m.idJugador=\''.$this->jugadorActivo.'\' AND (UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto) = '.$this->tiempo.'
								)

						UNION

						SELECT j.idUsuario AS idJugador, NULL AS idMision, COALESCE(j.idAlianza,-1), jip.puntosTecnologias
						FROM jugador AS j JOIN planetaColonizado AS pc ON j.idUsuario=pc.idJugador
							 LEFT JOIN jugadorInfoPuntuaciones AS jip ON (jip.idJugador = j.idUsuario)
						WHERE pc.idPlaneta='.$this->planeta.' AND pc.idGalaxia='.$this->galaxia.'
							AND j.vacaciones IS NULL
							AND (j.bloqueado IS NULL OR j.bloqueado < NOW())

					');

		//Obtengo todos los datos de los jugadores
		$jugadores = Array();
		while($row = $consulta->fetch_assoc()){
			$jugadores[] = $row;
		}

		//Filtro los jugadores aptos para la batalla
		//(jugadores debiles o no, dependiendo del jugador que desencadena la batalla)
		$jugadores = $this->aptosBatalla($idMision, $jugadores);

		//En esta varaible se almacenaran los bandos de la batalla
		$bando = Array();

		//Vuelco los datos
		foreach($jugadores AS $jugador){
			if($jugador['idMision']){
				if($jugador['idAlianza']!=-1)
					$bando[$jugador['idAlianza']][$jugador['idJugador']][] = $jugador['idMision'];
				else
					$bando[('jug'.$jugador['idJugador'])][$jugador['idJugador']][] = $jugador['idMision'];
			}
			else{
				if($jugador['idAlianza']!=-1)
					$bando[$jugador['idAlianza']][$jugador['idJugador']][] = Array(
																	'planeta' => $this->planeta,
																	'galaxia' => $this->galaxia
																);
				else
					$bando[('jug'.$jugador['idJugador'])][$jugador['idJugador']][] = Array(
																	'planeta' => $this->planeta,
																	'galaxia' => $this->galaxia
																);
			}
		}

		$consulta->close();

		//Genero los objetos necesarios
		foreach($bando AS $alianza => $info){
			$this->bandos[] = new BandoMision($alianza, $info);
		}

		return $this;
	}

	/**
	 * Realiza una criba de los jugadores, para que los debiles
	 * y los no debiles no se mezclen en ellas.
	 *
	 * Los usuarios que no cumplan las condiciones, se eliminan
	 * de la batalla
	 *
	 *  @param integer $idMision Mision desencadenante de la batalla
	 */
	private function aptosBatalla($idMision, $jugadores){
		//Busco la puntuacion del jugador atacante
		foreach($jugadores AS $jugador){
			if($jugador['idMision'] == $idMision){
				$puntuacion = $jugador['puntosTecnologias'];
				break;
			}
		}

		//Condicion para el resto de jugadores
		if( $puntuacion < $_ENV['config']->get('puntuacionDebil') ){
			$debil = TRUE;
		}
		else{
			$debil = FALSE;
		}

		//Recorro todos los jugadores, descartando los que no cumplan la condicion
		foreach($jugadores AS $key => $jugador){
			//Si el jugador no es del mismo tipo que el atacante, lo elimino de la lista
			if(($jugador['puntosTecnologias'] < $_ENV['config']->get('puntuacionDebil')) != $debil){
				unset($jugadores[$key]);
			}
		}

		return $jugadores;
	}
}
?>
