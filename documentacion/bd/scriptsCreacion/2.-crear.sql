-- -----------------------------------------------------
-- Table `idioma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `idioma` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL ,
  `codigo` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usuario` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL ,
  `pass` CHAR(64) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `idIdioma` SMALLINT UNSIGNED NOT NULL DEFAULT '1' ,
  `sessId` CHAR(26) NOT NULL DEFAULT '' ,
  `ipUltimoAcceso` CHAR(10) NOT NULL DEFAULT '' ,
  `ultimoAcceso` TIMESTAMP NULL DEFAULT NULL ,
  `proteccionIP` BIT NOT NULL DEFAULT 1 ,
  `fechaCreacion` TIMESTAMP NOT NULL DEFAULT NOW() ,
  `valido` VARCHAR(40) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `usuario_nombre` (`nombre` ASC) ,
  INDEX `fk_usuario_idioma1` (`idIdioma` ASC) ,
  CONSTRAINT `fk_usuario_idioma1`
    FOREIGN KEY (`idIdioma` )
    REFERENCES `idioma` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
MAX_ROWS = 10000
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `alianza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `alianza` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idFundador` SMALLINT UNSIGNED NOT NULL ,
  `titulo` VARCHAR(255) NOT NULL ,
  `imagen` VARCHAR(255) NOT NULL ,
  `texto` TEXT NOT NULL ,
  `foro` VARCHAR(255) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_{7FB264A2-ED65-4704-92AF-FA7CAC4D9BA9}` (`idFundador` ASC) ,
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC) ,
  CONSTRAINT `fk_{7FB264A2-ED65-4704-92AF-FA7CAC4D9BA9}`
    FOREIGN KEY (`idFundador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `raza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `raza` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `colorFirma` VARCHAR(6) NOT NULL DEFAULT 000000 ,
  `firmaX` TINYINT UNSIGNED NOT NULL ,
  `firmaY` TINYINT UNSIGNED NOT NULL ,
  `maxPlanetas` TINYINT UNSIGNED NOT NULL DEFAULT 3 ,
  `limiteSoldados` TINYINT UNSIGNED NOT NULL ,
  `limiteMisiones` TINYINT UNSIGNED NOT NULL ,
  `nivelMinimoHiperpropulsion` TINYINT UNSIGNED NOT NULL ,
  `stargateTropasIntergalactico` BIT NOT NULL DEFAULT 0 ,
  `capturarUnidades` BIT NOT NULL DEFAULT 0 ,
  `porcentajeRecoleccionPrimario` TINYINT UNSIGNED NOT NULL ,
  `porcentajeRecoleccionSecundario` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 8
MAX_ROWS = 8
MIN_ROWS = 8
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `firma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `firma` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `ruta` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_{47A05E3E-45E5-4A5E-B58A-FBB79FF3CF4A}` (`idRaza` ASC) ,
  CONSTRAINT `fk_{47A05E3E-45E5-4A5E-B58A-FBB79FF3CF4A}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `logotipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `logotipo` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `ruta` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_{CADCB337-2FB7-46E7-B8C2-6886D3E9BE31}` (`idRaza` ASC) ,
  CONSTRAINT `fk_{CADCB337-2FB7-46E7-B8C2-6886D3E9BE31}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugador`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugador` (
  `idUsuario` SMALLINT UNSIGNED NOT NULL ,
  `idLogotipo` TINYINT UNSIGNED NOT NULL ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `idFirma` TINYINT UNSIGNED NOT NULL ,
  `idAlianza` SMALLINT UNSIGNED NULL ,
  `ultimaActualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ultima actualizacion de su estado' ,
  `bloqueado` TIMESTAMP NULL ,
  `vacaciones` TIMESTAMP NULL ,
  PRIMARY KEY (`idUsuario`) ,
  INDEX `fk_{DE4B429B-D6A8-430E-969E-125D91D8A594}` (`idAlianza` ASC) ,
  INDEX `fk_{08B7CADE-B3CD-4DC2-A5E3-A2AE2F8948FB}` (`idFirma` ASC) ,
  INDEX `fk_{486AFE07-F0D6-492C-874F-D96F324D7F30}` (`idRaza` ASC) ,
  INDEX `fk_{F8A0F10C-DB3E-461F-AC4D-50A101C123A0}` (`idLogotipo` ASC) ,
  CONSTRAINT `fk_{B8834E33-77BD-4EAD-9CA2-1BB5C4A3A642}`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `usuario` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{DE4B429B-D6A8-430E-969E-125D91D8A594}`
    FOREIGN KEY (`idAlianza` )
    REFERENCES `alianza` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{08B7CADE-B3CD-4DC2-A5E3-A2AE2F8948FB}`
    FOREIGN KEY (`idFirma` )
    REFERENCES `firma` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{486AFE07-F0D6-492C-874F-D96F324D7F30}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{F8A0F10C-DB3E-461F-AC4D-50A101C123A0}`
    FOREIGN KEY (`idLogotipo` )
    REFERENCES `logotipo` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
MAX_ROWS = 10000
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoMensaje`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoMensaje` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mensaje`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mensaje` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idJugador` SMALLINT UNSIGNED NULL ,
  `idTipoMensaje` TINYINT UNSIGNED NOT NULL ,
  `nombreUsuario` VARCHAR(255) NOT NULL ,
  `asunto` VARCHAR(255) NOT NULL DEFAULT 'Sin Asunto' ,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `contenido` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_mensaje_tipoMensaje1` (`idTipoMensaje` ASC) ,
  INDEX `fk_{89A1BD0D-9EA4-403F-BBC7-2176E8F74695}` (`idJugador` ASC) ,
  CONSTRAINT `fk_{89A1BD0D-9EA4-403F-BBC7-2176E8F74695}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mensaje_tipoMensaje1`
    FOREIGN KEY (`idTipoMensaje` )
    REFERENCES `tipoMensaje` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `recibeMensaje`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `recibeMensaje` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `nombreUsuario` VARCHAR(255) NOT NULL COMMENT 'Campo desnormalizado. Este campo sirve para saber el nombre de todos los receptores de un mensaje, sin tener que buscarlos.' ,
  `leido` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idMensaje`, `idJugador`) ,
  INDEX `fk_{0D4C5F64-B834-40D1-9D55-0CEFCC784F7C}` (`idMensaje` ASC) ,
  INDEX `fk_{4A39DEF5-23E4-46B2-9F2C-0A1194B5D9FC}` (`idJugador` ASC) ,
  CONSTRAINT `fk_{0D4C5F64-B834-40D1-9D55-0CEFCC784F7C}`
    FOREIGN KEY (`idMensaje` )
    REFERENCES `mensaje` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{4A39DEF5-23E4-46B2-9F2C-0A1194B5D9FC}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `solicitudAlianza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `solicitudAlianza` (
  `idAlianza` SMALLINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `mensaje` TINYTEXT NOT NULL ,
  PRIMARY KEY (`idAlianza`, `idJugador`) ,
  INDEX `fk_{AC3366FB-2412-4783-909B-780F84AE10DE}` (`idAlianza` ASC) ,
  INDEX `fk_{CA3A8747-B18C-4415-B7C3-FDDEE03E9825}` (`idJugador` ASC) ,
  CONSTRAINT `fk_{AC3366FB-2412-4783-909B-780F84AE10DE}`
    FOREIGN KEY (`idAlianza` )
    REFERENCES `alianza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{CA3A8747-B18C-4415-B7C3-FDDEE03E9825}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `comercio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comercio` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idJugadorDest` SMALLINT UNSIGNED NOT NULL ,
  `idJugadorOrig` SMALLINT UNSIGNED NOT NULL ,
  `fechaPeticion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_{B91C937D-315C-461C-9C86-0E014A9C3941}` (`idJugadorOrig` ASC) ,
  INDEX `fk_{9DBFF2D8-7F18-47DA-A0FA-3BFE6BF8BED2}` (`idJugadorDest` ASC) ,
  CONSTRAINT `fk_{B91C937D-315C-461C-9C86-0E014A9C3941}`
    FOREIGN KEY (`idJugadorOrig` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{9DBFF2D8-7F18-47DA-A0FA-3BFE6BF8BED2}`
    FOREIGN KEY (`idJugadorDest` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `galaxia`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `galaxia` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `chavron` CHAR(2) NOT NULL ,
  `nPlanetas` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0 ,
  `nCuentas` SMALLINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 4
MAX_ROWS = 4
MIN_ROWS = 4
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `planeta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `planeta` (
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `nombrePlaneta` VARCHAR(255) NOT NULL DEFAULT '' ,
  `nombreSGC` VARCHAR(255) NOT NULL ,
  `coord1` CHAR(2) NOT NULL ,
  `coord2` CHAR(2) NOT NULL ,
  `coord3` CHAR(2) NOT NULL ,
  `coord4` CHAR(2) NOT NULL ,
  `coord5` CHAR(2) NOT NULL ,
  `coord6` CHAR(2) NOT NULL ,
  `coord7` CHAR(2) NOT NULL ,
  `riqueza` CHAR(3) NOT NULL ,
  PRIMARY KEY (`idPlaneta`, `idGalaxia`) ,
  INDEX `fk_{DCB85E47-6790-44AC-A26E-94F2D5E2CC30}` (`idGalaxia` ASC) ,
  CONSTRAINT `fk_{DCB85E47-6790-44AC-A26E-94F2D5E2CC30}`
    FOREIGN KEY (`idGalaxia` )
    REFERENCES `galaxia` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 62018
MAX_ROWS = 62018
MIN_ROWS = 62018
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `planetaEspecial`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `planetaEspecial` (
  `idPlanetaEsp` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `imagen` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idPlanetaEsp`, `idGalaxia`) ,
  CONSTRAINT `fk_{BD116817-D843-4E94-B626-76EADE2E3907}`
    FOREIGN KEY (`idPlanetaEsp` , `idGalaxia` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 122, 
COMMENT = 'Indica que planetas son especiales.' 
MAX_ROWS = 122
MIN_ROWS = 122
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `planetaExplorado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `planetaExplorado` (
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idPropietario` SMALLINT UNSIGNED NULL COMMENT 'Campo desnormalizado. Almacena el nombre del propietario del planeta.' ,
  `visible` BIT NOT NULL DEFAULT 1 ,
  `nota` VARCHAR(255) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`idPlaneta`, `idGalaxia`, `idJugador`) ,
  INDEX `fk_{79A40C3F-2AE7-4DB6-A963-C3320ACDC805}` (`idPlaneta` ASC, `idGalaxia` ASC) ,
  INDEX `fk_{C95B5F4D-FD5E-4523-8C87-3CF5B5B00670}` (`idJugador` ASC) ,
  INDEX `PlanetasVisibles` (`idJugador` ASC, `visible` ASC) ,
  CONSTRAINT `fk_{79A40C3F-2AE7-4DB6-A963-C3320ACDC805}`
    FOREIGN KEY (`idPlaneta` , `idGalaxia` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{C95B5F4D-FD5E-4523-8C87-3CF5B5B00670}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `planetaColonizado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `planetaColonizado` (
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `principal` BIT NOT NULL DEFAULT 0 COMMENT 'Se trata del planeta principal?' ,
  PRIMARY KEY (`idPlaneta`, `idGalaxia`) ,
  INDEX `fk_{A845AC13-F2FA-4E84-B687-C73864FE63DB}` (`idJugador` ASC) ,
  CONSTRAINT `fk_{A93F4949-4EC7-4DD9-AC36-5E2FA2748D00}`
    FOREIGN KEY (`idPlaneta` , `idGalaxia` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{A845AC13-F2FA-4E84-B687-C73864FE63DB}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoRecurso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoRecurso` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 3
MAX_ROWS = 3
MIN_ROWS = 3
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `recursoRaza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `recursoRaza` (
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `cantidadBase` MEDIUMINT UNSIGNED NOT NULL ,
  `produccionBase` DECIMAL(10,6) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idRaza`, `idTipoRecurso`) ,
  INDEX `fk_{0B936C27-91A7-4B68-9FA1-69E9F5596E62}` (`idRaza` ASC) ,
  INDEX `fk_{28238C69-F4CD-48FC-8325-584B2A66AA4E}` (`idTipoRecurso` ASC) ,
  CONSTRAINT `fk_{0B936C27-91A7-4B68-9FA1-69E9F5596E62}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{28238C69-F4CD-48FC-8325-584B2A66AA4E}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 24
MAX_ROWS = 24
MIN_ROWS = 24
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mejora` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 300
MAX_ROWS = 300
MIN_ROWS = 300
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoUnidad` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 4, 
COMMENT = 'Tipo basico al que pertenece una unidad.' 
MAX_ROWS = 4
MIN_ROWS = 4
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidad` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `idRaza` TINYINT UNSIGNED NULL ,
  `idtipoUnidad` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `puntos` MEDIUMINT UNSIGNED NOT NULL ,
  `ataque` MEDIUMINT UNSIGNED NOT NULL ,
  `resistencia` MEDIUMINT UNSIGNED NOT NULL ,
  `escudo` MEDIUMINT UNSIGNED NOT NULL ,
  `tiempo` MEDIUMINT UNSIGNED NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `invisible` BIT NOT NULL DEFAULT 0 ,
  `atraviesaEscudo` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_{9C24A4D6-A388-4909-A2C5-E25995A5DE6D}` (`idtipoUnidad` ASC) ,
  INDEX `fk_{74E8FD21-2FA5-42DC-8715-2A134F85D5C3}` (`idRaza` ASC) ,
  CONSTRAINT `fk_{9C24A4D6-A388-4909-A2C5-E25995A5DE6D}`
    FOREIGN KEY (`idtipoUnidad` )
    REFERENCES `tipoUnidad` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{74E8FD21-2FA5-42DC-8715-2A134F85D5C3}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 358
MAX_ROWS = 358
MIN_ROWS = 358
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadMejora` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `nivel` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idUnidad`, `idMejora`) ,
  INDEX `fk_{BAD00952-DF63-4CAC-A721-06B7D9A589A1}` (`idMejora` ASC) ,
  INDEX `fk_{BFDB23D3-4C32-4534-ABCF-C26A01424FE7}` (`idUnidad` ASC) ,
  CONSTRAINT `fk_{BAD00952-DF63-4CAC-A721-06B7D9A589A1}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{BFDB23D3-4C32-4534-ABCF-C26A01424FE7}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 486
MAX_ROWS = 486
MIN_ROWS = 486
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoSoldado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoSoldado` (
  `idTipoSoldado` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idTipoSoldado`) )
AVG_ROW_LENGTH = 8
MAX_ROWS = 8
MIN_ROWS = 8
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `soldado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `soldado` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idTipoSoldado` SMALLINT UNSIGNED NOT NULL ,
  `carga` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`) ,
  INDEX `fk_{08EDF5A6-07E0-4C4E-908C-CF516D9A2202}` (`idTipoSoldado` ASC) ,
  CONSTRAINT `fk_{B413CB78-B374-46EB-B305-A79F7A62FC38}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{08EDF5A6-07E0-4C4E-908C-CF516D9A2202}`
    FOREIGN KEY (`idTipoSoldado` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 220, 
COMMENT = 'Informacion adicional sobre las unidades soldado.' 
MAX_ROWS = 220
MIN_ROWS = 220
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoNave`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoNave` (
  `idTipoNave` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idTipoNave`) )
AVG_ROW_LENGTH = 5
MAX_ROWS = 5
MIN_ROWS = 5
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `nave`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nave` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idTipoNave` SMALLINT UNSIGNED NOT NULL ,
  `carga` SMALLINT UNSIGNED NOT NULL ,
  `stargate` BIT NOT NULL DEFAULT 0 ,
  `hiperespacio` BIT NOT NULL DEFAULT 0 ,
  `velocidad` TINYINT UNSIGNED NOT NULL ,
  `cazas` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`) ,
  INDEX `fk_{834E77E7-DF71-474E-8D95-22A621E5A04B}` (`idTipoNave` ASC) ,
  CONSTRAINT `fk_{B60A019C-0BA8-4D89-809A-D44B34F53136}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{834E77E7-DF71-474E-8D95-22A621E5A04B}`
    FOREIGN KEY (`idTipoNave` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 83, 
COMMENT = 'Informacion adicional sobre las unidades nave' 
MAX_ROWS = 83
MIN_ROWS = 83
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoDefensa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoDefensa` (
  `idTipoDefensa` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idTipoDefensa`) )
AVG_ROW_LENGTH = 4
MAX_ROWS = 4
MIN_ROWS = 4
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `defensa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `defensa` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idTipoDefensa` SMALLINT UNSIGNED NOT NULL ,
  `autodestruye` BIT NOT NULL DEFAULT 0 ,
  `tiempoMover` SMALLINT UNSIGNED NULL DEFAULT NULL ,
  PRIMARY KEY (`idUnidad`) ,
  INDEX `fk_{CCFFD92C-80F9-4951-8F93-BB1305C19654}` (`idTipoDefensa` ASC) ,
  CONSTRAINT `fk_{8F53CD45-1B49-4310-A770-863C25DFA4C3}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{CCFFD92C-80F9-4951-8F93-BB1305C19654}`
    FOREIGN KEY (`idTipoDefensa` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 35, 
COMMENT = 'Informacion adicional sobre las unidades de defensa.' 
MAX_ROWS = 35
MIN_ROWS = 35
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `recursoUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `recursoUnidad` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`, `idTipoRecurso`) ,
  INDEX `fk_{76B01CA0-1798-45E6-97E4-00D2E947413E}` (`idUnidad` ASC) ,
  INDEX `fk_{9F414513-FE09-4B16-A716-936F195E7131}` (`idTipoRecurso` ASC) ,
  CONSTRAINT `fk_{76B01CA0-1798-45E6-97E4-00D2E947413E}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{9F414513-FE09-4B16-A716-936F195E7131}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 851
MAX_ROWS = 851
MIN_ROWS = 851
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `planetaUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `planetaUnidad` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idPlanetaEsp` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`, `idPlanetaEsp`, `idGalaxia`) ,
  INDEX `fk_{32FA130C-C3DA-4EB0-8974-1A8B0F144AB8}` (`idPlanetaEsp` ASC, `idGalaxia` ASC) ,
  INDEX `fk_{6EBD1AE7-EC4B-44E2-A6B1-4944121475F4}` (`idUnidad` ASC) ,
  CONSTRAINT `fk_{32FA130C-C3DA-4EB0-8974-1A8B0F144AB8}`
    FOREIGN KEY (`idPlanetaEsp` , `idGalaxia` )
    REFERENCES `planetaEspecial` (`idPlanetaEsp` , `idGalaxia` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{6EBD1AE7-EC4B-44E2-A6B1-4944121475F4}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 193
MAX_ROWS = 193
MIN_ROWS = 193
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadHeroe`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadHeroe` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`) ,
  CONSTRAINT `fk_{A894518A-B328-49E1-BD48-2AB041798133}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 179
MAX_ROWS = 179
MIN_ROWS = 179
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `comercioEnviaTipoRecurso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comercioEnviaTipoRecurso` (
  `idComercio` INT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idComercio`, `idTipoRecurso`) ,
  INDEX `fk_{E4028200-E1BC-4503-942A-C55D5C84301E}` (`idComercio` ASC) ,
  INDEX `fk_{CE7FA4B1-7BF6-430A-845D-60F114DFB429}` (`idTipoRecurso` ASC) ,
  CONSTRAINT `fk_{E4028200-E1BC-4503-942A-C55D5C84301E}`
    FOREIGN KEY (`idComercio` )
    REFERENCES `comercio` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{CE7FA4B1-7BF6-430A-845D-60F114DFB429}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoRecursoUsuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoRecursoUsuario` (
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` DECIMAL(16,6) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idTipoRecurso`, `idJugador`) ,
  INDEX `fk_{969590D2-8216-458E-9241-D0D98767F34B}` (`idTipoRecurso` ASC) ,
  INDEX `fk_{F07514D3-433D-4A6B-B309-EE71D7D00ADB}` (`idJugador` ASC) ,
  CONSTRAINT `fk_{969590D2-8216-458E-9241-D0D98767F34B}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{F07514D3-433D-4A6B-B309-EE71D7D00ADB}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `comercioRecibeTipoRecurso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `comercioRecibeTipoRecurso` (
  `idComercio` INT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idComercio`, `idTipoRecurso`) ,
  INDEX `fk_{3C0F27B3-B804-4337-9749-6F09638424F9}` (`idComercio` ASC) ,
  INDEX `fk_{F6664C84-3BEC-4B5C-A80C-DE728346D7A5}` (`idTipoRecurso` ASC) ,
  CONSTRAINT `fk_{3C0F27B3-B804-4337-9749-6F09638424F9}`
    FOREIGN KEY (`idComercio` )
    REFERENCES `comercio` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{F6664C84-3BEC-4B5C-A80C-DE728346D7A5}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `razaComercio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `razaComercio` (
  `idRazaRecibe` TINYINT UNSIGNED NOT NULL ,
  `idRazaEnvia` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idRazaRecibe`, `idRazaEnvia`) ,
  INDEX `fk_{A7E6202D-2515-4C9F-9821-F1713D29B6AF}` (`idRazaEnvia` ASC) ,
  INDEX `fk_{C771E5B9-042F-4D51-9F76-00E68D52916D}` (`idRazaRecibe` ASC) ,
  CONSTRAINT `fk_{A7E6202D-2515-4C9F-9821-F1713D29B6AF}`
    FOREIGN KEY (`idRazaEnvia` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{C771E5B9-042F-4D51-9F76-00E68D52916D}`
    FOREIGN KEY (`idRazaRecibe` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 20
MAX_ROWS = 20
MIN_ROWS = 20
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mejoraTipoRecurso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mejoraTipoRecurso` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `porcentaje` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idMejora`, `idTipoRecurso`) ,
  INDEX `fk_{A2544300-6018-47B8-801D-1A2DC7C27942}` (`idTipoRecurso` ASC) ,
  INDEX `fk_{1E4EE914-DA40-4F85-82EA-ECFB1A36706B}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{A2544300-6018-47B8-801D-1A2DC7C27942}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{1E4EE914-DA40-4F85-82EA-ECFB1A36706B}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 26
MAX_ROWS = 26
MIN_ROWS = 26
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorMejoraInvestiga`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorMejoraInvestiga` (
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `tiempoInicial` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `tiempoFinal` TIMESTAMP NOT NULL DEFAULT '1971-01-01 00:00:01' ,
  PRIMARY KEY (`idJugador`) ,
  INDEX `fk_{886F1473-4567-48B9-B269-E77EA8DC33E2}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{6DA76416-599F-4AB1-81B7-FDD6E961F6FC}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{886F1473-4567-48B9-B269-E77EA8DC33E2}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoMejora` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 5
MAX_ROWS = 5
MIN_ROWS = 5
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mejoraTipoUnidadTipoMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mejoraTipoUnidadTipoMejora` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idTipoMejora` SMALLINT UNSIGNED NOT NULL ,
  `idTipoUnidad` TINYINT UNSIGNED NOT NULL ,
  `porcentaje` SMALLINT NOT NULL ,
  PRIMARY KEY (`idMejora`, `idTipoMejora`, `idTipoUnidad`) ,
  INDEX `fk_{05E790F1-0E9A-43F5-8740-EEF85DDC5B33}` (`idMejora` ASC) ,
  INDEX `fk_{D11B3D3B-3CAB-4895-854D-824DDFB5B6E4}` (`idTipoMejora` ASC) ,
  INDEX `fk_{1081A249-DF12-48F8-81C3-3E5C15BCBACC}` (`idTipoUnidad` ASC) ,
  CONSTRAINT `fk_{05E790F1-0E9A-43F5-8740-EEF85DDC5B33}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{D11B3D3B-3CAB-4895-854D-824DDFB5B6E4}`
    FOREIGN KEY (`idTipoMejora` )
    REFERENCES `tipoMejora` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{1081A249-DF12-48F8-81C3-3E5C15BCBACC}`
    FOREIGN KEY (`idTipoUnidad` )
    REFERENCES `tipoUnidad` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 660
MAX_ROWS = 660
MIN_ROWS = 660
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `grupoMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grupoMejora` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mejoraNormal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mejoraNormal` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `tiempo` SMALLINT UNSIGNED NOT NULL ,
  `puntos` SMALLINT UNSIGNED NULL ,
  `idGrupo` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idMejora`) ,
  INDEX `fk_mejoraNormal_gruposMejora` (`idGrupo` ASC) ,
  INDEX `fk_{4066071D-2B76-45D1-AAAB-EC3EE84DEBC6}` (`idRaza` ASC) ,
  CONSTRAINT `fk_{0F68CFCF-EBF5-429F-BF56-9E6E40602900}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{4066071D-2B76-45D1-AAAB-EC3EE84DEBC6}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mejoraNormal_gruposMejora`
    FOREIGN KEY (`idGrupo` )
    REFERENCES `grupoMejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `recursoMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `recursoMejora` (
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idTipoRecurso`, `idMejora`) ,
  INDEX `fk_{0A93845E-6A9B-4214-B37D-3C1809A7B28B}` (`idTipoRecurso` ASC) ,
  INDEX `fk_{59DF5265-0DD5-4F8C-A0CF-2927CB8ABC3F}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{0A93845E-6A9B-4214-B37D-3C1809A7B28B}`
    FOREIGN KEY (`idTipoRecurso` )
    REFERENCES `tipoRecurso` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{59DF5265-0DD5-4F8C-A0CF-2927CB8ABC3F}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejoraNormal` (`idMejora` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 164
MAX_ROWS = 164
MIN_ROWS = 164
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especial`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especial` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL DEFAULT '' ,
  `descripcion` TEXT NOT NULL ,
  `especificacion` TEXT NOT NULL ,
  `tiempoRecarga` MEDIUMINT UNSIGNED NOT NULL ,
  `tiempoDuracion` MEDIUMINT UNSIGNED NOT NULL ,
  `activo` BIT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idEspecial`) )
AVG_ROW_LENGTH = 109
MAX_ROWS = 109
MIN_ROWS = 109
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialRequierePlaneta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialRequierePlaneta` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idPlanetaEsp` MEDIUMINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idEspecial`, `idGalaxia`, `idPlanetaEsp`) ,
  INDEX `fk_{63F53A1D-7DBD-493F-934D-D6B1E076D418}` (`idPlanetaEsp` ASC, `idGalaxia` ASC) ,
  INDEX `fk_{FF02AEC5-CBE4-417F-8B53-BEF043E410AA}` (`idEspecial` ASC) ,
  CONSTRAINT `fk_{63F53A1D-7DBD-493F-934D-D6B1E076D418}`
    FOREIGN KEY (`idPlanetaEsp` , `idGalaxia` )
    REFERENCES `planetaEspecial` (`idPlanetaEsp` , `idGalaxia` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{FF02AEC5-CBE4-417F-8B53-BEF043E410AA}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 48
MAX_ROWS = 48
MIN_ROWS = 48
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadHeroeMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadHeroeMejora` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idUnidadHeroe` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idMejora`, `idUnidadHeroe`) ,
  INDEX `fk_{38B0E476-5D89-42F7-8FCB-6109E681BFEC}` (`idUnidadHeroe` ASC) ,
  INDEX `fk_{1CCACD88-4CF6-414C-9BF7-DD7485570553}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{38B0E476-5D89-42F7-8FCB-6109E681BFEC}`
    FOREIGN KEY (`idUnidadHeroe` )
    REFERENCES `unidadHeroe` (`idUnidad` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{1CCACD88-4CF6-414C-9BF7-DD7485570553}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadConstruir`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadConstruir` (
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL DEFAULT 1 ,
  `fechaConstruccionInicial` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `fechaConstruccionFinal` TIMESTAMP NOT NULL DEFAULT '1971-01-01 00:00:01' ,
  PRIMARY KEY (`idGalaxia`, `idPlaneta`, `idJugador`, `idUnidad`) ,
  INDEX `fk_unidadConstruir_jugador` (`idJugador` ASC) ,
  INDEX `fk_{F40ABB0A-2B27-4B38-AFD4-81B6F02E51B4}` (`idUnidad` ASC) ,
  INDEX `fk_{30C3D147-472E-4827-9033-F3404150CDF3}` (`idPlaneta` ASC, `idGalaxia` ASC) ,
  CONSTRAINT `fk_{F40ABB0A-2B27-4B38-AFD4-81B6F02E51B4}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{30C3D147-472E-4827-9033-F3404150CDF3}`
    FOREIGN KEY (`idPlaneta` , `idGalaxia` )
    REFERENCES `planetaColonizado` (`idPlaneta` , `idGalaxia` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_unidadConstruir_jugador`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialRequiereUnidadHeroe`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialRequiereUnidadHeroe` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idUnidadHeroe` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idEspecial`, `idUnidadHeroe`) ,
  INDEX `fk_{D0209D6A-E33D-40EF-84F5-6FC55796364E}` (`idEspecial` ASC) ,
  INDEX `fk_{F9ADC712-C2DA-4607-B13F-C0A577226856}` (`idUnidadHeroe` ASC) ,
  CONSTRAINT `fk_{D0209D6A-E33D-40EF-84F5-6FC55796364E}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{F9ADC712-C2DA-4607-B13F-C0A577226856}`
    FOREIGN KEY (`idUnidadHeroe` )
    REFERENCES `unidadHeroe` (`idUnidad` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 77
MAX_ROWS = 77
MIN_ROWS = 77
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialMejora` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idEspecial`, `idMejora`) ,
  INDEX `fk_{B1DA7CDC-EE39-48E4-BBBB-AD1058080651}` (`idEspecial` ASC) ,
  INDEX `fk_{B683910C-A934-43B9-9A0B-D43FD8832258}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{B1DA7CDC-EE39-48E4-BBBB-AD1058080651}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{B683910C-A934-43B9-9A0B-D43FD8832258}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoMision`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoMision` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  `tiempo` VARCHAR(5) NOT NULL ,
  `permanencia` BIT NOT NULL DEFAULT 0 ,
  `traslado` BIT NOT NULL DEFAULT 0 ,
  `roboPlaneta` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 7
MAX_ROWS = 7
MIN_ROWS = 7
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mision`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mision` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idTipoMision` TINYINT UNSIGNED NOT NULL ,
  `idGalaxiaOrigen` TINYINT UNSIGNED NOT NULL ,
  `idPlanetaOrigen` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxiaDestino` TINYINT UNSIGNED NOT NULL ,
  `idPlanetaDestino` MEDIUMINT UNSIGNED NOT NULL ,
  `fechaSalida` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `tiempoTrayecto` BIGINT NOT NULL ,
  `vuelta` BIT NOT NULL DEFAULT 0 ,
  `nuevaMision` BIT NOT NULL DEFAULT 0 ,
  `idGalaxiaDespliegue` TINYINT UNSIGNED DEFAULT NULL ,
  `idPlanetaDespliegue` MEDIUMINT UNSIGNED DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_mision_planeta1` (`idPlanetaOrigen` ASC, `idGalaxiaOrigen` ASC) ,
  INDEX `fk_mision_planeta2` (`idPlanetaDestino` ASC, `idGalaxiaDestino` ASC) ,
  INDEX `fk_mision_planeta3` (`idPlanetaDespliegue` ASC, `idGalaxiaDespliegue` ASC) ,
  INDEX `fk_mision_jugador1` (`idJugador` ASC) ,
  INDEX `fk_{90E0164D-CD32-46EB-AEBA-FE12A0CA2CCA}` (`idTipoMision` ASC) ,
  CONSTRAINT `fk_{90E0164D-CD32-46EB-AEBA-FE12A0CA2CCA}`
    FOREIGN KEY (`idTipoMision` )
    REFERENCES `tipoMision` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mision_planeta1`
    FOREIGN KEY (`idPlanetaOrigen` , `idGalaxiaOrigen` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mision_planeta2`
    FOREIGN KEY (`idPlanetaDestino` , `idGalaxiaDestino` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mision_planeta3`
    FOREIGN KEY (`idPlanetaDespliegue` , `idGalaxiaDespliegue` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mision_jugador1`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadJugadorPlaneta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadJugadorPlaneta` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL ,
  `cantidadEnMision` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `contable` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idUnidad`, `idPlaneta`, `idGalaxia`, `idJugador`) ,
  INDEX `fk_{6CD6B98D-1F19-4EA2-85FF-A644C4AFC032}` (`idUnidad` ASC) ,
  INDEX `fk_{78B11FF4-043B-44E1-ACC6-DEA0EC91DD4A}` (`idJugador` ASC) ,
  INDEX `fk_{05BFB261-EE1F-4660-B65D-D971D92FF236}` (`idPlaneta` ASC, `idGalaxia` ASC) ,
  CONSTRAINT `fk_{6CD6B98D-1F19-4EA2-85FF-A644C4AFC032}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{78B11FF4-043B-44E1-ACC6-DEA0EC91DD4A}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{05BFB261-EE1F-4660-B65D-D971D92FF236}`
    FOREIGN KEY (`idPlaneta` , `idGalaxia` )
    REFERENCES `planeta` (`idPlaneta` , `idGalaxia` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadJugadorPlanetaMision`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadJugadorPlanetaMision` (
  `idMision` BIGINT UNSIGNED NOT NULL ,
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `cantidadActual` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `cantidadEnviada` INT UNSIGNED NOT NULL ,
  `contable` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idMision`, `idUnidad`) ,
  INDEX `fk_{24838B54-C9A4-4A87-B323-6F2ECE4B74E5}` (`idUnidad` ASC, `idPlaneta` ASC, `idGalaxia` ASC, `idJugador` ASC) ,
  INDEX `fk_{275437B7-809F-4823-9A14-F7AF2944B3D0}` (`idMision` ASC) ,
  CONSTRAINT `fk_{24838B54-C9A4-4A87-B323-6F2ECE4B74E5}`
    FOREIGN KEY (`idUnidad` , `idPlaneta` , `idGalaxia` , `idJugador` )
    REFERENCES `unidadJugadorPlaneta` (`idUnidad` , `idPlaneta` , `idGalaxia` , `idJugador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{275437B7-809F-4823-9A14-F7AF2944B3D0}`
    FOREIGN KEY (`idMision` )
    REFERENCES `mision` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialUnidad` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` DECIMAL(4,1) NULL DEFAULT NULL ,
  PRIMARY KEY (`idEspecial`, `idUnidad`) ,
  INDEX `fk_{00597A0B-FB38-403A-B1F4-AA44EB5A2AB9}` (`idUnidad` ASC) ,
  INDEX `fk_{121F62AA-90D0-40BC-86F7-F5952A928914}` (`idEspecial` ASC) ,
  CONSTRAINT `fk_{00597A0B-FB38-403A-B1F4-AA44EB5A2AB9}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{121F62AA-90D0-40BC-86F7-F5952A928914}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 89
MAX_ROWS = 89
MIN_ROWS = 89
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorEspecialActivo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorEspecialActivo` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idExplorador` SMALLINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL ,
  `finEspecial` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`idEspecial`, `idJugador`) ,
  INDEX `fk_{C22CB379-AD54-4BF3-966F-88E914AD5680}` (`idJugador` ASC) ,
  INDEX `fk_{2DA86561-6D15-4145-AB9A-A4FDA9A0C1E7}` (`idEspecial` ASC) ,
  INDEX `fk_jugadorEspecialActivo_planetaExplorado1` (`idPlaneta` ASC, `idGalaxia` ASC, `idExplorador` ASC) ,
  CONSTRAINT `fk_{C22CB379-AD54-4BF3-966F-88E914AD5680}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{2DA86561-6D15-4145-AB9A-A4FDA9A0C1E7}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_jugadorEspecialActivo_planetaExplorado1`
    FOREIGN KEY (`idPlaneta` , `idGalaxia` , `idExplorador` )
    REFERENCES `planetaExplorado` (`idPlaneta` , `idGalaxia` , `idJugador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialRequiereMejoraNormal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialRequiereMejoraNormal` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `nivel` TINYINT UNSIGNED NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idEspecial`, `idMejora`) ,
  INDEX `fk_{582DAC91-3F33-4613-AC5E-11A2702832E5}` (`idEspecial` ASC) ,
  INDEX `fk_{D191D7D6-5CB4-4EB0-9877-161F56AF796C}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{582DAC91-3F33-4613-AC5E-11A2702832E5}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{D191D7D6-5CB4-4EB0-9877-161F56AF796C}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 178
MAX_ROWS = 178
MIN_ROWS = 178
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorMejora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorMejora` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `nivel` TINYINT(2) UNSIGNED NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idMejora`, `idJugador`) ,
  INDEX `fk_{17D563B3-DF1F-4595-A429-22BB20C6494C}` (`idJugador` ASC) ,
  INDEX `fk_{32EF6589-18D6-4C53-9BFB-47A8124BEB32}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{17D563B3-DF1F-4595-A429-22BB20C6494C}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{32EF6589-18D6-4C53-9BFB-47A8124BEB32}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `unidadRequerida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `unidadRequerida` (
  `idUnidadRequerida` SMALLINT UNSIGNED NOT NULL ,
  `idUnidadRequiere` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idUnidadRequerida`, `idUnidadRequiere`) ,
  INDEX `fk_{F4875F49-B4D3-40D6-B165-8E6EFD680F64}` (`idUnidadRequiere` ASC) ,
  INDEX `fk_{6343A781-22B4-4983-AF2C-D33C487B3760}` (`idUnidadRequerida` ASC) ,
  CONSTRAINT `fk_{F4875F49-B4D3-40D6-B165-8E6EFD680F64}`
    FOREIGN KEY (`idUnidadRequiere` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{6343A781-22B4-4983-AF2C-D33C487B3760}`
    FOREIGN KEY (`idUnidadRequerida` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 17
MAX_ROWS = 17
MIN_ROWS = 17
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorEspecialEspera`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorEspecialEspera` (
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `tiempoFinalEspera` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`idEspecial`, `idJugador`) ,
  INDEX `fk_{11FB8945-FA8B-4F42-9C36-3EE522067CA1}` (`idJugador` ASC) ,
  INDEX `fk_{58B8111F-D88E-41BA-B10F-BEF020767C24}` (`idEspecial` ASC) ,
  CONSTRAINT `fk_{11FB8945-FA8B-4F42-9C36-3EE522067CA1}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{58B8111F-D88E-41BA-B10F-BEF020767C24}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `razaGalaxiaOrigen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `razaGalaxiaOrigen` (
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idGalaxia`, `idRaza`) ,
  INDEX `fk_{BCC1964B-1357-4963-BC4F-D734D34C6153}` (`idRaza` ASC) ,
  INDEX `fk_{7BB0E399-9E91-4585-9CE5-9843D21E4538}` (`idGalaxia` ASC) ,
  CONSTRAINT `fk_{BCC1964B-1357-4963-BC4F-D734D34C6153}`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{7BB0E399-9E91-4585-9CE5-9843D21E4538}`
    FOREIGN KEY (`idGalaxia` )
    REFERENCES `galaxia` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 11
MAX_ROWS = 11
MIN_ROWS = 11
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `especialCapturaUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `especialCapturaUnidad` (
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `idEspecial` SMALLINT UNSIGNED NOT NULL ,
  `idUnidadConvertir` SMALLINT UNSIGNED NULL ,
  `probabilidad` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idUnidad`, `idEspecial`) ,
  INDEX `fk_{4692EA0B-5090-4DE5-BCAB-ECCF0FCD3A48}` (`idUnidad` ASC) ,
  INDEX `fk_{F9F9B7F4-3F90-4113-88B7-F19A009FFB77}` (`idEspecial` ASC) ,
  INDEX `fk_{8E9B7C9F-5CBC-4D92-AD79-FA8FADF83B7B}` (`idUnidadConvertir` ASC) ,
  CONSTRAINT `fk_{4692EA0B-5090-4DE5-BCAB-ECCF0FCD3A48}`
    FOREIGN KEY (`idUnidad` )
    REFERENCES `unidad` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{F9F9B7F4-3F90-4113-88B7-F19A009FFB77}`
    FOREIGN KEY (`idEspecial` )
    REFERENCES `especial` (`idEspecial` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{8E9B7C9F-5CBC-4D92-AD79-FA8FADF83B7B}`
    FOREIGN KEY (`idUnidadConvertir` )
    REFERENCES `unidad` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 328
MAX_ROWS = 328
MIN_ROWS = 328
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `tipoMejoraGeneral`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipoMejoraGeneral` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
AVG_ROW_LENGTH = 4
MAX_ROWS = 4
MIN_ROWS = 4
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mejoraTipoMejoraGeneral`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mejoraTipoMejoraGeneral` (
  `idMejora` SMALLINT UNSIGNED NOT NULL ,
  `idTipoMejora` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idMejora`, `idTipoMejora`) ,
  INDEX `fk_{ADA75156-C767-4A26-8280-C8B17FFF492F}` (`idTipoMejora` ASC) ,
  INDEX `fk_{E6352C71-C321-4B34-912B-F619449A7E71}` (`idMejora` ASC) ,
  CONSTRAINT `fk_{ADA75156-C767-4A26-8280-C8B17FFF492F}`
    FOREIGN KEY (`idTipoMejora` )
    REFERENCES `tipoMejoraGeneral` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_{E6352C71-C321-4B34-912B-F619449A7E71}`
    FOREIGN KEY (`idMejora` )
    REFERENCES `mejora` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
AVG_ROW_LENGTH = 15
MAX_ROWS = 15
MIN_ROWS = 15
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorInfoUnidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorInfoUnidades` (
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `soldadosCarga` SMALLINT NOT NULL DEFAULT 0 ,
  `soldadosAtaque` SMALLINT NOT NULL DEFAULT 0 ,
  `soldadosResistencia` SMALLINT NOT NULL DEFAULT 0 ,
  `soldadosEscudo` SMALLINT NOT NULL DEFAULT 0 ,
  `navesCarga` SMALLINT NOT NULL DEFAULT 0 ,
  `navesAtaque` SMALLINT NOT NULL DEFAULT 0 ,
  `navesResistencia` SMALLINT NOT NULL DEFAULT 0 ,
  `navesEscudo` SMALLINT NOT NULL DEFAULT 0 ,
  `navesVelocidad` SMALLINT NOT NULL DEFAULT 0 ,
  `defensasAtaque` SMALLINT NOT NULL DEFAULT 0 ,
  `defensasResistencia` SMALLINT NOT NULL DEFAULT 0 ,
  `defensasEscudo` SMALLINT NOT NULL DEFAULT 0 ,
  `invisible` BIT NOT NULL DEFAULT 0 ,
  `atraviesaIris` BIT NOT NULL DEFAULT 0 ,
  `viajeIntergalactico` BIT NOT NULL DEFAULT 0 ,
  `stargateIntergalactico` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idJugador`) ,
  CONSTRAINT `fk_{CAC429FF-BBAE-491E-A43D-028206C8EF45}`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorInfoGeneral`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorInfoGeneral` (
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `investigacionVelocidad` SMALLINT NOT NULL DEFAULT 0 ,
  `construccionVelocidad` SMALLINT NOT NULL DEFAULT 0 ,
  `numeroMensajes` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  `limiteMisiones` TINYINT UNSIGNED NOT NULL ,
  `numNaves` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `numSoldados` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `limiteSoldados` INT UNSIGNED NOT NULL ,
  `numDefensas` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `produccionPrimario` DECIMAL(16,6) UNSIGNED NOT NULL DEFAULT 0 ,
  `produccionSecundario` DECIMAL(16,6) UNSIGNED NOT NULL DEFAULT 0 ,
  `produccionEnergia` DECIMAL(16,6) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idJugador`) ,
  CONSTRAINT `fk_jugadorInfoGeneral_jugador1`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `jugadorInfoPuntuaciones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `jugadorInfoPuntuaciones` (
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `puntosNaves` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  `puntosSoldados` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  `puntosDefensas` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  `puntosTecnologias` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  `puntosTotales` BIGINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idJugador`) ,
  INDEX `jugadorInfoPuntuaciones-Jugador` (`idJugador` ASC) ,
  CONSTRAINT `jugadorInfoPuntuaciones-Jugador`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `recursosObtenidos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `recursosObtenidos` (
  `idMision` BIGINT UNSIGNED NOT NULL ,
  `idTipoRecurso` TINYINT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idMision`, `idTipoRecurso`, `idJugador`) ,
  INDEX `fk_mision_has_tipoRecursoUsuario_mision` (`idMision` ASC) ,
  INDEX `fk_mision_has_tipoRecursoUsuario_tipoRecursoUsuario` (`idTipoRecurso` ASC, `idJugador` ASC) ,
  CONSTRAINT `fk_mision_has_tipoRecursoUsuario_mision`
    FOREIGN KEY (`idMision` )
    REFERENCES `mision` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_mision_has_tipoRecursoUsuario_tipoRecursoUsuario`
    FOREIGN KEY (`idTipoRecurso` , `idJugador` )
    REFERENCES `tipoRecursoUsuario` (`idTipoRecurso` , `idJugador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `razaCapturaUnidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `razaCapturaUnidad` (
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `idUnidadCapturada` SMALLINT UNSIGNED NOT NULL ,
  `idUnidadConvertida` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idRaza`, `idUnidadConvertida`, `idUnidadCapturada`) ,
  INDEX `fk_razaCapturaUnidad_raza1` (`idRaza` ASC) ,
  INDEX `fk_razaCapturaUnidad_unidad1` (`idUnidadCapturada` ASC) ,
  INDEX `fk_razaCapturaUnidad_unidad2` (`idUnidadConvertida` ASC) ,
  CONSTRAINT `fk_razaCapturaUnidad_raza1`
    FOREIGN KEY (`idRaza` )
    REFERENCES `raza` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_razaCapturaUnidad_unidad1`
    FOREIGN KEY (`idUnidadCapturada` )
    REFERENCES `unidad` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_razaCapturaUnidad_unidad2`
    FOREIGN KEY (`idUnidadConvertida` )
    REFERENCES `unidad` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `infoJugadoresBatalla`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `infoJugadoresBatalla` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idRaza` TINYINT UNSIGNED NOT NULL ,
  `idAlianza` SMALLINT UNSIGNED NULL ,
  `nombreJugador` VARCHAR(255) NOT NULL ,
  `nombreRaza` VARCHAR(255) NOT NULL ,
  `nombreAlianza` VARCHAR(255) NOT NULL DEFAULT '' ,
  INDEX `fk_infoJugadoresBatalla_mensaje1` (`idMensaje` ASC) ,
  PRIMARY KEY (`idMensaje`, `idJugador`) ,
  CONSTRAINT `fk_infoJugadoresBatalla_mensaje1`
    FOREIGN KEY (`idMensaje` )
    REFERENCES `mensaje` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `infoMisUnidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `infoMisUnidades` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idUnidad` SMALLINT NOT NULL ,
  `idTipoUnidad` TINYINT NOT NULL ,
  `nombreUnidad` VARCHAR(255) NOT NULL ,
  `cantidadInicial` INT NOT NULL ,
  `cantidadFinal` INT NOT NULL ,
  `puntosUnidad` BIGINT NOT NULL ,
  INDEX `fk_infoUnidadesBatalla_infoJugadoresBatalla1` (`idMensaje` ASC, `idJugador` ASC) ,
  PRIMARY KEY (`idMensaje`, `idJugador`, `idUnidad`) ,
  CONSTRAINT `fk_infoUnidadesBatalla_infoJugadoresBatalla1`
    FOREIGN KEY (`idMensaje` , `idJugador` )
    REFERENCES `infoJugadoresBatalla` (`idMensaje` , `idJugador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reporte`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `reporte` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `html` TEXT NOT NULL ,
  INDEX `fk_reporte_mensaje1` (`idMensaje` ASC) ,
  PRIMARY KEY (`idMensaje`) ,
  CONSTRAINT `fk_reporte_mensaje1`
    FOREIGN KEY (`idMensaje` )
    REFERENCES `mensaje` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `infoUnidadesAtacadas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `infoUnidadesAtacadas` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `idUnidad` SMALLINT UNSIGNED NOT NULL ,
  `tipo` TINYINT UNSIGNED NOT NULL ,
  `idTipoUnidad` TINYINT UNSIGNED NOT NULL ,
  `nombreUnidad` VARCHAR(255) NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL ,
  `puntosObtenidos` BIGINT NOT NULL ,
  INDEX `fk_table1_infoJugadoresBatalla1` (`idMensaje` ASC, `idJugador` ASC) ,
  PRIMARY KEY (`idMensaje`, `idJugador`, `idUnidad`, `tipo`) ,
  CONSTRAINT `fk_table1_infoJugadoresBatalla1`
    FOREIGN KEY (`idMensaje` , `idJugador` )
    REFERENCES `infoJugadoresBatalla` (`idMensaje` , `idJugador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `infoGeneralBatalla`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `infoGeneralBatalla` (
  `idMensaje` INT UNSIGNED NOT NULL ,
  `idPlaneta` MEDIUMINT NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL ,
  INDEX `fk_infoGeneralBatalla_mensaje1` (`idMensaje` ASC) ,
  PRIMARY KEY (`idMensaje`) ,
  CONSTRAINT `fk_infoGeneralBatalla_mensaje1`
    FOREIGN KEY (`idMensaje` )
    REFERENCES `mensaje` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `evento` (
  `idEvento` BIGINT NOT NULL AUTO_INCREMENT ,
  `idJugador` SMALLINT UNSIGNED NOT NULL ,
  `tiempo` TIMESTAMP NOT NULL ,
  `tipo` SMALLINT UNSIGNED NOT NULL ,
  `id` BIGINT UNSIGNED NOT NULL ,
  `idGalaxia` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `idPlaneta` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0 ,
  INDEX `fk_evento_jugador1` (`idJugador` ASC) ,
  INDEX `buscar_eventos_jug` (`idJugador` ASC, `tiempo` ASC) ,
  INDEX `buscar_planeta_afectado` (`idGalaxia` ASC, `idPlaneta` ASC) ,
  PRIMARY KEY (`idEvento`) ,
  INDEX `buscar_evento_jug_tipo` (`idJugador` ASC, `tipo` ASC, `id` ASC) ,
  CONSTRAINT `fk_evento_jugador1`
    FOREIGN KEY (`idJugador` )
    REFERENCES `jugador` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fuegoDefensaDefensa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoDefensaDefensa` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoDefensa_has_tipoDefensa_tipoDefensa2` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoDefensa_has_tipoDefensa_tipoDefensa1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoDefensa_has_tipoDefensa_tipoDefensa2`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoDefensaNave`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoDefensaNave` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoDefensa_has_tipoNave_tipoNave1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoDefensa_has_tipoNave_tipoDefensa1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoDefensa_has_tipoNave_tipoNave1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoDefensaSoldado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoDefensaSoldado` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoDefensa_has_tipoSoldado_tipoSoldado1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoDefensa_has_tipoSoldado_tipoDefensa1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoDefensa_has_tipoSoldado_tipoSoldado1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoNaveDefensa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoNaveDefensa` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoNave_has_tipoDefensa_tipoDefensa1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoNave_has_tipoDefensa_tipoNave1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoNave_has_tipoDefensa_tipoDefensa1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoNaveNave`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoNaveNave` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoNave_has_tipoNave_tipoNave2` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoNave_has_tipoNave_tipoNave1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoNave_has_tipoNave_tipoNave2`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoNaveSoldado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoNaveSoldado` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoNave_has_tipoSoldado_tipoSoldado1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoNave_has_tipoSoldado_tipoNave1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoNave_has_tipoSoldado_tipoSoldado1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoSoldadoDefensa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoSoldadoDefensa` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoSoldado_has_tipoDefensa_tipoDefensa1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoSoldado_has_tipoDefensa_tipoSoldado1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoSoldado_has_tipoDefensa_tipoDefensa1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoDefensa` (`idTipoDefensa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoSoldadoNave`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoSoldadoNave` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoSoldado_has_tipoNave_tipoNave1` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoSoldado_has_tipoNave_tipoSoldado1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoSoldado_has_tipoNave_tipoNave1`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoNave` (`idTipoNave` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `fuegoSoldadoSoldado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fuegoSoldadoSoldado` (
  `idAtaca` SMALLINT UNSIGNED NOT NULL ,
  `idDefiende` SMALLINT UNSIGNED NOT NULL ,
  `porcentaje` CHAR(4) NOT NULL ,
  PRIMARY KEY (`idAtaca`, `idDefiende`) ,
  INDEX `fk_tipoSoldado_has_tipoSoldado_tipoSoldado2` (`idDefiende` ASC) ,
  CONSTRAINT `fk_tipoSoldado_has_tipoSoldado_tipoSoldado1`
    FOREIGN KEY (`idAtaca` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoSoldado_has_tipoSoldado_tipoSoldado2`
    FOREIGN KEY (`idDefiende` )
    REFERENCES `tipoSoldado` (`idTipoSoldado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);
