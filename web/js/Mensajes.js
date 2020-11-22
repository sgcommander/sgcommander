switch(mensajesSeccion){
	case 'escribir':
		var url='?controlador=Mensajes&accion=escribir'
		//Comprobamos si hay un destino
		if(mensajesDestino!=''){
			url=url+'&destino='+mensajesDestino;
			mensajesDestino='';
		}
		//Cargamos el formulario de escribir
		cargarSeccion(url, $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'escribir');
		$('mensajesBtnEscribir').disabled=1;
		$('mensajesBtnBorrarMarcados').disabled=1;
		$('mensajesBtnBorrarTodos').disabled=1;
		$('mensajesBtnEntrada').disabled=0;

		$('mensajesBtnEscribir').addClass('disabled');
		$('mensajesBtnBorrarMarcados').addClass('disabled');
		$('mensajesBtnBorrarTodos').addClass('disabled');
		$('mensajesBtnEntrada').removeClass('disabled');
		break;
	default:
		//Cargamos la bandeja de entrada
		cargarSeccion('?controlador=Mensajes&accion=entrada', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
		$('mensajesBtnEscribir').disabled=0;
		$('mensajesBtnBorrarMarcados').disabled=0;
		$('mensajesBtnBorrarTodos').disabled=0;
		$('mensajesBtnEntrada').disabled=1;

		$('mensajesBtnEscribir').removeClass('disabled');
		$('mensajesBtnBorrarMarcados').removeClass('disabled');
		$('mensajesBtnBorrarTodos').removeClass('disabled');
		$('mensajesBtnEntrada').addClass('disabled');
		
		//Ocultamos el aviso de mensajes nuevos
		$('mensajesDivAviso').tween('display','none');
		break;
}
//Volvemos a colocar la entrada como priemra opcion
mensajesSeccion='entrada'

//Boton que cierra el modulo de mensajes
if($defined($('mensajesBtnCerrar'))){
	$('mensajesBtnCerrar').addEvent('click', function(e) {
		$('mensajesDivMensajes').tween('display', 'none');
		mensajesVisible=false;
		mensajesSeccion='entrada';
		e.stop();
	});
}

//Boton que muestra la entrada
$('mensajesBtnEntrada').addEvent('click', function(e) {
	mensajesSeccion='entrada';
	cargarSeccion('?controlador=Mensajes&accion=entrada', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
	
	//Ocultamos el aviso de mensajes nuevos
	$('mensajesDivAviso').tween('display','none');
});

//Boton que muestra el formulario de escribir
$('mensajesBtnEscribir').addEvent('click', function(e) {
	mensajesSeccion='escribir';
	cargarSeccion('?controlador=Mensajes&accion=escribir', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'escribir');
});

//Boton que borra los mensajes marcados
if($defined($('mensajesBtnBorrarMarcados'))){
	$('mensajesBtnBorrarMarcados').addEvent('click', function(e) {
    	var url='?controlador=Mensajes&accion=borrar';
    	$$('.marcarMsg').each(function(el){
    		if(el.checked)
    			url=url+'&idMensaje[]='+el.get('value');
    	});
    	cargarSeccion(url, $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
	});
}

//Boton que borra todos los mensajes
if($defined($('mensajesBtnBorrarTodos'))){
	$('mensajesBtnBorrarTodos').addEvent('click', function(e) {
		Alerta.confirm($('mensajesLblConfirmacionBorrar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	cargarSeccion('?controlador=Mensajes&accion=borrarTodos', $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
		            } 
				}
		});
	});
}

//Hacer dragable los mensajes
$('mensajesDivMensajes').makeDraggable({'handle' : $('mensajesDivCabecera'), 'container' : $('web')});