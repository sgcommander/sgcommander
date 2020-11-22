<!-- inicioBloque: tPestana -->
	<div>
		<table class="tablacentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th colspan="2">{TIPOUNIDAD}</th>
					<th>{_REQUISITOS}</th>
				</tr>
			</thead>
			<tbody>
				{UNIDADES}
				<!-- inicioBloque: tUnidad -->
				<tr>
					<td><img src="{UNIDADIMG}" class="imagenunidad" alt="{UNIDADNOM}" /></td>
					<td>{UNIDADNOM}</td>
					<td>
						{REQUISITOS}
				 		<!-- inicioBloque: tRequisitoCumplido -->
						<div class="requisitocumplido">{TECNOLOGIA} {_NIVEL} {TECNIVEL}</div>
						<!-- finBloque: tRequisitoCumplido -->
						<!-- inicioBloque: tRequisitoIncumplido -->
						<div class="requisitoincumplido">{TECNOLOGIA} {_NIVEL} {TECNIVEL}</div>
						<!-- finBloque: tRequisitoIncumplido -->
					</td>
				</tr>
				<!-- finBloque: tUnidad -->
			</tbody>
		</table>
	</div>
<!-- finBloque: tPestana -->