/************************************************************
	Construcciones
 ************************************************************/
//Limpiamos los datos del modulo anterior
garbage.clean('construcciones');

if($('indexDivConsNaves').getStyle('display')=='block'){
	new Element('div', {'id': 'indexDivContNave'}).inject($('indexDivConsNaves'));
	var tiempoRestante=$('indexDivConsNaves').getFirst('.tiempoRestante').value;
	var tiempoTotal=$('indexDivConsNaves').getFirst('.tiempoTotal').value;
	garbage.regInstance(
		new Timer('indexDivContNave', {'bar': true, 'remainTime': tiempoRestante,
			'totalTime': tiempoTotal,
			'boxID': 'boxindexDivContNave',
			'percentageID': 'percentageindexDivContNave',
			'displayID': 'displayindexDivContNave',
			onComplete: function(){
				//Elimino el timer
				this.destroy();
				
				//Oculto/Elimino el html no necesario
				$('indexDivConsNaves').empty();
				$('indexDivConsNaves').setStyle('display','none');
				
				//En caso de no haber construcciones mostramos el cartel
				if($('indexDivConsTropas').getStyle('display')=='none' && $('indexDivConsNaves').getStyle('display')=='none' && $('indexDivConsDefensas').getStyle('display')=='none'){
					$('indexDivConstrucciones').setStyle('display','none');
					$('indexDivNoConstrucciones').setStyle('display','block');
				}
				
				//Si es necesario recargamos el modulo
				if(recargar)
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
			}
		}),
		'construcciones'
	);
}
if($('indexDivConsTropas').getStyle('display')=='block'){
	new Element('div', {'id': 'indexDivContTropa'}).inject($('indexDivConsTropas'));
	var tiempoRestante=$('indexDivConsTropas').getFirst('.tiempoRestante').value;
	var tiempoTotal=$('indexDivConsTropas').getFirst('.tiempoTotal').value;
	garbage.regInstance(
		new Timer('indexDivContTropa', {'bar': true, 'remainTime': tiempoRestante,
			'totalTime': tiempoTotal,
			'boxID': 'boxindexDivContTropa',
			'percentageID': 'percentageindexDivContTropa',
			'displayID': 'displayindexDivContTropa',
			onComplete: function(){
				//Elimino el timer
				this.destroy();
			
				//Oculto/Elimino el html no necesario
				$('indexDivConsTropas').empty();
				$('indexDivConsTropas').setStyle('display','none');
				
				//En caso de no haber construcciones mostramos el cartel
				if($('indexDivConsTropas').getStyle('display')=='none' && $('indexDivConsNaves').getStyle('display')=='none' && $('indexDivConsDefensas').getStyle('display')=='none'){
					$('indexDivConstrucciones').setStyle('display','none');
					$('indexDivNoConstrucciones').setStyle('display','block');
				}
				
				//Si es necesario recargamos el modulo
				if(recargar)
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
			}
		}),
		'construcciones'
	);
}
if($('indexDivConsDefensas').getStyle('display')=='block'){
	new Element('div', {'id': 'indexDivContDefensa'}).inject($('indexDivConsDefensas'));
	var tiempoRestante=$('indexDivConsDefensas').getFirst('.tiempoRestante').value;
	var tiempoTotal=$('indexDivConsDefensas').getFirst('.tiempoTotal').value;
	garbage.regInstance(
		new Timer('indexDivContDefensa', {'bar': true, 'remainTime': tiempoRestante,
			'totalTime': tiempoTotal,
			'boxID': 'boxindexDivContDefensa',
			'percentageID': 'percentageindexDivContDefensa',
			'displayID': 'displayindexDivContDefensa',
			onComplete: function(){
				//Elimino el timer
				this.destroy();
			
				//Oculto/Elimino el html no necesario
				$('indexDivConsDefensas').empty();
				$('indexDivConsDefensas').setStyle('display','none');
				
				//En caso de no haber construcciones mostramos el cartel
				if($('indexDivConsTropas').getStyle('display')=='none' && $('indexDivConsNaves').getStyle('display')=='none' && $('indexDivConsDefensas').getStyle('display')=='none'){
					$('indexDivConstrucciones').setStyle('display','none');
					$('indexDivNoConstrucciones').setStyle('display','block');
				}
				
				//Si es necesario recargamos el modulo
				if(recargar)
					cargarSeccion('?controlador='+controlador+'&accion='+accion, $('indexDivCentro'), 'jsmodulo','','');
			}
		}),
		'construcciones'
	);
}