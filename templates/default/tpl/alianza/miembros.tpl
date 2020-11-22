	<div>
		<input type="hidden" id="alianzaLblConfirmacionExpulsar" value="{_CONFEXPULSAR}" />
		<input type="hidden" id="alianzaLblConfirmacionCeder" value="{_CONFCEDER}" />
		<input type="hidden" id="alianzaLblConfirmacionAbandonar" value="{_CONFABANDONAR}" />
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_USUARIO}</th>
					<th>{_PUNTUACION}</th>
					<th>{_OPCIONES}</th>
				</tr>
				<tr>
					<td colspan="4" class="th2">
					<!-- BEGIN tPagMsg -->
						<span class="paginar 
						<!-- BEGIN tPagActual -->
						 pagActual
						<!-- END tPagActual -->
						">
							<a href="index.php?controlador=Alianza&amp;accion=miembros&amp;inicio={INICIO}">{PAG}</a>
						</span>
					<!-- END tPagMsg -->
					</td>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tUsuario -->
				<tr
				<!-- BEGIN tUsuarioPropio -->
				class="tablaSegundoNivel"
				<!-- END tUsuarioPropio -->
				>
					<td>
						<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />			
					</td>
					<td>
						<div>
							<!-- BEGIN tLider -->
							<img src="/images/iconos/{IDRAZALIDER}/lider.png" class="tooltip icono" title="{_LIDER}" alt="{_LIDER}" width="32" height="28" />
							<!-- END tLider -->
							<span>{USUARIO}</span>
							<!-- BEGIN tVacaciones -->
							<span>
								<img src="/images/iconos/{IDRAZAVACACIONES}/vacaciones.png" class="tooltip icono" title="{_VACACIONESICO}" alt="{_VACACIONESICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tVacaciones -->
							<!-- BEGIN tInactivo -->
							<span>
								<img src="/images/iconos/{IDRAZAINACTIVO}/inactivo.png" class="tooltip icono" title="{_INACTIVOICO}" alt="{_INACTIVOICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tInactivo -->
							<!-- BEGIN tDebil -->
							<span>
								<img src="/images/iconos/{IDRAZADEBIL}/debil.png" class="tooltip icono" title="{_DEBILICO}" alt="{_DEBILICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tDebil -->
						</div>
					</td>
					<td>{PUNTUACION}</td>
					<td>
						<!-- BEGIN tOtro -->
						<a href="?controlador=Mensajes&amp;accion=mensajes" class="enlaceEnviarMensaje">
							<img src="/images/iconos/leido.png" class="tooltip" title="{_ENVIARMENSAJE}" alt="{_ENVIARMENSAJE}" border="0" />
						</a>
						<!-- BEGIN tComercio -->
						<a href="?controlador=Recursos&amp;accion=nuevoComercio" class="enlaceEnviarComercio">
							<img src="/images/iconos/comercio.png" class="tooltip" title="{_ENVIARCOMERCIO}" alt="{_ENVIARCOMERCIO}" border="0" />
						</a>
						<!-- END tComercio -->
						<!-- END tOtro -->
						<!-- BEGIN tLiderazgo -->
						<a href="#" class="enlaceCederLiderazgo">
							<img src="/images/iconos/{IDRAZALIDERAZGO}/liderazgo.png" class="tooltip" title="{_LIDERAZGO}" alt="{_LIDERAZGO}" border="0" />
						</a>
						<!-- END tLiderazgo -->
						<!-- BEGIN tExpulsar -->
						<a href="#" class="enlaceExpulsarUsuario">
							<img src="/images/iconos/{IDRAZAEXPULSAR}/expulsar.png" class="tooltip" title="{_EXPULSAR}" alt="{_EXPULSAR}" border="0" />
						</a>
						<!-- END tExpulsar -->
						<!-- BEGIN tAbandonar -->
						<a href="#" id="alianzaEnlaceAbandonar">
							<img src="/images/iconos/{IDRAZAABANDONAR}/expulsar.png" class="tooltip" title="{_ABANDONAR}" alt="{_ABANDONAR}" border="0" />
						</a>
						<!-- END tAbandonar -->
						<!-- BEGIN tNinguna -->
						-
						<!-- END tNinguna -->
						<input type="hidden" class="idUsuario" value="{IDUSUARIO}" />
						<input type="hidden" class="usuario" value="{USUARIO}" />
						
					</td>
				</tr>
				<!-- END tUsuario -->
			</tbody>
		</table>			
 	</div>