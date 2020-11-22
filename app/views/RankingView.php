<?php
	/**
	 * Vista del modulo del ranking
	 *
	 * @author David & Jose
	 * @package views
	 * @since 12/08/2009
	 */
	
	
	
	/**
	 * Vista del modulo del ranking
	 *
	 * @access public
	 * @author David & Jose
	 * @package views
	 * @since 12/08/2009
	 */
	class RankingView
	    extends ViewBase
	{
	    /**
	     * Muestra las pestañas del ranking
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer pestana
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function ranking($pestana)
	    {
	        
	         //Cargamos la plantilla
			$this->tpl->loadTemplateFile('ranking/ranking.tpl');
	
	        //Idioma
			$this->tpl->setVariable('_USUARIOS',_('Usuarios'));
	        $this->tpl->setVariable('_ALIANZAS',_('Alianzas'));
	        $this->tpl->setVariable('_BUSCADOR',_('Buscador'));
	        
	        //Cargamos la primera pestana
	        $this->tpl->setVariable('PESTANA',$pestana);
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el ranking de usuarios
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer usuarios
	     * @param  Integer numUsuariosPag
	     * @param  Integer numUsuariosTotal
	     * @param  Integer pag
	     * @param  Integer tipoPuntuacion
	     * @param  Integer idUsuario
	     * @param  Integer comercioPosible
	     * @return mixed
	     * @since 12/08/2009
	     */
	    public function usuarios($usuarios, $numUsuariosPag, $numUsuariosTotal, $pag, $tipoPuntuacion, $idUsuario, $comercioPosible, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('ranking/usuarios.tpl');
			
			$this->tpl->setVariable('IDRAZA',$idRaza);
	
			//Idioma
	        $this->tpl->setVariable('_DEBIL',_('D&#233;bil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
	        
	        $this->tpl->setVariable('_DEBILDESC',_('Los jugadores son d&#233;biles cuando tienen menos de '.$_ENV['config']->get('puntuacionDebil').' puntos de investigaci&#243;n, los jugadores d&#233;biles solo pueden atacar a jugadores d&#233;biles y solo pueden ser atacados por jugadores d&#233;biles.'));
	        $this->tpl->setVariable('_INACTIVODESC',_('El usuario lleva sin entrar al juego mas de 15 dias.'));
	        $this->tpl->setVariable('_VACACIONESDESC',_('El usuario está en modo vacaciones, no participar&#225; en las batallas y permanecer&#225; en este modo al menos 48 horas.'));
	        
			$this->tpl->setVariable('_PUNTUACIONTOTAL',_('Puntuaci&#243;n Total'));
	        $this->tpl->setVariable('_PUNTUACIONNAVES',_('Puntuaci&#243;n Naves'));
	        $this->tpl->setVariable('_PUNTUACIONTROPAS',_('Puntuaci&#243;n Tropas'));
	        $this->tpl->setVariable('_PUNTUACIONDEFENSAS',_('Puntuaci&#243;n Defensas'));
			$this->tpl->setVariable('_PUNTUACIONINVESTIGACION',_('Puntuaci&#243;n Investigaci&#243;n')); 
	        
	        $this->tpl->setVariable('_USUARIO',_('Usuario'));
	        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
	        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
	        if($tipoPuntuacion=='naves'){
	        	$this->tpl->setVariable('TIPO',_('Naves'));
	        	$this->tpl->setVariable('SELNAVES','selected="selected"');
	        }
	        elseif($tipoPuntuacion=='tropas'){
	        	$this->tpl->setVariable('TIPO',_('Tropas'));
	        	$this->tpl->setVariable('SELTROPAS','selected="selected"');
	        }
	        elseif($tipoPuntuacion=='defensas'){
	        	$this->tpl->setVariable('TIPO',_('Defensas'));
	        	$this->tpl->setVariable('SELDEFENSAS','selected="selected"');
	        }
	        elseif($tipoPuntuacion=='investigacion'){
	        	$this->tpl->setVariable('TIPO',_('Investigaci&#243;n'));
	        	$this->tpl->setVariable('SELINVESTIGACION','selected="selected"');
	        }
	        else{
	        	$this->tpl->setVariable('TIPO',_('Total'));
	        	$this->tpl->setVariable('SELTOTAL','selected="selected"');
	        }
	        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
	        
	        //Listamos los usuarios
	        //Paginamos
			$paginas=ceil($numUsuariosTotal/$numUsuariosPag);
			$this->tpl->setCurrentBlock('tPagMsg');
	
			for($i=0;$i<$paginas;$i++){
				$this->tpl->setVariable('PAG',$i+1);
				$this->tpl->setVariable('INICIO',($i*$numUsuariosPag));
				if($tipoPuntuacion=='naves')
		        	$this->tpl->setVariable('TIPOPUNTUACION',_('naves'));
		        elseif($tipoPuntuacion=='tropas')
		        	$this->tpl->setVariable('TIPOPUNTUACION',_('tropas'));
		        elseif($tipoPuntuacion=='defensas')
		        	$this->tpl->setVariable('TIPOPUNTUACION',_('defensas'));
		        elseif($tipoPuntuacion=='investigacion')
		        	$this->tpl->setVariable('TIPOPUNTUACION',_('investigacion'));
		        else
		        	$this->tpl->setVariable('TIPOPUNTUACION',_('total'));
				//Si es la pagina actual la marcamos
				if($i+1==$pag)
					$this->tpl->touchBlock('tPagActual');
				$this->tpl->parseCurrentBlock();
			}
	
			$this->tpl->setCurrentBlock('tUsuario');
			//Calculamos la primera posicion
			$pos=($numUsuariosPag*($pag-1))+1;
			foreach($usuarios as $datos){
				$this->tpl->setVariable('POSICION',$pos);
				$this->tpl->setVariable('IDUSUARIO',$datos['id']);
				$this->tpl->setVariable('USUARIO',$datos['usuario']);
				$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
				$this->tpl->setVariable('RAZA',$datos['raza']);
				if($datos['idAlianza']==''){
					$this->tpl->hideBlock('tAlianza');
					$this->tpl->touchBlock('tNoAlianza');
				}
				else{
					$this->tpl->hideBlock('tNoAlianza');
					$this->tpl->setVariable('ALIANZA','('.$datos['alianza'].')');
					$this->tpl->setVariable('IDALIANZA',$datos['idAlianza']);
					$this->tpl->touchBlock('tAlianza');
				}
				//Si esta de vacaciones
				if($datos['vacaciones']){
					$this->tpl->setVariable('IDRAZAVACACIONES',$idRaza);
					$this->tpl->setVariable('_VACACIONESICO',_('Vacaciones'));
				}
				//Si esta inactivo
				if($datos['inactivo']){
					$this->tpl->setVariable('IDRAZAINACTIVO',$idRaza);
					$this->tpl->setVariable('_INACTIVOICO',_('Inactivo'));
				}
				//Si es debil
				if($datos['debil']){
					$this->tpl->setVariable('IDRAZADEBIL',$idRaza);
					$this->tpl->setVariable('_DEBILICO',_('D&#233;bil'));
				}
	
				//Colocamos el tipo de puntuacion
				if($tipoPuntuacion=='naves')
		        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosNaves']));
		        elseif($tipoPuntuacion=='tropas')
		        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosSoldados']));
		        elseif($tipoPuntuacion=='defensas')
		        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosDefensas']));
		        elseif($tipoPuntuacion=='investigacion')
		        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosTecnologias']));
		        else
		        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosTotales']));
	
		        //Si es el usuario que esta mirando el ranking lo marcamos y ocultamos opciones
				if($datos['id']==$idUsuario){
					$this->tpl->touchBlock('tUsuarioPropio');
					$this->tpl->touchBlock('tPropio');
				}
				else{
					$this->tpl->setVariable('_ENVIARMENSAJE',_('Enviar mensaje'));
					if($comercioPosible[$datos['id']]){
						$this->tpl->setVariable('_ENVIARCOMERCIO',_('Enviar comercio'));
					}
				}
	
				$pos++;
		       	$this->tpl->parseCurrentBlock();
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el ranking de alianzas
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer alianzas
	     * @param  Integer numAlianzasPag
	     * @param  Integer numAlianzasTotal
	     * @param  Integer pag
	     * @param  Integer tipoPuntuacion
	     * @param  Integer idAlianza
	     * @return mixed
	     * @since 19/08/2009
	     */
	    public function alianzas($alianzas, $numAlianzasPag, $numAlianzasTotal, $pag, $tipoPuntuacion, $idAlianza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('ranking/alianzas.tpl');
	        
	        //Listamos las alianzas
	        if(count($alianzas)==0){
				$this->tpl->setVariable('_NOALIANZAS',_('No hay alianzas'));
				$this->tpl->parse('tNoAlianzas');
				$this->tpl->hideBlock('tAlianzas');
			}
			else{
				//Idioma
				$this->tpl->setVariable('_PUNTUACIONMEDIA',_('Puntuaci&#243;n Media'));
				$this->tpl->setVariable('_PUNTUACIONTOTAL',_('Puntuaci&#243;n Total'));
		        $this->tpl->setVariable('_PUNTUACIONNAVES',_('Puntuaci&#243;n Naves'));
		        $this->tpl->setVariable('_PUNTUACIONTROPAS',_('Puntuaci&#243;n Tropas'));
		        $this->tpl->setVariable('_PUNTUACIONDEFENSAS',_('Puntuaci&#243;n Defensas'));
				$this->tpl->setVariable('_PUNTUACIONINVESTIGACION',_('Puntuaci&#243;n Investigaci&#243;n')); 
		        
		        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
		        $this->tpl->setVariable('_LIDER',_('L&#237;der'));
		        $this->tpl->setVariable('_PUNTUACION',_('Puntuaci&#243;n'));
		        if($tipoPuntuacion=='naves'){
		        	$this->tpl->setVariable('TIPO',_('Naves'));
		        	$this->tpl->setVariable('SELNAVES','selected="selected"');
		        }
		        elseif($tipoPuntuacion=='tropas'){
		        	$this->tpl->setVariable('TIPO',_('Tropas'));
		        	$this->tpl->setVariable('SELTROPAS','selected="selected"');
		        }
		        elseif($tipoPuntuacion=='defensas'){
		        	$this->tpl->setVariable('TIPO',_('Defensas'));
		        	$this->tpl->setVariable('SELDEFENSAS','selected="selected"');
		        }
		        elseif($tipoPuntuacion=='investigacion'){
		        	$this->tpl->setVariable('TIPO',_('Investigaci&#243;n'));
		        	$this->tpl->setVariable('SELINVESTIGACION','selected="selected"');
		        }
		        elseif($tipoPuntuacion=='total'){
		        	$this->tpl->setVariable('TIPO',_('Total'));
		        	$this->tpl->setVariable('SELTOTAL','selected="selected"');
		        }
				else{
		        	$this->tpl->setVariable('TIPO',_('Media'));
		        	$this->tpl->setVariable('SELMEDIA','selected="selected"');
		        }
		        $this->tpl->setVariable('_OPCIONES',_('Opciones'));
	
				$this->tpl->hideBlock('tNoAlianzas');

		        //Paginamos
				$paginas=ceil($numAlianzasTotal/$numAlianzasPag);
				$this->tpl->setCurrentBlock('tPagMsg');
				for($i=0;$i<$paginas;$i++){
					$this->tpl->setVariable('PAG',$i+1);
					$this->tpl->setVariable('INICIO',($i*$numAlianzasPag));
					if($tipoPuntuacion=='naves')
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('naves'));
			        elseif($tipoPuntuacion=='tropas')
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('tropas'));
			        elseif($tipoPuntuacion=='defensas')
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('defensas'));
			        elseif($tipoPuntuacion=='investigacion')
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('investigacion'));
			        elseif($tipoPuntuacion=='total')
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('total'));
			        else
			        	$this->tpl->setVariable('TIPOPUNTUACION',_('media'));
					//Si es la pagina actual la marcamos
					if($i+1==$pag)
						$this->tpl->touchBlock('tPagActual');
					$this->tpl->parseCurrentBlock();
				}
	
				$this->tpl->setCurrentBlock('tAlianza');
				//Calculamos la primera posicion
				$pos=($numAlianzasPag*($pag-1))+1;
				foreach($alianzas as $datos){
					$this->tpl->setVariable('POSICION',$pos);
					$this->tpl->setVariable('IDALIANZA',$datos['id']);
					$this->tpl->setVariable('ALIANZA',$datos['alianza']);
					$this->tpl->setVariable('FUNDADOR',$datos['fundador']);

					//Colocamos el tipo de puntuacion
					if($tipoPuntuacion=='naves')
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosNaves']));
			        elseif($tipoPuntuacion=='tropas')
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosSoldados']));
			        elseif($tipoPuntuacion=='defensas')
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosDefensas']));
			        elseif($tipoPuntuacion=='investigacion')
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosTecnologias']));
			        elseif($tipoPuntuacion=='total')
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosTotales']));
			        else
			        	$this->tpl->setVariable('PUNTUACION',floor($datos['puntosMedia']));
	
					//Si es el usuario que esta mirando el ranking lo marcamos y ocultamos opciones
					if($datos['id']==$idAlianza){
						$this->tpl->touchBlock('tAlianzaPropia');
					}
	
					$this->tpl->setVariable('_ENVIARMENSAJE',_('Enviar mensaje al l&#237;der'));
					if($idAlianza==""){
						$this->tpl->setVariable('_ENVIARSOLICITUD',_('Enviar solicitud de entrada'));
						$this->tpl->setVariable('_MENSAJESOLICITUD',_('Escribe un mensaje en la solicitud'));
					}
	
					//Si es la alianza del usuario que esta mirando el ranking la marcamos
					if($datos['id']==$idAlianza)
						$this->tpl->touchBlock('tAlianzaPropia');
	
					$pos++;
			       	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra resultados de busqueda
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer usuarios
	     * @param  Integer comercioPosible
	     * @param  Integer idUsuario
	     * @return mixed
	     * @since 29/08/2010
	     */
	    public function buscar($usuarios, $comercioPosible, $idUsuario, $idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('ranking/usuariosLista.tpl');
	
			if(count($usuarios)==0){
				$this->tpl->setVariable('IDRAZANOUSUARIOS',$idRaza);
				$this->tpl->setVariable('_NOUSUARIOS',_('No se han encontrado usuarios'));
				$this->tpl->parse('tNoUsuarios');
				$this->tpl->hideBlock('tUsuarios');
			}
			else{
				//Idioma
				$this->tpl->setVariable('_USUARIO',_('Usuario'));
		        $this->tpl->setVariable('_ALIANZA',_('Alianza'));
				$this->tpl->setVariable('_OPCIONES',_('Opciones'));
	
		        $this->tpl->hideBlock('tNoUsuarios');
				$this->tpl->setCurrentBlock('tUsuario');
	
				foreach($usuarios as $datos){
					//Datos del usuario
					$this->tpl->setVariable('IDUSUARIO',$datos['id']);
					$this->tpl->setVariable('USUARIO',$datos['nombre']);
					$this->tpl->setVariable('RAZA',$datos['raza']);
					$this->tpl->setVariable('RAZAIMG',$_ENV['config']->get('razasImgFolder').$datos['idRaza'].'.png');
					$this->tpl->setVariable('ALIANZA',$datos['alianza']);
	
					$this->tpl->setVariable('_PUNTOSNAVES',_('Puntos de naves'));
					$this->tpl->setVariable('_PUNTOSSOLDADOS',_('Puntos de tropas'));
					$this->tpl->setVariable('_PUNTOSDEFENSAS',_('Puntos de defensas'));
					$this->tpl->setVariable('_PUNTOSTECNOLOGIAS',_('Puntos de tecnolog&#237;as'));
					$this->tpl->setVariable('_PUNTOSTOTALES',_('Puntos totales'));
					$this->tpl->setVariable('PUNTOSNAVES',$datos['puntosNaves']);
					$this->tpl->setVariable('PUNTOSSOLDADOS',$datos['puntosSoldados']);
					$this->tpl->setVariable('PUNTOSDEFENSAS',$datos['puntosDefensas']);
					$this->tpl->setVariable('PUNTOSTECNOLOGIAS',$datos['puntosTecnologias']);
					$this->tpl->setVariable('PUNTOSTOTALES',$datos['puntosTotales']);
	
					//Si esta de vacaciones
					if($datos['vacaciones']){
						$this->tpl->setVariable('IDRAZAVACACIONES',$idRaza);
						$this->tpl->setVariable('_VACACIONESICO',_('De vacaciones'));
					}
					//Si esta inactivo
					if($datos['inactivo']){
						$this->tpl->setVariable('IDRAZAINACTIVO',$idRaza);
						$this->tpl->setVariable('_INACTIVOICO',_('Inactivo'));
					}
					//Si es debil
					if($datos['debil']){
						$this->tpl->setVariable('IDRAZADEBIL',$idRaza);
						$this->tpl->setVariable('_DEBILICO',_('Debil'));
					}
	
					//Si es el usuario que esta buscando
					if($datos['id']==$idUsuario){
						$this->tpl->touchBlock('tPropio');
					}
					else{
						$this->tpl->setVariable('_ENVIARMENSAJE',_('Enviar mensaje'));
						if($comercioPosible[$datos['id']]){
							$this->tpl->setVariable('_ENVIARCOMERCIO',_('Enviar comercio'));
						}
					}
	
		        	$this->tpl->parseCurrentBlock();
				}
			}
	        
	        //Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	    /**
	     * Muestra el buscador
	     *
	     * @access public
	     * @author David & Jose
	     * @return mixed
	     * @since 29/08/2010
	     */
	    public function buscador($idRaza)
	    {
	        
	        //Cargamos la plantilla
			$this->tpl->loadTemplateFile('ranking/buscador.tpl');
			
			$this->tpl->setVariable('IDRAZA',$idRaza);
	
			//Idioma
			$this->tpl->setVariable('_DEBIL',_('Debil'));
	        $this->tpl->setVariable('_INACTIVO',_('Inactivo'));
	        $this->tpl->setVariable('_VACACIONES',_('Vacaciones'));
			$this->tpl->setVariable('_BUSCAR',_('Buscar'));
			$this->tpl->setVariable('_MENSAJEBUSCAR',_('Utilice el buscador para buscar usuarios'));
			$this->tpl->setVariable('_DEBILDESC',_('Los jugadores son d&#233;biles cuando tienen menos de '.$_ENV['config']->get('puntuacionDebil').' puntos de investigaci&#243;n, los jugadores d&#233;biles solo pueden atacar a jugadores d&#233;biles y solo pueden ser atacados por jugadores d&#233;biles.'));
	        $this->tpl->setVariable('_INACTIVODESC',_('El usuario lleva sin entrar al juego mas de 15 dias.'));
	        $this->tpl->setVariable('_VACACIONESDESC',_('El usuario está en modo vacaciones, no participar&#225; en las batallas y permanecer&#225; en este modo al menos 48 horas.'));
	
			//Finalmente, mostramos la plantilla.
			$this->tpl->show();
	        
	    }
	
	}
?>