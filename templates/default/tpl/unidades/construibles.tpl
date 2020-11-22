	<div>
		<!-- BEGIN tLimite -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZALIMITE}/limite_tropas.png" alt="{_LIMITETROPAS}" /></td>
				<td>{_MENSAJELIMITE}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tLimite -->
		
		<!-- BEGIN tNoUnidades -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOUNIDADES}/lupa.png" alt="{_NOUNIDADES}" /></td>
				<td>{_NOUNIDADES}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoUnidades -->
		
		<!-- BEGIN tUnidad -->
		<table class="tablaMejora tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="3">{NOMUNIDAD} ({TIPOUNIDAD})</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div><img src="{UNIDADIMG}" class="imagenMejora" alt="{NOMUNIDAD}" /></div>
						<div class="unidadDivAtributos">
							<!-- BEGIN tAtaque -->
							<div>
								<img src="/images/iconos/{IDRAZA}/ataque.png" class="tooltip" title="{_ATAQUE} ({_BASE} + {_MEJORAS})&lt;br&gt;{BASE} + {MEJORAS}" alt="{_ATAQUE}" />
								<span>{ATAQUE}</span>
							</div>
							<!-- END tAtaque -->
							<!-- BEGIN tResistencia -->
							<div>
								<img src="/images/iconos/{IDRAZA}/resistencia.png" class="tooltip" title="{_RESISTENCIA} ({_BASE} + {_MEJORAS})&lt;br&gt;{BASE} + {MEJORAS}" alt="{_RESISTENCIA}" />
								<span>{RESISTENCIA}</span>
							</div>
							<!-- END tResistencia -->
							<!-- BEGIN tEscudos -->
							<div>
								<img src="/images/iconos/{IDRAZA}/escudos.png" class="tooltip" title="{_ESCUDOS} ({_BASE} + {_MEJORAS})&lt;br&gt;{BASE} + {MEJORAS}" alt="{_ESCUDOS}" />
								<span>{ESCUDOS}</span>
							</div>
							<!-- END tEscudos -->
							<!-- BEGIN tCarga -->
							<div>
								<img src="/images/iconos/{IDRAZA}/carga.png" class="tooltip" title="{_CARGA} ({_BASE} + {_MEJORAS})&lt;br&gt;{BASE} + {MEJORAS}" alt="{_CARGA}" />
								<span>{CARGA}</span>
							</div>
							<!-- END tCarga -->
							<!-- BEGIN tVelocidad -->
							<div>
								<img src="/images/iconos/{IDRAZA}/velocidad.png" class="tooltip" title="{_VELOCIDADH} ({_BASE} + {_MEJORAS})&lt;br&gt;{BASE} + {MEJORAS}" alt="{_VELOCIDADH}" />
								<span>{VELOCIDAD}</span>
							</div>
							<!-- END tVelocidad -->
							<!-- BEGIN tCazas -->
							<div>
								<img src="/images/iconos/{IDRAZA}/cazas.png" class="tooltip" title="{_CAZAS}" alt="{_CAZAS}" />
								<span>{CAZAS}</span>
							</div>
							<!-- END tCazas -->
							<!-- BEGIN tStargate -->
							<div>
								<img src="/images/iconos/{IDRAZA}/stargate.png" class="tooltip" title="{_ATRAVIESASTARGATE}" alt="{_ATRAVIESASTARGATE}" />
							</div>
							<!-- END tStargate -->
							<!-- BEGIN tCamuflaje -->
							<div>
								<img src="/images/iconos/{IDRAZA}/camuflaje.png" class="tooltip" title="{_CAMUFLAJE}" alt="{_CAMUFLAJE}" />
							</div>
							<!-- END tCamuflaje -->
							<!-- BEGIN tAtraviesa -->
							<div>
								<img src="/images/iconos/{IDRAZA}/atraviesaescudo.png" class="tooltip" title="{_ATRAVIESAESCUDOS}" alt="{_ATRAVIESAESCUDOS}" />
							</div>
							<!-- END tAtraviesa -->
							<!-- BEGIN tAutodestruccion -->
							<div>
								<img src="/images/iconos/{IDRAZA}/autodestruccion.png" class="tooltip" title="{_AUTODESTRUCCION}" alt="{_AUTODESTRUCCION}" />
							</div>
							<!-- END tAutodestruccion -->
						</div>
					</td>
					<td>
						<div class="txtJustificado">{UNIDADDESC}</div>
						<!-- BEGIN tFuegoRapido -->
						<div>
							<table class="tablaSegundoNivel tablaMejoras" cellpadding="0" cellspacing="0">
								<thead>
									<tr class="th2">
										<th>{_FUEGORAPIDO}</th>
										<th>{_NUMDISPAROS}</th>
									</tr>
								</thead>
								<tbody>
									<!-- BEGIN tFuego -->
									<tr>
										<td>{UNIDADDEFIENDE}</td>
										<td class="tablaCantidad">{DISPAROS}</td>
									</tr>
									<!-- END tFuego -->
								</tbody>
							</table>
						</div>
						<!-- END tFuegoRapido -->
						<!-- BEGIN tMejoras -->
						<div>
							<table class="tablaSegundoNivel tablaMejoras" cellpadding="0" cellspacing="0">
								<thead>
									<tr class="th2">
										<th colspan="2">{_MEJORAS}</th>
									</tr>
								</thead>
								<tbody>
									<!-- BEGIN tMejora -->
									<tr>
										<td class="tablaCantidad">{PORCENTAJE}</td>
										<td>{MEJORA}</td>
									</tr>
									<!-- END tMejora -->
								</tbody>
							</table>
						</div>
						<!-- END tMejoras -->
						<div>
							<table class="tablaCostes" cellpadding="0" cellspacing="0">
								<tbody>
									<!-- BEGIN tRecurso -->
									<tr>
										<td><img src="{RECURSOIMG}" alt="{RECURSONOM}" /></td>
										<td><span>{RECURSONOM}:</span></td>
										<td><span class="txtNegrita">{RECURSOCANT}</span></td>
									</tr>
									<!-- END tRecurso -->
									<!-- BEGIN tUnidadReq -->
									<tr>
										<td><img src="{UNIDADREQIMG}" class="imagenUnidadReq" alt="{UNIDADREQNOM}" /></td>
										<td><span>{UNIDADREQNOM}:</span></td>
										<td><span class="txtNegrita">{UNIDADREQCANT}</span></td>
									</tr>
									<!-- END tUnidadReq -->
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
						<div class="infoConstruir">
							<input type="hidden" class="idUnidad" value="{IDUNIDAD}" />
							<input type="hidden" class="primario" value="{RECURSOPRICANT}" />
							<input type="hidden" class="secundario" value="{RECURSOSECCANT}" />
							<input type="hidden" class="energia" value="{ENERGIACANT}" />
							<input type="hidden" class="tiempo" value="{TIEMPOTOTAL}" />
							<input type="hidden" class="maxUnidadesReq" value="{MAXUNIDADESCONS}" />
							<input type="hidden" class="heroe" value="{HEROE}" />
							<!-- BEGIN tConstruir -->
							<div class="construir" style="display:{DISPLAYCONSTRUIR}">
								<input type="button" class="btnMaximo" value="{_MAXIMO}" />
								<input type="text" class="txtCantidad cantidad" value="0" />
								<input type="button" class="btnConstruir disabled" value="{_CONSTRUIR}" disabled="disabled" />
							</div>
							<!-- END tConstruir -->
							<div class="construyendoActual" style="display:{DISPLAYCONSTRUYENDOACTUAL}">
								<!-- BEGIN tConstruyendoActual -->
								<div>{_CONSTRUYENDO} {CANTIDAD} {_UNIDADES}</div>
								<input type="hidden" id="cantidad" value="{CANTIDAD}" />
								<div id="unidadesDivCuentaAtras" class="cuentaAtras">{TIEMPO}</div>
								<button type="button" id="unidadesBtnCancelar" value="{_CANCELAR}">{_CANCELAR}</button>
								<!-- END tConstruyendoActual -->
							</div>
							<!-- BEGIN tConstruyendo -->
							<div class="construyendo" style="display:{DISPLAYCONSTRUYENDO}">
								-
							</div>
							<!-- END tConstruyendo -->
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- END tUnidad -->			
 	</div>