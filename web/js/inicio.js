/************************************************************
	Variables globales
************************************************************/
var Alerta;
//Timers de construcciones
var tiempoConsNaves;
var tiempoConsTropas;
var tiempoConsDefensas;
//Recolector de basura
var garbage = new Garbage();
//Mensajes
var mensajesVisible=false;
var mensajesSeccion='entrada';
var mensajesDestino='';
var comprobarMensajesNuevos;
//Comercios
var comerciosVisible=false;
//Especiales
var especialesVisible=false;
var barraEspeciales;
//Galaxia
var galaxiasGalaxiaSel=0;
var galaxiasSectorSel=0;
var galaxiasCuadranteSel=0;
//Scroll
var especialesScroll;
var preloaderScroll;
var mensajesScroll;
var comerciosScroll;
//Datos inicio
var recargar=true;
var controlador='Index';
var accion='principal';

/************************************************************
	Evento de carga de la pagina
************************************************************/
window.addEvent('domready', function() {
	/************************************************************
		Alertas
	 ************************************************************/
	Alerta = new SexyAlertBox();
		
	/************************************************************
		Tooltips
	 ************************************************************/
	var tips=new Tips('.tooltip',{
	    showDelay: 0,
	    hideDelay: 0,
	    className: 'tip-container',
	    fixed:false,
	    offsets: {'x': 5, 'y': 5}
	});

	$$('.tooltip').store('tip:text', '');	//Limpiamos la URL del tip
	
	/************************************************************
		Preloader, Mensajes
	 ************************************************************/
	preloaderScroll = new ScrollSidebar('preloader',{speed:400});
	mensajesScroll = new ScrollSidebar('mensajesDivMensajes',{speed:400});
	comerciosScroll = new ScrollSidebar('comerciosDivComercios',{speed:400});
	
	/************************************************************
		Eventos que necesitan recargarse
	************************************************************/
	menuPlanetas();
	indexListaPlanetas();
	indexCambiarNombrePlaneta();
	
	/************************************************************
		Boton de salida	
	************************************************************/
	//Capturamos el evento del boton de salida
	$('indexBtnSalir').addEvent('mouseover', function(e) {
		$('indexImgSalir').set('src',$('indexImgSalir').get('src').substr(0,$('indexImgSalir').get('src').length-5)+'2.png');
	});

	$('indexBtnSalir').addEvent('mouseout', function(e) {
		$('indexImgSalir').set('src',$('indexImgSalir').get('src').substr(0,$('indexImgSalir').get('src').length-5)+'1.png');
	});
	
	/************************************************************
		Enlaces menu
	************************************************************/
	$$('a.menu').each(function(el){
		el.addEvent('click', function(e) {
			cargarSeccion(el.get('href'), $('indexDivCentro'), 'jsmodulo','','');
			e.stop();
		});
	});
	
	//Boton de mensajes
	$$('.indexBtnMensajes').each(function(el){
		el.addEvent('click', function(e) {
			//Si estan ocultos los recargamos si no los ocultamos
			if (!mensajesVisible) {
				//Creamos la peticion
				var req = new Request.HTML({
					url: el.get('href'),
					method: 'post',
					evalScripts: true,
					onRequest: function(){
						//Mostramos la precarga
						$('preloader').setStyle('display', 'inline');
					},
					onComplete: function(html){
						//Ocultamos el mensaje de precarga
						$('preloader').setStyle('display', 'none');
						
						//Limpiamos el div
						$('mensajesDivMensajes').empty();
						
						//Metemos el html
						$('mensajesDivMensajes').adopt(html);
						include_once('/js/Mensajes.js', 'jsmensajes');
						
						//Mostramos los mensajes
						$('mensajesDivMensajes').tween('display', 'block');
						mensajesVisible=true;
					},
					onFailure: function(){
						//Ocultamos el mensaje de carga
						$('preloader').setStyle('display', 'none');
					}
				});
				//Enviamos la peticion
				req.send();
			}
			else{
				//Ocultamos los mensajes
				$('mensajesDivMensajes').tween('display', 'none');
				mensajesVisible=false;
			}
			e.stop();
		});
	});
	
	//Boton de especiales
	barraEspeciales=new Fx.Slide('especialesDivEspeciales').hide();
	
	$('indexBtnEspeciales').addEvent('click', function(e) {
		//Si estan ocultos los recargamos si no los ocultamos
		if (!especialesVisible) {
			//Creamos la peticion
			var req = new Request.HTML({
				url: $('indexBtnEspeciales').get('href'),
				method: 'post',
				evalScripts: true,
				onRequest: function(){
					//Mostramos la precarga
					$('preloader').setStyle('display', 'inline');
				},
				onComplete: function(html){
					//Ocultamos el mensaje de precarga
					$('preloader').setStyle('display', 'none');
					
					//Limpiamos el div
					$('especialesDivEspeciales').empty();
					
					//Hacemos visible el cuadro de especiales
					$('especialesDivEspeciales').setStyle('display', 'block');
					
					//Metemos el html
					$('especialesDivEspeciales').adopt(html);
					include_once('/js/Especiales.js', 'jsespeciales');
					
					//Desocultamos la barra de especiales
					$('especialesDivEspeciales').setStyles({ 'visibility': 'visible'}); 
					
					//Mostramos la barra de especiales
					barraEspeciales.slideIn();
					
					//Hacemos que se desplace con el scroll
					//especialesScroll=new ScrollSidebar('especialesDivEspeciales',{speed:0});
					
					especialesVisible=true;
				},
				onFailure: function(){
					//Ocultamos el mensaje de carga
					$('preloader').setStyle('display', 'none');
				}
			});
			//Enviamos la peticion
			req.send();
		}
		else{
			//Ocultamos la barra de especiales
			barraEspeciales.slideOut();
			especialesVisible=false;
			garbage.clean('especial');
		}
			
		e.stop();
	});
	
	//Evento del boton Ver planeta
	$('indexBtnVerPlaneta').addEvent('click', function(e) {
		galaxiasGalaxiaSel=$('indexBtnVerPlaneta').getParent().getFirst('.idGalaxia').value;
		galaxiasSectorSel=$('indexBtnVerPlaneta').getParent().getFirst('.idSector').value;
		galaxiasCuadranteSel=$('indexBtnVerPlaneta').getParent().getFirst('.idCuadrante').value;

		cargarSeccion('?controlador=Galaxias&accion=galaxias&idGalaxia='+galaxiasGalaxiaSel+'&idSector='+galaxiasSectorSel+'&idCuadrante='+galaxiasCuadranteSel, $('indexDivCentro'), 'jsmodulo','','');
		
		e.stop();
	});
	
	/************************************************************
		Recursos
	************************************************************/
	var incRecursos = function() { 
		indexRecursoPri=indexRecursoPri+indexRecursoPriPro;
		indexRecursoSec=indexRecursoSec+indexRecursoSecPro;
		$$('.recursoPriCant').each(function(el){
			el.set('text', parseInt(indexRecursoPri));
		});
		$$('.recursoSecCant').each(function(el){
			el.set('text', parseInt(indexRecursoSec));
		});
		$$('.energiaCant').each(function(el){
			el.set('text', parseInt(indexRecursoEne));
		});
	};
	
	/************************************************************
	 	Mensajes nuevos
	************************************************************/
	if(parseInt($('mensajesSpanNuevos').get('text'))>0)
		$('mensajesDivAviso').tween('display', 'block');
		
	comprobarMensajesNuevos = function() { 
		//Creamos la peticion
		var req = new Request({
			url: '?controlador=Index&accion=comprobarMensajes',
			method: 'post',
			evalScripts: true,
			onComplete: function(numMensajes){
				//Si han cambiado el numero de mensajes y son diferentes de 0
				if (numMensajes > 0 && numMensajes!=$('mensajesSpanNuevos').get('text') && mensajesSeccion=='entrada') {
					$('mensajesSpanNuevos').empty();
					$('mensajesSpanNuevos').set('text',numMensajes);
						
					//Si el panel de mensajes esta cerrado
					if ($('mensajesDivMensajes').getStyle('display') == 'none' || mensajesSeccion!='entrada') {
						$('mensajesDivAviso').tween('display', 'block');
					}
					else{ //Si esta abierto lo refrescamos
						if($defined($('mensajesBtnEntrada')))
							$('mensajesBtnEntrada').fireEvent('click');
					}
				}
			}
		}).send();
	};
	
	//Incrementamos los recursos cada segundo
	incRecursos.periodical(1000);
	
	//Comprobamos mensajes nuevos cada 3 min
	comprobarMensajesNuevos.periodical(180000);
	//comprobarMensajesNuevos.periodical(20000);
	
	//Incluimos el fichero js de construcciones
	include_once('/js/Index/construcciones.js','jsConstrucciones');
	
	//Incluimos el fichero js del modulo principal
	include_once('/js/Index.js','jsmodulo');
});


/************************************************************
	Lista de planetas
************************************************************/
function indexListaPlanetas(){
	$('indexLstPlanetas').addEvent('change', function selPlaneta(e) {
		if($('indexLstPlanetas').getSelected()[0].value!=0){
			//Guardamos la opcion que actualmente se esta mostrando
			var opcion=new Element('option', {value: indexIdGalaxiaSel+'|'+indexIdPlanetaSel+'|'+$('indexImgPlaneta').src,text: $('indexDivnombrePlaneta').innerHTML});
			//Parseamos los datos del value
			var datos=$('indexLstPlanetas').getSelected()[0].get('value').split('|',3);
			//Creamos la peticion
			var req = new Request.HTML({
					url:'?controlador=Index&accion=planetaDatos&idGalaxia='+datos[0]+'&idPlaneta='+datos[1],
					method: 'get',
				onRequest: function(){
					//Limpiamos el div adecuado
					var preloader=new Element('div', {'class': 'preloaderPlaneta'});
					$('indexDivPlanetaDatos').set('html','');
					preloader.inject($('indexDivPlanetaDatos'));
				},
				onComplete: function(html) {
					//Eliminamos el seleccionado actualmente y metemos el anterior que hemos guardado
					$('indexLstPlanetas').getSelected()[0].destroy();
					//$('indexLstPlanetas').selectedIndex=0;//Posiblemente sea opcional (lo es en firefox)
					opcion.inject($('indexLstPlanetas'));
					//Limpiamos el div
					$('indexDivPlaneta').empty();

					//Metemos el html
					$('indexDivPlaneta').adopt(html);
					
					//Evento del boton Ver planeta
					$('indexBtnVerPlaneta').addEvent('click', function(e) {
						galaxiasGalaxiaSel=$('indexBtnVerPlaneta').getParent().getFirst('.idGalaxia').value;
						galaxiasSectorSel=$('indexBtnVerPlaneta').getParent().getFirst('.idSector').value;
						galaxiasCuadranteSel=$('indexBtnVerPlaneta').getParent().getFirst('.idCuadrante').value;
				
						cargarSeccion('?controlador=Galaxias&accion=galaxias&idGalaxia='+galaxiasGalaxiaSel+'&idSector='+galaxiasSectorSel+'&idCuadrante='+galaxiasCuadranteSel, $('indexDivCentro'), 'jsmodulo','','');
						
						e.stop();
					});
					
					//Limpiamos las graficas de las construcciones actuales
					garbage.clean('NavesBarra');
					garbage.clean('SoldadosBarra');
					garbage.clean('DefensasBarra');
					
					//Recargamos las construcciones
					cargarSeccion('?controlador=Index&accion=construccionPlaneta',$('indexDivConstruccionPlaneta'),'jsconstrucciones','Index','construcciones');
					
					//Recargamos los eventos
					indexCambiarNombrePlaneta();
					
					//Recargamos la lista
					menuPlanetas();
					
					//Si es necesario recargamos el modulo
					if(recargar)
						cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
				},
				onFailure: function() {
					$('indexDivPlaneta').set('text', 'Error al cargar.');
				}
			});
			//Enviamos la peticion
			req.send();
		}
	});
}

/************************************************************
	Cambio de nombre planeta
************************************************************/
Element.Events.keyenter = {
	base: 'keyup',
	condition: function(e){
		return e.key=='enter';
	}
};

function indexCambiarNombrePlaneta(){
	//Cuadro de texto
	$('indexDivnombrePlaneta').addEvent('click', function(e){
			nuevoTextBox('cambiarNombre', indexNombreSel, 13, null,null,'indexDivnombrePlaneta', true)});
	
	//Icono de editar
	$('indexDivnombrePlaneta').addEvent('mouseover', function (e) {
		var icono=new Element('img', {
		    'src': '/images/iconos/editar.png',
		    'alt': 'Edit',
		    'id': 'indexImgEditar',
		    'styles': {
	        	'margin-left': '3px'
	    	}
		});
		icono.inject($('indexDivnombrePlaneta'));
	});
	
	$('indexDivnombrePlaneta').addEvent('mouseout', function (e) {
		if($defined($('indexImgEditar')))
			$('indexImgEditar').destroy();
	});
}

//Creamos la peticion
function indexEnviarNombrePlaneta(nombre,nombreViejo){
	if(nombre!=nombreViejo){
		var req = new Request.HTML({
			url:'?controlador=Index&accion=cambiarNombre&idGalaxia='+indexIdGalaxiaSel+'&idPlaneta='+indexIdPlanetaSel+'&nombre='+nombre,
			method: 'get',
			onComplete: function(html,texto) {
				//Si no se han producido errores
				if (texto.getProperty('class') != 'error') {
					//Limpiamos el div
					$('indexDivnombrePlaneta').set('text', '');
					
					//Metemos el html
					$('indexDivnombrePlaneta').adopt(html);
					
					//Actualizamos el js
					indexNomCompletoSel=$('indexDivnombrePlaneta').get('text');
					
					//Si es necesario recargamos el modulo
					if(recargar)
						cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
				}
				else{
					Alerta.info(texto.get('text'));
				}
			}
		});
		req.send();
	}
	else{
		$('indexDivnombrePlaneta').set('text',indexNomCompletoSel);
	}
}

function menuPlanetas() {
	//Limpiamos el menu
	if($defined($('divlistaplanetas')))
		$('divlistaplanetas').destroy();
	if($defined($('layer')))
		$('layer').destroy();
	
	if($('indexLstPlanetas').getChildren().length > 1){
		var planetas = $$('#indexLstPlanetas option');
		var numPlanetas = planetas.length;
		
		var div = new Element('div', {'id': 'divlistaplanetas'});
		
		var i=0;
		planetas.each(function(el){
			if(i>0){
				var indice=i;
				var datos=planetas[i].get('value').split('|');
				var planeta = new Element('div', {'id': 'indexDivPlaneta'+(i+1),
					'events': {
				        'click': function(){
							$('indexLstPlanetas').selectedIndex=indice;
							$('indexLstPlanetas').fireEvent('change');
				    	}
				    }
				});
				var img = new Element('img', {'src': datos[2], 'alt': planetas[i].get('text'), 'class': 'imagenplanetapeq'});
				var txt = new Element('span', {'styles':{'margin-left:': '20px'}, 'text': planetas[i].get('text')});
				
				img.inject(planeta);
				txt.inject(planeta);
				planeta.inject(div);
			}
			i++;	
		});
	
		div.inject($('indexLstPlanetas').getParent());
		
		var layer = new Element('div', {'id': 'layer'});
		layer.inject($('indexLstPlanetas').getParent());
		
		$('layer').addEvent('click', function (e) {
			$('divlistaplanetas').setStyle('display','block');
			document.addEvent('click', function (e) {
				document.addEvent('click', function (e) {
					$('divlistaplanetas').setStyle('display','');
					document.removeEvents('click');
				});
			});
		});
	}
}