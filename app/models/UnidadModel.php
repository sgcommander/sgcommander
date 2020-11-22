<?php
	/**
	 * Gestiona los datos de las unidades
	 *
	 * @author David & Jose
	 * @package models
	 * @since 31/05/2009
	 */



	/**
	 * Gestiona los datos de las unidades
	 *
	 * @abstract
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 31/05/2009
	 */
	abstract class UnidadModel
	    extends ModelBase
	{
	    /**
	     * Representa la tabla de los hijos
	     *
	     * @access protected
	     * @since 01/06/2009
	     * @var String
	     */
	    protected $tabla = '';



	    /**
	     * Construye x cantidad de naves
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idRaza
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer cantidad
	     * @param  Integer idUnidad
	     * @return mixed
	     * @since 13/05/2009
	     */
	    public function construir($idJugador, $idRaza, $idGalaxia, $idPlaneta, $cantidad, $idUnidad)
	    {
	        //Compruebo que la unidad que quiero construir este disponible
	        //El primer subselect extrae las unidades que puedo construir gracais a planetas especiales que tengo
	        //El segundo subselect obtiene las unidades que puedo construir gracias a mi raza e investigaciones, se tiene en cuenta
	        //que solo se peude cosntruir un heroe
	        $consulta=$this->db->query('
	        	SELECT 1
						FROM
							((
							SELECT pu.idUnidad AS id
							FROM planetaUnidad pu JOIN '.$this->tabla.' n ON pu.idUnidad=n.idUnidad
							WHERE idPlanetaEsp=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\')

							UNION

							(SELECT u.id
							FROM unidad AS u JOIN '.$this->tabla.' AS n ON u.id=n.idUnidad
								JOIN unidadMejora AS um ON u.id=um.idUnidad
								LEFT JOIN jugadorMejora AS jm ON jm.idMejora=um.idMejora AND jm.idJugador=\''.$idJugador.'\'
							WHERE u.idRaza=\''.$idRaza.'\'
							GROUP BY u.id
							HAVING MIN(COALESCE(jm.nivel,0)-um.nivel)>=0)) AS idr

							LEFT JOIN unidadHeroe AS uh ON uh.idUnidad=idr.id
							LEFT JOIN unidadJugadorPlaneta AS ujp ON ujp.idUnidad=idr.id  AND ujp.idJugador=\''.$idJugador.'\'
							LEFT JOIN unidadConstruir AS uc ON uc.idUnidad=idr.id  AND uc.idJugador=\''.$idJugador.'\'
						WHERE
							idr.id=\''.$idUnidad.'\' AND (uh.idUnidad IS NULL OR ((COALESCE(ujp.cantidad,0)+COALESCE(ujp.cantidadEnMision,0)=0) AND uc.idUnidad IS NULL) AND 1=\''.$cantidad.'\')
						');

	    	//$encontrado vale 1 si se ha encontrado coincidencia y 0 en caso contrario
	        list($encontrado)=$consulta->fetch_row();

	        //Elimino la consulta
	        $consulta->close();

	        //Si la unidad esta disponible la pongo en construccion
	        if(!$encontrado)
	        	return false;
	        else{
		        $this->db->query('INSERT INTO unidadConstruir (idUnidad, idGalaxia, idPlaneta, idJugador, cantidad, fechaConstruccionInicial)
		        							VALUES(\''.$idUnidad.'\',\''.$idGalaxia.'\',\''.$idPlaneta.'\',\''.$idJugador.'\',\''.$cantidad.'\', FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].'))');

		        $res = $this->db->errno==0;

		        //Actualizamos toda la informacion de sesion, respecto a puntos y cantidad de unidades por tipo, ya que si se esta
		        //construyendo una unidad que requiere de otras, esos valores cambiaran
		        //Cargamos todos los datos secundarios del usuario en sesion
				$info = new InfoJugadorModel();

				//Cargando tabla jugadorInfoGeneral
				list($_SESSION['infoJugador']['investigacionVelocidad'], $_SESSION['infoJugador']['construccionVelocidad'], $_SESSION['infoJugador']['numeroMensajes'], $_SESSION['infoUnidades']['limiteMisiones'],
				$_SESSION['infoUnidades']['numNaves'], $_SESSION['infoUnidades']['numSoldados'], $_SESSION['infoUnidades']['limiteSoldados'],
				$_SESSION['infoUnidades']['numDefensas'], $_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'],
				$_SESSION['infoRecursos'][2]['produccion']) = $info->infoGeneral($_SESSION['infoJugador']['idUsuario']);

				//Cargando tabla jugadorInfoUnidades
				$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);

		        return $res;
	        }

	    }

	    /**
	     * Cancela la construccion
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function cancelar($idJugador, $idGalaxia, $idPlaneta)
	    {
	        $this->db->query('DELETE FROM unidadConstruir
	        				WHERE idJugador=\''.$idJugador.'\'
	        					AND idGalaxia=\''.$idGalaxia.'\'
	        					AND idPlaneta=\''.$idPlaneta.'\'
	        					AND idUnidad IN (SELECT idUnidad FROM '.$this->tabla.')');

	        $res = $this->db->errno==0;

	        //Actualizamos toda la informaci�n de sesion, respecto a puntos y cantidad de unidades por tipo, ya que si se esta
	        //construyendo una unidad que requiere de otras, esos valores cambiar�n
	        //Cargamos todos los datos secundarios del usuario en sesion
			$info = new InfoJugadorModel();

			//Cargando tabla jugadorInfoGeneral
			list($_SESSION['infoJugador']['investigacionVelocidad'], $_SESSION['infoJugador']['construccionVelocidad'], $_SESSION['infoJugador']['numeroMensajes'], $_SESSION['infoUnidades']['limiteMisiones'],
			$_SESSION['infoUnidades']['numNaves'], $_SESSION['infoUnidades']['numSoldados'], $_SESSION['infoUnidades']['limiteSoldados'],
			$_SESSION['infoUnidades']['numDefensas'], $_SESSION['infoRecursos'][0]['produccion'], $_SESSION['infoRecursos'][1]['produccion'],
			$_SESSION['infoRecursos'][2]['produccion']) = $info->infoGeneral($_SESSION['infoJugador']['idUsuario']);

			//Cargando tabla jugadorInfoUnidades
			$_SESSION['infoPuntuacion'] = $info->infoPuntuacion($_SESSION['infoJugador']['idUsuario']);

	        return $res;

	    }

	    /**
	     * Devuelve el id de la construccion actual o 0 en caso de no haber
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function construccionActual($idJugador, $idGalaxia, $idPlaneta)
	    {

	        $consulta = $this->db->query(
	        			'SELECT uc.idUnidad, uc.cantidad, TIMESTAMPDIFF(SECOND,NOW(),uc.fechaConstruccionFinal) AS tiempo, TIMESTAMPDIFF(SECOND,uc.fechaConstruccionInicial,uc.fechaConstruccionFinal) AS tiempoTotal
						FROM unidadConstruir uc
						JOIN '.$this->tabla.' t ON t.idUnidad = uc.idUnidad
						WHERE uc.idJugador=\''.$idJugador.'\'
							AND uc.idGalaxia=\''.$idGalaxia.'\'
							AND uc.idPlaneta=\''.$idPlaneta.'\' LIMIT 1');

	        $unidad=null;
			if($consulta->num_rows!=0){
	        	$unidad=$consulta->fetch_assoc();
			}

			$consulta->close();
			return $unidad;

	    }

	    /**
	     * Devuelve las unidades construibles por un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idRaza
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function construibles($idJugador, $idRaza, $idGalaxia, $idPlaneta)
	    {

			//En el primer subselect, selecciono las unidades que nos aportan los planetas especiales
			//En el segundo subselect obtenfo las unidades que nos aporta la raza
			//En el select que engloba a los anteriores, selecciono el campo a seleccionar por el IN (es obligatorio)
			//En el select superior, selecciono los datos de las unidades disponibles para la construccion
	    	$consulta = $this->db->query('
				SELECT id, nombre, descripcion, tiempo, ataque, resistencia, escudo, invisible, atraviesaEscudo, h.idUnidad IS NOT NULL AS heroe
				FROM unidad AS u LEFT JOIN unidadHeroe AS h ON u.id=h.idUnidad
				WHERE id IN (
						(SELECT idr.id
						FROM
							((SELECT pu.idUnidad AS id
							FROM planetaUnidad pu JOIN '.$this->tabla.' n ON pu.idUnidad=n.idUnidad
							WHERE idPlanetaEsp=\''.$idPlaneta.'\' AND idGalaxia=\''.$idGalaxia.'\')

							UNION

							(SELECT u.id
							FROM unidad AS u JOIN '.$this->tabla.' AS n ON u.id=n.idUnidad
								JOIN unidadMejora AS um ON u.id=um.idUnidad
								LEFT JOIN jugadorMejora AS jm ON jm.idMejora=um.idMejora AND jm.idJugador=\''.$idJugador.'\'
							WHERE u.idRaza=\''.$idRaza.'\'
							GROUP BY u.id
							HAVING MIN(COALESCE(jm.nivel,0)-um.nivel)>=0)) AS idr

							LEFT JOIN unidadHeroe AS uh ON uh.idUnidad=idr.id
							LEFT JOIN unidadJugadorPlaneta AS ujp ON ujp.idUnidad=idr.id  AND ujp.idJugador=\''.$idJugador.'\'
							LEFT JOIN unidadConstruir AS uc ON uc.idUnidad=idr.id  AND uc.idJugador=\''.$idJugador.'\'
						))');

	      	$datos=array();
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();

	        $consulta->close();

	        //Ordenamos por id
	        usort($datos, function($a,$b){$ret = $a['id'] >= $b['id'] ? True : False; return $ret;});

			return $datos;

	    }

	    /**
	     * Devuelve las unidades disponibles en un planeta
	     *
	     * @abstract
	     * @access public
	     * @author David & Jose
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public abstract function disponibles($idGalaxia, $idPlaneta);

	    /**
	     * Obtiene los fuegos rapidos de la unidad
	     *
	     * @abstract
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 12/01/2010
	     */
	    public abstract function fuegoRapido();

	    /**
	     * Devuelve las unidades de una raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function listaRaza($idRaza)
	    {

	        $consulta = $this->db->query(
						'SELECT u.id, u.nombre
						FROM unidad u
						JOIN '.$this->tabla.' n ON u.id=n.idUnidad
						WHERE u.idRaza=\''.$idRaza.'\'');

	        $datos = Array();

			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve los requisitos de construcción para un usuario
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function requisitos($idJugador, $idRaza)
	    {

	        $consulta = $this->db->query(
						'SELECT u.id, m.nombre, um.nivel, um.nivel<=IFNULL(jm.nivel,0) AS cumple
						FROM (((unidad u JOIN '.$this->tabla.' t ON u.id=t.idUnidad)
							JOIN unidadMejora um ON u.id=um.idUnidad)
							JOIN mejora m ON um.idMejora=m.id)
							LEFT JOIN jugadorMejora jm ON jm.idMejora=m.id AND jm.idJugador=\''.$idJugador.'\'
						WHERE u.idRaza=\''.$idRaza.'\'');

	        $datos = Array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['id']][]=$info;
			}

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve el coste de recursos de las unidades
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function costeRecursos($unidades)
	    {

	        $consulta = $this->db->query(
						'SELECT idUnidad, idTipoRecurso, cantidad
						FROM recursoUnidad
						WHERE idUnidad IN (\''.implode('\',\'',$unidades).'\')');

			$datos=array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['idUnidad']][]=$info;
			}

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve el coste en unidades de las unidades
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @return mixed
	     * @since 31/05/2009
	     */
	    public function costeUnidades($unidades, $idJugador, $idGalaxia, $idPlaneta)
	    {

	        $consulta = $this->db->query(
						'SELECT ur.idUnidadRequerida AS id, ur.idUnidadRequiere, u.nombre, u.idtipoUnidad, ur.cantidad, IFNULL(up.cantidad,0)-IFNULL(up.cantidadEnMision,0) AS disponibles
						FROM (unidadRequerida ur JOIN unidad u ON ur.idUnidadRequiere=u.id)
						LEFT JOIN unidadJugadorPlaneta up ON ur.idUnidadRequiere=up.idUnidad
							AND up.idGalaxia=\''.$idGalaxia.'\'
							AND up.idPlaneta=\''.$idPlaneta.'\'
							AND up.idJugador=\''.$idJugador.'\'
						WHERE ur.idUnidadRequerida IN (\''.implode('\',\'',$unidades).'\')');

			$datos=array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['id']][]=$info;
			}

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve los atributos propios de una unidad
	     *
	     * @abstract
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @return mixed
	     * @since 01/06/2009
	     */
	    public abstract function atributos($unidades);

	    /**
	     * Elimina unidades de un jugador
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idGalaxia
	     * @param  Integer idPlaneta
	     * @param  Integer idUnidad
	     * @param  Integer cantidad
	     * @param  Boolean especial
	     * @return mixed
	     * @since 08/06/2009
	     */
	    public function licenciar($idJugador, $idGalaxia, $idPlaneta, $idUnidad, $cantidad)
	    {

	        //Se comprueba si se van a eliminar todas las unidades del planeta o solo unas pocas
	        $consulta = $this->db->query(
						'SELECT cantidad, cantidadEnMision FROM unidadJugadorPlaneta
						WHERE idGalaxia=\''.$idGalaxia.'\'
							AND idPlaneta=\''.$idPlaneta.'\'
							AND idUnidad=\''.$idUnidad.'\'
							AND idJugador=\''.$idJugador.'\'
						LIMIT 1');

	        list($cantidadTotal, $cantidadEnMision) = $consulta -> fetch_row();

	        $consulta->close();

	        //Si no estoy intentando eliminar unidades que estan en mision
	        if($cantidadTotal-$cantidad >= $cantidadEnMision){

		        //Se elimina el tipo de unidad en el planeta, en el caso de que no quedaran mas
		        if($cantidadTotal-$cantidad == 0)
		        	$this->db->query(
							'DELETE FROM unidadJugadorPlaneta
							WHERE idGalaxia=\''.$idGalaxia.'\'
								AND idPlaneta=\''.$idPlaneta.'\'
								AND idUnidad=\''.$idUnidad.'\'
								AND idJugador=\''.$idJugador.'\'');

		        //Se actualiza el numero de unidades del planeta, siempre que se puedan descontar.
		        //Si se intentan eliminar mas unidades de las que el planeta tiene, no se puede y no se realiza ninguna acci�n.
		        elseif($cantidadTotal-$cantidad >= 0)
			        $this->db->query(
								'UPDATE unidadJugadorPlaneta SET cantidad=cantidad-'.$cantidad.'
								WHERE idGalaxia=\''.$idGalaxia.'\'
									AND idPlaneta=\''.$idPlaneta.'\'
									AND idUnidad=\''.$idUnidad.'\'
									AND idJugador=\''.$idJugador.'\'');
	        }

	    }

	    /**
	     * Devuelve las mejoras que proporciona
	     * una unidad
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer unidades
	     * @return mixed
	     * @since 07/01/2009
	     */
	    public function mejorasUnidad($unidades)
	    {

	    	$consulta = $this->db->query(
						'SELECT h.idUnidadHeroe AS id, "" AS unidad, t.nombre AS atributo, m.porcentaje
						FROM unidadHeroeMejora h
							JOIN mejoraTipoMejoraGeneral m ON h.idMejora=m.idMejora
							JOIN tipoMejoraGeneral t ON m.idTipoMejora=t.id
						WHERE h.idUnidadHeroe IN (\''.implode('\',\'',$unidades).'\')');

			$datos=array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['id']][]=$info;
			}

	        $consulta->close();

	        $consulta = $this->db->query(
	        			'SELECT h.idUnidadHeroe AS id, u.nombre AS unidad, t.nombre AS atributo, m.porcentaje
						FROM unidadHeroeMejora h
							JOIN mejoraTipoUnidadTipoMejora m ON h.idMejora=m.idMejora
							JOIN tipoMejora t ON m.idTipoMejora=t.id
							JOIN tipoUnidad u ON m.idTipoUnidad=u.id
						WHERE h.idUnidadHeroe IN (\''.implode('\',\'',$unidades).'\')');

	        for($i=0; $i<$consulta->num_rows; $i++){
	        	$info=$consulta->fetch_assoc();
	        	$datos[$info['id']][]=$info;
			}

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve un array indexado por idUnidad
	     * con TRUE o FALSE dependiendo de si el jugador
	     * posee alguna unidad de ese tipo.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idUnidad
	     * @return mixed
	     * @since 08/07/2010
	     */
	    public function construidas($idJugador, $idUnidad)
	    {

	        $consulta = $this->db->query(
	        				'SELECT idUnidad
							FROM unidadJugadorPlaneta
							WHERE idJugador=\''.$idJugador.'\'
								AND idUnidad IN (\''.implode('\',\'',$idUnidad).'\')');
	        $datos = Array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$aux=$consulta->fetch_assoc();
	        	$datos[$i]=$aux['idUnidad'];
			}
			
			$cantidad=count($datos);

	        $consulta->close();

	        $consulta = $this->db->query(
	        				'SELECT idUnidad
							FROM unidadConstruir
							WHERE idJugador=\''.$idJugador.'\'
								AND idUnidad IN (\''.implode('\',\'',$idUnidad).'\')');

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$aux=$consulta->fetch_assoc();
	        	$datos[$i+$cantidad]=$aux['idUnidad'];
			}

	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Devuelve un array indexado por idUnidad, con
	     * TRUE si la unidad te la da un especial o
	     * FALSE en caso contrario.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUnidad
	     * @return mixed
	     * @since 16/07/2010
	     */
	    public function unidadDeEspecial($idUnidad)
	    {

	        $consulta = $this->db->query('
	        			SELECT u.id, e.idUnidad IS NOT NULL AS especial
	        			FROM unidad u
	        			LEFT JOIN especialUnidad e ON u.id=e.idUnidad
						WHERE u.id IN (\''.implode('\',\'',$idUnidad).'\')');
	        $datos = Array();

			for($i=0; $i<$consulta->num_rows; $i++){
	        	$aux=$consulta->fetch_assoc();
				$datos[$aux['id']]=$aux['especial'];
			}

	        $consulta->close();

			return $datos;

	    }

	}
?>
