	<div>
		<form action="./index.php" id="galaxiasFrmBuscador" class="formular" method="post">
			<input type="hidden" name="controlador" value="Galaxias" />
			<input type="hidden" name="accion" value="buscar" />
			<input type="text" name="buscado" class="validate['required','length[1,-1]'] text-input" id="galaxiasTxtBuscado" />
			<select name="busqueda" id="galaxiaSelBusqueda">
				<option value="1" selected="selected">{_PROPIETARIO}</option>
				<option value="2">{_NOMBREPLANETA}</option>
				<option value="3">{_NOMBREPLANETASGC}</option>
				<option value="4">{_RIQUEZA}</option>
			</select>
			<select name="idGalaxia" id="galaxiasSelGalaxia">
				<option value="0" selected="selected">{_TODASGALAXIAS}</option>
				<!-- BEGIN tGalaxia -->
				<option value="{IDGALAXIA}">{NOMGALAXIA}</option>
				<!-- END tGalaxia -->
			</select>
			<input type="submit" class="validate['submit']" value="{_BUSCAR}" />
		</form>
	</div>
	<div id="galaxiaDivBusqueda">
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<tbody>
				<tr class="th1">
					<td class="celdaIcono"><img src="/images/iconos/{IDRAZA}/lupa.png" alt="{_MENSAJEBUSCAR}" /></td>
					<td>{_MENSAJEBUSCAR}</td>
				</tr>
			</tbody>
		</table>
	</div>