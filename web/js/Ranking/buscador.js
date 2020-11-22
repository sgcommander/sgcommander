//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Validador del buscador
var validador = new FormCheck('rankingFrmBuscador',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	ajaxResponseDiv: 'rankingDivBusqueda',
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//Incluimos el archivo js del modulo
		//con include_once para que se ejecute con ASSET
		include_once('/js/Ranking/buscar.js','jsbusqueda');
		
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