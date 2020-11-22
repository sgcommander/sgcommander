<div>
	<table class="tablaCentral" cellpadding="0" cellspacing="0">
		<thead>
			<tr class="th1">
				<th>{_ACCIONMENSAJE}</th>
			</tr>
		</thead>
		<tbody>
			<tr class="th1">
				<td>
					<form action="./index.php" id="mensajesFrmEnviar" class="formular" method="post">
						<input type="hidden" name="controlador" value="Mensajes" />
						<input type="hidden" name="accion" value="enviar" />
						<fieldset> 				
					    	<label><span>{_DESTINATARIOS} : </span> <input type="text" name="destinatarios" class="validate['required','length[4,-1]'] text-input" value="{DESTINATARIOS}" /></label>
					    	<label><span>{_ASUNTO} : </span> <input type="text" name="asunto" class="validate['required','length[1,255]'] text-input" value="{ASUNTO}" /></label>
					    	<label><span>{_CONTENIDO} : </span> <textarea name="contenido" cols="15" rows="5" class="validate['required','length[1,-1]'] text-input" >{CONTENIDO}</textarea></label> 			
					    </fieldset>
					    <div id="mensajesDivInfo"></div>
					    <input type="submit" class="submit validate['submit']" value="{_ENVIAR}" id="mensajesBtnEnviar" />
					</form>
				</td>
			</tr>
		</tbody>
	</table>			
</div>