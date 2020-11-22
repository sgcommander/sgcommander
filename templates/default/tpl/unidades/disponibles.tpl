<div>	
		<!-- BEGIN tLimite -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td class="celdaIcono"><img src="/images/iconos/{IDRAZALIMITE}/limite_misiones.png" alt="{_LIMITEMISIONES}" /></td>
				<td>{_MENSAJELIMITE}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tLimite -->
		
		<!-- BEGIN tNoUnidades -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<tbody>
				<tr class="th1">
					<td class="celdaIcono"><img src="/images/iconos/{IDRAZANOUNIDADES}/{NOMUNIDADES}.png" alt="{_NOUNIDADES}" /></td>
					<td>{_NOUNIDADES}</td>
				</tr>
			</tbody>
		</table>
		<!-- END tNoUnidades -->
		
		<!-- BEGIN tUnidades -->
		<input type="hidden" id="mensajesLblConfirmacionLicenciar" value="{_CONFLICENCIAR}" />
		<table class="tablaDisponibles tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="5">{_UNIDADESPLANETA}</th>
				</tr>
				<tr class="th2">
					<th colspan="2">{_UNIDAD}</th>
					<th>{_DISPONIBLES}</th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tUnidad -->
				<tr>
					<td>
						<img src="{UNIDADIMG}" class="imagenUnidadPeq" alt="{NOMUNIDAD}" />
					</td>
					<td>
						<div><span class="txtNegrita">{NOMUNIDAD}</span> ({TIPOUNIDAD})</div>
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
					<td><span class="txtNegrita">{CANTIDAD} / {CANTIDADTOTAL}</span></td>
					<!-- BEGIN tOpciones -->
					<td><input type="button" class="btnQuitar" value="&#60;&#60;" /> <input type="button" class="btnAnadir" value="&#62;&#62;" /></td>
					<td class="cantidades">
						<input type="hidden" class="idUnidad" value="{IDUNIDAD}" />
						<input type="hidden" class="cantidad" value="{CANTIDAD}" />
						<!-- BEGIN tValCazas -->
						<input type="hidden" class="stargate" value="{CRUZASTARGATE}" />
						<input type="hidden" class="caza" value="{ESCAZA}" />
						<input type="hidden" class="capacidadCazas" value="{CAPACIDADCAZAS}" />
						<!-- END tValCazas -->
						<!-- BEGIN tExplorador -->
						<input type="hidden" class="explorador" value="{EXPLORADOR}" />
						<!-- END tExplorador -->
						<input type="text" class="txtCantidad" value="0" />
					</td>
					<!-- END tOpciones -->
					<!-- BEGIN tNoOpciones -->
					<td colspan="2">
						<div>{_NOSEPUEDEMOVER}</div>
						<div>
							<input type="hidden" class="idUnidad" value="{IDUNIDAD}" />
							<input type="hidden" class="cantidad" value="{CANTIDAD}" />
							<input type="button" class="btnLicenciar" value="{_LICENCIARDEFENSASTARGATE}" />
						</div>
					</td>
					<!-- END tNoOpciones -->
				</tr>
				<!-- END tUnidad -->
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><input type="button" id="unidadBtnNinguna" value="{_NINGUNA}" /></td>
					<td><input type="button" id="unidadBtnTodas" value="{_TODAS}" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<!-- BEGIN tTotalCazas -->
						<div id="divEspacioCazas">
							<img src="/images/iconos/{IDRAZACAZAS}/cazas.png" class="tooltip" title="{_ESPACIOCAZAS}" alt="{_ESPACIOCAZAS}" />
							<span id="cantidadCazas">0</span> / <span id="capacidadCazas">0</span>
						</div>
						<!-- END tTotalCazas -->
					</td>
					<td></td>
					<td colspan="2"><input type="button" id="unidadBtnLicenciar" class="disabled" value="{_LICENCIAR}" disabled="disabled" /></td>
				</tr>
				<!-- BEGIN tDestino -->
				<tr class="th2">
					<th colspan="5">{_DESTINODELAMISION}</th>
				</tr>
				<tr>
					<td colspan="3">
						<select name="unidadSelPlanetas" id="unidadSelPlanetas">
							<option value="0">{_SELECCIONAPLANETADESTINO}...</option>
							<!-- BEGIN tPlaneta -->
							<option value="{DATOSPLANETA}" {SELECTED}>{PLANETA}</option>
							<!-- END tPlaneta -->
						</select>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5" id="misionPlaneta">
						{MISIONPLANETA}
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<input type="button" id="unidadBtnEnviar" class="disabled" disabled="disabled" value="{_ENVIARMISION}" />
					</td>
				</tr> 
				<!-- END tDestino -->
			</tbody>
		</table>
		<!-- END tUnidades -->		
 	</div>