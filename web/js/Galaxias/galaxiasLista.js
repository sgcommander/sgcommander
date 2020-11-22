//Limpiamos los modulos cargados anteriormente
garbage.clean();

/* JS para los planetas */
include_once('/js/Galaxias/cuadrante.js','jscuadrante');

/* posicion actual */
if(galaxiasGalaxiaSel==0)
	galaxiasGalaxiaSel=$('galaxiasSelIdGalaxia').getSelected()[0].value;
if(galaxiasSectorSel==0)
	galaxiasSectorSel=$('galaxiasSelIdSector').getSelected()[0].value;
if(galaxiasCuadranteSel==0)
	galaxiasCuadranteSel=$('galaxiasSelIdCuadrante').getSelected()[0].value;

/* si es midway desactivamos cuadrantes y sectores */
if(galaxiasGalaxiaSel==4){
	$('galaxiasSelIdSector').fade('hide');
	$('galaxiasSelIdCuadrante').fade('hide');
}
	
//Seleccion de galaxia
if ($defined($('galaxiasSelIdGalaxia'))) {
	$('galaxiasSelIdGalaxia').addEvent('change', function(e){
		galaxiasGalaxiaSel = $('galaxiasSelIdGalaxia').getSelected()[0].value;
		//Creamos la peticion
		var req = new Request.HTML({
			url: '?controlador=Galaxias&accion=elegirGalaxia&idGalaxia=' + galaxiasGalaxiaSel,
			method: 'post',
			evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display', 'inline');
			},
			onComplete: function(html){
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display', 'none');
				
				//Metemos el html
				$('galaxiasSelIdSector').set('html', '');
				$('galaxiasSelIdSector').adopt(html);
				
				//Cargamos el primer cuadrante y el primer sector
				cargarSector(1);
				cargarCuadrante(1);
				
				//Si es midway desactivamos los controles si no los activamos
				if(galaxiasGalaxiaSel==4){
					$('galaxiasSelIdSector').fade(0);
					$('galaxiasSelIdCuadrante').fade(0);
				}
				else{
					$('galaxiasSelIdSector').fade(1);
					$('galaxiasSelIdCuadrante').fade(1);
				}
			},
			onFailure: function(){
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display', 'none');
			}
		});
		//Enviamos la peticion
		req.send();
	});
}

//Seleccion de sector
if ($defined($('galaxiasSelIdSector'))) {
	$('galaxiasSelIdSector').addEvent('change', function(e){
		galaxiasSectorSel = $('galaxiasSelIdSector').getSelected()[0].value;
		cargarSector(galaxiasSectorSel);
		cargarCuadrante(1);
		e.stop;
	});
}

//Seleccion de cuadrante
if ($defined($('galaxiasSelIdCuadrante'))) {
	$('galaxiasSelIdCuadrante').addEvent('change', function(e){
		galaxiasCuadranteSel = $('galaxiasSelIdCuadrante').getSelected()[0].value;
		cargarCuadrante(galaxiasCuadranteSel);
		e.stop;
	});
}

//Funcion que carga un cuadrante
function cargarCuadrante(idCuadrante){
	//Creamos la peticion
	var req = new Request.HTML({
		url: '?controlador=Galaxias&accion=cuadrante&idCuadrante='+idCuadrante,
		method: 'post',
		evalScripts: true,
		onRequest: function(){
			//Mostramos la precarga
			$('preloader').setStyle('display','inline');
		},
		onComplete: function(html) {
			//Ocultamos el mensaje de precarga
			$('preloader').setStyle('display','none');
			
			//Vaciamos el cuadrante
			$('galaxiasDivCuadrante').set('html','');
			
			//En caso de no seleccionar ninguno mostramos la imagen anterior
			$('galaxiasDivCuadrante').adopt(html);
				
			/* JS para los planetas */
			include_once('/js/Galaxias/cuadrante.js','jscuadrante');
		},
		onFailure: function() {
			//Ocultamos el mensaje de carga
			$('preloader').setStyle('display','none');
		}
	});
	//Enviamos la peticion
	req.send();
}

//Funcion que carga un sector
function cargarSector(idSector){
	//Creamos la peticion
	var req = new Request.HTML({
		url: '?controlador=Galaxias&accion=elegirSector&idSector='+idSector,
		method: 'post',
		evalScripts: true,
		onRequest: function(){
			//Mostramos la precarga
			$('preloader').setStyle('display','inline');
		},
		onComplete: function(html) {
			//Ocultamos el mensaje de precarga
			$('preloader').setStyle('display','none');
			
			//Metemos el html
			$('galaxiasSelIdCuadrante').set('html', '');
			$('galaxiasSelIdCuadrante').adopt(html);
		},
		onFailure: function() {
			//Ocultamos el mensaje de carga
			$('preloader').setStyle('display','none');
		}
	});
	//Enviamos la peticion
	req.send();
}

