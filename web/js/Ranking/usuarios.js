//Limpiamos los modulos cargados anteriormente
garbage.clean();

/************************************************************
	Select de tipos de puntuacion
************************************************************/
if($defined($('rankingSelPuntos'))){
	$('rankingSelPuntos').addEvent('change', function(e) {
		//Recargamos el ranking
		cargarSeccion('?controlador=Ranking&accion=usuarios&tipoPuntuacion='+$('rankingSelPuntos').getSelected()[0].value,$('morphPanelWrap').getFirst('div'),'jspestana','Ranking','usuarios');
		e.stop();
	});
}

/************************************************************
	Enlaces de paginacion
************************************************************/
$$('.paginar a').each(function(el){
	el.addEvent('click', function(e) {
		cargarSeccion(el.get('href'),$('morphPanelWrap').getFirst('div'),'jspestana','Ranking','usuarios');
		e.stop();
	});
});

/************************************************************
	Tooltips
************************************************************/
garbage.regInstance(
	new Tips('.tooltipDescripcion',{
		showDelay: 0,
		hideDelay: 0,
		className: 'tip-descripcion tip-container',
		fixed:false,
		offsets: {'x': 5, 'y': 5}
	})
);

$$('.tooltipDescripcion').store('tip:text', '');	//Limpiamos la URL del tip

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