//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Select de intercambiar
$('recursosSelCambioRecurso').addEvent('change', function(e) {
	if($('recursosSelCambioRecurso').selectedIndex==0)
		var indice=1;
	else
		var indice=0;
	$('recursosLblCambioRecurso').set('text',$('recursosSelCambioRecurso').options[indice].get('text')+' ');
	calcular();
	e.stop();
});

//Button de intercambiar
$('recursosBtnIntercambiar').addEvent('click', function(e) {
	//Comprobamos que no se intente intercambiar nada
	if($('recursosTxtCantidad').get('value')!=0){
		//Asiganmos el modo
		if($('recursosSelCambioRecurso').selectedIndex==0)
			var modo=1;
		else
			var modo=0;
		
		//Creamos la peticion de intercambio
		var reqInt = new Request.HTML({
				url: '?controlador=Recursos&accion=intercambiar&cantidad='+$('recursosTxtCantidad').get('value')+'&modo='+modo,
			onSuccess: function(html,texto) {
				mensaje('recursosDivErrorIntercambio',html);

				if (texto.getProperty('class') != 'error') {
					//Actualizamos los recursos
					if ($('recursosSelCambioRecurso').selectedIndex == 0) {
						indexRecursoPri = indexRecursoPri - parseInt($('recursosTxtCantidad').get('value'));
						indexRecursoSec = indexRecursoSec + parseInt($('recursosLblCambioCantidad').get('html'));
					}
					else {
						indexRecursoPri = indexRecursoPri + parseInt($('recursosLblCambioCantidad').get('html'));
						indexRecursoSec = indexRecursoSec - parseInt($('recursosTxtCantidad').get('value'));
					}
				}
				
				//Resetea el formulario de intercambio
				$('recursosTxtCantidad').set('value',0);
				calcular();
			}
		});
		//Enviamos la peticion
		reqInt.send();
	}
});

//Textbox de intercambiar
$('recursosTxtCantidad').addEvent('keyup', function(e) {
	calcular();
});
	
function calcular(){
	var cantidad=0;
	var valor=parseInt($('recursosTxtCantidad').get('value'), 10);
	var modo=$('recursosSelCambioRecurso').getSelected()[0].get('value');
	if(valor=='' || !validarNumero(valor)){
		cantidad=0;
	}
	else if(idRaza==1){
		if(modo==1)
			cantidad=Math.floor(valor*3/8);
		else
			cantidad=Math.floor(valor*8/3);
	}
	else if(idRaza==2){
		if(modo==1)
			cantidad=Math.floor(valor*2/9);
		else
			cantidad=Math.floor(valor*9/2);
	}
	else if(idRaza==3){
		if(modo==1)
			cantidad=Math.floor(valor*10/1);
		else
			cantidad=Math.floor(valor*1/10);
	}
	else if(idRaza==4){
		if(modo==1)
			cantidad=Math.floor(valor*3/8);
		else
			cantidad=Math.floor(valor*8/3);
	}
	else if(idRaza==5){
		if(modo==1)
			cantidad=Math.floor(valor*3/8);
		else
			cantidad=Math.floor(valor*8/3);
	}
	else if(idRaza==6){
		if(modo==1)
			cantidad=Math.floor(valor*2/9);
		else
			cantidad=Math.floor(valor*9/2);
	}
	else if(idRaza==7){
		if(modo==1)
			cantidad=Math.floor(valor*1/10);
		else
			cantidad=Math.floor(valor*10/1);
	}
	else if(idRaza==8){
		if(modo==1)
			cantidad=Math.floor(valor*2/9);
		else
			cantidad=Math.floor(valor*9/2);
	}
	
	//Aplicamos cargo por intercambio
	cantidad=Math.floor(cantidad*0.9);
	
	//Asignamos el valor
	$('recursosLblCambioCantidad').set('text',cantidad);
}