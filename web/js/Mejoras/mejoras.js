//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Array de botones de investigar
$$('.btnInvestigar').each(function(item, index){
	item.removeEvents();
	item.addEvent('click', function(e) {
		//Capturamos la posicion X e Y del click
        var x=e.page.x;
        var y=e.page.y;
        var urlxy='&version='+Base64.encode(x.toString())+'&uid='+Base64.encode(y.toString());
		e.stop();
		//Ocultamos el resto de botones
		$$('.investigar').each(function(item, index){
			item.setStyle('display','none');
		});
		
		$$('.investigando').each(function(item, index){
			item.setStyle('display','block');
		});
		
		//Mostramos la investigacion
		var idMejora=item.getParent().getParent().getFirst('.idMejora').get('value');
		var div=item.getParent().getParent().getFirst('.investigandoActual');
		cargarSeccion('?controlador=Mejoras&accion=investigar&idMejora='+idMejora+urlxy, div, 'jspestana', 'Mejoras', '1');
		item.getParent().getParent().getFirst('.investigandoActual').setStyle('display','block');
		item.getParent().getParent().getFirst('.investigando').setStyle('display','none');
	});
});

//Boton de cancelar
if($defined($('mejorasBtnCancelar'))){
	$('mejorasBtnCancelar').addEvent('click', function(e) {
		cargarSeccion('?controlador=Mejoras&accion=cancelar&idGrupo='+pestanas.panel.id, $(pestanas.panel.id), 'jspestana','Mejoras','mejoras');
	});
}

//Creamos la cuenta atras
if($defined($('mejorasDivCuentaAtras'))){
	garbage.regInstance(
		new Timer('mejorasDivCuentaAtras',
			{remainTime: parseInt($('mejorasDivCuentaAtras').get('text')),
			text: 'Terminado',
			onComplete: function(){
				if($defined(pestanas))
					(function(){pestanas.getContent();}).delay(500);
			}
		})
	);
}