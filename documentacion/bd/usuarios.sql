USE dev;
INSERT INTO `usuario` (`id` ,`nombre` ,`pass` ,`email` ,`ipUltimoAcceso` ,`ultimoAcceso`) VALUES
(1 , 'prueba', 'b28da40fb13920fcac612972ab298fe30686128aca722472d3b1cdfcf635a095', 'prueba@correo.com', '', NOW( ));

/**
 * Indicaciones de las razas
 */
SET @TAURI=1;
SET @GOAULD=2;
SET @ASGARD=3;
SET @JAFFA=4;
SET @ATLANTIS=5;
SET @WRAITH=6;
SET @REPLICANTES=7;
SET @ORI=8;

#Genero los datos de los jugadores
INSERT INTO `jugador` (`idUsuario`, `idRaza`, `idAlianza`, `ultimaActualizacion`, `bloqueado`, `vacaciones`) VALUES 
(1, @TAURI, NULL, CURRENT_TIMESTAMP , NULL , NULL);
