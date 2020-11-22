<div>
	<div id="comerciosDivInfo" class="mensaje"></div>
	<!-- BEGIN tTituloComercios -->
	<div class="tablaTitulo">{_COMERCIOS}</div>
	<!-- END tTituloComercios -->
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<!-- BEGIN tNoComercios -->
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZA}/comercios.png" alt="{_NOCOMERCIOS}" /></td>
				<td>{_NOCOMERCIOS}</td>
			</tr>
			<!-- END tNoComercios -->
			<!-- BEGIN tComerciosRecibidos -->
			<tr class="th1">
				<th colspan="4">{_RECIBIDOS}</th>
			</tr>
			<tr class="th2">
				<th>{_ENVIADOPOR}</th>
				<th>{_OFRECE}</th>
				<th>{_PIDE}</th>
				<th>{_OPCIONES}</th>
			</tr>
			<!-- BEGIN tComercioRecibido -->
			<tr>
				<td>{COMRECUSUARIO}</td>
				<td>
					<div>{RECCANTIDADPRIOFRECIDA} {PRIMARIO}</div>
					<div>{RECCANTIDADSECOFRECIDA} {SECUNDARIO}</div>
				</td>
				<td>
					<div>{RECCANTIDADPRIPEDIDA} {PRIMARIO}</div>
					<div>{RECCANTIDADSECPEDIDA} {SECUNDARIO}</div>
				</td>
				<td>
					<input type="hidden" class="idComercio" value="{IDCOMERCIO}" />
					<div><input type="button" class="btnNormal btnAceptar" value="{_ACEPTAR}" /></div>
					<div><input type="button" class="btnNormal btnRechazar" value="{_RECHAZAR}" /></div>
				</td>
			</tr>
			<!-- END tComercioRecibido -->
			<!-- END tComerciosRecibidos -->
			<!-- BEGIN tComerciosEnviados -->
			<tr class="th1">
				<th colspan="4">{_ENVIADOS}</th>
			</tr>
			<tr class="th2">
				<th>{_ENVIADOA}</th>
				<th>{_OFRECES}</th>
				<th>{_PIDES}</th>
				<th>{_OPCIONES}</th>
			</tr>
			<!-- BEGIN tComercioEnviado -->
			<tr>
				<td>{COMENVUSUARIO}</td>
				<td>
					<div>{ENVCANTIDADPRIOFRECIDA} {PRIMARIO}</div>
					<div>{ENVCANTIDADSECOFRECIDA} {SECUNDARIO}</div>
				</td>
				<td>
					<div>{ENVCANTIDADPRIPEDIDA} {PRIMARIO}</div>
					<div>{ENVCANTIDADSECPEDIDA} {SECUNDARIO}</div>
				</td>
				<td>
					<input type="hidden" class="idComercio" value="{IDCOMERCIO}" />
					<div><input type="button" class="btnNormal btnCancelar" value="{_CANCELAR}" /></div>
				</td>
			</tr>
			<!-- END tComercioEnviado -->
			<!-- END tComerciosEnviados -->
		</tbody>
	</table> 			
</div>