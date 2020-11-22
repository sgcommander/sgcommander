/************************************************************
	Organizamos los botones
************************************************************/
$('mensajesBtnEscribir').disabled=1;
$('mensajesBtnBorrarMarcados').disabled=1;
$('mensajesBtnBorrarTodos').disabled=1;
$('mensajesBtnEntrada').disabled=0;

$('mensajesBtnEscribir').addClass('disabled');
$('mensajesBtnBorrarMarcados').addClass('disabled');
$('mensajesBtnBorrarTodos').addClass('disabled');
$('mensajesBtnEntrada').removeClass('disabled');

//Validador de enviar mensaje
var validador = new FormCheck('mensajesFrmEnviar',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
		
		//Desactivamso el boton de enviar al clicar
		$('mensajesBtnEnviar').disabled=1;
		$('mensajesBtnEnviar').addClass('disabled');
	},
	onAjaxSuccess: function(response) {
		//Reseteamos el formulario
		document.getElementById('mensajesFrmEnviar').reset(); 
		//BUG de MooTools ke impide resetear con reset, lo he hecho a la vieja usanza
		//$('mensajesFrmEnviar').reset;
		
		//Reactivamos el botonde mensajes
		$('mensajesBtnEnviar').disabled=0;
		$('mensajesBtnEnviar').removeClass('disabled');
		
		//Metemos el html
		//mensaje('mensajesDivInfo',response)
		Alerta.info(response);
		
		//Incluimos el archivo js del modulo
		//con include_once para que se ejecute con ASSET
		include_once('/js/enviar.js','jsmensajescont');
		
		//Ocultamos el mensaje de carga
		$('preloader').setStyle('display','none');	
	},
	display : {
		errorsLocation : 0,
		indicateErrors : 2,
		showErrors : 1,
		addClassErrorToField : 1,
		scrollToFirst: false
	}
});