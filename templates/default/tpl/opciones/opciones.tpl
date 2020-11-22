<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Opciones';
	var accion='datos';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
       	<li title="datos">{_TUSDATOS}</li>
       	<li title="personalizar">{_PERSONALIZAR}</li>
    </ul>
</div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<div id="datos" class="morphtabs_panel">
		{PESTANA}
	</div>
	<div id="personalizar" class="morphtabs_panel">
		
	</div>
</div>