//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Validador del buscador
var validador = new FormCheck('galaxiasFrmBuscador',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	ajaxResponseDiv: 'galaxiaDivBusqueda',
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//Incluimos el archivo js del modulo
		//con include_once para que se ejecute con ASSET
		include_once('/js/Galaxias/buscar.js','jsbusqueda');
		
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