//Limpiamos los datos del modulo anterior
garbage.clean('especial');

//Boton que cierra el modulo de especiales
$('especialesBtnCerrar').addEvent('click', function(e) {
	//Ocultamos la barra de especiales
	barraEspeciales.slideOut();
	especialesVisible=false;

	garbage.clean('especial');
	e.stop();
});

//A�adimos los tips de los especiales
garbage.regInstance(
	new Tips('.tooltipEspecial',{
	    showDelay: 0,
	    hideDelay: 0,
	    className: 'tip-container',
	    fixed:false,
	    offsets: {'x': 5, 'y': 5}
	}),
	'especial'
);

$$('.tooltipEspecial').each(function(item, index){
	var texto='<div class="especialesDivTexto">'+item.getParent().getElement('.descripcion').value+'</div>';
	texto=texto+'<div class="especialesDivTitulo">'+item.getParent().getElement('.efecto').value+':</div>';
	texto=texto+'<div class="especialesDivTexto">'+item.getParent().getElement('.especificacion').value+'</div>';
	texto=texto+'<div class="especialesDivTitulo">'+item.getParent().getElement('.duracion').value+':</div>';
	texto=texto+'<div class="especialesDivTexto">'+item.getParent().getElement('.duracionTiempo').value+'</div>';
	texto=texto+'<div class="especialesDivTitulo">'+item.getParent().getElement('.recarga').value+':</div>';
	texto=texto+'<div class="especialesDivTexto">'+item.getParent().getElement('.duracionRecarga').value+'</div>';
	item.store('tip:text', texto);
});

//Cada especial
$$('.divEspecial').each(function(item, index){
	var id=item.getFirst('.idEspecial').value;
	var divBoton=item.getFirst('.especialesDivActivar');
	if(item.getFirst('.tiempoRestante').value!=0){
		divBoton.setStyle('display', 'none');
		item.getFirst('img').src=item.getFirst('.imagenActivo').value;
		
		garbage.regElement(new Element('div',{'class': 'especialesDivMensaje','text' : item.getFirst('.activo').value}).inject(item), 'especial');
		
		garbage.regInstance(
			new Timer('especial'+id, {'bar': true, 'remainTime': item.getFirst('.tiempoRestante').value,
				'totalTime': item.getFirst('.tiempoTotalRestante').value,
				'boxID': 'box'+id,
				'percentageID': 'percentage'+id,
				'displayID': 'display'+id,
				onComplete: function(){
					//Actualizo la imagen y cambio el letrerito a recargando
					item.getFirst('img').src=item.getFirst('.imagenRecarga').value;
					item.getFirst('.especialesDivMensaje').set('text',item.getFirst('.recargando').value);
					
					//Reinicializo el contador con los nuevos tiempo y la nueva funcion de completado
					this.reset(item.getFirst('.tiempoTotalRecarga').value, 
							item.getFirst('.tiempoTotalRecarga').value,
							function(){
								this.destroy();
								$('especial'+id).set('text', '');
								divBoton.setStyle('display', 'inline');
								item.getFirst('.especialesDivMensaje').destroy();
							}
					);
					
					//Si es necesario recargamos el modulo
					if(recargar)
						cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
				}
			}),
			'especial'
		);
	}
	else if(item.getFirst('.tiempoRecarga').value!=0){
		divBoton.setStyle('display', 'none');
		item.getFirst('img').src=item.getFirst('.imagenRecarga').value;
		garbage.regElement(new Element('div',{'class': 'especialesDivMensaje','text' : item.getFirst('.recargando').value}).inject(item), 'especial');
		garbage.regInstance(
			new Timer('especial'+id, {'bar': true, 'remainTime': item.getFirst('.tiempoRecarga').value,
				'totalTime': item.getFirst('.tiempoTotalRecarga').value,
				'boxID': 'box'+id,
				'percentageID': 'percentage'+id,
				'displayID': 'display'+id,
				onComplete: function(){
					this.destroy();
					$('especial'+id).set('text', '');
					divBoton.setStyle('display', 'inline');
					item.getFirst('.especialesDivMensaje').destroy();
					
					//Si es necesario recargamos el modulo
					if(recargar)
						cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
				}	
			}),
			'especial'
		);
	}
	else{
		item.getFirst('img').src=item.getFirst('.imagenRecarga').value;
	}
});
	

//Botones de activar
$$('.especialesBtnActivar').each(function(item, index){
	//Ocultamos los botones necesarios y mostramos las barras
	var divBoton=item.getParent();
	var id=item.getParent().getParent().getFirst('.idEspecial').value;
	var item2=item.getParent().getParent();
	
	var url='?controlador=Especiales&accion=activar&idEspecial='+id;

	item.addEvent('click', function(e) {
		//Capturamos la posicion X e Y del click
        var x=e.page.x;
        var y=e.page.y;
        var urlxy='&version='+Base64.encode(x.toString())+'&uid='+Base64.encode(y.toString());
		e.stop();
		//Creamos la peticion
		var req = new Request.HTML({
			url:url+urlxy,
			method: 'post',
			onComplete: function(html) {
				divBoton.setStyle('display', 'none');
				item2.getFirst('img').src=item2.getFirst('.imagenActivo').value;
				garbage.regElement(new Element('div',{'class': 'especialesDivMensaje','text' : item2.getFirst('.activo').value}).inject(item2), 'especial');
				garbage.regInstance(
					new Timer($('especial'+id), {'bar': true, 'remainTime': item2.getFirst('.tiempoTotalRestante').value,
						'totalTime': item2.getFirst('.tiempoTotalRestante').value,
						'boxID': 'box'+id,
						'percentageID': 'percentage'+id,
						'displayID': 'display'+id,
						onComplete: function(){
							//Actualizo la imagen y cambio el letrerito a recargando
							item2.getFirst('img').src=item2.getFirst('.imagenRecarga').value;
							item2.getFirst('.especialesDivMensaje').set('text',item2.getFirst('.recargando').value);
							
							//Reinicializo el contador con los nuevos tiempo y la nueva funcion de completado
							this.reset(item2.getFirst('.tiempoTotalRecarga').value,
									item2.getFirst('.tiempoTotalRecarga').value,
									function(){
										this.destroy();
										$('especial'+id).set('text', '');
										divBoton.setStyle('display', 'inline');
										item2.getFirst('.especialesDivMensaje').destroy();
									}
							);
							
							//Si es necesario recargamos el modulo
							if(recargar)
								cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
						}
					}),
					'especial'
				);
				
				//Si es necesario recargamos el modulo
				if(recargar)
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
			}
		});
		
		//Enviamos la peticion
		req.send();
		
		e.stop();
	});
});