//Limpiamos los modulos cargados anteriormente
garbage.clean();

/************************************************************
	Select de tipos de puntuacion
************************************************************/
if ($defined($('rankingSelPuntos'))) {
	$('rankingSelPuntos').addEvent('change', function(e){
		//Recargamos el ranking
		cargarSeccion('?controlador=Ranking&accion=alianzas&tipoPuntuacion=' + $('rankingSelPuntos').getSelected()[0].value, $('morphPanelWrap').getFirst('div'), 'jspestana', 'Ranking', 'alianzas');
		e.stop();
	});
}

/************************************************************
	Enlaces de paginacion
************************************************************/
$$('.paginar a').each(function(el){
	el.addEvent('click', function(e) {
		cargarSeccion(el.get('href'),$('morphPanelWrap').getFirst('div'),'jspestana','Ranking','alianzas');
		e.stop();
	});
});

/************************************************************
	Tooltips
************************************************************/
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

/************************************************************
	Enlaces de alianza
************************************************************/
$$('.enlaceAlianza').each(function(el){
	el.addEvent('click', function(e) {
		//Cargamos la ventana de mensajes
		cargarSeccion(el.get('href'), $('indexDivCentro'), 'jsmodulo','','');
		e.stop();
	});
});

/************************************************************
	Enlaces de enviar mensaje
************************************************************/
$$('.enlaceEnviarMensaje').each(function(el){
	el.addEvent('click', function(e) {
		//Especificamos la seccion de mensajes
		mensajesSeccion='escribir';
		mensajesDestino=el.getParent().getFirst('.fundador').value;
		//Cargamos la ventana de mensajes
		cargarSeccion(el.get('href'), $('mensajesDivMensajes'), 'jsmensajes','','Mensajes');
		//Para los mensajes mostramos el div
		$('mensajesDivMensajes').tween('display', 'block');
		e.stop();
	});
});

/************************************************************
	Enlaces de enviar solicitud
************************************************************/
$$('.enlaceEnviarSolicitud').each(function(el){
	el.addEvent('click', function(e) {
		var idAlianza=el.getParent().getFirst('.idAlianza').value;
		var mensaje=el.getParent().getFirst('.mensajeSolicitud').value;
		Alerta.prompt(mensaje,'' ,{ onComplete: 
			function(returnvalue) {
		    	if(returnvalue){
		    		//Creamos la peticion
					var req = new Request({
						url: el.get('href')+'&idAlianza='+idAlianza+'&mensaje='+returnvalue,
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
						},
						onFailure: function(){
							//Ocultamos el mensaje de carga
							$('preloader').setStyle('display', 'none');
						}
					});
					//Enviamos la peticion
					req.send();
		    	}
			}
		});
	
		e.stop();
	});
});