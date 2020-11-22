<div id="especialesDivContenido">
	<input type="button" id="especialesBtnCerrar" value="X" />
	<!-- BEGIN tNoEspeciales -->
	<div id="especialesLblNoEsp">{_NOESPECIALES}</div>
	<!-- END tNoEspeciales -->
	<!-- BEGIN tEspecial -->
	<div class="divEspecial">
		{ESPECIAL}
	</div>
	<!-- END tEspecial -->
	<div class="ajustar"></div>
</div>
<div id="especialesDivPlanetas">
	<div>{_ELIJAPLANETADESTINO}:</div>
	<div>
		<select id="especialesSelPlaneta" name="especialesSelPlaneta">
			<option value="0" selected="selected">{_SELECCIONAPLANETA}...</option>
			<!-- BEGIN tPlanetasEnemigos -->
			<option value="{DATOSPLANETA}">{PLANETANOMBRE}</option>
			<!-- END tPlanetasEnemigos -->	
		</select>
	</div>
</div>