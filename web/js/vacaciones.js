/************************************************************
	Evento de carga de la pagina
************************************************************/
window.addEvent('domready', function() {
	if($defined($('btnQuitarVacaciones'))){
		$('btnQuitarVacaciones').addEvent('click', function(e) {
			window.location = '?controlador=Opciones&accion=quitarVacaciones';
		});
	}
});