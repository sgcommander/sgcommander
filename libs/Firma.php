<?php

/**
 * Clase que gestiona la generacion de firmas
 *
 * @author David & Jose
 * @package libs
 * @since 30/06/2010
 */

/**
 * Clase que gestiona la generacion de firmas
 *
 * @access public
 * @author David & Jose
 * @package libs
 * @since 30/06/2010
 */
class Firma
    extends ModelBase
{
    /**
     * Genera la firma de un jugador y la
     * guarda en el directorio.
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 02/07/2010
     */
    public function generar($idJugador)
    {
        
        //Obtenemos los datos
        $datos=$this->obtenerDatos($idJugador);
        
        //Creamos la firma
    	$im=$this->crearImagen($datos);
    
		//Guardamos la firma
		imagejpeg($im, $_ENV['config']->get('firmaGenerarJugadorImgFolder').$idJugador.'.jpg');  
		imagedestroy($im);
        
    }

    /**
     * Genera una firma de un jugador y la muestra. (DEPRECATED)
     * 
     * No se usa ya que al entrar por el acceso MainController, se pueden
     * resolver eventos que provocan que la imagen salga mal formada.
     *
     * @access public
     * @author David & Jose
     * @param  Integer idJugador
     * @param  Integer idFirma
     * @return mixed
     * @since 02/07/2010
     */
    /*public function mostrar($idJugador, $idFirma = null)
    {
    	//Inicializacion del vector
    	$datos = Array();
    	
    	//Si hemos especificado una firma
        if($idFirma!=null){
        	$firma=$this->obtenerRuta($idJugador,$idFirma);
        	$datos['ruta']=$firma['ruta'];
        }
    	
        //Si existe la firma la genero
        if($datos['ruta']){
	        //Obtenemos los datos
	        $datos=$this->obtenerDatos($idJugador);
	        
	        //Creamos la firma
	    	$im=$this->crearImagen($datos);
	    
			//Mostramos la firma
			header("Content-type: image/jpeg");
			imagejpeg($im);  
			imagedestroy($im);
        }
    }*/

    /**
     * Constructor de firmas.
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 02/07/2010
     */
    public function Firma()
    {
        
		$this->db = SPDO::singleton();
        
    }

    /**
     * Obtiene los datos del jugador pasado
     * como parametro.
     *
     * @access private
     * @author David & Jose
     * @param  Integer idJugador
     * @return mixed
     * @since 02/07/2010
     */
    private function obtenerDatos($idJugador)
    {
        
        $sql='SELECT u.nombre, r.colorFirma, r.firmaX, r.firmaY, f.ruta, p.puntosNaves, 
        		p.puntosSoldados, p.puntosDefensas, p.puntosTecnologias, p.puntosTotales,j.idRaza
    			FROM usuario AS u JOIN jugador AS j ON u.id=j.idUsuario
    			JOIN raza AS r ON j.idRaza=r.id
    			JOIN firma AS f ON j.idFirma=f.id
    			JOIN jugadorInfoPuntuaciones AS p ON u.id=p.idJugador
    			WHERE u.id=\''.$idJugador.'\'
    			LIMIT 1';
        
        //Obtengo los datos de la firma del jugador
    	$consulta = $this->db->query($sql);
    	$datos = $consulta->fetch_array();
    	$consulta->close();
    
    	//Obtengo la posicion del jugador
    	$sql='SELECT count(*) AS posicion
					FROM jugadorInfoPuntuaciones
					WHERE puntosTotales > \''.$datos['puntosTotales'].'\'
					OR (puntosTotales = \''.$datos['puntosTotales'].'\' AND idJugador <= \''.$idJugador.'\') LIMIT 1';
    
    	$consulta = $this->db->query($sql);
        $result=$consulta->fetch_array();
        $consulta->close();
        
        $datos['posicion']=$result['posicion'];
        
        //Devolvemos la estructura de datos
        return $datos;
        
    }

    /**
     * Genera  una variable de imagen de GD
     * a partir de unos datos de jugador.
     *
     * @access private
     * @author David & Jose
     * @param  Integer datos
     * @return mixed
     * @since 02/07/2010
     */
    private function crearImagen($datos)
    {
        //Creamos la imagen a partir de la firma
		$im= imagecreatefromjpeg($_ENV['config']->get('firmaGenerarImgFolder').$datos['ruta']);

		//Transformamos el color de Hex a RGB
		$rgb = Funciones::html2rgb($datos['colorFirma']);
		$color = ImageColorAllocate($im,$rgb[0],$rgb[1],$rgb[2]);
		imagestring($im,5,$datos['firmaX'],$datos['firmaY'],$datos['posicion'].'. '.$datos['nombre'],$color);
		imagestring($im,2,$datos['firmaX'],$datos['firmaY']+17,_('Naves'),$color);
		imagestring($im,2,$datos['firmaX']+81,$datos['firmaY']+17,_('Tropas'),$color);
		imagestring($im,2,$datos['firmaX'],$datos['firmaY']+41,_('Defensas'),$color);
		imagestring($im,2,$datos['firmaX']+81,$datos['firmaY']+41,_('Tecnologia'),$color);
		imagestring($im,2,$datos['firmaX'],$datos['firmaY']+29,$datos['puntosNaves'],$color);
		imagestring($im,2,$datos['firmaX']+81,$datos['firmaY']+29,$datos['puntosSoldados'],$color);
		imagestring($im,2,$datos['firmaX'],$datos['firmaY']+53,$datos['puntosDefensas'],$color);
		imagestring($im,2,$datos['firmaX']+81,$datos['firmaY']+53,$datos['puntosTecnologias'],$color);

		//Devolvemos la imagen
		return $im;
        
    }

    /**
     * Obtiene la ruta de una firma para un 
     * usuario que pueda tener esa firma
     *
     * @access private
     * @author David & Jose
     * @param  Integer idJugador
     * @param  Integer idFirma
     * @return mixed
     * @since 02/07/2010
     */
    private function obtenerRuta($idJugador, $idFirma = null)
    {
        
        $sql='SELECT f.ruta
    			FROM jugador AS j
    			JOIN raza AS r ON j.idRaza=r.id
    			JOIN firma AS f ON j.idRaza=f.idRaza
    			WHERE j.idUsuario=\''.$idJugador.'\'
    			AND f.id=\''.$idFirma.'\'
    			LIMIT 1';

        //Obtengo los datos de la firma
    	$consulta = $this->db->query($sql);
    	$datos = $consulta->fetch_array();
    	$consulta->close();
    
        //Devolvemos la estructura de datos
        return $datos;
        
    }

}

?>