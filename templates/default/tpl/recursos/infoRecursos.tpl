	<div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_RECURSO}</th>
					<th>{_PRODUCCION}</th>
					<th>{_DISPONIBLE}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tInfoRecursos -->
				<tr>
					<td><img src="{INFORECURSOIMG}" alt="{INFORECURSONOM}" /></td>
					<td>{INFORECURSONOM}</td>
					<td>{INFORECURSOPRODUCCION}</td>
					<td><span class="{SPANRECNOM}">{INFORECURSOCANTIDAD}</span> {_UND}</td>
				</tr>
				<!-- END tInfoRecursos -->
				<tr class="th1">
					<th colspan="2">{_UNIDADES}</th>
					<th>{_MAXIMO}</th>
					<th>{_ACTUAL}</th>
				</tr>
				<tr>
					<td><img src="/images/iconos/{IDRAZA}/soldados.png" alt="{_TROPAS}" width="30" height="30" /></td>
					<td>{_TROPAS}</td>
					<td>{TROPASLIM} {_UND}</td>
					<td>{TROPASACTUAL} {_UND}</td>
				</tr>
				<tr>
					<td><img src="/images/iconos/{IDRAZA}/naves.png" alt="{_NAVES}" width="30" height="30" /></td>
					<td>{_NAVES}</td>
					<td>-</td>
					<td>{NAVESACTUAL} {_UND}</td>
				</tr>
				<tr>
					<td><img src="/images/iconos/{IDRAZA}/defensas.png" alt="{_DEFENSAS}" width="30" height="30" /></td>
					<td>{_DEFENSAS}</td>
					<td>-</td>
					<td>{DEFENSASACTUAL} {_UND}</td>
				</tr>
				
			</tbody>
		</table> 			
 	</div>

	<div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_INTERCAMBIAR} {_RECURSOS}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div id="recursosDivErrorIntercambio" class="mensaje"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							<input type="text" name="recursosTxtCantidad" value="0" id="recursosTxtCantidad" class="txtCantidad" /> 
							{_DE} 
							<select name="recurso" id="recursosSelCambioRecurso" class="lstRecursos">
	         						<option value="1" selected="selected">{RECURSOPRINOM}</option>
									<option value="2">{RECURSOSECNOM}</option>
	       						</select>
							{_POR} 
							<span id="recursosLblCambioCantidad">0</span> 
							{_DE}
							<span id="recursosLblCambioRecurso">{RECURSOSECNOM} </span>
							<input type="button" value="{_INTERCAMBIAR}" id="recursosBtnIntercambiar" />
						</div>
					</td>
				</tr>
			</tbody>
		</table> 			
 	</div>