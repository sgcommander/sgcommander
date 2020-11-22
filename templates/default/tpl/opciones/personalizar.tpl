<div>
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_LOGOTIPO}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<img src="{IMGLOGOTIPOACTUAL}" border="0" class="imagenBorde" id="opcionesImgLogotipo" alt="{_LOGOTIPOACTUAL}" />
				</td>
				<td>
					<select name="opcionesSelLogotipo" id="opcionesSelLogotipo">
						<!-- BEGIN tLogotipo -->
						<option value="{DATOSLOGOTIPO}" {SELECTED}>{NOMLOGOTIPO}</option>
						<!-- END tLogotipo -->
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="opcionesDivLogotipoMensaje" class="mensaje"></div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" id="opcionesBtnLogotipo" value="{_CAMBIARLOGOTIPO}" /></td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_FIRMA}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="4">
					<img src="{IMGFIRMAACTUAL}" border="0" class="imagenBorde" id="opcionesImgFirma" alt="{_FIRMAACTUAL}" />
				</td>
				<td>
					<select name="opcionesSelFirma" id="opcionesSelFirma">
						<!-- BEGIN tFirma -->
						<option value="{DATOSFIRMA}" {SELECTED}>{NOMFIRMA}</option>
						<!-- END tFirma -->
					</select>
				</td>
			</tr>
			<tr>
				<td>{_URL}: <input type="text" class="txtFirma" name="opcionesTxtURL" id="opcionesTxtURL" value="{FIRMAURL}" /></td>
			</tr>
			<tr>
				<td>{_FOROS}: <input type="text" class="txtFirma" name="opcionesTxtFOROS" id="opcionesTxtFOROS" value="{FIRMAFOROS}" /></td>
			</tr>
			<tr>
				<td>{_HTML}: <input type="text" class="txtFirma" name="opcionesTxtHTML" id="opcionesTxtHTML" value="{FIRMAHTML}" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="opcionesDivFirmaMensaje" class="mensaje"></div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" id="opcionesBtnFirma" value="{_CAMBIARFIRMA}" /></td>
			</tr>
		</tbody>
	</table>
</div>