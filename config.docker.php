<?php

/**
 * Librerias necesarias
 */
include_once '../libs/Config.php';
//include '../../../libs/Config.php';

$staticServer='';

$_ENV['config'] = new Config();

$_ENV['config']->set(array(
		/**
		 * Valores por defecto
		 */
		'sufixController' => 'Controller',
		'defaultController' => 'Index',
		'defaultAction' => 'index',
		'authController' => 'Acceso',
		'authAction' => 'login',
		'registroController' => 'Registro',
		'registroAction' => 'registro',

		/**
		 * Rutas MVC
		 */
		'appPath' => '../app/',
		'controllerPath' => 'controllers/',
		'modelPath' => 'models/',
		'viewPath' => 'views/',
		'tplPath' => '../templates/default/tpl/',
		'tplCachePath' => '../templates/default/cache/',

		/**
		 * Rutas Recursos
		 */
		'mejoraImgFolder' => $staticServer.'images/mejoras/',
		'planetaImgFolder' => $staticServer.'images/planetas/',
		'unidadImgFolder' => $staticServer.'images/unidades/',
		'especialImgFolder' => $staticServer.'images/especiales/',
		'simbolosImgFolder' => $staticServer.'images/chevron/',
		'logotipoImgFolder' => $staticServer.'images/logotipos/',
		'firmaGenerarImgFolder' => '../web/images/firmas/',
		'firmaGenerarJugadorImgFolder' => '../web/images/firmas/jugador/',
		'firmaImgFolder' => $staticServer.'images/firmas/',
		'firmaJugadorImgFolder' => $staticServer.'images/firmas/jugador/',
		'recursoImgFolder' => $staticServer.'images/recursos/',
		'galaxiaImgFolder' => $staticServer.'images/galaxias/',
		'razasImgFolder' => $staticServer.'images/razas/',
		'idiomasImgFolder' => $staticServer.'images/flag/',

		/**
		 * URL Externas
		 */
		//Redireccionamiento
		/*'urlLogin' => 'http://www.sgcommander.com',
		'urlForo' => 'http://foro.sgcommander.com', //Actualmente en desuso
		'urlFirmas' => 'http://firma.sg1.sgcommander.com',
		'urlImagenes' => 'http://static.sgcommander.com', //Actualmente en desuso
		'urlServidor' => 'http://sg1.sgcommander.com',*/
		
		'urlLogin' => 'http://localhost:8888',
		'urlForo' => 'http://foro.sgcommander.com', //Actualmente en desuso
		'urlFirmas' => 'http://localhost:8889/images/firmas/jugador',
		'urlImagenes' => '', //Actualmente en desuso
		'urlServidor' => 'http://localhost:8889',

		/**
		 * Base de datos
		 */
		'dbHost' => 'sgcommander-db',
		'dbPort' => 3306,
		'dbName' => 'dev',
		'dbUser' => 'sgcommander',
		'dbPass' => 'password',

		/**
			* Internacionalizacion
			*/
		'lang' => 'es_ES',
		'moFile' => 'messages',
	
		/**
			* Mensajeria
			*/
		'longitudAsuntoMensajeRecortar' => 15,

		/**
			* Paginaciones
			*/
		'rankingUsuariosNumPag' => 50,
		'rankingAlianzasNumPag' => 50,
	
		/**
			* JUEGOlibs
			*/

		/**
			* Galaxia
			*/
		'numGalaxias' => 3,
		'numSectores' => Array( 1 => 55, 2 => 40, 3 => 20, 4 => 1),
		'numCuadrantes' => 36,
		'numPlanetas' => 16,
		
		/*'numGalaxias' => 3,
		'numSectores' => Array( 1 => 5, 2 => 3, 3 => 2, 4 => 1),
		'numCuadrantes' => 1,
		'numPlanetas' => 16,*/

		//Distancias con naves
		/*'distanciaCuadrante' => 300,
		'distanciaSector' => 3500,
		'distanciaGalaxia' => 5000,
		'distanciaInterGalactica' => 50000,*/
		'distanciaCuadrante' => 30,
		'distanciaSector' => 350,
		'distanciaGalaxia' => 500,
		'distanciaInterGalactica' => 5000,
		
		/**
			* Longitudes de caracteres
			*/
		//Longitud nombre planeta
		'minNomPlaneta' => 5,
		'maxNomPlaneta' => 15,
	
		//Longitud del nombre de la alianza
		'minNomAlianza' => 1,
		'maxNomAlianza' => 25,

		/**
			* MISIONES
			*/

		/**
			* Recoleccion
			*/
		//Recoleccion maxima y minima, entre la cual se elegira aleatoriamente
		'minRecoleccion' => 80,
		'maxRecoleccion' => 100,

		/**
			* Batallas
			*/
		//BATALLAS
		'numeroRondas' => 10, //Numero de rondas en las que se decide la batalla
		'precisionFuegoMinima' => 90, //Indica el ataque efectivo de una unidad tendra como minimo 0.9*ataque
		'precisionFuegoMaxima' => 100, //Indica el ataque efectivo de una unidad tendra como maximo 1*ataque
		'porcentajeDesviacion' => 10, //Indica la desviacion en la seleccion de los grupos defensores. un 1% provoca que en una batalla 70 vs (1,1) se ataque aproximadamente 34-36 vs 1 y 34-36 vs 1

		//Indica la absorcion del escudo sobre el ataque
		'absorcionEscudoMin' => 100,
		'absorcionEscudoMax' => 100,

		'recuperacionEscudo' => 0.225, // Recarga del escudo por ataque (Tanto por uno)
		'porcentajeMinimoResistencia' => 0.5, //Indica el porcentaje minimo para cuando se ataca en grupo, se considere que estan vivas (Tanto por uno)
		//Con un valor de 0,5 significaria que a partir de que se elimina el 50% de resistencia de las unidades enemigas
		//obligatoriamente matare un minimo de unidades
		
		//Puntuación hasta la que se considera que se es debil
		'puntuacionDebil' => 5000,
		
		/**
			* Conquista
			*/
		//'tiempoConquista' => 86400,
		'tiempoConquista' => 8640,

		/**
			* CUENTA
			*/
		'tiempoVacaciones' => 172800, //Tiempo minimo en modo vacaciones

		//Longitud password
		'minPass' => 5,
		'maxPass' => 25,

		//Longitud usuario
		'minUser' => 4,
		'maxUser' => 15,
	
		/**
		* Log
		*/
		'logPath' => $_SERVER["DOCUMENT_ROOT"].'/../logs',
	
		/**
		* Registro
		*/
		'secretWordToken' => 'KCVASAMORIR', 
		'maxUsuarios' => 5000,
		'emailRegistro' => 'noreply@sgcommander.com',
		'correoConfirmacion' => false
	)
);

//Elimino la variable
unset($staticServer);

?>