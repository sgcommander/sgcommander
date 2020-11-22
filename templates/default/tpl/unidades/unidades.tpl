<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=true;
	var controlador='{CONTROLADOR}';
	var accion='{ACCION}';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
       	<li title="disponibles">{_DISPONIBLESPLANETA}</li>
       	<li title="construibles">{_CONSTRUIR}</li>
       	<li title="requisitos">{_REQUISITOS}</li>
    </ul>
</div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<div id="disponibles" class="morphtabs_panel">{PESTANA}</div>
	<div id="construibles" class="morphtabs_panel"></div>
	<div id="requisitos" class="morphtabs_panel"></div>
</div>