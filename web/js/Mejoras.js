//Cargamos las pestanas
var pestanas = new MorphTabs('pestanas',{
			width:'603px',
			height:'auto',
			useAjax: true,
			ajaxUrl: '?controlador=Mejoras&accion=mejorasLista&idGrupo='
});

//Cargamos el js de la primera pestana
include_once('/js/Mejoras/mejoras.js','jspestana');