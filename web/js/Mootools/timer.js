/*************************************************************
 * Crear una cuenta atras usando clases mootools
*************************************************************/
var Timer = new Class({
    //Permite la inicializacion de la clase con opciones y la ejecucion de eventos
    //durante la ejecucion
    Implements: [Options, Events],

    //Opciones predeterminadas
    options: {
		/*Opciones Generales*/
        remainTime: 3600, //Tiempo que lleva actualmente (segundos que quedan para finalizar)
        text: 'Finished',
		onComplete: $empty,
	
		/*Opciones para mostrar barra de progreso*/
		bar: false, //MArca si se desea mostrar una barra de progreso en vez de un temporizador
		totalTime: false, //Tiempo total (segundos que durara en su totalidad)
		boxID: 'box',
		percentageID: 'percentage',
		displayID: 'display',
		displayText: false,
		speed: 1
    },
	
    //Constructor de la clase
    initialize: function(el, options) {
    	//Permite elegir el elemento ya sea con su id o con un objeto asignado a ese id $(el)
    	if($type(el)=='string')
    		this.element = $(el);
    	else
    		this.element = el;
    	
		this.progBar = false;
		this.setOptions(options);
		
		//Si se desea mostrar una barra en vez de un contador
		if(this.options.bar){
			//Creo la barra de progreso
			this.progBar = new dwProgressBar({
				container: this.element,
				boxID: this.options.boxID,
				percentageID: this.options.percentageID,
				displayID: this.options.displayID,
				startPercentage: ((this.options.remainTime/this.options.totalTime)-1)*-100,
				displayText: this.options.displayText,
				speed: this.options.speed
			});
			
			//Almaceno los datos a mostrar en el tip
			this.element.store('tip:title', 'Tiempo Restante');
			this.element.store('tip:text', this.sec2str(this.options.remainTime));
			
			//Genero el tip
			this.Tip = new Tips(this.element,{
			    showDelay: 0,
			    hideDelay: 0,
			    className: 'tip-container',
			    fixed:false,
			    offsets: {'x': 5, 'y': 5}
			});
		}
	
		//Empieza la cuenta atras
		this.start();
    },

    //Inicializando el temporizador y mostrandolo al usuario
    start: function() {
        if (this.timer) return this;
        
        this.decrease();
        this.element.setStyle('visibility', 'visible');
        this.timer = this.decrease.periodical(1000,this);
    },

    //Apagando el contador
    stop: function() {
        if (!this.timer) return this; //Si el temporizador ya esta eliminado, devolvemos el objeto
        this.timer = $clear(this.timer);//Eliminamos el temporizador
        
        return this; //Devuelve el objeto
    },

    //Para el temporizador
    toggle: function() {
        if(this.timer) this.stop();
        else this.start();
        return this;
    },
    
    //Para el contador y establece el nuevo temporizador
    reset: function(remain, total, fnComplete){    	
    	//Paramos el temporizador
    	this.stop();
    	
    	//Asignamos los nuevos tiempos
    	this.options.remainTime=remain;
    	this.options.totalTime=total;
    	
    	//Almaceno los datos a mostrar en el tip
		this.element.store('tip:title', 'Tiempo Restante');
		this.element.store('tip:text', this.sec2str(this.options.remainTime));
    	
    	//Asignamos el nuevo evento onComplete si corresponde
    	if(fnComplete!=null){
	    	this.removeEvents('complete');
	    	this.addEvent('complete', fnComplete);
    	}
    	//Volvemos a poner el contador en marcha
    	this.start();
    },

    //Decrementa el contador en 1 cada segundo
    //Cuando el contador llega a 0, se dispara el evento onComplete
    decrease: function() {
		//Se extrae el tiempo restante formateado
		remain = this.sec2str(this.options.remainTime);

		//Si se desea mostrar la barra, se calcula el porcentaje, se incrementa la barra y se actualiza el tooltip
		if(this.progBar)
			this.refreshBar(((this.options.remainTime/this.options.totalTime)-1)*-100, remain);
		//Si se desea mostrar el tiempo, se calculan las horas minutos y segundos, para mostrarse
		else
			this.element.set('text', remain);
		
		//Si el temporizador ha llegado a 0, paramos el contador y disparamos el evento de completado
		if(this.options.remainTime<=0){
			this.stop();
			this.fireEvent('complete');
		}
		
		//Decrementamos el tiempo restante en un segundo
		this.options.remainTime--;
    },

    //Pasa el tiempo en segundos a el formato HH:MM:SS
    sec2str: function(time){
		hours=parseInt(time/3600);
		if(hours<10)
			hours="0"+hours;
	
		minutes=parseInt((time-hours*3600)/60);
		if(minutes<10)
			minutes="0"+minutes;
	
		seconds=parseInt((time-hours*3600)-(minutes*60));
		if(seconds<10)
			seconds="0"+seconds;
	
		return hours+":"+minutes+":"+seconds;
    },
    
    refreshBar: function(percentage, counter){
    	//Actualizo el porcentaje de la barra
		this.progBar.set(percentage);
		
		//Actualizo el contador del tooltip
		this.element.store('tip:text', counter);
		
		//Actualizo el tooltip de la barra de forma dinamica, para mostrar la cuenta atras
		if($defined(this.Tip.textElement))
			this.Tip.textElement.set('html', counter);
    },
    
    destroy: function(){    	
    	//Elimino los eventos
    	this.stop();
    	this.removeEvents();
        
        //Si tenemos un temporizador de tipo barra, lo limpiamos
        if(this.progBar){
        	//Elimino las clases progBar y Tip
        	this.progBar.destroy();
        	this.Tip.destroy();
        	
        	//Libero la memoria de progBar y de Tip
	        this.progBar=null;
	        this.Tip=null;
        }
    }
});