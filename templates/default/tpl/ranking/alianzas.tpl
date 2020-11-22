	<!-- BEGIN tSelRanking -->
	<div class="parrafo">
		<div class="rankingSelect">
			<select id="rankingSelPuntos">
				<option value="media" {SELMEDIA}>{_PUNTUACIONMEDIA}</option>
				<option value="total" {SELTOTAL}>{_PUNTUACIONTOTAL}</option>
				<option value="naves" {SELNAVES}>{_PUNTUACIONNAVES}</option>
				<option value="tropas" {SELTROPAS}>{_PUNTUACIONTROPAS}</option>
				<option value="defensas" {SELDEFENSAS}>{_PUNTUACIONDEFENSAS}</option>
				<option value="investigacion" {SELINVESTIGACION}>{_PUNTUACIONINVESTIGACION}</option>
			</select>
		</div>
	</div>
	<!-- END tSelRanking -->
	<div>
		<!-- BEGIN tNoAlianzas -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td>{_NOALIANZAS}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoAlianzas -->
		<!-- BEGIN tAlianzas -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th>N&#186;</th>
					<th>{_ALIANZA}</th>
					<th>{_LIDER}</th>
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
							<a href="index.php?controlador=Ranking&amp;accion=alianzas&amp;inicio={INICIO}">{PAG}</a>
						</span>
					<!-- END tPagMsg -->
					</td>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tAlianza -->
				<tr
				<!-- BEGIN tAlianzaPropia -->
				class="tablaSegundoNivel"
				<!-- END tAlianzaPropia -->
				>
					<td>{POSICION}</td>
					<td><a class="enlaceAlianza" href="index.php?controlador=Alianza&amp;accion=verAlianza&amp;idAlianza={IDALIANZA}">{ALIANZA}</a></td>
					<td>{FUNDADOR}</td>
					<td>{PUNTUACION}</td>
					<td>
						<a href="?controlador=Mensajes&amp;accion=mensajes" class="enlaceEnviarMensaje">
							<img src="/images/iconos/leido.png" class="tooltip" title="{_ENVIARMENSAJE}" alt="{_ENVIARMENSAJE}" border="0" />
						</a>
						<!-- BEGIN tOtra -->
						<a href="?controlador=Alianza&amp;accion=enviarSolicitud" class="enlaceEnviarSolicitud">
							<img src="/images/iconos/solicitud.png" class="tooltip" title="{_ENVIARSOLICITUD}" alt="{_ENVIARSOLICITUD}" border="0" />
						</a>
						<!-- END tOtra -->
						<input type="hidden" class="idAlianza" value="{IDALIANZA}" />
						<input type="hidden" class="fundador" value="{FUNDADOR}" />
						<input type="hidden" class="mensajeSolicitud" value="{_MENSAJESOLICITUD}" />
					</td>
				</tr>
				<!-- END tAlianza -->
			</tbody>
		</table>
		<!-- END tAlianzas --> 			
 	</div>