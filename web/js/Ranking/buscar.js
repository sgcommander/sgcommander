//Limpiamos los modulos cargados anteriormente
garbage.clean('rankingBuscador');

//A�adimos el tooltip
garbage.regInstance(
	new Tips('.tooltip',{
	    showDelay: 0,
	    hideDelay: 0,
	    className: 'tip-container',
	    fixed:false,
	    offsets: {'x': 5, 'y': 5}
	}),
	'rankingBuscador'
);

$$('.tooltip').store('tip:text', '');	//Limpiamos la URL del tip

/************************************************************
Enlaces de enviar mensaje
************************************************************/
$$('.enlaceEnviarMensaje').each(function(el){
el.addEvent('click', function(e) {
	//Especificamos la seccion de mensajes
	mensajesSeccion='escribir';
	mensajesDestino=el.getParent().getFirst('.usuario').value;
	//Cargamos la ventana de mensajes
	cargarSeccion(el.get('href'), $('mensajesDivMensajes'), 'jsmensajes','','Mensajes');
	//Para los mensajes mostramos el div
	$('mensajesDivMensajes').tween('display', 'block');
	e.stop();
});
});

/************************************************************
Enlaces de enviar comercios
************************************************************/
$$('.enlaceEnviarComercio').each(function(el){
el.addEvent('click', function(e) {
	//Si estan ocultos los recargamos si no los ocultamos
	if (!mensajesVisible) {
		//Creamos la peticion
		var req = new Request.HTML({
			url: el.get('href')+'&destino='+el.getParent().getFirst('.usuario').value+'&idDestino='+el.getParent().getFirst('.idUsuario').value,
			method: 'post',
			evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Limpiamos el div
				$('comerciosDivComercios').empty();
				
				//Metemos el html
				$('comerciosDivComercios').adopt(html);
				include_once('/js/Comercios.js', 'jscomercios');
				
				//Mostramos los mensajes
				$('comerciosDivComercios').tween('display', 'block');
				comerciosVisible=true;
			},
			onFailure: function(){
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display', 'none');
			}
		});
		//Enviamos la peticion
		req.send();
	}
	else{
		//Ocultamos los mensajes
		$('comerciosDivComercios').tween('display', 'none');
		comerciosVisible=false;
	}
	e.stop();
});
});