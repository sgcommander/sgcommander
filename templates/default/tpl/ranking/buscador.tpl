	<div>
		<form action="./index.php" id="rankingFrmBuscador" class="formular" method="post">
			<input type="hidden" name="controlador" value="Ranking" />
			<input type="hidden" name="accion" value="buscar" />
			<input type="text" name="buscado" class="validate['required','length[1,-1]'] text-input" id="rankingTxtBuscado" />
			<input type="submit" class="validate['submit']" value="{_BUSCAR}" />
		</form>
	</div>
	<div class="parrafo">
		<div class="iconosUsuario">
			<span><img src="/images/iconos/{IDRAZA}/debil.png" class="tooltipDescripcion icono" alt="{_DEBIL}" width="18px" height="18px" title="{_DEBILDESC}" /> {_DEBIL}</span>
			<span><img src="/images/iconos/{IDRAZA}/inactivo.png" class="tooltipDescripcion icono" alt="{_INACTIVO}" width="18px" height="18px" title="{_INACTIVODESC}" /> {_INACTIVO}</span>
			<span><img src="/images/iconos/{IDRAZA}/vacaciones.png" class="tooltipDescripcion icono" alt="{_VACACIONES}" width="18px" height="18px" title="{_VACACIONESDESC}" /> {_VACACIONES}</span>
		</div>
	</div>
	<div id="rankingDivBusqueda">
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<tbody>
				<tr class="th1">
					<td class="celdaIcono"><img src="/images/iconos/{IDRAZA}/lupa.png" alt="{_MENSAJEBUSCAR}" /></td>
					<td>{_MENSAJEBUSCAR}</td>
				</tr>
			</tbody>
		</table>
	</div>