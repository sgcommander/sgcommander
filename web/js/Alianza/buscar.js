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

/************************************************************
	Enlaces de enviar solicitud
************************************************************/
$$('.enlaceEnviarSolicitud').each(function(el){
	el.addEvent('click', function(e) {
		var idAlianza=el.getParent().getFirst('.idAlianza').value;
		var mensaje=el.getParent().getFirst('.mensajeSolicitud').value;
		Alerta.prompt(mensaje,'' ,{ onComplete: 
			function(returnvalue) {
		    	if(returnvalue){
		    		//Creamos la peticion
					var req = new Request({
						url: el.get('href')+'&idAlianza='+idAlianza+'&mensaje='+returnvalue,
						method: 'post',
						evalScripts: true,
						onRequest: function(){
							//Mostramos la precarga
							$('preloader').setStyle('display', 'inline');
						},
						onComplete: function(html){
							//Ocultamos el mensaje de precarga
							$('preloader').setStyle('display', 'none');
							
							//Metemos el html en la alerta
							Alerta.info(html);
						},
						onFailure: function(){
							//Ocultamos el mensaje de carga
							$('preloader').setStyle('display', 'none');
						}
					});
					//Enviamos la peticion
					req.send();
		    	}
			}
		});

		e.stop();
	});
});