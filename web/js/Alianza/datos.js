//Validador de enviar datos
var validador = new FormCheck('alianzaFrmDatos',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//Metemos el html en la alerta
		Alerta.info(response);
		
		//Ocultamos el mensaje de carga
		$('preloader').setStyle('display','none');	
	},
	display : {
		errorsLocation : 0,
		indicateErrors : 2,
		showErrors : 1,
		addClassErrorToField : 1,
		scrollToFirst: false
	}
});


//Boton que borra alianzas
if($defined($('alianzaBtnBorrar'))){
	$('alianzaBtnBorrar').addEvent('click', function(e) {
		Alerta.confirm($('alianzaLblConfirmacionBorrar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	//Creamos la peticion
						var req = new Request({
							url: '?controlador=Alianza&accion=borrar',
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
								
								//Recargamos el modulo
								cargarSeccion('?controlador=Alianza&accion=alianza', $('indexDivCentro'), 'jsmodulo','','Alianza');
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
	});
}