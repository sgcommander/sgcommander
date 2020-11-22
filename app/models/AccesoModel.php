<?php
	/**
	 * Gestiona los datos de entrada al juego
	 *
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */



	/**
	 * Gestiona los datos de entrada al juego
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 28/01/2009
	 */
	class AccesoModel
	    extends ModelBase
	{
	    /**
	     * Devuelve los datos del usuario en caso
	     * de existir, en caso contrario devuelve NULL
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String usuario
	     * @param  String pass
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function comprobar($usuario, $pass)
	    {
	        $consulta = $this->db->query(
	        			'SELECT u.id AS idUsuario, i.codigo AS lang, u.sessId, u.proteccionIP, u.nombre,
						j.idLogotipo, j.idFirma, j.idRaza, j.idAlianza,
	        			UNIX_TIMESTAMP(j.ultimaActualizacion) AS ultimaActualizacion, UNIX_TIMESTAMP(j.bloqueado) AS bloqueado, j.vacaciones
						FROM usuario AS u JOIN jugador AS j ON u.id=j.idUsuario
						     LEFT JOIN idioma AS i ON u.idIdioma=i.id
						WHERE UPPER(u.nombre)=\''.strtoupper($usuario).'\'
						AND u.pass=\''.hash('sha256', $pass).'\'');

	        $datos=$consulta->fetch_assoc();

	        //Elimina el resultado de la consulta
	        $consulta->close();

			return $datos;

	    }

	    /**
	     * Actualiza la IP y la fecha de logueo del
	     * usuario a su ultimo login
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idUsuario
	     * @return mixed
	     * @since 28/01/2009
	     */
	    public function registrarLogin($idUsuario, $ip, $sessionId)
	    {		
	        $this->db->query(
	        			'UPDATE usuario
						SET ultimoAcceso=NOW(),
						ipUltimoAcceso=INET_ATON(\''.$ip.'\'),
						sessId=\''.$sessionId.'\'
						WHERE id=\''.$idUsuario.'\'');
			$this->db->commit(); //TODO si nos e pone no guarda el acceso
			return $this->db->errno==0;
	    }

	}
?>