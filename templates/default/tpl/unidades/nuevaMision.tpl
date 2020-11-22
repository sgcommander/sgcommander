<!-- INCLUDE bloques/publicidad480x60.tpl -->
<div>
	<input type="hidden" id="idTipoUnidadMision" value="{IDTIPOUNIDADMISION}" />
	<input type="hidden" id="idMision" value="{IDMISION}" />
	<input type="hidden" id="idGalaxiaOrigen" value="{IDGALAXIAORIGEN}" />
	<input type="hidden" id="idPlanetaOrigen" value="{IDPLANETAORIGEN}" />
	<table class="tablaDisponibles tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="5">{_UNIDADESMISION}</th>
			</tr>
			<tr class="th2">
				<th colspan="2">{_UNIDAD}</th>
				<th>{_DISPONIBLES}</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN tUnidad -->
			<tr>
				<td>
					<img src="{UNIDADIMG}" class="imagenUnidadPeq" alt="{NOMUNIDAD}" />
				</td>
				<td>
					<div><span class="txtNegrita">{NOMUNIDAD}</span></div>
				</td>
				<td class="cantidades">
					<span class="txtNegrita">{CANTIDAD}</span>
					<input type="hidden" class="idUnidad" value="{IDUNIDAD}" />
					<input type="hidden" class="cantidad" value="{CANTIDAD}" />
				</td>
			</tr>
			<!-- END tUnidad -->
			<!-- BEGIN tDestino -->
			<tr class="th2">
				<th colspan="3">{_DESTINODELAMISION}</th>
			</tr>
			<tr>
				<td colspan="2">
					<select name="unidadSelPlanetas" id="unidadSelPlanetas">
						<option value="0">{_SELECCIONAPLANETADESTINO}...</option>
						<!-- BEGIN tPlaneta -->
						<option value="{DATOSPLANETA}" {SELECTED}>{PLANETA}</option>
						<!-- END tPlaneta -->
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" id="misionPlaneta">
					{MISIONPLANETA}
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="button" id="unidadBtnEnviar" class="disabled" disabled="disabled" value="{_ENVIARMISION}" />
				</td>
			</tr> 
			<!-- END tDestino -->
		</tbody>
	</table>
 </div>