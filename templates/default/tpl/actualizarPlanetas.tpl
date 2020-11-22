<script type="text/javascript">
	//Anyadir o eliminar planetas de la lista desplegable
	<!-- BEGIN tEliminarPlaneta -->
	$('indexLstPlanetas').empty();
	var opt=new Element('option',{'value':'0','selected':'selected','html':'{_SELECCIONAPLANETA}...'});
	opt.inject($('indexLstPlanetas'));
	<!-- BEGIN tPlaneta -->
	var opt=new Element('option',{'value':'{DATOSPLANETALST}','label':'{PNOMBRELST}','html':'{PNOMBRELST}'});
	opt.inject($('indexLstPlanetas'));
	<!-- END tPlaneta -->
	menuPlanetas();
	<!-- END tEliminarPlaneta -->
	
	
	//Cambiar el planeta seleccionado si se ha perdido
	<!-- BEGIN tSeleccionado -->
	//Parseamos los datos del value
	var datosplaneta='{DATOSPLANETASEL}';
	var datos=datosplaneta.split('|',3);
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
			//Eliminamos el primer planeta de la lista
			$('indexLstPlanetas').getFirst('option').getNext('option').dispose();
			menuPlanetas();
			
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
	<!-- END tSeleccionado -->
</script>