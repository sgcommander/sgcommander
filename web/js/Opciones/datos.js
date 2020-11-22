//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Boton que borra cuentas
if($defined($('opcionesBtnBorrar'))){
	$('opcionesBtnBorrar').addEvent('click', function(e) {
		Alerta.confirm($('opcionesLblConfirmacionBorrar').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	Alerta.confirm($('opcionesLblConfirmacionBorrar2').get('value'), {
		        			onComplete: 
		        				function(returnvalue) { 
		        		            if(returnvalue){
		        		            	//Creamos la peticion
		        		            	var req = new Request.HTML({
		        		            			url:'?controlador=Opciones&accion=borrar',
		        		            			method: 'post',
		        		            		onRequest: function(){
		        		            			//Mostramos la precarga
		        		            			$('preloader').setStyle('display','inline');
		        		            		},
		        		            		onComplete: function(html) {
		        		            			//Ocultamos el mensaje de precarga
		        		            			$('preloader').setStyle('display','none');
		        		            			
		        		            			Alerta.info(html,{
		        		            				onComplete:
		        		            					function(returnvalue) {
							        		            	//Recargamos la pagina
					        		            			window.location = 'http://www.sgcommander.com';
		        		            					}
		        		            			});
		        		            		},
		        		            		onFailure: function() {
		        		            			//Ocultamos el mensaje de carga
		        		            			$('preloader').setStyle('display','none');
		        		            		}
		        		            	});
		        		            	//Enviamos la peticion
		        		            	req.send();
		        		            }
		            			}
		            	});
		            }
				}
		});
	});
}

//Boton que activa el modo vacaciones
if($defined($('opcionesBtnVacaciones'))){
	$('opcionesBtnVacaciones').addEvent('click', function(e) {
		Alerta.confirm($('opcionesLblConfirmacionVacaciones').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	//Creamos la peticion
		            	var req = new Request({
		            			url:'?controlador=Opciones&accion=vacaciones',
		            			method: 'post',
		            		onRequest: function(){
		            			//Mostramos la precarga
		            			$('preloader').setStyle('display','inline');
		            		},
		            		onComplete: function(txt) {
		            			//Ocultamos el mensaje de precarga
		            			$('preloader').setStyle('display','none');
		            			
								Alerta.info(txt,{
									onComplete:
		            					function(returnvalue) {
			        		            	//Recargamos la pagina
	        		            			window.location = 'http://www.sgcommander.com';
		            					}
								});
		            		},
		            		onFailure: function() {
		            			//Ocultamos el mensaje de carga
		            			$('preloader').setStyle('display','none');
		            		}
		            	});
		            	//Enviamos la peticion
		            	req.send();
		            }
				}
		});
	});
}

//Boton que activa la proteccion ip
if($defined($('opcionesBtnProteccionIP'))){
	$('opcionesBtnProteccionIP').addEvent('click', function(e) {
		Alerta.confirm($('opcionesLblConfProteccionIP').get('value'), {
			onComplete: 
				function(returnvalue) { 
		            if(returnvalue){
		            	//Creamos la peticion
		            	var req = new Request({
		            			url:'?controlador=Opciones&accion=proteccionIP',
		            			method: 'post',
		            		onRequest: function(){
		            			//Mostramos la precarga
		            			$('preloader').setStyle('display','inline');
		            		},
		            		onComplete: function(txt) {
		            			//Ocultamos el mensaje de precarga
		            			$('preloader').setStyle('display','none');
		            			
		            			cargarSeccion('?controlador=Opciones&accion=datos', $('contenido'), 'jspestana','Opciones','datos');
									
		            		},
		            		onFailure: function() {
		            			//Ocultamos el mensaje de carga
		            			$('preloader').setStyle('display','none');
		            		}
		            	});
		            	//Enviamos la peticion
		            	req.send();
		            }
				}
		});
	});
}

//Validador de datos
var validador = new FormCheck('opcionesFrmDatos',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
		//mensaje('opcionesDivDatosMensaje',response.html);
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

//Validador de idioma
var validadorIdioma = new FormCheck('opcionesFrmIdioma',{
	submitByAjax: true,
	ajaxEvalScripts: true,
	onAjaxRequest: function(){
		//Mostramos el mensaje de carga
		$('preloader').setStyle('display','inline');
	},
	onAjaxSuccess: function(response) {
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