//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Seleccion de logotipo
if($defined($('opcionesSelLogotipo'))){
	$('opcionesSelLogotipo').addEvent('change', function(e) {
		var datos=$('opcionesSelLogotipo').getSelected()[0].get('value').split('|',2);
		$('opcionesImgLogotipo').src=datos[1];
	});
}

//Button de cambiar logotipo
$('opcionesBtnLogotipo').addEvent('click', function(e) {
	var datos=$('opcionesSelLogotipo').getSelected()[0].get('value').split('|',2);
	//Creamos la peticion 
	var req = new Request.HTML({
		url: '?controlador=Opciones&accion=cambiarLogotipo&idLogotipo='+datos[0],
		onSuccess: function(html,texto) {
			mensaje('opcionesDivLogotipoMensaje',html);
			if(texto.getProperty('class') != 'error') {
				//Cambiamos el logo
				$('indexImgLogotipo').src=datos[1];
			}
		}
	});
	//Enviamos la peticion
	req.send();
});

//Seleccion de firma
if($defined($('opcionesSelFirma'))){
	$('opcionesSelFirma').addEvent('change', function(e) {
		var datos=$('opcionesSelFirma').getSelected()[0].get('value').split('|',2);
		$('opcionesImgFirma').src=datos[1];
	});
}

//Button de cambiar firma
$('opcionesBtnFirma').addEvent('click', function(e) {
	var datos=$('opcionesSelFirma').getSelected()[0].get('value').split('|',2);
	//Creamos la peticion 
	var req = new Request.HTML({
		url: '?controlador=Opciones&accion=cambiarFirma&idFirma='+datos[0],
		onSuccess: function(html,texto) {
			mensaje('opcionesDivFirmaMensaje',html);
		}
	});
	//Enviamos la peticion
	req.send();
});

//Text de firma
$$('.txtFirma').each(function(el){
	el.addEvent('click', function(e) {
		el.focus();
		el.select();
	})
});

