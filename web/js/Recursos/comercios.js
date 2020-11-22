//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Array de botones de cancelar
$$('.btnCancelar').each(function(item, index){
	item.addEvent('click', function(e) {
		//Creamos la peticion de intercambio
		var req = new Request({
			url: '?controlador=Recursos&accion=cancelarComercio&idComercio='+item.getParent().getParent().getFirst('.idComercio').get('value'),
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html en la alerta
				Alerta.info(html);
				
				//Recargamos el modulo
				cargarSeccion('?controlador=Recursos&accion=comercios', $('morphPanelWrap').getFirst('div'), 'jspestana','Recursos','comercios');
			},
			onFailure: function(){
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display', 'none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
});

//Array de botones de rechazar
$$('.btnRechazar').each(function(item, index){
	item.addEvent('click', function(e) {
		//Creamos la peticion de intercambio
		var req = new Request({
			url: '?controlador=Recursos&accion=rechazarComercio&idComercio='+item.getParent().getParent().getFirst('.idComercio').get('value'),
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html en la alerta
				Alerta.info(html);
				
				//Recargamos el modulo
				cargarSeccion('?controlador=Recursos&accion=comercios', $('morphPanelWrap').getFirst('div'), 'jspestana','Recursos','comercios');
			},
			onFailure: function(){
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display', 'none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
});

//Array de botones de aceptar
$$('.btnAceptar').each(function(item, index){
	item.addEvent('click', function(e) {
		//Creamos la peticion de intercambio
		var req = new Request({
			url: '?controlador=Recursos&accion=aceptarComercio&idComercio='+item.getParent().getParent().getFirst('.idComercio').get('value'),
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html en la alerta
				Alerta.info(html);
				
				//Recargamos el modulo
				cargarSeccion('?controlador=Recursos&accion=comercios', $('morphPanelWrap').getFirst('div'), 'jspestana','Recursos','comercios');
			},
			onFailure: function(){
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display', 'none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
});