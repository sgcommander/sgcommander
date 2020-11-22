<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=true;
	var controlador='Index';
	var accion='principal';
</script>
<div id="titulo"></div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	{BLOQUECOMERCIOS}
	{BLOQUEMISIONES}
	{BLOQUESENSORES}
	{BLOQUEMEJORACTUAL}
	<div>
		<div class="tablaTitulo">{_PLANETAS}</div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_PLANETA}</th>
					<th>{_UNIDADES}</th>
					<th>{_CONSTRUCCIONES}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tPlanetaCentro -->
				<tr>
					<td>
						<!-- BEGIN tRiqueza -->
						<div class="misionPlanetaRiqueza">{PLANETARIQ} %</div>
						<!-- END tRiqueza -->
						<div><img src="{PLANETAIMG}" class="imagenPlanetaPeq" alt="{PLANETANOM}" /></div>
					</td>	
					<td>
						<div>{PLANETANOM}</div>
						<div>
							<input type="hidden" class="idGalaxia" value="{IDGALAXIACENTRO}" />
							<input type="hidden" class="idSector" value="{IDSECTORCENTRO}" />
							<input type="hidden" class="idCuadrante" value="{IDCUADRANTECENTRO}" />
							<input type="button" class="principalBtnVerPlaneta" value="{_VERPLANETA}" />
						</div>
					</td>
					<td>
						<div class="numUnidades"><img src="/images/iconos/{IDRAZA}/num_soldados.png" class="tooltip icono" alt="{_TROPAS}" title="{_TROPAS}" /> {NUMTROPAS}</div>
						<div class="numUnidades"><img src="/images/iconos/{IDRAZA}/num_naves.png" class="tooltip icono" alt="{_NAVES}" title="{_NAVES}" /> {NUMNAVES}</div>
						<div class="numUnidades"><img src="/images/iconos/{IDRAZA}/num_defensas.png" class="tooltip icono" alt="{_DEFENSAS}" title="{_DEFENSAS}" /> {NUMDEFENSAS}</div>
					</td>
					<td style="width:250px;">
						<div>
							<div class="principalDivConstrucciones" style="display:{DISPLAYCONSTRUCCIONES}">
								<div class="principalDivConsTropas" style="display:{DISPLAYTROPA}">
									<input type="hidden" class="tiempoTotal" value="{TIEMPOTOTALTROPA}" />
									<input type="hidden" class="tiempoRestante" value="{TIEMPORESTANTETROPA}" />
									<img src="{INDEXTROPAIMG}" class="imagenUnidadPeq" alt="{INDEXTROPANOM}" />
								</div>
								<div class="principalDivConsNaves" style="display:{DISPLAYNAVE}">
									<input type="hidden" class="tiempoTotal" value="{TIEMPOTOTALNAVE}" />
									<input type="hidden" class="tiempoRestante" value="{TIEMPORESTANTENAVE}" />
									<img src="{INDEXNAVEIMG}" class="imagenUnidadPeq" alt="{INDEXNAVENOM}" />
								</div>
								<div class="principalDivConsDefensas" style="display:{DISPLAYDEFENSA}">
									<input type="hidden" class="tiempoTotal" value="{TIEMPOTOTALDEFENSA}" />
									<input type="hidden" class="tiempoRestante" value="{TIEMPORESTANTEDEFENSA}" />
									<img src="{INDEXDEFENSAIMG}" class="imagenUnidadPeq" alt="{INDEXDEFENSANOM}" />
								</div>
							</div>
							<div class="principalDivNoConstrucciones" style="display:{DISPLAYNOCONSTRUCCIONES}">
								<span class="lblNoHay">{_NOCONSTRUCCIONES}</span>
							</div>
						</div>
					</td>
				</tr>
				<!-- END tPlanetaCentro -->
			</tbody>
		</table> 			
 	</div>
	<div>
		<div class="tablaTitulo">{_ESTADISTICAS}</div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_PUNTUACION}</th>
					<th colspan="2">{_POSICION}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">{PUNTOS}</td>
					<td colspan="2">{POSICION}</td>
				</tr>
				<tr class="th2">
					<th>{_NAVES}</th>
					<th>{_TROPAS}</th>
					<th>{_DEFENSAS}</th>
					<th>{_TECNOLOGIA}</th>
				</tr>
				<tr>
					<td>{PUNTOSNAVES}</td>
					<td>{PUNTOSSOLDADOS}</td>
					<td>{PUNTOSDEFENSAS}</td>
					<td>{PUNTOSTECNOLOGIAS}</td>
				</tr>
			</tbody>
		</table> 			
 	</div>
 </div>