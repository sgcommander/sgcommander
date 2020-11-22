<?php

/**
 * Gestiona los datos de las mejoras
 *
 * @author David & Jose
 * @package models
 * @since 15/04/2009
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * Gestiona los datos de las mejoras
 *
 * @access public
 * @author David & Jose
 * @package models
 * @since 15/04/2009
 */
class MejoraModel
    extends ModelBase
{
    

    

    
    /**
     * Devuelve las mejoras de un grupo
     *
     * @access public
     * @author David & Jose
     * @param  Integer idRaza
     * @param  Integer idGrupo
     * @return mixed
     * @since 15/04/2009
     */
    public function mejoras($idRaza, $idGrupo)
    {
        
        $consulta = $this->db->query(
        			'SELECT id, nombre, descripcion, tiempo, p.cantidad AS primario, s.cantidad AS secundario 
					FROM mejora m 
						JOIN mejoraNormal n ON m.id=n.idMejora
						JOIN recursoMejora p ON p.idMejora=m.id
						JOIN recursoMejora s ON s.idMejora=m.id
					WHERE n.idRaza=\''.$idRaza.'\'  
						AND n.idGrupo=\''.$idGrupo.'\'
						AND p.idTipoRecurso=1
						AND s.idTipoRecurso=2');

        //Genero la variable a devolver
        $datos = Array();
        
		//Vuelco todos los datos obtenidos        
		for($i=0; $i<$consulta->num_rows; $i++)
        	$datos[$i]=$consulta->fetch_assoc();
        
        $consulta->close();
        
        //Devuelvo los datos
		return $datos;
        
    }

    /**
     * Investiga una mejora
     *
     * @access public
     * @author David & Jose
     * @param  Integer idMejora
     * @param  Integer idJugador
     * @param  Integer idRaza
     * @return mixed
     * @since 15/04/2009
     */
    public function investigar($idMejora, $idJugador, $idRaza)
    {
        if(!is_array($this->investigando($idJugador))){
	        $this->db->query('INSERT INTO jugadorMejoraInvestiga (idMejora,idJugador,tiempoInicial)
	        						(SELECT idMejora,\''.$idJugador.'\',FROM_UNIXTIME('.$_SERVER['REQUEST_TIME'].')
	        						FROM mejoraNormal
	        						WHERE idMejora=\''.$idMejora.'\'
	        						AND idRaza=\''.$idRaza.'\' LIMIT 1)');
        
        	return $this->db->affected_rows > 0;
        }
        else{
        	return False;
        }
    }

    /**
     * Cancela una mejora
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 15/04/2009
     */
    public function cancelar($idJugador)
    {
        
        $this->db->query('DELETE FROM jugadorMejoraInvestiga 
        							WHERE idJugador=\''.$idJugador.'\'');
        
        return $this->db->errno==0;
        
    }

    /**
     * Dado un array de mejoras devuelve sus niveles para un usuario
     *
     * @access public
     * @author David & Jose
     * @param  Integer idMejoras
     * @param  Integer idJugador
     * @return mixed
     * @since 16/04/2009
     */
    public function nivel($idMejoras, $idJugador)
    {
        
        $consulta = $this->db->query(
        			'SELECT idMejora,nivel FROM jugadorMejora
					WHERE idJugador=\''.$idJugador.'\'  
					AND idMejora IN (\''.implode('\',\'',$idMejoras).'\')');

		$datos=array();

		for($i=0; $i<$consulta->num_rows; $i++)
        	$datos[$i]=$consulta->fetch_assoc();

        $consulta->close();
        
		return $datos;
        
    }

    /**
     * Devuelve los grupos de mejoras de una raza
     *
     * @access public
     * @author David & Jose
     * @param  Integer idRaza Dada una raza devuelve los grupos de mejoras disponibles
     * @return mixed
     * @since 19/04/2009
     */
    public function grupos($idRaza)
    {
        
        $consulta = $this->db->query(
        			'SELECT id,nombre FROM grupoMejora
        			WHERE id IN(
        				SELECT idGrupo FROM mejoraNormal 
        				WHERE idRaza=\''.$idRaza.'\')');

        //Genero la variable a devolver
        $datos = Array();
        
		for($i=0; $i<$consulta->num_rows; $i++)
        	$datos[$i]=$consulta->fetch_assoc();
        
        $consulta->close();
        
		return $datos;
        
    }

    /**
     * Devuelve el id de la mejora actualmente investigada
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 11/05/2009
     */
    public function mejoraActual($idJugador)
    {
        
        $consulta = $this->db->query(
        			'SELECT idMejora
					FROM jugadorMejoraInvestiga
					WHERE idJugador=\''.$idJugador.'\'');

        $idMejora=0;
        
		if($consulta->num_rows!=0){
			$datos=$consulta->fetch_assoc();
			$idMejora=$datos['idMejora'];
		}

		$consulta->close();

		return $idMejora;
        
    }

    /**
     * Devuelve el tiempo que le queda a la mejora actuamente investigada
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 11/05/2009
     */
    public function tiempoRestante($idJugador)
    {
        
        $consulta = $this->db->query(
        			'SELECT TIMESTAMPDIFF(SECOND,NOW(),tiempoFinal) AS tiempo
					FROM jugadorMejoraInvestiga
					WHERE idJugador=\''.$idJugador.'\'');

        $tiempo=0;
        
		if($consulta->num_rows!=0){
			list($tiempo)=$consulta->fetch_row();
		}

		$consulta->close();

		return $tiempo;
        
    }

    /**
     * Devuelve las mejoras que proporciona
     * una mejora
     *
     * @access public
     * @author David & Jose
     * @param  Integer idMejoras
     * @param  Integer idRaza
     * @return mixed
     * @since 08/01/2009
     */
    public function mejorasMejora($idMejoras, $idRaza)
    {
        
    	$consulta = $this->db->query(
					'(SELECT m.idMejora AS id, t.nombre AS unidad, "'._('Producci&#243;n de').'" AS atributo, m.porcentaje, NULL AS idTipo 
						FROM mejoraTipoRecurso m
						JOIN recursoRaza t ON m.idTipoRecurso=t.idTipoRecurso AND t.idRaza='.$idRaza.'
						WHERE m.idMejora IN (\''.implode('\',\'',$idMejoras).'\'))
					UNION
					(SELECT m.idMejora AS id, u.nombre AS unidad, t.nombre AS atributo, m.porcentaje, NULL AS idTipo
						FROM mejoraTipoUnidadTipoMejora m
						JOIN tipoMejora t ON m.idTipoMejora=t.id
						JOIN tipoUnidad u ON m.idTipoUnidad=u.id
						WHERE m.idMejora IN (\''.implode('\',\'',$idMejoras).'\'))
					UNION
					(SELECT m.idMejora AS id, "" AS unidad, t.nombre AS atributo, m.porcentaje, m.idTipoMejora AS idTipo
						FROM mejoraTipoMejoraGeneral m
						JOIN tipoMejoraGeneral t ON m.idTipoMejora=t.id
						WHERE m.idMejora IN (\''.implode('\',\'',$idMejoras).'\'))');

    	//Creo la variable donde se almacenaran los datos
		$datos=array();

		//Vuelco los datos obtenidos en la variable
		for($i=0; $i<$consulta->num_rows; $i++){
        	$info=$consulta->fetch_assoc();
        	$datos[$info['id']][]=$info;
		}
        
		//Elimino la consulta de memoria
        $consulta->close();
        
		return $datos;
        
    }

    /**
     * Devuelve el nivel mínimo para realizar
     * viajes intergalacticos de una raza
     *
     * @access public
     * @author David & Jose
     * @param  Integer idRaza
     * @return mixed
     * @since 10/01/2009
     */
    public function nivelMinimoIntergalactico($idRaza)
    {
        
        $consulta = $this->db->query(
        			'SELECT nivelMinimoHiperpropulsion
					FROM raza
					WHERE id=\''.$idRaza.'\' LIMIT 1');

		list($nivelMinimo)=$consulta->fetch_row();

		$consulta->close();

		return $nivelMinimo;
        
    }

    /**
     * Devuelve el aumento del limite de
     * tropas por nivel
     *
     * @access public
     * @author David & Jose
     * @param  Integer idRaza
     * @return mixed
     * @since 11/01/2009
     */
    public function aumentoLimiteSoldados($idRaza)
    {
        
        $consulta = $this->db->query(
        			'SELECT limiteSoldados
					FROM raza
					WHERE id=\''.$idRaza.'\' LIMIT 1');

		list($limite)=$consulta->fetch_row();

		$consulta->close();

		return $limite;
        
    }

    /**
     * Devuelve el aumento del limite de
     * misiones por nivel
     *
     * @access public
     * @author David & Jose
     * @param  Integer idRaza
     * @return mixed
     * @since 24/01/2010
     */
    public function aumentoLimiteMisiones($idRaza)
    {
        
        $consulta = $this->db->query(
        			'SELECT limiteMisiones
					FROM raza
					WHERE id=\''.$idRaza.'\' LIMIT 1');

		list($limite)=$consulta->fetch_row();

		$consulta->close();

		return $limite;
        
    }

    /**
     * Devuelve los datos de la mejora que
     * se esta investigando actualmente. 0 si
     * no se esta investigando.
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 23/06/2010
     */
    public function investigando($idJugador)
    {
        
        $consulta = $this->db->query(
        			'SELECT m.id, m.nombre, TIMESTAMPDIFF(SECOND,NOW(),i.tiempoFinal) AS tiempo, IFNULL(j.nivel,0)+1 AS nivel
					FROM jugadorMejoraInvestiga AS i 
					JOIN mejora AS m ON i.idMejora=m.id
					LEFT JOIN jugadorMejora AS j ON m.id=j.idMejora AND j.idJugador=i.idJugador
					WHERE i.idJugador=\''.$idJugador.'\'');

        $datos=0;
        
		if($consulta->num_rows!=0){
			$datos=$consulta->fetch_assoc();
		}

		$consulta->close();

		return $datos;
        
    }

}

?>