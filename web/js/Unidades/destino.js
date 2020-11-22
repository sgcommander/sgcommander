//Seleccion de mision
if ($defined($('unidadSelMisiones'))) {
	$('unidadSelMisiones').addEvent('change', function(e){
		var btnEnviar = $('unidadBtnEnviar');
		if ($('unidadSelMisiones').selectedIndex != 0) {
			var todoCero = true;
			var cazas=0;
			var capacidadCazas=0;
			var stargate=true;
			
			$$('.txtCantidad').each(function(item2, index){
				var cantidad = parseInt(Number(item2.get('value')));
				var cantidadMax = item2.getParent().getFirst('.cantidad').get('value');
				if (cantidad != 0 && validarNumero(cantidad) && cantidad > 0 && (parseInt(cantidad) <= parseInt(cantidadMax))) 
					todoCero = false;
				
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
				}
			});

			//Si la cantidad es distinta 0 y hemos seleciconado un tipo de mision
			var datosDestino = $('unidadSelPlanetas').getSelected()[0].get('value').split('|', 2);
			if (!todoCero && (capacidadCazas>=cazas || (stargate && (indexIdGalaxiaSel==datosDestino[0] || stargateIntergalactico)))) {
				btnEnviar.removeClass('disabled');
				btnEnviar.disabled = 0;
				
				//Averiguamos el tiempo de mision
				var tipoMision = $('unidadSelMisiones').getSelected()[0].get('value');
				var velocidad = $('unidadSelVelocidad').getSelected()[0].get('value');
				var url = '?controlador=' + controlador + '&accion=tiempoMision';
				url = url + '&tipoMision=' + tipoMision + '&galaxiaDestino=' + datosDestino[0] + '&planetaDestino=' + datosDestino[1] + '&velocidad=' + velocidad;
				$$('.cantidades').each(function(el){
					var idUnidad = el.getFirst('.idUnidad').get('value');
					var cantidad = el.getFirst('.txtCantidad').get('value');
					if (cantidad > 0) {
						url = url + '&idUnidad[]=' + idUnidad;
						url = url + '&cantidad[]=' + cantidad;
					}
				});
				cargarSeccion(url, $('unidadDivTiempo'), '', '', '');
			}
			else {
				btnEnviar.addClass('disabled');
				btnEnviar.disabled = 1;
				$('unidadDivTiempo').empty();
			}
		}
		else {
			btnEnviar.addClass('disabled');
			btnEnviar.disabled = 1;
			$('unidadDivTiempo').empty();
		}
	});
	
	//Ocultar las misiones innecesarias
	var exploradores=true;
	
	$$('.txtCantidad').each(function(item, index){
		var cantidad = item.get('value');
		if(cantidad>0){
			var padre=item.getParent();
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
}

//Seleccion de velocidad
if ($defined($('unidadSelVelocidad'))) {
	$('unidadSelVelocidad').addEvent('change', function(e){
		var btnEnviar = $('unidadBtnEnviar');
		var todoCero = true;
		var cazas=0;
		var capacidadCazas=0;
		var stargate=true;
		
		$$('.txtCantidad').each(function(item2, index){
			var cantidad = item2.get('value');
			var cantidadMax = item2.getParent().getFirst('.cantidad').get('value');
			if (cantidad != 0 && validarNumero(cantidad) && cantidad > 0 && (parseInt(cantidad) <= parseInt(cantidadMax))) 
				todoCero = false;
			
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
			}
		});
		
		//Si la cantidad es distinta 0 y hemos seleciconado un tipo de mision
		var datosDestino = $('unidadSelPlanetas').getSelected()[0].get('value').split('|', 2);
		if (!todoCero && $('unidadSelMisiones').selectedIndex != 0 && (capacidadCazas>=cazas || (stargate && (indexIdGalaxiaSel==datosDestino[0] || stargateIntergalactico)))) {
			btnEnviar.removeClass('disabled');
			btnEnviar.disabled = 0;
			
			//Averiguamos el tiempo de mision
			var tipoMision = $('unidadSelMisiones').getSelected()[0].get('value');
			var velocidad = $('unidadSelVelocidad').getSelected()[0].get('value');
			var url = '?controlador=' + controlador + '&accion=tiempoMision';
			url = url + '&tipoMision=' + tipoMision + '&galaxiaDestino=' + datosDestino[0] + '&planetaDestino=' + datosDestino[1] + '&velocidad=' + velocidad;
			$$('.cantidades').each(function(el){
				var idUnidad = el.getFirst('.idUnidad').get('value');
				var cantidad = el.getFirst('.txtCantidad').get('value');
				if (cantidad > 0) {
					url = url + '&idUnidad[]=' + idUnidad;
					url = url + '&cantidad[]=' + cantidad;
				}
			});
			cargarSeccion(url, $('unidadDivTiempo'), '', '', '');
		}
		else {
			btnEnviar.addClass('disabled');
			btnEnviar.disabled = 1;
			$('unidadDivTiempo').empty();
		}
	});
}