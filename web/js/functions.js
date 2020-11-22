/************************************************************
	Includes
************************************************************/
function include(file_path,id){
	var script = Asset.javascript(file_path,{id: id});
}

function include_once(file_path,id){
	//Si ya hay un js con ese id cargado lo destruimos
	if($defined($(id)))
		$(id).destroy();
		
	//Lo incluimos
	include(file_path,id);
}

/************************************************************
	Cargador de secciones
************************************************************/
//Funcion que carga la seccion
function cargarSeccion(url, div, idasset, modulo, archivojs){
	//Creamos la peticion
	var req = new Request.HTML({
			url:url,
			method: 'post',
			evalScripts: true,
		onRequest: function(){
			//Mostramos la precarga
			$('preloader').setStyle('display','inline');
		},
		onComplete: function(html) {
			//Ocultamos el mensaje de precarga
			$('preloader').setStyle('display','none');
			
			//Analytics
			_gaq.push(['_trackPageview', url]);
			
			if(div!='' && $defined(div)){
				//Limpiamos el div
				div.empty();
				
				//Metemos el html
				div.adopt(html);
			
				//Incluimos el archivo js de la seccion
				//con include_once para que se ejecute con ASSET
				if(idasset!=''){
					if(archivojs=='' && modulo=='')
						include_once('/js/'+controlador+'.js',idasset);
					else if(modulo=='')
						include_once('/js/'+archivojs+'.js',idasset);
					else
						include_once('/js/'+modulo+'/'+archivojs+'.js',idasset);
				}
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
}

/************************************************************
	Creador de textbox
************************************************************/
function nuevoTextBox(id, valor, longitud, keyenter, blur, divDestino, limpiar) {
	//Ponemos el valor por defecto de limpiar a true
	limpiar = limpiar || true;
	
	var textbox=new Element('input', {
	    'type': 'text',
	    'id': id,
	    'value': valor,
	    'styles': {
	        'height': longitud+'px'
	    },
	    'events': {
	        'keyenter': function(){
	    			indexEnviarNombrePlaneta(textbox.get('value'),indexNombreSel);
	    	},
	    	/* Si haces blur y keyenter se envia la consulta dos veces*/
	    	'blur': function(){
	    		$('indexDivnombrePlaneta').set('text',indexNomCompletoSel);
	    	}
	    }
	});
	
	if(limpiar)
		$(divDestino).set('text','');
	textbox.inject($(divDestino));
	textbox.focus();
}

/************************************************************
	Funcion que muestra mensajes de informacion y error en los modulos
************************************************************/
//Funcion que carga un mensaje
function mensaje(div, html){
	if($defined($(div))){
		//Limpiamos el div
		$(div).setStyle('display', 'block');
		$(div).set('text', '');
		$(div).fade('show');
		$(div).adopt(html);
		
		
		//Al rato limpiamos el div
		(function(){
			if($defined($(div))){
				$(div).set('tween',{
					duration: 250,
					onComplete: function(){
						if($defined($(div)) && $(div).getStyle('display')!='none'){
							$(div).tween('display', 'none');
						}	
					}
				});
				$(div).tween('opacity', 0);
				//$(div).tween(0);
			}
		}).delay(3000);
	}
}
	
/*************************************************************
 * Validador de numeros
*************************************************************/
function validarNumero(numero){
	return /^([0-9])*$/.test(numero);
}


