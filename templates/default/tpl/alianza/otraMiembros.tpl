	<div>
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_USUARIO}</th>
					<th>{_PUNTUACION}</th>
				</tr>
				<tr>
					<td colspan="3" class="th2">
					<!-- BEGIN tPagMsg -->
						<span class="paginar 
						<!-- BEGIN tPagActual -->
						 pagActual
						<!-- END tPagActual -->
						">
							<a href="index.php?controlador=Alianza&amp;accion=otraMiembros&amp;inicio={INICIO}&amp;idAlianza={IDALIANZA}">{PAG}</a>
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
					<td>
						<img src="{RAZAIMG}" class="imagenRazaIcono tooltip" title="{RAZA}" alt="{RAZA}" width="25" height="25" />
					</td>
					<td>
						<div>
							<!-- BEGIN tLider -->
							<img src="/images/iconos/lider.png" class="tooltip icono" title="{_LIDER}" alt="{_LIDER}" width="32" height="28" />
							<!-- END tLider -->
							<span>{USUARIO}</span>
							<!-- BEGIN tVacaciones -->
							<span>
								<img src="/images/iconos/vacaciones.png" class="tooltip icono" title="{_VACACIONESICO}" alt="{_VACACIONESICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tVacaciones -->
							<!-- BEGIN tInactivo -->
							<span>
								<img src="/images/iconos/inactivo.png" class="tooltip icono" title="{_INACTIVOICO}" alt="{_INACTIVOICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tInactivo -->
							<!-- BEGIN tDebil -->
							<span>
								<img src="/images/iconos/debil.png" class="tooltip icono" title="{_DEBILICO}" alt="{_DEBILICO}" width="18" height="18" border="0" />
							</span>
							<!-- END tDebil -->
						</div>
					</td>
					<td>{PUNTUACION}</td>
				</tr>
				<!-- END tUsuario -->
			</tbody>
		</table>			
 	</div>