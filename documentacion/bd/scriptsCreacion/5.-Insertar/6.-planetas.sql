CREATE TABLE IF NOT EXISTS tPlaneta (
idPlaneta SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
idGalaxia SMALLINT UNSIGNED NOT NULL ,
nombrePlaneta VARCHAR(255) NOT NULL DEFAULT '' ,
imagen VARCHAR(255) NOT NULL ,
riqueza VARCHAR(3) NOT NULL ,
PRIMARY KEY(idPlaneta, idGalaxia))
ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tPlanetaUnidad (
idUnidad SMALLINT UNSIGNED NOT NULL ,
idPlanetaEsp SMALLINT UNSIGNED NOT NULL ,
idGalaxia SMALLINT UNSIGNED NOT NULL ,
PRIMARY KEY(idUnidad, idPlanetaEsp, idGalaxia))
ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tEspecialRequierePlaneta (
idEspecial SMALLINT UNSIGNED NOT NULL ,
idGalaxia SMALLINT UNSIGNED NOT NULL ,
idPlanetaEsp SMALLINT UNSIGNED NOT NULL ,
PRIMARY KEY(idEspecial, idGalaxia, idPlanetaEsp))
ENGINE=InnoDB;

CREATE  TABLE IF NOT EXISTS tPlanetaMem (
  `idPlaneta` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idGalaxia` SMALLINT UNSIGNED NOT NULL ,
  `nombrePlaneta` VARCHAR(255) NOT NULL DEFAULT '' ,
  `nombreSGC` VARCHAR(255) NOT NULL ,
  `coord1` VARCHAR(2) NOT NULL ,
  `coord2` VARCHAR(2) NOT NULL ,
  `coord3` VARCHAR(2) NOT NULL ,
  `coord4` VARCHAR(2) NOT NULL ,
  `coord5` VARCHAR(2) NOT NULL ,
  `coord6` VARCHAR(2) NOT NULL ,
  `coord7` VARCHAR(2) NOT NULL ,
  `riqueza` VARCHAR(3) NOT NULL ,
  PRIMARY KEY (`idPlaneta`, `idGalaxia`)
)ENGINE = MEMORY;

DELETE FROM tPlaneta;
DELETE FROM tPlanetaMem;
DELETE FROM tPlanetaUnidad;
DELETE FROM tEspecialRequierePlaneta;

INSERT INTO tPlaneta (idPlaneta, idGalaxia, nombrePlaneta, imagen, riqueza) VALUES

#Via Lactea
(1,1,'Abydos','aby7378.jpg',85),
(2,1,'Adara II','ada3866.jpg',60),
(3,1,'Altair','alt2486.jpg',50),
(4,1,'Arkham','ark4614.jpg',90),
(5,1,'B30-255','b309158.jpg',60),
(6,1,'Base Alpha','bas5848.jpg',75),
(7,1,'Base Beta','bas8943.jpg',70),
(8,1,'Base de Anubis','bas5726.jpg',75),
(9,1,'Base del NID','bas3184.jpg',60),
(10,1,'Base Fábrica','bas4390.jpg',50),
(11,1,'Bedrosia','bed2091.jpg',75),
(12,1,'Burrock','bur3271.jpg',80),
(13,1,'Cal Mah','cal6994.jpg',80),
(14,1,'Camelot','cam5986.jpg',90),
(15,1,'Chulak','chu5909.jpg',100),
(16,1,'Cimmeria','cim5976.jpg',80),
(17,1,'Ciudad Tok\'Ra','ciu4530.jpg',90),
(18,1,'Colonia Unas','col5957.jpg',60),
(19,1,'Dakara','dak6444.jpg',60),
(20,1,'Dar Eshkalon','dar4279.jpg',70),
(21,1,'Delmak','del7009.jpg',50),
(22,1,'Depósito Antiguo','dep1498.jpg',100),
(23,1,'Erebo','ere7173.jpg',50),
(24,1,'Euronda','eur2934.jpg',30),
(25,1,'Fortaleza de Nirrti','for5221.jpg',65),
(26,1,'Hadante','had5585.jpg',40),
(27,1,'Haktyl','hak1399.jpg',90),
(28,1,'Hebridan','heb5697.jpg',100),
(29,1,'Heliópolis','hel6244.jpg',70),
(30,1,'Ávalon','hog4223.jpg',80),
(31,1,'Jade','jad4865.jpg',100),
(32,1,'Juna','jun4633.jpg',80),
(33,1,'Kheb','khe7934.jpg',70),
(34,1,'La Tierra','tie7308.jpg',100),
(35,1,'Langara','lan2171.jpg',100),
(36,1,'Latona','lat5063.jpg',75),
(37,1,'Mundo Furling','mun6012.jpg',70),
(38,1,'Gaia','gai6296.jpg',90),
(39,1,'Mundo Sodan','mun7691.jpg',100),
(40,1,'Netu','net2958.jpg',30),
(41,1,'Avnil','p3x8021.jpg',60),
(42,1,'Pangar','pan4585.jpg',80),
(43,1,'Planeta de Hathor','pla4843.jpg',90),
(44,1,'Natal Unas','pla5873.jpg',90),
(45,1,'Planeta Origen','pla1942.jpg',60),
(46,1,'Proclarush Taonas','pro6063.jpg',30),
(47,1,'Quetzalcoalt','que4865.jpg',70),
(48,1,'Reetalia','ree7514.jpg',70),
(49,1,'Revanna','rev7577.jpg',80),
(50,1,'Ruinas Antiguas','rui2965.jpg',80),
(51,1,'Salish','sal5678.jpg',90),
(52,1,'Tartaro','tar8341.jpg',30),
(53,1,'Tegalus','teg9394.jpg',80),
(54,1,'Tollana','tol7592.jpg',100),
(55,1,'Vagonbrei','vag8009.jpg',90),
(56,1,'Velona','vel4983.jpg',90),
(57,1,'Volia','vol3014.jpg',100),
(58,1,'Vorash','vor5327.jpg',80),
(59,1,'Vyus','vyu6057.jpg',90),
(60,1,'Nemesis','nem7036.jpg',70),
(61,1,'Tollan','tol1654.jpg',100),
(62,1,'Sahal','sah9960.jpg',70),
(63,1,'Kreshta','kre2920.jpg',80),
(64,1,'Kallana','kal2152.jpg',40),
(65,1,'Hogar de Ma\'chello','hog2817.jpg',60),
(66,1,'Hanka','han6445.jpg',60),
(67,1,'Ak\'het','akh1853.jpg',80),
(68,1,'Castiana','cas3809.jpg',60),
(69,1,'Cartago','car8657.jpg',80),
(70,1,'Amon Shek','amo2976.jpg',70),
(71,1,'Tobin','tob6068.jpg',50),
(72,1,'Base Ícaro','bas7854.jpg',100),
(73,1,'P7J989','p7J8595.jpg',70),
(74,1,'Bubastis','bub4356.jpg',70),
(75,1,'Aegis','aeg6605.jpg',70),
(76,1,'Talion','tal5853.jpg',75),
(77,1,'Lucian Ícarus','lui3530.jpg',100),
(78,1,'Lucia','luc5370.jpg',100),
(79,1,'Soma Kesh','som7970.jpg',100),
(80,1,'Base Gamma','gam8754.jpg',80),
(81,1,'Oran','ora9023.jpg',60),
(82,1,'Base Kuybyshev','kuy6491.jpg',80),
(83,1,'Herevah','her4697.jpg',10),
(84,1,'Base Científica','bas9647.jpg',80),
(85,1,'Quatum','qua8642.jpg',80),
(86,1,'Praxyon','prax6754.jpg',70),

#Pegasus
(1,2,'Atheros','ath4152.jpg',50),
(2,2,'Athos','ath8160.jpg',90),
(3,2,'Ballkans','bal6356.jpg',70),
(4,2,'Base Genii','bas5044.jpg',90),
(5,2,'Belsa','bel7519.jpg',70),
(6,2,'Bolok','bol4249.jpg',75),
(7,2,'Centro científico','cen8743.jpg',70),
(8,2,'Cloister','clo7518.jpg',75),
(9,2,'Clonadora','clo5971.jpg',60),
(10,2,'Dagan','dag2147.jpg',60),
(11,2,'Doranda','dor2853.jpg',75),
(12,2,'Eldreds','eld6760.jpg',80),
(13,2,'Geldar','gel4736.jpg',80),
(14,2,'Genii','gen1620.jpg',90),
(15,2,'Gohari','goh9965.jpg',40),
(16,2,'Guarida Ford','gua3452.jpg',80),
(17,2,'Hoff','hof1901.jpg',90),
(18,2,'Kera','ker6745.jpg',60),
(19,2,'Lantea','lan1435.jpg',60),
(20,2,'Nueva Athos','nue9928.jpg',70),
(21,2,'Lantis','lan9908.jpg',60),
(22,2,'Nueva Taranis','nue4444.jpg',70),
(23,2,'Olesia','ole2325.jpg',80),
(24,2,'Planeta 177','pla6805.jpg',60),
(25,2,'Planeta de Lucius','pla5041.jpg',65),
(26,2,'Natal Wraith','pla9840.jpg',40),
(27,2,'Proculus','pro5911.jpg',90),
(28,2,'Ruinas industriales','rui8014.jpg',60),
(29,2,'Sateda','sat9459.jpg',80),
(30,2,'Taranis','tar8682.jpg',80),
(31,2,'Villa de Elson','vil8178.jpg',80),
(32,2,'Fog Town','fog4967.jpg',60),
(33,2,'Capital Coalición','cap7092.jpg',90),
(34,2,'Manaria','man1793.jpg',70),
(35,2,'Planeta Luciérnaga','luc6539.jpg',30),
(36,2,'Base Alpha Pegasus','bap7985.jpg',30),
(37,2,'Colonia Traveller','col7865.jpg',80),
(38,2,'Thenora','the5601.jpg',70),
(39,2,'Talus','tal9126.jpg',90),
(40,2,'Vapolova','vap2466.jpg',80),

#Andromeda
(1,3,'Bilskirnir','bil6611.jpg',85),
(2,3,'Celestis','cel4044.jpg',100),
(3,3,'Halla','hal1006.jpg',40),
(4,3,'Jesave','jes1030.jpg',60),
(5,3,'Lokasenna','lok2970.jpg',90),
(6,3,'Midgard','mid9281.jpg',75),
(7,3,'Orilla','ori4643.jpg',90),
(8,3,'Ortus Mallum','ort2997.jpg',60),
(9,3,'Othala','oth4394.jpg',90),
(10,3,'Skaldskaparmal ','ska3153.jpg',90),
(11,3,'Ucayaquil','uca6507.jpg',85),
(12,3,'Ver Airis','ver3612.jpg',80),
(13,3,'Ver Egen','ver1499.jpg',80),
(14,3,'Ver Isca','ver6896.jpg',80),
(15,3,'Kounded Wnee','wou2278.jpg',80),
(16,3,'Bwrellicef','bwr2040.jpg',90),
(17,3,'Radiantia','rad7731.jpg',70),
(18,3,'Jungla Oscura','jun8203.jpg',70),
(19,3,'Hoth','hot8219.jpg',20),
(20,3,'Desierto de Mineral','des9841.jpg',50),
(21,3,'Ver Omesh','ver5335.jpg',70),
(22,3,'Eden','gen4365.jpg',100),
(23,3,'Ruinas Laberinto','rui8730.jpg',70),
(24,3,'Nébula V','neb7642.jpg',10),
(25,3,'?','unk8030.jpg',10),
(26,3,'Zona Desconocida','des8720.jpg',80),
(27,3,'Base Delta','bde6534.jpg',80),
(28,3,'Ursini HomeWorld','urs9419.jpg',90);

INSERT INTO tPlanetaUnidad (idUnidad,idPlanetaEsp,idGalaxia)
VALUES
(231,1,1), #En Abydos construyes Mastasge
(244,1,1), #En Abydos construyes Guerrilla de Abydos
(267,1,1), #*** HEROE *** En Abydos construyes Share
(271,1,1), #*** HEROE *** En Abydos construyes Skaara
(272,1,1), #*** HEROE *** En Abydos construyes Kasuf
#-----------------------------------------------------
(110,2,1), #*** HEROE *** En Adara II construyes Aeronave de Hermiod (Solo Asgards)
#-----------------------------------------------------
(261,3,1), #En Altair construyes Androides
(265,3,1), #*** HEROE *** En Altair construyes Harlan
#-----------------------------------------------------
(315,4,1), #En Arkham construyes Guerreros de Arkham
(21,4,1), #*** HEROE *** En Arkham construyes Rey Arkham
(450,4,1), #*** HEROE *** En Arkham construyes TimeJumper
#-----------------------------------------------------
(304,5,1), #*** HEROE *** En B30-255 construyes Nave de Martin Lloyd
#-----------------------------------------------------
( 15, 6, 1), #*** HEROE *** En Base Alpha construyes Ferretti (Solo Tauri)
(310, 6, 1), #*** HEROE *** En Base Alpha construyes Landry (Solo Tauri)
#-----------------------------------------------------
(28, 7, 1), #*** HEROE *** En Base Beta construyes Hammond (Solo Tauri)
(14, 7, 1), #*** HEROE *** En Base Beta construyes Mayor Paul Davies (Solo Tauri)
#-----------------------------------------------------
(45, 8,1), #En Base de Anubis construyes Guardia Chacal
(87, 8,1), #En Base de Anubis construyes Alkesh de carga
(74, 8,1), #*** HEROE *** En Base de Anubis construyes Tanith (Solo Goauld)
(333,8,1), #*** HEROE *** En Base de Anubis construyes Ryac (Solo Jaffa)
#-----------------------------------------------------
(5,9,1), #En Base del NID construyes Saqueador del NID
(20,9,1), #*** HEROE *** En Base del NID construyes Meybourne
(22,9,1), #*** HEROE *** En Base del NID construyes Barrett (Solo Tauri)
#-----------------------------------------------------
(43,10,1), #En Base Fabrica construyes Guardia Personal
(429,10,1), #En Base Fabrica construyes Moto
(87,10,1), #En Base Fabrica construyes Alkesh carga
#-----------------------------------------------------
(251,11,1), #En Bedrosia construyes Soldados Bedrosianos
(298,11,1), #En Bedrosia construyes Cazas Bedrosianos
(431,11,1), #*** HEROE *** En Bedrosia construyes Terraformador
#-----------------------------------------------------
(247,12,1), #En Burrock construyes Unas Silvestres
(376,12,1), #*** HEROE *** En Burrock construyes Burrock
#-----------------------------------------------------
(117,13,1), #En Cal Mah construyes Jaffas de Imhotep
(126,13,1), #*** HEROE *** En Cal Mah construyes KTano (Solo Jaffa)
(329,13,1), #*** HEROE *** En Cal Mah construyes nave KTano (Solo Jaffa)
#-----------------------------------------------------
(289,14,1), #En Camelot construyes Caballero Negro
(374,14,1), #*** HEROE *** En Camelot construyes Meurik
#-----------------------------------------------------
( 84,  15, 1), #En Chulak construyes Aguja Afilada
(369, 15, 1),  #*** HEROE *** En Chulak construyes Dreyac (Solo Jaffa)
( 16,  15, 1), #*** HEROE *** En Chulak construyes Kawalsky (Solo Tauri)
#-----------------------------------------------------
(234,16,1), #En Cimmeria construyes Vikingos
(101,16,1), #En Cimmeria construyes Martillo de Thor
(377,16,1), #*** HEROE *** En Cimmeria construyes Gayrwin
(330,16,1), #*** HEROE *** En Cimmeria construyes Carro de Thor (Solo Asgard)
(76,16,1), #*** HEROE *** En Cimmeria construyes El unas (Solo Goauld)
#-----------------------------------------------------
(240,17,1), #En Ciudad de la TokRa construyes Comando TokRa
(263,17,1), #En Ciudad de la TokRa construyes Asesino TokRa
(275,17,1), #*** HEROE *** En Ciudad de la TokRa construyes Jolinar
#-----------------------------------------------------
(247,18,1), #En Colonia Unas construyes Unas silvestre
(378,18,1), #*** HEROE *** En Colonia Unas construyes Iron Shirt
#-----------------------------------------------------
(125,19,1), #*** HEROE *** En Dakara construyes Gerak (Solo Jaffa)
#-----------------------------------------------------
(132,20,1), #En Dar Eshkalon construyes Torretas
(370,20,1), #*** HEROE *** En Dar Eshkalon construyes Shanauc (Solo Jaffa)
(442,20,1), #*** HEROE *** En Dar Eshkalon construyes Nave Herur (Solo Goauld)
#-----------------------------------------------------
(48,21,1), #En Delmak construyes Guardia Sokar
(86,21,1), #En Delmak construyes Alkesh
(75,21,1), #*** HEROE *** En Delmak construyes Sokar (Solo Goauld)
#-----------------------------------------------------
(47,23,1), #En Erebo construyes Guardia Baal
(88,23,1), #En Erebo construyes Hatak
#-----------------------------------------------------
(252,24,1), #En Euronda construyes Soldados Eurondanos
(296,24,1), #En Euronda construyes Campo def. eurondano
(300,24,1), #En Euronda construyes Cazas Teledirigidos
#-----------------------------------------------------
(69,25,1), #*** HEROE *** En Fortaleza de Nirrti construyes Nirrti (Solo goauld)
#-----------------------------------------------------
(266,26,1), #*** HEROE *** En Hadante construyes Linea
#-----------------------------------------------------
(115,27,1), #En Haktyl construyes Amazonas Jaffa
(123,27,1), #*** HEROE *** En Haktyl construyes Ishta (Solo Jaffa)
#-----------------------------------------------------
(249,28,1), #En Hebridan construyes Soldados Hebridanos
(278,28,1), #*** HEROE *** En Hebridan construyes Warrick
(301,28,1), #*** HEROE *** En Hebridan construyes Seberus
#-----------------------------------------------------
(294,30,1), #*** HEROE *** En Avalon construyes Dragon
(373,30,1), #*** HEROE *** En Avalon construyes Merlin
#-----------------------------------------------------
(116,31,1), #En Jade construyes Jaffas Ninja
(68,31,1), #*** HEROE *** En Jade construyes Yu (Solo Goauld)
#-----------------------------------------------------
(235,32,1), #En Juna construyes Guerreros de Juna
(383,32,1), #*** HEROE *** En Juna construyes Cronus (Solo Goauld)
#-----------------------------------------------------
(256,33,1), #En Kheb construyes Monje ascendido
#-----------------------------------------------------
(19,34,1), #*** HEROE *** En La Tierra construyes General ONeill (Solo Tauri)
(344,34,1), #*** HEROE *** En La Tierra construyes Eli Wallace (Solo Tauri)
(325,34,1), #*** HEROE *** En La Tierra construyes Col. Carter (Solo Atlantis)
(170,34,1), #*** HEROE *** En La Tierra construyes Apollo (Solo Atlantis)
(447,34,1), #*** HEROE *** En La Tierra construyes Loki (Solo Asgard)
(345,34,1), #*** HEROE *** En La Tierra construyes Brian (Solo Wraith)
(443,34,1), #*** HEROE *** En La Tierra construyes Atenea (Solo Goauld)
#-----------------------------------------------------
(237,35,1), #En Langara construyes Soldados Langarianos
(12,35,1), #*** HEROE *** En Langara construyes Jonas Quinn (Solo Tauri)
#-----------------------------------------------------
(283,37,1), #*** HEROE *** En Mundo Furling construyes Furlings
#-----------------------------------------------------
(284,38,1), #*** HEROE *** En Mundo Nox construyes Nox
(418,38,1), #*** HEROE *** En Mundo Nox construyes Ciudad Nox
#-----------------------------------------------------
(414,39,1), #En Mundo Sodan construyes Guerreros Sodan
(444,39,1), #*** HEROE *** Mundo Sodan construyes Haikon (Solo Jaffa)
( 17,39,1),  #*** HEROE *** En Mundo Sodan construyes Mitchell (Solo Tauri)
#-----------------------------------------------------
(255,40,1), #En Netu construyes Prisioneros Netu
(61,40,1), #*** HEROE *** En Netu construyes Apophis (Solo Goauld)
(280,40,1), #*** HEROE *** En Netu construyes Jacob (Solo Tauri)
#-----------------------------------------------------
(368,41,1), #*** HEROE *** En Avnil construyes Jonas Hanson
#-----------------------------------------------------
(291,42,1), #En Pangar construyes Canones Flotantes
(384,42,1), #*** HEROE *** En Pangar construyes Egeria
#-----------------------------------------------------
(46,43,1), #En Planeta de Hathor construyes Guardia Horus
(83,43,1), #En Planeta de Hathor construyes Torretas
(63,43,1), #*** HEROE *** En Planeta de Hathor construyes Hathor (Solo Goauld)
#-----------------------------------------------------
(248,44,1), #En Planeta Natal construyes Unas Goauld
(276,44,1), #*** HEROE *** En Planeta Natal construyes Chaka
#-----------------------------------------------------
(201,45,1), #Planeta Origen constuyes Exoesqueleto
(204,45,1), #*** HEROE *** Planeta Origen constuyes El Primero (Solo Replicantes)
#-----------------------------------------------------
(293,47,1), #Quetzalcoat constuyes Entes
(78,47,1), #*** HEROE *** Quetzalcoat constuyes Zipacna (Solo goauld)
#-----------------------------------------------------
(246,48,1), #En Reetalia construyes Reetu
#-----------------------------------------------------
(240,49,1), #En Revanna construyes Comando Tokra
(263,49,1), #En Revanna construyes Asesino Tokra
(270,49,1), #*** HEROE *** En Revanna construyes Martouf
#-----------------------------------------------------
(65, 50,1), #*** HEROE *** En Ruinas construyes Khalek (Solo Goauld)
(449,50,1), #*** HEROE *** En Ruinas construyes Dave Dixon (Solo Tauri)
#-----------------------------------------------------
(230,51,1), #En Salish construyes Espiritus
(232,51,1), #En Salish construyes Salish
(448,51,1), #*** HEROE *** En Salish construyes Xels
#-----------------------------------------------------
(50,52,1), #En Tartaro construyes Guerreros Kull
#-----------------------------------------------------
(243,53,1), #En Tegalus construyes Soldados de Rand y Caledonia
(221,53,1), #En Tegalus construyes Satelite Ori
(372,53,1), #*** HEROE *** En Tegalus construyes Jared Kane
#-----------------------------------------------------
(253,54,1), #En Tollana construyes Soldados Tollanos
(295,54,1), #En Tollana construyes Canones de iones tollanos
(274,54,1), #*** HEROE *** En Tollana construyes Narim
#-----------------------------------------------------
(289,55,1),  #En Vagonbrei construyes caballeros
#-----------------------------------------------------
(286,56,1), #*** HEROE *** En Velona construyes Orlin
#-----------------------------------------------------
(297,57,1), #En Volia construyes Cosechadora
(381,57,1), #*** HEROE *** En Volia construyes Mollen
#-----------------------------------------------------
(240,58,1), #En Vorash construyes Comando Tokra
(263,58,1), #En Vorash construyes Asesino Tokra
(269,58,1), #*** HEROE *** En Vorash construyes Anise
#-----------------------------------------------------
(291,59,1), #En Vyus construyes Canon flotante
(297,59,1), #En Vyus construyes Cosechadora
(279,59,1), #*** HEROE *** En Vyus construyes Aris Boch
#-----------------------------------------------------
(23,60,1), #*** HEROE *** En Nemesis construyes Burke (Solo Tauri)
(445,60,1), #*** HEROE *** En Nemesis construyes Volnek (Solo Jaffa)
#-----------------------------------------------------
(253,61,1), #En Tollan construyes Soldados Tollanos
(295,61,1), #En Tollan construyes Canones de iones tollanos
(379,61,1), #*** HEROE *** En Tollan construyes Omoc
#-----------------------------------------------------
(289,62,1),  #En Sahal construyes caballeros
#-----------------------------------------------------
(52,63,1), #En Kreshta construyes Ashrak
(427,63,1), #*** HEROE *** En Kreshta construyes Mzel (Solo Jaffa)
(230,63,1), #*** HEROE *** En Kreshta construyes Seth (Solo goauld)
#-----------------------------------------------------
(121,64,1), #*** HEROE *** En Kallana construyes Aron (Solo Jaffas)
(403,64,1), #*** HEROE *** En Kallana construyes Prior Via lactea (Solo Ori)
#-----------------------------------------------------
(268,65,1), #*** HEROE *** En Hogar de Machello construyes Machelo
#-----------------------------------------------------
(385,66,1), #*** HEROE **** En Hanka construyes Cassandra (Solo Tauri)
#-----------------------------------------------------
(45,67,1), #En Akhet construyes Guardia Chacal
(73,67,1), #*** HEROE *** En Akhet construyes Ra (Solo Goauld)
#-----------------------------------------------------
(43,69,1), #En Cartago construyes Guardia Personal
(371,69,1), #*** HEROE *** En Cartago construyes Camulus (Solo goauld)
(380,69,1), #*** HEROE *** En Cartago construyes Valar (Solo jaffa)
#-----------------------------------------------------
(46,70,1), #En Amon Shek construyes Guardia Horus
(80,70,1), #En Amon Shek construyes Lanzaderas Pesadas
(346,70,1), #*** HEROE *** En Amon Shek construyes Khonsu
#-----------------------------------------------------
(133,71,1), #En Tobin construyes Minas
(435,71,1), #*** HEROE *** En Tobin construyes Sombra del Desierto
#-----------------------------------------------------
(162,72,1), #En Base Icaro construyes Canones Rail
(27,72,1), #*** HEROE *** En Base Icaro construyes Dr. Rush (Solo Tauri)
(400,72,1), #*** HEROE *** En Base Icaro construyes Young (Solo Tauri)
#-----------------------------------------------------
(352,73,1), #*** HEROE *** En PJ... construyes Guarda
#-----------------------------------------------------
(45,74,1), #En Bubastis construyes Guardia Chacal
(317,74,1), #*** HEROE *** En Bubastis construyes Bastet (Solo Goauld)
#-----------------------------------------------------
(85,75,1), #Aegis construyes Nave de Osiris
(71,75,1), #*** HEROE *** Aegis construyes Osiris (Solo goauld)
#-----------------------------------------------------
(353,76,1), #En Talion construyes Ilac Renin
(122,76,1), #*** HEROE *** En Talion construyes Arkad
#-----------------------------------------------------
(399,77,1), #Lucian icarus construyes Mercenario Luccian
(391,77,1), #*** HEROE *** Lucian icarus construyes Kiva
(393,77,1), #*** HEROE *** Lucian icarus construyes Simeon
#-----------------------------------------------------
(399,78,1), #Lucia construyes Mercenario Luccian
(392,78,1), #*** HEROE *** Lucia construyes Netan
(396,78,1), #*** HEROE *** Lucia construyes Varro
#-----------------------------------------------------
(46,79,1), #Soma Kesh construyes Guardia Horus
(64,79,1), #*** HEROE *** Soma Kesh construyes Herur (Solo Goauld)
#-----------------------------------------------------
(312,80,1), #*** HEROE *** Gamma construyes Woolsey (Solo Atlantis) 
(390,80,1), #*** HEROE *** Gamma construyes Wray (Solo Tauri)
#-----------------------------------------------------
(397,81,1), #*** HEROE *** Oran construyes Tenat & Jup
(394,81,1), #*** HEROE *** Oran construyes Ginn
#-----------------------------------------------------
(4,82,1), #En Base Kuybyshev construyes Comandos SG ruso
(7,82,1), #En Base Kuybyshev construyes Oficial SG ruso
(319,82,1), #*** HEROE *** En Base Kuybyshev construyes Chekov (Solo Tauri)
(154,82,1), #*** HEROE *** En Base Kuybyshev construyes Zelenka (Solo Atlantis)
#-----------------------------------------------------
(426,83,1), #En Herevah construyes Guardia Dragon
(294,83,1), #*** HEROE *** Herevah construyes Dragon
#-----------------------------------------------------
(318,84,1), #*** HEROE *** Base Cientifica construyes Dr. Lee (Solo Tauri)
#-----------------------------------------------------
(26,85,1), #*** HEROE *** En Quatum construyes Kurt Russel (Solo Tauri)
(430,85,1), #*** HEROE *** En Quatum construyes Rod (Solo Atlantis)
(446,85,1), #*** HEROE *** En Quatum construyes Apophis (Solo Goauld)
#-----------------------------------------------------
(438,86,1), #*** HEROE *** En Praxyon construyes Escudo
#-----------------------------------------------------

(100,1,2), #En Atheros construyes Supersoldados
(104,1,2), #En Atheros construyes Naves de asalto
(407,1,2), #*** HEROE *** En Atheros construyes Escuadron vanir (Solo Asgard)
#-----------------------------------------------------
(233,2,2), #En Athos construyes Athosianos
(157,2,2), #*** HEROE *** En Athos construyes Teyla (Solo Atlantis)
#-----------------------------------------------------
(388,3,2), #*** HEROE *** En Ballkans construyes Kanaan
#-----------------------------------------------------
(239,4,2), #En Base Genii construyes Comando Genii
(262,4,2), #En Base Genii construyes Oficial Genii
(282,4,2), #*** HEROE *** En Base Genii construyes Kolya
#-----------------------------------------------------
(281,5,2), #*** HEROE *** En Belsa construyes Krynk
#-----------------------------------------------------
(238,6,2), #En Bolok construyes Bola Kai
(273,6,2), #*** HEROE *** En Bolok construyes Omal alias Machete
#-----------------------------------------------------
(326,7,2), #*** HEROE *** En Centro cientifico construyes James (Solo Wraith)
(188,7,2), #En Centro cientifico construyes Dardos
#-----------------------------------------------------
(290,8,2), #En Cloister construyes Ente
(302,8,2), #*** HEROE *** En Cloister construyes Impulsion
#-----------------------------------------------------
(331,9,2), #*** HEROE *** En clonadora construyes Kenny (Solo Wraith)
(187,9,2), #En Clonadora construyes Dardos
#-----------------------------------------------------
(289,10,2), #En Dagan construyes caballero
(386,10,2), #*** HEROE ***En Dagan construyes Allina
#-----------------------------------------------------
(163,11,2), #*** HEROE *** En Doranda construyes Canones de iones antiguos
#-----------------------------------------------------
(292,12,2), #En Eldreds construyes Torre de mini-drones
(302,12,2), #*** HEROE *** En Eldreds construyes Impulsion
#-----------------------------------------------------
(242,13,2), #En Geldar construyes Soldados de Geldar
(439,13,2), #En Geldar construyes Satelites Geldar
(431,13,2), #*** HEROE *** En Geldar construyes Terraformador
#-----------------------------------------------------
(239,14,2), #En Genii construyes Comando Genii
(262,14,2), #En Genii construyes Oficial Genii
(343,14,2), #*** HEROE *** En Genii construyes Ladon
#-----------------------------------------------------
(231,15,2), #En Gohari construyes Mastadge
#-----------------------------------------------------
(258,16,2), #En Guarida Ford construyes Milica Ford
(153,16,2), #*** HEROE *** En Guarida Ford construyes Ford Doping (Solo Atlantis)
#-----------------------------------------------------
(241,17,2), #En Hoff construyes Milicianos
(148,17,2), #*** HEROE *** En Hoff construyes Carson (Solo Atlantis)
#-----------------------------------------------------
(316,18,2), #En Kera construyes Guerreros de Kera
(302,18,2), #*** HEROE *** En Kera construyes Impulsion
#-----------------------------------------------------
(152,19,2), #*** HEROE *** En Lantea costruyes Ford (Solo Atlantis)
(340,19,2), #*** HEROE *** En Lantea costruyes Sun Tzu (Solo tauri)
#-----------------------------------------------------
(233,20,2), #En Nueva Athos construyes Athosianos
(382,20,2), #*** HEROE *** En Nueva Athos construyes Halling
#-----------------------------------------------------
(311,21,2), #*** HEROE *** En Lantis costruyes Weir (Solo Atlantis)
(128,21,2), #*** HEROE *** En Lantis construyes Maestro Tealc (Solo Jaffa)
(40,21,2), #*** HEROE *** En Lantis costruyes Phoenix (Solo Tauri)
#-----------------------------------------------------
(186,22,2), #En Nueva Taranis construyes Xenoforme
(193,22,2), #*** HEROE *** En Nueva Taranis construyes Colmena Michael (Solo Wraith)
#-----------------------------------------------------
(245,23,2), #En Olesia construyes prisioneros
(288,23,2), #En Olesia construyes canones
(342,23,2), #En Olesia construyes naves olesia
#-----------------------------------------------------
(239,24,2), #En Planeta 177 construyes Comando Genii
(262,24,2), #En Planeta 177 construyes Oficial Genii
(375,24,2), #*** HEROE *** En Planeta 177 construyes Cowen
#-----------------------------------------------------
(264,25,2), #*** HEROE *** En Planeta de Lucius construyes Lucius Lavin
#-----------------------------------------------------
(173,26,2), #En Planeta Natal Wraith construyes Guerreros Wraith
(185,26,2), #En Planeta Natal Wraith construyes Insectos Iratus
(327,26,2), #*** HEROE *** En Planeta Natal Wraith construyes Reina Mayor (Solo Wraith)
#-----------------------------------------------------
(314,27,2), #*** HEROE *** En Proculus construyes Chaya Sar
#-----------------------------------------------------
(175,28,2), #En Ruinas industriales construyes Hibridos
(182,28,2), #*** HEROE *** En Ruinas industriales construyes Michael (Solo Wraith)
(149,28,2), #*** HEROE *** En Ruinas industriales construyes Clon Beckett (Solo Atlantis)
#-----------------------------------------------------
(259,29,2), #En Sateda construyes Satedanos
(177,29,2), #*** HEROE *** En Sateda construyes Tyre
#-----------------------------------------------------
(168,30,2), #En Taranis construyes Auroras
#-----------------------------------------------------
(241,31,2), #En Villa de Elson construyes Milicianos
(337,31,2), #*** HEROE *** En Villa de Elson construyes Neeva
#-----------------------------------------------------
(250,32,2), #En Fog Town construyes Whispers
(435,32,2), #*** HEROE *** En Fog Town construyes Sombra del Desierto
#-----------------------------------------------------
(241,33,2), #En Capital de la Coalicion construyes Milicianos
(288,33,2), #En Capital de la Coalicion construyes canones
(435,33,2), #*** HEROE *** En Capital de la Coalicion construyes Sombra del Desierto
#-----------------------------------------------------
(259,34,2), #En Manaria construyes Satedanos
(437,34,2), #*** HEROE *** En Manaria construyes Sora
#-----------------------------------------------------
(387,35,2), #*** HEROE *** Planeta Luciernaga construyes Exiliado (Solo Wraith)
#-----------------------------------------------------
(24,36,2), #*** HEROE *** Base Alpha Pegasus construyes Dr. Lam (Solo Tauri)
(156,36,2), #*** HEROE *** En Base Alpha Pegasus construyes Lorne (Solo Atlantis)
(34,36,2), #En Base Alpha Pegasus construyes F302
#-----------------------------------------------------
(303,37,2), #Colonia Traveller construyes Crucero Traveller
(277,37,2), #*** HEROE *** Colonia Traveller construyes Larrin
(308,37,2), #*** HEROE *** Colonia Traveller construyes Nave de Katana
#-----------------------------------------------------
(303,38,2), #Thenora construyes Crucero Traveller 
(404,38,2), #*** HEROE *** Thenora construyes Katana
(309,38,2), #*** HEROE *** Thenora construyes Nave de Larrin
#-----------------------------------------------------
(323,39,2), #*** HEROE *** Talus construyes Steve (Solo Wraith)
#-----------------------------------------------------
(324,40,2), #*** HEROE *** Vapolova construyes Com. Primera (Solo Wraith)
(195,40,2), #*** HEROE *** Vapolova construyes La Primera (Solo Wraith)
#-----------------------------------------------------



(101,1,3), #En Bilskirnir construyes Martillo de Thor
(105,1,3), #En Bilskirnir construyes Beliksner
(111,1,3), #*** HEROE *** En Bilskirnir construyes Kvasir
#-----------------------------------------------------
(322,3,3), #*** HEROE *** En Halla construyes Cuarto (Solo Repli)
(321,3,3), #*** HEROE *** En Halla construyes Tercero (Solo Repli)
#-----------------------------------------------------
(292,4,3), #En Jesave construyes Torreta de drones
(302,4,3), #*** HEROE *** En Jesave construyes Impulsion
#-----------------------------------------------------
(103,5,3), #En Lokasenna construyes Satelite Asgard
(405,5,3), #*** HEROE *** En Lokasenna construyes nave de Freyr (Solo Asgard)
#-----------------------------------------------------
(234,6,3), #En Midgard construyes Vikingos
(101,6,3), #En Midgard construyes Martillo de Thor
#-----------------------------------------------------
(105,7,3), #En Orilla construyes Beliksner
(320,7,3), #*** HEROE *** En Orilla construyes Segundo (Solo Repli)
#-----------------------------------------------------
(236,8,3), #En Ortus Mallum construyes Rebelion anti-Ori
(302,8,3), #*** HEROE *** En Ortus Mallum construyes Nave de impulsion
#-----------------------------------------------------
(105,9,3), #En Othala construyes Beliksner
(406,9,3), #*** HEROE *** En Othala construyes Penegal (Solo Asgard)
#-----------------------------------------------------
(389,10,3), #Skaldskaparmal construyes Bestias
(101,10,3), #Skaldskaparmal construyes Martillo de Thor
(294,10,3), #*** HEROE *** Skaldskaparmal construyes Dragon
#-----------------------------------------------------
(247,11,3), #En Ucayaquil construyes Unas Silvestre
(246,11,3), #En Ucayaquil construyes Reetou
(185,11,3), #En Ucayaquil construyes Insecto iratus
#-----------------------------------------------------
(236,12,3), #En Ver Airis construyes Rebelion anti-Ori
(402,12,3), #*** HEROE *** En Ver Airis construyes Seevis
#-----------------------------------------------------
(401,13,3), #*** HEROE *** En Ver Eger construyes Prior de ver Eger (Solo Ori)
#-----------------------------------------------------
(210,14,3), #En Ver Isca construyes Guerreros Ori
(13,14,3), #*** HEROE *** En Ver isca construyes Vala Mal Doran (Solo Tauri)
#-----------------------------------------------------
(435,15,3), #*** HEROE *** En Wounded Knee construyes Sombra del Desierto
(231,15,3), #En Wounded Knee construyes Mastadge
(288,15,3), #En Wounded Knee construyes Caones Artesanos
#-----------------------------------------------------
(212,16,3), #*** HEROE *** En Bwrellicef construyes Profeta (Solo Ori)
#-----------------------------------------------------
(334,17,3), #*** HEROE *** En Radiantia construyes Damaris (Solo Ori)
#-----------------------------------------------------
(389,18,3), #En Jungla Oscura construyes Bestias
#-----------------------------------------------------
(293,19,3), #En Hoth construyes Colosos
#-----------------------------------------------------
(290,20,3), #Desierto de Mineral construyes Entes
(435,20,3), #*** HEROE *** En Desierto de Mineral construyes Sombra del Desierto
#-----------------------------------------------------
(313,21,3), #*** HEROE *** En Ver Omer construyes Prior tuerto (Solo Ori)
#-----------------------------------------------------
(290,22,3), #Genesis construyes Ente
(231,22,3), #Genesis construyes Mastadge
(431,22,3), #*** HEROE *** En Genesis construyes Terraformador
#-----------------------------------------------------
(389,23,3), #Ruinas Laberinto construyes Bestias
(435,23,3), #*** HEROE *** En Ruinas Laberinto construyes Sombra del Desierto 
#-----------------------------------------------------
(305,24,3), #*** HEROE *** Nebula V construyes Nave nebulosa
#-----------------------------------------------------
(260,25,3), #? construyes ? oficial
(299,25,3), #? construyes ? caza
(306,25,3), #? construyes ? nodriza
#-----------------------------------------------------
(229,26,3), #Zona Desconocida construyes Metamorficos
(432,26,3), #*** HEROE *** Zona Desconocida construyes Nave Comandante
#-----------------------------------------------------
(147,27,3), #*** HEROE *** Base Delta construyes Dra. Miller (Solo Atlantis)
(25,27,3), #*** HEROE *** Base Delta construyes Felger (Solo Tauri)
#-----------------------------------------------------
(434,28,3), #Ursini construyes Ursini
(433,28,3), #*** HEROE *** Ursini construyes Nave ursini
(395,28,3); #*** HEROE *** Ursini construyes Telford (Solo Tauri)
#-----------------------------------------------------

INSERT INTO tEspecialRequierePlaneta (idEspecial,idPlanetaEsp,idGalaxia)
VALUES

(537,47,1), #Quetzalcoalt --> Calavera de Cristal
(538,60,1), #Nemesis ---> Aparato de TelChak
(539,18,1), #Aliaza Unas ---> Alianza Unas'
(540,10,1), #Astilleros ---> Base Fabrica
(541,68,1), #Castiana ---> Manto de Arturo
(542,17,1), #Ciudad Tokra ---> Tuneles de Cristal
(543,22,1), #Deposito ---> Deposito del Conocimiento Planetario'
(544,29,1), #Heliopolis ---> Biblioteca de la Cuatro Razas de Heliopolis'
(545,33,1), #En Kheb te da ascendido
(546,52,1), #Tartaro --->'Fabrica de Tartaro'
(547,20,2), #Nueva Athos ---> 'Entrenamiento de Athos'
(548,3,3), #Halla ---> 'Dilatador Temporal de Halla'
(549,19,2), #Lantea ---> Sillon de los Antiguos
(550,21,2), #Lantis ---> Sillon de los Antiguos
(560,15,2), #Gohari ---> Sillon de los Antiguos
(551,46,1), #Proclarush ---> Sillon de los Antiguos
(552,19,1), #Dakara ---> Dakara
(553,36,1), #Latona ---> Centinela
(554,14,1), #Camelot ---> Rey Arturo
(561,2,3), #Celestis --> Arca de la Verdad
(555,34,1); #La Tierra ---> Sillon de los Antiguos
