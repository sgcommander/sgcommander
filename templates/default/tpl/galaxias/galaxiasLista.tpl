<div id="galaxiasDivListas">
	<select name="idGalaxia" id="galaxiasSelIdGalaxia">
		<!-- BEGIN tGalaxia -->
		<option value="{IDGALAXIA}" {GALAXIASEL}>{NOMGALAXIA}</option>
		<!-- END tGalaxia -->
	</select>
	<select name="idSector" id="galaxiasSelIdSector">
		<!-- BEGIN tSector -->
		<option value="{IDSECTOR}" {SECTORSEL}>{NOMSECTOR}</option>
		<!-- END tSector -->
	</select>
	<select name="idCuadrante" id="galaxiasSelIdCuadrante">
		<!-- BEGIN tCuadrante -->
		<option value="{IDCUADRANTE}" {CUADRANTESEL}>{NOMCUADRANTE}</option>
		<!-- END tCuadrante -->
	</select>
</div>
<div class="parrafo">
		<div class="iconosUsuario">
			<span><img src="/images/iconos/{RAZAICO}/debil.png" class="tooltipDescripcion icono" alt="{_DEBIL}" width="18px" height="18px" title="{_DEBILDESC}" /> {_DEBIL}</span>
			<span><img src="/images/iconos/{RAZAICO}/inactivo.png" class="tooltipDescripcion icono" alt="{_INACTIVO}" width="18px" height="18px" title="{_INACTIVODESC}" /> {_INACTIVO}</span>
			<span><img src="/images/iconos/{RAZAICO}/vacaciones.png" class="tooltipDescripcion icono" alt="{_VACACIONES}" width="18px" height="18px" title="{_VACACIONESDESC}" /> {_VACACIONES}</span>
		</div>
	</div>
<div id="galaxiasDivCuadrante">
	{PLANETAS}
</div>