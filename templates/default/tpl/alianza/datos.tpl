<div>
	<form action="./index.php" name="alianzaFrmDatos" id="alianzaFrmDatos" method="post">
	<input type="hidden" name="controlador" value="{CONTROLADOR}" />
	<input type="hidden" name="accion" value="{ACCION}" />
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_DATOS}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><span class="txtNegrita">{_TITULO}:</span></td>
				<td><input type="text" id="alianzaTxtTitulo" name="titulo" value="{TITULO}" class="validate['required','length[1,25]'] text-input"/></td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_IMAGEN} ({_OPCIONAL}):</span></td>
				<td><input type="text" id="alianzaTxtImagen" name="imagen" value="{IMAGEN}" class="validate['length[1,255]'] text-input"/></td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_FORO} ({_OPCIONAL}):</span></td>
				<td><input type="text" id="alianzaTxtForo" name="foro" value="{FORO}" class="validate['length[1,255]'] text-input"/></td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_TEXTO}:</span></td>
				<td><textarea id="alianzaTxtTexto" name="texto" class="validate['required'] text-input">{TEXTO}</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" id="alianzaBtnCrear" class="submit validate['submit']" value="{_ENVIAR}" /></td>
			</tr>
		</tbody>
	</table>
	</form>
</div>
<!-- BEGIN tOpciones -->
<div>
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_OPCIONESALIANZA}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="button" name="alianzaBtnBorrar" id="alianzaBtnBorrar" value="{_BORRARALIANZA}" />
					<input type="hidden" id="alianzaLblConfirmacionBorrar" value="{_CONFBORRAR}" />
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- END tOpciones -->