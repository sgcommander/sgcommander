##
## Razas
##

#raza
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('1','FFFFFF','163','37','4',"Tau\'ri",'9','1','13',0, '73', '27');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('2','FFFFFF','158','32','4',"Goa\'uld",'7','1','10',0, '82', '18');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('3','FFFFFF','158','18','3',"Asgard",'3','1','3',1, '8', '92');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('4','FFFFFF','167','40','5',"Jaffa",'9','1','10',0, '73', '27');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('5','FFFFFF','20','40','4',"Atlantis",'7','1','13',0, '73', '27');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('6','FFFFFF','170','43','4',"Wraith",'7','1','17',0, '82', '18');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('7','FFFFFF','30','40','4',"Replicantes",'10','1','6',0, '92', '8');
INSERT INTO raza(id,colorFirma,firmaX,firmaY,maxPlanetas,nombre,limiteSoldados, limiteMisiones, nivelMinimoHiperpropulsion,stargateTropasIntergalactico, porcentajeRecoleccionPrimario, porcentajeRecoleccionSecundario) VALUES ('8','FFFFFF','25','32','4',"Ori",'7','1','14',0, '82', '18');

#tipoRecurso
INSERT INTO tipoRecurso(id,nombre) VALUES (1,"Primario");
INSERT INTO tipoRecurso(id,nombre) VALUES (2,"Secundario");
INSERT INTO tipoRecurso(id,nombre) VALUES (3,"Energía");

#recursoRaza
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@TAURI,@PRIMARIO,  "Personal",       900,    0.007);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@TAURI,@SECUNDARIO,"Trinium",        500,    0.002625);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@TAURI,@ENERGIA,   "Energía",  4000, 4000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@GOAULD,@PRIMARIO,   "Naquadah",     2250,    0.005);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@GOAULD,@SECUNDARIO, "Anfitriones",   650,    0.0011);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@GOAULD,@ENERGIA,    "Energía", 4000, 4000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ASGARD,@PRIMARIO,  "Clones",         800,    0.0023);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ASGARD,@SECUNDARIO,"Neutronio",     3000,    0.023);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ASGARD,@ENERGIA,   "Energía",  5000, 5000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@JAFFA,@PRIMARIO,   "Rebeldes",      1300,    0.007);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@JAFFA,@SECUNDARIO, "Naquadah",      700,     0.002625);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@JAFFA,@ENERGIA,    "Energía", 4000,  4000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ATLANTIS,@PRIMARIO,   "Personal",      1200,    0.007);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ATLANTIS,@SECUNDARIO, "Trinium",        550,    0.002625);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ATLANTIS,@ENERGIA,    "Energía",  4000, 4000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@WRAITH,@PRIMARIO,  "Biomateria",   1400,    0.005);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@WRAITH,@SECUNDARIO,"Humanos",       350,    0.0011);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@WRAITH,@ENERGIA,   "Energía", 4000, 4000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@REPLICANTES,@PRIMARIO,  "Piezas",       1100,    0.0023);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@REPLICANTES,@SECUNDARIO,"Neutronio",     100,    0);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@REPLICANTES,@ENERGIA,   "Energía", 6000, 6000);

INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ORI,@PRIMARIO,   "Naquadah",      2500,    0.005);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ORI,@SECUNDARIO, "Fieles",         800,    0.0011);
INSERT INTO recursoRaza(idRaza,idTipoRecurso,nombre,cantidadBase,produccionBase) VALUES (@ORI,@ENERGIA,    "Energía",  4000, 4000);

#razaComercio
INSERT INTO razaComercio (`idRazaRecibe` ,`idRazaEnvia`)VALUES
(@TAURI, @TAURI),
(@TAURI, @JAFFA),
(@TAURI, @ATLANTIS),
(@GOAULD, @GOAULD),
(@GOAULD, @WRAITH),
(@GOAULD, @ORI),
(@ASGARD, @ASGARD),
(@JAFFA, @TAURI),
(@JAFFA, @JAFFA),
(@JAFFA, @ATLANTIS),
(@ATLANTIS, @TAURI),
(@ATLANTIS, @JAFFA),
(@ATLANTIS, @ATLANTIS),
(@WRAITH, @GOAULD),
(@WRAITH, @WRAITH),
(@WRAITH, @ORI),
(@REPLICANTES, @REPLICANTES),
(@ORI, @GOAULD),
(@ORI, @WRAITH),
(@ORI, @ORI);

#galaxia
INSERT INTO galaxia (id, nombre, chavron)
VALUES
('1','Vía Láctea','1'),
('2','Pegasus','2'),
('3','Andrómeda','3'),
('4','Midway','4');

#razaGalaxiaOrigen
INSERT INTO razaGalaxiaOrigen (idGalaxia, idRaza)
VALUES
(@VIALACTEA,@TAURI),
(@VIALACTEA,@GOAULD),
(@VIALACTEA,@ASGARD),
(@VIALACTEA,@JAFFA),
(@VIALACTEA,@REPLICANTES),
(@PEGASUS,@ATLANTIS),
(@PEGASUS,@WRAITH),
(@PEGASUS,@ASGARD),
(@ANDROMEDA,@ASGARD),
(@ANDROMEDA,@REPLICANTES),
(@ANDROMEDA,@ORI);

#firma
INSERT INTO firma (`id`, `idRaza`, `nombre`, `ruta`)
VALUES
(3, @ASGARD, 'Loki', 'As15736.jpg'),
(9, @ASGARD, 'Thor', 'As7464.jpg'),
(13, @WRAITH, 'Dardo', 'Wr74943.jpg'),
(14, @WRAITH, 'Cazador', 'Wr3939.jpg'),
(17, @REPLICANTES, 'Replicarter', 'Re9575.jpg'),
(18, @REPLICANTES, 'Reese', 'Re74364.jpg'),
(19, @ATLANTIS, 'John Sheppard', 'At129553.jpg'),
(20, @ATLANTIS, 'Rodney Mckay', 'At846239.jpg'),
(21, @ORI, 'Orici', 'Or98675.jpg'),
(22, @ORI, 'Doci', 'Or942345.jpg'),
(23, @GOAULD, 'Ra', 'Go102923.jpg'),
(24, @GOAULD, 'Apophis', 'Go85756.jpg'),
(25, @TAURI, 'Jack O\'Neill', 'Ta8364.jpg'),
(26, @TAURI, 'SGC Logo', 'Ta8863.jpg'),
(27, @JAFFA, 'Teal\'c', 'Ja8263564.jpg'),
(28, @JAFFA, 'Guerrero Serpiente', 'Ja5676.jpg');

#logotipo
INSERT INTO logotipo (`id`, `idRaza`, `nombre`, `ruta`)
VALUES
(1, @ASGARD, 'Thor', 'As7kjvyrn.png'),
(2, @ASGARD, 'Thor 2', 'As9bj7my.png'),
(3, @WRAITH, 'Cazador', 'Wr8jfh0t.png'),
(4, @WRAITH, 'Wraith furioso', 'Wr7nk.png'),
(5, @REPLICANTES, 'Replicarter', 'Re0nrin5.png'),
(6, @REPLICANTES, 'Quinto', 'Re4iunjk.png'),
(7, @ATLANTIS, 'John Sheppard', 'At0nrin5.png'),
(8, @ATLANTIS, 'Rodney Mckay', 'At4iunjk.png'),
(9, @ORI, 'Orici', 'Or3gte7.png'),
(10, @ORI, 'Doci', 'Or6bhy4.png'),
(11, @GOAULD, 'Ra', 'Go5y7rf8t.png'),
(12, @GOAULD, 'Apophis', 'Go8jhfuhjg.png'),
(13, @TAURI, 'Jack O\'Neill', 'Tgr5fvg6.png'),
(14, @TAURI, 'SGC Logo', 'Tlj3bap6k.png'),
(15, @JAFFA, 'Teal\'c', 'Ja84798fsr.png'),
(16, @JAFFA, 'Guerrero Serpiente', 'Jajdiot47.png');
