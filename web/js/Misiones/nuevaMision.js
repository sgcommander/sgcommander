//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Seleccion de destino
if($defined($('unidadSelPlanetas'))){
	$('unidadSelPlanetas').addEvent('change', function(e) {
		if($('unidadSelPlanetas').selectedIndex!=0){
			var datos=$('unidadSelPlanetas').getSelected()[0].get('value').split('|',2);
			var idMision=$('idMision').get('value');
			//Creamos la peticion
			cargarSeccion('?controlador=Misiones&accion=planetaNueva&idMision='+idMision+'&idGalaxia='+datos[0]+'&idPlaneta='+datos[1], $('misionPlaneta'), 'jsdestino', 'Misiones', 'destino');
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
		var idMision=$('idMision').get('value');
		var datosDestino=$('unidadSelPlanetas').getSelected()[0].get('value').split('|',2);
		var tipoMision=$('unidadSelMisiones').getSelected()[0].get('value');
		var velocidad=$('unidadSelVelocidad').getSelected()[0].get('value');
		var url='?controlador=Misiones&accion=nueva';
		url=url+'&idMision='+idMision+'&tipoMision='+tipoMision+'&galaxiaDestino='+datosDestino[0]+'&planetaDestino='+datosDestino[1]+'&velocidad='+velocidad;
		
		//Creamos la peticion
		var req = new Request.HTML({
				url:url+urlxy,
				method: 'post',
				evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display','inline');
			},
			onComplete: function(html) {
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display','none');

				//pestanas.activate('disponibles');
				cargarSeccion('?controlador=Index&accion=principal', $('indexDivCentro'), 'jsmodulo','','');
			},
			onFailure: function() {
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display','none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
}