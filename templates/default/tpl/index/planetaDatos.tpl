<script type="text/javascript">
		var indexIdPlanetaSel={IDPLANETASEL};
		var indexIdGalaxiaSel={IDGALAXIASEL};
		var indexNombreSel="{PLANETASELNOMUSUARIO}";
		var indexNomCompletoSel="{PLANETASELNOM}";
</script>
<div id="indexDivPlanetaImagen">
	<img src="{PLANETASELIMG}" id="indexImgPlaneta" class="imagenPlanetaNor" alt="{PLANETASELNOM}"/>
</div>
<div id="indexDivPlanetaDatos">
	<div id="indexDivnombrePlaneta">{PLANETASELNOM}</div>
	<div id="indexDivcoordenadas">
		<!-- BEGIN tDibCoordenadas -->
			<img src="{IMGCOORD}" id="indexImgCoord{IDSIMBOLO}" class="imagenSimbolo" alt="{COORD}" />
		<!-- END tDibCoordenadas -->	
	</div>
	<div id="indexDivBotonesPlaneta">
		<input type="hidden" class="idGalaxia" value="{IDGALAXIASEL}" />
		<input type="hidden" class="idSector" value="{IDSECTORSEL}" />
		<input type="hidden" class="idCuadrante" value="{IDCUADRANTESEL}" />
		<input type="button" id="indexBtnVerPlaneta" value="{_VERPLANETA}" />
	</div>		
</div>