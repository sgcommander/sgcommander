<div>
	<form action="./index.php" name="opcionesFrmDatos" id="opcionesFrmDatos" method="post">
	<input type="hidden" name="controlador" value="Opciones" />
	<input type="hidden" name="accion" value="cambiarDatos" />
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_TUSDATOS}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><span class="txtNegrita">{_USUARIO}:</span></td>
				<td>{USUARIO}</td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_CONTRASENA}:</span></td>
				<td><input type="password" id="opcionesTxtPass" name="pass" class="validate['length[5,25]'] text-input"/></td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_REPETIRCONTRASENA}:</span></td>
				<td><input type="password" id="opcionesTxtPass2" name="pass2" class="validate['confirm[pass]'] text-input"/></td>
			</tr>
			<tr>
				<td><span class="txtNegrita">{_EMAIL}:</span></td>
				<td><input type="text" value="{EMAIL}" id="opcionesTxtEmail" name="email" class="validate['required'] text-input"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="opcionesDivDatosMensaje" class="mensaje"></div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" id="opcionesBtnDatos" class="submit validate['submit']" value="{_CAMBIARDATOS}" /></td>
			</tr>
		</tbody>
	</table>
	</form>
</div>
<div>
	<form action="./index.php" name="opcionesFrmIdioma" id="opcionesFrmIdioma" method="post">
	<input type="hidden" name="controlador" value="Opciones" />
	<input type="hidden" name="accion" value="cambiarIdioma" />
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="2">{_IDIOMA}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><span class="txtNegrita">{_IDIOMAACTUAL}:</span></td>
				<td>
					<select id="opcionesSelIdioma" name="idioma" class="text-input">
						<!-- BEGIN tIdioma -->
						<option value="{IDIDIOMA}" style="background-image: url({IMGIDIOMA});" {SELECTED}>{IDIOMA}</option>
						<!-- END tIdioma -->
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" id="opcionesBtnIdioma" class="submit validate['submit']" value="{_CAMBIARIDIOMA}" /></td>
			</tr>
		</tbody>
	</table>
	</form>
</div>
<div>
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th colspan="3">{_OPCIONESCUENTA}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="button" name="opcionesBtnProteccionIP" id="opcionesBtnProteccionIP" value="{_PROTECCIONIP}" />
					<input type="hidden" id="opcionesLblConfProteccionIP" value="{_CONFPROTECCIONIP}" />
				</td>
				<td>
					<input type="button" name="opcionesBtnVacaciones" id="opcionesBtnVacaciones" value="{_MODOVACIONES}" />
					<input type="hidden" id="opcionesLblConfirmacionVacaciones" value="{_CONFMODOVACACIONES}" />
				</td>
				<td>
					<input type="button" name="opcionesBtnBorrar" id="opcionesBtnBorrar" value="{_BORRARCUENTA}" />
					<input type="hidden" id="opcionesLblConfirmacionBorrar" value="{_CONFBORRAR}" />
					<input type="hidden" id="opcionesLblConfirmacionBorrar2" value="{_CONFBORRAR2}" />
				</td>
			</tr>
		</tbody>
	</table>
</div>