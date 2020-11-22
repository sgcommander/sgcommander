	<div>
		<!-- BEGIN tNoSolicitudes -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOSOLICITUDES}/lupa.png" alt="{_NOSOLICITUDES}" /></td>
				<td>{_NOSOLICITUDES}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoSolicitudes -->
		<!-- BEGIN tSolicitudes -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_USUARIO}</th>
					<th>{_PUNTUACION}</th>
					<th>{_OPCIONES}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tSolicitud -->
				<tr>
					<td>
						<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />
					</td>
					<td>{USUARIO}</td>
					<td>{PUNTUACION}</td>
					<td rowspan="2">
						<div><input type="button" class="btnNormal btnAceptar" value="{_ACEPTAR}" /></div>
						<div><input type="button" class="btnNormal btnDenegar" value="{_DENEGAR}" /></div>
						<input type="hidden" class="idUsuario" value="{IDUSUARIO}" />
					</td>
				</tr>
				<tr class="tablaSegundoNivel">
					<td colspan="3" class="txtSolicitud"><textarea cols="50" rows="4" readonly="readonly">{MENSAJE}</textarea></td>
				</tr>
				<!-- END tSolicitud -->
			</tbody>
		</table>
		<!-- END tSolicitudes --> 			
 	</div>