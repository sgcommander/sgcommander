	<input type="hidden" name="idExplorador" value="{IDEXPLORADOR}" id="idExplorador" />
	<!-- BEGIN tPlaneta -->
	<div class="planetaGalaxia">
		<!-- BEGIN tRiqueza -->
		<div class="planetaRiqueza">{RIQUEZA}</div>
		<!-- END tRiqueza -->
		<!-- BEGIN tRaza -->
		<div class="planetaRaza">
			<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />
		</div>
		<!-- END tRaza -->
		<!-- BEGIN tIconos -->
		<div class="planetaIconos">
			<!-- BEGIN tDebil -->
			<img src="/images/iconos/{IDRAZADEBILICO}/debil.png" alt="{_DEBILICO}" width="18px" height="18px" class="tooltip icono" title="{_DEBILICO}" />
			<!-- END tDebil -->
			<!-- BEGIN tInactivo -->
			<img src="/images/iconos/{IDRAZAINACTIVOICO}/inactivo.png" alt="{_INACTIVOICO}" width="18px" height="18px" class="tooltip icono" title="{_INACTIVOICO}" />
			<!-- END tInactivo -->
			<!-- BEGIN tVacaciones -->
			<img src="/images/iconos/{IDRAZAVACACIONESICO}/vacaciones.png" alt="{_VACACIONESICO}" width="18px" height="18px" class="tooltip icono" title="{_VACACIONESICO}"  />
			<!-- END tVacaciones -->
		</div>
		<!-- END tIconos -->
		<div class="planetaAcciones">
			<input type="hidden" class="idGalaxia" value="{IDGALPLANETA}" />
			<input type="hidden" class="idPlaneta" value="{IDPLANETA}" />
			<!-- BEGIN tNaves -->
			<img src="/images/iconos/{IDRAZA}/enviar_naves.png" alt="{_ENVIARNAVES}" width="35" height="35" class="btnNaves tooltip" title="{_ENVIARNAVES}" />
			<!-- END tNaves -->
			<!-- BEGIN tSoldados -->
			<img src="/images/iconos/{IDRAZA}/enviar_soldados.png" alt="{_ENVIARTROPAS}" width="35" height="35" class="btnTropas tooltip" title="{_ENVIARTROPAS}" />
			<!-- END tSoldados -->
			<!-- BEGIN tDefensas -->
			<img src="/images/iconos/{IDRAZA}/enviar_defensas.png" alt="{_ENVIARDEFENSAS}" width="35" height="35" class="btnDefensas tooltip" title="{_ENVIARDEFENSAS}" />
			<!-- END tDefensas -->
			<!-- BEGIN tExplorar -->
			<img src="/images/iconos/{IDRAZA}/enviar_exploracion.png" alt="{_ENVIAREXPLORAR}" width="35" height="35" class="btnExplorar tooltip" title="{_ENVIAREXPLORAR}" />
			<!-- END tExplorar -->
			<!-- BEGIN tAnadir -->
			<img src="/images/iconos/{IDRAZA}/anadir_lista.png" alt="{_ANADIRTULISTA}" width="35" height="35" class="btnAnadir tooltip" title="{_ANADIRTULISTA}" />
			<!-- END tAnadir -->
			<!-- BEGIN tEliminar -->
			<img src="/images/iconos/{IDRAZA}/eliminar_lista.png" alt="{_ELIMINARTULISTA}" width="35" height="35" class="btnEliminar tooltip" title="{_ELIMINARTULISTA}" />
			<!-- END tEliminar -->
		</div>
		<div class="planetaPropietario">{PLANETAUSR} {PLANETAALZ}</div>
		<div class="planetaImagen"><img src="{IMGPLANETA}" alt="{NOMPLANETA}" class="imagenPlanetaNor" /></div>
		<div>{NOMPLANETA}</div>
	</div>
	<!-- END tPlaneta -->