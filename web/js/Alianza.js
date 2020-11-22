var recargar=false;
var controlador='Alianza';
var accion='alianza';

//Cargamos las pestanas
var pestanas = new MorphTabs('pestanas',{
			width:'603px',
			height:'auto',
			useAjax: true,
			ajaxUrl: '?controlador='+controlador+'&accion='
});

//Cargamos el js de la primera pestana
if($defined($('buscador')))
	include_once('/js/Alianza/buscador.js','jspestana');
	
