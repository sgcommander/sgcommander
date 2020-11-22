<div>
	<input type="hidden" id="mensajesLblIdMensaje" value="{MSGID}" />
	<input type="hidden" id="mensajesLblAsunto" value="{MSGASUNTO}" />
	<input type="hidden" id="mensajesLblEmisor" value="{MSGEMISOR}" />
	<input type="hidden" id="mensajesLblConfirmacionBorrar" value="{_CONFBORRARMSG}" />
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th>{MSGASUNTO} {_ENVIADOPOR} {MSGEMISOR} {_ELDIA} {MSGFECHA} {_ALAS} {MSGHORA}</th>
			</tr>
		</thead>
	</table>
	<div id="mensajesDivTexto"><textarea readonly="readonly" cols="70" rows="15">{MSGCONTENIDO}</textarea></div>
	<div id="mensajesDivMenu">
		<input type="button" id="mensajesBtnBorrar" value="{_BORRAR}" />
		<input type="button" id="mensajesBtnReenviar" value="{_REENVIAR}" />
		<input type="button" id="mensajesBtnResponder" value="{_RESPONDER}" />
	</div>	
</div>