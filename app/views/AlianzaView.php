<?php
	/**
	 * Vista de alianza
	 *
	 * @author David & Jose
	 * @package views
	 * @since 29/01/2010
	 */
	
	
	
	/**
	 * Vista de alianza
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 29/01/2010
	 */
	class AlianzaView
	    extends ViewBase
	{
	    /**
	     * Muestra el modulo de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Boolean tieneAlianza
	     * @param  Boolean esLider
	     * @param  String pestana
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function alianza($tieneAlianza, $esLider, $pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/alianza.tpl');
	
			//Mostramos las diferentes pesta�as
			if($tieneAlianza){
				$this->tpl->setVariable('_ALIANZA',_('Alianza'));
				$this->tpl->setVariable('_MIEMBROS',_('Miembros'));
				$this->tpl->parse('tAlianza');
				$this->tpl->touchBlock('tAlianzaPanel');
				if($esLider){
					$this->tpl->setVariable('_SOLICITUDES',_('Solicitudes'));
					$this->tpl->setVariable('_EDITAR',_('Editar'));
					$this->tpl->parse('tLider');
					$this->tpl->touchBlock('tLiderPanel');
				}
	
				//Cargamos la primera pestana
	        	$this->tpl->setVariable('PESTANAALIANZA',$pestana);
			}
			else{
				$this->tpl->setVariable('_BUSCAR',_('Buscar'));
				$this->tpl->setVariable('_CREAR',_('Crear'));
				$this->tpl->parse('tNoAlianza');
				$this->tpl->touchBlock('tNoAlianzaPanel');
	
				//Cargamos la primera pestana
	        	$this->tpl->setVariable('PESTANANOALIANZA',$pestana);
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra un buscador de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscador($idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/buscador.tpl');
			
			$this->tpl->setVariable('IDRAZA',$idRaza);
	
			$this->tpl->setVariable('_NOMBRE',_('Nombre'));
			$this->tpl->setVariable('_LIDER',_('L&#237;der'));
			$this->tpl->setVariable('_BUSCAR',_('Buscar'));
			$this->tpl->setVariable('_MENSAJEBUSCAR',_('No perteneces a ninguna alianza, puedes buscar una alianza y enviar una solictud de ingreso mediante el buscador'));
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el formulario para crear una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function crear()
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/datos.tpl');
	
			$this->tpl->setVariable('ACCION','enviarDatos');
			$this->tpl->setVariable('CONTROLADOR','Alianza');
			$this->tpl->setVariable('_DATOS',_('Datos de la nueva alianza'));
			$this->tpl->setVariable('_TITULO',_('T&#237;tulo'));
			$this->tpl->setVariable('_IMAGEN',_('URL Imagen'));
			$this->tpl->setVariable('_FORO',_('URL Foro/Web'));
			$this->tpl->setVariable('_TEXTO',_('Texto'));
			$this->tpl->setVariable('_ENVIAR',_('Crear alianza'));
			$this->tpl->setVariable('_OPCIONAL',_('Opcional'));
	
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el resultado de la busqueda
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer alianzas
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function buscar($alianzas, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/lista.tpl');
	
			if(count($alianzas)==0){
				$this->tpl->setVariable('IDRAZANOALIANZAS',$idRaza);
				$this->tpl->setVariable('_NOALIANZAS',_('No se han encontrado alianzas'));
				$this->tpl->parse('tNoAlianzas');
				$this->tpl->hideBlock('tAlianzas');
			}
			else{
				//Idioma
				$this->tpl->setVariable('_ALIANZA',_('Alianza'));
		        $this->tpl->setVariable('_LIDER',_('L&#237;der'));
		        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
		        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
		        
		        $this->tpl->hideBlock('tNoAlianzas');
				$this->tpl->setCurrentBlock('tAlianza');
	
				foreach($alianzas as $datos){
					$this->tpl->setVariable('IDRAZA',$idRaza);
					$this->tpl->setVariable('IDALIANZA',$datos['id']);
					$this->tpl->setVariable('ALIANZA',$datos['alianza']);
					$this->tpl->setVariable('FUNDADOR',$datos['fundador']);
					$this->tpl->setVariable('PUNTUACION',floor($datos['puntosTotales']));
					$this->tpl->setVariable('_ENVIARSOLICITUD',_('Enviar solicitud de entrada'));
					$this->tpl->setVariable('_MENSAJESOLICITUD',_('Escribe un mensaje en la solicitud'));
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el formulario para editar la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String titulo
	     * @param  String imagen
	     * @param  String texto
	     * @param  String foro
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function datos($titulo, $imagen, $texto, $foro)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/datos.tpl');
	
			$this->tpl->setVariable('ACCION','cambiarDatos');
			$this->tpl->setVariable('CONTROLADOR','Alianza');
			$this->tpl->setVariable('_DATOS',_('Datos de la alianza'));
			$this->tpl->setVariable('_TITULO',_('T&#237;tulo'));
			$this->tpl->setVariable('_IMAGEN',_('URL Imagen'));
			$this->tpl->setVariable('_FORO',_('URL Foro/Web'));
			$this->tpl->setVariable('_TEXTO',_('Texto'));
			$this->tpl->setVariable('_ENVIAR',_('Cambiar datos'));
			$this->tpl->setVariable('_OPCIONAL',_('Opcional'));
	
			//Datos actuales
			$this->tpl->setVariable('TITULO',$titulo);
			$this->tpl->setVariable('TEXTO',$texto);
			$this->tpl->setVariable('IMAGEN',$imagen);
			$this->tpl->setVariable('FORO',$foro);
	
			//Bloque de opciones de la alianza
			$this->tpl->setVariable('_OPCIONESALIANZA',_('Opciones de alianza'));
			$this->tpl->setVariable('_BORRARALIANZA',_('Borrar alianza'));
			$this->tpl->setVariable('_CONFBORRAR',_('&#191;Realmente desea borrar la alianza&#63; Este proceso es irreversible.'));
	
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra los miembros de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer miembros
	     * @param  Integer numMiembrosPag
	     * @param  Integer numMiembrosTotal
	     * @param  Integer pag
	     * @param  Boolean esLider
	     * @param  Integer idUsuario
	     * @param  Integer comercioPosible
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function miembros($miembros, $numMiembrosPag, $numMiembrosTotal, $pag, $esLider, $idUsuario, $comercioPosible, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/miembros.tpl');
	
			//Idioma
	        $this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	        
	        $this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
	        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        
	        $this->tpl->setVariable('_CONFEXPULSAR',_('&#191;Realmente desea expulsar a este jugador&#63;'));
	        $this->tpl->setVariable('_CONFCEDER',_('&#191;Realmente desea ceder el control de la alianza a este jugador&#63;'));
	        $this->tpl->setVariable('_CONFABANDONAR',_('&#191;Realmente desea abandonar la alianza&#63;'));
	        
	        //Listamos los usuarios
	        //Paginamos
			$paginas=ceil($numMiembrosTotal/$numMiembrosPag);
			$this->tpl->setCurrentBlock('tPagMsg');
			for($i=0;$i<$paginas;$i++){
				$this->tpl->setVariable('PAG',$i+1);
				$this->tpl->setVariable('INICIO',($i*$numMiembrosPag));
				//Si es la pagina actual la marcamos
				if($i+1==$pag)
					$this->tpl->touchBlock('tPagActual');
				$this->tpl->parseCurrentBlock();
			}
	
			//Listamos los miembros
			$this->tpl->setCurrentBlock('tUsuario');
			foreach($miembros as $datos){
				if($datos['lider']){
					$this->tpl->setVariable('_LIDER',_('L&#237;der'));
				}
				$this->tpl->setVariable('IDUSUARIO',$datos['id']);
				$this->tpl->setVariable('USUARIO',$datos['usuario']);
				$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
				$this->tpl->setVariable('RAZA',$datos['raza']);
				$this->tpl->setVariable('PUNTUACION',floor($datos['puntuacion']));
	
				//Mostramos opciones segun si se es el lider
				if($datos['id']==$idUsuario){
					if($esLider){
						$this->tpl->touchBlock('tNinguna');
					}
					else{
						$this->tpl->setVariable('IDRAZAABANDONAR',$idRaza);
						$this->tpl->setVariable('_ABANDONAR',_('Abandonar la alianza'));
					}
				}
				else{
					$this->tpl->setVariable('_ENVIARMENSAJE',_('Enviar mensaje'));
					if($comercioPosible[$datos['id']])
						$this->tpl->setVariable('_ENVIARCOMERCIO',_('Enviar comercio'));
					if($esLider){
						$this->tpl->setVariable('IDRAZAEXPULSAR',$idRaza);
						$this->tpl->setVariable('IDRAZALIDERAZGO',$idRaza);
						$this->tpl->setVariable('_EXPULSAR',_('Expulsar miembro'));
						$this->tpl->setVariable('_LIDERAZGO',_('Ceder liderazgo de la alianza'));
					}
				}
	
		       	$this->tpl->parseCurrentBlock();
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra la pantalla principal de la alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  String titulo
	     * @param  String imagen
	     * @param  String texto
	     * @param  String foro
	     * @return mixed
	     * @since 29/01/2010
	     */
	    public function tuAlianza($titulo, $imagen, $texto, $foro)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/tuAlianza.tpl');
	
			$this->tpl->setVariable('TITULO',$titulo);
			$this->tpl->setVariable('TEXTO',$texto);
			//Si tiene imagen
			if($imagen!=""){
				$this->tpl->setVariable('IMAGEN',$imagen);
			}
			else{
				$this->tpl->hideBlock('tImagen');
			}
			//Si tiene foro o web
			if($foro!=""){
				$this->tpl->setVariable('FORO',$foro);
				$this->tpl->setVariable('_FOROWEB',_('Foro/Web'));
			}
			else
				$this->tpl->hideBlock('tForo');
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra las solicitudes de una alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer solicitudes
	     * @return mixed
	     * @since 06/02/2010
	     */
	    public function solicitudes($solicitudes, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/solicitudes.tpl');
	
			if(count($solicitudes)==0){
				$this->tpl->setVariable('_NOSOLICITUDES',_('No hay solicitudes de entrada'));
				$this->tpl->setVariable('IDRAZANOSOLICITUDES',$idRaza);
				$this->tpl->parse('tNoSolicitudes');
				$this->tpl->hideBlock('tSolicitudes');
			}
			else{
				//Idioma
		        $this->tpl->setVariable('_USUARIO',_('Usuario'));
		        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
		        $this->tpl->setVariable('_MENSAJE',_('Mensaje'));
		        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
		        
		        //Listamos las solicitudes
				$this->tpl->setCurrentBlock('tSolicitud');
				foreach($solicitudes as $datos){
					$this->tpl->setVariable('IDUSUARIO',$datos['idJugador']);
					$this->tpl->setVariable('USUARIO',$datos['usuario']);
					$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('RAZA',$datos['raza']);
					$this->tpl->setVariable('PUNTUACION',floor($datos['puntuacion']));
					$this->tpl->setVariable('MENSAJE',$datos['mensaje']);
	
					$this->tpl->setVariable('_ACEPTAR',_('Aceptar'));
					$this->tpl->setVariable('_DENEGAR',_('Denegar'));
	
			       	$this->tpl->parseCurrentBlock();
				}
			}
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el menu de ver otra alianza
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idAlianza
	     * @param  String pestana
	     * @return mixed
	     * @since 18/04/2010
	     */
	    public function verAlianza($idAlianza, $pestana)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/verAlianza.tpl');
	
			$this->tpl->setVariable('IDALIANZA',$idAlianza);
			$this->tpl->setVariable('_ALIANZA',_('Alianza'));
			$this->tpl->setVariable('_MIEMBROS',_('Miembros'));
	
			//Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Lista los usuarios de otra alianza.
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer miembros
	     * @param  Integer idAlianza
	     * @param  Integer numMiembrosPag
	     * @param  Integer numMiembrosTotal
	     * @param  Integer pag
	     * @return mixed
	     * @since 18/04/2010
	     */
	    public function otraMiembros($miembros, $idAlianza, $numMiembrosPag, $numMiembrosTotal, $pag)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('alianza/otraMiembros.tpl');
	
			//Idioma
	        $this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	        
	        $this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
	        
	        //Listamos los usuarios
	        //Paginamos
			$paginas=ceil($numMiembrosTotal/$numMiembrosPag);
			$this->tpl->setCurrentBlock('tPagMsg');
			for($i=0;$i<$paginas;$i++){
				$this->tpl->setVariable('PAG',$i+1);
				$this->tpl->setVariable('INICIO',($i*$numMiembrosPag));
				$this->tpl->setVariable('IDALIANZA',$idAlianza);
				//Si es la pagina actual la marcamos
				if($i+1==$pag)
					$this->tpl->touchBlock('tPagActual');
				$this->tpl->parseCurrentBlock();
			}
	
			//Listamos los miembros
			$this->tpl->setCurrentBlock('tUsuario');
			foreach($miembros as $datos){
				if($datos['lider']){
					$this->tpl->setVariable('_LIDER',_('L&#237;der'));
				}
				$this->tpl->setVariable('IDUSUARIO',$datos['id']);
				$this->tpl->setVariable('USUARIO',$datos['usuario']);
				$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
				$this->tpl->setVariable('RAZA',$datos['raza']);
				$this->tpl->setVariable('PUNTUACION',floor($datos['puntuacion']));
	
		       	$this->tpl->parseCurrentBlock();
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>