<?php

/**
 * Clase que gestiona la informacion de una unidad en batalla
 *
 * @author David & Jose
 * @package libs
 * @since 27/08/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include_once('../libs/ModelBase.php');

class UnidadMision
	extends ModelBase
{
	private $id; //Indica la unidad que es
	private $jugador;

	//Localizacion
	private $idMision; //Indica la mision desde la que proviene
	private $planeta;
	private $galaxia;

	//Categorias de la unidad
	private $tipo;
	private $subtipo;
	private $especial;

	//Cantidades
	private $cantidad;
	private $cantidadInicial;
	private $cantidadEliminada=0;

	//Caracteristicas de la unidad
	private $atributos; //Atributos base
	private $attrMejorado; //Atributos + Mejoras jugador

	//Resistencia y escudo actual de la unidad
	private $escudo;
	private $resistencia;

	//Batalla
	private $unidadesEliminadas = Array();
	private $unidadesCapturadas = Array();

	//Fuego rapido
	private static $fuegoRapido = Array();

	/**
	 * FUNCIONES PUBLICAS
	 */

	//Constructor de la clase
	public function __construct($jugador, $id, $cantidad, $mejoras = Array(), $idMision = NULL){
		//Uso el constructor padre
		parent::__construct();

		//Almaceno el jugador al que pertenezco
		$this->jugador = $jugador;

		//Asigno la unidad
		$this->id = $id;

		//Asigna la mision
		if($idMision)
			$this->idMision = $idMision;

		//Indica la cantidad inicial de la unidad
		$this->cantidadInicial = $cantidad;
		$this->cantidad = $cantidad;
		
		//Obtengo la informacion de la unidad y le aplico las mejoras
		$this->obtenerInfo()->aplicarMejoras($mejoras);
	}

	/**
	 * Realiza el ataque de una unidad a otra
	 *
	 * @param mixed $unidad Unidad defensora
	 * @param integer $cantidad Cantidad de unidades que atacan
	 */
	public function atacar(&$unidad, $cantidad){
		//Obtengo el numero de disparos a realizar por la unidad atacante a la defensora
		$nDisparos = $this->getNumDisparos($unidad);

		//Calculamos el ataque efectivo de un disparo
		$ataqueEfectivo = $this->attrMejorado['ataque']*(mt_rand($_ENV['config']->get('precisionFuegoMinima'), $_ENV['config']->get('precisionFuegoMaxima'))/100);

		//Si el ataque efectivo es superior al escudo + resistencia lo ajustamos
		if($ataqueEfectivo > ($unidad->getResistencia()+$unidad->getEscudo()))
			$ataqueEfectivo = ($unidad->getResistencia()+$unidad->getEscudo());

		//Ataque total emitido entre todas las unidades atacantes
		$totalDisparos = $nDisparos*$cantidad;
		$ataqueGlobal = $ataqueEfectivo*$totalDisparos;
		$ataqueAbsorvido = 0; //Inicialmente el escudo no absorve danyo

		//Comprobamos si debo atacar al escudo, ya que no lo puedo atravesar y la unidad
		//a atacar lo tiene activado
		if(!$this->getAtraviesaEscudo() && $unidad->getEscudo()){
			//Descontamos la cantidad de escudos destruidos
			$absorcion = $unidad->getEscudo()*(mt_rand($_ENV['config']->get('absorcionEscudoMin'), $_ENV['config']->get('absorcionEscudoMax'))/100);

			//Ataque maximo absorvido por el escudo
			$ataqueAbsorvido = $absorcion*$totalDisparos;

			//Si la cantidad de escudo es menor a mi ataque para los escudos,
			//el atauqe a los escudos pasa a ser el maximo posible
			if($unidad->getEscudoActual()< $ataqueAbsorvido){
				$ataqueAbsorvido = $unidad->getEscudoActual();
			}

			//Si los escudos absorven mas ataque que el emitido, el ataque absorvido es el maximo
			if($ataqueAbsorvido > $ataqueGlobal){
				$ataqueAbsorvido = $ataqueGlobal;
			}

			//Reducimos el escudo
			$unidad->setEscudoActual($unidad->getEscudoActual()-$ataqueAbsorvido);

			//Parte del ataque se ha quedado en el escudo
			$ataqueGlobal -= $ataqueAbsorvido;
		}

		//Resistencia a la que ataco como maximo con mis disparos
		$resistenciaAtacada = ($unidad->getResistenciaActual()/$unidad->getCantidad())*$totalDisparos;

		//Controlamos que la resistencia atacada no sea superior a la actual,
		//si lo es significa que el numero total de unidades a destruir son todas, por eso se modifica
		//el totalDisparos
		if($resistenciaAtacada > $unidad->getResistenciaActual()){
			$resistenciaAtacada=$unidad->getResistenciaActual();
			$totalDisparos = $unidad->getCantidad();
		}

		//Si la resistencia total es menor que el ataque, el ataque sera el maximo posible (toda la resistencia)
		if($resistenciaAtacada < $ataqueGlobal){
			$ataqueGlobal = $resistenciaAtacada;
		}

		//Cantidad maxima destruida
		$maxDestruidas = ceil($unidad->getCantidad()-ceil(($unidad->getResistenciaActual()-$ataqueGlobal)/$unidad->getResistencia()));

		//Si no hay fuego rapido, no puedo destruir mas que la cantidad con la que ataco 1 vs 1
		if($maxDestruidas > $totalDisparos){
			$maxDestruidas = $totalDisparos;
		}

		//Si podemos destruir unidades
		if($maxDestruidas){
			//Calculamos la cantidad minima atacada, teniendo en cuenta que se han atacado
			//a tantas unidades enemigas como disparos realizados como maximo
			$minDestruidas = $totalDisparos - (($totalDisparos*($unidad->getResistenciaActual()/$unidad->getCantidad()))-$ataqueGlobal)/($unidad->getResistencia()*$_ENV['config']->get('porcentajeMinimoResistencia'));

			//Si el minimode destruidas en negativo lo ajustamos a 0
			if($minDestruidas < 0){
				$minDestruidas = 0;
			}
		}
		//Si no podemos destruir unidades, el minimo es igual al maximo
		else{
			$minDestruidas = $maxDestruidas;
		}

		//Obtengo la cantidad de unidades destruidas
		$cantidadDestruidas = ceil(mt_rand($minDestruidas, $totalDisparos));

		//Si la cantidad que quiero destruir sobrepasa el maximo, solo destruyo
		//el minimo. Esto permite apantallar con unidades, ya que el random con muchas unidades
		//es muy probable que de un numero fuera del rango de $minDestruidas y $maxDestruidas,
		//destruyendo de esta manera, solo el minimo (que puede ser 0)
		if($cantidadDestruidas > $maxDestruidas){
			$cantidadDestruidas = $minDestruidas;
		}

		/*
		 * Actualizaciones de estado
		 */
		//Si la unidad se autodestruye actualizamos la cantidad
		if(array_key_exists('autoDestruye', $this->atributos) && $this->atributos['autoDestruye']){
			//Calculamos la cantidad aproximada a autodestruir
			$cantidadAutodestruir=ceil(($ataqueAbsorvido+$ataqueGlobal)/$this->getAtaque()/$nDisparos);
			$this->cantidad -= $cantidadAutodestruir;
			$this->cantidadEliminada += $cantidadAutodestruir;

			if(!$this->cantidad){
				$this->unidadEliminada();
			}
		}

		//Elimino la cantidad de resistencia necesaria
		$unidad->setResistenciaActual($unidad->getResistenciaActual()-$ataqueGlobal);
		
		//Aseguramos el maximo de destruidas
		if($cantidadDestruidas > $unidad->cantidadInicial){
			$cantidadDestruidas=$unidad->cantidadInicial;
		}
		if($cantidadDestruidas > $unidad->getCantidad()){
			$cantidadDestruidas=$unidad->getCantidad();
		}
		

		//Actualizamos las cantidades de defensores
		$unidad->setCantidad($unidad->getCantidad()-$cantidadDestruidas);
		$unidad->setCantidadEliminada($unidad->getCantidadEliminada()+$cantidadDestruidas);

		//Si hemos eliminado unidades, le indicamos al jugador cuanles ha eliminado, para que se registren
		if($cantidadDestruidas){
			$this->heEliminado($unidad, $cantidadDestruidas);
		}

		//Si la cantidad de la unidad es 0 es que el jugador ha perdido esta unidad,
		//asi que se lo indicamos al jugador
		if($unidad->getCantidad()<=0){
			$unidad->unidadEliminada();
		}

		return $this;
	}

	public function almacenarDatos(){
		//Si estoy en mision, actualizo las unidades
		if($this->estaEnMision()){

			/*
			 * Actualizo la informacion que respecta a mi unidad
			 */

			//Si se ha eliminado alguno de los compoenentes de la unidad, se traslada a la bd
			if($this->getCantidadEliminada()){
				/*System_Daemon::info('Mision --> UPDATE unidadJugadorPlanetaMision
					SET cantidadActual=cantidadActual-\''.$this->getCantidadEliminada().'\'
					WHERE idMision=\''.$this->idMision.'\' AND idUnidad=\''.$this->id.'\' AND idJugador=\''.$this->jugador->getId().'\'');*/
				$this->db->query('
					UPDATE unidadJugadorPlanetaMision
					SET cantidadActual=cantidadActual-\''.$this->getCantidadEliminada().'\'
					WHERE idMision=\''.$this->idMision.'\' AND idUnidad=\''.$this->id.'\' AND idJugador=\''.$this->jugador->getId().'\'
				');
			}

			/*
			 * Compruebo si de las unidades que ha matado mi unidad, puedo capturar alguna
			 */
			foreach($this->unidadesEliminadas AS &$info){
				//Obtengo las unidades capturadas
				$capturadas = $this->jugador->capturar($info['unidad'], $info['cantidad']);

				//Si he capturado alguna unidad
				if($capturadas){
					//Registro la transformacion para poderla visualizar en el reporte
					$this->unidadesCapturadas[$info['unidad']->getId()] = $capturadas;

					//Compruebo si la unidad existe en mi planeta de origen
					$consulta = $this->db->query('
						SELECT idPlanetaOrigen, idGalaxiaOrigen
						FROM mision
						WHERE id=\''.$this->idMision.'\'
						LIMIT 1;
					');

					list($idPlaneta, $idGalaxia) = $consulta->fetch_row();

					foreach($capturadas AS $datos){
						//Almacenamos la informacion de la transformacion
						$cantidadCapturada = $datos['cantidad'];
						$unidadCapturada = $datos['unidad'];

						//La cantidad eliminada, es ahora inferior, ya que parte se ha capturado
						$info['cantidad']-=$cantidadCapturada;

						//Compruebo si la unidad existe en el planeta
						$consulta = $this->db->query('
							SELECT 1
							FROM unidadJugadorPlaneta
							WHERE idUnidad=\''.$unidadCapturada.'\' AND idPlaneta=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
							LIMIT 1
						');

						list($existeEnPlaneta) = $consulta->fetch_row();

						if(!$existeEnPlaneta){
							//Anyado la unidad en el planeta
							$this->db->query('
								INSERT INTO unidadJugadorPlaneta
								(idUnidad, idPlaneta, idGalaxia, idJugador, cantidad, contable)
								VALUES(\''.$unidadCapturada.'\', \''.$idPlaneta.'\',\''.$idGalaxia.'\',\''.$this->jugador->getId().'\',\''.$cantidadCapturada.'\', 1)
							');

							//Anyado la unidad a la mision
							$this->db->query('
								INSERT INTO unidadJugadorPlanetaMision
								(idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadActual, cantidadEnviada, contable)
								VALUES(\''.$this->idMision.'\', \''.$unidadCapturada.'\',\''.$this->jugador->getId().'\',\''.$idGalaxia.'\',\''.$idPlaneta.'\', \''.$cantidadCapturada.'\',\''.$cantidadCapturada.'\', 1);
							');
						}
						else{
							//Compruebo si la unidad existe en mision
							$consulta = $this->db->query('
								SELECT 1
								FROM unidadJugadorPlanetaMision
								WHERE idMision=\''.$this->idMision.'\' AND idUnidad=\''.$unidadCapturada.'\' AND idJugador=\''.$this->jugador->getId().'\'
							');

							list($existeEnMision) = $consulta->fetch_row();

							if(!$existeEnMision){
								//Actualizo la unidad en el planeta
								$this->db->query('
									UPDATE unidadJugadorPlaneta
									SET cantidad=cantidad+\''.$cantidadCapturada.'\', contable=1
									WHERE idUnidad=\''.$unidadCapturada.'\' AND idPlaneta=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
								');

								//Anyado la unidad a la mision
								$this->db->query('
									INSERT INTO unidadJugadorPlanetaMision
									(idMision, idUnidad, idJugador, idGalaxia, idPlaneta, cantidadActual, cantidadEnviada, contable)
									VALUES(\''.$this->idMision.'\', \''.$unidadCapturada.'\',\''.$this->jugador->getId().'\',\''.$idGalaxia.'\',\''.$idPlaneta.'\', \''.$cantidadCapturada.'\',\''.$cantidadCapturada.'\', 1);
								');
							}
							else{
								//Actualizo la unidad en el planeta
								$this->db->query('
									UPDATE unidadJugadorPlaneta
									SET cantidad=cantidad+\''.$cantidadCapturada.'\', cantidadEnMision=cantidadEnMision+\''.$cantidadCapturada.'\', contable=1
									WHERE idUnidad=\''.$unidadCapturada.'\' AND idPlaneta=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
								');

								//Actualizo la unidad en la mision
								$this->db->query('
									UPDATE unidadJugadorPlanetaMision
									SET cantidadActual=cantidadActual+\''.$cantidadCapturada.'\', cantidadEnviada=cantidadEnviada+\''.$cantidadCapturada.'\'
									WHERE idMision=\''.$this->idMision.'\' AND idUnidad=\''.$unidadCapturada.'\' AND idJugador=\''.$this->jugador->getId().'\'
								');
							}
						}
					}
				}

				//Si finalmente he eliminado unidades, obtengo sus puntos
				if($info['cantidad']){
					//Actualizo los puntos, contabilizando las unidades destruidas y no las convertidas
					$this->puntosUnidadesEliminadas($info['unidad'], $info['cantidad']);
				}
				//Si no he eliminado las unidades, si no que las he capturado todas, elimino
				//la unidad como unidad eliminada
				else{
					unset($info);
				}
			}
		}
		//Si estoy en un planeta, comprubo si debo eliminar la unidad o actualizarla
		else{
			$consulta = $this->db->query('
				SELECT cantidad
				FROM unidadJugadorPlaneta
				WHERE idUnidad=\''.$this->id.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
			');

			list($cantidad) = $consulta->fetch_row();

			//Si no se han eliminado todas las unidades, actualizo
			if($cantidad > $this->getCantidadEliminada()){
				if($this->getCantidadEliminada()){
					/*System_Daemon::info('Planeta --> UPDATE unidadJugadorPlaneta
						SET cantidad=cantidad-\''.$this->getCantidadEliminada().'\'
						WHERE idUnidad=\''.$this->id.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'');*/
					$this->db->query('
						UPDATE unidadJugadorPlaneta
						SET cantidad=cantidad-\''.$this->getCantidadEliminada().'\'
						WHERE idUnidad=\''.$this->id.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
					');
				}
			}
			//Sino, las elimino
			else{
				/*System_Daemon::info('Planeta --> DELETE FROM unidadJugadorPlaneta
					WHERE idUnidad=\''.$this->id.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'');*/
				$this->db->query('
					DELETE FROM unidadJugadorPlaneta
					WHERE idUnidad=\''.$this->id.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
				');
			}

			/*
			 * Compruebo si de las unidades que ha matado mi unidad, puedo capturar alguna
			 */
			foreach($this->unidadesEliminadas AS &$info){
				//Obtengo las unidades capturadas
				$capturadas = $this->jugador->capturar($info['unidad'], $info['cantidad']);

				//Si he capturado algo, lo proceso
				if($capturadas){
					//Registro la transformacion para poderla visualizar en el reporte
					$this->unidadesCapturadas[$info['unidad']->getId()] = $capturadas;

					//Recorro todas las conversiones
					foreach($capturadas AS $datos){
						$unidadCapturada = $datos['unidad'];
						$cantidadCapturada = $datos['cantidad'];

						//La cantidad eliminada, es ahora inferior, ya que parte se ha capturado
						$info['cantidad']-=$cantidadCapturada;

						$consulta = $this->db->query('
							SELECT 1
							FROM unidadJugadorPlaneta
							WHERE idUnidad=\''.$unidadCapturada.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
							LIMIT 1
						');

						list($existeEnPlaneta) = $consulta->fetch_row();

						if(!$existeEnPlaneta){
							$this->db->query('
								INSERT INTO unidadJugadorPlaneta
								(idUnidad, idPlaneta, idGalaxia, idJugador, cantidad, contable)
								VALUES(\''.$unidadCapturada.'\', \''.$this->planeta.'\',\''.$this->galaxia.'\',\''.$this->jugador->getId().'\',\''.$cantidadCapturada.'\',1)
							');
						}
						else{
							$this->db->query('
								UPDATE unidadJugadorPlaneta
								SET cantidad=cantidad+\''.$cantidadCapturada.'\', contable=1
								WHERE idUnidad=\''.$unidadCapturada.'\' AND idPlaneta=\''.$this->planeta.'\' AND idGalaxia=\''.$this->galaxia.'\' AND idJugador=\''.$this->jugador->getId().'\'
							');
						}
					}
				}

				//Si finalmente he eliminado unidades, obtengo sus puntos
				if($info['cantidad']){
					//Actualizo los puntos, contabilizando las unidades destruidas y no las convertidas
					$this->puntosUnidadesEliminadas($info['unidad'], $info['cantidad']);
				}
				//Si no he eliminado las unidades, si no que las he capturado todas, elimino
				//la unidad como unidad eliminada
				else{
					unset($info);
				}
			}
		}
	}

	//Comprueba si la unidad es especial
	public function esEspecial(){
		return $this->especial != 0;
	}

	//Marca la unidad como eliminada
	public function unidadEliminada(){
		$this->jugador->unidadEliminada();
	}

	/**
	 * Devuelve los puntos perdidos a causa de esta unidad
	 *
	 * @return unknown_type
	 */
	public function puntosPerdidos(){
		return $atributos['puntos']*$cantidadEliminada;
	}

	/**
	 * Indica si esta unidad de encuentra en una mision o se encuentra en un planeta
	 *
	 * @return unknown_type
	 */
	public function estaEnMision(){
		return !empty($this->idMision);
	}

	/**
	 * Asigna un planeta a la unidad, si esta no tiene asignada una mision
	 *
	 * @param unknown_type $galaxia
	 * @param unknown_type $planeta
	 * @return unknown_type
	 */
	public function asignarPlaneta($galaxia, $planeta){
		$this->galaxia = $galaxia;
		$this->planeta = $planeta;
	}

	public function estaDestruida(){
		return $this->cantidad == 0;
	}

	/**
	 * Devuelve TRUE si la unidad puede atacar a la unidad pasada como parametro. FALSE en caso contrario.
	 *
	 * @param unknown_type $unidad
	 * @return unknown_type
	 */
	public function compatible($unidad){
		$ret = TRUE;

		//Segun el tipo de la unidad atacante
		switch($this->tipo){
			case NAVE:
				//Comprobamos el tipo del defensor
				switch($unidad->getTipo()){
					case SOLDADO:
						if($this->subtipo!=CAZA && $this->subtipo!=CAZAPESADO && $this->subtipo!=CRUCERO)
							$ret=false;
						break;
					CASE DEFENSA:
						if($unidad->subtipo==TERRESTRE && $this->subtipo!=CAZA && $this->subtipo!=CAZAPESADO && $this->subtipo!=CRUCERO)
							$ret=false;
						break;
				}
				break;
			case SOLDADO:
				switch($unidad->getTipo()){
					case NAVE:
						if($unidad->subtipo!=CAZA && $unidad->subtipo!=CAZAPESADO && $unidad->subtipo!=CRUCERO)
							$ret=false;
						break;
					case DEFENSA:
						if($unidad->subtipo!=STARGATE && $unidad->subtipo!=TERRESTRE && $unidad->subtipo!=AEREA)
							$ret=false;
						break;
				}
				break;
			case DEFENSA:
				switch($this->subtipo){
					case TERRESTRE:
						if($unidad->getTipo()==NAVE && $unidad->subtipo!=CAZA && $unidad->subtipo!=CAZAPESADO && $unidad->subtipo!=CRUCERO)
							$ret=false;
						break;
					case AEREA:
						if($unidad->getTipo()==SOLDADO)
							$ret=false;
						break;
					case ORBITAL:
						if($unidad->getTipo()==SOLDADO)
							$ret=false;
						break;
				}
				break;
		}

		//Devolvemos el resultado
		return $ret;
	}

	public function getId(){
		return $this->id;
	}

	public function getIdMision(){
		return $this->idMision;
	}

	public function getJugador(){
		return $this->jugador;
	}

	public function getNombre(){
		return $this->atributos['nombreUnidad'];
	}

	public function getAtaque(){
		return $this->attrMejorado['ataque'];
	}

	public function getResistencia(){
		return $this->attrMejorado['resistencia'];
	}

	public function getEscudo(){
		return $this->attrMejorado['escudo'];
	}

	public function getCarga(){
		return $this->attrMejorado['carga'];
	}

	public function getInvisible(){
		return $this->attrMejorado['invisible'];
	}

	public function getCantidad(){
		return $this->cantidad;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function getSubtipo(){
		return $this->subtipo;
	}

	public function getCantidadEliminada(){
		return $this->cantidadEliminada;
	}

	public function getResistenciaActual(){
		return $this->resistencia;
	}

	public function getEscudoActual(){
		return $this->escudo;
	}

	public function setResistenciaActual($val){
		if($val<0)
			$val=0;

		return $this->resistencia=$val;
	}

	public function setEscudoActual($val){
		if($val<0)
			$val=0;

		return $this->escudo=$val;
	}

	public function setCantidad($cantidad){
		if($cantidad<0)
			$cantidad=0;
		
		if($cantidad>$this->cantidadInicial)
			$cantidad=$this->cantidadInicial;

		$this->cantidad=ceil($cantidad);
	}

	public function setCantidadEliminada($cantidad){
		if($cantidad<0)
			$cantidad=0;
		
		if(ceil($cantidad)>$this->cantidadInicial)
			$cantidad=$this->cantidadInicial;

		return $this->cantidadEliminada=ceil($cantidad);
	}

	public function getPuntos($suman=true){
		if($this->esEspecial() && !$suman){
			return 0;
		}
		else{
			return $this->atributos['puntos'];
		}
	}

	public function getAtraviesaEscudo(){
		return $this->atributos['atraviesaEscudo'];
	}

	/**
	 * Escribo la informacion sobre el reporte de la unidad
	 *
	 * @param unknown_type $idMensaje
	 * @return unknown_type
	 */
	public function enviarReporte($idMensaje){
		//Inserto la informacion sobre mis unidades
		$this->db->query('
			INSERT INTO infoMisUnidades
				(idMensaje, idJugador, idUnidad, idTipoUnidad, nombreUnidad, cantidadInicial, cantidadFinal, puntosUnidad)
			VALUES
				(\''.$idMensaje.'\', \''.$this->jugador->getId().'\', \''.$this->id.'\', \''.$this->getTipo().'\',
				"'.$this->getNombre().'", \''.$this->cantidadInicial.'\',
				\''.$this->getCantidad().'\', \''.$this->getPuntos(false).'\')
			ON DUPLICATE KEY UPDATE
				cantidadInicial=cantidadInicial+\''.$this->cantidadInicial.'\',
				cantidadFinal=cantidadFinal+\''.$this->getCantidad().'\'
		');

		//Inserto informacion sobre las unidades que he destruido
		foreach($this->unidadesEliminadas AS $info){
			$unidad = $info['unidad'];
			$cantidad = $info['cantidad'];

			$this->db->query('
				INSERT INTO infoUnidadesAtacadas
					(idMensaje, idJugador, idUnidad, tipo, idTipoUnidad, nombreUnidad, cantidad, puntosObtenidos)
				VALUES
					(\''.$idMensaje.'\', \''.$this->jugador->getId().'\', \''.$unidad->getId().'\', \''.DESTRUIDA.'\', \''.$unidad->getTipo().'\', "'.$unidad->getNombre().'", \''.$cantidad.'\', \''.($unidad->getPuntos()*$cantidad).'\')
				ON DUPLICATE KEY UPDATE
					cantidad=cantidad+\''.$cantidad.'\',
					puntosObtenidos=puntosObtenidos+\''.($unidad->getPuntos()*$cantidad).'\'
			');
		}

		//Inserto informacion sobre las unidades que he capturado
		foreach($this->unidadesCapturadas AS $idOriginal => $transformacion){
			//Recorro las transformaciones de la unidad
			foreach($transformacion AS $convertida){
				$consulta = $this->db->query('
					SELECT nombre, puntos, idTipoUnidad
					FROM unidad
					WHERE id=\''.$convertida['unidad'].'\'
				');

				list($nombreUnidad, $puntosUnidad, $idTipoUnidad) = $consulta->fetch_row();

				//Inserto las nuevas unidades capturadas
				$this->db->query('
					INSERT INTO infoUnidadesAtacadas
						(idMensaje, idJugador, idUnidad, tipo, idTipoUnidad, nombreUnidad, cantidad, puntosObtenidos)
					VALUES
						(\''.$idMensaje.'\', \''.$this->jugador->getId().'\', \''.$convertida['unidad'].'\', \''.CAPTURADA.'\', \''.$idTipoUnidad.'\', "'.$nombreUnidad.'", \''.$convertida['cantidad'].'\', \''.($convertida['cantidad']*$puntosUnidad).'\')
					ON DUPLICATE KEY UPDATE
						cantidad=cantidad+\''.$convertida['cantidad'].'\',
						puntosObtenidos=puntosObtenidos+\''.($convertida['cantidad']*$puntosUnidad).'\'
				');
			}
		}
	}

	/**
	 * FUNCIONES PRIVADAS
	 */

	private function obtenerInfo(){
		//
		//Obtengo los datos genericos de la unidad
		//
		$consulta = $this->db->query('
    		SELECT u.idTipoUnidad AS tipo, COALESCE(eu.idUnidad, FALSE) AS especial, u.nombre AS nombreUnidad, u.puntos, u.ataque, u.resistencia, u.escudo, u.invisible, u.atraviesaEscudo
    		FROM unidad AS u LEFT JOIN especialUnidad AS eu ON (u.id = eu.idUnidad)
    		WHERE u.id = \''.$this->id.'\'
    		LIMIT 1
    	');

		$attr = $consulta->fetch_assoc();

		$consulta->close();

		//Asigno los atributos genericos
		$this->atributos = array_slice($attr, 2);

		//Almaceno el tipo
		$this->tipo = $attr['tipo'];

		//Almaceno si la unidad es especial o no
		$this->especial = $attr['especial'];

		unset($attr);

		//
		//Obtengo los atributos especificos del tipo de la unidad
		//
    	switch($this->tipo){
    		case NAVE:
    			$consulta = $this->db->query('
					SELECT idTipoNave AS subtipo, carga, stargate, hiperespacio, cazas, velocidad
					FROM nave WHERE idUnidad = \''.$this->id.'\'
    			');
    			break;
    		case SOLDADO:
    			$consulta = $this->db->query('
					SELECT idTipoSoldado AS subtipo, carga
					FROM soldado WHERE idUnidad = \''.$this->id.'\'
    			');
    			break;
    		case DEFENSA:
    			$consulta = $this->db->query('
					SELECT idTipoDefensa AS subtipo, autoDestruye, tiempoMover
					FROM defensa WHERE idUnidad = \''.$this->id.'\'
    			');
    			break;
    		case ESPECIAL:
    			break;
    		default:
    			die('Existe un fallo de consistencia entre la base de datos y las constantes del juego');
    	}

    	//Obtengo los datos de la consulta y la cierro
    	$attr = $consulta->fetch_assoc();
    	$consulta->close();

    	//Anyado los atributos especificos a los generales
    	$this->atributos = array_merge($this->atributos, array_slice($attr, 1));

    	//almaceno el subtipo de la unidad
    	$this->subtipo = $attr['subtipo'];

    	unset($attr);


    	return $this;
	}

	private function obtenerFuegoRapido($idTipoDefensor){
		//Compruebo si se debe consultar el fuego rapido
		if(!array_key_exists($this->tipo,self::$fuegoRapido) || !array_key_exists($idTipoDefensor,self::$fuegoRapido[$this->tipo])){
			//Obtengo los atributos especificos del tipo de la unidad
	    	switch($this->tipo){
	    		case NAVE:
	    			switch($idTipoDefensor){
	    				case NAVE:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoNaveNave
			    			');
	    					break;
	    				case SOLDADO:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoNaveSoldado
			    			');
	    					break;
	    				case DEFENSA:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoNaveDefensa
			    			');
	    					break;
	    			}
	    			break;
	    		case SOLDADO:
	    			switch($idTipoDefensor){
	    				case NAVE:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoSoldadoNave
			    			');
	    					break;
	    				case SOLDADO:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoSoldadoSoldado
			    			');
	    					break;
	    				case DEFENSA:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoSoldadoDefensa
			    			');
	    					break;
	    			}
	    			break;
	    		case DEFENSA:
	    			switch($idTipoDefensor){
	    				case NAVE:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoDefensaNave
			    			');
	    					break;
	    				case SOLDADO:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoDefensaSoldado
			    			');
	    					break;
	    				case DEFENSA:
	    					$consulta = $this->db->query('
								SELECT idAtaca, idDefiende, porcentaje
								FROM fuegoDefensaDefensa
			    			');
	    					break;
	    			}
	    			break;
	    		default:
	    			die('Existe un fallo de consistencia entre la base de datos y las constantes del juego');
	    	}

	    	//Inicializo el vector de tipos
	    	self::$fuegoRapido[$this->getTipo()][$idTipoDefensor] = Array();

	    	//Recorro los fuegos rapidos y creo la estructura para almacenarlos
	    	while($row=$consulta->fetch_assoc()){
	    		self::$fuegoRapido[$this->getTipo()][$idTipoDefensor][$row['idAtaca']][$row['idDefiende']]=$row['porcentaje'];
	    	}

	    	//Cierro la consulta y limpio la variable
	    	$consulta->close();
			unset($row);
		}
	}

	private function aplicarMejoras(){
		$mejora = $this->jugador->getMejoras();

		//Anyado los atributos restantes para las unidades
        switch($this->tipo){
        	case NAVE:
        		$this->attrMejorado['ataque']=$this->atributos['ataque']*(($mejora['navesAtaque']/100)+1);
        		$this->attrMejorado['resistencia']=$this->atributos['resistencia']*(($mejora['navesResistencia']/100)+1);
        		$this->attrMejorado['escudo']=$this->atributos['escudo']*(($mejora['navesEscudo']/100)+1);
        		$this->attrMejorado['carga']=$this->atributos['carga']*(($mejora['navesCarga']/100)+1);
        		$this->attrMejorado['velocidad']=$this->atributos['velocidad']*(($mejora['navesVelocidad']/100)+1);

        		$this->attrMejorado['invisible']=$this->atributos['invisible'] || $mejora['invisible'];

        		break;
        	case SOLDADO:
        		$this->attrMejorado['resistencia']=$this->atributos['resistencia']*(($mejora['soldadosResistencia']/100)+1);
        		$this->attrMejorado['ataque']=$this->atributos['ataque']*(($mejora['soldadosAtaque']/100)+1);
        		$this->attrMejorado['escudo']=$this->atributos['escudo']*(($mejora['soldadosEscudo']/100)+1);
        		$this->attrMejorado['carga']=$this->atributos['carga']*(($mejora['soldadosCarga']/100)+1);

        		$this->attrMejorado['invisible']= $this->atributos['invisible'] || $mejora['invisible'];

        		break;
        	case DEFENSA:
        		$this->attrMejorado['resistencia']=$this->atributos['resistencia']*(($mejora['defensasResistencia']/100)+1);
        		$this->attrMejorado['ataque']=$this->atributos['ataque']*(($mejora['defensasAtaque']/100)+1);
        		$this->attrMejorado['escudo']=$this->atributos['escudo']*(($mejora['defensasEscudo']/100)+1);

        		$this->attrMejorado['invisible']= $this->atributos['invisible'] || $mejora['invisible'];

        		break;
        }

        //Pongo los valores iniciales de resistencia y escudo
        $this->resistencia=$this->attrMejorado['resistencia']*$this->cantidad;
        $this->escudo=$this->attrMejorado['escudo']*$this->cantidad;

        return $this;
	}

	private function heEliminado(&$unidad, $cantidad){
		$encontrado = FALSE;

		foreach($this->unidadesEliminadas AS &$info){
			if($info['unidad'] == $unidad){
				$info['cantidad']+=$cantidad;
				$encontrado = TRUE;
				break;
			}
		}

		if(!$encontrado){
			$this->unidadesEliminadas[] = Array('unidad' => $unidad,
												'cantidad' => $cantidad
										);
		}

		return $this;
	}

	private function puntosUnidadesEliminadas(&$unidad, $cantidad){
		//Si la cantidad es distinta de 0, obtenemos los puntos de la unidad eliminada
		if($cantidad){
			switch($unidad->getTipo()){
				case NAVE:
					$this->db->query('
						UPDATE jugadorInfoPuntuaciones
						SET puntosNaves=puntosNaves+\''.($cantidad*$unidad->getPuntos()).'\'
						WHERE idJugador=\''.$this->jugador->getId().'\'
					');
					break;
				case SOLDADO:
					$this->db->query('
						UPDATE jugadorInfoPuntuaciones
						SET puntosSoldados=puntosSoldados+\''.($cantidad*$unidad->getPuntos()).'\'
						WHERE idJugador=\''.$this->jugador->getId().'\'
					');
					break;
				case DEFENSA:
					$this->db->query('
						UPDATE jugadorInfoPuntuaciones
						SET puntosDefensas=puntosDefensas+\''.($cantidad*$unidad->getPuntos()).'\'
						WHERE idJugador=\''.$this->jugador->getId().'\'
					');
					break;
			}
		}
	}

	/**
	 * Obtiene el numero de disparos que se van a realizar contra la unidad
	 */
	private function getNumDisparos(&$unidad){
		//Obtengo la informacion sobre el fuego rapido
		$this->obtenerFuegoRapido($unidad->getTipo());

		//Si este subtipo no tiene ningun tipo de fuego rapido, devuelvo 1 disparo
		if(!array_key_exists($this->getSubtipo(), self::$fuegoRapido[$this->getTipo()][$unidad->getTipo()])){
			return 1;
		}
		//Si no tengo fuego contra la unidad a la que ataco, devuelvo 1 disparo
		elseif(!array_key_exists($unidad->getSubtipo(), self::$fuegoRapido[$this->getTipo()][$unidad->getTipo()][$this->getSubtipo()]))
			return 1;
		//si tengo fuego rapido contra la unidad, devuelvo el numero de disparos que puedo realizar
		else{
			return self::$fuegoRapido[$this->getTipo()][$unidad->getTipo()][$this->getSubtipo()][$unidad->getSubtipo()]/100;
		}
	}

	/**
	 * Recarga el escudo de la unidad teniendo en cuenta que no puede
	 * sobrepasar el maximo original
	 */
	public function recargarEscudo(){
		//Solo se recargan las unidades que tienen sujetos vivos
		if($this->getCantidad() && $this->getEscudoActual()){
			//Cantidad maxima de escudo permitida
			$escudoMaximo = $this->getEscudo()*$this->getCantidad();

			//Posible aumento en el escudo
			$aumentoEscudo = $escudoMaximo*$_ENV['config']->get('recuperacionEscudo');

			//Escudo actual de la unidad
			$escudoActual = $this->getEscudoActual();

			//Si el incremento pasa del maximo, asigno el maximo
			$escudoFinal = ($aumentoEscudo+$escudoActual > $escudoMaximo)? $escudoMaximo : $aumentoEscudo+$escudoActual;

			//Asigno el nuevo valor del escudo a las unidades
			$this->setEscudoActual($escudoFinal);
		}
	}
}
?>
