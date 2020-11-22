/*************************************************************
 * Recolector de basura.
 * 
 * Se registran los datos a eliminar, ya sea codigo
 * html (elements) o variables/instancias (instance).
 * 
 * Los objetos pasados a las funciones de registro, deben
 * ser del tipo:
 * 	En elementos:
 * 		- mod: nombreDelModulo (debe ser null si quieres
 * 				que cualquier otro modulo lo pueda limpiar).
 * 		- data: identificador del elemento o su objeto.
 * 
 *  En varaibles/instancias:
 * 		- mod: nombreDelModulo (debe ser null si quieres
 * 				que cualqueir otro modulo lo pueda limpiar).
 * 		- data: referencia a la variable a eliminar.
*************************************************************/
var Garbage = new Class({
    //Constructor de la clase
    initialize: function() {
		this.info = {'element': [], 'instance': []};//Genero el vector inicial
    },
    
    regElement: function(value, module){
    	this.info.element.include({'mod' : module, 'data': value});
    },
    
    regInstance: function(value, module){
    	this.info.instance.include({'mod' : module, 'data': value});
    },

    clean: function(modulo){
    	//alert('Limpiando el modulo: ' + modulo + '\nHay "'+ this.info.instance.length + '" Instancias y "' + this.info.element.length + '" Elementos');
    	
    	//Limpia todo lo relacionado con las instancias/variables
    	this.info.instance=this.info.instance.filter(function(item, index){
    		//alert('Intancia Modulo: '+ item.mod);
    		
    		//Si he encontrado el modulo a eliminar
    		if(item.mod == modulo){
    			item.data.destroy();
    			item.data = null;
    			
    			//Devuelve false para que el filtro no lo seleccione
    			return false;
    		}
    		
    		//Devuelve true para que el filtro lo seleccione y permanezca en el vector
    		return true;
    	});

    	//Limpia todo lo relacionado con los elementos
    	this.info.element=this.info.element.filter(function(item, index){
    		//alert('Elemento Modulo: '+ item.mod);
    		
    		//Si he encontrado el modulo a eliminar
    		if(item.mod == modulo){
    			item.data.removeEvents();
    			item.data.destroy();
    			item.data=null;
    			
    			//Devuelve false para que el filtro no lo seleccione
    			return false
    		}
    		
    		//Devuelve true para que el filtro lo seleccione y permanezca en el vector
    		return true
    	});
    	
    	//alert('Quedan "'+ this.info.instance.length + '" Instancias y "' + this.info.element.length + '" Elementos');
    }
});
