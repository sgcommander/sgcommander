	<div>
		<!-- BEGIN tNoMejoras -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td>{_NOMEJORAS}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoMejoras -->
		
		<!-- BEGIN tMejora -->
		<table class="tablaMejora tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="3">{NOMMEJORA} ({_NIVELACTUAL} {NIVEL})</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<img src="{MEJORAIMG}" class="imagenMejora" alt="{NOMMEJORA}" />
					</td>
					<td>
						<div class="txtJustificado">{MEJORADESC}</div>
						<!-- BEGIN tMejoras -->
						<div>
							<table class="tablaSegundoNivel tablaMejoras" cellpadding="0" cellspacing="0">
								<thead>
									<tr class="th2">
										<th colspan="2">{_MEJORAS}</th>
									</tr>
								</thead>
								<tbody>
									<!-- BEGIN tMejoraActual -->
									<!-- BEGIN tPorcentaje -->
									<tr>
										<td><b>{PORCENTAJE}</b></td>
										<td>{MEJORA}</td>
									</tr>
									<!-- END tPorcentaje -->
									<!-- BEGIN tNoPorcentaje -->
									<tr>
										<td colspan="2" style="text-align:center">{MEJORANOPOR}</td>
									</tr>
									<!-- END tNoPorcentaje -->
									<!-- END tMejoraActual -->
								</tbody>
							</table>
						</div>
						<!-- END tMejoras -->
						<div>
							<table class="tablaCostes" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td><img src="{RECURSOPRIIMG}" alt="{RECURSOPRINOM}" /></td>
										<td><span>{RECURSOPRINOM}:</span></td>
										<td><span class="txtNegrita">{RECURSOPRICANT}</span></td>
									</tr>
									<tr>
										<td><img src="{RECURSOSECIMG}" alt="{RECURSOSECNOM}" /></td>
										<td><span>{RECURSOSECNOM}:</span></td>
										<td><span class="txtNegrita">{RECURSOSECCANT}</span></td>
									</tr>
									<tr>
										<td><img src="{TIEMPOIMG}" alt="{_TIEMPO}" /></td>
										<td><span>{_TIEMPO}:</span></td>
										<td><span class="txtNegrita">{TIEMPODHMS}</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
					<td class="control">
						<div class="infoInvestigar">
							<input type="hidden" class="idMejora" value="{IDMEJORA}" />
							<input type="hidden" class="nivelSig" value="{NIVELSIG}" />
							<!-- BEGIN tInvestigar -->
							<div class="investigar" style="display:{DISPLAYINVESTIGAR}">
								<button type="button" class="btnInvestigar" value="{_INVESTIGAR} &lt;br /&gt;{_NIVEL} {NIVELSIG}">{_INVESTIGAR}<br />{_NIVEL} {NIVELSIG}</button>
							</div>
							<!-- END tInvestigar -->
							<div class="investigandoActual" style="display:{DISPLAYINVESTIGANDOACTUAL}">
								<!-- BEGIN tInvestigandoActual -->
								<div>{_INVESTIGANDO}</div>
								<div id="mejorasDivCuentaAtras" class="cuentaAtras">{TIEMPO}</div>
								<button type="button" id="mejorasBtnCancelar" value="{_CANCELAR}">{_CANCELAR}</button>
								<!-- END tInvestigandoActual -->
							</div>
							<!-- BEGIN tInvestigando -->
							<div class="investigando" style="display:{DISPLAYINVESTIGANDO}">
								<!-- BEGIN tInsuficientes -->
								<div class="divRecursosIns">{_RECURSOSINS}</div>
								<!-- END tInsuficientes -->
								{ESTADOMEJ}
							</div>
							<!-- END tInvestigando -->
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- END tMejora -->			
 	</div>