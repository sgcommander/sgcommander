<?php
	//Memcache
	define('cachear',0);
	define('noCachear',1);
	define('eliminar',2);

	//Tipos de unidades con su identificador (correlacion con la base de datos)
	define('NAVE', 1);
	define('SOLDADO', 2);
	define('DEFENSA', 3);

	//Tipos de naves con su identificador (correlacion con la base de datos)
	define('CAZA', 1);
	define('CAZAPESADO', 2);
	define('CRUCERO', 3);
	define('NODRIZA', 4);
	define('INSIGNIA', 5);

	//Tipos de soldados con su identificador (correlacion con la base de datos)
	define('EXPLORACION', 1);
	define('RECOLECCION', 2);
	define('COMBATE', 3);
	define('OFICIAL', 4);
	define('CIENTIFICO', 5);
	define('MEDICO', 6);
	define('LIDER', 7);
	define('ASCENDIDO', 8);

	//Tipos de defensas con su identificador (correlacion con la base de datos)
	define('STARGATE', 1);
	define('TERRESTRE', 2);
	define('AEREA', 3);
	define('ORBITAL', 4);

	//Tipos de misiones con su identificador (correlacion con la base de datos)
	define('ATACAR', 1);
	define('DESPLEGAR', 2);
	define('RECOLECTAR', 3);
	define('EXPLORAR', 4);
	define('CONQUISTAR', 5);
	define('CONTRATACAR', 6);
	define('ESTABLECERBASE', 7);

	//Tipos de mensajes con su identificador (correlacion con la base de datos)
	define('MENSAJENORMAL', 1);
	define('MENSAJEADMIN', 2);
	define('MENSAJEALIANZA', 3);
	define('MENSAJEREPORTE', 4);
	define('MENSAJEBATALLA', 5);
	define('MENSAJEAVISO', 6);

	//Valores de los recursos al intercambiar
	define('TAURIPRIMARIO',3);
	define('TAURISECUNDARIO',8);
	define('GOAULDPRIMARIO',2);
	define('GOAULDSECUNDARIO',9);
	define('ASGARDPRIMARIO',10);
	define('ASGARDSECUNDARIO',1);
	define('JAFFAPRIMARIO',3);
	define('JAFFASECUNDARIO',8);
	define('ATLANTISPRIMARIO',3);
	define('ATLANTISSECUNDARIO',8);
	define('WRAITHPRIMARIO',2);
	define('WRAITHSECUNDARIO',9);
	define('REPLICANTESPRIMARIO',1);
	define('REPLICANTESSECUNDARIO',10);
	define('ORIPRIMARIO',2);
	define('ORISECUNDARIO',9);
	
	//Tipos de mejoraTipoMejoraGeneral
	define('MEJORALIMITETROPAS',5);
	define('MEJORALIMITEMISIONES',7);
	
	//Tipos de lineas del Log
	define('ACCION', 0);
	define('EVENTO', 1);
	
	//Eventos
	define('EVENTOMEJORAR', 1);
	define('EVENTOCONSTRUIR', 2);
	define('EVENTOFINESPECIALACTIVO', 3);
	define('EVENTOFINESPECIALESPERA', 4);
	define('EVENTOMISION', 5);
	
	//Reportes
	define('DESTRUIDA', 0);
	define('CAPTURADA', 1);

	//ELIMINAR
	//Constantes para el registro de logs
	define('MISIONENVIAR', 1);
	define('MISIONRESOLVER', 2);
	define('MISIONFINALIZAR', 3);
	define('ESPECIALACTIVAR', 4);
	define('ESPECIALRECARGAR', 5);
	define('ESPECIALDISPONIBLE', 6);
	define('CONSTRUIR', 7);
	define('LICENCIAR', 8);
	define('INVESTIGAR', 9);
	define('ALIANZACREAR', 10);
	define('ALIANZAPETICION', 11);
	define('ALIANZAACEPTACION', 12);
	define('OPCIONESCAMBIARDATOS', 13);
	//FIN ELIMINAR
?>
