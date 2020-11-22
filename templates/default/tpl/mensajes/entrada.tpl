	<div>
		<input type="hidden" id="mensajesLblConfirmacionBorrar" value="{_CONFBORRARMSG}" />
		<table class="tablaCentral" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="th1">
					<th><input type="checkbox" id="mensajesChkTodos"/></th>
					<th colspan="2">{_ASUNTO}</th>
					<th>{_ENVIADOPOR}</th>
					<th>{_FECHA}</th>
					<th>{_HORA}</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN tNoMensajes -->
				<tr class="th1">
					<td colspan="6">
						<div class="lblNoHay">{_NOMENSAJES}</div>
					</td>
				</tr>
				<!-- END tNoMensajes -->
				<!-- BEGIN tMensajes -->
				<tr>
					<td colspan="6" class="th2">
					<!-- BEGIN tPagMsg -->
						<span class="paginarMensajes <!-- BEGIN tPagActual -->pagActual<!-- END tPagActual -->">
							<a href="index.php?controlador=Mensajes&amp;accion=entrada&amp;inicio={INICIO}">{PAG}</a>
						</span>
					<!-- END tPagMsg -->
					</td>
				</tr>
				<!-- BEGIN tMensaje -->	
				<tr>
					<td>
						<input type="checkbox" class="marcarMsg" value="{MSGIDBORRAR}" />
					</td>
					<td>
						<!-- BEGIN tLeido -->
						<img src="/images/iconos/mensajes/{MSGTIPO}leido.png" alt="{_LEIDO}" width="23" height="20" />
						<!-- END tLeido -->
						<!-- BEGIN tNoLeido -->
						<img src="/images/iconos/mensajes/{MSGTIPO}noleido.png" alt="{_NOLEIDO}" width="23" height="20" />
						<!-- END tNoLeido -->
					</td>
					<td>
						<!-- BEGIN tNormal -->	
						<a class="ancMensaje" href="index.php?controlador=Mensajes&amp;accion=mensaje&amp;idMensaje={MSGID}">{MSGASUNTO}</a>
						<!-- END tNormal -->
						<!-- BEGIN tReporte -->	
						<a class="ancReporte" rel="boxed" href="index.php?controlador=Mensajes&amp;accion=reporte&amp;idMensaje={MSGID}">{MSGASUNTO}</a>
						<!-- END tReporte -->
						<!-- BEGIN tBatalla -->	
						<a class="ancBatalla" href="index.php?controlador=Mensajes&amp;accion=batalla&amp;idMensaje={MSGID}">{MSGASUNTO}</a>
						<!-- END tBatalla -->
					</td>
					<td>{MSGEMISOR}</td>
					<td>{MSGFECHA}</td>
					<td>{MSGHORA}</td>
				</tr>
				<!-- END tMensaje -->	
				<!-- END tMensajes -->
			</tbody>
		</table> 			
 	</div>