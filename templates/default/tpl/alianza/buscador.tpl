	<div>
		<form action="./index.php" id="alianzaFrmBuscador" class="formular" method="post">
			<input type="hidden" name="controlador" value="Alianza" />
			<input type="hidden" name="accion" value="buscar" />
			<input type="text" name="buscado" class="validate['required','length[1,-1]'] text-input" id="alianzaTxtBuscado" />
			<select name="busqueda" id="alianzaSelBusqueda">
				<option value="1" selected="selected">{_NOMBRE}</option>
				<option value="2">{_LIDER}</option>
			</select>
			<input type="submit" class="validate['submit']" value="{_BUSCAR}" />
		</form>
	</div>
	<div id="alianzaDivBusqueda">
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<tbody>
				<tr class="th1">
					<td class="celdaIcono"><img src="/images/iconos/{IDRAZA}/lupa.png" alt="{_MENSAJEBUSCAR}" /></td>
					<td>{_MENSAJEBUSCAR}</td>
				</tr>
			</tbody>
		</table>
	</div>