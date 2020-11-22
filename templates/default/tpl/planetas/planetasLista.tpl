	<div class="parrafo">
		<!-- BEGIN tIconos -->
		<!--<div class="iconosUsuario">
			<span><img src="/images/iconos/debil.png" class="icono" alt="{_DEBIL}" width="18px" height="18px" /> {_DEBIL}</span>
			<span><img src="/images/iconos/inactivo.png" class="icono" alt="{_INACTIVO}" width="18px" height="18px" /> {_INACTIVO}</span>
			<span><img src="/images/iconos/vacaciones.png" class="icono" alt="{_VACACIONES}" width="18px" height="18px" /> {_VACACIONES}</span>
		</div>-->
		<!-- END tIconos -->
	</div>
	<div>
		<!-- BEGIN tNoPlanetas -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOPLANETAS}/planetas.png" alt="{_NOPLANETAS}" /></td>
				<td>{_NOPLANETAS}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoPlanetas -->
		<!-- BEGIN tPlanetas -->
		<!-- BEGIN tLimite -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZALIMITE}/planetas.png" alt="{_NOPLANETAS}" /></td>
				<td>{_MENSAJELIMITE}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tLimite -->
		<input type="hidden" id="planetasLblConfirmacionAbandonar" value="{_CONFABANDONAR}" />
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_PLANETA}</th>
					<th>{_USUARIO} ({_ALIANZA})</th>
					<th>{_RIQUEZA}</th>
					<th>{_OPCIONES}</th>
				</tr>
				<!-- BEGIN tPaginacion -->
				<td colspan="5" class="th2">
					<!-- BEGIN tPagPlaneta -->
						<span class="paginar <!-- BEGIN tPagActual -->pagActual<!-- END tPagActual -->">
							<a href="index.php?controlador=Planetas&amp;accion={ACCION}&amp;inicio={INICIO}">{PAG}</a>
						</span>
					<!-- END tPagPlaneta -->
				</td>
				<!-- END tPaginacion -->
			</thead>
			<tbody>
				<!-- BEGIN tPlaneta -->
				<!-- BEGIN tGalaxia -->
				<tr>
					<td colspan="5" class="th2">
						{NOMGALAXIA}
					</td>
				</tr>
				<!-- END tGalaxia -->
				<tr>
					<td>
						<img src="{PLANETAIMG}" class="imagenPlanetaPeq tooltip" alt="{PLANETANOM}" title="{PLANETANOTA}" />
					</td>
					<td>{PLANETANOM}</td>
					<td>
						<div>{PLANETAUSR} {PLANETAALZ}</div>
					</td>
					<td>{PLANETARIQ} %</td>
					<td class="planetaControles">
						<!--<div><input type="button" class="btnNormal btnTropas" value="{_ENVIARTROPAS}" /></div>
						<div><input type="button" class="btnNormal btnNaves" value="{_ENVIARNAVES}" /></div>-->
						<div><input type="button" class="btnNormal btnVerPlaneta" value="{_VERPLANETA}" /></div>
						<!-- BEGIN tPlanetaEliminar -->
						<div><input type="button" class="btnNormal btnEliminar" value="{_ELIMINARTULISTA}" /></div>
						<!-- END tPlanetaEliminar -->
						<!-- BEGIN tPlanetaAnadir -->
						<div><input type="button" class="btnNormal btnAnadir" value="{_ANADIRTULISTA}" /></div>
						<!-- END tPlanetaAnadir -->
						<!-- BEGIN tPlanetaAbandonar -->
						<div><input type="button" class="btnNormal btnAbandonar" value="{_ABANDONAR}" /></div>
						<!-- END tPlanetaAbandonar -->
						<input type="hidden" class="idGalaxia" value="{PLANETAIDGALAXIA}" />
						<input type="hidden" class="idSector" value="{PLANETAIDSECTOR}" />
						<input type="hidden" class="idCuadrante" value="{PLANETAIDCUADRANTE}" />
						<input type="hidden" class="idPlaneta" value="{PLANETAID}" />
					</td>
				</tr>
				<!-- END tPlaneta -->
			</tbody>
		</table>
		<!-- END tPlanetas --> 			
 	</div>