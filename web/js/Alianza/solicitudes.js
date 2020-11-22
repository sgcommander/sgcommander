//Limpiamos los modulos cargados anteriormente
garbage.clean();

//A�adimos la nota del planeta
garbage.regInstance(
	new Tips('.tooltip',{
	    showDelay: 0,
	    hideDelay: 0,
	    className: 'tip-container',
	    fixed:false,
	    offsets: {'x': 5, 'y': 5}
	})
);

$$('.tooltip').store('tip:text', '');	//Limpiamos la URL del tip

//Array de botones de aceptar
$$('.btnAceptar').each(function(item, index){
	item.removeEvents();
    item.addEvent('click', function(e) {
    	var idJugador=item.getParent().getParent().getFirst('.idUsuario').value;
    	//Creamos la peticion
		var req = new Request({
			url: '?controlador=Alianza&accion=aceptarSolicitud&idJugador='+idJugador,
			method: 'post',
			evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html en la alerta
				Alerta.info(html);
				
				//Recargamos la seccion
				cargarSeccion('?controlador=Alianza&accion=solicitudes', $('morphPanelWrap').getFirst('div'), 'jspestana','Alianza','solicitudes');
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

//Array de botones de denegar
$$('.btnDenegar').each(function(item, index){
	item.removeEvents();
    item.addEvent('click', function(e) {
    	var idJugador=item.getParent().getParent().getFirst('.idUsuario').value;
    	//Creamos la peticion
		var req = new Request({
			url: '?controlador=Alianza&accion=rechazarSolicitud&idJugador='+idJugador,
			method: 'post',
			evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html en la alerta
				Alerta.info(html);
				
				//Recargamos la seccion
				cargarSeccion('?controlador=Alianza&accion=solicitudes', $('morphPanelWrap').getFirst('div'), 'jspestana','Alianza','solicitudes');
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