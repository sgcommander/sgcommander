//Limpiamos los modulos cargados anteriormente
garbage.clean();

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

/************************************************************
	Iconos de acciones
************************************************************/
$$('.planetaGalaxia').addEvents({
        mouseenter: function(){
            this.getFirst('.planetaAcciones').morph({'display':'block'});
		},
        mouseleave: function(){
			this.getFirst('.planetaAcciones').morph({'display':'none'});
        }
});

//Anadimos los tips de los atributos
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

//Array de botones de enviar naves
$$('.btnNaves').each(function(item, index){
	item.addEvent('click', function(e) {
		var misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		var misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		cargarSeccion('?controlador=Naves&accion=naves&idPlanetaDestino='+misionesIdPlanetaDestino+'&idGalaxiaDestino='+misionesIdGalaxiaDestino, $('indexDivCentro'), 'jsmodulo','','');
			
		e.stop();
	});
});

//Array de botones de enviar soldados
$$('.btnTropas').each(function(item, index){
	item.addEvent('click', function(e) {
		var misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		var misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		cargarSeccion('?controlador=Soldados&accion=soldados&idPlanetaDestino='+misionesIdPlanetaDestino+'&idGalaxiaDestino='+misionesIdGalaxiaDestino, $('indexDivCentro'), 'jsmodulo','','');
			
		e.stop();
	});
});

//Array de botones de enviar exploracion
$$('.btnExplorar').each(function(item, index){
	item.addEvent('click', function(e) {
		var misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		var misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		var misionesIdExplorador=$('idExplorador').value;
		var req = new Request({
			url: '?controlador=Soldados&accion=mision&galaxiaDestino='+misionesIdGalaxiaDestino+'&planetaDestino='+misionesIdPlanetaDestino+'&idUnidad[]='+misionesIdExplorador+'&cantidad[]=1&velocidad=100&tipoMision=4',
			onComplete: function(html){
				//Ocultamos los botones
				$$('.btnExplorar').each(function(item2, index2){
					item2.fade('hide');
				});
				
				//Recargamos el cuadrante
				cargarSeccion('?controlador=Galaxias&accion=cuadrante&idGalaxiaExplorado='+misionesIdGalaxiaDestino+'&idPlanetaExplorado='+misionesIdPlanetaDestino, $('galaxiasDivCuadrante'), 'jscuadrante','Galaxias','cuadrante');
			}
		});
		req.send();
		e.stop();
	});
});

//Array de botones de enviar defensas
$$('.btnDefensas').each(function(item, index){
	item.addEvent('click', function(e) {
		var misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		var misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		cargarSeccion('?controlador=Defensas&accion=defensas&idPlanetaDestino='+misionesIdPlanetaDestino+'&idGalaxiaDestino='+misionesIdGalaxiaDestino, $('indexDivCentro'), 'jsmodulo','','');
			
		e.stop();
	});
});


$$('.btnAnadir').each(function(item, index){
	item.addEvent('click', function(e) {
		misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		cargarSeccion('?controlador=Galaxias&accion=anadir&idGalaxia='+misionesIdGalaxiaDestino+'&idPlaneta='+misionesIdPlanetaDestino, $('galaxiasDivCuadrante'), 'jscuadrante','Galaxias','cuadrante');
	});
});

$$('.btnEliminar').each(function(item, index){
	item.addEvent('click', function(e) {
		misionesIdGalaxiaDestino=item.getParent().getFirst('.idGalaxia').value;
		misionesIdPlanetaDestino=item.getParent().getFirst('.idPlaneta').value;
		cargarSeccion('?controlador=Galaxias&accion=eliminar&idGalaxia='+misionesIdGalaxiaDestino+'&idPlaneta='+misionesIdPlanetaDestino, $('galaxiasDivCuadrante'), 'jscuadrante','Galaxias','cuadrante');
	});
});
