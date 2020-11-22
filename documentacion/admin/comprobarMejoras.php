<?php
set_time_limit(6000);

define('CORRECTO',true);
require_once('../bd/generadorPlanetas/class.Mysql.php');
require_once('../../constants.php');

$mysql = Mysql::getInstancia();

$mysql->query('
	SELECT idJugador, tipo, subtipo, SUM(porcentaje) FROM
	((SELECT jm.idJugador AS idJugador, tu.nombre AS tipo, tm.nombre AS subtipo, jm.nivel*mtutm.porcentaje AS porcentaje
	FROM jugadorMejora AS jm JOIN mejoraTipoUnidadTipoMejora AS mtutm ON (jm.idMejora = mtutm.idMejora)
		LEFT JOIN tipoUnidad AS tu ON (tu.id=mtutm.idTipoUnidad)
		LEFT JOIN tipoMejora AS tm ON (tm.id = mtutm.idTipoMejora))

	UNION

	(SELECT jea.idJugador AS idJugador, tu.nombre AS tipo, tm.nombre AS subtipo, mtutm.porcentaje AS porcentaje
	FROM jugadorEspecialActivo AS jea JOIN especialMejora AS em ON (jea.idEspecial = em.idEspecial)
		JOIN mejoraTipoUnidadTipoMejora AS mtutm ON (mtutm.idMejora = em.idMejora)
		LEFT JOIN tipoUnidad AS tu ON (tu.id=mtutm.idTipoUnidad)
		LEFT JOIN tipoMejora AS tm ON (tm.id = mtutm.idTipoMejora))

	UNION

	(SELECT ujp.idJugador AS idJugador, tu.nombre AS tipo, tm.nombre AS subtipo, mtutm.porcentaje AS porcentaje
	FROM unidadJugadorPlaneta AS ujp JOIN unidadHeroeMejora AS uhm ON (ujp.idUnidad=uhm.idUnidadHeroe)
		JOIN mejoraTipoUnidadTipoMejora AS mtutm ON (mtutm.idMejora = uhm.idMejora)
		LEFT JOIN tipoUnidad AS tu ON (tu.id=mtutm.idTipoUnidad)
		LEFT JOIN tipoMejora AS tm ON (tm.id = mtutm.idTipoMejora))) AS mejora
	GROUP BY idJugador, tipo, subtipo;
');

?>