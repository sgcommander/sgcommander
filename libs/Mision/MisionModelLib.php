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
class MisionModelLib
    extends ModelBase
{





    public function propietarioPlaneta($idGalaxia, $idPlaneta){
    	//Obtengo el id del propietario del planeta
    	$consulta = $this->db->query('
    					SELECT idJugador
    					FROM planetaColonizado
    					WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
    					LIMIT 1
    				');
    	$result = $consulta->fetch_row();

    	return $result[0];
    }

    public function crearEstructuraUnidad($row, &$infoUnidades){
    		//Si la unidad no existe, la creo
    		if(!array_key_exists($row['idUnidad'], $infoUnidades[$row['idJugador']])){
    			//Relleno los campos generales
    			$infoUnidades[$row['idJugador']][$row['idUnidad']] = Array(
    																	'idUnidad' => $row['idUnidad'],
    																	'nombreUnidad' => $row['nombreUnidad'],
    																	'tipo' => $row['tipo'],
    																	'puntos' => $row['puntos'],
    																	'ataque' => $row['ataque'],
    																	'resistencia' => $row['resistencia'],
    																	'escudo' => $row['escudo'],
    																	'invisible' => $row['invisible'],
    																	'atraviesaEscudo' => $row['atraviesaEscudo'],
    																	'cantidadActual' => $row['cantidadActual'],
    																	'cantidadEliminada' => 0
    																);
    			//La informaci�n espec�fica de cada misi�n, se almacena en el vector
    			$infoUnidades[$row['idJugador']][$row['idUnidad']]['mision'] = Array(
    																				$row['idMision'] => Array(
    																										'cantidadActual' => $row['cantidadActual']
    																									)
    																			);
    		}
    		//Si la unidad ya existe, solo anyado los datos especificos de la mision
    		else{
    			//La informaci�n espec�fica de cada misi�n, se almacena en el vector
    			$infoUnidades[$row['idJugador']][$row['idUnidad']]['mision'][$row['idMision']] = Array(
    																								'cantidadActual' => $row['cantidadActual']
    																							);
    			//incremento el numero total de unidades enviadas
    			$infoUnidades[$row['idJugador']][$row['idUnidad']]['cantidadActual']+=$row['cantidadActual'];
    		}
    }

	public function obtenerUnidadesMision($idMision, $idJugador){
		//Variable que almacenara la estructura de las unidades de la mision
    	$infoUnidades = Array();
		
		//Obtengo todos los datos del usuario atacante
    	$consulta = $this->db->query('
    		SELECT idUnidad
    		FROM unidadJugadorPlanetaMision
    		WHERE idMision=\''.$idMision.'\'
    		AND idJugador=\''.$idJugador.'\'
    	');
		
		for($i=0; $i<$consulta->num_rows; $i++){
			$datos=$consulta->fetch_assoc();
			$infoUnidades[$i]=$datos['idUnidad'];
		}

        $consulta->close();
		
		return $infoUnidades;
	}

	public function obtenerUnidadesJugadoresMision($idGalaxia, $idPlaneta, $propietario, $datosJugadores)
    {
    	//Variable que almacenara la estructura de las unidades de cada jugador
    	$infoUnidades[$propietario] = Array();

    	//Construyo los pares a buscar
    	foreach($datosJugadores AS $idJugador => $mision){

    		//Creo el indice para cada jugador
    		$infoUnidades[$idJugador] = Array();

    		//Vector con pares idjugador y idmision para la consulta
    		foreach($mision AS $idMision){
    			$res[]=$idJugador.', '. $idMision;
    		}
    	}

    	//Obtengo todos los datos del usuario atacante
    	$consulta = $this->db->query('
    		SELECT ujpm.idMision, ujpm.idJugador, u.id AS idUnidad, u.nombre AS nombreUnidad, u.idTipoUnidad AS tipo, ujpm.cantidadActual, puntos, ataque, resistencia, escudo, invisible, atraviesaEscudo
    		FROM unidadJugadorPlanetaMision AS ujpm LEFT JOIN unidad AS u ON (u.id = ujpm.idUnidad)
    		WHERE (ujpm.idJugador, ujpm.idMision) IN(('.implode('),(', $res).'))
    	');

    	//Almaceno todos los datos en un vector
    	while($row=$consulta->fetch_assoc()){
    		$this->crearEstructuraUnidad($row, $infoUnidades);
    	}

    	//si existe el propietario del planeta, extraigo tambi�n sus datos
    	if($propietario){
	    	//Obtengo las unidades que residen en el planeta del propietario, no se tienen en cuenta las que tiene fuera del planeta
	    	$consulta = $this->db->query('
	    		SELECT -1 AS idMision, ujp.idJugador, u.id AS idUnidad, u.nombre AS nombreUnidad, u.idTipoUnidad AS tipo, ujp.cantidad-ujp.cantidadEnMision AS cantidadActual, puntos, ataque, resistencia, escudo, invisible, atraviesaEscudo
	    		FROM unidadJugadorPlaneta AS ujp LEFT JOIN unidad AS u ON (u.id = ujp.idUnidad)
	    		WHERE idJugador =\''.$propietario.'\' AND idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\' AND ujp.cantidad-ujp.cantidadEnMision > 0'
	    	);

	    	//Almaceno todos los datos en un vector
	    	while($row=$consulta->fetch_assoc()){
	    		$this->crearEstructuraUnidad($row, $infoUnidades);
	    	}
    	}
    	//Anyado los identificadores del propietario, para facilitar su tratamiento
    	foreach($infoUnidades AS $idJugador => $unidades){
	    	foreach($unidades AS $unidad){
	    		//Anyado los nuevos id y tipos
		    	$listaTiposUnidad[$unidad['tipo']][]=$unidad['idUnidad'];
	    	}
    	}

    	//Obtengo los datos especificos de las unidades
	    $listaDatosUnidad=$this->obtenerDatosTipoUnidad($listaTiposUnidad);

    	//Aplico los valores de cada unidad a todos los jugadores
	    foreach($infoUnidades AS $idJugador => $unidades){
	    	foreach($unidades AS $idUnidad => $datos){
	    		$infoUnidades[$idJugador][$idUnidad]=array_merge($datos, $listaDatosUnidad[$idUnidad]);
	    	}
	   	}

	   	//Devuelvo la informacion de las unidades de todos los jugadores
	   	return $infoUnidades;
    }

	public function obtenerDatosMision($idMision){
		//Obtiene todos los campos de la tabla mision, ademas de obtener el tipo de mision por nombre y no por id
    	$consulta = $this->db->query('
			SELECT m.id, LOWER(tm.nombre) AS tipo, m.idTipoMision, m.idJugador, m.idGalaxiaOrigen, m.idGalaxiaDestino,
				m.idPlanetaOrigen, m.idPlanetaDestino,
				UNIX_TIMESTAMP(m.fechaSalida) AS fechaSalida, m.tiempoTrayecto,
				m.vuelta, tm.permanencia AS permanente, m.nuevaMision, m.idGalaxiaDespliegue, m.idPlanetaDespliegue
			FROM mision AS m LEFT JOIN tipoMision AS tm ON (m.idTipoMision = tm.id) WHERE m.id='.$idMision
		);

		return $consulta->fetch_assoc();
    }

	/**
     * Obtiene la informacion necesaria de todos los jugadores y la
     * almacena en la estructura correspondiente
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function obtenerDatosJugadoresMision($idJugadores)
    {

        //Selecciona la informacion de los jugadores que participan
		$consulta = $this->db->query('
			SELECT jiu.idJugador, j.idAlianza, jiu.soldadosCarga, jiu.soldadosAtaque, jiu.soldadosResistencia, jiu.soldadosEscudo,
					jiu.navesCarga, jiu.navesAtaque, jiu.navesResistencia, jiu.navesEscudo, jiu.navesVelocidad,
					jiu.defensasAtaque, jiu.defensasResistencia, jiu.defensasEscudo, jiu.invisible, jiu.atraviesaIris
			FROM jugadorInfoUnidades AS jiu LEFT JOIN jugador AS j ON (jiu.idJugador = j.idUsuario)
			WHERE idJugador IN ('.implode(',', $idJugadores).')
		');

		//Almaceno los datos de los jugadores y clasificandolos ademas por alianzas
		$bando=0;//Numero de bando por el que se empieza
		$idBandoAlianzas=Array();//Indica para cada alianza que id de bando tiene asignado (autoasignado la primera vez que se encuentra la alianza)
		$infoJugadores=Array();//Indica la informacion completa de los jugadores

		//Asigno la informacion en la estructura
		while($row=$consulta->fetch_assoc()){
			//Si el jugador no tiene alianza, creo un bando para el solo
			if(empty($row['idAlianza'])){
				//Almaceno los datos
				$infoJugadores[$bando]['jugadores'][$row['idJugador']]['mejoras']=array_slice($row, 1);
				//Indico que este bando solo contendra un jugador
				$infoJugadores[$bando++]['info']['numJugadores']=1;
			}
			//Si el jugador pertenece a una alianza
			else{
				//Compruebo si dicha alianza ya tiene un bando asignado, sino le asigno uno
    			if(!array_key_exists($row['idAlianza'], $idBandoAlianzas)){
    				//Indico que numero de bando le pertenece a la alianza
    				$idBandoAlianzas[$row['idAlianza']]=$bando++;

    				//Inicializo el contador de los jugadores del bando a 0
    				$infoJugadores[$idBandoAlianzas[$row['idAlianza']]]['info']['numJugadores']=0;
    			}

    			//Almaceno la informacion en la estructura
				$infoJugadores[$idBandoAlianzas[$row['idAlianza']]]['jugadores'][$row['idJugador']]['mejoras']=array_slice($row, 1);
				$infoJugadores[$idBandoAlianzas[$row['idAlianza']]]['info']['numJugadores']++;
			}
		}

		return $infoJugadores;

    }

	/**
     * Obtiene la informacion necesaria del propietario de la mision
     * almacena en la estructura correspondiente
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 27/08/2009
     */
    public function obtenerDatosJugadorMision($idJugador)
    {

        //Selecciona la informacion de los jugadores que participan
		$consulta = $this->db->query('
			SELECT jiu.soldadosCarga, jiu.soldadosAtaque, jiu.soldadosResistencia, jiu.soldadosEscudo,
					jiu.navesCarga, jiu.navesAtaque, jiu.navesResistencia, jiu.navesEscudo, jiu.navesVelocidad,
					jiu.defensasAtaque, jiu.defensasResistencia, jiu.defensasEscudo, jiu.invisible, jiu.atraviesaIris,
					jiu.viajeIntergalactico, jiu.stargateIntergalactico
			FROM jugadorInfoUnidades AS jiu
			WHERE jiu.idJugador=\''.$idJugador.'\' LIMIT 1
		');
		
		$result = $consulta->fetch_assoc();

		return $result;
    }

	public function volver($idMision, $permanente, $tExtra = 0, $tPenalizacion=0)
	{
		//ESTAS DOS SENTENCIAS SE PUEDEN UNIR A TRAVES DE UN IF Y LA CONCATENACION, PERO ASI SON MAS CLARAS

		//Esta funcion activa el bit de vuelta y calcula la hora correcta de salida, corrigiendo el tiempo necesario
		//Para controlar la funcion, en el where se anyade vuelta=0 para que no se pueda mandar de vuelta algo que ya lo esta

		//Si es permanente, el tiempo de salida debera ser NOW, si es que ya ha llegado al destino, ya que este se espera (primera opcion)
		//Si el la mision no ha llegado al destino, se calcula el tiempo de salida para que llegue al origen en el tiempo que lleva en curso la mision (segunda opcion)
		$tiempoActual=time();
		if($permanente){
			$sql='UPDATE mision SET vuelta = 1, fechaSalida =
				FROM_UNIXTIME(
					LEAST(
						'.($tiempoActual+$tPenalizacion).',
						'.$tPenalizacion.'+('.$tiempoActual.'-(tiempoTrayecto-('.$tiempoActual.'-UNIX_TIMESTAMP(fechaSalida))))
					)) WHERE id ='.$idMision.' and vuelta=0';
		}
		//Si no es permanente, el tiempo de salida en caso de haber llegado al planeta, sera el tiempo actual, menos el tiempo de retraso de la actualizacion con respecto a la llegada  (primera opcion)
		//Si el la mision no ha llegado al destino, se calcula el tiempo de salida para que llegue al origen en el tiempo que lleva en curso la mision (segunda opcion)
		else{
			$sql='UPDATE mision SET vuelta = 1, fechaSalida =
				FROM_UNIXTIME(
					LEAST(
						'.$tiempoActual.'-(('.$tiempoActual.'-UNIX_TIMESTAMP(fechaSalida))-tiempoTrayecto)+'.($tExtra+$tPenalizacion).',
						'.$tPenalizacion.'+('.$tiempoActual.'-(tiempoTrayecto-('.$tiempoActual.'-UNIX_TIMESTAMP(fechaSalida))))
					)) WHERE id ='.$idMision.' and vuelta=0';
		}

		//Ejecuto la consulta
		$this->db->query($sql);

		return $this->db->affected_rows;

	}

	public function trasladarAntiguasMisiones($idJugador, $idGalaxia, $idPlaneta, $tiempoMaximo){
    //Si tengo algun desplegar en el planeta, debo actualizar la fecha a la actual y finalizar la mision
	    	$consulta = $this->db->query('
	    		SELECT m.id
	    		FROM mision AS m JOIN tipoMision AS tm ON (m.idTipoMision = tm.id)
	    		WHERE m.idJugador=\''.$idJugador.'\' AND tm.id=\''.DESPLEGAR.'\'
	    			AND m.idGalaxiaDestino=\''.$idGalaxia.'\' AND m.idPlanetaDestino=\''.$idPlaneta.'\'
	    			AND (UNIX_TIMESTAMP(m.fechaSalida)+m.tiempoTrayecto) <= '.$tiempoMaximo
	    	);

	    	while(list($idDesplegar) = $consulta->fetch_row()){
	    		$this->borrarMision($idDesplegar);
	    	}
    }

	public function borrarMision($idMision)
	{
		//Elimino las unidades de la mision
		//TODO ATENCION! Esto se debe hacer por culpa de un bug de mysql, que al ejecutar el DELETE CASCADE desde la tabla mision
		//el trigger de unidadJugadorPlanetaMision_BD no lo detecta, con lo que no se ejecuta y forma una inconsistencia de datos.
		//Eliminando manualmente las entradas de unidadJugadorPlanetaMision se fuerza a dispararse el trigger y los datos se mantienen integros.
		$this->db->query('
			DELETE FROM unidadJugadorPlanetaMision WHERE idMision='.$idMision
		);

		$this->db->query('
			DELETE FROM recursosObtenidos WHERE idMision='.$idMision
		);

		//Elimino la mision de la base de datos
		$this->db->query('
			DELETE FROM mision WHERE id='.$idMision
		);
	}
	
	public function borrarMisionDesplegar($idMision, $idJugador)
	{
		//Elimino el evento para no comprobar constantemente los despliegues
		$this->db->query('
			DELETE FROM evento
			WHERE id='.$idMision.'
			AND idJugador='.$idJugador.'
			AND tipo='.EVENTOMISION
		);
	}

	public function estaColonizado($idGalaxia, $idPlaneta){
		$consulta = $this->db->query('
				SELECT 1
				FROM planetaColonizado
        		WHERE idPlaneta=\''.$idPlaneta.'\'
        				AND idGalaxia=\''.$idGalaxia.'\'
        		LIMIT 1');

        //Devuelve true si el planeta esta colonizado
        return $consulta->num_rows == 1;
	}

	public function numPlanetasColonizados($idJugador){
		$consulta = $this->db->query('SELECT COUNT(*)
        									FROM planetaColonizado
											WHERE idJugador=\''.$idJugador.'\'');

		$result = $consulta->fetch_row();

		return $result[0];
	}

	public function numMaxPlanetasColonizados($idJugador){
		$consulta = $this->db->query('
					SELECT maxPlanetas
					FROM raza
					WHERE id=(
								SELECT idRaza
								FROM jugador
								WHERE idUsuario='.$idJugador.'
							)');

		$result=$consulta->fetch_row();

		return $result[0];
	}

    public function colonizarPlaneta($idJugador, $idGalaxia, $idPlaneta, $tiempoColonizacion){
    	//Lo colonizo
        $this->db->query('
        	INSERT INTO planetaColonizado
        			(idPlaneta,idGalaxia,idJugador,principal)
        	VALUES ('.$idPlaneta.','.$idGalaxia.','.$idJugador.',0)');

        //Lo anyado a Tu lista del usuario para que este disponible
        $this->db->query('
        	UPDATE planetaExplorado
        	SET visible=1
        	WHERE idPlaneta=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\' AND idJugador=\''.$idJugador.'\'');

        //Hago el traslado de posibles misiones de despliegue que hubieran mias en el planeta
        $this->trasladarAntiguasMisiones($idJugador, $idGalaxia, $idPlaneta, $tiempoColonizacion);
    }

    public function nuevoPlanetaExplorado($idJugador, $idGalaxia, $idPlaneta)
    {
        $this->db->query('INSERT IGNORE INTO planetaExplorado (idPlaneta, idGalaxia, idJugador, visible)
        		VALUES('.$idPlaneta.', '.$idGalaxia.', '.$idJugador.', 0);');
    }

    public function esPropietarioPlaneta($idJugador, $idGalaxia, $idPlaneta){
    	$consulta = $this->db->query(
    			'SELECT 1
    			FROM planetaColonizado
        		WHERE idPlaneta=\''.$idPlaneta.'\'
        				AND idGalaxia=\''.$idGalaxia.'\'
        				AND idJugador=\''.$idJugador.'\'
        		LIMIT 1');

    	//Si la consutla devuelve una linea, es que el planeta es mio
    	return $consulta->num_rows == 1;
    }

    public function obtenerRiqueza($idGalaxia, $idPlaneta)
    {

        $consulta = $this->db->query('SELECT riqueza
        					FROM planeta
        					WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'');
        return $consulta->fetch_row();
    }

	public function obtenerPorcentajeRecoleccion($idJugador){
        //Obtenemos los porcentajes para la recoleccion, de la raza del jugador
        $consulta = $this->db->query('SELECT porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario
        					FROM raza
        					WHERE id=(SELECT idRaza FROM jugador WHERE idUsuario=\''.$idJugador.'\')');
        return $consulta->fetch_row();
	}

	public function almacenarRecursos($idMision, $idJugador, $primario, $secundario){
        //Insertamos las cantidades recolectadas en la mision
        $this->db->query(
        		'INSERT INTO recursosObtenidos (idMision, idTipoRecurso, idJugador, cantidad) VALUES
        			(\''.$idMision.'\', 1, \''.$idJugador.'\', \''.$primario.'\'),
        			(\''.$idMision.'\', 2, \''.$idJugador.'\', \''.$secundario.'\')
        			ON DUPLICATE KEY UPDATE cantidad=cantidad'
        );
	}

	public function obtenerProduccionJugadores($idJugadores){
		$consulta=$this->db->query('
				SELECT idJugador, produccionPrimario, produccionSecundario
				FROM jugadorInfoGeneral
				WHERE idJugador IN ('.implode(',', $idJugadores).')
		');

		while($row = $consulta->fetch_assoc()){
			$producciones[$row['idJugador']][0]=$row['produccionPrimario'];
			$producciones[$row['idJugador']][1]=$row['produccionSecundario'];
		}

		return $producciones;
	}

	private function infoJugadoresBatalla($idJugadores){
		//Obtengo la informacion del usuario
		$result = $this->db->query('
			SELECT u.id AS idJugador, j.idRaza, j.idAlianza, u.nombre AS nombreJugador, r.nombre AS nombreRaza, a.titulo AS nombreAlianza
			FROM usuario AS u JOIN jugador AS j ON (u.id = j.idUsuario)
				LEFT JOIN alianza AS a ON (j.idAlianza = a.id)
				LEFT JOIN raza AS r ON (j.idRaza = r.id)
			WHERE idUsuario IN (\''.implode('\', \'', $idJugadores).'\')
		');

		//Almaceno toda la info, ordenada por jugador
		while($row = $result->fetch_assoc()){
			$infoJugadores[$row['idJugador']]=$row;
		}

		return $infoJugadores;
	}

	private function infoUnidadesBatalla($idUnidades){
		//Declaracion de la informacion
		$infoUnidades = Array();

		//Obtengo la informacion de las unidades
		$result = $this->db->query('
			SELECT id AS idUnidad, idTipoUnidad, nombre AS nombreUnidad, puntos AS puntosUnidad
			FROM unidad
			WHERE id IN (\''.implode('\', \'', $idUnidades).'\')
		');

		//Almaceno toda la info, ordenada por idUnidad
		while($row = $result->fetch_assoc()){
			$infoUnidades[$row['idUnidad']]=$row;
		}

		return $infoUnidades;
	}

	/**
     * Genera un reporte de mision
     *
     * @access public
     * @author
     * @return mixed
     * @since 27/08/2009
     */
	public function enviarReporteMision($asunto, $destinatarios, $html){

        $this->db->query('INSERT INTO mensaje (asunto, contenido, idTipoMensaje)
        								VALUES (\''.$asunto.'\', \'\', \'4\')');

        //Capturamos el id del mensaje
        $idMensaje=$this->db->insert_id;

        //Insertamos el html
        $this->db->query('INSERT INTO reporte (idMensaje, html)
        								VALUES (\''.$idMensaje.'\', \''.strtr($html, array( '\'' => '&#39;') ).'\')');

        //Realizamos el lote de consultas (asignamos a los destinatarios el reporte)
        $sql='INSERT INTO recibeMensaje (idMensaje, idJugador) VALUES ';
        foreach($destinatarios as $idReceptor)
        	$sql.='(\''.$idMensaje.'\', \''.$idReceptor.'\'), ';

        //Elimino los caracteres ", " del final de la cadena
       	$sql=substr($sql, 0, -2);

       	$this->db->query($sql);

        return $this->db->errno==0;
	}

	/**
     * Envia un aviso de mision
     *
     * @access public
     * @author
     * @return mixed
     * @since 29/06/2010
     */
	public function enviarAviso($asunto, $destinatarios, $mensaje){

        $this->db->query('INSERT INTO mensaje (asunto, contenido, idTipoMensaje)
        								VALUES (\''.$asunto.'\', \''.addslashes($mensaje).'\', \''.MENSAJEAVISO.'\')');

        //Capturamos el id del mensaje
        $idMensaje=$this->db->insert_id;

        //Realizamos el lote de consultas (asignamos a los destinatarios el reporte)
        $sql='INSERT INTO recibeMensaje (idMensaje, idJugador) VALUES ';
        foreach($destinatarios as $idReceptor)
        	$sql.='(\''.$idMensaje.'\', \''.$idReceptor.'\'), ';

        //Elimino los caracteres ", " del final de la cadena
       	$sql=substr($sql, 0, -2);

       	$this->db->query($sql);

        return $this->db->errno==0;
	}

 	/**
     * Devuelve la información de un planeta
     * dado su idGalaxia y su idPlaneta
     *
     * @access public
     * @author David & Jose
     * @param  Integer idGalaxia
     * @param  Integer idPlaneta
     * @param  Integer idJugador
     * @param  Integer idAlianza
     * @return mixed
     * @since 27/01/2009
     */
    public function planeta($idGalaxia, $idPlaneta)
    {

        $consulta = $this->db->query(
					'SELECT p.idPlaneta,p.idGalaxia,pe.idPropietario,
					p.nombrePlaneta,p.nombreSGC,p.riqueza,
					IFNULL(pes.imagen,CONCAT(CONCAT(p.idGalaxia,"_"),CONCAT(p.riqueza,".jpg"))) AS imagen,
					a.id AS idAlianza, a.titulo AS alianza, u.nombre as propietario,
					p.coord1,p.coord2,p.coord3,p.coord4,p.coord5,p.coord6,p.coord7
					FROM (planeta AS p LEFT JOIN planetaExplorado AS pe
					ON pe.idPlaneta=p.idPlaneta AND pe.idGalaxia=p.idGalaxia)
					LEFT JOIN jugador AS g ON g.idUsuario=pe.idPropietario
					LEFT JOIN usuario AS u ON u.id=g.idUsuario
					LEFT JOIN alianza AS a ON a.id=g.idAlianza
					LEFT JOIN planetaEspecial pes
					ON p.idPlaneta=pes.idPlanetaEsp AND p.idGalaxia=pes.idGalaxia
					WHERE p.idGalaxia=\''.$idGalaxia.'\'
					AND p.idPlaneta=\''.$idPlaneta.'\'
					LIMIT 1');

        $datos=$consulta->fetch_assoc();

        $consulta->close();

		return $datos;

    }

/**
     * Devuelve la información de un planeta
     * dado su idGalaxia y su idPlaneta
     *
     * @access public
     * @author David & Jose
     * @param  Integer idGalaxia
     * @param  Integer idPlaneta
     * @param  Integer idJugador
     * @param  Integer idAlianza
     * @return mixed
     * @since 27/01/2009
     */
    public function raza($idJugador)
    {

        $consulta = $this->db->query(
					'SELECT j.idRaza, r.nombre AS primario, r2.nombre AS secundario
					FROM jugador AS j
					JOIN recursoRaza AS r ON r.idRaza=j.idRaza AND r.idTipoRecurso=1
					JOIN recursoRaza AS r2 ON r2.idRaza=j.idRaza AND r2.idTipoRecurso=2
					WHERE j.idUsuario=\''.$idJugador.'\'
					LIMIT 1');

        $datos=$consulta->fetch_assoc();

        $consulta->close();

		return $datos;

    }

    //Aumenta los puntos a los jugadores, por las unidades destruidas
    public function aumentarPuntos($infoDestruidas){
    	//Obtengo todos los identificadores de las unidades
    	$idUnidades = Array();
    	foreach($infoDestruidas AS $idJugador => $unidad){
    		foreach($unidad AS $idUnidad => $datos){
    			$idUnidades[]=$idUnidad;
    		}
    	}

    	//Obtengo los puntos y el tipo
    	$resultado = $this->db->query('
    		SELECT id, idTipoUnidad, puntos
    		FROM unidad
    		WHERE id IN (\''.implode('\',\'', $idUnidades).'\')
    	');

    	while($row = $resultado->fetch_assoc()){
    		$info[$row['id']] = Array('idTipoUnidad' => $row['idTipoUnidad'],
    								'puntos' => $row['puntos']
    							);
    	}

    	//Genero el vector para las columnas a las cuales asignar los puntos
    	$columna=Array();
    	$columna[NAVE]='puntosNaves';
    	$columna[SOLDADO]='puntosSoldados';
    	$columna[DEFENSA]='puntosDefensas';

    	//Asigno los puntos obtenidos en batalla a los jugadores correspondientes
    	foreach($infoDestruidas AS $idJugador => $unidad){
    		foreach($unidad AS $idUnidad => $destruidas){
    			$this->db->query(
    				'UPDATE jugadorInfoPuntuaciones
    				SET '.$columna[$info[$idUnidad]['idTipoUnidad']].'='.$columna[$info[$idUnidad]['idTipoUnidad']].'+'.($info[$idUnidad]['puntos']*$destruidas['destruida']).'
    				WHERE idJugador=\''.$idJugador.'\'
    			');
    		}
    	}
    }

    public function conquistar($idJugador, $idGalaxia, $idPlaneta, $tiempoConquista){
    	if($this->puedeColonizar($idJugador, $idGalaxia, $idPlaneta)){
    		//Elimino las unidades que se estan construyendo en el planeta
    		$this->db->query('
	    		DELETE FROM unidadConstruir
	    		WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
	    	');

	    	//Elimino las unidades de la mision que tengan como salida el planeta a conquistar
	    	$this->db->query('
	    		DELETE FROM unidadJugadorPlanetaMision
	    		WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
	    	');

	    	//Elimino las misiones que tiene de origen mi planeta
	    	$this->db->query('
	    		DELETE FROM mision
	    		WHERE idGalaxiaOrigen=\''.$idGalaxia.'\' AND idPlanetaOrigen=\''.$idPlaneta.'\'
	    	');

	    	//Elimino las unidades que esten en el planeta
	    	$this->db->query('
	    		DELETE FROM unidadJugadorPlaneta
	    		WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
	    	');

	    	//Elimino el planeta de planeta colonizado
	    	$this->db->query('
	    		DELETE FROM planetaColonizado
	    		WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\'
	    	');

	    	//Asigno el planeta especial a mi nombre
	    	$this->db->query('
	    		INSERT INTO planetaColonizado (idPlaneta, idGalaxia, idJugador)
	    		VALUES (\''.$idPlaneta.'\', \''.$idGalaxia.'\', \''.$idJugador.'\')
	    	');

	    	//Hago el traslado de posibles misiones de despliegue que hubieran mias en el planeta
        	$this->trasladarAntiguasMisiones($idJugador, $idGalaxia, $idPlaneta, $tiempoConquista);

    		return True;
    	}
    	else{
    		return False;
    	}
    }

    public function puedeColonizar($idJugador, $idGalaxia, $idPlaneta){
    	//Compruebo que el usuario no este ni de vacaciones ni baneado
    	$consulta = $this->db->query('
    					SELECT UNIX_TIMESTAMP(vacaciones) AS vacaciones, UNIX_TIMESTAMP(bloqueado) AS bloqueado
    					FROM jugador
    					WHERE idUsuario IN (
    							SELECT idJugador
    							FROM planetaColonizado
    							WHERE idGalaxia=\''.$idGalaxia.'\' AND idPlaneta=\''.$idPlaneta.'\')
    					LIMIT 1
    				');

    	list($vacaciones, $bloqueado) = $consulta->fetch_row();

    	$consulta->close();

    	//Si el usuario al que quiero conquistar no esta ni de vacaciones, ni baneado porsigo con la conquista
    	if($vacaciones=='' && ($bloqueado=='' || $bloqueado < time())){
	    	//Compruebo que no he llegado al maximo de planetas
	    	$consulta = $this->db->query('
	    					SELECT COUNT(*)
	    					FROM planetaColonizado
	    					WHERE idJugador=\''.$idJugador.'\'
	    				');

	    	list($actual) = $consulta->fetch_row();

	    	$consulta->close();

	    	$consulta = $this->db->query('
	    					SELECT r.maxPlanetas
	    					FROM jugador AS j JOIN raza AS r ON j.idRaza=r.id
	    					WHERE j.idUsuario=\''.$idJugador.'\'
	    					LIMIT 1
	    				');

	    	list($limite) = $consulta->fetch_row();

	    	$consulta->close();

	    	return $actual < $limite;
    	}
    	else{
    		return False;
    	}
    }

    /**
     * Devuelve el tipo de unidades de la mision.
     *
     * @access public
     * @author David & Jose
     * @param  Integer idMision
     * @return mixed
     * @since 27/05/2010
     */
    public function misionTipo($idMision)
    {

        $consulta = $this->db->query(
					'SELECT u.idTipoUnidad
					FROM unidadJugadorPlanetaMision m JOIN unidad u ON m.idUnidad=u.id
					WHERE m.idMision=\''.$idMision.'\' LIMIT 1');

		$datos=$consulta->fetch_assoc();

        $consulta->close();

        return $datos['idTipoUnidad'];

    }
}

?>