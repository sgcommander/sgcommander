			<tr class="th1">
				<th colspan="5">{_MISIONESTIPO}</th>
			</tr>
			<tr class="th2">
				<th>{_MISION}</th>
				<th>{_ORIGEN}</th>
				<th>{_DESTINO}</th>
				<th>{_TIEMPO}</th>
				<th>{_OPCIONES}</th>
			</tr>
			<!-- BEGIN tMision -->
			<tr>
				<td>
					<div><img src="/images/iconos/+.png" class="misionBtnVer" /> {MISION}</div>
					<!-- BEGIN tMisionVuelta -->
					<div>({_REGRESO})</div>
					<!-- END tMisionVuelta -->
				</td>
				<td><a href="?controlador=Galaxias&amp;accion=galaxias&amp;idGalaxia={IDGALAXIAORIGEN}&amp;idSector={IDSECTORORIGEN}&amp;idCuadrante={IDCUADRANTEORIGEN}" class="enlacePlaneta">{ORIGEN}</a></td>
				<td><a href="?controlador=Galaxias&amp;accion=galaxias&amp;idGalaxia={IDGALAXIADESTINO}&amp;idSector={IDSECTORDESTINO}&amp;idCuadrante={IDCUADRANTEDESTINO}" class="enlacePlaneta">{DESTINO}</a></td>
				<td>
					<div class="cuentaAtrasMision">{TIEMPO}</div>
					<div>{_CONQUISTANDO}</div>
				</td>
				<td>
					<!-- BEGIN tUsuario -->
					{USUARIO}
					<!-- END tUsuario -->
					<input type="hidden" class="idMision" value="{IDMISION}" />
					<!-- BEGIN tMisionRegresar -->
					<div><input type="button" class="btnRegresar" value="{_REGRESAR}" /></div>
					<!-- END tMisionRegresar -->
					<!-- BEGIN tMisionNueva -->
					<div><input type="button" class="btnNuevaMision" value="{_NUEVAMISION}" /></div>
					<!-- END tMisionNueva -->
					<!-- BEGIN tMisionNinguna -->
					-
					<!-- END tMisionNinguna -->
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="misionUnidades">
						<table cellpadding="0" cellspacing="0" class="tablaMisionUnidades">
							<tbody>
								<!-- BEGIN tMisionUnidad -->
								<tr>
									<td>
										<img src="{UNIDADIMG}" class="imagenUnidadPeq" alt="{NOMUNIDAD}" />
									</td>
									<td><b>{NOMUNIDAD}</b></td>
									<td><b>{CANTIDAD}</b></td>
								</tr>
								<!-- END tMisionUnidad -->
							</tbody>
						</table>
					</div>
				</td>
			</tr>
			<!-- END tMision -->