//Boton que cierra el modulo de comercios
if($defined($('comerciosBtnCerrar'))){
	$('comerciosBtnCerrar').addEvent('click', function(e) {
		$('comerciosDivComercios').tween('display', 'none');
		comerciosVisible=false;
		e.stop();
	});
}

//Validador de enviar mensaje
var validador = new FormCheck('comerciosFrmEnviar',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//Ocultamos el formulario
		$('comerciosDivComercios').tween('display', 'none');
		comerciosVisible=false;
		
		//Metemos el html
		//mensaje('mensajesDivInfo',response)
		Alerta.info(response);
		
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

//Hacer dragable los comercios
$('comerciosDivComercios').makeDraggable({'handle' : $('comerciosDivCabecera'), 'container' : $('web')});