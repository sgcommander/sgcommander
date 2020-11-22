<!-- Datos guardados para pasarselos a js sin hacer peticiones -->
<script type="text/javascript">
	var recargar=false;
	var controlador='Planetas';
	var accion='tuLista';
</script>
<div id="pestanas">
	<ul class="morphtabs_title">
       	<li title="tuLista">{_TULISTA}</li>
       	<li title="planetasPropios">{_PROPIOS}</li>
       	<li title="planetasAliados">{_ALIADOS}</li>
       	<li title="planetasEnemigos">{_ENEMIGOS}</li>
       	<li title="planetasNeutrales">{_NEUTRALES}</li>
    </ul>
</div>
<div id="contenido">
	<!-- INCLUDE bloques/publicidad480x60.tpl -->
	<div id="tuLista" class="morphtabs_panel">
		{PESTANA}
	</div>
	<div id="planetasPropios" class="morphtabs_panel">
		
	</div>
	<div id="planetasAliados" class="morphtabs_panel">
		
	</div>
	<div id="planetasEnemigos" class="morphtabs_panel">
		
	</div>
	<div id="planetasNeutrales" class="morphtabs_panel">
		
	</div>
</div>