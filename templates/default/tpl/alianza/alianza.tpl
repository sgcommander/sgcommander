<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Alianza';
	var accion='alianza';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
		<!-- BEGIN tAlianza -->
       	<li title="tuAlianza">{_ALIANZA}</li>
       	<li title="miembros">{_MIEMBROS}</li>
       	<!-- END tAlianza -->
		<!-- BEGIN tNoAlianza -->
       	<li title="buscador">{_BUSCAR}</li>
       	<li title="crear">{_CREAR}</li>
       	<!-- END tNoAlianza -->
       	<!-- BEGIN tLider -->
       	<li title="solicitudes">{_SOLICITUDES}</li>
       	<li title="datos">{_EDITAR}</li>
       	<!-- END tLider -->
    </ul>
</div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<!-- BEGIN tAlianzaPanel -->
    <div id="tuAlianza" class="morphtabs_panel">{PESTANAALIANZA}</div>
    <div id="miembros" class="morphtabs_panel"></div>
    <!-- END tAlianzaPanel -->
	<!-- BEGIN tNoAlianzaPanel -->
    <div id="buscador" class="morphtabs_panel">{PESTANANOALIANZA}</div>
    <div id="crear" class="morphtabs_panel"></div>
    <!-- END tNoAlianzaPanel -->
    <!-- BEGIN tLiderPanel -->
    <div id="solicitudes" class="morphtabs_panel"></div>
    <div id="datos" class="morphtabs_panel"></div>
    <!-- END tLiderPanel -->
</div>