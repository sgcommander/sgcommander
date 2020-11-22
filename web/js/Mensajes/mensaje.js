/************************************************************
	Organizamos los botones
************************************************************/
$('mensajesBtnEscribir').disabled=0;
$('mensajesBtnBorrarMarcados').disabled=1;
$('mensajesBtnBorrarTodos').disabled=1;
$('mensajesBtnEntrada').disabled=0;

$('mensajesBtnEscribir').removeClass('disabled');
$('mensajesBtnBorrarMarcados').addClass('disabled');
$('mensajesBtnBorrarTodos').addClass('disabled');
$('mensajesBtnEntrada').removeClass('disabled');

//Boton que borra un mensaje
if($defined($('mensajesBtnBorrar'))){
	$('mensajesBtnBorrar').addEvent('click', function(e) {
		Alerta.confirm($('mensajesLblConfirmacionBorrar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	cargarSeccion('?controlador=Mensajes&accion=borrar&idMensaje='+$('mensajesLblIdMensaje').get('value'), $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'entrada');
		            } 
				}
		});
	});
}

//Boton que reenvia un mensaje
if($defined($('mensajesBtnReenviar'))){
	$('mensajesBtnReenviar').addEvent('click', function(e) {
      	cargarSeccion('?controlador=Mensajes&accion=escribir&asunto='+$('mensajesLblAsunto').get('value')+'&idMensaje='+$('mensajesLblIdMensaje').get('value'), $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'escribir');
	});
}

//Boton que responde un mensaje
if($defined($('mensajesBtnResponder'))){
	$('mensajesBtnResponder').addEvent('click', function(e) {
      	cargarSeccion('?controlador=Mensajes&accion=escribir&asunto=RE:'+$('mensajesLblAsunto').get('value')+'&destino='+$('mensajesLblEmisor').get('value'), $('mensajesDivContenido'), 'jsmensajescont', 'Mensajes', 'escribir');
	});
}