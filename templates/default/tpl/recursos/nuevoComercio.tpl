<div id="comerciosDivCabecera">
	<input type="button" id="comerciosBtnCerrar" value="X" />
</div>

<div id="comerciosDivContenido">
	<form action="./index.php" name="comerciosFrmEnviar" id="comerciosFrmEnviar" method="post">
		<input type="hidden" name="controlador" value="Recursos"/>
		<input type="hidden" name="accion" value="enviarComercio"/>
		<input type="hidden" name="destino" value="{IDDESTINO}"/>
		<div id="comerciosDivDestino" class="th1">{_DESTINATARIO}: {DESTINO}</div>
		<div id="comerciosDivOfreces">
			<p class="th2">{_OFRECES}</p>
			<p>
				<label for="primarioOfreces">{PRIMARIO}</label>
				<input type="text" name="primarioOfreces" value="0" class="validate['required','digit[0,-1]'] txtCantidad"/>
			</p>
			<p>
				<label for="secundarioOfreces">{SECUNDARIO}</label>
				<input type="text" name="secundarioOfreces" value="0" class="validate['required','digit[0,-1]'] txtCantidad"/>
			</p>
		</div>
		<div id="comerciosDivPides">
			<p class="th2">{_PIDES}</p>
			<p>
				<label for="primarioPides">{PRIMARIO}</label>
				<input type="text" name="primarioPides" value="0" class="validate['required','digit[0,-1]'] txtCantidad"/>
			</p>
			<p>
				<label for="secundarioPides">{SECUNDARIO}</label>
				<input type="text" name="secundarioPides" value="0" class="validate['required','digit[0,-1]'] txtCantidad"/>
			</p>
		</div>
		<div id="comerciosDivEnviar"><input type="submit" value="{_ENVIARCOMERCIO}"/></div>
	</form>
</div>