//Limpiamos los modulos cargados anteriormente
garbage.clean();

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

//Array de botones de construir
$$('.btnConstruir').each(function(item, index){
	item.removeEvents();
	item.addEvent('click', function(e) {
		//Desactivamos el boton
		item.disabled=1;
		item.addClass('disabled');
		
		//Capturamos la posicion X e Y del click
        var x=e.page.x;
        var y=e.page.y;
        var urlxy='&version='+Base64.encode(x.toString())+'&uid='+Base64.encode(y.toString());
		e.stop();
		
		var idUnidad=item.getParent().getParent().getFirst('.idUnidad').get('value');
		var cantidad=parseInt(Number(item.getParent().getFirst('.cantidad').get('value')));
		var tiempo=parseFloat(item.getParent().getParent().getFirst('.tiempo').get('value').replace(',','.'));
		var div=item.getParent().getParent().getFirst('.construyendoActual');
		
		//Enviamos la peticion
		var req = new Request.HTML({
				url:'?controlador='+controlador+'&accion=construir&idUnidad='+idUnidad+'&cantidad='+cantidad+urlxy,
				method: 'post',
				evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display','inline');
			},
			onComplete: function(html) {
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display','none');
				
				//Comprobamos si devuelve correctamente
				if(html.length > 0){
					if(div!='' && $defined(div)){
						//Limpiamos el div
						div.empty();
						
						//Metemos el html
						div.adopt(html);
					
						//Incluimos el archivo js de la seccion
						//con include_once para que se ejecute con ASSET
						include_once('/js/'+controlador+'/'+'construibles'+'.js','jspestana');
					}
					
					//Ocultamos el resto de botones
					$$('.construir').each(function(item, index){
						item.setStyle('display','none');
					});
					
					$$('.construyendo').each(function(item, index){
						item.setStyle('display','block');
					});
					
					//Mostramos la construccion
					item.getParent().getParent().getFirst('.construyendoActual').setStyle('display','block');
					item.getParent().getParent().getFirst('.construyendo').setStyle('display','none');
					
					//Actualizamos la cantidad de tropas si es necesario
					$$('.tropasCantidad').each(function(el){
						el.set('text', parseInt(el.get('text'))+cantidad);
					});
					
					//Mostramos la construccion en las actuales del planeta
					var divUnidad;
					var id;
					switch(controlador){
						case 'Naves':
							divUnidad=$('indexDivConsNaves');
							id='indexDivContNave';
							break;
						case 'Soldados':
							divUnidad=$('indexDivConsTropas');
							id='indexDivContTropa';
							break;
						case 'Defensas':
							divUnidad=$('indexDivConsDefensas');
							id='indexDivContDefensa';
							break;
					}
					new Element('input', {'type': 'hidden', 'class': 'tiempoTotal', 'value': Math.round(tiempo * cantidad) }).inject(divUnidad);
					new Element('input', {'type': 'hidden', 'class': 'tiempoRestante', 'value': Math.round(tiempo * cantidad) }).inject(divUnidad);
					new Element('img', {'src': '/images/unidades/'+idUnidad+'.jpg', 'class': 'imagenUnidadPeq', 'alt': 'Construyendo'}).inject(divUnidad);
					new Element('div', {'id': id}).inject(divUnidad);
					
					$('indexDivConstrucciones').setStyle('display','inline');
					$('indexDivNoConstrucciones').setStyle('display','none');
					divUnidad.setStyle('display','block');
					
					var controladorConst=controlador;
					
					garbage.regInstance(
						new Timer(id, {'bar': true, 'remainTime': Math.round(tiempo * cantidad),
							'totalTime': Math.round(tiempo * cantidad),
							'boxID': 'box'+id,
							'percentageID': 'percentage'+id,
							'displayID': 'display'+id,
							onComplete: function(){
								//Elimino el timer
								this.destroy();
								
								//Oculto/Elimino el html no necesario
								divUnidad.empty();
								divUnidad.setStyle('display','none');
								
								//En caso de no haber construcciones mostramos el cartel
								if($('indexDivConsTropas').getStyle('display')=='none' && $('indexDivConsNaves').getStyle('display')=='none' && $('indexDivConsDefensas').getStyle('display')=='none'){
									$('indexDivConstrucciones').setStyle('display','none');
									$('indexDivNoConstrucciones').setStyle('display','block');
								}
								
								//Si es necesario recargamos el modulo
								if(controlador==controladorConst && pestanas.panel.id=='disponibles'){
									cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
								}
							}
						}),
						controlador+'Barra'
					);
				}
			},
			onFailure: function() {
				if(div!='' && $defined(div)){
					$(div).set('text', 'Error al cargar.');
				}
				
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display','none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
});

//Boton de cancelar
if($defined($('unidadesBtnCancelar'))){
	$('unidadesBtnCancelar').addEvent('click', function(e) {
		e.stop();
		//Desactivamos el boton
		$('unidadesBtnCancelar').disabled=1;
		$('unidadesBtnCancelar').addClass('disabled');
		
		var div=$('unidadesBtnCancelar').getParent().getParent().getFirst('.contruir');
		//Enviamos la peticion
		var req = new Request.HTML({
				url:'?controlador='+controlador+'&accion=cancelar',
				method: 'post',
				evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display','inline');
			},
			onComplete: function(html) {
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display','none');
				
				//Mostramos el resto de botones
				$$('.construir').each(function(item, index){
					item.setStyle('display','block');
				});
				
				//Ocultamos todos los estados de construir
				$$('.construyendo').each(function(item, index){
					item.setStyle('display','none');
				});
				
				//Actualizamos la cantidad de tropas si es necesario
				$$('.tropasCantidad').each(function(el){
					el.set('text', parseInt(el.get('text'))-parseInt($('cantidad').get('value')));
				});
				
				//Mostramos el boton de construir
				$('unidadesBtnCancelar').getParent().getParent().getFirst('.construir').setStyle('display','block');
				$('unidadesBtnCancelar').getParent().getParent().getFirst('.construyendoActual').setStyle('display','none');
				$('unidadesBtnCancelar').getParent().getParent().getFirst('.construyendoActual').empty();
				
				//Ocultamos la construccion en las actuales del planeta
				var divUnidad;
				switch(controlador){
					case 'Naves':
						divUnidad=$('indexDivConsNaves');	
						break;
					case 'Soldados':
						divUnidad=$('indexDivConsTropas');	
						break;
					case 'Defensas':
						divUnidad=$('indexDivConsDefensas');	
						break;
				}

				divUnidad.setStyle('display','none');
				garbage.clean(controlador+'Barra');
				divUnidad.empty();
				
				//En caso de no haber construcciones mostramos el cartel
				if($('indexDivConsTropas').getStyle('display')=='none' && $('indexDivConsNaves').getStyle('display')=='none' && $('indexDivConsDefensas').getStyle('display')=='none'){
					$('indexDivConstrucciones').setStyle('display','none');
					$('indexDivNoConstrucciones').setStyle('display','block');
				}
				
				
				if(div!='' && $defined(div)){
					//Limpiamos el div
					div.empty();
					
					//Metemos el html
					div.adopt(html);
					
					//Cargamos el js
					include_once('/js/'+controlador+'/construibles.js','jspestana');
				}	
			},
			onFailure: function() {
				if(div!='' && $defined(div)){
					$(div).set('text', 'Error al cargar.');
				}
				
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display','none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
}

//Campos de texto
$$('.txtCantidad').each(function(item, index){
	//Evento al clicar
	item.addEvent('click', function(e) {
		e.stop();
		if(item.get('value')=='0')
			item.set('value','');
	});
	
	//Evento al pulsar tecla
	item.addEvent('keyup', function(e) {
		var cantidad=item.get('value');
		var btnConstruir=item.getParent().getFirst('.btnConstruir');
		var primario=parseInt(item.getParent().getParent().getFirst('.primario').get('value'));
		var secundario=parseInt(item.getParent().getParent().getFirst('.secundario').get('value'));
		var energia=parseInt(item.getParent().getParent().getFirst('.energia').get('value'));
		var maxUnidadesReq=parseInt(item.getParent().getParent().getFirst('.maxUnidadesReq').get('value'));
		var heroe=parseInt(item.getParent().getParent().getFirst('.heroe').get('value'));

		//Si la cantida es valida y nos alcanzan los recursos
		if(/^\d+$/.test(cantidad) && cantidad>0
			&& indexRecursoPri>=(cantidad*primario) && indexRecursoSec>=(cantidad*secundario) && indexRecursoEne>=(cantidad*energia) 
			&& (maxUnidadesReq==-1 || cantidad<=maxUnidadesReq) && ((heroe==1 && cantidad==1) || heroe==0)
		){
			btnConstruir.removeClass('disabled');
			btnConstruir.disabled=0;
		}
		else{
			btnConstruir.addClass('disabled');
			btnConstruir.disabled=1;
		}
	});
});

//Botones de maximo
$$('.btnMaximo').each(function(item, index){
	item.addEvent('click', function(e) {
		var txtCantidad=item.getParent().getFirst('.txtCantidad');
		var primario=item.getParent().getParent().getFirst('.primario').get('value');
		var secundario=item.getParent().getParent().getFirst('.secundario').get('value');
		var energia=item.getParent().getParent().getFirst('.energia').get('value');
		var maxUnidadesReq=item.getParent().getParent().getFirst('.maxUnidadesReq').get('value');
		var heroe=item.getParent().getParent().getFirst('.heroe').get('value');

		//Dividimos entre cada recurso
		var cantidad = new Array();
		//Las que permite el primario
		if(primario!=0)
			cantidad[cantidad.length]=parseInt(indexRecursoPri)/primario;
		//Las que permite el secudnario
		if(secundario!=0)
			cantidad[cantidad.length]=parseInt(indexRecursoSec)/secundario;
		//Las que permite la energia
		if(energia!=0)
			cantidad[cantidad.length]=parseInt(indexRecursoEne/energia);
		//Las que permitan las unidades
		if(maxUnidadesReq>-1)
			cantidad[cantidad.length]=maxUnidadesReq;
		/*else
			cantidad[cantidad.length]=0;*/
		if(heroe==1)
			cantidad[cantidad.length]=1;
			
		//Asignamos el menor de los valores a la cantidad
		txtCantidad.set('value',Math.floor(Math.min.apply(Math,cantidad)));
		txtCantidad.fireEvent('keyup');
	});
});

//Creamos la cuenta atras
if($defined($('unidadesDivCuentaAtras'))){
	garbage.regInstance(
		new Timer('unidadesDivCuentaAtras',
			{remainTime: parseInt($('unidadesDivCuentaAtras').get('text')),
			text: 'Terminado',
			onComplete: function(){
				if(pestanas.panel.id=='construibles'){
					(function(){pestanas.getContent();}).delay(500);
				}
			}
		})
	);
}