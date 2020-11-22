	<div class="parrafo">
		<div class="iconosUsuario">
			<span><img src="/images/iconos/{IDRAZA}/debil.png" class="tooltipDescripcion icono" alt="{_DEBIL}" width="18px" height="18px" title="{_DEBILDESC}" /> {_DEBIL}</span>
			<span><img src="/images/iconos/{IDRAZA}/inactivo.png" class="tooltipDescripcion icono" alt="{_INACTIVO}" width="18px" height="18px" title="{_INACTIVODESC}" /> {_INACTIVO}</span>
			<span><img src="/images/iconos/{IDRAZA}/vacaciones.png" class="tooltipDescripcion icono" alt="{_VACACIONES}" width="18px" height="18px" title="{_VACACIONESDESC}" /> {_VACACIONES}</span>
			<span>
				<select id="rankingSelPuntos">
					<option value="total" {SELTOTAL}>{_PUNTUACIONTOTAL}</option>
					<option value="naves" {SELNAVES}>{_PUNTUACIONNAVES}</option>
					<option value="tropas" {SELTROPAS}>{_PUNTUACIONTROPAS}</option>
					<option value="defensas" {SELDEFENSAS}>{_PUNTUACIONDEFENSAS}</option>
					<option value="investigacion" {SELINVESTIGACION}>{_PUNTUACIONINVESTIGACION}</option>
				</select>
			</span>
		</div>
	</div>
	<div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th>N&#186;</th>
					<th colspan="2">{_USUARIO} ({_ALIANZA})</th>
					<th>{_PUNTUACION} {TIPO}</th>
					<th>{_OPCIONES}</th>
				</tr>
				<tr>
					<td colspan="5" class="th2">
					<!-- BEGIN tPagMsg -->
						<span class="paginar 
						<!-- BEGIN tPagActual -->
						 pagActual
						<!-- END tPagActual -->
						">
							<a href="index.php?controlador=Ranking&amp;accion=usuarios&amp;tipoPuntuacion={TIPOPUNTUACION}&amp;inicio={INICIO}">{PAG}</a>
						</span>
					<!-- END tPagMsg -->
					</td>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tUsuario -->
				<tr
				<!-- BEGIN tUsuarioPropio -->
				class="tablaSegundoNivel"
				<!-- END tUsuarioPropio -->
				>
					<td>{POSICION}</td>
					<td>
						<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />
					</td>
					<td>
						<div>
							<!-- BEGIN tAlianza -->
							<span>{USUARIO} <a class="enlaceAlianza" href="index.php?controlador=Alianza&amp;accion=verAlianza&amp;idAlianza={IDALIANZA}">{ALIANZA}</a></span>
							<!-- END tAlianza -->
							<!-- BEGIN tNoAlianza -->
							<span>{USUARIO}</span>
							<!-- END tNoAlianza -->
							<!-- BEGIN tVacaciones -->
							<span>
								<img src="/images/iconos/{IDRAZAVACACIONES}/vacaciones.png" class="tooltip icono" title="{_VACACIONESICO}" alt="{_VACACIONESICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tVacaciones -->
							<!-- BEGIN tInactivo -->
							<span>
								<img src="/images/iconos/{IDRAZAINACTIVO}/inactivo.png" class="tooltip icono" title="{_INACTIVOICO}" alt="{_INACTIVOICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tInactivo -->
							<!-- BEGIN tDebil -->
							<span>
								<img src="/images/iconos/{IDRAZADEBIL}/debil.png" class="tooltip icono" title="{_DEBILICO}" alt="{_DEBILICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tDebil -->
						</div>
					</td>
					<td>{PUNTUACION}</td>
					<td>
						<!-- BEGIN tOtro -->
						<a href="?controlador=Mensajes&amp;accion=mensajes" class="enlaceEnviarMensaje">
							<img src="/images/iconos/leido.png" class="tooltip" title="{_ENVIARMENSAJE}" alt="{_ENVIARMENSAJE}" border="0" />
						</a>
						<!-- BEGIN tComercio -->
						<a href="?controlador=Recursos&amp;accion=nuevoComercio" class="enlaceEnviarComercio">
							<img src="/images/iconos/comercio.png" class="tooltip" title="{_ENVIARCOMERCIO}" alt="{_ENVIARCOMERCIO}" border="0" />
						</a>
						<!-- END tComercio -->
						<!-- END tOtro -->
						<!-- BEGIN tPropio -->
						-
						<!-- END tPropio -->
						<input type="hidden" class="idUsuario" value="{IDUSUARIO}" />
						<input type="hidden" class="usuario" value="{USUARIO}" />
					</td>
				</tr>
				<!-- END tUsuario -->
			</tbody>
		</table>			
 	</div>