//Cargamos las pestanas
var pestanas = new MorphTabs('pestanas',{
			width:'603px',
			height:'auto',
			useAjax: true,
			ajaxUrl: '?controlador=Ranking&accion='
});

//Cargamos el js de la primera pestana
include_once('/js/Ranking/usuarios.js','jspestana');