//Integrando las funciones destroy a clases usadas en mootools que no lo tienen

//Clase Tips
Tips.implement({
    destroy: function(){
		 this.hide(); //Ocultamos el tip en caso de que este mostrandose
	     this.tip.destroy();//Elimino el html del tip
    }
});