<div id="pestanasBatalla">
	<ul class="morphtabs_title">
       	<li title="general">{_GENERAL}</li>
		<!-- BEGIN tPestanaPlaneta -->
       	<li title="planeta">{_PLANETA}</li>
       	<!-- END tPestanaPlaneta -->
       	<!-- BEGIN tPestanaTropas -->
       	<li title="tropas">{_TROPAS}</li>
       	<!-- END tPestanaTropas -->
       	<!-- BEGIN tPestanaNaves -->
       	<li title="naves">{_NAVES}</li>
       	<!-- END tPestanaNaves -->
       	<!-- BEGIN tPestanaDefensas -->
       	<li title="defensas">{_DEFENSAS}</li>
       	<!-- END tPestanaDefensas -->	
    </ul>
	<div id="general" class="morphtabs_panel">
		<div class="pestanaBatalla">
			<table class="batallaTabla" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th class="th1"></th>
						<th class="th1">{_GENERALTROPAS}</th>
						<th class="th1">{_GENERALNAVES}</th>
						<th class="th1">{_GENERALDEFENSAS}</th>
						<th class="th1">{_GENERALTOTAL}</th>
					</tr>
				</thead>
				<tbody>
					<!-- BEGIN tUsuario -->	
					<tr class="{TIPO}">
						<td class="batallaTablaJugador">
							<div class="batallaCeldaJugador">{JUGADOR}</div>
							<div class="batallaCeldaAlianza">{ALIANZA}</div>
							<div class="batallaCeldaRaza"><img src="{RAZAIMG}" class="imagenRazaIcono" alt="{RAZA}" width="25" height="25" /> <span>{RAZA}</span></div>
						</td>
						<td>
							<div class="batallaPuntos">{PUNTOSTROPAS}</div>
							<div class="batallaBarra" title="{TOOLTIPTROPAS}">
								<div class="batallaPorcentajePerdido" style="margin-left:{TROPASPERDIDOLEFT}px; width:{TROPASPERDIDO}px;"></div>
								<div class="batallaPorcentajeInicial"></div>
								<div class="batallaPorcentajeGanado" style="width:{TROPASGANADO}px;"></div>
							</div>
						</td>
						<td>
							<div class="batallaPuntos">{PUNTOSNAVES}</div>
							<div class="batallaBarra" title="{TOOLTIPNAVES}">
								<div class="batallaPorcentajePerdido" style="margin-left:{NAVESPERDIDOLEFT}px; width:{NAVESPERDIDO}px;"></div>
								<div class="batallaPorcentajeInicial"></div>
								<div class="batallaPorcentajeGanado" style="width:{NAVESGANADO}px;"></div>
							</div>
						</td>
						<td>
							<div class="batallaPuntos">{PUNTOSDEFENSAS}</div>
							<div class="batallaBarra" title="{TOOLTIPDEFENSAS}">
								<div class="batallaPorcentajePerdido" style="margin-left:{DEFENSASPERDIDOLEFT}px; width:{DEFENSASPERDIDO}px;"></div>
								<div class="batallaPorcentajeInicial"></div>
								<div class="batallaPorcentajeGanado" style="width:{DEFENSASGANADO}px;"></div>
							</div>
						</td>
						<td>
							<div class="batallaPuntosGrande">{PUNTOSTOTALES}</div>
							<div class="batallaBarra" title="{TOOLTIPTOTAL}">
								<div class="batallaPorcentajePerdido" style="margin-left:{TOTALPERDIDOLEFT}px; width:{TOTALPERDIDO}px;"></div>
								<div class="batallaPorcentajeInicial"></div>
								<div class="batallaPorcentajeGanado" style="width:{TOTALGANADO}px;"></div>
							</div>
						</td>
					</tr>
					<!-- END tUsuario -->
				</tbody>
			</table>
		</div>
	</div>
	<!-- BEGIN tContenidoTropas -->
	<div id="tropas" class="morphtabs_panel">
		<div class="pestanaBatalla">
			<table class="batallaTabla" cellpadding="0" cellspacing="0">
				<tbody>
					<!-- BEGIN tUsuarioTropas -->	
					<tr>
						<td class="batallaTablaJugador">
							<div class="batallaCeldaJugador">{TROPASJUGADOR}</div>
							<div class="batallaCeldaAlianza">{TROPASALIANZA}</div>
							<div class="batallaCeldaRaza"><img src="{TROPASRAZAIMG}" class="imagenRazaIcono" alt="{TROPASRAZA}" width="25" height="25" /> <span>{TROPASRAZA}</span></div>
						</td>
						<td>
							<table class="unidadesTabla" cellpadding="0" cellspacing="0">
								<!-- BEGIN tTropasIniciales -->
								<tr>
									<td class="batallaCeldaGrande th1">{_TROPASINICIALES} / {_TROPASFINALES}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tTropaInicial -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{TROPAINICIALIMG}" class="imagenUnidadPeq" alt="{TROPAINICIAL}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{TROPAINICIAL}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADINICIAL}: <span>{NUMTROPAINICIAL}</span></div>
											<div class="batallaCeldaCantidad">{_CANTIDADFINAL}: <span>{NUMTROPAFINAL}</span></div>
										</div>
										<!-- END tTropaInicial -->
									</td>
								</tr>
								<!-- END tTropasIniciales -->
								<!-- BEGIN tTropasDestruidas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_TROPASDESTRUIDAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tTropaDestruida -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{TROPADESTRUIDAIMG}" class="imagenUnidadPeq" alt="{TROPADESTRUIDA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{TROPADESTRUIDA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADDESTRUIDA}: <span>{NUMTROPADESTRUIDA}</span></div>
										</div>
										<!-- END tTropaDestruida -->
									</td>
								</tr>
								<!-- END tTropasDestruidas -->
								<!-- BEGIN tTropasCapturadas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_TROPASCAPTURADAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tTropaCapturada -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{TROPACAPTURADAIMG}" class="imagenUnidadPeq" alt="{TROPACAPTURADA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{TROPACAPTURADA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADCAPTURADA}: <span>{NUMTROPACAPTURADA}</span></div>
										</div>
										<!-- END tTropaCapturada -->
									</td>
								</tr>
								<!-- END tTropasCapturadas -->
							</table>
						</td>	
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<!-- END tUsuarioTropas -->
				</tbody>
			</table>
		</div>
	</div>
	<!-- END tContenidoTropas -->
	<!-- BEGIN tContenidoNaves -->
	<div id="naves" class="morphtabs_panel">
		<div class="pestanaBatalla">
			<table class="batallaTabla" cellpadding="0" cellspacing="0">
				<tbody>
					<!-- BEGIN tUsuarioNaves -->	
					<tr>
						<td class="batallaTablaJugador">
							<div class="batallaCeldaJugador">{NAVESJUGADOR}</div>
							<div class="batallaCeldaAlianza">{NAVESALIANZA}</div>
							<div class="batallaCeldaRaza"><img src="{NAVESRAZAIMG}" class="imagenRazaIcono" alt="{NAVESRAZA}" width="25" height="25" /> <span>{NAVESRAZA}</span></div>
						</td>
						<td>
							<table class="unidadesTabla" cellpadding="0" cellspacing="0">
								<!-- BEGIN tNavesIniciales -->
								<tr>
									<td class="batallaCeldaGrande th1">{_NAVESINICIALES} / {_NAVESFINALES}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tNaveInicial -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{NAVEINICIALIMG}" class="imagenUnidadPeq" alt="{NAVEINICIAL}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{NAVEINICIAL}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADINICIAL}: <span>{NUMNAVEINICIAL}</span></div>
											<div class="batallaCeldaCantidad">{_CANTIDADFINAL}: <span>{NUMNAVEFINAL}</span></div>
										</div>
										<!-- END tNaveInicial -->
									</td>
								</tr>
								<!-- END tNavesIniciales -->
								<!-- BEGIN tNavesDestruidas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_NAVESDESTRUIDAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tNaveDestruida -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{NAVEDESTRUIDAIMG}" class="imagenUnidadPeq" alt="{NAVEDESTRUIDA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{NAVEDESTRUIDA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADDESTRUIDA}: <span>{NUMNAVEDESTRUIDA}</span></div>
										</div>
										<!-- END tNaveDestruida -->
									</td>
								</tr>
								<!-- END tNavesDestruidas -->
								<!-- BEGIN tNavesCapturadas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_NAVESCAPTURADAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tNaveCapturada -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{NAVECAPTURADAIMG}" class="imagenUnidadPeq" alt="{NAVECAPTURADA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{NAVECAPTURADA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADCAPTURADA}: <span>{NUMNAVECAPTURADA}</span></div>
										</div>
										<!-- END tNaveCapturada -->
									</td>
								</tr>
								<!-- END tNavesCapturadas -->
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<!-- END tUsuarioNaves -->
				</tbody>
			</table>
		</div>
	</div>
	<!-- END tContenidoNaves -->
	<!-- BEGIN tContenidoDefensas -->
	<div id="defensas" class="morphtabs_panel">
		<div class="pestanaBatalla">
			<table class="batallaTabla" cellpadding="0" cellspacing="0">
				<tbody>
					<!-- BEGIN tUsuarioDefensas -->	
					<tr>
						<td class="batallaTablaJugador">
							<div class="batallaCeldaJugador">{DEFENSASJUGADOR}</div>
							<div class="batallaCeldaAlianza">{DEFENSASALIANZA}</div>
							<div class="batallaCeldaRaza"><img src="{DEFENSASRAZAIMG}" class="imagenRazaIcono" alt="{DEFENSASRAZA}" width="25" height="25" /> <span>{DEFENSASRAZA}</span></div>
						</td>
						<td>
							<table class="unidadesTabla" cellpadding="0" cellspacing="0">
								<!-- BEGIN tDefensasIniciales -->
								<tr>
									<td class="batallaCeldaGrande th1">{_DEFENSASINICIALES} / {_DEFENSASFINALES}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tDefensaInicial -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{DEFENSAINICIALIMG}" class="imagenUnidadPeq" alt="{DEFENSAINICIAL}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{DEFENSAINICIAL}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADINICIAL}: <span>{NUMDEFENSAINICIAL}</span></div>
											<div class="batallaCeldaCantidad">{_CANTIDADFINAL}: <span>{NUMDEFENSAFINAL}</span></div>
										</div>
										<!-- END tDefensaInicial -->
									</td>
								</tr>
								<!-- END tDefensasIniciales -->
								<!-- BEGIN tDefensasDestruidas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_DEFENSASDESTRUIDAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tDefensaDestruida -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{DEFENSADESTRUIDAIMG}" class="imagenUnidadPeq" alt="{DEFENSADESTRUIDA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{DEFENSADESTRUIDA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADDESTRUIDA}: <span>{NUMDEFENSADESTRUIDA}</span></div>
										</div>
										<!-- END tDefensaDestruida -->
									</td>
								</tr>
								<!-- END tDefensasDestruidas -->
								<!-- BEGIN tDefensasCapturadas -->
								<tr>
									<td class="batallaCeldaGrande th1">{_DEFENSASCAPTURADAS}</td>
								</tr>
								<tr class="tablaSegundoNivel">
									<td>
										<!-- BEGIN tDefensaCapturada -->
										<div class="batallaCeldaUnidad">
											<div class="batallaCeldaImagenUnidad"><img src="{DEFENSACAPTURADAIMG}" class="imagenUnidadPeq" alt="{DEFENSACAPTURADA}" width="78" height="60" /></div>
											<div class="batallaCeldaUnidadNombre">{DEFENSACAPTURADA}</div>
											<div class="batallaCeldaCantidad">{_CANTIDADCAPTURADA}: <span>{NUMDEFENSACAPTURADA}</span></div>
										</div>
										<!-- END tDefensaCapturada -->
									</td>
								</tr>
								<!-- END tDefensasCapturadas -->
							</table>
						</td>
					</tr>			
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<!-- END tUsuarioDefensas -->
				</tbody>
			</table>
		</div>
	</div>
	<!-- END tContenidoDefensas -->
	<!-- BEGIN tContenidoPlaneta -->
	<div id="planeta" class="morphtabs_panel">
		<div class="pestanaBatalla">
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
		</div>
	</div>
	<!-- END tContenidoPlaneta -->
</div>