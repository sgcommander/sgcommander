<div class="reportePlaneta">
	<div class="reporteTitulo th1">{_PLANETAMISION}</div>
	<div class="reportePlanetaImagen">
		<div class="reportePlanetaRiqueza">{PLANETARIQ} %</div>
		<div><img src="{PLANETAIMG}" class="imagenPlanetaNor" alt="{PLANETANOM}" /></div>
	</div>
	<div class="reportePlanetaNombre">{PLANETANOM}</div>
	<div class="reportePlanetaUsuario">{PLANETAUSR} {PLANETAALZ}</div>
	<div class="reportePlanetaCoordenadas">
		<!-- BEGIN tDibCoordenadas -->
			<img src="{IMGCOORD}" id="reporteImgCoord{IDSIMBOLO}" class="imagenSimbolo" alt="{COORD}" />
		<!-- END tDibCoordenadas -->	
	</div>
</div>

<div class="reporteRecursos">
	
</div>

<div class="reporteUnidades">
	<div class="reporteTitulo th1">{_UNIDADESMISION}</div>
	<div class="reporteUnidadesLista">
	<!-- BEGIN tNoUnidades -->
	<div class="lblNoHay"><span>{_NOUNIDADES}</span></div>
	<!-- END tNoUnidades -->
	<!-- BEGIN tUnidad -->
	<div class="batallaCeldaUnidad">
		<div class="batallaCeldaImagenUnidad"><img src="{UNIDADIMG}" class="imagenUnidadPeq" alt="{UNIDAD}" width="78" height="60" /></div>
		<div class="batallaCeldaUnidadNombre">{UNIDAD}</div>
		<div class="batallaCeldaCantidad">{_CANTIDAD}: <span>{NUMUNIDAD}</span></div>
	</div>
	<!-- END tUnidad -->
	</div>
</div>