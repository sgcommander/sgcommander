//Seleccion de mision
if ($defined($('unidadSelMisiones'))) {
	$('unidadSelMisiones').addEvent('change', function(e){
		var btnEnviar = $('unidadBtnEnviar');
		if ($('unidadSelMisiones').selectedIndex != 0) {
			var datosDestino = $('unidadSelPlanetas').getSelected()[0].get('value').split('|', 2);
			btnEnviar.removeClass('disabled');
			btnEnviar.disabled = 0;
				
			//Averiguamos el tiempo de mision
			var tipoUnidadMision = $('idTipoUnidadMision').get('value');
			switch(tipoUnidadMision){
				case '1':
					var controladorTipo='Naves';
					break;
				case '2':
					var controladorTipo='Soldados';
					break;
			}
			var tipoMision = $('unidadSelMisiones').getSelected()[0].get('value');
			var velocidad = $('unidadSelVelocidad').getSelected()[0].get('value');
			var idGalaxiaOrigen = $('idGalaxiaOrigen').get('value');
			var idPlanetaOrigen = $('idPlanetaOrigen').get('value');
			var url = '?controlador=' + controladorTipo + '&accion=tiempoMision';
			url = url + '&tipoMision=' + tipoMision + '&galaxiaOrigen=' + idGalaxiaOrigen + '&planetaOrigen=' + idPlanetaOrigen + '&galaxiaDestino=' + datosDestino[0] + '&planetaDestino=' + datosDestino[1] + '&velocidad=' + velocidad;
			$$('.cantidades').each(function(el){
				var idUnidad = el.getFirst('.idUnidad').get('value');
				var cantidad = el.getFirst('.cantidad').get('value');
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

//Seleccion de velocidad
if ($defined($('unidadSelVelocidad'))) {
	$('unidadSelVelocidad').addEvent('change', function(e){
		var btnEnviar = $('unidadBtnEnviar');
		if ($('unidadSelMisiones').selectedIndex != 0) {
			var datosDestino = $('unidadSelPlanetas').getSelected()[0].get('value').split('|', 2);
			btnEnviar.removeClass('disabled');
			btnEnviar.disabled = 0;
				
			//Averiguamos el tiempo de mision
			var tipoUnidadMision = $('idTipoUnidadMision').get('value');
			switch(tipoUnidadMision){
				case '1':
					var controladorTipo='Naves';
					break;
				case '2':
					var controladorTipo='Soldados';
					break;
			}
			var tipoMision = $('unidadSelMisiones').getSelected()[0].get('value');
			var velocidad = $('unidadSelVelocidad').getSelected()[0].get('value');
			var idGalaxiaOrigen = $('idGalaxiaOrigen').get('value');
			var idPlanetaOrigen = $('idPlanetaOrigen').get('value');
			var url = '?controlador=' + controladorTipo + '&accion=tiempoMision';
			url = url + '&tipoMision=' + tipoMision + '&galaxiaOrigen=' + idGalaxiaOrigen + '&planetaOrigen=' + idPlanetaOrigen + '&galaxiaDestino=' + datosDestino[0] + '&planetaDestino=' + datosDestino[1] + '&velocidad=' + velocidad;
			$$('.cantidades').each(function(el){
				var idUnidad = el.getFirst('.idUnidad').get('value');
				var cantidad = el.getFirst('.cantidad').get('value');
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