//Limpiamos los modulos cargados anteriormente
garbage.clean('galaxiaBuscador');

//Anadimos la nota del planeta
garbage.regInstance(
	new Tips('.tooltip',{
	    showDelay: 0,
	    hideDelay: 0,
	    className: 'tip-container',
	    fixed:false,
	    offsets: {'x': 5, 'y': 5}
	}),
	'galaxiaBuscador'
);

$$('.tooltip').store('tip:text', '');	//Limpiamos la URL del tip

//Array de botones de eliminar
$$('.btnEliminar').each(function(item, index){
	item.removeEvents();
    item.addEvent('click', function(e) {
    	var req = new Request({
			url: '?controlador=Planetas&accion=eliminar&idGalaxia='+item.getParent().getNext('.idGalaxia').get('value')+'&idPlaneta='+item.getParent().getNext('.idPlaneta').get('value')+'&accionRecargar=planetasNeutrales',
			onComplete: function(html){
    			validador.submitByAjax();
			}
		}).send();
    });
});

//Array de botones de anadir
$$('.btnAnadir').each(function(item, index){
	item.removeEvents();
    item.addEvent('click', function(e) {
    	var req = new Request({
			url: '?controlador=Planetas&accion=anadir&idGalaxia='+item.getParent().getNext('.idGalaxia').get('value')+'&idPlaneta='+item.getParent().getNext('.idPlaneta').get('value')+'&accionRecargar=planetasNeutrales',
			onComplete: function(html){
    			validador.submitByAjax();
			}
		}).send();
    });
});

//Array de botones de Ver planeta
$$('.btnVerPlaneta').each(function(item, index){
	item.addEvent('click', function(e) {
		galaxiasGalaxiaSel=item.getParent().getParent().getFirst('.idGalaxia').value;
		galaxiasSectorSel=item.getParent().getParent().getFirst('.idSector').value;
		galaxiasCuadranteSel=item.getParent().getParent().getFirst('.idCuadrante').value;
	
		cargarSeccion('?controlador=Galaxias&accion=galaxias&idGalaxia='+galaxiasGalaxiaSel+'&idSector='+galaxiasSectorSel+'&idCuadrante='+galaxiasCuadranteSel, $('indexDivCentro'), 'jsmodulo','','');
			
		e.stop();
	});
});