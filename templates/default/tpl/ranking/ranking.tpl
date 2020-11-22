<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Ranking';
	var accion='ranking';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
        	<li title="usuarios">{_USUARIOS}</li>
        	<li title="alianzas">{_ALIANZAS}</li>
			<li title="buscador">{_BUSCADOR}</li>
    	</ul>
</div>

<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<div id="usuarios" class="morphtabs_panel">
		{PESTANA}
	</div>
	<div id="alianzas" class="morphtabs_panel">
		
	</div>
	<div id="buscador" class="morphtabs_panel">
		
	</div>
</div>