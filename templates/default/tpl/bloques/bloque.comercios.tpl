<!-- inicioBloque: tBloque -->
	<div>
		{COMERCIOSTITULO}
		<!-- inicioBloque: tTituloComercios -->
		<div class="tablatitulo">{_COMERCIOS}</div>
		<!-- finBloque: tTituloComercios -->
		<table class="tablacentral" cellpadding="0" cellspacing="0">
			<tbody>
				{COMERCIOS}
				<!-- inicioBloque: tNoComercios -->
				<tr class="th1">
					<td>{_NOCOMERCIOS}</td>
				</tr>
				<!-- finBloque: tNoComercios -->
				<!-- inicioBloque: tComerciosRecibidos -->
				<tr class="th1">
					<th colspan="4">{_RECIBIDOS}</th>
				</tr>
				<tr class="th2">
					<th>{_ENVIADOPOR}</th>
					<th>{_OFRECE}</th>
					<th>{_PIDE}</th>
					<th>{_OPCIONES}</th>
				</tr>
				{COMERCIOSREC}
				<!-- inicioBloque: tComercioRecibido -->
				<tr>
					<td>{COMRECUSUARIO}</td>
					<td>
						<div>{CRORECPRI} {RECURSOPRINOM}</div>
						<div>{CRORECSEC} {RECURSOSECNOM}</div>
					</td>
					<td>
						<div>{CRPRECPRI} {RECURSOPRINOM}</div>
						<div>{CRPRECSEC} {RECURSOSECNOM}</div>
					</td>
					<td>
						<div><input type="button" class="btnnormal" value="{_ACEPTAR}" /></div>
						<div><input type="button" class="btnnormal" value="{_RECHAZAR}" /><div>
					</td>
				</tr>
				<!-- finBloque: tComercioRecibido -->
				<!-- finBloque: tComerciosRecibidos -->

				<!-- inicioBloque: tComerciosEnviados -->
				<tr class="th1">
					<th colspan="4">{_ENVIADOS}</th>
				</tr>
				<tr class="th2">
					<th>{_ENVIADOA}</th>
					<th>{_OFRECES}</th>
					<th>{_PIDES}</th>
					<th>{_OPCIONES}</th>
				</tr>
				{COMERCIOSENV}
				<!-- inicioBloque: tComercioEnviado -->
				<tr>
					<td>{COMENVUSUARIO}</td>
					<td>
						<div>{CEORECPRI} {RECURSOPRINOM}</div>
						<div>{CEORECSEC} {RECURSOSECNOM}</div>
					</td>
					<td>
						<div>{CEPRECPRI} {RECURSOPRINOM}</div>
						<div>{CEPRECSEC} {RECURSOSECNOM}</div>
					</td>
					<td>
						<div><input type="button" class="btnnormal" value="{_CANCELAR}" /></div>
					</td>
				</tr>
				<!-- finBloque: tComercioEnviado -->
				<!-- finBloque: tComerciosEnviados -->
			</tbody>
		</table> 			
 	</div>
<!-- finBloque: tBloque -->