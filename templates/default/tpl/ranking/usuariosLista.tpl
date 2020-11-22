	<div>
		<!-- BEGIN tNoUsuarios -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOUSUARIOS}/lupa.png" alt="{_NOUSUARIOS}" /></td>
				<td>{_NOUSUARIOS}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoUsuarios -->
		<!-- BEGIN tUsuarios -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_USUARIO}</th>
					<th>{_ALIANZA}</th>
					<th>{_OPCIONES}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tUsuario -->
				<tr>
					<td>
						<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />
					</td>
					<td>
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
					</td>
					<td>{ALIANZA}</td>
					<td rowspan="2">
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
						<!-- BEGIN tPropio -->
						-
						<!-- END tPropio -->
						<input type="hidden" class="idUsuario" value="{IDUSUARIO}" />
						<input type="hidden" class="usuario" value="{USUARIO}" />
					</td>
				</tr>
				<tr class="tablaSegundoNivel">
					<td colspan="3" class="txtSolicitud">
						<div>{_PUNTOSNAVES}: <span class="txtNegrita">{PUNTOSNAVES}</span></div>
						<div>{_PUNTOSSOLDADOS}: <span class="txtNegrita">{PUNTOSSOLDADOS}</span></div>
						<div>{_PUNTOSDEFENSAS}: <span class="txtNegrita">{PUNTOSDEFENSAS}</span></div>
						<div>{_PUNTOSTECNOLOGIAS}: <span class="txtNegrita">{PUNTOSTECNOLOGIAS}</span></div>
						<div>{_PUNTOSTOTALES}: <span class="txtNegrita">{PUNTOSTOTALES}</span></div>
					</td>
				</tr>
				<!-- END tUsuario -->
			</tbody>
		</table>
		<!-- END tUsuarios --> 			
 	</div>