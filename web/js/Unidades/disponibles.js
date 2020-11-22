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


//Array de botones de >>
$$('.btnAnadir').each(function(item, index){
	item.addEvent('click', function(e) {
		e.stop();
		var cantidad=item.getParent().getParent().getFirst('.cantidades').getFirst('.cantidad').get('value');
		var txtCantidad=item.getParent().getParent().getFirst('.cantidades').getFirst('.txtCantidad');
		txtCantidad.set('value',cantidad);
		txtCantidad.fireEvent('keyup');
	});
});

//Array de botones de <<
$$('.btnQuitar').each(function(item, index){
	item.addEvent('click', function(e) {
		e.stop();
		var txtCantidad=item.getParent().getParent().getFirst('.cantidades').getFirst('.txtCantidad');
		txtCantidad.set('value',0);
		txtCantidad.fireEvent('keyup');
	});
});

//Boton de ninguna
if($defined($('unidadBtnNinguna'))){
	$('unidadBtnNinguna').addEvent('click', function(e) {
		$$('.txtCantidad').each(function(item, index){
			item.set('value','0');
			item.fireEvent('keyup');
		});
	});
}

//Boton de todas
if($defined($('unidadBtnTodas'))){
	$('unidadBtnTodas').addEvent('click', function(e) {
		$$('.txtCantidad').each(function(item, index){
			var cantidad=item.getParent().getFirst('.cantidad').get('value');
			item.set('value',cantidad);
			item.fireEvent('keyup');
		});
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
	
	//Evento al perder foco
	item.addEvent('blur', function(e) {
		e.stop();
		if(item.get('value')=='')
			item.set('value','0');
	});
	
	//Evento al escribir
	item.addEvent('keyup', function(e) {
		var btnLicenciar=$('unidadBtnLicenciar');
		var btnEnviar=$('unidadBtnEnviar');
		var selMision=$('unidadSelMisiones');
		var todoCero=true;
		var cazas=0;
		var capacidadCazas=0;
		var stargate=true;
		var exploradores=true;
		
		$$('.txtCantidad').each(function(item2, index){
				var cantidad=parseInt(Number(item2.get('value')));
				var cantidadMax=item2.getParent().getFirst('.cantidad').get('value');
				if(cantidad!=0 && validarNumero(cantidad) && cantidad>0 && (parseInt(cantidad)<=parseInt(cantidadMax)))
					todoCero=false;
				
				//Comprobamos los cazas y si son exploradores
				if(cantidad>0){
					var padre=item2.getParent();
					//Cantidades de cazas
					if($defined(padre.getFirst('.capacidadCazas')))
						capacidadCazas=capacidadCazas+(parseInt(padre.getFirst('.capacidadCazas').get('value'))*cantidad);
					if($defined(padre.getFirst('.caza')) && padre.getFirst('.caza').get('value')==1)
						cazas=cazas+cantidad;
					//Comprobamos si viaja por el stargate
					if($defined(padre.getFirst('.stargate')) && stargate)
		        		stargate=padre.getFirst('.stargate').get('value')==1;
					
					//Comprobamos si todos son exploradores
					if($defined(padre.getFirst('.explorador')) && exploradores)
						exploradores=padre.getFirst('.explorador').get('value')==1;
				}			
		});
		
		//Si no todos son exploradores ocultamos la mision de explorar
		if($defined($('unidadOptExplorar'))){
			if(!exploradores){
				//$('unidadOptExplorar').setStyles({'visibility':'hidden','display':'none'});
				$('unidadOptExplorar').disabled = 1;
				if($('unidadSelMisiones').getSelected()[0].get('value')==4)
					$('unidadSelMisiones').selectedIndex=0;
			}
			else{
				//$('unidadOptExplorar').setStyles({'visibility':'visible','display':'block'});
				$('unidadOptExplorar').disabled = 0;
			}
		}
		
		//Ajustamos la cantidad de cazas
		if($defined($('cantidadCazas')) && $defined($('capacidadCazas')) && $defined($('divEspacioCazas'))){
			$('cantidadCazas').set('text','');
			$('capacidadCazas').set('text','');
			if(!stargate){
				$('cantidadCazas').set('text',cazas);
				$('capacidadCazas').set('text',capacidadCazas);
			}
			else{
				$('cantidadCazas').set('text','0');
				$('capacidadCazas').set('text','0');
			}
			
			//Coloreamos en rojo los cazas
			if(capacidadCazas>=cazas || stargate)
				$('divEspacioCazas').removeClass('rojo');
			else
				$('divEspacioCazas').addClass('rojo');
		}
		
		//Si la cantidad es 0 y hemos seleciconado un tipo de mision y caben los cazas
		if($defined($('unidadSelPlanetas'))){
			var datosDestino=$('unidadSelPlanetas').getSelected()[0].get('value').split('|',2);
			if(!todoCero && $defined(selMision) && selMision.selectedIndex!=0 && (capacidadCazas>=cazas || (stargate && (indexIdGalaxiaSel==datosDestino[0] || stargateIntergalactico)))){
				btnEnviar.removeClass('disabled');
				btnEnviar.disabled=0;
				
				//Averiguamos el tiempo de mision
				var tipoMision=$('unidadSelMisiones').getSelected()[0].get('value');
				var velocidad=$('unidadSelVelocidad').getSelected()[0].get('value');
				var url='?controlador='+controlador+'&accion=tiempoMision';
				url=url+'&tipoMision='+tipoMision+'&galaxiaDestino='+datosDestino[0]+'&planetaDestino='+datosDestino[1]+'&velocidad='+velocidad;
				$$('.cantidades').each(function(el){
	    			var idUnidad=el.getFirst('.idUnidad').get('value');
	    			var cantidad=el.getFirst('.txtCantidad').get('value');
	    			if(cantidad>0){
	    				url=url+'&idUnidad[]='+idUnidad;
	    				url=url+'&cantidad[]='+cantidad;
	    			}
				});
				cargarSeccion(url, $('unidadDivTiempo'),'','','');
			}
			else{
				if($defined($('unidadBtnEnviar'))){
					btnEnviar.addClass('disabled');
					btnEnviar.disabled=1;
				}
				
				if($defined($('unidadDivTiempo')))
					$('unidadDivTiempo').empty();
			}
		}
		
		
		//Si la cantida es cero en todos desactivamos el boton de licenciar
		if(!todoCero){
			btnLicenciar.removeClass('disabled');
			btnLicenciar.disabled=0;
		}
		else{
			btnLicenciar.addClass('disabled');
			btnLicenciar.disabled=1;
		}
	});
});

//Boton que licencia unidades
if($defined($('unidadBtnLicenciar'))){
	$('unidadBtnLicenciar').addEvent('click', function(e) {
		Alerta.confirm($('mensajesLblConfirmacionLicenciar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	var url='?controlador='+controlador+'&accion=licenciar';
		            	$$('.cantidades').each(function(el){
		            			var idUnidad=el.getFirst('.idUnidad').get('value');
		            			var cantidad=parseInt(Number(el.getFirst('.txtCantidad').get('value')));
		            			if(cantidad>0){
		            				url=url+'&idUnidad[]='+idUnidad;
		            				url=url+'&cantidad[]='+cantidad;
		            			}
		            	});

		            	cargarSeccion(url, $('disponibles'), 'jspestana', controlador, 'disponibles');
		            } 
				}
		});
	});
}

//Boton que licencia la defensa de stargate
$$('.btnLicenciar').each(function(item, index){
	item.addEvent('click', function(e) {
		Alerta.confirm($('mensajesLblConfirmacionLicenciar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	var url='?controlador='+controlador+'&accion=licenciar';
		            	
		            	var idUnidad=item.getParent().getFirst('.idUnidad').get('value');
		            	var cantidad=parseInt(Number(item.getParent().getFirst('.cantidad').get('value')));
		            	if(cantidad>0){
		            		url=url+'&idUnidad[]='+idUnidad;
		            		url=url+'&cantidad[]='+cantidad;
		            	}

		            	cargarSeccion(url, $('disponibles'), 'jspestana', controlador, 'disponibles');
		            } 
				}
		});
	});
});

//Seleccion de destino
if($defined($('unidadSelPlanetas'))){
	$('unidadSelPlanetas').addEvent('change', function(e) {
		if($('unidadSelPlanetas').selectedIndex!=0){
			var datos=$('unidadSelPlanetas').getSelected()[0].get('value').split('|',2);
			//Creamos la peticion
			cargarSeccion('?controlador=Misiones&accion=planeta&idGalaxia='+datos[0]+'&idPlaneta='+datos[1], $('misionPlaneta'), 'jsdestino', 'Unidades', 'destino');
		}
		else{
			$('misionPlaneta').set('html', '');
			var btnEnviar=$('unidadBtnEnviar');
			btnEnviar.addClass('disabled');
			btnEnviar.disabled=1;
		}
	});
}

//Boton de enviar mision
if($defined($('unidadBtnEnviar'))){
	$('unidadBtnEnviar').addEvent('click', function(e) {
		//Capturamos la posicion X e Y del click
        var x=e.page.x;
        var y=e.page.y;
        var urlxy='&version='+Base64.encode(x.toString())+'&uid='+Base64.encode(y.toString());
		e.stop();
		//Averiguamos el tiempo de mision
		var datosDestino=$('unidadSelPlanetas').getSelected()[0].get('value').split('|',2);
		var tipoMision=$('unidadSelMisiones').getSelected()[0].get('value');
		var velocidad=$('unidadSelVelocidad').getSelected()[0].get('value');
		var url='?controlador='+controlador+'&accion=mision';
		url=url+'&tipoMision='+tipoMision+'&galaxiaDestino='+datosDestino[0]+'&planetaDestino='+datosDestino[1]+'&velocidad='+velocidad;
		$$('.cantidades').each(function(el){
			//Construimos la URL
			var idUnidad=el.getFirst('.idUnidad').get('value');
			var cantidad=parseInt(Number(el.getFirst('.txtCantidad').get('value')));
			if(cantidad>0){
				url=url+'&idUnidad[]='+idUnidad;
				url=url+'&cantidad[]='+cantidad;
			}
		});
		
		//Hacemos la peticion
		cargarSeccion(url+urlxy, $('indexDivCentro'), 'jsmodulo','','');
	});
}

//Añadimos el js del planeta de destino
include_once('/js/Unidades/destino.js', 'jsdestino');