<script type="text/javascript">
	//Producciones
	<!-- BEGIN tPrimarioProduccion -->
	var indexRecursoPriPro=parseFloat({RECURSOPRIPRO});
	<!-- END tPrimarioProduccion -->
	<!-- BEGIN tSecundarioProduccion -->
	var indexRecursoSecPro=parseFloat({RECURSOSECPRO});
	<!-- END tSecundarioProduccion -->
	<!-- BEGIN tEnergiaProduccion -->
	$$('.energiaProd').each(function(el){
		el.set('text', parseInt({RECURSOENEPRO}));
	});
	<!-- END tEnergiaProduccion -->
</script>