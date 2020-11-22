<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=true;
	var controlador='Recursos';
	var accion='recursos';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
        <li title="info">{_RECURSOS}</li>
        <li title="comercios">{_COMERCIOS}</li>
    </ul>
</div>

<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<div id="info" class="morphtabs_panel">
		{PESTANA}
	</div>
	<div id="comercios" class="morphtabs_panel">
		
	</div>
</div>