<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{RAZANOM}</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="/estilos/{IDRAZA}.css" />
	<link rel="STYLESHEET" type="text/css" href="/estilos/general.css" />
	<link rel="stylesheet" type="text/css" href="/estilos/formcheck.css" />
	<link rel="stylesheet" type="text/css" href="/estilos/formularios.css" />
	<script type="text/javascript" src="/js/Mootools/mootools-core.js"></script>
	<script type="text/javascript" src="/js/Mootools/mootools-more.js"></script>
	<script type="text/javascript" src="/js/Mootools/morphtabs.js"></script>
	<script type="text/javascript" src="/js/Mootools/formcheck.js"></script>
	<script type="text/javascript" src="/js/Mootools/es.js"></script>
	<script type="text/javascript" src="/js/Mootools/sexyalertbox.js"></script>
	<script type="text/javascript" src="/js/Mootools/SqueezeBox.js"></script>
	<script type="text/javascript" src="/js/Mootools/dwProgressBar.js"></script>
	<script type="text/javascript" src="/js/Mootools/scrollSideBar.js"></script>
	<script type="text/javascript" src="/js/Mootools/timer.js"></script>
	<script type="text/javascript" src="/js/Destroyers.js"></script>
	<script type="text/javascript" src="/js/Garbage.js"></script>
	<script type="text/javascript" src="/js/functions.js"></script>
	<script type="text/javascript" src="/js/webtoolkit.base64.js"></script>
	<script type="text/javascript" src="/js/inicio.js"></script>
	
	<!-- Estilos --> 
	<style type="text/css">
		/*No pueden estar dentro del fichero css, ya que deben
		ser rellenados automaticamente por el PHP */
		#constropas div{
			width:50px;
		}
		#consnaves div{
			width:60px;
		}
		#consdefensas div{
			width:20px;
		}
	</style>
	<!-- Javascript -->
	<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
	<script type="text/javascript">
		var raza="{RAZA}";
		var idRaza={IDRAZA};
		
		var indexRecursoPri=parseFloat({RECURSOPRICANT});
		var indexRecursoSec=parseFloat({RECURSOSECCANT});
		var indexRecursoEne={ENERGIA};
		var indexRecursoPriPro=parseFloat({RECURSOPRIPRO});
		var indexRecursoSecPro=parseFloat({RECURSOSECPRO});
		
		var stargateIntergalactico={STARGATEINTERGALACTICO};
	</script>
</head>
<body>
	<script type="text/javascript">
  		var _gaq = _gaq || [];
  		_gaq.push(['_setAccount', 'UA-45732778-1']);
  		_gaq.push(['_setDomainName', 'sgcommander.com']);
  		_gaq.push(['_trackPageview']);

  		(function() {
    			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  		})();
	</script>
	<div id="web">
	<div id="mensajesDivMensajes" class="mensajes">
		<div id="mensajesDivContenido"></div>
	</div>
	<div id="comerciosDivComercios" class="comercios">
		<div id="comerciosDivContenido"></div>
	</div>
	<div id="especialesDivEspeciales" class="especiales"></div>
	<div id="mensajesDivAviso">
		<img src="/images/iconos/mensajes/1noleido.png" alt="{_MENSAJESNUEVOS}" />
		<a href="?controlador=Mensajes&amp;accion=mensajes" class="indexBtnMensajes">
			<span>{_TIENES} <span id="mensajesSpanNuevos">{MENSAJESNUEVOS}</span> {_MENSAJESNUEVOS}</span>
		</a>
	</div>
	<div id="preloader">
		<div>{_CARGANDO}...</div>
	</div>
 	<div id="indexDivContenedor">
 		<!-- Recursos -->
 		<div id="indexDivRecursoPri" title="{RECURSOPRINOM}" class="tooltip">
			<div class="textoRecurso"><span class="recursoPriCant">{RECURSOPRI}</span></div>	
 		</div>
 		<div id="indexDivRecursoSec" title="{RECURSOSECNOM}" class="tooltip">
			<div class="textoRecurso"><span class="recursoSecCant">{RECURSOSEC}</span></div>	 		
 		</div>
 		<div id="indexDivRecursoEnergia" title="{ENERGIANOM}" class="tooltip">
			<div class="textoRecurso"><span class="energiaCant">{ENERGIA}</span> / <span class="energiaProd">{ENERGIATOTAL}</span></div>			
 		</div>
 		<!-- FinRecursos -->
 		<!-- Logo -->
 		<div id="indexDivLogo"><img src="{LOGOTIPO}" alt="{LOGOTIPONOM}" id="indexImgLogotipo" /></div>
 		<!-- FinLogo -->
 		<!-- Planeta -->
 		<div id="indexDivPlaneta">
 			{PLANETA}
 		</div>
 		<div id="indexDivLogoPlanetaResto">
			<span id="indexLblPlanetasLista">
				{PLANETALISTA}			
			</span>
			<div id="indexDivConstruccionPlaneta">
			{CONSTRUCCIONPLANETA}
			</div>		
 		</div>
 		<!-- FinPlaneta -->
 		<!-- Botonera -->
 		<div id="indexDivBotonera">
			<div id="indexDivBoton1"><a href="?controlador=Index&amp;accion=principal" class="menu">{_INICIO}</a></div>
			<div id="indexDivBoton2"><a href="?controlador=Planetas&amp;accion=planetas" class="menu">{_PLANETAS}</a></div>
			<div id="indexDivBoton3"><a href="?controlador=Galaxias&amp;accion=galaxias" class="menu">{_GALAXIAS}</a></div>
			<div id="indexDivBoton4"><a href="?controlador=Recursos&amp;accion=recursos" class="menu">{_RECURSOS}</a></div>
			<div id="indexDivBoton5"><a href="?controlador=Soldados&amp;accion=soldados" class="menu">{_TROPAS}</a></div>
			<div id="indexDivBoton6"><a href="?controlador=Naves&amp;accion=naves" class="menu">{_NAVES}</a></div>
			<div id="indexDivBoton7"><a href="?controlador=Defensas&amp;accion=defensas" class="menu">{_DEFENSAS}</a></div>
			<div id="indexDivBoton8"><a href="?controlador=Especiales&amp;accion=especiales" id="indexBtnEspeciales">{_ESPECIALES}</a></div>
			<div id="indexDivBoton9"><a href="?controlador=Mejoras&amp;accion=mejoras" class="menu">{_MEJORAS}</a></div>
			<div id="indexDivBoton10"><a href="http://foro.sgcommander.com" target="_blank">{_FORO}</a></div>
			<div id="indexDivBoton11"><a href="?controlador=Alianza&amp;accion=alianza" class="menu">{_ALIANZA}</a></div>
			<div id="indexDivBoton12"><a href="?controlador=Mensajes&amp;accion=mensajes" class="indexBtnMensajes">{_MENSAJES}</a></div>
			<div id="indexDivBoton13"><a href="?controlador=Ranking&amp;accion=ranking" class="menu">{_RANKING}</a></div>
			<div id="indexDivBoton14"><a href="?controlador=Opciones&amp;accion=opciones" class="menu">{_OPCIONES}</a></div>
			<div id="indexDivBoton15"><a href="?controlador=Acceso&amp;accion=logout" id="indexBtnSalir"><img src="/images/estilos/{RAZA}/salir1.png" id="indexImgSalir" alt="{_SALIR}" /></a></div>
 		</div>
 		<!-- FinBotonera -->
 		<!-- Contenido -->
 		<div id="indexDivCentro">
			{CONTENIDO}
		</div>
 		<!-- FinContenido -->
 	</div>
 	<div id="indexDivPie"></div>
	<div>
		<p>
		   <a href="http://validator.w3.org/check?uri=referer">
			<img style="border:0;width:88px;height:31px" src="/images/valid-xhtml10.png" alt="Valid XHTML 1.0 Strict" />
		   </a>
		    <a href="http://jigsaw.w3.org/css-validator/">
			<img style="border:0;width:88px;height:31px" src="/images/vcss.gif" alt="¡CSS Válido!" />
		    </a>
		</p>
	</div>
	</div>
 </body>
</html>
