<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Mejoras';
	var accion='mejorasLista';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
		<!-- BEGIN tGrupo -->
       	<li title="{IDGRUPO}">{NOMGRUPO}</li>
       	<!-- END tGrupo -->
    </ul>
</div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<!-- BEGIN tGrupoPanel -->
	<div id="{IDGRUPO}" class="morphtabs_panel">{PESTANA}</div>
	<!-- END tGrupoPanel -->
</div>