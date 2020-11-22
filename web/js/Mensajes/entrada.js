SqueezeBox.initialize();

/************************************************************
	Organizamos los botones
************************************************************/
$('mensajesBtnEscribir').disabled=0;
$('mensajesBtnBorrarMarcados').disabled=0;
$('mensajesBtnBorrarTodos').disabled=0;
$('mensajesBtnEntrada').disabled=1;

$('mensajesBtnEscribir').removeClass('disabled');
$('mensajesBtnBorrarMarcados').removeClass('disabled');
$('mensajesBtnBorrarTodos').removeClass('disabled');
$('mensajesBtnEntrada').addClass('disabled');

/************************************************************
	Boton de marcar todos
************************************************************/
if($defined($('mensajesChkTodos'))){
	$('mensajesChkTodos').addEvent('click', function(e) {
		var c=$('mensajesChkTodos').checked;
		$$('.marcarMsg').each(function(el){
			el.checked=c;
		});
	});
}

/************************************************************
	Enlaces de paginacion
************************************************************/
$$('.paginarMensajes a').each(function(el){
	el.addEvent('click', function(e) {
		cargarSeccion(el.get('href'), $('mensajesDivContenido'), 'jsmensajescont','Mensajes','entrada');
		e.stop();
	});
});

/************************************************************
	Enlaces de mensajes normales
************************************************************/
$$('.ancMensaje').each(function(el){
	el.addEvent('click', function(e) {
		cargarSeccion(el.get('href'), $('mensajesDivContenido'), 'jsmensajescont','Mensajes','mensaje');
		e.stop();
	});
});

/************************************************************
	Enlaces de reportes
************************************************************/
$$('.ancReporte').each(function(el){
	el.addEvent('click', function(e) {
		e.stop();
		SqueezeBox.open(el.get('href'), {
			size: {x: 735, y: 450},
			sizeLoading: {x: 735, y: 450},
			onAjax: function(){
				cargarSeccion('?controlador=Mensajes&accion=entrada', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
			}
		});
	});
});

/************************************************************
	Enlaces de reportes de batalla
************************************************************/
$$('.ancBatalla').each(function(el){
	el.addEvent('click', function(e) {
		e.stop();
		SqueezeBox.open(el.get('href'), {
			size: {x: 735, y: 450},
			sizeLoading: {x: 735, y: 450},
			onAjax: function(){
				include_once('/js/Mensajes/batalla.js','jsreporte');
				cargarSeccion('?controlador=Mensajes&accion=entrada', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
			}
		});
	});
});