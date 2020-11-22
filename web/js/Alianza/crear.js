//Validador de enviar datos
var validador = new FormCheck('alianzaFrmDatos',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//Metemos el html en la alerta
		Alerta.info(response);
		
		//Ocultamos el mensaje de carga
		$('preloader').setStyle('display','none');	
		
		//Recargamos el modulo
		cargarSeccion('?controlador=Alianza&accion=alianza', $('indexDivCentro'), 'jsmodulo','','Alianza');
	},
	display : {
		errorsLocation : 0,
		indicateErrors : 2,
		showErrors : 1,
		addClassErrorToField : 1,
		scrollToFirst: false
	}
});