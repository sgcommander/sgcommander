<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Alianza';
	var accion='verAlianza';
</script>

<div id="pestanas">
	<ul class="morphtabs_title">
       	<li title="otraAlianza&amp;idAlianza={IDALIANZA}">{_ALIANZA}</li>
       	<li title="otraMiembros&amp;idAlianza={IDALIANZA}">{_MIEMBROS}</li>
    </ul>
</div>
<div id="contenido">
    <div id="otraAlianza&amp;idAlianza={IDALIANZA}" class="morphtabs_panel">{PESTANA}</div>
    <div id="otraMiembros&amp;idAlianza={IDALIANZA}" class="morphtabs_panel"></div>
</div>