//Limpiamos los modulos cargados anteriormente
garbage.clean();

/************************************************************
	Enlaces de paginacion
************************************************************/
$$('.paginar a').each(function(el){
	el.addEvent('click', function(e) {
		cargarSeccion(el.get('href'),$('morphPanelWrap').getFirst('div'),'jspestana','Alianza','otraMiembros');
		e.stop();
	});
});

/************************************************************
	Tooltips
************************************************************/
garbage.regInstance(
	new Tips('.tooltip',{
		showDelay: 0,
		hideDelay: 0,
		className: 'tip-container',
		fixed:false,
		offsets: {'x': 5, 'y': 5}
	})
);

$$('.tooltip').store('tip:text', '');	//Limpiamos la URL del tip