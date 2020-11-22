	<div>
		<!-- BEGIN tNoUnidades -->
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<tbody>
			<tr class="th1">
				<td>{_NOUNIDADES}</td>
			</tr>
		</tbody>
		</table>
		<!-- END tNoUnidades -->
		
		<!-- BEGIN tUnidades -->
		<table class="tablaDisponibles tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{_UNIDAD}</th>
					<th>{_REQUISITOS}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tUnidad -->
				<tr>
					<td>
						<img src="{UNIDADIMG}" class="imagenUnidadNor" alt="{NOMUNIDAD}" />
					</td>
					<td>
						{NOMUNIDAD}
					</td>
					<td>
						<!-- BEGIN tRequisitoCumplido -->
						<div class="requisitoCumplido">{NOMMEJORA} {_NIVEL} {NIVEL}</div>
						<!-- END tRequisitoCumplido -->
						<!-- BEGIN tRequisitoNoCumplido -->
						<div class="requisitoNoCumplido">{NOMMEJORA} {_NIVEL} {NIVEL}</div>
						<!-- END tRequisitoNoCumplido -->
					</td>
				</tr>
				<!-- END tUnidad -->
			</tbody>
		</table>
		<!-- END tUnidades -->			
 	</div>