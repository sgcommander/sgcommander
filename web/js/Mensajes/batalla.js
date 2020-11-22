//Limpiamos los modulos cargados anteriormente
garbage.clean('mensajes');

/************************************************************
	Pestanas
************************************************************/
var pestanasBatalla = new MorphTabs('pestanasBatalla',{
			width:'720px',
			height: 'auto',
			useAjax: false,
			central:false
});

/************************************************************
	Tooltips
************************************************************/

garbage.regInstance(
new Tips('.batallaBarra',{
	showDelay: 0,
	hideDelay: 0,
	className: 'tip-container',
	fixed:false,
	offsets: {'x': 5, 'y': 5}
})
,'mensajes');

$$('.batallaBarra').store('tip:text', '');	//Limpiamos la URL del tip