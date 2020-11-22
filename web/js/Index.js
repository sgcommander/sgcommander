//Limpiamos los modulos cargados anteriormente
garbage.clean();

//Comprobamos si hay mensajes nuevos
comprobarMensajesNuevos();

//Contador de la mejora
if($defined($('indexTiempoMejora'))){
	garbage.regInstance(
			new Timer($('indexTiempoMejora'),
				{remainTime: parseInt($('indexTiempoMejora').get('text')),
				text: 'Terminado',
				onComplete: function(){
					//Parche: Limpiamos el modulo antes de recargarlo para evitar sobrecarga
					garbage.clean();
				
					(function(){
						cargarSeccion('?controlador=Index&accion=principal', $('indexDivCentro'), 'jsmodulo','','');
					}).delay(500);
				}
			})
		);
}

//Inicializo los nuevos contadores
$$('.cuentaAtrasMision').each(function(item, index){
	if(item.get('text')!='-'){
		garbage.regInstance(
				new Timer(item,
					{remainTime: parseInt(item.get('text')),
					text: 'Terminado',
					onComplete: function(){
						//Parche: Limpiamos el modulo antes de recargarlo para evitar sobrecarga
						garbage.clean();
						
						(function(){
							cargarSeccion('?controlador=Index&accion=principal', $('indexDivCentro'), 'jsmodulo','','');
						}).delay(500);
					}
				})
			);
	}
});

//Anadimos el acordeon de misiones
var misionesAcc = new Accordion(
		$$('.misionBtnVer'), 
		$$('.misionUnidades'),
		{
			display: -1,
			opacity: false,
			alwaysHide: true,
			onActive: function(toggler, element){
				toggler.set('src','/images/iconos/-.png');
			},
			onBackground: function(toggler, element){
				toggler.set('src','/images/iconos/+.png');
			}
		}
);

//Enlaces de ver planeta
$$('a.enlacePlaneta').each(function(item, index){
	item.addEvent('click', function(e) {
		e.stop();
	
		cargarSeccion(item.get('href'), $('indexDivCentro'), 'jsmodulo','','');
	});
});

//Arreglo para que no se produzca un salto en la primera carga
$$('.misionUnidades').each(function(item, index){
	item.setStyle('visibility','visible');
});

//Array de botones de regresar
$$('.btnRegresar').each(function(item, index){
	item.removeEvents();
	item.addEvent('click', function(e) {
		e.stop();
		//Cancelamos la mision
		var idMision=item.getParent().getParent().getFirst('.idMision').get('value');
		//Creamos la peticion
		var req = new Request.HTML({
				url:'?controlador=Misiones&accion=regresar&idMision='+idMision,
				method: 'post',
				evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display','inline');
			},
			onComplete: function(html) {
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display','none');
				
				//Recargamos el modulo principal
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
});

//Array de botones de regresar
var nuevaGalaxiaDestino=0;
var nuevaPlanetaDestino=0;
var nuevaTipoMision=0;
var nuevaVelocidad=0;

$$('.btnNuevaMision').each(function(item, index){
	item.removeEvents();
	item.addEvent('click', function(e) {
		var idMision=item.getParent().getParent().getFirst('.idMision').get('value');
		cargarSeccion('?controlador=Misiones&accion=mision&idMision='+idMision, $('indexDivCentro'), 'jsmodulo','','');
	});
});

$$('.principalBtnVerPlaneta').each(function(item, index){
	item.removeEvents();
	item.addEvent('click', function(e) {
		e.stop();
		galaxiasGalaxiaSel=item.getParent().getFirst('.idGalaxia').value;
		galaxiasSectorSel=item.getParent().getFirst('.idSector').value;
		galaxiasCuadranteSel=item.getParent().getFirst('.idCuadrante').value;

		cargarSeccion('?controlador=Galaxias&accion=galaxias&idGalaxia='+galaxiasGalaxiaSel+'&idSector='+galaxiasSectorSel+'&idCuadrante='+galaxiasCuadranteSel, $('indexDivCentro'), 'jsmodulo','','');
		
		e.stop();
	});
});

/************************************************************
	Construcciones
************************************************************/
//Limpiamos los datos del modulo anterior
garbage.clean('construccionesCentro');

//Naves
$$('.principalDivConsNaves').each(function(item, index){
	if(item.getStyle('display')=='block'){
		var timer=new Element('div').inject(item);
		var tiempoRestante=item.getFirst('.tiempoRestante').value;
		var tiempoTotal=item.getFirst('.tiempoTotal').value;
		garbage.regInstance(
			new Timer(timer, {'bar': true, 'remainTime': tiempoRestante,
				'totalTime': tiempoTotal,
				'boxID': 'boxindexDivContNave'+index,
				'percentageID': 'percentageindexDivContNave'+index,
				'displayID': 'displayindexDivContNave'+index,
				onComplete: function(){
					//Oculto/Elimino el html no necesario
					item.empty();
					item.setStyle('display','none');

					//Si es necesario recargamos el modulo
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
					
					//Elimino el timer
					this.destroy();
				}
			})
		);
	}
});

//Tropas
$$('.principalDivConsTropas').each(function(item, index){
	if(item.getStyle('display')=='block'){
		var timer=new Element('div').inject(item);
		var tiempoRestante=item.getFirst('.tiempoRestante').value;
		var tiempoTotal=item.getFirst('.tiempoTotal').value;
		garbage.regInstance(
			new Timer(timer, {'bar': true, 'remainTime': tiempoRestante,
				'totalTime': tiempoTotal,
				'boxID': 'boxindexDivContNave'+index,
				'percentageID': 'percentageindexDivContNave'+index,
				'displayID': 'displayindexDivContNave'+index,
				onComplete: function(){
					//Oculto/Elimino el html no necesario
					item.empty();
					item.setStyle('display','none');
					
					//Si es necesario recargamos el modulo
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
					
					//Elimino el timer
					this.destroy();
				}
			})
		);
	}
});

//Defensas
$$('.principalDivConsDefensas').each(function(item, index){
	if(item.getStyle('display')=='block'){
		var timer=new Element('div').inject(item);
		var tiempoRestante=item.getFirst('.tiempoRestante').value;
		var tiempoTotal=item.getFirst('.tiempoTotal').value;
		garbage.regInstance(
			new Timer(timer, {'bar': true, 'remainTime': tiempoRestante,
				'totalTime': tiempoTotal,
				'boxID': 'boxindexDivContDefensa'+index,
				'percentageID': 'percentageindexDivContDefensa'+index,
				'displayID': 'displayindexDivContDefensa'+index,
				onComplete: function(){
					//Oculto/Elimino el html no necesario
					item.empty();
					item.setStyle('display','none');

					//Si es necesario recargamos el modulo
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
					
					//Elimino el timer
					this.destroy();
				}
			})
		);
	}
});

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


//Ocultamos el mensaje de precarga
$('preloader').setStyle('display','none');