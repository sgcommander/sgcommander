<?php
	/**
	 * Esta clase almacena la configuracion de la web
	 */
	class Config{
		private $conf;
		
		/**
		 * Constructor
		 */
		public function __construct(){
			//Configuracion vacia
			$this->conf = Array();
		}

		/**
		 * Permite anyadir/modificar la configuracion de la web,
		 * elemento a elemento o varios elementos pasando un vector
		 * 
		 * Ej: $obj->set(array('wwwRoot' => '/var/www'));
		 */
		public function set($key){
			//Anyado los nuevos pares clave valor, a los ya existentes.
			//En caso de ya existir previamente, se sobreescriben.
			$this->conf = array_merge($this->conf, $key);
		}
		
		/**
		 * Obtengo el valor de la configuracion
		 */		
		public function get($key){
			
			//Si la clave existe, devuelvo su valor
			if(array_key_exists($key, $this->conf))
				return $this->conf[$key];
				
			//Si no existe, devuelvo el valor nulo
			else
				return NULL;
		}
		
		
		/**
		 * Permite eliminar la configuracion de la web,
		 * ya sea un elemento o varios.
		 * 
		 * Ej: $obj->del('wwwRoot');
		 *     $obj->del(Array('wwwRoot', 'dbHost'));
		 */
		public function del($key){
			
			//Compruebo si quiero eliminar una o varias configuraciones
			if(!is_array($key)){
				//Elimino una configuracion
				unset($this->conf[$key]);
			}
			else{
				//Elimino todas las configuraciones pasadas
				foreach($key AS $val){
					unset($this->conf[$val]);
				}
			}
		}
		
	}
?>
