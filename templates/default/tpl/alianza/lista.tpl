	<div>
		<!-- BEGIN tNoAlianzas -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOALIANZAS}/lupa.png" alt="{_NOALIANZAS}" /></td>
				<td>{_NOALIANZAS}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoAlianzas -->
		<!-- BEGIN tAlianzas -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th>{_ALIANZA}</th>
					<th>{_LIDER}</th>
					<th>{_PUNTUACION}</th>
					<th>{_OPCIONES}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tAlianza -->
				<tr>
					<td>{ALIANZA}</td>
					<td>{FUNDADOR}</td>
					<td>{PUNTUACION}</td>
					<td>
						<a href="?controlador=Alianza&amp;accion=enviarSolicitud" class="enlaceEnviarSolicitud">
							<img src="/images/iconos/{IDRAZA}/solicitud.png" class="tooltip" title="{_ENVIARSOLICITUD}" alt="{_ENVIARSOLICITUD}" border="0" />
						</a>
						<input type="hidden" class="idAlianza" value="{IDALIANZA}" />
						<input type="hidden" class="fundador" value="{FUNDADOR}" />
						<input type="hidden" class="mensajeSolicitud" value="{_MENSAJESOLICITUD}" />
					</td>
				</tr>
				<!-- END tAlianza -->
			</tbody>
		</table>
		<!-- END tAlianzas --> 			
 	</div>