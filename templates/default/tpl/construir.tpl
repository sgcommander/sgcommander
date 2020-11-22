<!-- inicioBloque: tPestana -->
	<div class="parrafo">
		{UNIDADES}
		<!-- inicioBloque: tUnidades -->
		<div>
			<div class="unidadimgdiv"><img src="{UNIDADIMG}" class="imagenunidad" alt="{UNIDADNOM}" /></div>
			<div class="unidadtextodiv">
				<div class="unidadtxttitulo"><span class="txtnegrita">{UNIDADNOM}</span> ({UNIDADTIPO})</div>
				<div class="unidadtxtdescripcion">{UNIDADDESC}</div>
				<div class="unidadtxtprecios">
					{RECURSOS}
				 	<!-- inicioBloque: tRecurso -->
					<div><span class="txtnegrita">{RECURSONOM}:</span> {RECURSOCANT}</div>
					<!-- finBloque: tRecurso -->
					<div><span class="txtnegrita">{_TIEMPOENTRENAMIENTO}:</span> {UNIDADTIEMPO}</div>
				</div>	
			</div>
			<div class="unidadbotonesdiv" id="unidadconstruccioninfo">
				<form>
					<p>{_CANTIDAD}</p>
					<p><input type="text" value="0" name="cantidad" class="txtcantidad" /></p>
					<p><input type="submit" value="{_ENTRENAR}" /></p>
				</form>
			</div>
		</div>
		<!-- finBloque: tUnidades -->
	</div>
<!-- finBloque: tPestana -->