<?php
	/**
	 * Modelo que gestiona la información
	 * de recursos de la BBDD
	 *
	 * @author David & Jose
	 * @package models
	 * @since 29/01/2009
	 */
	
	
	
	/**
	 * Modelo que gestiona la información
	 * de recursos de la BBDD
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 29/01/2009
	 */
	class RecursosModel
	    extends ModelBase
	{
	    /**
	     * Devuelve la información de recursos del 
	     * usuario ordenados por tipo de recurso
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @return mixed
	     * @since 29/01/2009
	     */
	    public function recursos($idUsuario)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idTipoRecurso, cantidad
						FROM tipoRecursoUsuario
						WHERE idJugador=\''.$idUsuario.'\'');
	
	        $datos = Array();
	        
			for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
	        //Ordenamos por tipo
	        usort($datos, function($a,$b){$ret = $a['idTipoRecurso'] >= $b['idTipoRecurso'] ? True : False; return $ret;});
	        
			return $datos;
	        
	    }
	
	    /**
	     * Devuelve la información sobre el recurso
	     * pasado como parametro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @param  Integer idTipo
	     * @return mixed
	     * @since 29/01/2009
	     */
	    public function recurso($idUsuario, $idTipo)
	    {
	        
	        $consulta = $this->db->query(
						'SELECT idTipoRecurso, cantidad
						FROM tipoRecursoUsuario
						WHERE idJugador=\''.$idUsuario.'\'
						AND idTipoRecurso=\''.$idTipo.'\' LIMIT 1');
	
	        $datos=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Intercambia un recurso por otro
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idRaza
	     * @param  Integer cantidad
	     * @param  Boolean modo Modo de intercambio:
	TRUE: primario por secundario
	FALSE: secundario por primario
	     * @return mixed
	     * @since 14/02/2009
	     */
	    public function intercambiar($idJugador, $idRaza, $cantidad, $modo)
	    {
	        
	        if($modo){
	        	$idTipoRecursoRestar=1;
	        	$idTipoRecursoSumar=2;
	        }
	        else{
	        	$idTipoRecursoRestar=2;
	        	$idTipoRecursoSumar=1;
	        }
	        
	        //Restamos el recurso
	        $this->db->query(
						'UPDATE tipoRecursoUsuario SET
						cantidad=cantidad-\''.$cantidad.'\'
						WHERE idTipoRecurso=\''.$idTipoRecursoRestar.'\'
						AND idJugador=\''.$idJugador.'\'');
	        
	        //Calculamos la cantidad a sumar
	        $cantidad=$this->calcularIntercambio($idRaza, $modo, $cantidad);
	        
	        //Sumamos el otro recurso
	        $this->db->query(
						'UPDATE tipoRecursoUsuario SET
						cantidad=cantidad+\''.$cantidad.'\'
						WHERE idTipoRecurso=\''.$idTipoRecursoSumar.'\'
						AND idJugador=\''.$idJugador.'\'');
	        
	        return $this->db->errno==0;
	        
	    }
	
	    /**
	     * Devuelve los nombres de los recursos de una raza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @return mixed
	     * @since 09/04/2009
	     */
	    public function nombreRecursos($idRaza)
	    {
	        
	        $consulta=$this->db->query('SELECT idTipoRecurso, nombre 
	        							FROM recursoRaza 
	        							WHERE idRaza=\''.$idRaza.'\''); 
	        
	        $datos = Array();
	        
	        for($i=0; $i<$consulta->num_rows; $i++)
	        	$datos[$i]=$consulta->fetch_assoc();
	        
	        $consulta->close();
	        
			return $datos;
	        
	    }
	
	    /**
	     * Calcula la cantidad de un intercambio
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idRaza
	     * @param  Integer modo
	     * @param  Integer cantidad
	     * @return mixed
	     * @since 11/11/2009
	     */
	    public function calcularIntercambio($idRaza, $modo, $cantidad)
	    {
	        
	        $cantidad=intval($cantidad);
			switch($idRaza){
	        	case 1:
		        	if($modo)
		        		$cantidad=floor($cantidad*TAURIPRIMARIO/TAURISECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*TAURISECUNDARIO/TAURIPRIMARIO);
		        	break;
	        	case 2:
		        	if($modo)
		        		$cantidad=floor($cantidad*GOAULDPRIMARIO/GOAULDSECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*GOAULDSECUNDARIO/GOAULDPRIMARIO);
		        	break;
	        	case 3:
		        	if($modo)
		        		$cantidad=floor($cantidad*ASGARDPRIMARIO/ASGARDSECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*ASGARDSECUNDARIO/ASGARDPRIMARIO);
		        	break;
	        	case 4:
		        	if($modo)
		        		$cantidad=floor($cantidad*JAFFAPRIMARIO/JAFFASECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*JAFFASECUNDARIO/JAFFAPRIMARIO);
	        		break;
	        	case 5:
		        	if($modo)
		        		$cantidad=floor($cantidad*ATLANTISPRIMARIO/ATLANTISSECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*ATLANTISSECUNDARIO/ATLANTISPRIMARIO);
		        	break;
	        	case 6:
		        	if($modo)
		        		$cantidad=floor($cantidad*WRAITHPRIMARIO/WRAITHSECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*WRAITHSECUNDARIO/WRAITHPRIMARIO);
		        	break;
		        case 7:
		        	if($modo)
		        		$cantidad=floor($cantidad*REPLICANTESPRIMARIO/REPLICANTESSECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*REPLICANTESSECUNDARIO/REPLICANTESPRIMARIO);
		        	break;
	        	case 8:
		        	if($modo)
		        		$cantidad=floor($cantidad*ORIPRIMARIO/ORISECUNDARIO);
		        	else
		        		$cantidad=floor($cantidad*ORISECUNDARIO/ORIPRIMARIO);
		        	break;
	        }
			//Aplicamos cargo por intercambiar
			return intval($cantidad*0.9);
	        
	    }
	    
	    /**
	     * Obtiene la produccion del jugador pasado por parametro
	     * 
	     * @param $idJugador
	     * @return unknown_type
	     */
		public function obtenerProduccion($idJugador){
			$consulta=$this->db->query('
					SELECT produccionPrimario, produccionSecundario
					FROM jugadorInfoGeneral
					WHERE idJugador=\''.$idJugador.'\'
			');
	
			return $consulta->fetch_assoc();
		}
	
	}
?>