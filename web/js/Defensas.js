//Cargamos las pestanas
var pestanas = new MorphTabs('pestanas',{
			width:'603px',
			height:'auto',
			useAjax: true,
			ajaxUrl: '?controlador=Defensas&accion='
});

//Cargamos el js de la primera pestana
include_once('/js/Unidades/disponibles.js','jspestana');