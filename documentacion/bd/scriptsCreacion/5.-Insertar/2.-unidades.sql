#tipoUnidad
INSERT INTO tipoUnidad (`id` ,`nombre`) VALUES
('1', 'Nave'),
('2', 'Soldado'),
('3', 'Defensa'),
('4', 'Especial');

#tipoNave
INSERT INTO tipoNave (idTipoNave, nombre)
VALUES
('1','Caza'),
('2','Caza Pesado'),
('3','Crucero'),
('4','Nodriza'),
('5','Insignia'),
('6','Nave Suprema');

#tipoSoldado
INSERT INTO tipoSoldado (idTipoSoldado, nombre)
VALUES
('1','Exploración'),
('2','Recolección'),
('3','Combate'),
('4','Oficial'),
('5','Científico'),
('6','Médico'),
('7','Líder'),
('8','Soldado Supremo'),
('9','Asesino');

#tipoDefensas
INSERT INTO tipoDefensa (idTipoDefensa, nombre) VALUES
('1','Stargate'),
('2','Terrestre'),
('3','Aérea'),
('4','Orbital'),
('5','Defensa Suprema');

#############################################################################################################################################
## Fuego rapido
#############################################################################################################################################
INSERT INTO fuegoDefensaSoldado (idAtaca, idDefiende, porcentaje) VALUES
(@TERRESTRE,@COMBATE,500),
(@TERRESTRE,@OFICIAL,500),
(@DEFENSAESPECIAL,@EXPLORACION, 1000),
(@DEFENSAESPECIAL,@RECOLECCION, 1000),
(@DEFENSAESPECIAL,@COMBATE, 1000),
(@DEFENSAESPECIAL,@OFICIAL, 1000),
(@DEFENSAESPECIAL,@CIENTIFICO, 1000),
(@DEFENSAESPECIAL,@MEDICO, 1000),
(@DEFENSAESPECIAL,@LIDER, 1000),
(@DEFENSAESPECIAL,@ASESINO, 1000);

INSERT INTO fuegoDefensaNave (idAtaca, idDefiende, porcentaje) VALUES
(@AEREA,@CAZA,500),
(@AEREA,@CAZAPESADO,300),
(@AEREA,@CRUCERO, 200),
(@ORBITAL,@CRUCERO,300),
(@ORBITAL,@NODRIZA,500),
(@ORBITAL,@INSIGNIA, 500),
(@DEFENSAESPECIAL,@CAZA, 1000),
(@DEFENSAESPECIAL,@CAZAPESADO, 1000),
(@DEFENSAESPECIAL,@CRUCERO, 1000),
(@DEFENSAESPECIAL,@NODRIZA, 1000),
(@DEFENSAESPECIAL,@INSIGNIA, 1000);

INSERT INTO fuegoNaveDefensa (idAtaca, idDefiende, porcentaje) VALUES
(@CAZA,@ORBITAL,300),
(@CAZAPESADO,@ORBITAL,500),
(@CRUCERO,@STARGATE, 1000),
(@CRUCERO,@TERRESTRE,500),
(@NODRIZA,@STARGATE,300),
(@INSIGNIA,@STARGATE, 500),
(@SUPREMA,@STARGATE, 1000),
(@SUPREMA,@AEREA, 1000),
(@SUPREMA,@ORBITAL, 1000);

INSERT INTO fuegoNaveNave (idAtaca, idDefiende, porcentaje) VALUES
(@CAZA,@CRUCERO, 500),
(@CAZAPESADO,@CRUCERO, 300),
(@NODRIZA,@CAZA, 200),
(@NODRIZA,@CAZAPESADO, 200),
(@INSIGNIA,@CAZA, 300),
(@INSIGNIA,@CAZAPESADO, 300),
(@INSIGNIA,@CRUCERO, 200),
(@SUPREMA,@CAZA, 1000),
(@SUPREMA,@CAZAPESADO, 1000),
(@SUPREMA,@CRUCERO, 1000),
(@SUPREMA,@NODRIZA, 1000),
(@SUPREMA,@INSIGNIA, 1000);

INSERT INTO fuegoNaveSoldado (idAtaca, idDefiende, porcentaje) VALUES
(@CAZAPESADO,@RECOLECCION,200),
(@CAZAPESADO,@EXPLORACION,200),
(@CRUCERO,@RECOLECCION,500),
(@CRUCERO,@EXPLORACION,500),
(@CRUCERO,@COMBATE, 500),
(@CRUCERO,@OFICIAL,500);

INSERT INTO fuegoSoldadoDefensa (idAtaca, idDefiende, porcentaje) VALUES
(@COMBATE,@STARGATE,500),
(@COMBATE,@AEREA,500),
(@LIDER,@STARGATE,500),
(@LIDER,@TERRESTRE, 500),
(@LIDER,@AEREA, 500),
(@ESPECIAL,@STARGATE,1000),
(@ESPECIAL,@TERRESTRE, 1000),
(@ESPECIAL,@AEREA, 1000);

INSERT INTO fuegoSoldadoSoldado (idAtaca, idDefiende, porcentaje) VALUES
(@COMBATE,@RECOLECCION,500),
(@COMBATE,@EXPLORACION,500),
(@OFICIAL,@RECOLECCION,300),
(@OFICIAL,@EXPLORACION,300),
(@OFICIAL,@COMBATE,300),
(@ESPECIAL,@EXPLORACION,1000),
(@ESPECIAL,@RECOLECCION, 1000),
(@ESPECIAL,@COMBATE, 1000),
(@ESPECIAL,@OFICIAL,1000),
(@ESPECIAL,@MEDICO, 1000),
(@ESPECIAL,@CIENTIFICO, 1000),
(@ESPECIAL,@LIDER,1000),
(@ASESINO,@OFICIAL,1000),
(@ASESINO,@MEDICO,1000),
(@ASESINO,@CIENTIFICO,1000),
(@ASESINO,@LIDER,1000),
(@ASESINO,@ASESINO,1000);

INSERT INTO fuegoSoldadoNave (idAtaca, idDefiende, porcentaje) VALUES
(@OFICIAL,@CAZA,500),
(@OFICIAL,@CAZAPESADO,300),
(@OFICIAL,@CRUCERO, 200),
(@LIDER,@CAZA, 500),
(@LIDER,@CAZAPESADO,500),
(@LIDER,@CRUCERO, 500),
(@ESPECIAL,@CAZA, 1000),
(@ESPECIAL,@CAZAPESADO, 1000),
(@ESPECIAL,@CRUCERO,1000);

#############################################################################################################################################
## Unidades
#############################################################################################################################################
INSERT INTO `unidad` (`id`, `idRaza`, `idtipoUnidad`, `nombre`, `puntos`, `ataque`, `resistencia`, `escudo`, `tiempo`, `descripcion`, `invisible`, `atraviesaEscudo`)
VALUES

########################################################
# Tauri.................................................
########################################################
### Tropas
(1,   @TAURI, @SOLDADO, 'UCAV',                        1,   '25',   '15',   '0',   '120', '"Unmanned Combat Air Vehicle", son pequeños vehículos aéreos no pilotados usados por los Tau\'ri para la exploración aérea de mundos alienígenas. Las UCAV son la versión mejorada de las UAV, armadas con misiles que les permiten alcanzar objetivos desde el aire mediante control remoto.', FALSE, FALSE),
(2,   @TAURI, @SOLDADO, 'Ingenieros',                  2,   '10',   '40',   '0',   '900', 'Los ingenieros de los Tau\'ri son grupos de científicos y soldados de entre cuatro y ocho personas especializados en diversos campos de la ciencia, son de especial utilidad para conocer los detalles sobre los nuevos planetas descubiertos y sus recursos naturales.', FALSE, FALSE),
(3,   @TAURI, @SOLDADO, 'Comando SG',                  4,   '80',   '74',  '21',   '640', 'Grupos de élite formados por cuatro hombres especializados en diferentes campos y que son capaces de enfrentarse a cualquier misión en planetas alienígenas. Son expertos en misiones de reconocimiento, transporte y combate contra el enemigo.', FALSE, FALSE),
(6,   @TAURI, @SOLDADO, 'Oficial SGC',                13,  '220',  '374', '106',  '2600', 'Hombres condecorados por las Fuerzas Aéreas con mucha experiencia en combate. Diestros en el manejo de armas y estrategias de guerra, dan apoyo al resto de tropas con su gran Líderazgo en batalla.', FALSE, FALSE),
(8,   @TAURI, @SOLDADO, 'Dr. Daniel Jackson',        200,   '80', '1303', '368',   '900', 'Doctor en Arqueología, Antropólogo y Lingüista ya que habla veintitrés idiomas incluyendo el Antiguo Egipcio. Promovió durante mucho tiempo que las Grandes Pirámides no fueron construidas por los egipcios, lo que le sirvió el rechazo de otros colegas. Fue reclutado como experto para el primer viaje por el Stargate. Posteriormente, entro a formar parte de la comunidad científica dentro del SGC. De carácter alegre y siempre diplomático, su extraordinario conocimiento de todas las culturas terrestres pasadas hace que se convierta en una pieza básica cuando acompaña a los comandos tau\'ri para relacionarse con las culturas de otros mundos, descubrir nuevos avances y hacer nuevos aliados.', FALSE, FALSE),
(10,  @TAURI, @SOLDADO, 'Dra. Janet Fraiser',        200,    '0',  '793', '224',   '900', 'Doctora militar jefe y mayor de las Fuerzas Aéreas en el proyecto de alto secreto situado en el Complejo de las Montañas Cheyenne. El General Hammond la seleccionó para trabajar en el SGC por su experiencia en enfermedades exóticas. Combina el cuidado de los heridos del SGC con el trabajo de campo, descubriendo enfermedades e infecciones nuevas y cómo disiparlas.', FALSE, FALSE),
(11,  @TAURI, @SOLDADO, 'Mayor Samantha Carter',     200,  '500',  '963', '272',   '900', 'Líder científico-militar del SGC. Sirvió en el Pentágono, estudiando desde allí durante dos años la tecnología del Stargate y convirtiéndose en una experta. Fue previamente oficial de vuelo en Kuwait y posee un nivel tres en Combate cuerpo a cuerpo. Es uno de los mayores genios de la astrofísica en toda la Tierra ya que tiene un doctorado en Mecánica Cuántica y su reacción ante situaciones críticas es magnífica. Optimista y luchadora, cuando se creo el proyecto Stargate fue asignada al equipo del Coronel O\'Neill, siendo vital en las aventuras que corren día a día.', FALSE, TRUE),
(18,  @TAURI, @SOLDADO, 'Coronel Jack O\'Neill', 200, '1500', '1156', '326',   '900', 'Líder de las tropas Tau\'ri y comandante en Jefe del Comando Stargate. Militar desde los dieciocho años, es considerado un héroe entre sus similares por la cantidad de veces que ha resuelto situaciones límite. Fue el cerebro militar elegido para hacer el primer viaje a través del Stargate. Líder del SG-1, apoya con su Líderazgo y estrategia al resto de soldados, mejorando su moral y habilidades en combate. Además es un gran guerrero capaz de plantar cara a cualquier enemigo. De gran entereza y sentido del humor, O\'Neill no sólo es respetado en la Tierra, sino entre las otras razas de la Vía Láctea como los Asgards.', FALSE, TRUE),

### Naves
(33,  @TAURI, @NAVE, 'X-301',                8,   '90',   '225',    '0',  '648', 'Primer caza de los Tau\'ri construido combinando tecnología aeronáutica terrestre y un Planeador de la Muerte Goa\'uld. Su diseño es muy básico y depende mucho de la tecnología alienígena, pero puede entrar en combate contra otras naves sin problemas.', FALSE, FALSE),
(34,  @TAURI, @NAVE, 'X-302',                9,  '450',   '650',    '0', '1800', 'Caza estándar de las flotas Tau\'ri y el primero diseñado exclusivamente por ellos. Va armado con misiles de cabeza de naquadah y cañones raíl. A diferencia de los F-302, cuenta con un propulsor hiperespacial por lo que puede realizar viajes largos.', FALSE, FALSE),
(35,  @TAURI, @NAVE, 'BC-303',              86,  '920',  '3400',  '960', '4290', 'La clase BC-303 o "Prometeo" es el primer gran logro aeroespacial de los Tau\'ri que consiguió unir toda su tecnología para diseñar una nave con capacidad para defender un planeta y realizar viajes hiperespaciales gracias a los motores y armas de los Asgard.', FALSE, FALSE),
(36,  @TAURI, @NAVE, 'BC-304',             148, '1865',  '6007', '1696', '7380', 'Nave definitiva de combate de los Tau\'ri. Es la última versión de la clase Dédalo, armada con cañones raíl y cabezas de naquadah combinadas con el teletransporte y armamento asgard. Tiene capacidad para viajar por el hiperespacio y llevar cazas en su interior.', FALSE, FALSE),
(37,  @TAURI, @NAVE, 'Prometeo',           300, '1800',  '5893', '1664',  '900', 'La primera nave diseñada por los Tau\'ri, que fue bautizada como "proyecto Prometeo". Fue la primera en sintetizar tecnología Tau\'ri y Asgard. Posee escudos y armas Asgard que le permiten enfrentarse a las más poderosas naves enemigas.', FALSE, FALSE),
(39,  @TAURI, @NAVE, 'Odisea',             300, '3500',  '8387', '2368',  '900', 'Siguiente versión de las naves de guerra Tau\'ri, más poderosas en cuanto a fuego, escudos y mejor diseñadas para adaptarse al combate espacial que las anteriores. La primera de estas naves fue denominada "Odisea".', FALSE, TRUE),
(339, @TAURI, @NAVE, 'USS George Hammond', 300, '7500', '10313', '2912',  '900', 'Nave hermana del Dédalo que fue creada con el objetivo de interactuar en misiones de alto secreto en la Vía Láctea y la Galaxia Pegasus. Nombrada de esta forma en honor al General de Brigada George Hammond, primer líder militar del SGC que falleció durante su construcción. Incorpora un Módulo de Punto Cero que la hace más resistente y más poderosa que cualquier otra nave construida en la Tierra.', FALSE, TRUE),

### Defensas
(29,  @TAURI, @DEFENSA, 'Iris',                     5000,    '0', '306000', '86400', '43000', 'Barrera compuesta de titanio y trinium que recubre el Stargate impidiendo el paso de tropas enemigas y evitando los ataques a través de la puerta estelar. Tiene una integridad muy alta pero un consumo de energía muy elevado.', FALSE, FALSE),
(30,  @TAURI, @DEFENSA, 'Guarnición Defensiva',  12,  '200',    '431',     '122',  '1320', 'Grupo de soldados especializados en defensa de localizaciones. Bien armados, con varias estrategias defensivas y gran cobertura además de preparados para repeler cualquier incursión enemiga por tierra.', FALSE, FALSE),
(31,  @TAURI, @DEFENSA, 'LanzaCohetes',               34,  '500',    '300',     '85',  '2720', 'Misiles recubiertos de naquadah y guiados por ordenador que pueden ser usados contra naves enemigas de pequeño tamaño, ya que su poder de ataque no es lo suficientemente elevado como para causar daños serios en naves de mayor tamaño.', FALSE, FALSE),
(32,  @TAURI, @DEFENSA, 'Cohete Balístico',      35, '1000',    '136',     '38',  '2760', 'Cohetes armados con cabezas de naquadah mejoradas disparados hacia la orbita, sirven para la defensa contra naves de gran tamaño ya que su poder de ataque permite atravesar los escudos y causar daños en el casco de las naves más grandes del enemigo.', FALSE, TRUE),

### Especiales
#Raza
(9,   @SINRAZA, @SOLDADO, 'Daniel Jackson Ascendido',    0,  '2000',   '8000',   '5000', '0', 'Ser ascendido que una vez fue el Dr. Jackson. Igual que el resto de los seres que están en un plano de existencia superior, tienen prohibido implicarse en los problemas de los humanos. Aunque la personalidad de Jackson aún esta patente cuando asciende y puede infringir esa norma.', TRUE, TRUE),
(415, @SINRAZA, @DEFENSA, 'Sillón de los Antiguos', 0, '10000', '250000', '120000', '0', 'Plataforma de armas de la Antartida', FALSE, TRUE),
#Planetas
(38,  @SINRAZA, @NAVE,    'Korolev',    0,  '5000',  '7000',  '2000',   '0', '.', FALSE, TRUE),
(355, @SINRAZA, @NAVE,    'Destiny',    0, '10000', '50000', '25000',   '0', 'De diseño claramente Antiguo, la Destiny es una nave lanzada hace cientos de miles de años desde Dakara para, junto a varias naves hermanas, analizar y sembrar Stargates por todos los planetas alcanzables del espacio. No es una nave tripulada pero todo dentro de ella queda documentado. Posee poderosos cañones para hacer frente a obstaculos y una notable inteligencia artificial que nutre de recursos a sus ocupantes.', FALSE, TRUE),
(356, @SINRAZA, @NAVE,    'Clase Thor', 0 , '7000', '15000',  '4000',   '0', '.', FALSE, TRUE),

### Planetas
(385, @SINRAZA, @SOLDADO, 'Cassandra Fraiser',                       100,   '0',   '900', '100', '1200', 'Cassandra es la única sobreviviente de un planeta que había sido arrasado por una plaga bacteriana. El SG-1 trajo a Cassandra a la Tierra, donde descubrieron que Nirrti, había plantado una bomba de tiempo dentro de Cassandra en un esfuerzo por destruir la Stargate de la Tierra.', FALSE, FALSE),
(390, @SINRAZA, @SOLDADO, 'Camile Wray',                             100,  '10',  '1000', '100', '1200', 'Oficial de recursos humanos Tau\'ri del Comité Internacional de Supervisión, y principal representante del IOA en la Base Icaro, la cual se vieron obligados a evacuar tras un ataque. El grupo, en lugar de volver a La Tierra, se encuentraron varados en la nave antigua Destiny.', FALSE, FALSE),
(24,  @SINRAZA, @SOLDADO, 'Dra. Carolyn Lam',                        100,   '0',   '900', '200', '1200', 'Doctora jefe en el proyecto de alto secreto situado en el Complejo de las Montañas Cheyenne. Tomó el cargo en recomendación de su padre, el General Hank Landry, cuando este se hizo cargo del Proyecto Stargate.', FALSE, FALSE),
(25,  @SINRAZA, @SOLDADO, 'Dr. Jay Felger',                          100,   '0',  '1000', '100', '1200', 'Experto científico civil, que trabaja para el comando Stargate en investigaciones secundarias. Es el creador del virus "El Vengador" que inutiliza la red de stargates.', FALSE, FALSE),
(344, @SINRAZA, @SOLDADO, 'Eli Wallace',                             100,  '40',  '1000', '100', '1200', 'Antiguo alumno del MIT que es todo un geek. Totalmente vago aunque es un genio. Domina las matemáticas y la informática además de tener mucho sentido del humor. Sin embargo, carece de confianza debido a que su verdadera inteligencia nunca se ha reconocido.', FALSE, FALSE),
(318, @SINRAZA, @SOLDADO, 'Dr. William Lee',                         100,  '30',  '1000', '150', '1200', 'Doctor en Física y Astrofísica. Se introdujo en el SGC como ayudante del doctor Hamilton para despues tomar un puesto más importante. Vital para el estudio de aparatos antiguos y programas de ordenador de otras culturas. También acompañó al Dr. Jackson a Honduras en busca del aparato de Tel\'Chack. Pasa a ser el científico con mayor experiencia cuando Carter decide incorporarse al Área 51. ', FALSE, FALSE),
(27,  @SINRAZA, @SOLDADO, 'Dr. Nicholas Rush',                       100, '150',  '1000', '100', '1200', 'Brillante y maquiavélico científico escocés. Tras la muerte de su esposa, se dedicó en cuerpo y alma a su trabajo, que él antepone a cualquier cosa. Es una eminencia en los estudios sobre el noveno chevron.', FALSE, FALSE),
(12,  @SINRAZA, @SOLDADO, 'Jonas Quinn',                             100, '200',  '1000', '100', '1200', 'Antiguo asesor principal del Primer Ministro de Kelowna. Como el resto de los habitantes de Langara, Jonas posee la habilidad genética de aprender conceptos y lenguas con una rapidez inusual. Esto le dota de una inteligencia magnifica y muchas aptitudes para la ciencia. Amigo del Dr. Daniel Jackson, le sustituyó como arqueólogo y lingüista del SG-1 cuando este ascendió. Sus estudios sobre el naquadriah de su planeta son muy respetados dentro de la comunidad científica.', FALSE, FALSE),
(280, @SINRAZA, @SOLDADO, 'Jacob Carter',                            100, '500',  '1000', '100', '1200', 'Cuando la larva Goa\'uld Selmak veía que sus posibilidades para curar a su huésped, la anciana Saroosh, eran ya imposibles sin la ayuda de un sarcófago, tomo como anfitrión al moribundo padre de la Coronel Carter, el general Jacob Carter. Jacob seria desde entonces el mediador entre la Tok\'ra y La Tierra, pues conocia muy bien ambos mundos debido a su simbiosis con Selmak.', TRUE, TRUE),
(28,  @SINRAZA, @SOLDADO, 'General George Hammond',                  100, '500',  '1000', '200', '1200', 'El General George Hammond, oficial de la fuerza aérea desde mediados de los años 60, reemplazó en la dirección de la base al General West, quien comando el proyecto Stargate durante la misión original a Abydos. Hammond tenía como última tarea antes de su retiro desmantelar definitivamente el proyecto Stargate. Sin embargo, el ataque de Apophis al complejo lo obligó a seguir adelante con el programa. Como Comandante de la Unidad de Defensa e Investigación, el General Hammomd dirige el SGC y todas la unidades SG del Complejo en la Montaña Cheyenne. Su misión es analizar las amenazas potenciales de razas alienígenas, defender la Tierra de posibles invasiones y analizar y recuperar tecnologías para estudios más completos. De carácter duro pero permisivo, Hammond es el cerebro militar de las operaciones estelares del SGC. El maestro Jaffa Bra\'tac lo ha llamado "Hammond de Texas", debido a que es oriundo de dicho estado norteamericano.', FALSE, TRUE),
(310, @SINRAZA, @SOLDADO, 'General Hank Landry',                     100, '500',  '1000', '200', '1200', 'El General Henry Landry es asignado en el mando del Comando Stargate en el 2005 para suplir al general O\'Neill, que decidió dejar el puesto y ser sustituido definitivamente. Fue elegido por el presidente Henry Hayes y recomendado por el propio O\'Neill y George Hammond, viejos amigos suyos. Tiene una inclinación por citar a generales famosos como George Washington, Douglas MacArthur y George S. Patton.', FALSE, TRUE),
(20,  @SINRAZA, @SOLDADO, 'Coronel Harry Maybourne',                 100, '300',  '1000', '200', '1200', 'Coronel de las Fuerzas Aéreas Norteamericanas y líder de la organización NID. Se mostró reacio a colaborar con el Proyecto Stargate. Posteriormente, uso el Stargate para crear un comando de miembros del NID que operaban en secreto, robando tecnología alienígena para usarla en defensa de La Tierra. ', FALSE, TRUE),
(21,  @SINRAZA, @SOLDADO, 'Rey Arkhan',                              100, '600',  '1100',  '50', '1200', 'Cuando el Coronel de las Fuerzas Aéreas Norteamericanas, Harry Maybourne fue expulsado del ejercito por robar tecnología alienígena, decidió colaborar con el Coronel O\'Neill para desmantelar la corrupción en el NID y detener una infiltración Goa\'uld a la Tierra. Debido a su colaboración en estas dos operaciones, el SGC junto con la Tok\'Ra, decidió ocultarle en un planeta de la Vía Láctea. Gracias a su astucia, consiguió engañar a la sociedad medieval del planeta y convertirse en su Rey. A pesar de que el pueblo descubriría la verdad con el tiempo, siguieron aceptándole por las buenas obras que había realizado.', FALSE, TRUE),
(14,  @SINRAZA, @SOLDADO, 'Mayor Paul Davies',                       100, '300',  '1100', '200', '1200', 'Encargado de la oficina del mando conjunto (NORAD) que se encuentra por encima del sub-nivel 28 de Cheyenne Mountain. Siempre muy diplomático, Davis sirve de enlace entre el SGC y Washington donde informa al Pentágono recibiendo informes de las misiones del comando puntualmente.', FALSE, FALSE),
(15,  @SINRAZA, @SOLDADO, 'Mayor Louis Ferretti',                    100, '600',  '1100', '100', '1200', 'Uno de los componentes de la primera misión que el SGC realizo por el Stargate. De carácter más bien pesimista, reaccionó con hostilidad durante la primera misión a Abydos contra el Dr. Daniel Jackson cuando comprendió que no podrían volver a casa si éste no descubría cómo abrir la puerta desde aquel planeta. Tras su regreso, se incorporó al equipo SG-2, tomando el mando cuando el mayor Kawalsky murió.', FALSE, FALSE),
(16,  @SINRAZA, @SOLDADO, 'Mayor Charles Kawalsky',                  100, '700',  '1200', '100', '1200', 'Fué uno de los elegidos para cruzar el Stargate por primera vez, siendo el segundo al mando del grupo del Coronel Jack O\'Neill. Hombre leal, con gran sentido del deber y gran amigo de O\'Neill ayudó junto a sus compañeros a aquellas personas a liberarse del yugo de Ra.', FALSE, FALSE),
(319, @SINRAZA, @SOLDADO, 'Coronel Yuri Chekov',                     100, '500',  '1000', '100', '1200', 'Coronel del ejercito ruso. Fué designado por el Kremlin para tratar las negociaciones con EEUU sobre el uso del segundo Stargate, encontrado en la Antátida. De gran arrojo por su patria, la situación del Comando Stargate en su lucha con los Ori hizo que, a cambio de su Stargate, los rusos consiguieran su primera nave propia, la Korolev.', FALSE, TRUE),
(13,  @SINRAZA, @SOLDADO, 'Vala Mal Doran',                          100, '900',  '1000', '250', '1200', 'Ladrona y contrabandista que usa su astucia para apoderarse de naves de transporte y tecnología para luego venderlas al mejor postor. Tras hacerse con el Prometeo, conocerá al Dr. Daniel Jackson y, a pesar de las reticencias de éste, se introducirá en el Comando Stargate. En un accidente durante la destrucción del Super Stargate, fué enviada a la Galaxia Ori. Allí fue elegida por los Ori para dar a luz a su representante en el plano de existencia mortal, la Orici.', FALSE, TRUE),
(22,  @SINRAZA, @SOLDADO, 'Agente Malcolm Barret',                   100, '800',  '1000', '100', '1200', 'Es un agente del NID que lucha contra la corrupción en el cuerpo. Ha ayudado varias veces al SG-1 y es el hombre al mando de las operaciones anti-infiltraciones Goa\'uld en la Tierra.', FALSE, TRUE),
(23,  @SINRAZA, @SOLDADO, 'Agente Burke',                            100, '800',  '1000',  '50', '1200', 'Es un agente de la C.I.A. destinado en Honduras. Antiguo amigo del Coronel Jack O\'Neill, ya que sirvieron juntos en el ejercito.', FALSE, TRUE),
(395, @SINRAZA, @SOLDADO, 'Coronel David Telford',                   100, '1200', '1100', '150', '1200', 'Coronel en la Fuerza Aérea de los Estados Unidos. Un hombre de vida militar, que fue elegido originalmente para dirigir la expedición a través del Stargate, cuando se descubriera la capacidad de marcar el noveno chevron. Sin embargo, debido a la destrucción imprevista de la base, el Coronel Everett Young se convirtió en el nuevo líder. Tiempo después se descubrió que Telford habia sido drogado con Nishta por la Alianza Lucian durante una infiltración y que filtraba información sobre el Comando Stargate y la Destiny.', FALSE, TRUE),
(400, @SINRAZA, @SOLDADO, 'Coronel Everett Young',                   100, '1200', '1100', '200', '1200', 'Coronel de la Fuerza Aérea de Estados Unidos y comandante de la Base de �caro. Pasó algún tiempo como líder de un equipo SG. El general Jack O\'Neill, le ofreció ser comandante de la expedición �caro antes de ofrecerselo al Coronel Telford, pero Young lo rechazó, optando en su lugar para regresar a la Tierra. Tras el incidente en la base Icaro, Lídero a los supervivientes que habian quedado atrapados en la Destiny, con el objetivo de conseguir regresar a La Tierra.', FALSE, TRUE),
(449, @SINRAZA, @SOLDADO, 'Coronel Dave Dixon',                      100, '1300', '1100', '200', '1200', 'El coronel Dixon es un oficial de alto rango Tau\'ri que lidera el SG-13. Se unió al Programa Stargate tras servir en el Pentágono. Tiempo después, Dixon fue enviado al SG-1, oficialmente en calidad de observador, y ayudó a conseguir un tratado minero en un planeta llamado Adjo, dónde él y otros miembros del SG-1 estuvieron en peligro de morir por una versión Goa\'uld de la peste bubónica. Posteriormente se convirtió en el oficial al mando del SG-13. En una misión, su equipo encontró las ruinas de una antigua ciudad que más tarde fue atacado por Jaffas.', FALSE, TRUE),
(17,  @SINRAZA, @SOLDADO, 'Coronel Cameron Mitchell',                100, '1300', '1100', '200', '1200', 'Líder del SG-1 cuando O\'Neill es ascendido a general. Experto piloto militar, Lídero la escuadrilla de los F-302 en la batalla contra las fuerzas de Anubis en la Antártida pero cayó y quedó herido gravemente. Sin embargo, ante la promesa de que Líderaría el SG-1 se recuperó. De amplios conocimientos y de ida sencilla, "Cam" es un luchador nato desde su infancia. Nacido en Texas, el Líderazgo de Mitchell en batalla es primordial a la hora de decidirla.', FALSE, FALSE),
(26,  @SINRAZA, @SOLDADO, 'Coronel Jack O\'Neil Alternativo', 100, '1400', '1200', '200', '1200', 'Líder de las tropas Tau\'ri y comandante en Jefe del Comando Stargate. Militar desde los dieciocho años, es considerado un héroe entre sus similares por la cantidad de veces que ha resuelto situaciones límite. Fue el cerebro militar elegido para hacer el primer viaje a través del Stargate. Líder del SG-1, apoya con su Líderazgo y estrategia al resto de soldados, mejorando su moral y habilidades en combate. Además es un gran guerrero capaz de plantar cara a cualquier enemigo.', FALSE, TRUE),
(19,  @SINRAZA, @SOLDADO, 'General Jack O\'Neill',               100, '1500', '2000', '200', '1200', 'Líder de las tropas Tau\'ri y comandante en Jefe del Comando Stargate. Fué ascendido a General de las USAF por sus méritos en el Comando Stargate. Militar desde los dieciocho años, es considerado un héroe entre sus similares por la cantidad de veces que ha resuelto situaciones límite. Fue el cerebro militar elegido para hacer el primer viaje a través del Stargate. Líder del SG-1, apoya con su Líderazgo y estrategia al resto de soldados, mejorando su moral y habilidades en combate. Además es un gran guerrero capaz de plantar cara a cualquier enemigo. De gran entereza y sentido del humor, O\'Neill no sólo es respetado en la Tierra, sino entre las otras razas de la Vía Láctea como los Asgards.', FALSE, TRUE),

(40,  @SINRAZA, @NAVE, 'Fénix',                         150, '5000', '9000', '2000', '1080', 'Nave de la clase Dédalo asignada a la Coronel Samantha Carter para luchar en la Vía Láctea contra las facciones guerrilleras de Michael. Tiene lo último en armamento asgard y escudos de fuerza generados por MPC.', FALSE, TRUE),
(340, @SINRAZA, @NAVE, 'Sun Tzu',                            150, '5000', '6000', '3000', '1080', 'Nave de clase Dédalo que fué construida por los chinos mediante los planos originales de la BC302 compartidos por los EEUU durante la negociación por el control del Puesto de Avanzada de McMurdo. Fué mandada a la lucha contra la Super Colmena que amenazó la Tierra. Cuenta con un núcleo asgard y bahías de 302. Fué nombrada en honor a Sun Tzu, uno de los grandes estrategas militares de la historia de China.', FALSE, TRUE),


########################################################
# Goauld................................................
########################################################
### Tropas
(41,  @GOAULD, @SOLDADO, 'Droide de reconocimiento',   1,   '15',   '10',    '0',  '120', 'Unidades robóticas que están diseñadas para llevar a cabo misiones de reconocimiento y transmisión de información. Están hechas de un material capaz de soportar climas intensos. Cuentan con una amplia gama de sensores de alta resolución y largo alcance así como también unos pequeños cañones para defenderse de intrusos y destruir blancos específicos.', FALSE, FALSE),
(42,  @GOAULD, @SOLDADO, 'Guerreros Jaffa',            2,   '25',   '40',    '0',  '900', 'Tropas estándar de los Goa\'uld. Tienen una dependencia tanto física como psicológica de sus señores, que los usan como tropas y como incubadoras para sus larvas. Son fieles guerreros sin ningún miedo a morir por su dios.', FALSE, FALSE),
(43,  @GOAULD, @SOLDADO, 'Guardia Personal',           6,   '50',   '60',   '17',  '936', 'Jaffa de élite que defienden personalmente a su dios como guardaespaldas, Líderados por el primado, son guerreros muy bien entrenados y mejor armados.', FALSE, FALSE),
(50,  @GOAULD, @SOLDADO, 'Guerrero Kull',             42,  '390',  '787',  '222', '8370', 'Los conocimientos antiguos de Anubis le permitieron crear estos guerreros muy avanzados, superatletas a los que mantiene vivos una larva Goa\'uld. Protegidos por una armadura y unos escudos Goa\'uld capaces de absorber los disparos enemigos y armados con unas temibles armas de energía muy rápidas que causan muchas bajas en las líneas enemigas.', FALSE, TRUE),
(53,  @GOAULD, @SOLDADO, 'Thoth',                    200,    '0',  '793',  '224',  '900', 'Dios de la sabiduría, la escritura, la música, y símbolo de la Luna. Es un Goa\'uld menor experto en tecnología al servicio de otros Goa\'ulds. Es responsable de las mejoras tecnológicas y de adaptar las tecnologías robadas en las conquistas para su aplicación en las naves y defensas.', FALSE, FALSE),
(57,  @GOAULD, @SOLDADO, 'Her\'ak',              200,  '500',  '771',  '218',  '900', 'El líder de las tropas y guardaespaldas personal del Goa\'uld Anubis, a él se le encomienda Líderar las misiones más importantes. Her\'ak fue primado de Khonsu hasta que descubrió que era un infiltrado de la Tok\'ra y lo asesino. Su fama llego hasta oidos de Anubis que lo convirtió en su Primado.', FALSE, TRUE),
(60,  @GOAULD, @SOLDADO, 'Apophis',                  200,  '500',  '963',  '272',  '900', 'Uno de los mas poderosos Señores del Sistema Goa\'uld. Hermano de Ra, tras la caida de este domino a todos los pueblos de la Vía Lactea con despotismo y tirania. Apophis, representaba en la mitología egipcia a las fuerzas maléficas que habitan las tinieblas. Fue representada como una serpiente gigantesca.', FALSE, TRUE),
(62,  @GOAULD, @SOLDADO, 'Ba\'al',               200, '1300', '1247',  '352',  '900', 'Uno de los Señores del Sistema mas poderoso. Si bien es excepcionalmente despiadado, Ba\'al parece ser el que posee un mejor entendimiento de la naturaleza humana, más que lo típico para un Goa\'uld y tiene también una vaga comprensión del concepto de humor. Su estilo tiende más a una sutil insidiosidad que a una franca crueldad. Baal era una divinidad de varios pueblos situados en el Medio Oriente. Era el dios de la lluvia y la guerra.', FALSE, TRUE),

### Naves
(83, @GOAULD, @NAVE, 'Planeador de la Muerte',  6,   '120',   '150',     '0',  '504', 'Cazas ligeros biplaza con una alta capacidad de maniobra pero muy escasos en potencia de fuego e integridad. No poseen escudos ni pueden viajar por el hiperespacio. Los Jaffa las llaman "Udajit" en su lengua', FALSE, FALSE),
(84, @GOAULD, @NAVE, 'Aguja Afilada',          11,   '300',   '550',     '0', '2140', 'Planeadores de la Muerte modificados para poder atravesar el Stargate. Son unos cazas pesados equipados con una potencia de fuego y una integridad superior aunque no tienen motor de hiperpropulsión.', FALSE, FALSE),
(86, @GOAULD, @NAVE, 'Al\'kesh',           44,   '445',   '760',   '215', '8640', 'Pequeños cruceros Goa\'uld especializados en el bombardeo de superficies planetarias. Tiene capacidad para viajar por el hiperespacio, y poseen bodegas para cargar recursos.', FALSE, FALSE),
(88, @GOAULD, @NAVE, 'Ha\'tak',           107,  '1465',  '4193',  '1184', '5355', 'La nave estándar de las flotas Goa\'uld, con forma piramidal. Pueden aterrizar sobre las pirámides construidas en tierra. Tiene una potencia de fuego y una integridad grandes, posee unas amplias bodegas lo que aumenta su capacidad de carga y también pueden llevar cazas en su interior pudiendo llevarlos con él en los viajes hiperespaciales', FALSE, FALSE),
(89, @GOAULD, @NAVE, 'Palacio Nodriza',       161,  '5320',  '9067',  '2560', '8035', 'Enormes naves-palacio, símbolos del poder feudal de los Goa\'uld. Tienen un gran poder de ataque y unos escudos muy potentes. Su gran tamaño les permite tener una gran capacidad de carga y pueden llevar muchos cazas en su interior para realizar viajes hiperespaciales a gran velocidad.', FALSE, FALSE),
(94, @GOAULD, @NAVE, 'Estación Hassara', 300,  '1500', '35133',  '9920',  '900', 'Nave orbital de gran tamaño con poderosos escudos y una integridad fuera de lo normal. Usada por los Señores del Sistema Goa\'uld para relizar sus concilios y defenderse de los ataques de sus enemigos.', FALSE, TRUE),
(95, @GOAULD, @NAVE, 'Beelzebuth',            300, '10000', '14280',  '4032',  '900', 'Nave maestra encargada y diseñada por orden de Ba\'al en sus astilleros de Erebo. Es una poderosa nave palaciega con un poder superior al de cualquier nave nodriza común, con amplias galerías y enormes bahías para trasnportar Planeadores de la Muerte. Cuenta con potentes cañones de plasma, creados por los Antiguos y cuyos prototipos fueron encontrados por Ba\'al en una de sus escaramuzas.', FALSE, TRUE),

### Defensas
(79, @GOAULD, @DEFENSA, 'Campo de Fuerza',           8400,    '0', '126743', '35786', '67196', 'Barrera energética basada en la tecnoloía de escudos Goa\'uld para impedir el paso de las tropas enemigas por el Stargate.', FALSE, FALSE),
(80, @GOAULD, @DEFENSA, 'Cañón pesado',      12,  '100',    '200',     '0',  '1375', 'Controladas por Jaffa son la pieza estándar de la defensa Goa\'uld, simples, baratas y eficientes para la defensa por tierra.', FALSE, FALSE),
(81, @GOAULD, @DEFENSA, 'Torreta',                     23,  '175',    '261',     '74',  '1840', 'Similares en tecnología a las lanzaderas pesadas pero con mucha más potencia de fuego e integridad, situadas a una altura superior desde la que pueden alcanzar a los objetivos de tierra con más facilidad.', FALSE, FALSE),
(82, @GOAULD, @DEFENSA, 'Satélite Goa\'uld', 171, '5500',   '2901',    '819',  '5130', 'Satélites defensivos de tecnología Goa\'uld preparados para crear una red de defensa global sobre un planeta pudiendo repeler los ataques de naves enemigas dado su alto poder de ataque al actuar al unisono contra sus objetivos.', FALSE, FALSE),

### Especiales
#Raza
(59,  @SINRAZA, @SOLDADO, 'Anubis',            0,  '2000',  '8000',  '5000', '0', 'Antiguo Señor del Sistema que logró ascender pero que fué rechazado, quedando atrapado entre el plano de existencia superior y mortal. Aunque es extremadamente poderoso, sobrevive en forma de energía cautiva en una armadura antropomorfa. Anubis es el Señor de la ciudad de los muertos y era el encargado de guiar al espíritu de los muertos al "otro mundo".', TRUE, TRUE),
(408, @SINRAZA, @NAVE,    'Nodriza de Anubis', 0, '10000', '50000', '25000', '0', 'Gigantesca nave nodriza usada por el Señor del Sistema Anubis. Está dotada de un arma de energía especial en el centro de la nave, capaz de destruir las flotas del enemigo e incluso dañar la superficie de los planetas de un sólo disparo. Ademas tiene poder suficiente para destruir un Stargate.', FALSE, TRUE),
#Planetas
(51,  @SINRAZA, @SOLDADO, 'Ba\'al',                    0, '375', '750',  '30', '0', 'Clones del simbionte y anfitrión del Señor del Sistema Ba\'al. Pudo clonarse al descubrir un puesto avanzado de tecnología antigua. De esta forma se infiltró en la Tierra, consiguiendo poseer una estrategia muy potente.', FALSE, TRUE),
#.
(91,  @SINRAZA, @NAVE, 'Nave Imperial de Yu',      0,  '3000',  '13000',  '1000', '0', 'Nave comandada por el Señor de Jade Yu y que es la insignia de la flota imperial del Señor del Sistema. Los ejercitos de Yu son los mas numerosos y nobles de entre los Goa\'uld.', FALSE, TRUE),
(90,  @SINRAZA, @NAVE, 'Nave del Inframundo',      0,  '4000',  '15000',  '1500', '0', 'Nave nodriza de Sokar. Tras la caída de Apophis, Sokar fue el primer lord de la Via Láctea que se alzo en armas.', FALSE, TRUE),
(92,  @SINRAZA, @NAVE, 'Nodriza de Apophis',       0,  '5000',  '20000',  '1000', '0', 'Gran nave nodriza construida para el Señor del Sistema Apophis. Combinando tecnologias de otras razas, Apophis consiguio una nave muy poderosa en combate y que cambiaba las caracteristicas de su flota de Ha\'Taks, volviendolas invisibles.', FALSE, TRUE),
(93,  @SINRAZA, @NAVE, 'Palacio Cheops',           0,  '5000',  '20000',  '1000', '0', 'Ostentosa nave nodriza del Dios Sol Ra. De gran tamaño y potencia, aunque algo lenta, la nave de Ra es usada para viajar por los muchos enclaves planetarios del Goa\'uld y tanto vigilar como proteger las minas de Naquadad. Dentro de ella, caben naves de menor tamaño que son liberadas sobre el planeta si existe una amenaza.', FALSE, TRUE),

### Planetas
(61,  @SINRAZA, @SOLDADO, 'Apophis',               100, '1500',  '900', '300', '1200', 'Uno de los más poderosos Señores del Sistema Goa\'uld. Tras rumorearse su muerte, logró escapar de las garras del Señor del Sistema Sokar, que lo tenía apresado, haciendose dueño de sus posesiones y ejército. Apophis, representaba en la mitología egipcia a las fuerzas maléficas que habitan las tinieblas. Fue representada como una serpiente gigantesca.', FALSE, TRUE),
(63,  @SINRAZA, @SOLDADO, 'Hathor',                100,  '500', '1200', '100', '1200', 'Reina Goa\'uld, espoda de Ra y madre de Heru-ur. Conocida como la madre de todos los dioses, se encarga de crear las larvas para luego implantarlas en anfitriones. Fue encerrada en el Templo de Palenque, en Mexico hace miles de años en el interior de un sarcófago que la ha mantenido viva desde entonces. Hathor, cuyo nombre significa "Templo de Horus", fue una divinidad cósmica, diosa del amor, de la alegría, la danza y las artes musicales, diosa nutricia y patrona de los ebrios en la mitología egipcia.', FALSE, TRUE),
(64,  @SINRAZA, @SOLDADO, 'Heru-ur',               100, '1200',  '900', '100', '1200', 'Hijo de Ra y Hathor, Heru-ur es uno de los lores Goa\'uld mas violentos y sanginarios. Es enemigo mortal de su tío Apophis, y su familia por considerarlos desertores de la cusa de Ra. Fue uno de los gau\'uld que rompio el Tratado de Planetas protegidos de los Asgard al atacan Cimmeria. Horus "el elevado", dios celeste y dios sanador en la mitología egipcia. Se le consideró iniciador de la civilización egipcia. Es representado como halcón, u hombre con cabeza de halcón, con la corona Doble.', FALSE, TRUE),
(65,  @SINRAZA, @SOLDADO, 'Khalek',                100, '1600', '1800', '250', '1200', 'Hok\'Taur, geneticamente identico a Anubis concebido con un aparato de manipulacion genetica antiguo. Khalek posee la memoria genetica de Anubis y de muchos otros Goa\'uld. Esta diseñado para convertirse en un ser ascendido. Aun asi, en su estado normal es muy muy poderoso, controlando la telequinesis y rayos de energia. ', FALSE, TRUE),
(68,  @SINRAZA, @SOLDADO, 'Lord Yu',               100,  '400', '2000', '200', '1200', 'Honorable Señor del Sistema Goa\'uld, que reside en su palacio del planeta Jade. Es también conocido con el apelativo de Yu El Grande, y es uno de los más recientes emperadores de China que según cuenta una leyenda asumió el papel de dios porque poseía grandes y míticos poderes, viniendo al mundo del cuerpo de un dragón. Gobierna bajo unas reglas muy severas pero sabe también ser condescendiente y proporcionar avances e influencias positivas. ', FALSE, FALSE),
(69,  @SINRAZA, @SOLDADO, 'Nirrti',                100,  '900', '1000', '100', '1200', 'Una de las Señoras del Sistema mas crueles y despiadadas. A sus pies han caido mundos enteros. Con aptitudes para la ciencia experimental, Nirti ha perseguido durante siglos la creación del anfitrión perfecto: El Hok\'Taur, un humano alterado genéticamente con un increíble poder psiquico. Nírti era originalmente una diosa de la muerte, relacionada con la diosa Devi. En el posterior hinduismo, Nírti se convirtió en una de las guardianas de las direcciones (dik pala).', TRUE, FALSE),
(71,  @SINRAZA, @SOLDADO, 'Osiris',                100,  '500', '1200', '200', '1200', 'Antiguo Señor del Sistema que fue confinado en un vaso canopo egipcio por Ra a modo de castigo y oculto en la Tierra. Varios años despues logro salir y tomar un anfitrión, volviendo a tomar la confianza de los Señores del Sistema como Goa\'uld menor de Anubis. Osiris era el dios de la resurrección, símbolo de la fertilidad y regeneración del Nilo; es el dios de la vegetación y la agricultura; también preside el tribunal del juicio de los difuntos en la mitología egipcia.', TRUE, FALSE),
(73,  @SINRAZA, @SOLDADO, 'Ra',                    100, '1000',  '900', '200', '1200', 'Señor Supremo del Sistema, tambien denominado Dios Sol. Durante siglos, Ra comando las legiones de los ejercitos de los Señores del Sistema con mano de acero y violencia, siendo esta una época de terror en los mundos de la Vía Lactea. Fue el primer Goa\'uld en tomar un anfitrión humano. Ra "Gran Dios" anónimo, demiurgo, dios solar de Heliópolis en la mitología egipcia. Ra era el símbolo de la luz solar, dador de vida, así como responsable del ciclo de la muerte y la resurrección.', FALSE, TRUE),
(74,  @SINRAZA, @SOLDADO, 'Tanith',                100,  '300',  '900',  '50', '1200', 'Goa\'uld menor que obtuvo poder despues de traicionar a la Tok\'ra. Servidor de Apophis, tras la caída de este se alineo con la resistencia a los Señores del Sistema de Anubis.', FALSE, TRUE),
(75,  @SINRAZA, @SOLDADO, 'Sokar',                 100,  '900', '1100', '150', '1200', 'Durante años, Sokar fue uno de los Señores del Sistema mas malvados y poderosos. Sin embargo, tras enfrentarse a Ra y Apophis, fue desterrado a los mundos exteriores y concentro sus fuerzas en Netu, una luna del planeta Delmak. Desde alli ataco las bases de los Señores del Sistema, minando sus fuerzas y siendo un poderoso enemigo. Sokar, dios de la oscuridad, del Mundo Inferior y la decadencia en la Tierra, según la mitología egipcia. Era protector de los muertos y patrón de los herreros. Tambien ha sido identificado con el Demonio cristiano.', FALSE, TRUE),
(76,  @SINRAZA, @SOLDADO, 'El Unas',               100,  '850',  '800',  '20', '1200', ' "El Primero", o "el Unas" fue el primer unas que recibio como huesped a un Goa\'uld. Los Unas fueron los primeros huespedes humanoides de los Goa\'uld. Cuando encontraron a los humanos, desecharon sus cuerpos Unas.', FALSE, FALSE),
(78,  @SINRAZA, @SOLDADO, 'Zipacna',               100,  '900', '1000', '100', '1200', 'Goa\'uld menor al servicio de Apophis que tras la caida de éste logró importantes victorias al servicio de Anubis. Fué el responsable de la toma de Tollana y de la caida de la base Tok\'ra de Revanna. Zipacna era en la mitología maya un hijo de Vucub Caquix, el "Siete Guacamayo" y Chimalmat. Él y su hermano, Cabrakan, a menudo eran considerados demonios. Se decía que Zipacna, como sus parientes, era muy arrogante y violento. Era caracterizado como un caimán grande y a menudo alardeado para ser el creador de las montañas.', FALSE, FALSE),
(230, @SINRAZA, @SOLDADO, 'Seth',                  100,  '900', '1100', '150', '1200', 'Hace varios miles de años, durante su estancia en la Tierra, traicionó a su hermano Osiris y hermana Isis, sacándolos de sus anfitriones y colocándolos en frascos de éxtasis. También intentó matar a Ra, pero fracasó y pasó a la clandestinidad. Seth es la deidad de la fuerza bruta, Señor del mal y las tinieblas, dios de la sequía y del desierto en la mitología egipcia. Seth fue la divinidad patrona de las tormentas, la guerra y la violencia.', FALSE, TRUE),
(317, @SINRAZA, @SOLDADO, 'Bastet',                100,  '900', '1100', '150', '1200', 'La peligrosa Bastet no llegó al poder hasta la segunda dinastía gobernante Goa\'uld. Uniendo fuerzas con Kali, las dos hicieron un trato con Sobek, para luego, en la fiesta de celebración, traicionarle. Se rumorea que la cabeza de Sobek todavía decora el palacio de Bastet en Bubastis. Infiel y mortal, bastet es considerada una de las Señoras del Sistema más peligrosas. Sus legiones de Jaffa son famosas por estar compuestas en su gran mayoría por mujeres.', FALSE, TRUE),
(371, @SINRAZA, @SOLDADO, 'Camulus',               100, '1000',  '500', '150', '1200', 'Camulus es el segundo embajador goa\'uld enviado a La Tierra para llegar a un acuerdo con los Tauri para combatir a Ba\'al. Tratará de engañar a la Tierra tratando de conseguir un ZPM pero fue descubierto, pidiendo asilo posteriormente a la Tierra al ver que el resto de goa\'uld podría acabar con sus escasos dominios. En la mitología celta, Camulus era dios de la guerra que vivió en el área que es hoy Bélgica. Los rastros de su culto también se encuentran en Gran Bretaña.', FALSE, TRUE),
(383, @SINRAZA, @SOLDADO, 'Cronus',                100, '1200',  '600', '100', '1200', 'Es uno de los mas influyentes Señores del Sistema. Ha sido el único que ha conseguido expulsar a Sokar, siendo además enemigo encarnizado de Apophis. El padre de Teal\'c fue Primado suyo, tras mandarle a una batalla en que la que no iba a tener ninguna posibilidad de ganar, lo mandó matar y mandó al éxilo a un Teal\'c aún niño y a su madre, al planeta Chulak. Lleva el nombre de uno de los doce Titanes en la mitología griega y en esta cultura consiguió alcanzar el poder supremo. Fue también el dios del destino, de la suerte y se convirtió en el padre de Zeus, Hera, Poseidón y Hades. ', FALSE, TRUE),
(443, @SINRAZA, @SOLDADO, 'Atenea',                100,  '600', '1200', '100', '1200', 'Atenea es una Goa\'uld que se infiltró en La Tierra tomando el cuerpo de Charlotte Mayfield, vicepresidenta de Farrow-Marshall Aeronautics, una empresa controlada por Ba\'al que era una tapadera del TRUST, una organización Goa\'uld en La Tierra. Anteriormente, Athenea había sido rival de Qetesh, pues ambas ambicionaban encontrar la Clava Thessara Infinitas. Atenea es, en la mitología griega, la diosa de la guerra, la civilización, la sabiduría, la estrategia, artes y la justicia. Es una de las principales deidades del panteón griego y uno de los doce dioses del Olimpo.', FALSE, TRUE),
(446, @SINRAZA, @SOLDADO, 'Apophis',               100,  '500', '1000', '250', '1200', 'Uno de los mas poderosos Señores del Sistema Goa\'uld. Hermano de Ra, tras la caida de este domino a todos los pueblos de la Vía Lactea con despotismo y tirania. Apophis, representaba en la mitología egipcia a las fuerzas maléficas que habitan las tinieblas. Fue representado como una serpiente gigantesca.', FALSE, TRUE),

(442, @SINRAZA, @NAVE, 'Palacio del Halcón',  150, '5500', '12000', '2000', '1080', 'Ostentosa nave nodriza del Goa\'uld Heru\'ur, hijo de Ra. De gran tamaño y potencia, esta nave es usada para viajar por los muchos enclaves planetarios del Goa\'uld y tanto vigilar como proteger las minas de Naquadad. Dentro de ella, caben naves de menor tamaño que son liberadas sobre el planeta si existe una amenaza.', FALSE, TRUE),

########################################################
# Asgard................................................
########################################################
### Tropas
(98,  @ASGARD, @SOLDADO, 'Sonda Huginn-Muninn',   1,    '0',   '40',   '0',   '120', 'Aparatos cibernéticos para la exploración de planetas desconocidos a través del Stargate. No poseen armas ya que su misión es pasar inadvertidas y escanear áreas conflictivas. En La Tierra, son consideradas OVNIS, debido a los miles de avistamientos que ha habido. En la mitología nórdica Huginn y Muninn son un par de cuervos que viajaban alrededor del mundo recogiendo noticias e información para Odin.', FALSE, FALSE),
(99,  @ASGARD, @SOLDADO, 'Thor',                200,    '5',  '261', '74',   '900', 'Cuerpo clónico que guarda en su interior el subconsciente del Asgard Thor. Comandante supremo de la flota Asgard y Líder militar de su raza. Debido a su debilidad genetica, los asgards no son muy buenos combatientes en Tierra. Aun asi, son una raza muy desarrollada a nivel social y pueden pedir ayuda a otras razas si se tercia. Thor es el dios del trueno en la mitología nórdica y germánica.', FALSE, TRUE),
(100, @ASGARD, @SOLDADO, 'SuperSoldado',         74,  '350',  '929', '262', '11816', 'Exoesqueleto de materiales muy duros creado por una facción Asgard que reside en la galaxia Pegasus. Tiene un escudo protector de amplio tamaño, capacidad para soportar la ingravidez y la movilidad de un ser humano, pudiendo correr, disparar y luchar cuerpo a cuerpo.', FALSE, TRUE),
(358, @ASGARD, @SOLDADO, 'Vanir',               200, '2500', '1791', '506',   '900', 'Cientifico rebelde de la facción Asgard de la galaxia Pegasus, dirige y mejora la moral de todos los Supersoldados gracias a su frialdad y confianza. Los Vanir se separaron los de los demas Asgard por conflictos ideologicos hace mucho tiempo.', FALSE, TRUE),

### Naves
(104, @ASGARD, @NAVE, 'Nave de asalto',            10,    '85',    '99',   '28', '2020', 'Naves asgard que utiliza la faccion separatista de Pegasus. Tienen grandes bodegas de carga y un motor de hiperpropulsión muy avanzado, pudiendo abrir ventanas hiperespaciales en decimas de segundo.', FALSE, FALSE),
(105, @ASGARD, @NAVE, 'Beliksner',                 36,   '712',  '1337',  '378', '7140', 'Nave estándar de los Asgard, también conocida como "El Carro de Thor". Usadas para defender la galaxia de la opresión Goa\'uld y proteger el "Tratado de planetas protegidos". Armada con armas y escudos Asgard y con capacidad para viajar por el hiperespacio.', FALSE, FALSE),
(106, @ASGARD, @NAVE, 'Jackson',                   81,  '1900',  '5803', '1638', '4040', 'Cuando Anubis aumento el potencial de la tecnología Goa\'uld, la clase Beliksner quedo obsoleta, por lo que los Asgard desarrollaron este nuevo modelo mucho más avanzado al que llamaron "Daniel Jackson", y que Lídera las flotas Asgard en su lucha contra los Goa\'ulds.', TRUE, FALSE),
(107, @ASGARD, @NAVE, 'O\'Neill',             156,  '7100', '15187', '4288', '7800', 'Nave suprema de la flota asgard, desarrollada ante la impotencia en la lucha contra los replicantes. La clase O\'Neill posee lo último en tecnología armamentística y escudos de los Asgard, convirtiéndose en una de las naves mas poderosas en la galaxia.', FALSE, FALSE),
(108, @ASGARD, @NAVE, 'Científico Heimdall', 300,     '0',  '7933', '2240',  '900', 'Los científicos asgard se dedican a todo tipo de investigaciones a bordo de sus enormes Naves de Ciencia. Sus investigaciones van desde tecnología genética hasta el desarrollo de armas para sus naves y defensas.', FALSE, FALSE),
(109, @ASGARD, @NAVE, 'Valhalla',                 300,  '6000', '10993', '3104',  '900', 'Oficial asgard que tiene sobre su mando una flota encargada de proteger los planetas del "Tratado de planetas protegidos" contra los ataques enemigos. Su sola presencia en batalla aumenta la moral de las naves asgard.', FALSE, TRUE),
(112, @ASGARD, @NAVE, 'Comandante Supremo Thor',  300, '10000', '18133', '5120',  '900', 'Líder de la flota asgard, muy poderoso y temido por sus enemigos. Con gran poder de fuego y una gran integridad y escudos, el Comandante Supremo cuida los intereses asgard en las zonas en guerra de la galaxia. Mejora a todas las naves que luchan a su lado.', FALSE, TRUE),

### Defensas
(101, @ASGARD, @DEFENSA, 'Martillo de Thor',    1000,    '0',  '48733', '13760',  '1800', 'Un martillo muy parecido a los martillos de defensa, pero con un coste de energía mucho mas bajo. Desarrollado por los científicos Asgards para la defensa de su planeta principal.', FALSE, FALSE),
(102, @ASGARD, @DEFENSA, 'Martillo de Defensa', 5300,    '0', '153000', '43200', '42500', 'El arma defensiva principal de los Asgard, lanza un rayo de energía sobre las tropas enemigas teletransportándolas a lugares cerrados de donde no pueden escapar. Usada en los planetas bajo "El tratado de planetas protegidos".', FALSE, FALSE),
(103, @ASGARD, @DEFENSA, 'Satélite Asgard', 206, '6000',   '3797',  '1072',  '6180', 'Desarrollado en la guerra contra los replicantes, esta arma orbital puede ser armado con todo tipo de armamento Asgard y lanzada al espacio desde donde es eficaz en la defensa contra cualquier enemigo.', FALSE, FALSE),

### Especiales
(409, @SINRAZA, @NAVE, 'Palacio de Valaskjálf', 0, '15000', '50000', '20000', '0', '.', FALSE, TRUE),

### Planetas
(110, @SINRAZA, @NAVE, 'Técnico Hermiod',   150, '5000', '10000', '3000', '1080', 'Nave de guerra del asgard Hermiod. Hermiod es el asgard enviado a escoltar a los Tau\'ri de Atlantis a la galaxia Pegasus. En la mitología nórdica, Hermógr es el dios enviado por los Aesir a Helheim para intentar que su reina.', FALSE, TRUE),
(111, @SINRAZA, @NAVE, 'Embajador Kvasir',       150, '6000', '12000', '3000', '1080', 'Nave de guerra del asgard Hermiod. Fue una de las naves que la raza humanoide envio a la batalla del superstargate, saliendo ilesa de la misma aunque dañada. Cuenta con las ultimas mejoras en tecnologia asgard. Kvasir es un dios de la mitología nórdica. Fue creado de la saliva de todos los dioses, convirtiéndose así en el más sabio de los Vanir. Dos hermanos, los enanos Fjalar y Galar, lo invitaron a un banquete en su caverna y lo mataron. Los enanos mezaclaron su sangre con miel y la preservaron. La mezcla fermentó y se convirtió en la hidromiel que inspiraba a los poetas.', FALSE, TRUE),
(330, @SINRAZA, @NAVE, 'El Carro de Thor',       150, '6000',  '9000', '2000', '1080', 'Nave clase Beliksner personal del Comandante Supremo Thor. Utiliza el rayo teletransportador como arma contra tropas y pequeñas naves. El poema escáldico Haustlöng relata que la tierra era arrasada y las montañas se resquebrajan cuando Thor viajaba en su carro.', FALSE, TRUE),
(405, @SINRAZA, @NAVE, 'Alto Consejero Freyr',   150, '4000', '10000', '3000', '1080', 'Freyr es un miembro de la raza Asgard y miembro del Alto Consejo Asgard. El SG-1 encontró por primera vez a Freyr cuando el coronel Jack O\'Neill se reunió con el Consejo Superior Asgard para discutir sobre los daños del sol de K\'Tau.', FALSE, TRUE),
(406, @SINRAZA, @NAVE, 'Alto Consejero Penegal', 150, '4000', '10000', '3000', '1080', 'Penegal es un miembro del Alto Consejo Asgard. Informó a Thor que los Replicantes atacaban el asentamiento de Orilla.', TRUE, FALSE),
(407, @SINRAZA, @NAVE, 'Escuadró n Vanir',  150, '1800',  '7000', '1000', '1080', 'El líder Vanir era miembro y líder de la faccion de renegados Asgard de la Galaxia Pegasus. Fue el líder de la fuerza de ataque que se infiltró en Atlantis. Comanda el puesto de avanzada abandonado en Atteros que contenía el dispositivo Attero, letal para las naves Wraith. Llevaba un traje blindado de SuperSoldado.', TRUE, FALSE),
(447, @SINRAZA, @NAVE, 'Científico Loki',   150, '6000',  '6800',  '650', '1080', 'Loki fue un científico Asgard, que planeó una manera de curar a su especie de la decadencia de su genoma causado ​​por la clonación constante de sus cuerpos. Hacia 1985, sus acciones fueron descubiertas, y el Alto Consejo Asgard lo desterró. Loki es un dios de la mitología nórdica que es descrito como el origen de todo fraude.', TRUE, TRUE),


########################################################
# Jaffa.................................................
########################################################
### Tropas
(113, @JAFFA, @SOLDADO, 'Sacerdote Jaffa',        1,   '12',   '25',   '0',  '120', 'Tras la rebelión Jaffa muchos sacerdotes se unieron a los rebeldes dedicándose a la exploración de otros mundos a través del Stargate donde producen nuevas revueltas anti-Goa\'uld y reclutan rebeldes a la causa Jaffa.', FALSE, FALSE),
(114, @JAFFA, @SOLDADO, 'Rebeldes Jaffa',         2,   '20',   '40',   '0',  '900', 'Antiguas tropas de muchos Goa\'uld que gracias a la tretonina de los Tau\'ri se libraron de su dependencia física de las larvas simbionte y se unieron a la rebelión buscando la venganza contra los Señores del Sistema y la creación de la Nación Libre Jaffa.', FALSE, FALSE),
(118, @JAFFA, @SOLDADO, 'Dis\'tra',          11,   '55',   '57',  '16', '1800', 'Antiguos primados de los Señores del Sistema Goa\'uld que han decidido unirse a la rebelión sabiendo que los éstos no son dioses y buscando derrocarles a sus antiguos señores. Grandes guerreros muy bien entrenados y muy valorados en combate. Ademas, son muy venerados y admirados por las generaciones jóvenes que los llaman "Dis\'tras" que significa "maestro" en lengua Goa\'uld.', FALSE, FALSE),
(119, @JAFFA, @SOLDADO, 'Guerrero Sodan',        14,  '180',  '317',  '90', '3000', 'Los Sodan son un grupo de Jaffas rebeldes que hace algo más de 5.000 años comprendieron que los Goa\'uld no eran dioses y se rebelaron contra el Señor del Sistema Ishkur. Empezaron a viajar a través de la galaxia y finalmente se establecieron en un planeta oculto con gran cantidad de tecnología Antigua. Cuando el resto de los Jaffa iniciaron la rebelión contra sus señores Goa\'uld, los Sodan se unieron a ellos, siendo posteriormente parte de la Nación Libre Jaffa. El estilo de lucha Sodan es superior al de todos los demás Jaffa y cuenta con la ventaja de la invisibilidad.', TRUE, FALSE),
(120, @JAFFA, @SOLDADO, 'Rak\'nor',         200,  '300',  '397', '112',  '900', 'Hijo de Delnor, el cual se unió a la rebelión Jaffa tratando de que los suyos también lo hicieran. Por ello, arrancó a su hijo de la frente el símbolo de adoración a los Goa\'uld. Al enterarse, Apophis mató a su familia y le dejó vivir a cambio de servirle. Despues de esto, Teal\'c conseguira convencerle y se unira a la rebelion Jaffa como su padre antes que él.', FALSE, TRUE),
(124, @JAFFA, @SOLDADO, 'Jolan',                200, '1000',  '657', '186',  '900', 'Valeroso guerrero de los Jaffa libres de Sodan. Es un aguerrido combatiente que utiliza todas sus habilidades de lucha, combinandolas con la tecnología de camuflaje Sodan, para derrotar oponentes. Entrenó y retó al coronel Mitchell en el ritual Kel Shak Lo, pensando que este habia asesinado a su hermano.', TRUE, TRUE),
(127, @JAFFA, @SOLDADO, 'Teal\'c',          200, '1200', '1247', '352',  '900', 'Teal\'c es hijo de un Jaffa que fue Primado de Cronos. Fue aprendiz del Maestro Bra\'tac, y con el tiempo llegó a ser Primado de Apophis. Su interacción con Bra\'tac y sus propias experiencias personales, condujeron a Teal\'c a dudar en la divinidad de los Goa\'uld. En un determinado momento, traiciono a Apophis y se unió a los Tau\'ri de La Tierra, entrando a formar parte del Comando Stargate. Con ayuda de estos, consiguio ayudas vitales contra los Señores del Sistema, creando vía libre para fundar la Nacion Libre Jaffa. Teal\'c es un experto guerrero en todas las facetas y un hombre muy leal a sus principios.', FALSE, TRUE),
(129, @JAFFA, @SOLDADO, 'Maestro Bra\'tac', 200, '1300', '2040', '576',  '900', 'Gran maestro Jaffa y amigo de Teal\'c. Cuando éste era más joven, sirvió como primado de Apophis, para posteriormente pasarle el testigo. Vive en Chulak, hogar de los Jaffa reclutados por Apophis, donde adiestra a los jovenes en la creencia de que los Goa\'uld son dioses falsos. Bra\'tac yudó activamente al SG-1 y a la familia de Teal\'c cuando fue perseguido. También líderó la resistencia Jaffa para luchar contra los Goa\'uld. Maestro en el arte de las técnicas de lucha Jaffa, cuando va a la batalla, asegura el éxito de las misiones y consigue mas Jaffa rebeldes que se unen a la causa.', FALSE, TRUE),

### Naves
(134, @JAFFA, @NAVE, 'Udajeet',                  6,   '125',   '150',    '0',  '264', 'Cazas ligeros biplaza con una alta capacidad de maniobra pero muy escasos en potencia de fuego e integridad. No poseen escudos ni pueden viajar por el hiperespacio. La clase Udajeet, además, permite que la cabina se abra para ataques en superficie.', FALSE, FALSE),
(135, @JAFFA, @NAVE, 'Tel\'Tak',            15,   '150',   '159',   '45', '3040', 'Pequeñas naves de carga Jaffa que no tienen poder de ataque, pero van provistas de escudos y una integridad suficiente. Su principal misión es el transporte de recursos y personal de un planeta a otro ya que poseen anillos de transporte y pueden realizar viajes hiperespaciales.', TRUE, FALSE),
(136, @JAFFA, @NAVE, 'Al\'kesh Jaffa',      31,   '800',  '1015',  '287', '6120', 'Pequeños cruceros Jaffa especializados en el bombardeo de superficies planetarias. Tiene capacidad para viajar por el hiperespacio, y poseen bodegas para cargar recursos.', TRUE, FALSE),
(137, @JAFFA, @NAVE, 'Ha\'tak Jaffa',       86,  '1615',  '5100', '1440', '4275', 'La nave estándar de las flotas Jaffa, con forma piramidal. Pueden aterrizar sobre las pirámides construidas en tierra. Tiene una potencia de fuego y una integridad grandes, posee unas amplias bodegas lo que aumenta su capacidad de carga y también pueden llevar cazas en su interior pudiendo llevarlos con él en los viajes hiperespaciales', FALSE, FALSE),
(138, @JAFFA, @NAVE, 'Nave Nodriza',           192,  '4115',  '7253', '2048', '9605', 'Enormes naves-palacio que los Jaffa han conseguido adueñarse al derrocar a sus dueños. Tienen un gran poder de ataque y unos escudos muy potentes. Su gran tamaño les permite tener una gran capacidad de carga y pueden llevar muchos cazas en su interior para realizar viajes hiperespaciales a gran velocidad.', FALSE, FALSE),
(139, @JAFFA, @NAVE, 'Consejero Tolok',        300,  '2500',  '7253', '2048',  '900', 'Nave del consejero oficial de la Nacion Libre Jaffa. Sirve de nave burocrática y para misiones de diplomacia, aunque tambien tiene mucho que decir en los combates espaciales.', FALSE, TRUE),
(140, @JAFFA, @NAVE, 'Líder del Consejo', 300,  '3500',  '7253', '2240',  '900', 'Nave de Gerak, líder del consejo de sabios de la Nación Jaffa. Su nave esta por encima de las del resto de la flota Jaffa y es un gran apoyo para el resto de sus hermanos en su lucha con los Goa\'uld y los Ori.', FALSE, TRUE),
(141, @JAFFA, @NAVE, 'Tal\'pat Ryn',       300,  '9000', '12852', '3629',  '900', 'Nave insignia de la flota Jaffa. Comandada por Teal\'c, Aron y Bra\'tac, los mas carismáticos guerreros que iniciaron la rebelión para derrocar a los Goa\'uld y establecer la Nacion Libre Jaffa. Recibe el nombre de "Tal\'pat Ryn" que significa "Estrella Fugaz", ya que es la nave mas poderosa y su presencia en batallas es crucial, aumentando la moral de todos sus hermanos Jaffa.', FALSE, TRUE),

### Defensas
(130, @JAFFA, @DEFENSA, 'Protector del Chappa\'ai', 8400,    '0', '126746',  '35787', '67200', 'Barrera energética basada en la tecnología de escudos Goa\'uld para impedir el paso de las tropas enemigas por el Stargate, adaptada por los Jaffa para permitir el paso de las tropas amigas.', FALSE, FALSE),
(131, @JAFFA, @DEFENSA, 'Lanzadera pesada',               12,  '200',    '272',     '77',  '1320', 'Controladas por Jaffa son la pieza estándar de la defensa Goa\'uld, simples, baratas y eficientes para la defensa por tierra.', FALSE, FALSE),
(132, @JAFFA, @DEFENSA, 'Atalaya',                        23,  '175',    '261',     '74',  '1265', 'El Gran Consejo Jaffa decidio, tras la destruccion de Dakara, que la tecnología del arma les ayudaria a defenderse de sus enemigos. Para ello replicaron el nucleo del arma de Dakara para crear pequeñas atalayas de defensa, mucho menos poderosas que la original pero que sirvieron de gran ayuda para defender puntos vitales de incursiones terrestres.', FALSE, FALSE),
(133, @JAFFA, @DEFENSA, 'Mina orbital',                   20, '2250',    '100',      '0',   '600', 'Minas planetarias colocadas en orbita alrededor del planeta. Producen serios daños a toda nave enemiga que entre en contacto con ellas, provocando su destrucción. Una nave atrapada en un campo de minas lo tiene muy difícil para escapar.', FALSE, TRUE),

### Especiales
(285, @SINRAZA, @SOLDADO, 'Oma DeSala',     0,  '2000',   '8000',   '5000', '0', 'Es un espíritu identificado con la Madre Naturaleza, teniendo el poder de crear y destruir igual que la propia Naturaleza. Dentro de los Antiguos ascendidos, Oma es una de las pocas que usa su poder para enseñar a ascender a los seres humanos. Tambien es la protectora del Harsessis, Shifú.', TRUE, TRUE),
(411, @SINRAZA, @DEFENSA, 'Arma de Dakara', 0, '15000', '300000', '150000', '0', 'La superarma Dakara es un dispositivo oculto capaz de reducir toda la materia en sus componentes elementales básicos, y reestructurar la misma. Se encuentra en el Templo de Dakara, un lugar sagrado para la Nación Libre Jaffa y la sede de su nuevo gobierno. Posee la capacidad para atravesar los escudos de todos los buques conocidos (incluyendo los de los Asgard y los buques de guerra Ori) que también funciona como un arma devastadora para matar a toda la tripulación de los buques en órbita o destruir toda la vida en la superficie de cientos de planetas en un momento.', FALSE, TRUE),

### Planetas
(369, @SINRAZA, @SOLDADO, 'Drey\'auc',       100,  '100',  '700',  '10', '1200', ' Es la esposa de Teal\'c. Tuvo que refugiarse con su hijo en un campamento de refugiados al ser despreciados por la sociedad de Chulak ante la traición a Apophis de su esposo. Condenada a la misería, vio como su hijo enfermaba, por lo que convenció a los monjes para que le dieran la oportunidad de ser en un futuro un Jaffa y portar en su interior una larva de goa\'uld.', FALSE, FALSE),
(370, @SINRAZA, @SOLDADO, 'Shan\'auc',       100,  '100',  '700',  '10', '1200', 'Shan\'auc de la Colinas Rojas era una sacerdotisa Jaffa de Chulak. Shan\'auc llegó a creer que había convencido a su larva simbionte Goa\'uld para que renegase de los Goa\'uld. Sin embargo fue engañada por esta para infiltrarse en la Tok\'ra.', FALSE, FALSE),
(121, @SINRAZA, @SOLDADO, 'Aron',                100,  '600',  '700',  '50', '1200', 'Antiguo Jaffa al servicio de Moloc. Se unirá a Torok en el ataque a Dakara para reconquistar el templo y lograr un gran avance en la rebelón Jaffa.', FALSE, TRUE),
(123, @SINRAZA, @SOLDADO, 'Ishta',               100,  '700',  '700',  '50', '1200', 'Suma sacerdotisa de las Jaffas de Moloc y de las Jaffas rebeldes del planeta Hak\'tyl. En sus incursiones como espía de Moloc, salva a los bebés niñas y se las lleva a Hak\'tyl donde crecen. Después mata a los Jaffa hombres para quitarles las larvas e implantarselas a las jóvenes antes de la edad de Prin\'ta.', FALSE, TRUE),
(125, @SINRAZA, @SOLDADO, 'Gerak',               100,  '500',  '900',  '50', '1200', 'Antiguo primado de Montu y primer Líder de la Nacion Libre Jaffa que pretendio instaurar un gobierno militar. Forma parte del la faccion tradicionalista del consejo que rechaza cualquier ayuda Tau\'ri y Tok\'ra. Un guerrero desde su mas tierna infancia, Gerak es considerado uno de los Jaffas mas prestigiosos de toda la galaxia. ', FALSE, TRUE),
(427, @SINRAZA, @SOLDADO, 'M\'zel',          100,  '800',  '800',  '50', '1200', 'Un líder del movimiento de resistencia Jaffa, M\'zel es un guerrero algo estoico y reflexivo. Estuvo presente en el segundo sitio de la Base Alfa cuando fue atacado por las fuerzas de Anubis.', FALSE, TRUE),
(380, @SINRAZA, @SOLDADO, 'Va\'lar',         100,  '800',  '800',  '50', '1200', 'Antiguo comandante de los ejercitos de Apophis y amigo de Teal\'c. Cuando volvió derrotado de una batalla contra las fuerzas de Ra, y Apophis ordenó a Teal\'c que le matase por fallar a su dios. En vez de eso, Teal\'c le acompaño hasta la superficie del planeta, donde la gran batalla se había librado y le perdonó la vida. Va\'lar huyó durante años hasta que los Jaffa se rebelaron contra los Goa\'uld.', FALSE, TRUE),
(122, @SINRAZA, @SOLDADO, 'Arkad',               100,  '700',  '700',  '50', '1200', 'Jaffa que se aprovecha de la debilidad del consejo Jaffa y decide aliarse a los ori para conseguir mas poder. Tiene cuentas pendientes con el Jaffa Teal\'c debido a que mato a su madre por dejarle en ridiculo combate a combate cuando eran los dos primados.', FALSE, TRUE),
(444, @SINRAZA, @SOLDADO, 'Lord Haikon',         100, '1300', '1500', '100', '1200', 'Lord Haikon es el líder de los Sodan, una facción Jaffa que se rebeló del yugo de los Goa\'uld hace quinientos años. Contó con la ayuda de los Tau\'ri cuando los priores Ori intentaron que los Sodan se entregasen a las creencias de Origen.', TRUE, TRUE),
(445, @SINRAZA, @SOLDADO, 'Volnek',              100,  '800',  '900', '100', '1200', 'Jaffa Sodan hermano de Jolan. Fue herido por Cameron Mitchell, muriendo su simbionte. Se le envió a La Tierra para ser tratado con tretonina y ser interrogado sobre los Sodan.', TRUE, TRUE),
(126, @SINRAZA, @SOLDADO, 'K\'Tano',         100, '1000', '1000', '100', '1200', 'Antiguo primado de Imhotep que deserto de sus filas y se unio a la Rebelión Jaffa, arrastrando muchos mundos Jaffa con él. Un experto tanto en combate, donde es uno de los mejores guerreros, como en la diplomacia. Es considerado todo un líder de los Jaffas.', FALSE, TRUE),
(333, @SINRAZA, @SOLDADO, 'Ray\'ac',         100,  '100',  '300',  '25', '1200', 'Hijo de Teal\'c. Aprendio de su padre la destreza en combate de los guerreros Jaffa. Aun asi, estuvo mucho tiempo alejado de él cuando deserto de Apophis y se unió al Comando Stargate de los Tau\'ri. Desde muy joven ya demostro una gran habilidad en el manejo de naves de combate, consiguiendo posteriormente varias victorias para la rebelion.', FALSE, FALSE),
(128, @SINRAZA, @SOLDADO, 'Maestro Teal\'c', 100, '1500', '1300', '200', '1200', 'Como antiguo primado de los Goa\'uld y uno de los Líderes de la rebelión, Tea\'lc goza de una fama bien fundada en el seno Jaffa. Un héroe para las nuevas generaciones que habitan el reconstruido templo de Dakara. Teal\'c es un experto guerrero en todas las facetas y un hombre muy leal a sus principios.', FALSE, TRUE),

(329, @SINRAZA, @NAVE, 'Escuadrón de K\'tano', 150, '6000', '5000', '3000', '1080', 'Sequito de naves nodriza que están bajo las órdenes del antiguo primado de Imhotep, K\'tano. Son leales a la rebelión y muy bien jerarquizadas en distintas tareas, coordinadas por la nave insignia de K\'tano.', TRUE, TRUE),

########################################################
# Atlantis..............................................
########################################################
### Tropas
(142, @ATLANTIS, @SOLDADO, 'Comando Exploración',   1,   '20',   '25',   '0',  '120', 'Los comandos de exploración de Atlantis son grupos reducidos de soldados encargados de la exploración de mundos alienígenas en busca de nuevos recursos o asentamientos viables. Están preparados para entrar en combate pero su misión principal es el reconocimiento a través del Stargate.', FALSE, FALSE),
(143, @ATLANTIS, @SOLDADO, 'Zapadores',                  2,   '10',   '40',   '0',  '900', 'Los ingenieros de la base Atlantis son grupos de científicos y soldados de entre cuatro y ocho personas especializados en diversos campos de la ciencia, son de utilidad para conocer al detalle los nuevos planetas descubiertos y sus recursos naturales.', FALSE, FALSE),
(144, @ATLANTIS, @SOLDADO, 'Comando Atlantis',           6,   '66',   '80',   '0',  '928', 'Grupos de élite formados por cuatro hombres especializados en diferentes campos y que son capaces de enfrentarse a cualquier misión en planetas alienígenas. Son expertos en misiones de reconocimiento, transporte y combate contra el enemigo.', FALSE, FALSE),
(146, @ATLANTIS, @SOLDADO, 'Marine',                    16,  '150',  '272',  '77', '3130', 'Hombres condecorados por el Cuerpo de Marines con mucha experiencia en combate. Diestros en el manejo de armas y estrategias de guerra, dan apoyo al resto de tropas con su gran líderazgo en batalla.', FALSE, FALSE),
(150, @ATLANTIS, @SOLDADO, 'Dra. Jennifer Keller',     200,    '0',  '578', '163',  '900', 'Jefa médica de la expedición Atlantis y mano derecha de Beckett. Retoma el trabajo de Beckett, lo que incluye su terapia genética y su estudio sobre el insecto iratus, lo que la permite saber y conocer mucho más que éste al respecto. Su conocimiento permitirá en varias ocasiones ayudar a la base en momentos de crisis.', FALSE, FALSE),
(155, @ATLANTIS, @SOLDADO, 'Dr. Rodney McKay',         200,   '40',  '827', '234',  '900', 'Líder científico de la Base Atlantis. Es doctor en Astrofísica. Trabajo varios años entre el Área 51 y el Pentágono dónde aprendió todo lo necesario sobre el Stargate. También colaboró en varias ocasiones en el Comando Stargate. Tras algún tiempo en Rusia estudiando el segundo Stargate, fue destinado a la base de McMurdo, y de ahí paso a ser el líder científico que fue mandado a la base Atlantis. Su inteligencia ha sacado de apuros a la base en varias ocasiones, y sus investigaciones de nanotecnología son únicas. De nacionalidad canadiense, es una mente brillante, aunque es pesimista, bastante cínico, alérgico a los cítricos y bastante hipocondríaco.', FALSE, FALSE),
(158, @ATLANTIS, @SOLDADO, 'Ronon Dex',                200, '1500',  '997', '282',  '900', 'Antiguo militar del planeta Sateda, que fue arrasado por los Wraith. Ronon perdió todo lo que tenía cuando fue capturado por los Wraith y convertido en corredor, personas que son perseguidas indiscriminadamente por los Wraith por toda la galaxia a modo de deporte. Fue encontrado por los miembros de la Base Atlantis y liberado del calvario. Desde entonces es miembro activo de la base, siendo clave en incursiones militares debido a su extraordinaria preparación. De carácter reservado, Ronon es un guerrero nato. Domina casi cualquier modalidad de lucha cuerpo a cuerpo y es uno de los mejores tiradores de la base. Valora mucho el honor y la lealtad.', FALSE, TRUE),
(159, @ATLANTIS, @SOLDADO, 'Coronel John Sheppard',    200, '1100',  '793', '224',  '900', 'Líder militar de la Base Atlantis en la Galaxia Pegasus. Cuando fue reclutado, era piloto de las Fuerzas Aéreas en la base de McMurdo, donde llevaba destinado once meses. Adora volar y es capaz de hacerlo en cualquier tipo de máquina aérea, desde helicópteros Black Hawk hasta aviones Sea Harrier, y sobre todo cazas espaciales 302 y Jumper, ya que posee el gen para manejar artefactos lantianos. Su sentido del humor le hace ser una persona positiva y un perfecto líder y caballero. Además de su habilidad a los mandos de aeronaves, también es un gran luchador cuerpo a cuerpo y con armas de fuego. También es muy útil en estrategia militar.', FALSE, TRUE),

### Naves
(165, @ATLANTIS, @NAVE, 'F-302',         7,  '230',   '350',    '0', '1380', 'Caza estándar de las flotas Atlantis y el primero diseñado exclusivamente por ellos. Va armado con misiles de cabeza de naquadah y cañones raíl. A pesar de contar con un propulsor hiperespacial los viajes por el hiperespacio no son muy seguros por lo que viaja a bordo de naves más grandes.', FALSE, FALSE),
(166, @ATLANTIS, @NAVE, 'Jumper',       18,  '550',   '765',    '0', '3600', 'Pequeñas naves construidas por los Antiguos. Van armadas con drones y escudos, que tienen la capacidad de hacer invisible la nave. Además pueden contraer sus alas para pasar a través del Stargate.', TRUE, FALSE),
(167, @ATLANTIS, @NAVE, 'BC304',       148, '1865',  '5644', '1594', '7380', 'Nave definitiva de combate de los Atlantis. La clase Dedalo es la mejora de la X-303, armada con cañones raíl y cabezas de naquadah combinadas con el teletransporte asgard. Tiene capacidad para viajar por el hiperespacio y llevar cazas en su interior.', FALSE, FALSE),
(168, @ATLANTIS, @NAVE, 'Aurora',      193, '6120', '10993', '3104', '9635', 'Naves de guerra de los Antiguos, usadas en la guerra contra los Wraith y los replicantes de Pegasus. Armadas con drones, que son disparados desde la Silla de Mando y protegidas por escudos lantianos. Es una de las naves mas potentes de la galaxia y pueden viajar por el hiperespacio, llevando cazas en su interior.', FALSE, FALSE),
(169, @ATLANTIS, @NAVE, 'Dédalo', 300, '3500',  '8387', '2368',  '900', 'Nave hermana del Odisea que fue creada con el objetivo de mandarla a luchar a la galaxia Pegaso, para defender a Atlantis de la invasión Wraith. Incorpora un Módulo de Punto Cero que la hace más resistente y más poderosa que cualquier otra nave construida en la Tierra.', FALSE, TRUE),
(171, @ATLANTIS, @NAVE, 'Orión',  300, '7000', '12693', '3584',  '900', 'El Crucero de Batalla Orión es la nave de clase Aurora más avanzada pilotada por la expedición Atlantis. Fue construida por los Antiguos para luchar en la guerra contra los Wraith. Al igual que el Dédalo, la Orión incorpora varios Módulos de Punto Cero en sus sistemas lo que la convierte en una nave perfectamente construida para la guerra.', FALSE, TRUE),

### Defensa
(160, @ATLANTIS, @DEFENSA, 'Escudo Protector',          10625,    '0', '160367',  '45280', '85000', 'Diseñado por los Antiguos para defender sus Stargates de las incursiones Wraith por tierra. Se basa en la tecnología lantiana de escudos y consume una gran cantidad de energía de los MPC.', FALSE, FALSE),
(161, @ATLANTIS, @DEFENSA, 'Comando de Defensa',           11,  '300',    '521',    '147',  '1210', 'Comando de soldados especializados en defensa, bien armados, con buenas estrategias defensivas y buena cobertura, preparados para repeler cualquier incursión enemiga por tierra.', FALSE, FALSE),
(162, @ATLANTIS, @DEFENSA, 'Cañón Raíl',    22,  '750',    '657',    '186',  '1760', 'Potentes cañones creados en principio para montarse como armamento en las naves de clase Dédalo, luego fueron adaptados como defensas antiaéreas para la primera incursión Wraith a Atlantis. Son efectivos contra naves enemigas ligeras.', FALSE, FALSE),
(164, @ATLANTIS, @DEFENSA, 'Satélite Antiguo',       360, '8000',  '22667',   '6400', '10800', 'Estaciones espaciales defensivas que son la pieza más destacada de la tecnología defensiva de los Antiguos. Capaz de destruir naves nodrizas con muy pocos disparos, aunque con un enorme consumo energético.', FALSE, FALSE),

### Especiales
#Raza
(287, @SINRAZA, @SOLDADO, 'Morgana Le Fay', 0,  '2000',   '8000',  '5000', '0', 'Ser ascendido que oculto el Sangreal por diferentes planetas con pruebas. Una gran luchadora, Morgana se siente en conflicto con sus hermanos ascendidos por estar en contra de la norma de no intervancion en los planso inferiores de existencia. En la cultura popular, Morgana ha sido desde siempre una de las hechiceras más famosas y poderosas de la literatura occidental; siendo para muchos la clara personificación del mal, el odio y la venganza, así como la belleza ardiente, el deseo, la tentación y, por encima de todo, la pasión.', TRUE, TRUE),
(335, @SINRAZA, @NAVE,    'Atlantis',       0, '10000', '115000', '50000', '0', 'Atlantis es una Ciudad Nave Antigua y esta basada en el mito griego de la Ciudad Perdida de la Atlantida. La medida defensiva primaria de Atlantis es un escudo que lo abarca todo. Aunque este escudo es inestimable y puede detener casi cualquier amenaza eficazmente, requiere tanta energía que debe instalarse un MPC para activarlo. La medida ofensiva primaria de la ciudad es un gran numero de Armas de Drones.', FALSE, TRUE),
#Planetas
(354, @SINRAZA, @NAVE, 'Clase Excalibur', 0, '6500', '10000', '2900', '900', 'Una de las principales aplicaciones del legado Asgard y Antiguo de los Tau\'ri fue la ingeniería aeroespacial. Aunque el proyecto quedo parado un tiempo debido al ataque Wraith al Area 51, la BC305 (bautizada como "Excalibur"), fue lanzada con éxito al espacio y probada en batallas interestelares.', FALSE, TRUE),


### Planetas
(147, @SINRAZA, @SOLDADO, 'Dra. Jeannie Miller',        100,   '10',  '600', '100', '1200', 'Hermana del Dr. Rodney Mckay. Experta en ciencia espacial, abandono la carrera cientifica para dedicarse a su familia. Eventualemnte trabaja con su hermano en la expedicion Atlantis en trabajos sobre la nanotecnologia y la investigacion para la sustraccion de energia del subespacio.', FALSE, FALSE),
(148, @SINRAZA, @SOLDADO, 'Dr. Carson Beckett',         100,    '0', '1000', '200', '1200', 'Jefe médico de la expedición Tau\'ri en la base Atlantis. Sus conocimientos de la medicina son excelsos, llegando a purificar la droga Hoffana que ataca a los Wraith y descubriendo con exito los cambios en el genoma Wraith. Se le considera el inventor del retrovirus, que invierta las cualidades de los Wraith, volviendolos humanos. De nacionalidad escocesa, gran sentido del humor y un hombre de ciencia, posee el gen lantiano para manejar aparatos antiguos.', FALSE, FALSE),
(149, @SINRAZA, @SOLDADO, 'Clon de Dr. Carson Beckett', 100,   '30',  '700', '100', '1200', 'Clon creado por Michael del jefe médico de la expedición Tau\'ri en la base Atlantis. Sus conocimientos de la medicina son excelsos, llegando a purificar la droga Hoffana que ataca a los Wraith y descubriendo con exito los cambios en el genoma Wraith. Se le considera el inventor del retrovirus, que invierta las cualidades de los Wraith, volviendolos humanos. De nacionalidad escocesa, gran sentido del humor y un hombre de ciencia, posee el gen lantiano para manejar aparatos antiguos al igual que el original.', FALSE, FALSE),
(152, @SINRAZA, @SOLDADO, 'Teniente Aiden Ford',        100,  '600',  '600', '150', '1200', 'En un joven pero fornido militar con bastante experiencia a pesar de su edad. Con tal sólo veinticinco años se puso a las órdenes del coronel Sumner y del mayor Sheppard en la misión que les llevó al otro lado del Stargate. Es valiente y decidido, ademas de ser un buen luchador, conocedor de llaves de yudo, que ha usado en alguna ocasión para defenderse.', FALSE, TRUE),
(153, @SINRAZA, @SOLDADO, 'Aiden Ford',                 100,  '900', '1000', '100', '1200', 'Tras ser rescatado del mar cuando un Wraith trató de alimentarse de él, los medicos descubrieron que su cuerpo contenia gran cantidad de la encima que los Wraith usan para que el cuerpo humano aguante el proceso de alimentación. Su rostro en el lado izquierdo queda desfigurado, y su ojo izquierdo ha quedado con una película negra. Tras ser rechazado, huye de Atlantis y lídera un comando para atacar Wraiths y robarles su encima, que les vuelve mucho mas agiles y fuertes.', FALSE, TRUE),
(154, @SINRAZA, @SOLDADO, 'Dr. Radek Zelenka',          100,    '0',  '500', '100', '1200', 'Miembro de la expedicion original a la Galaxia Pegasus como segundo cientifico al mando de la expedicion Atlantis. Natural de la República Checa, Zelenka es un cientifico e ingeniero, experto en mecanismos y artefactos lantianos, especialmente en el sistema de los Jumpers. Se pasa el día ayudando a Mckay en sus trabajos y coordinando grupos de investigación.', FALSE, FALSE),
(156, @SINRAZA, @SOLDADO, 'Mayor Evan Lorne',           100,  '700',  '900', '100', '1200', 'Antiguo miembro del SGC en el SG-11 al mando del coronel Edwards, será trasladado a Atlantis donde se le da el mando de su propio equipo. El mayor se consolidará como segundo al mando tras el teniente coronel Sheppard. De caracter afable y siempre en primera linea de fuego, es un veterano en los viajes por el Stargate.', FALSE, TRUE),
(157, @SINRAZA, @SOLDADO, 'Teyla Emmagan',              100, '1100', '1000', '100', '1200', 'Líder del peublo athosiano y nativa del planeta Athos. Su planeta fue atacado por los Wraith y ella estuvo junto a su familia en el intento de resistencia. Por desgracia, los Wraith ganaron y ella perdió a su toda su familia más cercana. Posteriormente, refugio a su pueblo en la Ciudad de Atlantis, siendo acogida por los Tau\'ri y formando parte del comando de exploracion del Coronel John Sheppard. Esta altamente adiestrada en combate cuerp a cuerpo.', FALSE, TRUE),
(277, @SINRAZA, @SOLDADO, 'Larrin',                     100,  '200',  '400', '100', '1200', 'Líder de los Travelers, vagabundos espaciales que vagan por la galaxia en naves que usan como viviendas. Raptó al Coronel Sheppard para que les enseñase a pilotar una nave de clase Aurora que habian encontrado. Su líderazgo y determinacion la han llevado hasta la cupula de la sociedad viajera.', FALSE, TRUE),
(311, @SINRAZA, @SOLDADO, 'Dra. Elisabeth Weir',        100,    '0',  '400', '100', '1200', 'Doctora en relaciones diplomaticas. Tras su breve estancia en el Comando Stargate sustituyendo como civil al general Hammond dadas sus dotes de negociadora para el gobierno ante conflictos internacionales, Weir es trasladada a la base Atlantis como líder de la misma. Comenzó como diplomática y trabajó para el gobierno en negociaciones con países en conflicto o con terroristas. Es crítica con el ejército, pero ante la posibilidad que la dan al conocer el Comando Stargate, no duda en unirse a ellos aunque sea a su medida. Posee un doctorado en política internacional en la Universidad de Georgetown además de hablar cinco lenguas distintas. Aprenderá el lenguaje de Los Antiguos durante la estancia en su nuevo hogar. Dejó todo, incluida su pareja sentimental: Simon, por partir hacia lo desconocido.', FALSE, FALSE),
(312, @SINRAZA, @SOLDADO, 'Richard Woolsey',            100,    '0',  '300', '100', '1200', 'El señor Woosley se encargó durante mucho tiempo en la Tierra de ser el encargado supervisor civil del Proyecto Stargate informando al Presidente y tratando de dar una visión objetiva en las misiones a través del Stargate. Es enviado a Atlantis cuando pasa un año de la estancia de Samantha Carter como sustituta de la doctora Weir en la base de Pegasus. Aunque es acogido de inmediato por el grupo de la base, no se siente del todo ubicado dado que es una persona que respeta por encima de todo las normas, tanto civiles como militares, algo que en la base Atlantis muchas veces puede ser un problema. Se deja guiar en todo momento por la visión del coronel Sheppard esperando aprender a cómo ser un líder.', FALSE, FALSE),
(325, @SINRAZA, @SOLDADO, 'Coronel Samantha Carter',    100,  '500', '1400', '300', '1200', 'Líder científico-militar de la Base Atlantis. Sirvió en el Pentágono, estudiando desde allí durante dos años la tecnología del Stargate y convirtiéndose en una experta. Fue previamente oficial de vuelo en Kuwait y posee un nivel tres en Combate cuerpo a cuerpo. Es uno de los mayores genios de la astrofísica en toda la Tierra ya que tiene un doctorado en Mecánica Cuántica y su reacción ante situaciones criticas es magnifica. Optimista y luchadora, cuando se disolvio el SG-1, tomo el mando de la base Atlantis como Líder militar.', FALSE, TRUE),
(349, @SINRAZA, @SOLDADO, 'F.R.A.N',                    100,  '500',  '700', '300', '1200', 'El Friendly Replicator ANdroid o simplemente FRAN, es un replicante humanoide creado por el Dr. Mckay como un medio para crear un iman para las particulas replicantes. Al tener consciencia programada, nunca se a opuesto a su misión.', FALSE, FALSE),
(388, @SINRAZA, @SOLDADO, 'Kanaan',                     100,  '900', '1000', '100', '1200', 'Kanaan es uno de los líderes del pueblo Athosiano, amante de Teyla Emmagan y padre de su hijo Torren John Emmagan. Desde la infancia, Kanaan había notado que fue uno de los pocos miembros de su pueblo que poseía habilidades mentales Wraith. Kanaan es el líder natural de su pueblo, pues posee habilidades para el mando y el gobierno.', FALSE, TRUE),
(430, @SINRAZA, @SOLDADO, 'Dr. Rodney Mckay Alternativo',     100,   '40',  '800', '250', '1200', 'Líder científico de la Base Atlantis. Es doctor en Astrofísica. Trabajo varios años entre el Área 51 y el Pentágono dónde aprendió todo lo necesario sobre el Stargate. También colaboró en varias ocasiones en el Comando Stargate. Tras algún tiempo en Rusia estudiando el segundo Stargate, fue destinado a la base de McMurdo, y de ahí paso a ser el líder científico que fue mandado a la base Atlantis. Su inteligencia ha sacado de apuros a la base en varias ocasiones, y sus investigaciones de nanotecnología son únicas. De nacionalidad canadiense, es una mente brillante, aunque es pesimista, bastante cínico, alérgico a los cítricos y bastante hipocondríaco.', FALSE, FALSE),

(170, @SINRAZA, @NAVE, 'Apollo', 150, '4000', '8000', '3000', '900', 'Nave hermana del Dédalo que tambien fue destinada a la galaxia Pegaso, para defender a Atlantisde los ataques de los Asuranos. Incorpora un Modulo de Punto Cero que la hace mas resistente y mas poderosa que cualquier otra nave construida en la Tierra y armas de rayos asgard.', FALSE, TRUE),

########################################################
# Wraith................................................
########################################################
### Tropas
(172, @WRAITH, @SOLDADO, 'Sonda Escáner', 1,   '0',    '20', '0',  '120', 'Sondas automatizadas para la exploración de planetas en busca de humanos, no tienen capacidad para entrar en combate por lo que pueden ser destruidas fácilmente, pero permiten un reconocimiento sin arriesgar tropas.', FALSE, FALSE),
(173, @WRAITH, @SOLDADO, 'Guerreros Wraith',   2,  '50',    '60', '0',  '900', 'Tropa estándar de los Wraith, protegidos por armaduras y armados con paralizadores. Son más fuertes y musculosos que los Wraith oficiales pero apenas tienen poder telepático y no tienen desarrollada la voz. Su principal misión suele ser la caza de humanos, pero pueden dedicarse a otras incursiones tanto de ataque como de defensa.', FALSE, FALSE),
(174, @WRAITH, @SOLDADO, 'Oficial Wraith',    15,  '150',  '380', '0', '3030', 'La élite de los guerreros Wraith. Son machos Wraith totalmente inteligentes y con aptitudes militares y científicas. Poseen un poder telepático muy potente para comunicarse a kilómetros de distancia. Con mucha experiencia en combate y rastreo, suelen liderar a sus hermanos guerreros menos inteligentes y conocen todas las estrategias de combate necesarias para la caza de humanos.', FALSE, FALSE),
(176, @WRAITH, @SOLDADO, 'Cazador Bob',      200,  '900',  '930', '0',  '900', 'Guerreros de élite Wraith, que actúan como oficiales para tropas menos importantes. Han sido entrenados dando caza a corredores a los que persiguen a lo largo y ancho de la galaxia. Mejora la moral y el entrenamiento de tropas bajo su mando, pues suelen ser Wraiths muy famosos dentro de la comunidad espectro.', FALSE, TRUE),
(178, @WRAITH, @SOLDADO, 'Guardiana',        200,  '200', '1126', '0',  '900', 'Wraith hembra que posteriormente será una reina. Los Wraith tienen periodos de hibernación cuando escasea la comida, en los cuales permanecen aislados y protegidos por una Guardiana y un reducido grupo de tropas. La guardiana actúa como oficial para las tropas protectoras, manteniendo a salvo a sus hermanos bajo hibernación.', FALSE, FALSE),
(181, @WRAITH, @SOLDADO, 'Rey',              200,  '500', '1352', '0',  '900', 'Máximo líder Wraith. Cada rey o reina Wraith posee al menos una nave colmena y un territorio bajo su regencia. Suelen ser los oficiales de mayor rango dentro de su facción. Mejora la moral y velocidad de entrenamiento de tropas.', FALSE, TRUE),
(183, @WRAITH, @SOLDADO, 'Todd',             200, '1200', '1524', '0',  '900', 'Comandante y Líder de una de las facciones Wraith enfrentadas conocida como "La Alianza". Fue secuestrado por los Genii durante algunos años y se le dio por muerto entre los Líderes Wraith. Posteriormente, el coronel John Sheppard seria apresado con él. Juntos lograron escapar de la cárcel Genii a pesar de sus diferencias. Todd forjó diversas alianzas con los Tau\'ri de Atlantis para derrotar a las facciones Wraith y a los replicantes alteranos siempre buscando su propio beneficio y el de su colmena.', FALSE, TRUE),

### Naves
(187, @WRAITH, @NAVE, 'Dardo',                3,  '170',   '260', '0',  '256', 'Cazas estándar de los Wraith, empleadas para las cosechas de humanos. Su diseño les permite viajar a través del Stargate y atrapar humanos con sus teletransportadores. Está preparada para entrar en combate pero carece de escudos.', FALSE, FALSE),
(188, @WRAITH, @NAVE, 'Explorador',           3,  '200',   '280', '0',  '264', 'Pequeñas naves de transporte dedicadas a la exploración de planetas en busca de cosechas de humanos. Está armado aunque su principal utilidad es escapar furtivamente de enclaves asediados.', FALSE, FALSE),
(189, @WRAITH, @NAVE, 'Crucero Wraith',      27, '1125',  '3000', '0', '5480', 'Nave de guerra Wraith, preparada para el combate directo y con gran poder de ataque. Sirven como escolta para las enormes Nave Colmena y como apoyo para naves más pequeñas.', FALSE, FALSE),
(190, @WRAITH, @NAVE, 'Nave Colmena',        61, '2115',  '7000', '0', '3055', 'Enormes naves nodriza de los Wraith, preparadas para causar estragos en cualquier planeta humano que visiten. Combinación de tecnología y material orgánico, en ellas viven cientos de Wraith dispuestos a alimentarse. Gran poder de ataque contra todo tipo de naves enemigas.', FALSE, FALSE),
(191, @WRAITH, @NAVE, 'Colmena Comandante', 300, '5500', '20000', '0',  '900', 'Nave de apoyo comandada por el líder militar Wraith de la facción, experto en tácticas y estrategias de combate espacial. Básica en los ataques e incursiones a otros mundos para garantizar el éxito de las misiones de las naves Wraith.', FALSE, TRUE),
(192, @WRAITH, @NAVE, 'Colmena Reina',      300, '7000', '20000', '0',  '900', 'Nave insignia de la flota Wraith, hogar de la reina líder de la facción. Desde ella se dirigen todas las cosechas sobre mundos humanos. Tiene una capacidad de fuego y una resistencia mayor al resto de naves colmena de la flota. Mejora las características del resto de naves.', FALSE, TRUE),
(194, @WRAITH, @NAVE, 'Colmena de Todd',    300, '8000', '25000', '0',  '900', 'Nave colmena insignia de Todd. La destrucción de su primera colmena Líder sobre Atlantis hizo que el séquito del Wraith perdiera a su reina, lo que hizo que perdiera también fuerza en "la Alianza". Aún así, Todd no duda en usar su astucia para potenciar sólo a su nueva colmena, que cuenta con una velocidad, escudos y potencia de fuego superior debido al conocimiento adquirido en su estancia en Atlantis.', FALSE, TRUE),

### Defensas
(184, @WRAITH, @DEFENSA, 'Campo Deflector', 10625,   '0', '2500', '140000', '85000', 'Usado por los Wraith como defensa del stargate, es una barrera de energía sónica que impide el paso de las tropas enemigas a través de la puerta. A pesar de que los Wraith son muy poco territoriales, suelen usarlos para proteger enclaves importantes. Tiene una alta integridad pero un coste muy elevado en energía.', FALSE, FALSE),
(185, @WRAITH, @DEFENSA, 'Insecto Iratus',      1, '150',   '50',      '0',   '300', 'Los insectos Iratus son los antepasados lejanos de los Wraith. Son unos enormes insectos capaces de adherirse a otros seres vivos y absorberles su vitalidad, haciéndolos envejecer hasta matarlos. Los Wraith los crían como defensas de sus planetas, ya que quien es infectado por uno, raramente logra sobrevivir.', FALSE, TRUE),

### Especiales
#Raza
(410, @SINRAZA, @SOLDADO, 'Wraith Sobrealimentado', 0, '3000',  '11000', FALSE, FALSE, '.', FALSE, TRUE),
(338, @SINRAZA, @NAVE,    'Super Colmena',          0, '8000', '200000', FALSE, FALSE, 'Enorme nave colmena que se alimenta de varios MPC ideada por Todd y su grupo de científicos. Su poder ofensivo es casi incomparable, asi como su velocidad y su integridad. Es casi imposible de destruir. ', FALSE, TRUE),

### Planetas
(177, @SINRAZA, @SOLDADO, 'Tyre',                     100, '1000', '1500', '10', '1200', 'Guerrero y Líder militar del ejercito de Sateda. Cuando esta fue arrasada, Tyre se convirtio en un fugitivo que sobrevivia siendo nomada de planeta en planeta. Despues se gano fama como cazarrecompensas y dominado por los Wraith, a los que sirve. A cambio, estos le proporcionan el don de la vida.', FALSE, TRUE),
(182, @SINRAZA, @SOLDADO, 'Michael',                  100,  '500', '3000',  '0', '1200', 'Oficial cientifico Wraith que fue tratado con el retrovirus del Dr. Beckett y que se convirtio en humano. Al descubrir la verdad, volveria a su forma Wraith, aunque nunca completamente, lo que le causara la marginacion de la sociedad Wraith. Tras esto, se exiliaria, buscando la forma de crear un ejercito de hibridos que combinarian la fuerza de los Wraith y la nutricion humana.', FALSE, TRUE),
(323, @SINRAZA, @SOLDADO, 'Steve',                    100,  '600',  '300',  '0', '1200', 'Comandante en jefe de una de las mas poderosas facciones Wraith. Tras descubrir el asentamiento Tau\'ri en Atlantis, su faccion se propuso derrocar a los humanos y tomar el control de la Ciudad Nave. Su intento fracaso cuando fue derrotado por Teyla y hecho prisionero de los Atlantis, que lo usaron como sujeto experimental para probar la droga Hoffana anti-Wraith.', FALSE, TRUE),
(324, @SINRAZA, @SOLDADO, 'Comandante de La Primera', 100, '1000',  '800',  '0', '1200', 'Uno de los mas admirados y mortiferos Wraith en el campo de batalla. Fue asignado como comandante de "La Primera", la nave mas antigua y poderosa de la faccion conocida como "La Alianza".', FALSE, TRUE),
(326, @SINRAZA, @SOLDADO, 'James',                    100,  '300',  '900',  '0', '1200', 'Científico Wraith, que junto a otros espectros, pacto un trato con los Atlantis para luchar contra una faccion enemiga. Sus conocimientos cientificos fueron usados para idear un sistema para teletransportar una bomba a la nave colmena mas poderosa y asi dar un golpe estrategico.', FALSE, TRUE),
(327, @SINRAZA, @SOLDADO, 'Reina Mayor',              100,  '700', '1000',  '0', '1200', 'Reina de la facción enemiga de "La Alianza". Ideo un plan para pactar con los Atlantis y asi poder utilizar su sistema de teletransporte para destruir naves colmena. Posteriormente, los traiciono para encontrar la Tierra.', FALSE, TRUE),
(331, @SINRAZA, @SOLDADO, 'Kenny',                    100,  '700', '700',   '0', '1200', 'Segundo al mando de Todd. Se unió a este tras la batalla contra los replicantes. Es un Wraith leal y dispuesto a tomar el mando de la colmena si es necesario.', FALSE, TRUE),
(345, @SINRAZA, @SOLDADO, 'Brian',                    100, '1000', '1000',  '0', '1200', 'En un universo pararlelo al nuestro, los Wraith asediaron la Tierra con un bastión de naves colmena. Durante la misma y tras perder su nave, uno de los comandantes se estrelló con un dardo en el desierto de Nevada cuando intentaba destruir el área 51. Para sobrevivir en el planeta sin ser descubierto, se disfrazó de humano. Su plan era usar su poder telepatico para ganar dinero facil en lso casinos de Las Vegas y asi poder financiarse los componentes necesarios para crear un dispositivo que mandase las coordenadas de la Tierra a algún universo pararlelo al suyo.', FALSE, TRUE),
(387, @SINRAZA, @SOLDADO, 'El Exiliado',              100,  '700', '2000',  '0', '1200', 'Durante una batalla en la orbita de un hinospito planeta, una nave crucero wraith fue derribada por un satelite lantiano que defendia el enclave. El oficial al mando de la nave consiguio sobrevivir al impacto y sobrevivio muchos años en la superficie del planeta.', FALSE, TRUE),
(193, @SINRAZA, @NAVE, 'Colmena de Michael', 150, '6000', '30000', '0', '900', 'Nave colmena principal de la faccion rebelde de Michael. Cuando éste fue rechazado por las facciones Wraith, decidio vengarse creando una ejército de hibridos Wraith-humano para derrotarlas y dominar la Galaxia Pegasus. Su estancia entre los Atlantis durante su breve periodo de conversión y su habilidad como cientifico militar, le han permitid añadir una serie de mejoras a sus naves colmena.', FALSE, TRUE),
(195, @SINRAZA, @NAVE, 'La Primera',         150, '9000', '50000', '0', '900', 'Nave colmena Líder de la faccion "La Alianza". Muy pocos han conseguido tratar cara a cara con su reina. Es una la nave colmena Wraith mas antigua y de las mas poderosas de la galaxia Pegasus. Quien controle a "La primera", controlara todas las naves de la faccion espectro que Lídera.', FALSE, TRUE),

########################################################
# Replicantes...........................................
########################################################
### Tropas
(196, @REPLICANTES, @SOLDADO, 'Replicante',             1,    '5',   '10',   '0',   '80', 'Creados originalmente como juguetes por la androide Reese, compuestos por cientos de bloques individuales de diversos materiales, comenzaron a replicarse para sobrevivir en ambientes hostiles. Son capaces de disolver diversos materiales y usarlos para crear nuevas piezas con las que replicarse, además han demostrado ser capaces de plagar tecnologías de otras razas.', FALSE, FALSE),
(197, @REPLICANTES, @SOLDADO, 'Replicante avanzado',    4,   '40',   '60',   '0',  '400', 'Mas avanzado que el replicante original, este replicante ha usado la tecnología asgard para hacerse, con la base de un replicante, una perfecta arma de combate que pueda atacar tanto en tierra como en aire.', FALSE, FALSE),
(198, @REPLICANTES, @SOLDADO, 'Replicante Humanoide',  40,  '300',  '861', '243', '8370', 'En su intento por destruir a los replicantes con un dilatador de tiempo, los Asgard crearon por accidente a los replicantes humanoides que son la evolución natural de los replicantes tras miles de años. Cada bloque tiene el tamaño de una célula biológica, consiguiendo un aspecto humano. Necesitan neutronio para ser creados pero son prácticamente indestructibles.', FALSE, FALSE),
(199, @REPLICANTES, @SOLDADO, 'Replicante madre',     200,  '200',  '793', '224',  '900', 'Tipo de replicante especial que se encarga de fabricar y mejorar a los replicantes para asegurar la supremacía de los ejércitos de los replicantes en la galaxia. Esta unidad mejora fundamentalmente la construcción de los replicantes.', FALSE, FALSE),
(202, @REPLICANTES, @SOLDADO, 'Reese',                200,  '100', '1020', '288',  '900', 'Androide humanoide que es la que da origen a los replicantes. No tiene la capacidad de replicarse pero tiene el poder de convertir cualquier cosa sólida en piezas para fabricar nuevos replicantes que hagan la voluntad de su creador. Esta unidad aumenta fundamentalmente la investigación de las mejoras replicantes.', FALSE, FALSE),
(203, @REPLICANTES, @SOLDADO, 'Quinto',               200,  '800', '1269', '358',  '900', 'Es el único de los Replicantes que para ellos posee un fallo por ser más humano que los demás. Se trató de corregir el error que poseía Reese y ese intento hizo que se creara a Quinto.', FALSE, TRUE),
(205, @REPLICANTES, @SOLDADO, 'RepliCarter',          200, '1200', '1383', '390',  '900', 'Replicante fabricado por Quinto semejante en cuerpo y mente a la teniente coronel Samantha Carter de los Tau\'ri, para dominar junto a él la galaxia y destruir a todas las razas que se opongan. De amplia astucia y ambición, pronto se desligará de Quinto para amenazar la Galaxia.', FALSE, TRUE),

### Naves
(206, @REPLICANTES, @NAVE, 'Replicante Crucero',   38,  '1600',   '3457',    '976', '2400', 'Millones de piezas replicantes que se han unido formando una nave. Pueden viajar a través del hiperespacio y principalmente atacan a otras naves con proyectiles de replicantes para poder tomar su control y añadirlas a la flota.', FALSE, FALSE),
(207, @REPLICANTES, @NAVE, 'Replicante Nave',      69,  '2500',   '5553',   '1568', '3600', 'Naves formadas por piezas replicantes que tienen una integridad y un ataque superior a los cruceros. Son usados por los replicantes humanoides como transporte a través del hiperespacio y pueden tomar con facilidad otras naves enemigas disparándoles proyectiles de replicantes.', FALSE, FALSE),
(208, @REPLICANTES, @NAVE, 'Nave de Quinto',      400,  '8500',  '11560',   '3264',  '900', 'Nave insignia de la flota replicante, comandada por Quinto, esta nave persigue la destrucción de todo ser vivo en la galaxia. Aumenta el poder de las naves que la acompañan.', FALSE, TRUE),

### Defensas
(357, @REPLICANTES, @DEFENSA, 'Replicante Iris', 5000, '0', '158667', '44800', '67000', 'Barrera compuesta de piezas que recubren el Stargate impidiendo el paso de tropas enemigas y evitando los ataques a través de la puerta estelar. Tiene una integridad muy alta pero un consumo de energía muy elevado.', FALSE, FALSE),

### Especiales
#Raza
(412, @SINRAZA, @SOLDADO, 'Replicante Constrictor',            0, '1500',  '8000', '5000', '0', '.', FALSE, TRUE),
(413, @SINRAZA, @NAVE,    'Estación Espacial Replicante', 0, '8000', '75000',    FALSE, FALSE, '.', FALSE, TRUE),
#Planetas
(201, @SINRAZA, @SOLDADO, 'Exoesqueleto replicante', 50, '275',  '550', '200', '2000', 'Fusión de piezas replicantes que surge cuando copian la estructura del esqueleto humano. La replicacion es extremadamente dolorosa para el anfitrion, que muere en el proceso creado la primera semilla de los replicantes humanoides.', FALSE, FALSE),

### Planetas
(204, @SINRAZA, @SOLDADO, 'Primero', 100, '1100',  '900', '300', '1200', 'Líder de los replicantes humanoides en Halla y el mas antiguo de todos. Su mentalidad es cerrada y estricta con el objetivo replicante. Fue el Replicante que alcanzó la máquina del tiempo Asgard logrando usarla a su favor. Gracias a ello consiguió que su raza evolucionara hasta tener forma humana tras el estudio de su creadora Reese.', FALSE, TRUE),
(320, @SINRAZA, @SOLDADO, 'Segundo', 100,  '900', '1100', '300', '1200', 'Segunda prueba de creacion de replicante androide.', FALSE, TRUE),
(321, @SINRAZA, @SOLDADO, 'Tercero', 100, '1300',  '800', '300', '1200', 'Tercera prueba de creacion de replicante androide.', FALSE, TRUE),
(322, @SINRAZA, @SOLDADO, 'Cuarto',  100, '1000', '1000', '300', '1200', 'Cuarta prueba de creacion de replicante androide.', FALSE, TRUE),

########################################################
# Ori...................................................
########################################################
### Tropas
(209, @ORI, @SOLDADO, 'Prior',             1,    '5',   '10',    '0',  '120', 'Sacerdotes dedicados a difundir la palabra de Origen por toda la galaxia, enseñan a los pueblos la doctrina del libro de Origen y reclutan nuevos fieles a la causa de los Ori.', FALSE, FALSE),
(210, @ORI, @SOLDADO, 'Guerreros Ori',     5,   '35',   '65',    '0',  '856', 'Soldados de choque de los Ori, creyentes y fieles devotos del libro del origen, reclutados por los priores a lo largo y ancho de la galaxia, darían su vida por defender su fe en los Ori.', FALSE, FALSE),
(211, @ORI, @SOLDADO, 'Prior Avanzado',   17,  '180',  '408',  '115', '3320', 'Representantes humanos de los Ori en este plano de existencia, su principal misión es comandar los ejércitos Ori y al igual que el resto de priores difundir la palabra de Origen. Son humanos modificados genéticamente, con grandes poderes.', FALSE, FALSE),
(214, @ORI, @SOLDADO, 'Tomin',           200,  '500',  '601',  '170',  '900', 'Natural de Ver Isca, Tomin era un aldeano que quedo lisiado desde pequeño. Por su devocion a los Ori, fue curado de su malformacion por un Prior, motivo que lo impulson a unirse a la cruzada Ori en la Vía Lactea. Consiguio muchas victorias en la guerra, hecho que le hizo convertirse en comandante de una de las faciones del ejercito Ori.', FALSE, TRUE),
(328, @ORI, @SOLDADO, 'Prior Invocador', 200,  '400', '1745',  '493', '7200', 'Prior mandado por el Doci a la Vía Lactea con el proposito de crear una cabeza de playa. Creo un campo de fuerza que rodeo todo un planeta y que se alimentaba de las armas de las naves. Asi, se pudieron enviar las piezas del SuperStargate desde la galaxia Ori para poder crear el portal.', FALSE, FALSE),
(216, @ORI, @SOLDADO, 'Orici',           200, '1200', '1677',  '474',  '900', 'Adria, llamada la "Orici", es el agente humano de los Ori creado para Líderar a los Priores y el ejército de los Ori en una campaña para la dominación galáctica. Fue modificada genéticamente para que su fisiología fuera la mas cercana posible a los Antiguos, para que pudiera alojar el conocimiento de los Ori. Este conocimiento le da poderes realmente asombrosos. Mejora la moral y la velocidad de entrenamiento de las tropas.', FALSE, TRUE),
(217, @ORI, @SOLDADO, 'Doci',            200, '2000', '1587',  '448',  '900', 'Literalmente significa "El que ha sido tocado por el poder de los Ori". Reside en la ciudad de Celestis, en sus cámaras personales que están al lado de las Llamas de la Iluminación dónde los Ori gastan la eternidad. Si los Ori desean hablar a los seres inascendidos, lo hacen a través del Doci. Mejora la moral de las tropas.', FALSE, TRUE),

### Naves
(222, @ORI, @NAVE, 'Caza de incursión',   8,   '400',   '584',   '165',  '1620', 'Cazas pesados ori que viajan a bordo de las grandes naves de guerra. Armadas con armas energéticas Ori y defendidas por escudos Ori, tienen una potencia de fuego muy destructora y la maniobrabilidad de un caza.', FALSE, FALSE),
(223, @ORI, @NAVE, 'Nave de Guerra',         309, '15000', '24177',  '6826', '15435', 'Enormes naves capaces de transportar a cientos de guerreros ori en su lucha contra los no creyentes. Armada con potentes armas de energía Ori capaces de destruir cualquier nave de un solo disparo. Además cuenta con escudos ori capaces de aguantar cualquier tipo de fuego enemigo.', FALSE, TRUE),
(225, @ORI, @NAVE, 'Nave insignia',          300, '15000', '23573',  '6656',   '900', 'Nave comandada generalmente por un prior para llevar a la flota Ori al dominio sobre todas las razas que habitan en la Vía Láctea. Esta nave aumenta el poder y la resistencia de las naves que la acompañan a las batallas.', FALSE, TRUE),
(226, @ORI, @NAVE, 'Supernave de Orici',     300, '20000', '31960',  '9024',   '900', 'Nave personal de la Orici, usada para líderar la cruzada contra los infieles de la Vía Lactea. Protegida por todas las demas naves, la presencia de Adria en batalla es temida por sus enemigos. Esta nave aumenta las posibilidades de victoria en batalla debido a su poder descomunal.', FALSE, TRUE),
(332, @ORI, @NAVE, 'Pieza del SuperStargate',  0,     '0',   '453',   '128',   '900', 'Se trata de un chevron gigante fabricado con potentes materiales que unido a otros es capaz de generar una puerta estelar gigante por la que pueden pasar flotas enteras de naves.', FALSE, FALSE),

### Defensas
(219, @ORI, @DEFENSA, 'Escudo de energía', 10625,    '0', '160367',  '45280', '85000', 'Diseñado por los Ori para defender sus stargates de las incursiones enemigas por tierra. Se basa en la tecnología de escudos de los antiguos y consume una gran cantidad de energía.', FALSE, FALSE),
(220, @ORI, @DEFENSA, 'Pelotón de Defensa',   17,  '140',    '186',     '52',  '1815', 'Comando de soldados especializados en defensa, bien armados, con buenas estrategias defensivas y buena cobertura, preparados para repeler cualquier incursión enemiga por tierra.', FALSE, FALSE),
(221, @ORI, @DEFENSA, 'Satélite Ori',        304, '6000',   '8613',   '2432',  '9120', 'Satélite defensivo creado por los Ori para el Protectorado Rand, puede destruir naves de un solo disparo. Dispone de escudos de la tecnología de los Antiguos y pueden defender un planeta de los ataques de naves enemigas.', FALSE, TRUE),
(509, @ORI, @DEFENSA, 'Superstargate',          10000,    '0',  '88967',  '25120',  '7200', 'Puerta estelar de 400 metros de diametro, esta creada para ser atravesada por naves espaciales y ha de ser alimentada con la energía que sólo un agujero negro es capaz de proporcionar.', FALSE, FALSE),

### Especiales
(218, @SINRAZA, @SOLDADO, 'Orici ascendida',        0, '2000',   '8000',   '5000', '0', 'Adria, la Orici, es la enviada de los Ori a al Tierra. Cuando éstos mueren, Adria hurdio un plan para ascender y asi tomar el lugar de todos ellos en el plano de existencia superior. Se puede suponer que, una vez ascendio, Adria logro aunar todo el poder de los Ori en una sóla persona.', TRUE, TRUE),
(416, @SINRAZA, @DEFENSA, 'Cúpula Planetaria', 0,    '0',     '10',     '50', '0', 'La Cúpula Planetaria era un denso escudo que recubre un planeta entero y lo protege de los ataques orbitales enemigos.', FALSE, FALSE),

### Planetas
(212, @SINRAZA, @SOLDADO, 'El Administrador',              100,  '800',  '900',  '200', '1200', 'Los Priores de Ver Eger son Líderados por el Administrador, que es esencialmente un Prior jefe que actúa como enlace directo con el Doci. Sus poderes son superiores a los de los priores comunes ya que encabeza la invasión de los Ori a la Vía Láctea.', FALSE, FALSE),
(313, @SINRAZA, @SOLDADO, 'Líder Prior',              100, '1000',  '900',  '300', '1200', 'En la cruzada de los Ori sobre la Vía Láctea, el Líder prior es enviado a las planetas enemigos para imponer Origen. ', FALSE, TRUE),
(334, @SINRAZA, @SOLDADO, 'Damaris',                       100,  '700', '1000',  '500', '1200', 'Líder prior enviado por los Ori para convertir al pueblo de los Sodan a origen, fué capturado por el SG-1 e interrogado por el general Landry y Orlin.', FALSE, TRUE),
(401, @SINRAZA, @SOLDADO, 'Prior de Ver Eger',             100,  '700', '1000',  '500', '1200', 'El Prior de Ver Eger era un devoto Prior de los Ori. Revivió a Vala Mal Doran después de haber sido quemada viva en el Ara. A continuación, la transportó junto con Daniel Jackson a Celestis para reunirse con el Doci. Después de la reunión con el Doci, volvió a Ver Eger para eliminar a los miembros de la resistencia anti-Ori.', FALSE, FALSE),
(403, @SINRAZA, @SOLDADO, 'Prior de Vía Láctea', 100,  '700', '1000',  '500', '1200', 'El Prior Líder de la Vía Láctea fue el primero en entrar en dicha galaxia para iniciar la cruzada de los Ori. Viajó al planeta P3X-421, donde el Dr. Lindsay estaba ayudando a la gente del lugar. El teniente coronel Cameron Mitchell llegó al planeta a investigar y lo llevgó al Comando Stargate.', FALSE, FALSE),

########################################################
# Sin raza..............................................
########################################################

########################################  Exploradores  ####################################################################################
(228, @SINRAZA, @SOLDADO, 'Reol',   4,  '50',   '50',  '5',  '100', 'Criaturas que pueden tomar el aspecto de otro ser a los ojos de la gente. Su verdadero aspecto casi nunca es descubierto. Son una raza pacifica y exploradora.', TRUE, FALSE),
(434, @SINRAZA, @SOLDADO, 'Ursini', 4,  '75',   '75',  '5',  '100', 'Los Ursini son una especia antropomorfa bípeda. Parecen tener un exoesqueleto, como los insectos, y tienen dedos finos y huesudos. Son una raza de tecnología avanzada que entró en guerra y que, tras caer derrotados, vagan por la galaxia buscando un nuevo hogar.', FALSE, FALSE),
########################################  Recolectores  ####################################################################################
(231, @SINRAZA, @SOLDADO, 'Mastadge',       5,    '8',  '50',  '0',   '500',  'Grandes animales de carga que son domesticados por las comunidades humanas. No estan especialmente dotados para el combate pero son muy utiles en la recoleccion de recursos.', FALSE, FALSE),
(233, @SINRAZA, @SOLDADO, 'Athosianos',     5,   '90',  '50',  '0',   '500',  'Habitantes de Athos, que tuvieron que abandonar su planeta por los ataques de los Wraith. Grandes guerreros en batalla que nunca abandonan a los suyos.', FALSE, FALSE),

(115, @SINRAZA, @SOLDADO, 'Amazonas Jaffa', 6,  '100',  '70', '10',   '500',  'Mujeres guerreras dispuestas a salvar a las niñas del planeta Hak\'tyl de morir quemadas por órdenes del Goa\'uld Moloc. Sirven en secreto a la Rebelión Jaffa. Muy diestras en combate cuerpo a cuerpo.', FALSE, FALSE),
(261, @SINRAZA, @SOLDADO, 'Androide',       6,  '100',  '75', '30',   '500',  'Replicas virtuales de personas humanas creadas por Harlan en Ataris para ayudarle a trabajar en su fabrica.', FALSE, FALSE),
########################################  Combate  ########################################################################################
(227, @SINRAZA, @SOLDADO, 'Impuros',                     7,   '50',   '20',  '0',  '100', 'Seres humanos que han sido contagiados por un extraño virus que les convierte en hombres muy primitivos y agresivos. Su cerebro ha sido paralizado, dejando únicamente intactas las zonas de los instintos más básicos. No atienden a razón y su principales armas son palos y rocas que encuentran.', FALSE, FALSE),
(250, @SINRAZA, @SOLDADO, 'Whisper',                     7,  '200',   '30',  '0',  '300', 'Alteración del ADN humano creada por el semiWraith Michael. Los sujetos son altamente agresivos y fuertes. De carácter depredador, cuentan con una habilidad natural para ocultarse en la niebla que su propio cuerpo genera.', TRUE, FALSE),
(257, @SINRAZA, @SOLDADO, 'Zombie de Tel\'Chak',     7,  '100',  '300',  '0',  '400', 'Seres muertos resucitados mediante el aparato de Tel\'Chak. Son una reanimacion del cuerpo muerto por lo que son muy poco inteligentes, aunque son muy dificiles de liquidar con armas convencionales.', FALSE, FALSE),
(316, @SINRAZA, @SOLDADO, 'Guerrero de Kera',            7,   '80',   '50',  '0',  '400', 'Jovenes guerreros del planeta M7G-677. Su cultura les obliga a suicidarse a la edad de veinticinco años por el bien de la comunidad, ya que creen que asi mantandran alejados a los Wraith.', FALSE, FALSE),
(315, @SINRAZA, @SOLDADO, 'Guerreros de Arkham',         7,   '80',   '30',  '0',  '400', 'Guerreros de cultura medieval que vivian en el planeta Arkham bajo el mando del Coronel Harry Maybourne. De incuestionable valor y honor, no usan armas de fuego pero su diestro manejo de las armas arrojadizas y lealtad a su rey son de gran utilidad.', FALSE, FALSE),
(232, @SINRAZA, @SOLDADO, 'Salish',                      7,   '80',  '160',  '0',  '400', 'Guerreros natales del planeta Salish, que es protegido por los espíritus del bosque. De incuestionable valor y honor, los guerreros de Salish no usan armas de fuego pero su arrojo y su gran numero hacen que sean de gran valor en combate.', FALSE, FALSE),

(240, @SINRAZA, @SOLDADO, 'Comando Tok\'Ra',         8,  '130',   '60', '10',  '400', 'Fuerzas de combate y asalto de la Tok\'Ra. Ocultos en sus bases de cristal, los comando Tok\'Ra estan formados por guerreros especializados en infiltracion.', FALSE, FALSE),
(245, @SINRAZA, @SOLDADO, 'Prisionero Olesiano',         8,  '100',   '50',  '2',  '400', 'Reclusos del planeta Olesia, que son confinados en una gran recinto abierto. El gobierno olesiano los utiliza para ganarse el favor de los Wraith, ofreciendoselos como alimento.', FALSE, FALSE),
(235, @SINRAZA, @SOLDADO, 'Guerrero de Juna',            8,  '100',   '70',  '0',  '400', 'Guerreros natales del planeta Juna, que pertenece al territorio del Goa\'uld Cronus. De incuestionable valor y honor, los guerreros de Juna no usan armas de fuego pero su mimetismo en los bosques y su astucia son de gran utilidad.', FALSE, FALSE),
(236, @SINRAZA, @SOLDADO, 'Rebelde anti-Ori',            8,  '100',   '60',  '0',  '400', 'Fuerzas guerrilleras secretas que conspiran para derrocar el poder Ori. Tienen muchas facciones clandestinas diseminadas por toda la galaxia, dando pequeños golpes contra los priores.', FALSE, FALSE),
(244, @SINRAZA, @SOLDADO, 'Guerrilla de Abydos',         8,  '100',   '60',  '0',  '400', 'Cuando los Tau\'ri hicieron su primer viaje a Abydos, encontraron que el planeta estaba siendo esclavizado por Ra. El Coronel O\'Neill, junto con el mayor Kawalski y el Mayor Ferretti, organizaron una rebelión para expulsar al Señor del Sistema. Los valientes jovenes de Abydos consiguieron derrotar a las fuerzas Jaffa de Ra por su coraje y su gran numero', FALSE, FALSE),
(238, @SINRAZA, @SOLDADO, 'Bola Kai',                    8,  '130',   '80',  '0',  '400', 'Raza de sanginarios nomadas que van de planeta a planeta saquenado aldeas y puestos avanzados. Su numero es insultantemente grande y son un pueblo guerrero muy temido en Pegasus.', FALSE, FALSE),
(234, @SINRAZA, @SOLDADO, 'Guerrero Vikingo',            8,  '130',   '80',  '0',  '400', 'Guerreros natales del planeta Cimmeria, que es protegido por los Asgard. De incuestionable valor y honor, los guerreros cimmerianos no usan armas de fuego pero su aguante ante condiciones climatológicas adversas y su conocimiento de los bosques es muy útil en combate.', FALSE, TRUE),

(243, @SINRAZA, @SOLDADO, 'Milicia de Rand y Caledonia', 9,  '100',  '120',  '5',  '500', 'Fuerzas de infantería de Rand y Caledonia. Las continuas disputas militares internas del planeta entre sus dos naciones principales han conseguido que los ciudadanos monten milicias urbanas muy bien armadas.', FALSE, FALSE),
(239, @SINRAZA, @SOLDADO, 'Comando Genii',               9,  '100',   '70',  '5',  '500', 'Fuerzas de combate y asalto de los Genii. Su clandestinidad hace que sean rapidas de conseguir. Entrenados por los mejores comandante Genii, son muy habiles en el uso de armas blancas y de fuego.', FALSE, FALSE),
(4,   @SINRAZA, @SOLDADO, 'Comando SG ruso',             9,   '90',   '80',  '5',  '500', 'Grupos de élite formados por cuatro hombres especializados en diferentes campos y que son capaces de enfrentarse a cualquier misión en planetas alienígenas. Son expertos en misiones de reconocimiento, transporte y combate contra el enemigo.', FALSE, FALSE),
(44,  @SINRAZA, @SOLDADO, 'Infiltrados de Apophis',      9,   '90',   '80',  '5',  '500', 'Jóvenes Jaffa que son adiestrados en campos secretos por los hombres de Apophis para aprender costumbres de combate Tau\'ri y así poder infiltrarse en la Tierra sin ser detectados.', FALSE, FALSE),
(5,   @SINRAZA, @SOLDADO, 'Saqueador del NID',           9,  '100',  '120', '20',  '500', 'Antiguos miembros del NID que fueron reclutados por el Coronel Maybourne para realizar misiones de saqueo y robo de aparatos alienígenas que pudieran servir para defender la Tierra de los Goa\'uld.', TRUE, FALSE),
(237, @SINRAZA, @SOLDADO, 'Guerrillero Langariano',      9,  '100',  '100',  '5',  '500', 'Fuerzas de infantería del planeta Langara. Las continuas disputas militares internas del planeta entre sus tres naciones principales (Kelowna, Terrania y la Federación Andari) han conseguido que los ciudadanos estén al pie del cañón.', FALSE, FALSE),

(251, @SINRAZA, @SOLDADO, 'Soldado Bedrosiano',         10,  '130',    '95',  '15', '600', 'Fuerzas de infanteria del planeta Bedrosia. Estrictos y honorables guerreros que daran su vida por proteger sus territorios. Grandes combatientes cuerpo a cuerpo con armas de fuego.', FALSE, FALSE),
(252, @SINRAZA, @SOLDADO, 'Soldado Eurondano',          10,  '130',    '95',  '15', '600', 'Facciones militares del planeta Euronda que se encuentra en guerra con la otra nacion del planeta. Muy diestros en combate, pues llevan en guerra desde tiempos inmemoriables.', FALSE, FALSE),
(255, @SINRAZA, @SOLDADO, 'Prisionero de Netu',         10,  '150',   '100',  '15', '600', 'Ladrones, violadores, asesinos... toda la calaña de la Galaxia se encuentra confinada en la luna de Netu bajo la proteccion del Señor de la Oscuridad, Sokar. Muchos han servido de anfitriones para larvas Goa\'uld por su mente envenenada.', FALSE, FALSE),
(242, @SINRAZA, @SOLDADO, 'Milicia de Hallona',         10,  '160',    '95',  '15', '600', 'Duros guerreros que viven para el combate, ya que su nación, Hallona, esta en guerra con Geldar. Están hechos a imagen y semejanza de su líder, el Coronel John Sheppard', FALSE, FALSE),
(249, @SINRAZA, @SOLDADO, 'Guerrero Serrakin',          10,  '130',   '100',  '40', '600', 'Los Serrakin son un grupo de honorables e inteligentes humanoides que liberaron al planeta Hebridan de los Goa\'uld hace años. Actualmente viven en armonía con los seres humanos, pudiendo incluso emparejarse. Tecnológicamente y socialmente avanzados, formaron alianza con los Tau\'ri proveyéndoles de reactores para sus naves.', FALSE, FALSE),
(253, @SINRAZA, @SOLDADO, 'Guardia Tollano',            10,  '135',   '100',  '40', '600', 'Fuerzas de infanteria de los Tollanos. Debido a lo avanzada que esta su civilizacion, cuentan con armas de ultima tecnologia en batalla.', FALSE, FALSE),
(46,  @SINRAZA, @SOLDADO, 'Guardia Horus',              10,  '130',   '130',  '10', '600', 'Jaffas con una brillante armadura cuyo casco representa a un halcón. Son los sirvientes de la familia de Ra, sobre todo de su hijo Her-Ur. Usan armaduras de este tipo para causar asombro en los poblados poco desarrollados, que los toman como seres divinos.', FALSE, FALSE),
(47,  @SINRAZA, @SOLDADO, 'Guardia de Ba\'al',      10,  '130',   '140',  '20', '600', 'Jaffas de élite al servicio del arrogante Señor del Sistema Ba\'al. Encargados de la supervisión de sus minas de naquadah y sus fabricas de Ha\'tak en Erebo. Muy bien entrenados en combate cuerpo a cuerpo y con armas bláster.', FALSE, FALSE),
(48,  @SINRAZA, @SOLDADO, 'Guardia Necrópolis',    10,  '130',   '135',  '10', '600', 'La guardia de Sokar la componen Jaffas, humanos e incluso otros Goa\'uld que sirven al Señor de Netu como castigo. Hombres de todas las esquinas de la galaxia y escoria sin prejuicios. Visten unas intimidatorias armaduras forjadas en el propio planeta.', FALSE, FALSE),

(116, @SINRAZA, @SOLDADO, 'Jaffa Ninja',                11,  '160',  '150',  '20', '700', 'Jaffas del Señor del Sistema Yu, que son expertos en el arte ninja de combate y que utilizan katanas ashrak extremadamente afiladas y realmente mortiferos.', FALSE, TRUE),
(117, @SINRAZA, @SOLDADO, 'Jaffas de Imhotep',          11,  '160',  '150',  '20', '700', 'Jaffas adiestrados con la antigua tecnica de la Mastaba por el Goa\'uld Imhotep. Utilizan casi todas las partes de su cuerpo para golpear al rival ya que la Mastaba potencia la expresion corporal. Son letales en la lucha cuerpo a cuerpo.', FALSE, FALSE),
(247, @SINRAZA, @SOLDADO, 'Unas silvestre',             11,  '160',  '200',  '50', '700', 'Seres antropomorfos y primitivos originarios del mismo planeta que los Goa\'uld. Los Unas libres forman sociedades divididas en clanes o tribus bien estructuradas y dominadas por el Macho Alpha. Han desarrollado un lenguaje y una adaptabilidad al medio y a las armas de fuego, así como una defensa a la posesión Goa\'uld. Son muy fuertes cuerpo a cuerpo y su dura piel les defiende de las armas de energía.', FALSE, FALSE),
(248, @SINRAZA, @SOLDADO, 'Unas Goa\'uld',          11,  '170',  '250',  '50', '700', 'Seres antropomorfos y primitivos originarios del mismo planeta que los Goa\'uld. Este hecho hizo que fueran sus primeros anfitriones. Son muy fuertes cuerpo a cuerpo y su dura piel les defiende de las armas de energía. Además cuando un Goa\'uld toma el cuerpo de un Unas, le dota de un increíble poder de regeneración a las heridas y enfermedades, así como la capacidad de un lenguaje fluido.', FALSE, FALSE),
(229, @SINRAZA, @SOLDADO, 'Stragoth',                   11,  '170',  '190',  '50', '700', 'Raza de alienígenas que toman la forma de cualquier ser vivo. Para ello, antes han de capturarlo y conectarlo a su matriz biológica.', TRUE, FALSE),

(175, @SINRAZA, @SOLDADO, 'Híbrido',               12,  '240',  '300',  '0',  '900', 'Experimentos genéticos de Michael, a medio camino entre Wraith y humanos. Muy sumisos y con una habilidad para el combate excepcional.', FALSE, TRUE),
(246, @SINRAZA, @SOLDADO, 'Reetou',                     12,  '250',  '190', '30',  '900', 'Alienígenas con forma de insecto que tienen el peligroso don de la invisibilidad al ojo humano. Tras considerarlos una amenaza, fueron perseguidos y masacrados por los Goa\'uld. Por este hecho, una facción rebelde tiene como objetivo la destrucción de todo ser que pueda ser un anfitrión de los Goa\'uld. Operan en comandos de infiltración de cinco miembros, armados con cañones de iones.', TRUE, FALSE),
(45,  @SINRAZA, @SOLDADO, 'Guardia Chacal',             12,  '250',  '180', '25',  '900', 'Antigua guardia personal del Goa\'uld Anubis. Tras la caída de este, los guerreros Chacal juraron lealtad a el Señor Supremo Ra y su familia. Son la élite de la guardia Jaffa Goa\'ld. Poseen entrenamiento de primado y su arsenal va desde lanzaderas Jaffa a garras retráctiles.', FALSE, TRUE),
(258, @SINRAZA, @SOLDADO, 'Guerrilla de Ford',          12,  '200',  '250', '20',  '900', 'Cuando el Teniente Ford descubrió las propiedades de la encima Wraith, deserto de Atlantis y formo un grupo de asalto de caravanas de transporte Wraith. Los guerrilleros cuentan con una incansable fuerza y energía, así como soltura en el manejo de armas de cualquier tipo.', FALSE, FALSE),
(260, @SINRAZA, @SOLDADO, '?',                          12,  '275',  '200', '60',  '900', 'Raza militar tecnologicamente avanzada que planeo el ataque a la base Atlantis en una relidad alterntiva.', FALSE, FALSE),
(429, @SINRAZA, @SOLDADO, 'Zara\'Kesh',             12,  '275',  '345', '20', '1000', 'Aparatos que se impulsan mediante naquadah, y que son condicidos por Jaffas especializados en su conducción. Poseen armas similares a las lanzaderas pesadas y su la gran velocidad que alcanzan hacen que sean mortiferas armas.', FALSE, TRUE),
(389, @SINRAZA, @SOLDADO, 'Bestia',                     15,  '320',  '400',  '0',  '900', 'Poderosas bestias similares a los extintos dinosaurios terrestres que habitan inospitos planetas de Andromeda. Debido a su ferocidad y violencia, son letales en combate con unidades de infanteria. Adiestrarlas es francamente dificil pero aportan gran poder intimidatorio entre las huestes de soldados.', FALSE, TRUE),
########################################  Oficiales  ########################################################################################
(353, @SINRAZA, @SOLDADO, 'Illac Renin',                    13, '130', '200',   '0', '1900', 'Jaffas que han decidido seguir los designios del Libro de Origen. El grupo se identifica con las enseñanzas Ori, y han sido causantes de varios ataques a comunidades humanas y Jaffa que se oponían a ellos. En Antiguo, significa el "Reino del Camino".', FALSE, FALSE),
(241, @SINRAZA, @SOLDADO, 'Miliciano de La Coalición', 14, '185', '320',   '5', '2000', 'Fuerza guerrillera formada por el consejo de aldeas de Pegasus y que protege las poblaciones humanas de ataques Wraith y Bola Kai. La continua guerra entre humanos y Wraith ha endurecido a los aldeanos, haciéndolos mas fuertes y mas preparados para la batalla.', FALSE, FALSE),
(7,   @SINRAZA, @SOLDADO, 'Oficial SG ruso',                16, '200', '400',  '50', '2000', 'Hombres condecorados por las Fuerzas Aéreas rusas con mucha experiencia en combate. Diestros en el manejo de armas y estrategias de guerra, dan apoyo al resto de tropas con su líderazgo en batalla.', FALSE, FALSE),
(262, @SINRAZA, @SOLDADO, 'Oficial Genii',                  20, '220', '410',  '40', '2300', 'Hombres condecorados por el Alto consejo Genii y entrenados desde pequeños en el uso de armas, que aportan mucha experiencia en combate. Diestros en estrategias de guerra, dan apoyo al resto de tropas con su Líderazgo en batalla.', FALSE, FALSE),
(259, @SINRAZA, @SOLDADO, 'Oficiales Satedanos',            25, '230', '450',  '40', '2300', 'Fuerzas de infanteria del planeta Sateda. Fieros y honorables guerreros que daran su vida por proteger a los suyos y sus territorios. Grandes combatientes cuerpo a cuerpo tanto con armas de fuego satedanas, como de espadas y cuchillos.', FALSE, FALSE),
(399, @SINRAZA, @SOLDADO, 'Mercenario Lucian',              30, '250', '450',  '50', '3000', 'La Alianza Lucian son un grupo mafioso muy bien organizado que se hizo con el control de la tecnologia goauld cuando estos fueron derrotados. Se rigen por un estricto codigo militar en el que se aceptan contrabandistas, ladrones y asesinos de todos los puntos de la galaxia.', FALSE, FALSE),
(254, @SINRAZA, @SOLDADO, 'Humanos mutados',                30, '350',  '80',  '60', '3100', 'En su búsqueda por crear genéticamente un Hok\'taur o humano avanzado, la Goa\'uld Nirti experimento con un aparato de los Antiguos para reconfigurar el ADN de los humanos de P3X-367. Estos humanos sufrieron graves mutaciones físicas y taras, pero a cambio adquirieron poderes psíquicos tales como telequinesia o telepatía.', FALSE, FALSE),
(256, @SINRAZA, @SOLDADO, 'Monje de Kheb',                  45, '320', '400',  '70', '4000', 'Humano de aspecto oriental y cultura tibetana. El monje vive en el planeta Kheb. Recibió al SG-1 y a Bra\'tac durante su visita a este lugar buscando al niño Harsesis.', TRUE, FALSE),
########################################  Asesino  ##########################################################################################
(414, @SINRAZA, @SOLDADO, 'Asesino Sodan',       25, '200', '180', '50', '1800', 'Los Sodan cuentan con un grupo de guerreros especializados en el sigilo y la ocultación. Utilizando sus artefactos de invisibilidad, pueden atacar a objetivos concretos desde cualquier punto sin ser detectados.', TRUE, FALSE),
(263, @SINRAZA, @SOLDADO, 'Asesino Tok\'Ra', 25, '250', '200', '20', '1900', 'Los asesinos de la Tok\'Ra son hombres fuertemente entrenados en infiltracion, suplantacion y sigilo que han sido adiestrados por los Altos Mandos de la Tok\'Ra para la eliminacion de objetivos. Poseen el poder de Hara Kash y cuentan con multiples recursos como invisibilidad o suplantacion de forma fisica.', TRUE, FALSE),
(426, @SINRAZA, @SOLDADO, 'Guardia Dragón', 30, '350', '250', '30', '2000', 'Los guardias Dragón fueron la guardia personal de Goa\'uld Kur cuya aterradora imagen y reputación fue heredada por sus Jaffa. Cada guardia dragón fue entrenado para ser un feroz guerrero que lucha hasta el final, y nunca se rinde en batalla, incluso cuando la situación parece perdida. Su ferocidad en batalla y sus tacticas agresivas fueron consideradas deshonrosas incluso para otros Jaffa, sin embargo, era una necesidad para la protección de su planeta natal. Sus yelmos, cuando se activan, toman la forma de un dragón y están equipados con "La garra del dragón", unas espadas gemelas en las muñecas de ocho pulgadas.', FALSE, TRUE),
(52,  @SINRAZA, @SOLDADO, 'Ashrak',              40, '350', '250', '35', '2000', 'Los Ashrak o "Cazadores" son asesinos Goa\'uld que han sido adiestrados por los Señores del Sistema para la infiltración y eliminación de objetivos. Poseen el poder de Hara Kash y cuentan con múltiples recursos como invisibilidad o suplantación de forma física.', TRUE, TRUE),
########################################  Heroes Tropa  ######################################################################################
#..........................Cientificos
(268, @SINRAZA, @SOLDADO, 'Ma\'chelo',       100,   '5',   '30',   '5', '1200', 'Otrora fue un gran guerrero en muchas batallas contra los Goa\'uld. Durante una de ellas, fue hecho prisionero por estos siendo torturado. Consiguió escapar y desde entonces crea inventos para acabar con ésta especie alienígena, por lo que los Señores del Sistema le buscaron durante más de cincuenta años para destruírle.', FALSE, FALSE),
(266, @SINRAZA, @SOLDADO, 'Linea',               100,  '10',   '35',  '30', '1200', 'Mujer con grandes conocimientos en química que es conocida con el nombre de la "Destructora de Mundos". Fue enviada a la prisión del planeta Hadante por haber provocado una enorme explosión en un planeta, causando numerosos daños.', FALSE, FALSE),
(265, @SINRAZA, @SOLDADO, 'Harlan',              100,  '15',   '50',  '10', '1200', 'Único superviviente del planeta en el que vive, Altair. Todos los habitantes murireron debido a que destruyeron su planeta y tuvo que sobrevivir bajo tierra. Es muy hábil en la construccion de androides.', FALSE, FALSE),
(283, @SINRAZA, @SOLDADO, 'Furlings',            100,   '0',  '100', '100', '1200', 'Es la cuarta raza que se unió a los Nox, los Antiguos y los Asgard para tratar de alcanzar una alianza en la Galaxia. Aunque se conoce su existencia casi desde el principio hasta ahora no se había logrado ningún planeta en el que poder tener un posible contacto con ellos.', TRUE, FALSE),
(386, @SINRAZA, @SOLDADO, 'Allina',              100,  '50',  '500',   '7', '1200', 'Allina es una joven investigadora daganiana que quería reiniciar de nuevo la hermandad Quindosim, después de recuperar la "Potentia", un Módulo de Punto Cero, creyendo que sería recompensado por los Antiguos otorgandoles proteccion.', FALSE, FALSE),
(269, @SINRAZA, @SOLDADO, 'Anise',               100,  '80',  '500',  '50', '1200', 'Es un miembro de la Tok\'ra, especialista en culturas antiguas y arqueología. Experta cientifica, descubrió una leyenda sobre unos brazaletes que daban gran fuerza a sus portadores. Mediadora y representante de la Tok\'ra en La Tierra.', FALSE, FALSE),
(381, @SINRAZA, @SOLDADO, 'Mollem',              100,  '50',  '600',  '50', '1200', 'Perteneciente a la raza de los Aschen, La Tierra conocíó a estos habitantes realizando un pacto para defenderse. La tecnología de esta raza es muy avanzada por lo que la Tierra alcanza el año 2010 sin go\'auld, sin cáncer y aumentando su nivel de longevidad', FALSE, FALSE),
(278, @SINRAZA, @SOLDADO, 'Warrick Finn',        100, '100',  '600',  '50', '1200', 'Pertenece a la Raza de los Serrakin. Aliado Tau\'ri, tras ser ayudado en un motin de una nave-prision, competira junto a Carter en la carrera de Kon Garat. Es un experto en mecánica y puede conseguir repuestos para casi cualquier nave.', FALSE, TRUE),
(394, @SINRAZA, @SOLDADO, 'Ginn',                100, '150',  '900',  '50', '1200', 'Ginn es una científica humana miembro del equipo de la Alianza Lucian que abordo la nave antigua Destiny. Según su propio testimonio, fue llevada desde su casa en la punta de pistola y obligado a unirse a la Alianza Lucian cuando su familia fue amenazada. Es una experta en tecnología lantiana.', FALSE, FALSE),
(275, @SINRAZA, @SOLDADO, 'Jolinar de Malkshur', 100, '120',  '900',  '50', '1200', 'Miembro ilustre y activo de la Tok\'Ra. Fue un quebradero de cabeza de los Señores del Sistema durante años, hasta que fue capturada por Sokar y mandada a Netu. Luchó igual que el resto de componentes de la Tok\'ra por acabar con la dominación Goa\'uld y sus métodos de sufrimiento para conseguir anfitriones a los que infectar. ', FALSE, FALSE),
#..........................Medicos
(284, @SINRAZA, @SOLDADO, 'Nox',       100, '0', '1000', '500', '1200', 'Los Nox tienen la capacidad de hacer desaparecer las cosas a su alrededor. Sus conocimientos son muy antiguos, y formaron parte junto a los Asgard, Los Furlings y los Antiguos, la alianza de "Las Cinco Razas". Otras de sus características importantes es que poseen un ritual conocido como "Ritual de la Vida", en el que son capaces de resucitar a los muertos, aunque se vuelven vulnerables durante la ceremonia.', TRUE, FALSE),
(352, @SINRAZA, @SOLDADO, 'El Guarda', 100, '5',  '500',  '10', '1200', 'Curioso personaje que habita el mundo P7J-989 que invento un dispositivo que atrapa a los habitantes del planeta en una realidad virtual.', FALSE, FALSE),
#..........................Oficiales
(271, @SINRAZA, @SOLDADO, 'Skaara',       100, '500',  '900',   '5', '1200', 'Hijo pequeño de Kasuf, jefe del poblado de Nagada, en el planeta Abydos. Joven despierto y enérgico, se hizo amigo del Coronel Jack O\'Neill durante el primer viaje de éste a través del Stargate. Viendo en él al liberador de su pueblo quiso imitarlo, transformándose en un gran guerrero y ayudando en la liberación de Nagada de la opresión de Ra.', FALSE, TRUE),
(437, @SINRAZA, @SOLDADO, 'Sora Tyrus',   100, '600',  '950',  '50', '1200', 'Sora Tyrus es una Genii hija de Tyrus. Según Cowen, es una luchadora experta y una audaz tiradora. Conoció a Teyla Emmagan durante toda su vida, sin embargo a pesar de su amistad, Sora culpó a Teyla de la muerte de su padre durante una misión en una nave colmena Wraith.', FALSE, TRUE),
(368, @SINRAZA, @SOLDADO, 'Jonas Hanson', 100, '700',  '975',  '75', '1200', 'Jonas Hanson fue un capitán y líder del SG-9. Cuando el equipo cruzo en Stargate en direccion a Avnil, sus habitantes inmediatamente se inclinaron pensando que eran dioses. Hanson no lo negó y le dijo al resto del equipo que podría ser más seguro si se permitia a los habitantes seguir creyendolo por un tiempo instaurando un sistema de gobierno totalitario.', FALSE, TRUE),
(372, @SINRAZA, @SOLDADO, 'Jared Kane',   100, '850',  '975', '100', '1200', 'Jared Kane es un nativo del planeta Tegalus, un planeta bajo la amenaza de una guerra mundial por varias décadas entre la Federación de Nueva Caledonia y su nación de origen, el Protectorado de Rand. Era el principal ayudante del Comandante Gareth. También tenía una esposa llamada Leda Kane, que pagó menos atención a través de los años, desde que estaba tratando de restaurar el orden en el planeta, y sus cuestiones políticas ya inestables.', FALSE, TRUE),
(393, @SINRAZA, @SOLDADO, 'Simeon',       100, '950',  '985', '100', '1200', 'Nacido en un planeta donde las colonias humanas eran fuertemente hostigadas, Simeon es un hombre duro y arcaico. Siempre fiel a su mando superior, se unió a la Alianza Lucian para prosperar lejos de su planeta. Formo parte de la expedicion Lucian que abordo la nave antigua Destiny,', FALSE, TRUE),
#..........................Asesinos
(337, @SINRAZA, @SOLDADO, 'Neeva Casol', 100, '700', '900', '100', '1200', 'Ladrona natural de la galaxia Pegasus, mientras robaba un deposito de tecnología antigua intercambio accidentalmente su cuerpo con el de la doctora Keller, tras deshacer el cambio de cuerpos su futuro es incierto.', FALSE, TRUE),
(281, @SINRAZA, @SOLDADO, 'Kiryk',       100, '800', '900', '100', '1200', 'Corredor que huye de planeta en planeta de los cazadores Wraith. Muy disciplinado en combate, encontro por casualidad un dispositivo antiguo de teleportacion que le hace invisible a placer y le solventa muchos problemas con los espectros.', TRUE, TRUE),
(279, @SINRAZA, @SOLDADO, 'Aris Boch',   100, '900', '900', '100', '1200', 'Uno de los mejores cazarecompensas de toda la Galaxia. Su raza fue rechazada por los Goa\'uld para servirles de anfitriones, por lo que la gran mayoria de la población fue exterminada. El resto fueron utilizados como esclavos haciéndoles adictos a una sustancia llamada "Roshna". Sin ésta sustancia inyectada, mueren a los pocos dias.', FALSE, TRUE),
#..........................Lider
(264, @SINRAZA, @SOLDADO, 'Lucius Lavin',             100,   '10',  '450', '150', '1200', 'Lucius es un hombre que descubrio una toxina muy potente que hace que todo el mundo tenga un muy buen concepto de él y le admiren. Ademas, posee un escudo personal lantiano.', FALSE, FALSE),
(267, @SINRAZA, @SOLDADO, 'Sha\'re',              100,   '10',  '700',   '0', '1200', 'Hija mayor de Kasuf, jefe del poblado de Nagada en el planeta Abydos, lugar que visitaron por primera vez los componentes del primer equipo que cruzó el Stargate. Se convirtió en la mujer del Dr. Daniel Jackson cuando este decidió abandonar su vida en la Tierra para vivir en Abydos.', FALSE, FALSE),
(382, @SINRAZA, @SOLDADO, 'Halling',                  100,  '200',  '300',   '0', '1200', 'Un hombre profundamente espiritual, Halling es leal a su pueblo y a su hijo, Jinto. Viajó con el resto de su pueblo a la ciudad de Atlantis para establecer una nueva vida, relativamente libre de la amenaza constante de los Wraith.', FALSE, TRUE),
(448, @SINRAZA, @SOLDADO, 'Xe\'ls',               100,  '500',  '300',  '10', '1200', 'Xels es un alien de la raza de espíritus que son capaces de adaptar su cuerpo para parecerse al de cualquier forma viva. Protectores del pueblo Salish y buenos recolectadores de trinium, poseen el poder espiritual que les permite hacer desaparecer a cualquier organismo vivo y adaptar su forma para desestabilizar al enemigo.', TRUE, FALSE),
(374, @SINRAZA, @SOLDADO, 'Meurik',                   100,  '400',  '300',  '10', '1200', 'Meuric es el gobernador de Camelot, donde el SG-1 llegó en busca de armas capaces de destruir a los Ori. Meuric es un hombre sabio aunque profundamente respetuoso de las antiguas tradiciones.', FALSE, FALSE),
(346, @SINRAZA, @SOLDADO, 'Khonsu',                   100,  '400',  '500',  '50', '1200', 'Khonsu de Amón Shek fue un miembro de la Tok\'ra que se hizo pasar por Goa\'uld. El SG-1 fue capturado por su guardia Jaffa deliberadamente, en una operacion encubierta para conocer y obtener información acerca de cómo Anubis había estado recibiendo su tecnología avanzada.', TRUE, FALSE),
(376, @SINRAZA, @SOLDADO, 'Burrock',                  100,  '400',  '500',  '20', '1200', 'Burrock era un domador y vendedor de Unas en su planeta. En su vida había visto a los Unas como poco más que bestias de carga para hacer su voluntad. Había pasado incontables horas en el pedestal de la DHD, marcando un sinfín de combinaciones hasta que encontro el éxito al conectar con el mundo hogar original de la Unas, P3X-888, a partir de una dirección de la puerta que se transmite de generación en generación en las diversas familias de su planeta.', FALSE, FALSE),
(377, @SINRAZA, @SOLDADO, 'Gairwyn',                  100,  '500',  '500',   '0', '1200', 'Es la jefa del poblado cimmeriano desde la muerte de su esposo. Recibió al SG-1 durante su primera visita y trató de hacer que se sintiera como en casa. Además condujo al equipo para tratar de ayudar a rescatar a O\'Neill y Teal\'c del Laberinto del Unas.', FALSE, TRUE),
(397, @SINRAZA, @SOLDADO, 'Tenat y Jup',              100,  '600',  '500',  '50', '1200', 'Tenat y Jup, del planeta Oran, fueron los dos compradores interesados en adquirir el Prometeo tras ser robado por Vala Mal Doran. Más tarde trataron de vengarse de Vala y entregarla a la Alianza Lucian que había puesto una recompensa sobre ella. No obstante fue liberada por Daniel Jackson, Teal\'c y Cameron Mitchell, al que creyeron un cazador de recompensas.', FALSE, FALSE),
(402, @SINRAZA, @SOLDADO, 'Seevis',                   100,  '750',  '600',   '0', '1200', 'Seevis era un humano que se desempeñó como administrador de Ver Isca y barman local. Era conocido como un fiel seguidor de los Ori, y parecía no tener compasión por los "no creyentes". Si descubria a algun habitante apartarse del camino de la justicia, sus castigos eran conocidos por ser graves, incluida su colocación en el altar de pueblo en día a la vez sin comida ni agua. Posteriormente se descubrió que, sorprendentemente para muchos, Seevis Líderaba la milicia de resistencia a los Ori.', FALSE, FALSE),
(270, @SINRAZA, @SOLDADO, 'Martouf',                  100,  '700',  '650',  '30', '1200', 'Es un miembro de la Tok\'ra, especialista en diplomacia. Sera mediador entre La Tierra y los mundos Tok\'Ra, siendo de apoyo muchas veces al SG-1 en sus incursiones. Luchó igual que el resto de componentes de la Tok\'ra por acabar con la dominación Goa\'uld y sus métodos de sufrimiento para conseguir anfitriones a los que infectar.', TRUE, FALSE),
(272, @SINRAZA, @SOLDADO, 'Kasuf',                    100,  '700',  '900',   '5', '1200', 'Jefe del poblado de Nagada en el planeta Abydos. Es un hombre convencido en sus creencias, y que siempre ha tratado de guiar a su pueblo por el mejor camino. Durante mucho tiempo, trató de que su gente se sintiera lo mejor posible a pesar del sometimiento del dios Goa\'uld Ra, quién mantuvo a la población sometida a trabajos forzados en las minas de la región. Con la visita del primer grupo desde La Tierra, Kasuf se alineo con la resistencia que los Tau\'ri crearon y que acabo con la tirania del Señor Supremo.', FALSE, FALSE),
(273, @SINRAZA, @SOLDADO, 'Omal',                     100,  '750',  '700',   '0', '1200', 'Líder de los Bola Kai. Fue elgido tras asesinar al antiguo Líder en una pelea ritual. Fiero y despiadado en combate, su nombre es temido por toda la Galaxia. Es diestro en el uso de armas blancas como espadas y machetes.', FALSE, TRUE),
(274, @SINRAZA, @SOLDADO, 'Narim',                    100,  '775',  '700',  '70', '1200', 'Miembro del alto consejo de Tollan. Cuando su respaldo en el alto consejo Omoc, murió, comenzó a sospechar que algo oscuro había detrás de la Curia de su planeta, por ello trató de comunicárselo al SG-1 para que éstos le ayudaran a saber lo que ocurría. Cuando tuvo que decidir entre la supervivencia de su planeta y su raza y la del resto del Universo, ayudó al SG-1 a desenmascarar al Goa\'uld que los presionaba.', FALSE, FALSE),
(404, @SINRAZA, @SOLDADO, 'Katana Labreya',           100,  '800',  '800',  '40', '1200', 'Katana Labreya es una Traveller, capitán de un crucero generacional. Cuando el Stargate del mundo natal Traveller destruyó su colonia, Larrin envió a Katana a Atlantis a averiguar lo que pasó. Conocio la localización del dispositivo Attero y con la ayuda del coronel John Sheppard y el Dr. Radek Zelenka logró llegar al planeta donde se encontraba.', FALSE, FALSE),
(276, @SINRAZA, @SOLDADO, 'Chaka',                    100,  '800',  '900',  '90', '1200', 'Líder de la faccion Unas aliada con los Tau\'ri. Interactuo por primera vez con estos cuando rapto el Dr. Jackson. Éste logro ganarse al Unas y ayudarle a ganar el Líderazgo de su faccion. Posteriormente sirvio a los Tau\'ri de enlace entre ellos y facciones violentas unas.', FALSE, TRUE),
(343, @SINRAZA, @SOLDADO, 'Ladon Radim',              100,  '850',  '500',  '80', '1200', 'Líder de los Genii tras el derrocamiento de Cowen. Tras ayudar al Comandante Acastus Kolya en una escaramuza por tomar control de Atlantis, Ladon recapacito y trato de ganarse el favor de los habitantes de la ciudad nave con varias alianzas.', FALSE, TRUE),
(375, @SINRAZA, @SOLDADO, 'Cowen',                    100,  '800',  '800',  '80', '1200', 'Cowen, fue el Jefe de los Genii y enemigo de la expedición Atlantis. Después de ordenar a sus tropas a traicionar a la expedición en varias ocasiones, que fue derrocado finalmente por Ladon Radim, uno de sus principales lugartenientes, como parte de un golpe militar.', FALSE, TRUE),
(379, @SINRAZA, @SOLDADO, 'Omoc',                     100,  '850',  '750',  '90', '1200', 'Omoc fue uno de los más sabios entre los Tollan. Había aprendido de los errores que su pueblo había hecho con Serita, un planeta vecino que se destruyó después de que Tollan accediera a compartir su avanzada tecnología con ellos. Cuando su pueblo se vio obligado a evacuar su planeta condenado, Omac y su equipo fueron rescatados por el SG-1.', TRUE, FALSE),
(384, @SINRAZA, @SOLDADO, 'Egeria',                   100,  '900',  '800',  '90', '1200', 'Egeria era una reina Goa\'uld, que sentía que no era correcto utilizar otras especies como esclavos y llevarlos a la fuerza como anfitriones, por lo que dio lugar a una legión de prim\'ta que carecían de la naturaleza dominante de los Goa\'uld, convirtiéndose en la reina madre de la Tok\'ra.', FALSE, TRUE),
(378, @SINRAZA, @SOLDADO, 'Iron Shirt',               100,  '985',  '900',  '90', '1200', 'Kor Asek, es decir, Camisa de Hierro en lengua Goa\'uld, es el macho alfa de una tribu Unas de P3X-403 con el que Daniel Jackson y Chaka negociaron, para permitir el acceso a un depósito de Naquadah situado en tierra sagrada de los Unas, donde los antepasados de su tribu fueron explotados hasta la muerte por los Goa\'uld.', FALSE, FALSE),
(396, @SINRAZA, @SOLDADO, 'Varro',                    100,  '985', '1000', '100', '1200', 'Varro es la mano derecha de Kiva. Un hombre de fieles creeencias que se unio a la Alianza Lucian para poder sacar a su familia adelante. Cuando Kiva murio en el asalto a al Destiny, Varro quedo al mando de los hombres de la Alianza que se mantuvieron en la nave lantiana junto a los Tau\'ri Líderados por el Coronel Young.', FALSE, TRUE),
(391, @SINRAZA, @SOLDADO, 'Kiva',                     100, '1000',  '900', '100', '1200', 'Kiva es una humana que se convirtió en comandante de la Alianza Lucian. Es la hija de otro oficial de alto rango llamado Masim, que fue uno de los jerarcas de la Alianza. Ella afirma que sus únicos intereses son para el bienestar de su pueblo, pero mata sin piedad como una demostración de fuerza o si alguien le falla.', FALSE, TRUE),
(392, @SINRAZA, @SOLDADO, 'Netan',                    100, '1000',  '950', '100', '1200', 'Netan es el despiadado líder de la Alianza Lucian y enemigo del SG-1. Implacable y despiadado, con frecuencia durante su mandato como líder de la Alianza Lucian cometia viles fechorias y asesinba incluso sus propios hombres. A pesar de ello, Netan fue considerado un cobarde por otros mandos de la Alianza, sobre todo cuando se negó a perseguir a los Tauri.', FALSE, TRUE),
(282, @SINRAZA, @SOLDADO, 'Comandante Acastus Kolya', 100, '1100', '1000', '100', '1200', 'Líder militar genii. Experto en el combate cuerpo a cuerpo y con todo tipo de armas. De extremada astucia y arrogancia, tomó en una ocasión la ciudad de Atlantis junto a varios comandos Genii. Su enemistad con los miembros de la base lantiana y su codicia de poder, han hecho que haya salido derrotado en varias ocasiones.', FALSE, TRUE),
#..........................Supremos
(286, @SINRAZA, @SOLDADO, 'Orlin',        100, '1000', '1000',  '2000', '1200', 'Ser ascendido que siguió a Carter hasta La Tierra. Fue desterrado de su mundo por ayudar a los habitantes de Velona a defenderse de los Goa\'uld y saltarse la regla número uno en su planeta, no acelerar la ascensión de los humanos. De excelentes conocimientos cientficos, Orlin ayudo posteriormente al SG-1 a construir el aparato innibidor de Priores.', TRUE, TRUE),
(314, @SINRAZA, @SOLDADO, 'Chaya Sar',    100, '2000', '2000',  '1000', '1200', 'Lantiana que ascendio en tiempos de la guerra contra los Wraith y que protege el planeta Proculus de las incursiones espectras. Fue descubierta en una mision por el Coronel Sheppard, que descubrio su origen ascendido.', TRUE, TRUE),
(424, @SINRAZA, @SOLDADO, 'El Rey Arturo',  0, '2500', '2000',  '1200',    '0', 'Ambrosio Aureliano fue un caudillo romano de origen britano que dirigió la defensa de Bretaña frente a los invasores sajones a comienzos del siglo VI. Posteriormente se convirtio en rey de Bretaña y estableció un imperio en las Islas Británicas. Viendo su potencial, el lantiano Merlín, que había descendido de un plano existencial superior, se convirtió en su consejero y le enseño los secretos del universo y el uso del Stargate. Arturo fue un héroe de leyenda en La Tierra y Camelot. Tras salir victorioso de su batalla final contra su enemigo Mordred en Camlann, salió en busca del Sangreal, que habia sido robado por Morgana, junto con sus caballeros.', TRUE, TRUE),
(373, @SINRAZA, @SOLDADO, 'Merlin',       100, '2000', '1000',   '800', '1200', 'Merlín fue un lantiano que creó el Sangraal. Nacido como Moros formo parte del Alto Consejo Lantiano en Atlantis durante la guerra con los Wraith. Tras la derrota en Pegasus ordenó a los lantianos evacuar Atlantis para volver a la Tierra. Ya en La Tierra, se recluyó en la meditación, y ascendió. Sin embargo, llegó a la conclusión de que los Ori eran una amenaza demasiado grande para ignorarla por lo que descendió, conservando todos los conocimientos y muchos de sus poderes. A la vez que fabricaba un arma capaz de acabar con los ori, confió sus secretos al rey Arturo y algunos de sus nobles.', TRUE, TRUE),


########################################  Caza Pesado  ######################################################################################
(297, @SINRAZA, @NAVE, 'Cosechadora Aschen', 15,   '0', '175',  '5', '1000', 'Aeronaves de recoleccion de recursos Ashen. No tienen armas ni capacidad de viaje hiperespacial, pero recolectan una gran cantidad de recursos en planetas con recursos naturales.', FALSE, FALSE),
(299, @SINRAZA, @NAVE, '?',                  15, '400', '400',  '0', '1500', 'Cazas de combate usados por una misteriosa raza para atacar Atlantis. Gran maniobrabilidad y fuego de combate.', FALSE, FALSE),
(298, @SINRAZA, @NAVE, 'Caza Bedrosiano',    15, '450', '500',  '0', '1500', 'Cazas de combate Bedrosianos. Son utilizados tanto en combate aereo como en transporte de tropas. Poseen poca maniobrabilidad pero muy buen resistencia.', FALSE, FALSE),
(85,  @SINRAZA, @NAVE, 'Caza de Osiris',     17, '550', '600', '15', '1600', 'Nave personal del Goa\'uld Osiris que estuvo oculta durante siglos en unas antiguas ruinas de Egipto. Es un caza pesado, menos maniobrable que un Planeador de la Muerte pero bastante mas resistente a ataques enemigos y evidentemente, mas sigiloso y veloz.', TRUE, FALSE),
########################################  Crucero  ##########################################################################################
(87,  @SINRAZA, @NAVE, 'Al\'kesh de carga',          35,  '400', '1600', '170', '5400', 'Módulos de carga añadidos a una nave de tipo Al\'kesh, para el transporte de materiales.', FALSE, FALSE),
(342, @SINRAZA, @NAVE, 'Interceptor Olesiano',           40,  '800', '2000', '100', '5400', 'Nave de combate que usan los habitantes del planeta Olesia para defender la zona de la carcel.', FALSE, TRUE),
(303, @SINRAZA, @NAVE, 'Crucero Generacional Traveller', 40, '1300', '3000', '100', '5600', 'Naves estandar de los Travellers, nómadas espaciales cuyas residencias son las propias naves. De aspecto destartalado, las naves son un conglomerado de artefactos conseguidos en puntos dispares de la galaxia y que son ensamblados con eficacia.', FALSE, FALSE),
########################################  Nodriza  ##########################################################################################
(306, @SINRAZA, @NAVE, '?', 200, '2750', '6000', '1000', '3000', 'Enorme crucero de batalla de una misteriosa raza tecnologicamente avanzada que ataco la ciudad de Atlantis en una realidad alternativa.', FALSE, FALSE),
########################################  Heroes Nave  ######################################################################################
#..........................Cruceros
(450, @SINRAZA, @NAVE, 'Time Jumper de Janus',  150,  '550', '765',   '50', '1000', 'El TimeJumper es un Jumper capaz de viajar en el tiempo. Fue construido por un científico lantiano llamado Janus, que le incorporó un dispositivo que inventó en la bodega de carga. En la línea de tiempo principal, simplemente fue un complemento experimental y a pesar de que funcionó con éxito, la tecnología fue prohibida por el Consejo Lantean con el fin de prevenir los peligro asociados con viajes en el tiempo.', TRUE, FALSE),
#..........................Cruceros
(301, @SINRAZA, @NAVE, 'Sebrus',                200,  '600', '3000', '500', '1000', 'Nave Serrakin. Su considerable velocidad le hace ser una de las mejores naves para competir en la carrera de Kon Garat de Hebridan. Sus escudos y armas le han permitido ganar dicha carrera en alguna ocasión. Además, ha sido usada varias veces para el transporte de personal, material y también de prisioneros.', FALSE, FALSE),
(307, @SINRAZA, @NAVE, 'Serenity',              200,  '900', '2000', '400', '1000', 'Nave de clase Firefly, que es usada para el contrabando. Asemeja una luciérnaga en la disposición general, y la sección de cola, análoga a un abdomen insectoide bioluminiscente, se ilumina durante la aceleración.', FALSE, TRUE),
(308, @SINRAZA, @NAVE, 'Crucero de Katana',     200, '1500', '4000', '100', '1000', 'Nave de la traveler, Katana Labreya. De aspecto destartalado, es un eficaz crucero de batalla con capacidad de viaje por el hiperespacio. Fue reclutada por el Coronel Sheppard para encontrar al Dédalo, que habia sido raptado por los Wraith, y para destruir el dispositivo de Attero.', FALSE, TRUE),
(431, @SINRAZA, @NAVE, 'Terraformador Gadmeer', 200, '2500', '3500', '200', '1000', 'El Terraformador Gadmeer es una nave construida por los Gadmeer como última esperanza para preservar su civilización, que se enfrentaba a la aniquilación a manos de un poder militar superior. Dicha nave lanza poderosos chorros de fuego sobre la superficie, devastando todo a su paso.', FALSE, TRUE),
#..........................Nodrizas
(304, @SINRAZA, @NAVE, 'Nave de Martin Lloyd', 200, '3000', '7000', '1000', '1000', 'Nave de la raza alienigena de Martin Lloyd, que viene a recogerle a la Tierra desde la nueva ubicacion de su base.', FALSE, FALSE),
(432, @SINRAZA, @NAVE, 'Nave Comandante',      200, '4000', '9000', '2000', '1000', 'Misteriosa nave que permanece flotando durante las batallas. Sus sistemas internos controlan unas pequeñas unidades caza llamados Drones Berzerker, cazas no tripulados que son enviados en masa contra objetivos enemigos.', FALSE, FALSE),
#..........................Insignias
(305, @SINRAZA, @NAVE, 'Nave de la Nebulosa V',            200, '5500', '6000', '1000',  '1080', 'Poderosa nave alienigena que surgio en una brillante nebulosa.', FALSE, FALSE),
(302, @SINRAZA, @NAVE, 'Nave de propulsión Lantiana', 200, '6500', '8500', '1000',  '1080', 'Nave que sirve de asentamiento a los grupos lantianos. Aterriza en lugares elevados y puede facilmente escapar debido a su motor de propulsión.', FALSE, TRUE),
(309, @SINRAZA, @NAVE, 'Aurora de Larrin',                 200, '4000', '9000', '1000',  '1080', 'Nave de batalla lantiana abandonada en la guerra contra los Wraith y encontrada por los Travelers varios años despues. A pesar de haber pasado mucho tiempo fuera de servicio, su MPC apenas esta agotado y cuenta con un arsenal de drones que se pueden disparar desde el sillon de mando.', FALSE, TRUE),
(433, @SINRAZA, @NAVE, 'Nodriza Ursini',                   200, '6000', '5500',  '900',  '1080', 'Los ursini son una raza de aliens exploradores que, hace siglos, entraron en guerra con otra raza. Durante su conflicto, los ursini construyeron poderosas naves de guerra, sin embargo, casi todas fueron destruidas cuando fueron derrotados. Ahora las naves ursini son muy poco comunes en la galaxia.', FALSE, FALSE),
(435, @SINRAZA, @NAVE, 'Sombra del Desierto',              200, '6500', '6000', '1000',  '1080', 'Las naves conocidas como "Sombras" son mortales naves que orbitan planetas aparentemente inofensivos pero que esconden bases militares. Las Sombras son construidas con el fin de proteger los planetas de incursiones, cogiendo por sorpresa a los invasores debido al metódico camuflaje de la nave.', TRUE, TRUE),
#..........................Supremas
(418, @SINRAZA, @NAVE, 'Ciudad Nox',500, '10000', '115000', '50000', '7200', 'Los Nox son tan tecnológicamente avanzados que son capaces de revivir a los muertos y de hacer invisible cualquier objeto. Son no intervencionistas extremos, sienten la obligació n moral de ayudar ambos bandos de una contienda hasta que se alcance una decisió n equilibrada, no importa si un lado tiene malas intenciones. Su poderosa ciudad fue una vez una de las capitales de la Coalició n de las Cinco Grandes Razas y un bastió n defensivo.', TRUE, TRUE),


########################################  Defensa Stargate  ######################################################################################
(296, @SINRAZA, @DEFENSA, 'Campo de defensa eurondano', 255, '0', '10000', '10000', '65000', 'Enorme escudo que defiende la ciudad de una faccion combatiente de Euronda. Requiere cantidades ingentes de energia pero su resistencia es casi infinita.', FALSE, FALSE),
(438, @SINRAZA, @DEFENSA, 'Escudo de Praxyon',          255, '0', '10000', '10000', '65000', 'Praxyon es un planeta de la Vía Láctea donde se encuentra un puesto secreto de observación solar construído por los Antiguos. Baal utilizó este puesto de avanzada para viajar atrás en el tiempo utilizando las erupciones solares y así detener el programa Stargate de los Tauri.', FALSE, FALSE),
########################################  Defensa Terrestre  ######################################################################################
(291, @SINRAZA, @DEFENSA, 'Cañon flotante', 18, '300', '100',  '10', '1200', 'Cañones que estan adheridos a un globo teledirigido y que disparan desde el aire a objetivos en tierra.', FALSE, FALSE),
(290, @SINRAZA, @DEFENSA, 'Ente lantiana',       18, '250', '250',  '50', '1200', 'Defensa terrestre que los Antiguos colocaron en diversos planetas para protegerlos y a su vez evitar que sus habitantes abandonaran su planeta. Su invisibilidad y su aspecto atemorizador son un gran problema para los posibles atacantes.', TRUE, FALSE),
(293, @SINRAZA, @DEFENSA, 'Ente Coloso',         18, '350', '450',  '10', '1200', 'Enormes colosos hechos de materia pura que protegen emplazamientos sagrado. Tienen la habilidad de desaparecer a los ojos humanos.', TRUE, FALSE),
(186, @SINRAZA, @DEFENSA, 'Xenomorfo',           18, '400', '500',   '0', '1200', 'Evolución genética del insecto iratus creada por el semiWraith Michael. Son altamente agresivos y fuertes. De carácter depredador, cuentan con una habilidad natural para ocultarse en las sombras.', FALSE, FALSE),
(289, @SINRAZA, @DEFENSA, 'Caballero Negro',     18, '450', '550', '100', '1200', 'Defensas holograficas terrestres colocadas por los Antiguos para evitar la entrada en lugares donde habian ocultado secretos. Muy peligrosos en combate por Tierra e inmunes a las armas de fuego.', FALSE, FALSE),
(292, @SINRAZA, @DEFENSA, 'Torre de miniDrones', 18, '500', '600', '100', '1500', 'Torretas de asedio lantianas. Cuentan con una version mas pequeña de los drones comunes, que son altamente peligrosos para las tropas y carros terrestres enemigos.', FALSE, TRUE),
########################################  Defensa Aerea  ######################################################################################
(288, @SINRAZA, @DEFENSA, 'Cañón artesano',     25,  '600',   '80',    '5', '1800', 'Cañones que utilizan polvora para lanzar grandes rocas contra naves enemigas. Son eficaces a larga distancia y contra naves de pequeño tamaño.', FALSE, TRUE),
(300, @SINRAZA, @DEFENSA, 'Caza teledirigido',            30,  '600',  '400',    '0', '1800', 'Cazas formados por la nave un modulo independiente donde se encuentra la cabina de mando. Pueden ser dirigidos desde tierra de forma muy eficaz. La idea de que el piloto no sufre daños es una gran ventaja en combate.', FALSE, FALSE),
(294, @SINRAZA, @DEFENSA, 'Dragón',                 100, '2500', '2000', '1300', '1080', 'Defensa instaurada por la lantiana Morga Lefay para proteger el Sangreal. Son unas criaturas de gruesa piel y con la capacidad de volar, lo que las hace viables para derribar naves que entren en su espacio aéreo. Además, cuenta con un potente chorro de fuego que emana de su boca, capaz de fundir metal.', FALSE, FALSE),
(295, @SINRAZA, @DEFENSA, 'Cañon de iones tollano', 100, '3000', '2500',  '300', '1080', 'Potente cañon diseñado por los tollanos para defender su planeta. Uno solo de ellos puede derribar naves enemigas en orbita debido a su potente disparo de iones.', FALSE, FALSE),
(163, @SINRAZA, @DEFENSA, 'Cañón Antiaéreo Antiguo', 300, '10000', '10000', '300', '8400', 'Cañones de gran potencia diseñados por los Antiguos. Capaces de defender el planeta de las flotas enemigas que penetran en la atmósfera, con una gran potencia y cadencia de fuego pero un elevado consumo de energía.', FALSE, TRUE),
########################################  Defensa orbital  ######################################################################################
(439, @SINRAZA, @DEFENSA, 'Satélite Geldariano', 100, '5400', '2000', '1000', '5130', 'Satélites orbitales colocados por los habitantes de Geldar para defender su planeta.', FALSE, FALSE),
########################################  Heroes Defensa  ######################################################################################
(419, @SINRAZA, @DEFENSA, 'Plataforma de Lantea',            0,  '9000', '220000', '100000', '0', 'Plataforma de armas de Lantea', FALSE, TRUE),
(420, @SINRAZA, @DEFENSA, 'Plataforma de Lantis',            0,  '9000', '220000', '100000', '0', 'Plataforma de armas de Lantis', FALSE, TRUE),
(421, @SINRAZA, @DEFENSA, 'Plataforma de Proclarush Taonas', 0,  '9000', '220000', '100000', '0', 'Plataforma de armas de Lantea', FALSE, TRUE),
(422, @SINRAZA, @DEFENSA, 'Arma de Dakara',                  0, '11000', '270000', '120000', '0', 'La superarma Dakara es un dispositivo oculto capaz de reducir toda la materia en sus componentes elementales básicos, y reestructurar la misma. Se encuentra en el Templo de Dakara, un lugar sagrado para la Nación Libre Jaffa y la sede de su nuevo gobierno. Posee la capacidad para atravesar los escudos de todos los buques conocidos (incluyendo los de los Asgard y los buques de guerra Ori) que también funciona como un arma devastadora para matar a toda la tripulación de los buques en órbita o destruir toda la vida en la superficie de cientos de planetas en un momento.', FALSE, TRUE),
(423, @SINRAZA, @DEFENSA, 'Torre Centinela',                 0,  '8000', '200000',  '80000', '0', 'El Centinela es un dispositivo de defensa planetario creado por los Latonianos hace 500 años para defender su planeta de invasiones. Crea un haz de luz enorme que hiere a las unidades enemigas que atacan el planeta.', FALSE, TRUE),
(425, @SINRAZA, @DEFENSA, 'Plataforma de la Antártida', 0,  '9000', '220000', '100000', '0', 'Plataforma de armas de La Tierra', FALSE, TRUE),
(428, @SINRAZA, @DEFENSA, 'Plataforma enterrada',            0,  '6500', '150000',  '70000', '0', 'Plataforma de armas de Gohari', FALSE, TRUE);


################################################################################################################
#Creamos constantes de atributos de naves capturables para calcular los stats de sus equivalentes capturadas
################################################################################################################
#Puntos
SET @PUNTOS_BC303     = (SELECT puntos FROM unidad WHERE id =  '35');
SET @PUNTOS_BC304T    = (SELECT puntos FROM unidad WHERE id =  '36');
SET @PUNTOS_ALKESHG   = (SELECT puntos FROM unidad WHERE id =  '87');
SET @PUNTOS_HATAKG    = (SELECT puntos FROM unidad WHERE id =  '88');
SET @PUNTOS_NODRIZAG  = (SELECT puntos FROM unidad WHERE id =  '89');
SET @PUNTOS_BELIK     = (SELECT puntos FROM unidad WHERE id = '105');
SET @PUNTOS_JACKSON   = (SELECT puntos FROM unidad WHERE id = '106');
SET @PUNTOS_ONEILL    = (SELECT puntos FROM unidad WHERE id = '107');
SET @PUNTOS_ALKESHJ   = (SELECT puntos FROM unidad WHERE id = '136');
SET @PUNTOS_HATAKJ    = (SELECT puntos FROM unidad WHERE id = '137');
SET @PUNTOS_NODRIZAJ  = (SELECT puntos FROM unidad WHERE id = '138');
SET @PUNTOS_BC304A    = (SELECT puntos FROM unidad WHERE id = '167');
SET @PUNTOS_AURORA    = (SELECT puntos FROM unidad WHERE id = '168');
SET @PUNTOS_DARDO     = (SELECT puntos FROM unidad WHERE id = '187');
SET @PUNTOS_CRUCERW   = (SELECT puntos FROM unidad WHERE id = '189');
SET @PUNTOS_COLMENA   = (SELECT puntos FROM unidad WHERE id = '190');
SET @PUNTOS_INCURS    = (SELECT puntos FROM unidad WHERE id = '222');
SET @PUNTOS_GUERRA    = (SELECT puntos FROM unidad WHERE id = '223');
SET @PUNTOS_NAZIS     = (SELECT puntos FROM unidad WHERE id = '306');
#Ataque
SET @ATAQUE_BC303     = (SELECT ataque FROM unidad WHERE id =  '35');
SET @ATAQUE_BC304T    = (SELECT ataque FROM unidad WHERE id =  '36');
SET @ATAQUE_ALKESHG   = (SELECT ataque FROM unidad WHERE id =  '87');
SET @ATAQUE_HATAKG    = (SELECT ataque FROM unidad WHERE id =  '88');
SET @ATAQUE_NODRIZAG  = (SELECT ataque FROM unidad WHERE id =  '89');
SET @ATAQUE_BELIK     = (SELECT ataque FROM unidad WHERE id = '105');
SET @ATAQUE_JACKSON   = (SELECT ataque FROM unidad WHERE id = '106');
SET @ATAQUE_ONEILL    = (SELECT ataque FROM unidad WHERE id = '107');
SET @ATAQUE_ALKESHJ   = (SELECT ataque FROM unidad WHERE id = '136');
SET @ATAQUE_HATAKJ    = (SELECT ataque FROM unidad WHERE id = '137');
SET @ATAQUE_NODRIZAJ  = (SELECT ataque FROM unidad WHERE id = '138');
SET @ATAQUE_BC304A    = (SELECT ataque FROM unidad WHERE id = '167');
SET @ATAQUE_AURORA    = (SELECT ataque FROM unidad WHERE id = '168');
SET @ATAQUE_DARDO     = (SELECT ataque FROM unidad WHERE id = '187');
SET @ATAQUE_CRUCERW   = (SELECT ataque FROM unidad WHERE id = '189');
SET @ATAQUE_COLMENA   = (SELECT ataque FROM unidad WHERE id = '190');
SET @ATAQUE_INCURS    = (SELECT ataque FROM unidad WHERE id = '222');
SET @ATAQUE_GUERRA    = (SELECT ataque FROM unidad WHERE id = '223');
SET @ATAQUE_NAZIS     = (SELECT ataque FROM unidad WHERE id = '306');
#Resistencia
SET @VIDA_BC303     = (SELECT resistencia FROM unidad WHERE id =  '35');
SET @VIDA_BC304T    = (SELECT resistencia FROM unidad WHERE id =  '36');
SET @VIDA_ALKESHG   = (SELECT resistencia FROM unidad WHERE id =  '87');
SET @VIDA_HATAKG    = (SELECT resistencia FROM unidad WHERE id =  '88');
SET @VIDA_NODRIZAG  = (SELECT resistencia FROM unidad WHERE id =  '89');
SET @VIDA_BELIK     = (SELECT resistencia FROM unidad WHERE id = '105');
SET @VIDA_JACKSON   = (SELECT resistencia FROM unidad WHERE id = '106');
SET @VIDA_ONEILL    = (SELECT resistencia FROM unidad WHERE id = '107');
SET @VIDA_ALKESHJ   = (SELECT resistencia FROM unidad WHERE id = '136');
SET @VIDA_HATAKJ    = (SELECT resistencia FROM unidad WHERE id = '137');
SET @VIDA_NODRIZAJ  = (SELECT resistencia FROM unidad WHERE id = '138');
SET @VIDA_BC304A    = (SELECT resistencia FROM unidad WHERE id = '167');
SET @VIDA_AURORA    = (SELECT resistencia FROM unidad WHERE id = '168');
SET @VIDA_DARDO     = (SELECT resistencia FROM unidad WHERE id = '187');
SET @VIDA_CRUCERW   = (SELECT resistencia FROM unidad WHERE id = '189');
SET @VIDA_COLMENA   = (SELECT resistencia FROM unidad WHERE id = '190');
SET @VIDA_INCURS    = (SELECT resistencia FROM unidad WHERE id = '222');
SET @VIDA_GUERRA    = (SELECT resistencia FROM unidad WHERE id = '223');
SET @VIDA_NAZIS     = (SELECT resistencia FROM unidad WHERE id = '306');
#Escudo
SET @ESCUDO_BC303     = (SELECT escudo FROM unidad WHERE id =  '35');
SET @ESCUDO_BC304T    = (SELECT escudo FROM unidad WHERE id =  '36');
SET @ESCUDO_ALKESHG   = (SELECT escudo FROM unidad WHERE id =  '87');
SET @ESCUDO_HATAKG    = (SELECT escudo FROM unidad WHERE id =  '88');
SET @ESCUDO_NODRIZAG  = (SELECT escudo FROM unidad WHERE id =  '89');
SET @ESCUDO_BELIK     = (SELECT escudo FROM unidad WHERE id = '105');
SET @ESCUDO_JACKSON   = (SELECT escudo FROM unidad WHERE id = '106');
SET @ESCUDO_ONEILL    = (SELECT escudo FROM unidad WHERE id = '107');
SET @ESCUDO_ALKESHJ   = (SELECT escudo FROM unidad WHERE id = '136');
SET @ESCUDO_HATAKJ    = (SELECT escudo FROM unidad WHERE id = '137');
SET @ESCUDO_NODRIZAJ  = (SELECT escudo FROM unidad WHERE id = '138');
SET @ESCUDO_BC304A    = (SELECT escudo FROM unidad WHERE id = '167');
SET @ESCUDO_AURORA    = (SELECT escudo FROM unidad WHERE id = '168');
SET @ESCUDO_INCURS    = (SELECT escudo FROM unidad WHERE id = '222');
SET @ESCUDO_GUERRA    = (SELECT escudo FROM unidad WHERE id = '223');
SET @ESCUDO_NAZIS     = (SELECT escudo FROM unidad WHERE id = '306');

#Constante de Bajada
SET @CTE_TEMPORALES   = 0.70;
SET @CTE_CAPTURADAS   = 0.75;
SET @CTE_REPLICANTE   = 0.80;

#Constantes con la media de los atributos
SET @PUNTOS_COMBATE   = (SELECT ROUND(AVG(u.puntos))      FROM unidad as u WHERE u.id in ('3','43','118','144'));
SET @ATAQUE_COMBATE   = (SELECT ROUND(AVG(u.ataque))      FROM unidad as u WHERE u.id in ('3','43','118','144'));
SET @VIDA_COMBATE     = (SELECT ROUND(AVG(u.resistencia)) FROM unidad as u WHERE u.id in ('3','43','118','144'));
SET @ESCUDO_COMBATE   = (SELECT ROUND(AVG(u.escudo))      FROM unidad as u WHERE u.id in ('3','43','118','144'));

SET @PUNTOS_OFICIAL   = (SELECT ROUND(AVG(u.puntos))      FROM unidad as u WHERE u.id in ('6','50','100','119','146','198','211','174'));
SET @ATAQUE_OFICIAL   = (SELECT ROUND(AVG(u.ataque))      FROM unidad as u WHERE u.id in ('6','50','100','119','146','198','211','174'));
SET @VIDA_OFICIAL     = (SELECT ROUND(AVG(u.resistencia)) FROM unidad as u WHERE u.id in ('6','50','100','119','146','198','211','174'));
SET @ESCUDO_OFICIAL   = (SELECT ROUND(AVG(u.escudo))      FROM unidad as u WHERE u.id in ('6','50','100','119','146','198','211'));

SET @PUNTOS_CRUCERO   = (SELECT ROUND(AVG(u.puntos))      FROM unidad as u WHERE u.id in ('86','105','136','206', '189'));
SET @ATAQUE_CRUCERO   = (SELECT ROUND(AVG(u.ataque))      FROM unidad as u WHERE u.id in ('86','105','136','206', '189'));
SET @VIDA_CRUCERO     = (SELECT ROUND(AVG(u.resistencia)) FROM unidad as u WHERE u.id in ('86','105','136','206', '189'));
SET @ESCUDO_CRUCERO   = (SELECT ROUND(AVG(u.escudo))      FROM unidad as u WHERE u.id in ('86','105','136','206'));

SET @ATA_HERO_TEMP   = 1000;
SET @VID_HERO_TEMP   = 900;
SET @ESC_HERO_TEMP   = 250;

SET @PUNTOS_NODRIZA   = (SELECT ROUND(AVG(u.puntos))      FROM unidad as u WHERE u.id in ('35','36','88','106','137','167','207'));
SET @ATAQUE_NODRIZA   = (SELECT ROUND(AVG(u.ataque))      FROM unidad as u WHERE u.id in ('35','36','88','106','137','167','207'));
SET @VIDA_NODRIZA     = (SELECT ROUND(AVG(u.resistencia)) FROM unidad as u WHERE u.id in ('35','36','88','106','137','167','207'));
SET @ESCUDO_NODRIZA   = (SELECT ROUND(AVG(u.escudo))      FROM unidad as u WHERE u.id in ('35','36','88','106','137','167','207'));

SET @PUNTOS_INSIGNIA  = (SELECT ROUND(AVG(u.puntos))      FROM unidad as u WHERE u.id in ('107','89','138','168','190'));
SET @ATAQUE_INSIGNIA  = (SELECT ROUND(AVG(u.ataque))      FROM unidad as u WHERE u.id in ('107','89','138','168','190'));
SET @VIDA_INSIGNIA    = (SELECT ROUND(AVG(u.resistencia)) FROM unidad as u WHERE u.id in ('107','89','138','168','190'));
SET @ESCUDO_INSIGNIA  = (SELECT ROUND(AVG(u.escudo))      FROM unidad as u WHERE u.id in ('107','89','138','168'));


########################################################
# Unidades de los especiales............................
########################################################
INSERT INTO unidad (id, idRaza, idtipoUnidad, nombre, puntos, ataque, resistencia, escudo, tiempo, descripcion, invisible, atraviesaEscudo)
VALUES

#.........................................................................................................
#Especiales Tauri.........................................................................................
#.........................................................................................................

#--- Aliados Jaffa ---------------------------------------------------------------------------
(600, @SINRAZA, @SOLDADO, 'Guardia aliada', @PUNTOS_COMBATE 
                                              , @ATAQUE_COMBATE * 1.05
                                              , @VIDA_COMBATE   * 1.05
                                              , @ESCUDO_COMBATE * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(601, @SINRAZA, @SOLDADO, 'Jaffa de élite', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.05
                                              , @VIDA_OFICIAL   * 1.05
                                              , @ESCUDO_OFICIAL * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(602, @SINRAZA, @SOLDADO, 'Teal\'c de Chulak', 200
                                              , @ATA_HERO_TEMP
                                              , @VID_HERO_TEMP
                                              , @ESC_HERO_TEMP,
                                              '0', '.', FALSE, TRUE),

#--- Aliados Tokra ---------------------------------------------------------------------------
(603, @SINRAZA, @SOLDADO, 'Comando Tok\'Ra', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.08
                                              , @VIDA_COMBATE   * 1.08
                                              , @ESCUDO_COMBATE * 1.08,
                                              '0', '.', TRUE, FALSE),
                                              
(604, @SINRAZA, @SOLDADO, 'Asesino Tok\'Ra', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.08
                                              , @VIDA_OFICIAL   * 1.08
                                              , @ESCUDO_OFICIAL * 1.08,
                                              '0', '.', TRUE, FALSE),

#--- Naves Asgard ---------------------------------------------------------------------------
(605, @SINRAZA, @NAVE, 'Clase Beliksner',    @PUNTOS_BELIK  ,  @ATAQUE_BELIK   * @CTE_TEMPORALES, @VIDA_BELIK   * @CTE_TEMPORALES, @ESCUDO_BELIK   * @CTE_TEMPORALES ,  '0', '.', FALSE, FALSE),
(606, @SINRAZA, @NAVE, 'Clase Jackson',      @PUNTOS_JACKSON,  @ATAQUE_JACKSON * @CTE_TEMPORALES, @VIDA_JACKSON * @CTE_TEMPORALES, @ESCUDO_JACKSON * @CTE_TEMPORALES,   '0', '.', TRUE, FALSE),
(607, @SINRAZA, @NAVE, 'Clase O\'Neill', @PUNTOS_ONEILL ,  @ATAQUE_ONEILL  * @CTE_TEMPORALES, @VIDA_ONEILL  * @CTE_TEMPORALES, @ESCUDO_ONEILL  * @CTE_TEMPORALES,   '0', '.', FALSE, FALSE),

#--- Vengador ---------------------------------------------------------------------------
(661, @SINRAZA, @DEFENSA, 'Módulo del Vengador 2.0', 100, '0', '10000', '10000', '0', '.', FALSE, FALSE),

#.........................................................................................................
#Especiales Goauld........................................................................................
#.........................................................................................................

#--- Ashrak ---------------------------------------------------------------------------
(608, @SINRAZA, @SOLDADO, 'Ashrak', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.13
                                              , @VIDA_OFICIAL   * 1.13
                                              , @ESCUDO_OFICIAL * 1.13,
                                              '0', '.', TRUE, FALSE),

#--- Concilio Goauld ---------------------------------------------------------------------------

(609, @SINRAZA, @NAVE, 'Al\'kesh del Concilio', @PUNTOS_ALKESHG ,  @ATAQUE_ALKESHG  * @CTE_TEMPORALES,   @VIDA_ALKESHG * @CTE_TEMPORALES,   @ESCUDO_ALKESHG * @CTE_TEMPORALES,    '0', '.', TRUE, FALSE),
(610, @SINRAZA, @NAVE, 'Ha\'tak del Concilio',  @PUNTOS_HATAKG  ,  @ATAQUE_HATAKG   * @CTE_TEMPORALES,    @VIDA_HATAKG * @CTE_TEMPORALES,    @ESCUDO_HATAKG * @CTE_TEMPORALES,     '0', '.', FALSE, FALSE),
(611, @SINRAZA, @NAVE, 'Nodriza del Concilio',      @PUNTOS_NODRIZAG,  @ATAQUE_NODRIZAG * @CTE_TEMPORALES,  @VIDA_NODRIZAG * @CTE_TEMPORALES,  @ESCUDO_NODRIZAG * @CTE_TEMPORALES,   '0', '.', FALSE, FALSE),

#--- El Continuo ---------------------------------------------------------------------------
(664, @SINRAZA, @SOLDADO, 'Dis\'tra  de élite', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.17
                                              , @VIDA_OFICIAL   * 1.17
                                              , @ESCUDO_OFICIAL * 1.17,
                                              '0', '.', FALSE, FALSE),
                                              
(341, @SINRAZA, @SOLDADO, 'Teal\'c de Chulak', 200
                                              , @ATA_HERO_TEMP * 1.2
                                              , @VID_HERO_TEMP * 1.2
                                              , @ESC_HERO_TEMP * 1.2,
                                              '0', '.', FALSE, TRUE),

#--- El TRUST ---------------------------------------------------------------------------
(49,  @SINRAZA, @SOLDADO, 'Agente TRUST', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', TRUE, FALSE),

#.........................................................................................................
#Especiales Asgard........................................................................................
#.........................................................................................................

#--- Aliados Tauri
(612, @SINRAZA, @SOLDADO, 'Comando SG Tau\'ri', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.05
                                              , @VIDA_COMBATE   * 1.05
                                              , @ESCUDO_COMBATE * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(613, @SINRAZA, @SOLDADO, 'Oficial Tau\'ri', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.05
                                              , @VIDA_OFICIAL   * 1.05
                                              , @ESCUDO_OFICIAL * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(614, @SINRAZA, @SOLDADO, 'Coronel Jack O\'Neill', 200
                                              , @ATA_HERO_TEMP
                                              , @VID_HERO_TEMP
                                              , @ESC_HERO_TEMP,
                                              '0', '.', FALSE, TRUE),

#--- La Otra extirpe
(615, @SINRAZA, @SOLDADO, 'SuperSoldado Pegasus', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.13
                                              , @VIDA_OFICIAL   * 1.13
                                              , @ESCUDO_OFICIAL * 1.13,
                                              '0', '.', FALSE, TRUE),

#--- El Consejo Asgard
(616, @SINRAZA, @NAVE, 'Beliksner del Consejo',    @PUNTOS_BELIK  ,  @ATAQUE_BELIK   * @CTE_TEMPORALES,   @VIDA_BELIK * @CTE_TEMPORALES,   @ESCUDO_BELIK * @CTE_TEMPORALES ,  '0', '.', FALSE, FALSE),
(617, @SINRAZA, @NAVE, 'Jackson del Consejo',      @PUNTOS_JACKSON,  @ATAQUE_JACKSON * @CTE_TEMPORALES, @VIDA_JACKSON * @CTE_TEMPORALES, @ESCUDO_JACKSON * @CTE_TEMPORALES, '0', '.', TRUE, FALSE),
(618, @SINRAZA, @NAVE, 'O\'Neill del Consejo', @PUNTOS_ONEILL ,  @ATAQUE_ONEILL  * @CTE_TEMPORALES,  @VIDA_ONEILL * @CTE_TEMPORALES,  @ESCUDO_ONEILL *  @CTE_TEMPORALES, '0', '.', FALSE, FALSE),

#.........................................................................................................
#Especiales Jaffa.........................................................................................
#.........................................................................................................

#--- Aliados Tauri
(619, @SINRAZA, @SOLDADO, 'Comando SG Tau\'ri', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.05
                                              , @VIDA_COMBATE   * 1.05
                                              , @ESCUDO_COMBATE * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(620, @SINRAZA, @SOLDADO, 'Oficial Tau\'ri', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.05
                                              , @VIDA_OFICIAL   * 1.05
                                              , @ESCUDO_OFICIAL * 1.05,
                                              '0', '.', FALSE, FALSE),
                                              
(621, @SINRAZA, @SOLDADO, 'Coronel Jack O\'Neill', 200
                                              , @ATA_HERO_TEMP
                                              , @VID_HERO_TEMP
                                              , @ESC_HERO_TEMP,
                                              '0', '.', FALSE, TRUE),

#--- Sodan
(622, @SINRAZA, @SOLDADO, 'Sodan aliados', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.13
                                              , @VIDA_OFICIAL   * 1.13
                                              , @ESCUDO_OFICIAL * 1.13,
                                              '0', '.', TRUE, FALSE),

#--- Consejo Jaffa
(623, @SINRAZA, @NAVE, 'Al\'kesh del Consejo', @PUNTOS_ALKESHJ ,  @ATAQUE_ALKESHJ  * @CTE_TEMPORALES,   @VIDA_ALKESHJ * @CTE_TEMPORALES,   @ESCUDO_ALKESHJ * @CTE_TEMPORALES,    '0', '.', TRUE, FALSE),
(624, @SINRAZA, @NAVE, 'Ha\'tak del Consejo',  @PUNTOS_HATAKJ  ,  @ATAQUE_HATAKJ   * @CTE_TEMPORALES,    @VIDA_HATAKJ * @CTE_TEMPORALES,    @ESCUDO_HATAKJ * @CTE_TEMPORALES,     '0', '.', FALSE, FALSE),
(625, @SINRAZA, @NAVE, 'Nodriza del Consejo',      @PUNTOS_NODRIZAJ,  @ATAQUE_NODRIZAJ * @CTE_TEMPORALES,  @VIDA_NODRIZAJ * @CTE_TEMPORALES,  @ESCUDO_NODRIZAJ * @CTE_TEMPORALES,   '0', '.', FALSE, FALSE),

#--- Aliados Atlantis
(662, @SINRAZA, @SOLDADO, 'Marine de Atlantis', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.17
                                              , @VIDA_OFICIAL   * 1.17
                                              , @ESCUDO_OFICIAL * 1.17,
                                              '0', '.', FALSE, FALSE),
                                              
(663, @SINRAZA, @SOLDADO, 'Ronon Dex', 200
                                              , @ATA_HERO_TEMP * 1.2
                                              , @VID_HERO_TEMP * 1.2
                                              , @ESC_HERO_TEMP * 1.2,
                                              '0', '.', FALSE, TRUE),

#.........................................................................................................
#Especiales Atlantis......................................................................................
#.........................................................................................................

#--- Pueblos de Pegasus
(626, @SINRAZA, @SOLDADO, 'Comando Genii', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.06
                                              , @VIDA_COMBATE   * 1.06
                                              , @ESCUDO_COMBATE * 1.06,
                                              '0', '.', FALSE, FALSE),
                                              
(627, @SINRAZA, @SOLDADO, 'Oficial Satedano', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.06
                                              , @VIDA_OFICIAL   * 1.06
                                              , @ESCUDO_OFICIAL * 1.06,
                                              '0', '.', FALSE, FALSE),

#--- Trotamundos espaciales
(629, @SINRAZA, @NAVE, 'Crucero Traveller', @PUNTOS_CRUCERO, @ATAQUE_CRUCERO * @CTE_TEMPORALES,  @VIDA_CRUCERO * @CTE_TEMPORALES,  @ESCUDO_CRUCERO * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),
(630, @SINRAZA, @NAVE, 'Aurora Traveller',  @PUNTOS_AURORA , @ATAQUE_AURORA * @CTE_TEMPORALES,  @VIDA_AURORA * @CTE_TEMPORALES,  @ESCUDO_AURORA * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),

#--- Refuerzos Tauri
(658, @SINRAZA, @SOLDADO, 'Comando SG Tau\'ri', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.17
                                              , @VIDA_COMBATE   * 1.17
                                              , @ESCUDO_COMBATE * 1.17,
                                              '0', '.', FALSE, FALSE),
                                              
(659, @SINRAZA, @SOLDADO, 'Oficial Tau\'ri', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.17
                                              , @VIDA_OFICIAL   * 1.17
                                              , @ESCUDO_OFICIAL * 1.17,
                                              '0', '.', FALSE, FALSE),
                                              
(660, @SINRAZA, @SOLDADO, 'General Jack O\'Neill', 200
                                              , @ATA_HERO_TEMP * 1.3
                                              , @VID_HERO_TEMP * 1.3
                                              , @ESC_HERO_TEMP * 1.3,
                                              '0', '.', FALSE, TRUE),

#.........................................................................................................
#Especiales Wraith........................................................................................
#.........................................................................................................

#--- Partida de Caza
(631, @SINRAZA, @SOLDADO, 'Cazador Experto', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.13
                                              , ((50 * @ESCUDO_OFICIAL + 30 * @VIDA_OFICIAL)/30)* 1.13
                                              , '0',
                                              '0', '.', FALSE, FALSE),

#--- Despertar
(632, @SINRAZA, @NAVE, 'Dardo',         @PUNTOS_DARDO  ,  @ATAQUE_DARDO   * @CTE_TEMPORALES,  @VIDA_DARDO   * @CTE_TEMPORALES, '0',  '0', '.', FALSE, FALSE),
(633, @SINRAZA, @NAVE, 'Crucero',       @PUNTOS_CRUCERW,  @ATAQUE_CRUCERW * @CTE_TEMPORALES,  @VIDA_CRUCERW * @CTE_TEMPORALES, '0',  '0', '.', FALSE, FALSE),
(634, @SINRAZA, @NAVE, 'Nave Colmena',  @PUNTOS_COLMENA,  @ATAQUE_COLMENA * @CTE_TEMPORALES,  @VIDA_COLMENA * @CTE_TEMPORALES, '0',  '0', '.', FALSE, FALSE),

#.........................................................................................................
#Especiales Ori......................................................................................
#.........................................................................................................

#--- Doctrina
(636, @SINRAZA, @SOLDADO, 'Seguidor Vikingo', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.06
                                              , @VIDA_COMBATE   * 1.06
                                              , @ESCUDO_COMBATE * 1.06,
                                              '0', '.', FALSE, FALSE),
                                              
(637, @SINRAZA, @SOLDADO, 'Seguidor Reetu', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.05
                                              , @VIDA_OFICIAL   * 1.05
                                              , @ESCUDO_OFICIAL * 1.05,
                                              '0', '.', TRUE, FALSE),

#--- Aliados Jaffa
(638, @SINRAZA, @SOLDADO, 'Guardia de Origen', @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.08
                                              , @VIDA_COMBATE   * 1.08
                                              , @ESCUDO_COMBATE * 1.08,
                                              '0', '.', FALSE, FALSE),
                                              
(639, @SINRAZA, @SOLDADO, 'Primado de Origen', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.08
                                              , @VIDA_OFICIAL   * 1.08
                                              , @ESCUDO_OFICIAL * 1.08,
                                              '0', '.', FALSE, FALSE),

#--- Camino origen
(640, @SINRAZA, @NAVE, 'Cazas de incursión', @PUNTOS_INCURS,  @ATAQUE_INCURS * @CTE_TEMPORALES,   @VIDA_INCURS * @CTE_TEMPORALES,   @ESCUDO_INCURS * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),
(641, @SINRAZA, @NAVE, 'Nave de Guerra',          @PUNTOS_GUERRA,  @ATAQUE_GUERRA * @CTE_TEMPORALES,   @VIDA_GUERRA * @CTE_TEMPORALES,   @ESCUDO_GUERRA * @CTE_TEMPORALES, '0', '.', FALSE, TRUE),

#.........................................................................................................
#Especiales Replicantes...................................................................................
#.........................................................................................................

#--- Combatientes
(642, @SINRAZA, @SOLDADO, 'Exoesqueleto replicante', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.13
                                              , @VIDA_OFICIAL   * 1.13
                                              , @ESCUDO_OFICIAL * 1.13,
                                              '0', '.', FALSE, FALSE),

#--- Familia
(650, @SINRAZA, @SOLDADO, 'Replicante Humanoide', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', TRUE, FALSE),

#--- Convocar Flota
(643, @SINRAZA, @NAVE, 'Replicante Crucero', @PUNTOS_CRUCERO, '1200', '3375', '263', '0', '.', FALSE, FALSE),
(644, @SINRAZA, @NAVE, 'Replicante Nave',    @PUNTOS_NODRIZA, '1875', '5250', '525', '0', '.', FALSE, FALSE),

#.........................................................................................................
#Especiales Planetas......................................................................................
#.........................................................................................................

#--- IOA Comun para Tauri y Atlantis
(665, @SINRAZA, @SOLDADO, 'Agente táctico', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', FALSE, FALSE),
                                              
(666, @SINRAZA, @SOLDADO, 'Agente Especial Bates', 200
                                              , @ATA_HERO_TEMP * 1.2
                                              , @VID_HERO_TEMP * 1.2
                                              , @ESC_HERO_TEMP * 1.2,
                                              '0', '.', FALSE, TRUE),

(628, @SINRAZA, @SOLDADO, 'Agente táctico', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', FALSE, FALSE),
                                              
(635, @SINRAZA, @SOLDADO, 'Agente Especial Bates', 200
                                              , @ATA_HERO_TEMP * 1.2
                                              , @VID_HERO_TEMP * 1.2
                                              , @ESC_HERO_TEMP * 1.2,
                                              '0', '.', FALSE, TRUE),

#--- Alianza Unas (Chaka)
(645, @SINRAZA, @SOLDADO, 'Unas de Chaka', @PUNTOS_OFICIAL
                                              , @ATAQUE_COMBATE * 1.22
                                              , @VIDA_COMBATE   * 1.22
                                              , @ESCUDO_COMBATE * 1.22,
                                              '0', '.', FALSE, FALSE),
#--- Alianza Unas (Planeta)
(646, @SINRAZA, @SOLDADO, 'Unas silvestre', @PUNTOS_OFICIAL
                                              , @ATAQUE_COMBATE * 1.22
                                              , @VIDA_COMBATE   * 1.22
                                              , @ESCUDO_COMBATE * 1.22,
                                              '0', '.', FALSE, FALSE),
#--- Plan de Anubis (Planeta)
(647, @SINRAZA, @SOLDADO, 'Siervo de Tartaro', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.17
                                              , @VIDA_OFICIAL   * 1.17
                                              , @ESCUDO_OFICIAL * 1.17,
                                              '0', '.', FALSE, TRUE),
#--- Otra forma de...
(649, @SINRAZA, @SOLDADO, 'Agente Black Op NID', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', TRUE, FALSE),
#--- Aliens de Michael
(651, @SINRAZA, @DEFENSA, 'Xenomorfo', @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.22
                                              , @VIDA_OFICIAL   * 1.22
                                              , @ESCUDO_OFICIAL * 1.22,
                                              '0', '.', TRUE, FALSE),
#--- Ascendido de Kheb
(652, @SINRAZA, @SOLDADO, 'Ser Ascendido', 300, '5000', '10000', '5000', '0', 'Ser ascendido que oculto el Sangreal por diferentes planetas con pruebas. Una gran luchadora, Morgana se siente en conflicto con sus hermanos ascendidos por estar en contra de la norma de no intervancion en los planso inferiores de existencia. En la cultura popular, Morgana ha sido desde siempre una de las hechiceras más famosas y poderosas de la literatura occidental; siendo para muchos la clara personificación del mal, el odio y la venganza, así como la belleza ardiente, el deseo, la tentación y, por encima de todo, la pasión.', TRUE, TRUE),

#--- Naves de la Alianza Lucian
(653, @SINRAZA, @NAVE, 'Al\'kesh Lucian', @PUNTOS_ALKESHJ, ((@ATAQUE_ALKESHJ + @ATAQUE_ALKESHG)/2) * @CTE_TEMPORALES, ((@VIDA_ALKESHJ + @VIDA_ALKESHG)/2) * @CTE_TEMPORALES, ((@ESCUDO_ALKESHJ + @ESCUDO_ALKESHG)/2) * @CTE_TEMPORALES, '0', '.', TRUE, FALSE),
(654, @SINRAZA, @NAVE, 'Ha\'tak Lucian',  @PUNTOS_HATAKJ , ((@ATAQUE_HATAKJ  + @ATAQUE_HATAKG)/2)  * @CTE_TEMPORALES,  ((@VIDA_HATAKJ  + @VIDA_HATAKG)/2) * @CTE_TEMPORALES,  ((@ESCUDO_HATAKJ  + @ESCUDO_HATAKG)/2) * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),
(398, @SINRAZA, @NAVE, 'Nave de Netan',       300, '1500',  '4000',  '300', '0', '.', FALSE, TRUE),

#--- Naves Traveller
(655, @SINRAZA, @NAVE, 'Crucero Traveller', @PUNTOS_CRUCERO, @ATAQUE_CRUCERO * @CTE_TEMPORALES,  @VIDA_CRUCERO * @CTE_TEMPORALES,  @ESCUDO_CRUCERO * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),
(656, @SINRAZA, @NAVE, 'Aurora Traveller',  @PUNTOS_AURORA , @ATAQUE_AURORA * @CTE_TEMPORALES,  @VIDA_AURORA * @CTE_TEMPORALES,  @ESCUDO_AURORA * @CTE_TEMPORALES, '0', '.', FALSE, FALSE),

#--- Drones
(657, @SINRAZA, @NAVE, 'Dron Berzerker', @PUNTOS_CRUCERO, '1400', '700', FALSE, FALSE, '.', FALSE, FALSE);

#...........................................................................................

########################################################
# Unidades de capturas..................................
########################################################
INSERT INTO unidad (id, idRaza, idtipoUnidad, nombre, puntos, ataque, resistencia, escudo, tiempo, descripcion, invisible, atraviesaEscudo)
VALUES
########################################################
#################Tropas#################################
########################################################
#........Combate.........................................
#Tauri
(451, @SINRAZA, @SOLDADO, 'Recluta Jaffa',       @PUNTOS_COMBATE, @ATAQUE_COMBATE, @VIDA_COMBATE,  @ESCUDO_COMBATE, '0', '.', FALSE, FALSE),
#Goauld
(452, @SINRAZA, @SOLDADO, 'Lo\'taur',        @PUNTOS_COMBATE, @ATAQUE_COMBATE, @VIDA_COMBATE,  @ESCUDO_COMBATE, '0', '.', FALSE, FALSE),
#Atlantis
(453, @SINRAZA, @SOLDADO, 'Comando Atlantis',    @PUNTOS_COMBATE, @ATAQUE_COMBATE, @VIDA_COMBATE,  @ESCUDO_COMBATE, '0', '.', FALSE, FALSE),
#Jaffa
(454, @SINRAZA, @SOLDADO, 'Jaffa Guardián', @PUNTOS_COMBATE, @ATAQUE_COMBATE, @VIDA_COMBATE,  @ESCUDO_COMBATE, '0', '.', FALSE, FALSE),
#Wraith
(455, @SINRAZA, @SOLDADO, 'Wraith Iratus',       @PUNTOS_COMBATE, @ATAQUE_COMBATE, (50 * @ESCUDO_OFICIAL + 30 * @VIDA_OFICIAL)/30, FALSE, FALSE, '.', FALSE, FALSE),
#Ori
(457, @SINRAZA, @SOLDADO, 'Guerrero Origen',     @PUNTOS_COMBATE, @ATAQUE_COMBATE, @VIDA_COMBATE,  @ESCUDO_COMBATE, '0', '.', FALSE, FALSE),

###Planetas
(440, @SINRAZA, @SOLDADO, 'Guardia Real',  @PUNTOS_COMBATE
                                              , @ATAQUE_COMBATE * 1.22
                                              , @VIDA_COMBATE   * 1.22
                                              , @ESCUDO_COMBATE * 1.22,
                                              '0', '.', FALSE, FALSE),

#........Oficial.........................................
#Tauri
(458, @SINRAZA, @SOLDADO, 'Jaffa SGC',            @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
#Goauld
(417, @SINRAZA, @SOLDADO, 'Soldado Goa\'uld', @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
(77,  @SINRAZA, @SOLDADO, 'Wraith Goa\'uld',  @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
#Atlantis
(145, @SINRAZA, @SOLDADO, 'Humano Espectro',      @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
#Jaffa
(459, @SINRAZA, @SOLDADO, 'Jaffa Cónsul',    @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
#Wraith
(460, @SINRAZA, @SOLDADO, 'Wraith Centinela',     @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, (50 * @ESCUDO_OFICIAL + 30 * @VIDA_OFICIAL)/30,  FALSE, FALSE, '.', FALSE, FALSE),
#Replicante
(200, @SINRAZA, @SOLDADO, 'Humanoide replicante', @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),
#Ori
(461, @SINRAZA, @SOLDADO, 'Converso',             @PUNTOS_OFICIAL, @ATAQUE_OFICIAL, @VIDA_OFICIAL,  @ESCUDO_OFICIAL, '0', '.', FALSE, FALSE),

###Planetas
(436, @SINRAZA, @SOLDADO, 'Antiguo Anfitrión', @PUNTOS_OFICIAL  
                                              , @ATAQUE_OFICIAL * 1.07
                                              , @VIDA_OFICIAL   * 1.07
                                              , @ESCUDO_OFICIAL * 1.07,
                                              '0', '.', FALSE, FALSE),
                                              
(347, @SINRAZA, @SOLDADO, 'Adoradores Wraith',      @PUNTOS_OFICIAL
                                              , @ATAQUE_OFICIAL * 1.07
                                              , @VIDA_OFICIAL   * 1.07
                                              , @ESCUDO_OFICIAL * 1.07,
                                              '0', '.', FALSE, FALSE),

#........De Heroes.........................................
#Goauld
(54,  @SINRAZA, @SOLDADO, 'Arqueólogo Goa\'uld', 50, '125', '900', '100', '0', 'Experto en arqueologia, cultura y lenguas antiguas. Acompaña a las tropas Goa\'uld para encontrar recursos vitales de otros mundos y robar nuevos avances.', FALSE, FALSE),
(55,  @SINRAZA, @SOLDADO, 'Científico Goa\'uld', 50, '300', '900', '100', '0', 'Unidad cientifico-militar experta en investigación y desarrollo de tecnologías alienígenas.', FALSE, FALSE),
(56,  @SINRAZA, @SOLDADO, 'Militar Goa\'uld',         50, '400', '900', '100', '0', 'Hombre leal y con gran sentido del deber. Fue poseido por una larva Goa\'uld durante la segunda mision del SGC a Chulak. Actuó a modo de espía en las filas Tau\'ri. Cuando fué descubierto, intentó escapar hacia Chulak por la puerta.', FALSE, FALSE),
(58,  @SINRAZA, @SOLDADO, 'Reina de Apophis',             50, '400', '900', '100', '0', 'Es la Reina Goa\'uld de Apophis, que tomó como anfitriona a la hija del Rey de Abydos, Sha\'re que era la esposa del Dr. Daniel Jackson. Es la madre del Hersissus, Shifú. Amonet "la Oculta", es una diosa protectora y primordial de lo oculto en la mitología egipcia; personifica el viento del norte, el que trae la vida.', FALSE, FALSE),
(66,  @SINRAZA, @SOLDADO, 'Primado',                      50, '500', '900', '100', '0', 'Goa\'uld menor que tomo como anfitrión a su primado humano, K\'tano para poder infiltrarse como líder en la rebelion Jaffa contra los Goa\'uld. Adquirio de este sus excelsas habilidades para el combate cuerpo a cuerpo. Imhotep fue un sabio, médico, astrólogo, y el primer arquitecto conocido en la historia. Sumo sacerdote de Heliópolis, fue visir del faraón Necherjet Dyeser, y diseñó la Pirámide escalonada de Saqqara, durante la dinastía III.', FALSE, TRUE),
(67,  @SINRAZA, @SOLDADO, 'Príncipe de Abydos',      50, '400', '900', '100', '0', 'Goa\'uld menor, hijo de Apophis, que tomo como anfitrión al príncipe de Nagada, Skaara. Para ganarse el respeto de su padre, Klorel se unió a él en una campaña militar contra La Tierra.', FALSE, FALSE),
(72,  @SINRAZA, @SOLDADO, 'Reina Goa\'uld',           50, '400', '900', '100', '0', 'Goa\'uld menor al servicio de Camulus, Qetesh goberno con tiranía en las minas de naquadad de varios mundos. Es experta en métodos de tortura y no vacila en aplicar ejecuciones masivas. En la mitología Egipcia y en la religión de Canaan, Qetesh se refiere a la diosa del amor y la belleza. Originalmente era una divinidad semítica de la religión de Canaan y adoptada un tiempo mas tarde por el panteón egipcio.', FALSE, FALSE),
(70,  @SINRAZA, @SOLDADO, 'Orici Goa\'uld',           50, '600', '900', '100', '0', 'Adria es el agente humano de los Ori creado para Líderar a los Priores y el ejército de los Ori en una campaña para la dominación galáctica. Fue modificada genéticamente para que su fisiología fuera la mas cercana a los Antiguos posible, esto fue requerido para que pudiera alojar el conocimiento de los Ori, que le da poderes realmente asombrosos comvirtiendose asi en un anfitrión perfecto para cualquier Goa\'uld fuerte que pueda dominar su cuerpo.', FALSE, TRUE),
#Atlantis
(151, @SINRAZA, @SOLDADO, 'Teniente',        50, '500', '900', '50', '0', 'Miembro militar de la expedicion Atlantis. Durante una misión de infiltracion a una nave Wraith, fue golpeado, lo que el causo problemas graves de memoria. ', FALSE, FALSE),
#Wraith
(179, @SINRAZA, @SOLDADO, 'Humano Iratus',         50,  '600',  '900', FALSE, FALSE, 'Mutacion entre el ADN del Coronel Sheppard y un hibrido iratus alcanzada cuando un Wraith mutado con el retrovirus mordio al coronel. Esta fusion doto a Sheppard de poderes fisicos sobrehumanos propios de los insectos. A medida que estos crecian, desaparecia toda capacidad de raciocionio humano en el sujeto. ', FALSE, TRUE),
(180, @SINRAZA, @SOLDADO, 'Reina Athosiana',       50,  '650',  '900', FALSE, FALSE, 'Líder del pueblo athosiano y nativa del planeta Athos. Refugio a su pueblo en la Ciudad de Atlantis, y alli altero su ADN para convertirse en reina Wraith de la Colmena de Todd. Esta altamente adiestrada en combate cuerpo a cuerpo.', FALSE, TRUE),
(348, @SINRAZA, @SOLDADO, 'Especialista Satedano', 50,  '700',  '900', '5', '0', 'Antiguo militar del planeta Sateda y antiguo corredor. Fue capturado por los Wraith tiempo despues para someterle a una tortura y tratamiento que acabo por convertirle en un siervo de los espectros. Domina casi cualquier modalidad de lucha cuerpo a cuerpo y valora mucho el honor y la lealtad.', FALSE, TRUE),
#Ori
(213, @SINRAZA, @SOLDADO, 'Prior Tau\'ri', 50, '650', '900', '100', '0', 'Cuando Daniel albergo la mente de Merlin, fue capaz de engañar a la Orici para que pudiera construir el arma para destruir seres ascendidos. Sin embargo, fue convertido en sacerdote y estuvo dedicado a difundir la palabra de Origen por toda la galaxia, enseñan a los pueblos la doctrina del libro de Origen y reclutan nuevos fieles a la causa de los Ori. Sin embargo, Daniel no utiliza amenazas y sigue las enseñanzas del libro de Origen de forma cortes y diplomatica.', FALSE, TRUE),
(215, @SINRAZA, @SOLDADO, 'Prior Jaffa',       50, '500', '900', '100', '0', 'Jaffa que acepto convertirse en Prior, para adoctrinar a su raza para seguir a los Ori. Forma parte del la faccion tradicionalista del consejo que rechaza cualquier ayuda Tau\'ri y Tok\'ra. Un guerrero desde su mas tierna infancia, Gerak es considerado uno de los Jaffas mas prestigiosos de toda la galaxia.', FALSE, TRUE),
(336, @SINRAZA, @SOLDADO, 'Sacerdotisa',       50, '500', '900', '100', '0', 'Tras un accidente durante la destrucción de SuperStargate, Vala fue enviada a una lejana Galaxia. Allí fue elegida por los Ori para dar a luz a su representante en el plano de existencia mortal, la Orici. Tras ser convencida por la Orici para unirse a los Ori, actua como general y es alabada como la madre de la Líder suprema de los Ori.', FALSE, TRUE),

###Planetas
(350, @SINRAZA, @SOLDADO, 'Androide de Jack O\'Neill',  50, '750', '900',  '10',    '0', 'Cuando el SG-1 visitó el planeta de Harlan, éste creo clones roboticos identicos a ellos para ayudarle en su fabrica. El SG-1 robotico consiguio escapar pero al poseer la memoria de los autenticos no conocian su naturaleza robotica.', FALSE, TRUE),

########################################################
#################Naves##################################
########################################################
#Replicantes
#..
(359, @SINRAZA, @NAVE, 'Replicante BC-303',       
      @PUNTOS_BC303,   
      ROUND(@ATAQUE_BC303 * @CTE_REPLICANTE), 
      ROUND(@VIDA_BC303   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_BC303 * @CTE_REPLICANTE), 
      '0', '.', FALSE, FALSE),
#..
(360, @SINRAZA, @NAVE, 'Replicante BC-304',       
      ROUND((@PUNTOS_BC304T  + @PUNTOS_BC304A)/2),   
      ROUND(((@ATAQUE_BC304T + @ATAQUE_BC304A)/2) * @CTE_REPLICANTE), 
      ROUND(((@VIDA_BC304T   + @VIDA_BC304A)/2)   * @CTE_REPLICANTE), 
      ROUND(((@ESCUDO_BC304T + @ESCUDO_BC304A)/2) * @CTE_REPLICANTE),  
      '0', '.', FALSE, FALSE),
#..
(361, @SINRAZA, @NAVE, 'Replicante Ha\'tak',   
      ROUND((@PUNTOS_HATAKJ  + @PUNTOS_HATAKG)/2),   
      ROUND(((@ATAQUE_HATAKJ + @ATAQUE_HATAKG)/2) * @CTE_REPLICANTE), 
      ROUND(((@VIDA_HATAKJ   + @VIDA_HATAKG)/2)   * @CTE_REPLICANTE), 
      ROUND(((@ESCUDO_HATAKJ + @ESCUDO_HATAKG)/2) * @CTE_REPLICANTE),  
      '0', '.', FALSE, FALSE),
#..
(362, @SINRAZA, @NAVE, 'Replicante Piramide',     
      ROUND((@PUNTOS_NODRIZAJ  + @PUNTOS_NODRIZAG)/2),   
      ROUND(((@ATAQUE_NODRIZAJ + @ATAQUE_NODRIZAG)/2) * @CTE_REPLICANTE), 
      ROUND(((@VIDA_NODRIZAJ   + @VIDA_NODRIZAG)/2)   * @CTE_REPLICANTE), 
      ROUND(((@ESCUDO_NODRIZAJ + @ESCUDO_NODRIZAG)/2) * @CTE_REPLICANTE),  
      '0', '.', FALSE, FALSE),
#..
(364, @SINRAZA, @NAVE, 'Replicante Jackson',
      @PUNTOS_JACKSON,   
      ROUND(@ATAQUE_JACKSON * @CTE_REPLICANTE), 
      ROUND(@VIDA_JACKSON   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_JACKSON * @CTE_REPLICANTE), 
      '0', '.', TRUE, FALSE),
#..
(365, @SINRAZA, @NAVE, 'Replicante O\'Neill', 
      @PUNTOS_ONEILL,   
      ROUND(@ATAQUE_ONEILL * @CTE_REPLICANTE), 
      ROUND(@VIDA_ONEILL   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_ONEILL * @CTE_REPLICANTE), 
      '0', '.', FALSE, FALSE),
#..
(366, @SINRAZA, @NAVE, 'Replicante Aurora',
      @PUNTOS_AURORA,   
      ROUND(@ATAQUE_AURORA * @CTE_REPLICANTE), 
      ROUND(@VIDA_AURORA   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_AURORA * @CTE_REPLICANTE), 
      '0', '.', FALSE, FALSE),
#..
(367, @SINRAZA, @NAVE, 'Replicante Ori',
      @PUNTOS_GUERRA,   
      ROUND(@ATAQUE_GUERRA * @CTE_REPLICANTE), 
      ROUND(@VIDA_GUERRA   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_GUERRA * @CTE_REPLICANTE), 
      '0', '.', FALSE, TRUE),
#..
(441, @SINRAZA, @NAVE, 'Replicante ?',
      @PUNTOS_NAZIS,   
      ROUND(@ATAQUE_NAZIS * @CTE_REPLICANTE), 
      ROUND(@VIDA_NAZIS   * @CTE_REPLICANTE), 
      ROUND(@ESCUDO_NAZIS * @CTE_REPLICANTE), 
      '0', '.', FALSE, FALSE),
#...............................................................................................................
#...............................................................................................................
#Goauld
(96,  @SINRAZA, @NAVE, 'Clase Dédalo',
      ROUND((@PUNTOS_BC304T  + @PUNTOS_BC304A)/2),   
      ROUND(((@ATAQUE_BC304T + @ATAQUE_BC304A)/2) * @CTE_CAPTURADAS), 
      ROUND(((@VIDA_BC304T   + @VIDA_BC304A)/2)   * @CTE_CAPTURADAS), 
      ROUND(((@ESCUDO_BC304T + @ESCUDO_BC304A)/2) * @CTE_CAPTURADAS),  
      '0', '.', FALSE, FALSE),
#..
(97,  @SINRAZA, @NAVE, 'Nave Ori de Ba\'al',
      @PUNTOS_GUERRA,   
      ROUND(@ATAQUE_GUERRA * @CTE_CAPTURADAS), 
      ROUND(@VIDA_GUERRA   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_GUERRA * @CTE_CAPTURADAS), 
      '0', '.', FALSE, TRUE),
#...............................................................................................................
#Wraith
(351, @SINRAZA, @NAVE, 'Clase Dédalo',
      ROUND((@PUNTOS_BC304T  + @PUNTOS_BC304A)/2),   
      ROUND(((@ATAQUE_BC304T + @ATAQUE_BC304A)/2) * @CTE_CAPTURADAS), 
      ROUND(((@VIDA_BC304T   + @VIDA_BC304A)/2)   * @CTE_CAPTURADAS), 
      ROUND(((@ESCUDO_BC304T + @ESCUDO_BC304A)/2) * @CTE_CAPTURADAS),  
      '0', '.', FALSE, FALSE),
#...............................................................................................................
#Ori
(224, @SINRAZA, @NAVE, 'Ha\'tak del consejo Jaffa',
      @PUNTOS_HATAKJ,   
      ROUND(@ATAQUE_HATAKJ * @CTE_CAPTURADAS), 
      ROUND(@VIDA_HATAKJ   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_HATAKJ * @CTE_CAPTURADAS), 
      '0', '.', FALSE, FALSE),
#...............................................................................................................
#...............................................................................................................
#...............................................................................................................
#Genericas
(667, @SINRAZA, @NAVE, 'BC-303',
      @PUNTOS_BC303,   
      ROUND(@ATAQUE_BC303 * @CTE_CAPTURADAS), 
      ROUND(@VIDA_BC303   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_BC303 * @CTE_CAPTURADAS), 
      '0', '.', FALSE, FALSE),
#..
(668, @SINRAZA, @NAVE, 'BC-304',
      ROUND((@PUNTOS_BC304T  + @PUNTOS_BC304A)/2),   
      ROUND(((@ATAQUE_BC304T + @ATAQUE_BC304A)/2) * @CTE_CAPTURADAS), 
      ROUND(((@VIDA_BC304T   + @VIDA_BC304A)/2)   * @CTE_CAPTURADAS), 
      ROUND(((@ESCUDO_BC304T + @ESCUDO_BC304A)/2) * @CTE_CAPTURADAS),  
      '0', '.', FALSE, FALSE),
#..
(669, @SINRAZA, @NAVE, 'Ha\'tak',
      ROUND((@PUNTOS_HATAKJ  + @PUNTOS_HATAKG)/2),   
      ROUND(((@ATAQUE_HATAKJ + @ATAQUE_HATAKG)/2) * @CTE_CAPTURADAS), 
      ROUND(((@VIDA_HATAKJ   + @VIDA_HATAKG)/2)   * @CTE_CAPTURADAS), 
      ROUND(((@ESCUDO_HATAKJ + @ESCUDO_HATAKG)/2) * @CTE_CAPTURADAS),  
      '0', '.', FALSE, FALSE),
#..
(670, @SINRAZA, @NAVE, 'Nave Palacio',
      ROUND((@PUNTOS_NODRIZAJ  + @PUNTOS_NODRIZAG)/2),   
      ROUND(((@ATAQUE_NODRIZAJ + @ATAQUE_NODRIZAG)/2) * @CTE_CAPTURADAS), 
      ROUND(((@VIDA_NODRIZAJ   + @VIDA_NODRIZAG)/2)   * @CTE_CAPTURADAS), 
      ROUND(((@ESCUDO_NODRIZAJ + @ESCUDO_NODRIZAG)/2) * @CTE_CAPTURADAS),  
      '0', '.', FALSE, FALSE),
#..
(671, @SINRAZA, @NAVE, 'Jackson',
      @PUNTOS_JACKSON,   
      ROUND(@ATAQUE_JACKSON * @CTE_CAPTURADAS), 
      ROUND(@VIDA_JACKSON   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_JACKSON * @CTE_CAPTURADAS), 
      '0', '.', TRUE, FALSE),
#..
(672, @SINRAZA, @NAVE, 'O\'Neill',
      @PUNTOS_ONEILL,   
      ROUND(@ATAQUE_ONEILL * @CTE_CAPTURADAS), 
      ROUND(@VIDA_ONEILL   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_ONEILL * @CTE_CAPTURADAS), 
      '0', '.', FALSE, FALSE),
#..
(673, @SINRAZA, @NAVE, 'Aurora',
      @PUNTOS_AURORA,   
      ROUND(@ATAQUE_AURORA * @CTE_CAPTURADAS), 
      ROUND(@VIDA_AURORA   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_AURORA * @CTE_CAPTURADAS), 
      '0', '.', FALSE, FALSE),
#..
(674, @SINRAZA, @NAVE, 'Nave de Guerra',
      @PUNTOS_GUERRA,   
      ROUND(@ATAQUE_GUERRA * @CTE_CAPTURADAS), 
      ROUND(@VIDA_GUERRA   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_GUERRA * @CTE_CAPTURADAS), 
      '0', '.', FALSE, TRUE),
#..
(675, @SINRAZA, @NAVE, '?',
      @PUNTOS_NAZIS,   
      ROUND(@ATAQUE_NAZIS * @CTE_CAPTURADAS), 
      ROUND(@VIDA_NAZIS   * @CTE_CAPTURADAS), 
      ROUND(@ESCUDO_NAZIS * @CTE_CAPTURADAS), 
      '0', '.', FALSE, FALSE),
#..
(676, @SINRAZA, @NAVE, 'Nave Colmena',
      @PUNTOS_COLMENA,   
      ROUND(@ATAQUE_COLMENA * @CTE_CAPTURADAS), 
      ROUND(@VIDA_COLMENA   * @CTE_CAPTURADAS), 
      '0',
      '0', '.', FALSE, FALSE);




######Normales#########
#####Seguimiento de ids
#####Ultimo --> 461 (363, 456 falta)
#######################



######Especia.#########
#####Seguimiento de ids
#####Ultimo --> 676 (648 libre)
#######################


#############################################################################################################################################
## Naves
#############################################################################################################################################
#nave
INSERT INTO nave (idUnidad, idTipoNave, carga, stargate, hiperespacio, velocidad, cazas)
VALUES

########################################################
# Tauri.................................................
########################################################
('33', @CAZA,'0',0,0,'0','0'), #X-301
('34', @CAZAPESADO,'0',0,1,'20','0'), #F-302
('35', @NODRIZA,'700',0,1,'20','8'), #BC-303
('36', @NODRIZA,'100',0,1,'28','16'), #BC-304
('37', @NODRIZA,'300',0,1,'32','20'), #Prometeo
('39', @NODRIZA,'250',0,1,'37','30'), #Odisea
('339',@NODRIZA,'200',0,1,'35','30'), #USS George Hammond

('38', @NODRIZA,'250',0,1,'35','25'), #Korolev
('40', @NODRIZA,'150',0,1,'42','35'), #Fenix
('340',@NODRIZA,'200',0,1,'35','30'), #Sun Tzu
('355',@SUPREMA,'0',0,1,'50','100'), #Destiny
('356',@SUPREMA,'0',0,1,'50','0'), #BC-306

########################################################
# Goauld................................................
########################################################
('83', @CAZA,'0',0,0,'0','0'),  #Planeador de la muerte
('84', @CAZAPESADO,'0',1,0,'0','0'), #Aguja afilada
('86', @CRUCERO,'100',0,1,'15','0'), #Alkesh
('88', @NODRIZA,'600',0,1,'27','24'), #Hatak
('89', @INSIGNIA,'100',0,1,'24','60'), #Nave nodriza
('94', @INSIGNIA,'0',0,1,'1','200'), #Estación Hassara
('95', @INSIGNIA,'100',0,1,'24','200'), #Beelzebuth

('408',@SUPREMA,'0',0,1,'48','0'), #Nave de Anubis

('90',@SUPREMA,'900',0,1,'20','80'), #Sequito de Baal
('91',@SUPREMA,'300',0,1,'24','50'), #Nave imperial de Yu
('92',@SUPREMA,'200',0,1,'21','40'), #Nodriza de Apofhis
('93',@SUPREMA,'500',0,1,'15','60'), #Palacia de Ra
('96',@NODRIZA,'250',0,1,'35','30'), #Dedalo capturado
('97',@INSIGNIA,'500',0,1,'50','30'), #Nave Orici capturada
('442', @INSIGNIA,'100',0,1,'24','60'), #Nave Heruur

########################################################
# Asgard................................................
########################################################
('104',@CAZAPESADO,'250',0,1,'50','0'), #Nave de asalto
('105',@CRUCERO,'75',0,1,'32','0'), #Beliksner
('106',@NODRIZA,'450',0,1,'43','0'), #Jackson
('107',@INSIGNIA,'200',0,1,'40','0'), #Oneill
('108',@NODRIZA,'800',0,1,'45','0'), #Cientifico Heimdall
('109',@INSIGNIA,'200',0,1,'43','0'), #Valhalla
('112',@INSIGNIA,'0',0,1,'50','0'), #Comandante supremo Thor

('409',@SUPREMA,'0',0,1,'48','0'), #Palacio de Valaskjalf

('110',@INSIGNIA,'50',0,1,'40','0'), #Aeronave de Hermiod
('111',@INSIGNIA,'0',0,1,'45','0'), #Nave de Kvasir
('330',@NODRIZA,'600',0,1,'48','0'), #El carro de Thor
('405',@INSIGNIA,'200',0,1,'43','0'), #Alto consejero Freyr
('406',@INSIGNIA,'200',0,1,'43','0'), #Alto consejero Penegal
('407',@NODRIZA,'200',0,1,'43','0'), #Escuadron Vanir
('447',@NODRIZA,'450',0,1,'43','0'), #Loki

########################################################
# Jaffa.................................................
########################################################
('134',@CAZA,'0',0,0,'0','0'), #Udajeet
('135',@CAZAPESADO,'400',0,1,'35','0'), #Teltak
('136',@CRUCERO,'0',0,1,'27','0'), #Alkesh
('137',@NODRIZA,'600',0,1,'27','24'), #Hatak
('138',@INSIGNIA,'100',0,1,'24','60'), #Nave Nodriza
('139',@NODRIZA,'500',0,1,'30','24'), #Consejero Tolok
('140',@INSIGNIA,'300',0,1,'28','60'), #Líder del consejo
('141',@INSIGNIA,'0',0,1,'35','60'), #Talpat Ryn

('329',@INSIGNIA,'200',0,1,'31','50'), #Escuadron de Katano

########################################################
# Atlantis..............................................
########################################################
('165',@CAZAPESADO,'0',0,0,'0','0'), #F-302
('166',@CAZAPESADO,'200',1,0,'0','0'), #Jumper
('167',@NODRIZA,'700',0,1,'28','16'), #BC-304
('168',@INSIGNIA,'0',0,1,'22','60'), #Aurora
('169',@NODRIZA,'200',0,1,'35','16'), #Dedalo
('171',@INSIGNIA,'0',0,1,'38','60'), #Orion

('335',@SUPREMA,'0',0,1,'48','150'), #Ciudad de Atlantis

('170',@NODRIZA,'100',0,1,'37','30'), #Apolo
('354',@NODRIZA,'250',0,1,'37','30'), #BC-305

########################################################
# Wraith................................................
########################################################
('187',@CAZA,'200',1,0,'0','0'), #Dardo
('188',@CAZAPESADO,'75',0,1,'30','0'), #Explorador
('189',@CRUCERO,'200',0,1,'18','20'), #Crucero
('190',@INSIGNIA,'100',0,1,'20','100'), #Nave Colmena
('191',@INSIGNIA,'700',0,1,'25','100'), #Colmena comandante
('192',@INSIGNIA,'600',0,1,'25','100'), #Colmena reina
('194',@INSIGNIA,'300',0,1,'35','150'), #Colmena de Todd

('338',@SUPREMA,'0',0,1,'100','500'), #Supercolmena

('193',@INSIGNIA,'800',0,1,'28','40'), #Colmena de Michael
('195',@INSIGNIA,'200',0,1,'18','150'), #La primera
('351',@NODRIZA,'200',0,1,'35','30'), #Dedalo capturado

########################################################
# Replicantes...........................................
########################################################
('206',@CRUCERO,'200',0,1,'35','0'), #Replicante crucero
('207',@NODRIZA,'250',0,1,'40','0'), #Replicante Nave
('208',@NODRIZA,'300',0,1,'42','0'), #Nave de quinto

('413',@SUPREMA,'0',0,1,'48','0'), #Replicante planetoide

########################################################
# Ori...................................................
########################################################
('222',@CAZAPESADO,'0',0,1,'20','0'), #Caza de incursion
('223',@INSIGNIA,'2500',0,1,'35','50'), #Nave de guerra
('225',@INSIGNIA,'800',0,1,'40','50'), #Nave insignia
('226',@INSIGNIA,'500',0,1,'50','50'), #Supernave Orici
('332',@CAZA,'0',1,0,'0','0'), #Pieza del superstargate

('224',@INSIGNIA,'0',0,1,'35','40'), #Líder del consejo Jaffa capturado

########################################################
# Sin raza..............................................
########################################################
#(idUnidad, idTipoNave, carga, stargate, hiperespacio, velocidad, cazas)
###############  Caza Pesado  ###############
('297', @CAZAPESADO, '500',  0, 0,  '0', '0'), # Cosechadora Ashen
('298', @CAZAPESADO, '200',  0, 1, '45', '0'), # Caza Bedrosiano
('299', @CAZAPESADO,   '0',  0, 0,  '0', '0'), # Caza Nazis del espacio caza
( '85', @CAZAPESADO, '200',  0, 1, '45', '0'), # Caza de Osiris
###############  Crucero  ###############
('303', @CRUCERO, '200', 0, 1, '27', '0'), #Crucero traveler
('342', @CRUCERO, '100', 0, 1, '20', '0'), #Nave Olesiana
( '87', @CRUCERO, '600', 0, 1, '20', '0'), #Alkesh de carga
###############  Nodriza ###############
('306', @NODRIZA, '200', 0, 1, '30', '50'), #? Nazis del espacio nodriza
###############  Heroes  ###############
('450', @CAZAPESADO, '200', 1,0,'0','0'), #TimeJumper

('301', @CRUCERO, '200', 0, 1, '40',  '0'), #Seberus
('307', @CRUCERO, '200', 0, 1, '50',  '0'), #Serenity (ivan gozando)
('308', @CRUCERO, '200', 0, 1, '30',  '0'), #Crucero de Katana
('431', @CRUCERO, '200', 0, 1, '30', '20'), #Terraformador

('304', @NODRIZA, '100', 0, 1, '30', '50'), #Nave de Martin Lloyd
('432', @NODRIZA,   '0', 0, 1, '30','200'), #Comandante de drones

('305', @INSIGNIA,   '0',0,1,'35', '0'),  #Nave de la nebulosa
('302', @INSIGNIA, '600',0,1,'23','50'),  #Nave de propulsion lantiana
('309', @INSIGNIA, '200',0,1,'35','15'), #Aurora de Larrin
('433', @INSIGNIA, '300',0,1,'35','50'), #Nave ursini
('435', @INSIGNIA,   '0',0,1,'35','80'), #Sombra del desierto

('418', @SUPREMA ,'0',0,1,'50','0'), #Nave Nox

########################################################
# Especiales............................................
########################################################
#Aliados Asgard
('605',@CRUCERO,'200',0,1,'32','0'), #Clase Beliksner
('606',@NODRIZA,'450',0,1,'43','0'), #Clase Jackson
('607',@INSIGNIA,'200',0,1,'40','0'), #Clase Oneill

#Concilio Goauld
('609',@CRUCERO,'200',0,1,'18','0'), #Alkesh del concilio
('610',@NODRIZA,'600',0,1,'27','25'), #Hatak del concilio
('611',@INSIGNIA,'400',0,1,'24','50'), #Nodriza del concilio

#El consejo Asgard
('616',@CRUCERO,'200',0,1,'32','0'), #Beliksner del consejo
('617',@NODRIZA,'450',0,1,'43','0'), #Jackson del consejo
('618',@INSIGNIA,'200',0,1,'40','0'), #Oneill del consejo

#Consejo Jaffa
('623',@CRUCERO,'200',0,1,'18','0'), #Alkesh del consejo
('624',@NODRIZA,'600',0,1,'27','25'), #Hatak del consejo
('625',@INSIGNIA,'400',0,1,'24','50'), #Nave nodriza del consejo

#Trotamundos espaciales
('629',@CRUCERO,'200',0,1,'20','0'), #Crucero traveler
('630',@INSIGNIA,'200',0,1,'22','20'), #Aurora traveler

#Despertar
('632',@CAZA,'200',1,0,'0','0'), #Dardo
('633',@CRUCERO,'200',0,1,'14','20'), #Crucero
('634',@INSIGNIA,'400',0,1,'18','100'), #Naves colmena

#Camino de origen
('640',@CAZAPESADO,'0',0,1,'20','0'), #Cazas de incursion
('641',@INSIGNIA,'1000',0,1,'35','40'), #Nave de guerra

#Convocar flota
('643',@CRUCERO,'200',0,1,'35','0'), #Replicante crucero
('644',@NODRIZA,'250',0,1,'40','0'), #Replicante nave

#Naves Lucian
('653', @CRUCERO,'100',0,1,'15','0'), #Alkesh
('654', @NODRIZA,'600',0,1,'27','24'), #Hatak
('398',@INSIGNIA,'200',0,1,'31','50'), #Nave de Netan

#Naves Traveller
('655',@CRUCERO,'200',0,1,'20','0'), #Crucero traveler
('656',@INSIGNIA,'200',0,1,'22','20'), #Aurora traveler

#Drones
('657',@CAZA,'0',0,0,'0','0'), #Dron berzerker

######################################################
#### Capturas
######################################################
('359', @NODRIZA,  '700',0,1,'20','8'), #Replicante BC-303
('360', @NODRIZA,  '100',0,1,'28','16'), #Replicante BC-304
('361', @NODRIZA,  '600',0,1,'27','24'), #Replicante Hatak
('362', @INSIGNIA, '100',0,1,'24','60'), #Replicante Piramide
('364', @NODRIZA,  '450',0,1,'43','0'), #Replicante Jackson
('365', @INSIGNIA, '200',0,1,'40','0'), #Replicante Oneill
('366', @INSIGNIA,   '0',0,1,'22','60'), #Replicante Aurora
('367', @INSIGNIA,'2500',0,1,'35','50'), #Replicante Ori
('441', @NODRIZA,  '200',0,1,'24','50'), #? Nazis Replicante

('667', @NODRIZA,   '700',0,1,'20',  '8'), #BC-303
('668', @NODRIZA,   '100',0,1,'28', '16'), #BC-304
('669', @NODRIZA,   '600',0,1,'27', '24'), #Hatak
('670', @INSIGNIA,  '100',0,1,'24', '60'), #Piramide
('671', @NODRIZA,   '450',0,1,'43',  '0'), #Jackson
('672', @INSIGNIA,  '200',0,1,'40',  '0'), #Oneill
('673', @INSIGNIA,    '0',0,1,'22', '60'), #Aurora
('674', @INSIGNIA, '2500',0,1,'35', '50'), #Ori
('675', @NODRIZA,   '200',0,1,'24', '50'), #Nazis
('676', @INSIGNIA,  '100',0,1,'20','100'); #Nave Colmena

#############################################################################################################################################
## Soldados
#############################################################################################################################################
#soldado
INSERT INTO soldado (idUnidad, idTipoSoldado, carga)
VALUES

########################################################
# Tauri.................................................
########################################################
('1',@EXPLORACION,'0'), #UCAV
('2',@RECOLECCION,'77'), #Ingenieros
('3',@COMBATE,'25'), #Comando  SG
('6',@OFICIAL,'0'), #Oficial SGC
('8',@CIENTIFICO,'0'), #Dr. Daniel Jackson
('10',@MEDICO,'0'), #Dra. Janet Fraiser
('11',@CIENTIFICO,'0'), #Mayor Samantha Carter
('18',@LIDER,'0'), #Coronel Jack Oneill

('9',@ESPECIAL,'0'), #Daniel Jackson Ascendido
('12',@CIENTIFICO,'20'), #Jonas Quinn
('13',@OFICIAL,'0'), #Vala Mal Doran
('14',@OFICIAL,'0'), #Mayor Paul Davies
('15',@OFICIAL,'0'), #Mayor Louis Ferretti
('16',@OFICIAL,'0'), #Mayor Charles Kawalsky
('17',@OFICIAL,'0'), #Coronel Cameron Mitchell
('19',@LIDER,'0'), #General Jack Oneill
('20',@OFICIAL,'0'), #Coronel Harry Maybourne
('21',@LIDER,'0'), #Rey Arkhan
('22',@OFICIAL,'0'), #Agente Malcom Barret
('23',@OFICIAL,'0'), #Agente Burke
('24',@MEDICO,'0'), #Dra. Carolyn Lam
('25',@CIENTIFICO,'0'), #Dr. Jay Felger
('26',@LIDER,'0'), #Coronel Jack Kurt Oneill
('27',@CIENTIFICO,'0'), #Dr. Nicholas Rush
('28',@LIDER,'0'), #General George Hammond
('310',@LIDER,'0'), #General Landry
('318',@CIENTIFICO,'0'), #Dr. Willian Lee
('319',@OFICIAL,'0'), #Coronel Yuri Chekov
('344',@CIENTIFICO,'0'), #Eli wallace
('385',@LIDER,'0'), #Cassandra Fraiser
('390',@LIDER,'0'), #Camile Wray
('395',@LIDER,'0'), #David Telford
('400',@LIDER,'0'), #Everett Young
('449',@LIDER,'0'), #Dave Dixon

########################################################
# Goauld.................................................
########################################################
('41',@EXPLORACION,'0'), #Droide de reconocimiento
('42',@RECOLECCION,'60'), #Guerreros Jaffa
('43',@COMBATE,'10'), #Guardia personal
('50',@OFICIAL,'0'), #Guerrero Kull
('53',@CIENTIFICO,'0'), #Thoth
('57',@OFICIAL,'0'), #Herak
('60',@LIDER,'0'), #Apophis
('62',@LIDER,'0'), #Baal

('49',@OFICIAL,'0'), #Oficial Trust
('51',@OFICIAL,'0'), #Baal Clon
('59',@ESPECIAL,'0'), #Anubis
('61',@LIDER,'0'), #Apophis Netu
('63',@LIDER,'0'), #Hathor
('64',@LIDER,'0'), #Heruur
('65',@ESPECIAL,'0'), #Khalek
('68',@LIDER,'0'), #Yu
('69',@CIENTIFICO,'0'), #Nirti
('71',@LIDER,'0'), #Osiris
('73',@LIDER,'0'), #Ra
('74',@LIDER,'0'), #Tanith
('75',@LIDER,'0'), #Sokar
('76',@OFICIAL,'20'), #El Unas
('78',@LIDER,'0'), #Zipacna
('230',@LIDER,'0'), #Seth
('317',@LIDER,'0'), #Bastet
('341',@LIDER,'0'), #Tealc El continuo
('371',@LIDER,'0'), #Camulus
('380',@OFICIAL,'0'), #Valar
('383',@LIDER,'0'), #Cronus
('443',@CIENTIFICO,'0'), #Atenea
('446',@LIDER,'0'), #Apophis

########################################################
# Asgard................................................
########################################################
('98',@EXPLORACION,'80'), #Sonda de exploracion
('99',@LIDER,'0'), #Thor
('100',@OFICIAL,'0'), #SuperSoldado
('358',@LIDER,'0'), #Vanir

########################################################
# Jaffa.................................................
########################################################
('113',@EXPLORACION,'0'), #Sacerdote Jaffa
('114',@RECOLECCION,'80'), #Rebeldes Jaffa
('118',@COMBATE, '0'), #Distra
('119',@OFICIAL,'0'), #Guerrero Sodan
('120',@OFICIAL,'0'), #Raknor
('124',@OFICIAL,'0'), #Jolan
('127',@LIDER,'0'), #Tealc
('129',@LIDER,'0'), #Maestro Bratac

('285',@ESPECIAL,'0'), #Oma DeSala
('121',@OFICIAL,'0'), #Aron
('122',@LIDER,'0'), #Arkad
('123',@LIDER,'0'), #Ishta
('125',@LIDER,'0'), #Gerak
('126',@LIDER,'0'), #Katano
('128',@LIDER,'0'), #Maestro Tealc
('333',@OFICIAL,'0'), #Ryac
('369',@LIDER,'0'), #Dreyauc
('370',@LIDER,'0'), #Shanauc
('427',@OFICIAL,'0'), #Aron
('444',@LIDER,'0'), #Haikon
('445',@OFICIAL,'0'), #Volnek

########################################################
# Atlantis..............................................
########################################################
('142',@EXPLORACION,'0'), #Comando de exploracion
('143',@RECOLECCION,'70'), #Zapadores
('144',@COMBATE,'6'), #Comando Atlantis
('146',@OFICIAL,'0'), #Marine
('150',@MEDICO,'0'), #Dra. Jennifer Keller
('155',@CIENTIFICO,'0'), #Dr. Rodney Mckay
('158',@LIDER,'0'), #Ronon Dex
('159',@LIDER,'0'), #Coronel John Sheppard

('287',@ESPECIAL,'0'), #Morgana Le Fay
('147',@CIENTIFICO,'0'), #Dra.Jeannie Miller
('148',@MEDICO,'0'), #Dr. Carson Beckett
('149',@MEDICO,'0'), #Dr. Carson Beckett Clon
('152',@OFICIAL,'0'), #Teniente Aiden Ford
('153',@LIDER,'0'), #Ford dopado
('154',@CIENTIFICO,'0'), #Dr. Radek Zelenka
('156',@OFICIAL,'0'), #Mayor Evan Lorne
('157',@LIDER,'0'), #Teyla Emmagan
('277',@LIDER,'0'), #Larrin
('311',@LIDER,'0'), #Dra. Weir
('312',@LIDER,'0'), #Richard Woolsey
('325',@CIENTIFICO,'0'), #Coronel Carter
('349',@CIENTIFICO,'0'), #F.R.A.N.
('388',@LIDER,'0'), #Kanaan
('430',@CIENTIFICO,'0'), #Dr. Rod Mckay

########################################################
# Wraith................................................
########################################################
('172',@EXPLORACION,'0'), #Sonda escaner
('173',@RECOLECCION,'70'), #Guerreros Wraith
('174',@OFICIAL,'0'), #Oficial Wraith
('176',@OFICIAL,'0'), #Cazador Bob
('178',@LIDER,'0'), #Guardiana
('181',@LIDER,'0'), #Rey
('183',@LIDER,'0'), #Todd

('410',@ESPECIAL,'0'), #Wraith sobrealimentado
('177',@LIDER,'0'), #Tyre
('182',@LIDER,'0'), #Michael
('323',@OFICIAL,'0'), #Steve
('324',@OFICIAL,'0'), #Comandante de La primera
('326',@CIENTIFICO,'0'), #James
('327',@LIDER,'0'), #Reina Mayor
('331',@OFICIAL,'0'), #Kenny
('345',@CIENTIFICO,'0'), #Brian
('387',@OFICIAL,'0'), #El Exiliado

########################################################
# Replicantes...........................................
########################################################
('196',@EXPLORACION,'15'), #Replicante
('197',@COMBATE,'5'), #Replicante avanzado
('198',@OFICIAL,'0'), #Replciante huanoide
('199',@OFICIAL,'0'), #Replicanete madre
('202',@CIENTIFICO,'0'), #Reese
('203',@LIDER,'0'), #Quinto
('205',@LIDER,'0'), #RepliCarter

('412',@LIDER,'0'), #Gozilla replicante
('201',@OFICIAL,'0'), #Exoesqueleto replicante
('204',@LIDER,'0'), #Primero
('320',@LIDER,'0'), #Segundo
('321',@LIDER,'0'), #Tercero
('322',@LIDER,'0'), #Cuarto

########################################################
# Ori...................................................
########################################################
('209',@EXPLORACION,'50'), #Prior
('210',@COMBATE,'125'), #Guerreros Ori
('211',@OFICIAL,'50'), #Prior Avanzado
('328',@OFICIAL,'0'), #Prior invocador
('214',@OFICIAL,'0'), #Tomin
('216',@LIDER,'0'), #Orici
('217',@LIDER,'0'), #Doci

('218',@ESPECIAL,'0'), #Orici Ascendida
('313',@LIDER,'0'), #Líder Prior
('212',@LIDER,'0'), #El administrador
('401',@LIDER,'0'), #Prior de Ver Eger
('403',@LIDER,'0'), #Prior de Vía Láctea
('334',@OFICIAL,'0'), #Damaris

########################################################
# Sin raza..............................................
########################################################

###########  Exploradores  ###########
('228', @EXPLORACION,  '30'),  #Reol
('434', @EXPLORACION,  '30'), #Ursini
###########  Recolectores  ###########
('231', @RECOLECCION,'300'), #Mastadge
('233', @RECOLECCION, '90'), #Athosianos
('115', @RECOLECCION, '90'), #Amazonas Jaffa
('261', @RECOLECCION, '90'), #Androide
###########  Combate      ###########
('227', @COMBATE ,'25'), #Impuros
('250', @COMBATE ,'25'), #Whisper
('257', @COMBATE ,'25'), #Zombie de TelChak
('316', @COMBATE ,'25'), #Guerrero de Kera
('315', @COMBATE ,'25'), #Guerreros de Arkham
('232', @COMBATE ,'25'), #Salish
('240', @COMBATE ,'10'), #Comando TokRa
('245', @COMBATE ,'10'), #Prisionero Olesiano
('235', @COMBATE ,'10'), #Guerrero de Juna
('236', @COMBATE ,'10'), #Rebelde anti-Ori
('244', @COMBATE ,'10'), #Guerrilla de Abydos
('238', @COMBATE ,'10'), #Bola Kai
('234', @COMBATE ,'10'), #Guerrero Vikingo
('243', @COMBATE ,'5'), #Milicia de Rand y Caledonia
('239', @COMBATE ,'5'), #Comando Genii
(  '4', @COMBATE ,'5'), #Comando SG ruso
( '44', @COMBATE ,'5'), #Infiltrados de Apophis
(  '5', @COMBATE ,'5'), #Saqueador del NID
('237', @COMBATE ,'5'), #Guerrillero Langariano
('251', @COMBATE ,'0'), #Soldado Bedrosiano
('252', @COMBATE ,'0'), #Soldado Eurondano
('255', @COMBATE ,'0'), #Prisionero de Netu
('242', @COMBATE ,'0'), #Milicia de Hallona
('249', @COMBATE ,'0'), #Guerrero Serrakin
('253', @COMBATE ,'0'), #Guardia Tollano
( '46', @COMBATE ,'0'), #Guardia Horus
( '47', @COMBATE ,'0'), #Guardia de Baal
( '48', @COMBATE ,'0'), #Guardia de Sokar
('116', @COMBATE ,'0'), #Jaffa Ninja
('117', @COMBATE ,'0'), #Jaffas de Imhotep
('247', @COMBATE ,'0'), #Unas silvestre
('248', @COMBATE ,'0'), #Unas Goauld
('229', @COMBATE ,'0'), #Stragoth
('175', @COMBATE ,'0'), #Hibrido
('246', @COMBATE ,'0'), #Reetou
( '45', @COMBATE ,'0'), #Guardia Chacal
('258', @COMBATE ,'0'), #Guerrilla de Ford
('260', @COMBATE ,'0'), #?
('429', @COMBATE ,'0'), #ZaraKesh
('389', @COMBATE ,'0'), #Bestia
###########  Oficiales  ###########
('353', @OFICIAL ,'0'), #Illac Renin
('241', @OFICIAL ,'0'), #Miliciano de La Coalicion
(  '7', @OFICIAL ,'0'), #Oficial SG ruso
('262', @OFICIAL ,'0'), #Oficial Genii
('259', @OFICIAL ,'0'), #Oficiales Satedanos
('399', @OFICIAL ,'0'), #Mercenario Lucian
('254', @OFICIAL ,'0'), #Humanos mutados
('256', @OFICIAL ,'0'), #Monje de Kheb
('350', @OFICIAL ,'0'), #Androide de Jack ONeill
###########  Asesino  ###########
('263', @ASESINO ,'0'), #Asesino Tokra
('426', @ASESINO ,'0'), #Guerrero Dragon
('414', @ASESINO ,'0'), #Guerreros Sodan
( '52', @ASESINO ,'0'), #Ashrak
###########  Heroes  ###########
('264',@LIDER,'0'), #Lucius Lavin
('265',@CIENTIFICO,'0'), #Harlan
('266',@CIENTIFICO,'0'), #Linea
('267',@LIDER,'0'), #Shaure
('268',@CIENTIFICO,'0'), #Machelo
('269',@CIENTIFICO,'0'), #Anise
('270',@LIDER,'0'), #Martouf
('271',@OFICIAL,'0'), #Skaara
('272',@LIDER,'0'), #Kasuf
('273',@LIDER,'0'), #Omal
('274',@LIDER,'0'), #Narim
('275',@CIENTIFICO,'0'), #Jolinar de Malkshur
('276',@LIDER,'0'), #Chaka
('278',@CIENTIFICO,'0'), #Warrick
('279',@ASESINO,'0'), #Aris Boch
('280',@LIDER,'0'), #Jacob Carter
('281',@ASESINO,'0'), #Kiryck
('282',@LIDER,'0'), #Comandante Acastus Kolya
('283',@CIENTIFICO,'0'), #Furlings
('284',@MEDICO,'0'), #Nox
('286',@ESPECIAL,'0'), #Orlin
('314',@ESPECIAL,'0'), #Chaya Sar
('337',@ASESINO,'0'), #Neeva Casol
('343',@LIDER,'0'), #Ladon Radim
('346',@LIDER,'0'), #Khonsu
('352',@MEDICO,'0'), #El guarda
('368',@OFICIAL,'0'), #Jonas Hanson
('372',@OFICIAL,'0'), #Jared Kane
('373',@ESPECIAL,'0'), #Merlin
('374',@LIDER,'0'), #Meurik
('375',@LIDER,'0'), #Cowen
('376',@LIDER,'0'), #Burrock
('377',@LIDER,'0'), #Gairwyn
('378',@LIDER,'0'), #Iron Shirt
('379',@LIDER,'0'), #Omoc
('381',@CIENTIFICO,'0'), #Mollem
('382',@LIDER,'0'), #Halling
('384',@LIDER,'0'), #Egeria
('386',@CIENTIFICO,'0'), #Allina
('391',@LIDER,'0'), #Kiva
('392',@LIDER,'0'), #Netam
('393',@OFICIAL,'0'), #Simeon
('394',@CIENTIFICO,'0'), #Ginn
('396',@LIDER,'0'), #Varro
('397',@LIDER,'0'), #Tenat & Jup
('402',@LIDER,'0'), #Seevis
('404',@LIDER,'0'), #Katana Labrea
('424',@ESPECIAL,'0'), #Arturo
('437',@OFICIAL,'0'), #Sora
('448',@LIDER,'0'), #Xels

########################################################
# Especiales............................................
########################################################
#Aliados Jaffa
('600',@COMBATE,'0'), #Guardia aliada
('601',@OFICIAL,'0'), #Distra aliado
('602',@LIDER,'0'), #Tealc de Chulak

#Aliados Tokra
('603',@COMBATE,'0'), #Comando Tokra
('604',@ASESINO,'0'), #Asesino Tokra

#El plan de anubis
('608',@ASESINO,'0'), #Ashrak

#El Continuo
('664',@OFICIAL,'0'), #Distra

#Aliados Tauri
('612',@COMBATE,'0'), #Comando SG Tauri
('613',@OFICIAL,'0'), #Oficial Tauri
('614',@LIDER,'0'), #Coronel jack Oneill

#La Otra extirpe
('615',@OFICIAL,'0'), #Supersoldados Pegasus

#Aliados Tauri
('619',@COMBATE,'0'), #Comando SG Tauri
('620',@OFICIAL,'0'), #Oficial Tauri
('621',@LIDER,'0'), #Coronel Jack Oneill

#Aliados Atlantis para Jaffa
('662',@OFICIAL,'0'), #Marines
('663',@LIDER,'0'), #Ronon

#Sodan
('622',@ASESINO,'0'), #Sodan aliados

#Pueblos de Pegasus
('626',@COMBATE,'0'), #Milicianos de La Coalicion
('627',@OFICIAL,'0'), #Comando de Ronon

#Aliados Tauri para Atlantis
('658',@COMBATE,'0'), #Comando SG Tauri
('659',@OFICIAL,'0'), #Oficial Tauri
('660',@LIDER,'0'), #Coronel jack Oneill

#Partida de caza
('631',@OFICIAL,'0'), #Cazador Experto

#Doctrina
('636',@COMBATE,'0'), #Segidores Vikingos
('637',@OFICIAL,'0'), #Seguidores Reetou

#Aliado Jaffa Ori
('638',@COMBATE,'0'), #Guardia Origen
('639',@OFICIAL,'0'), #Distra de Origen

#Combatientes replicantes
('642',@OFICIAL,'0'), #Exoesqueleto replicante

#Alianza Unas Chaka
('645',@OFICIAL,'0'), #Unas de Chaka

#Alianza Unas Planeta
('646',@OFICIAL,'0'), #Unas silvestre

#Plande anubis Planeta
('647',@OFICIAL,'0'), #Siervo de anubis

#La familia
('650',@OFICIAL,'0'), #Replicante humanoide

#Otra forma de proteger La Tierra
('649',@OFICIAL,'0'), #Elite del NID

#IOA
('665',@OFICIAL,'0'), #Agente IOA
('666',@LIDER,'0'), #Bates
('628',@OFICIAL,'0'), #Agente IOA
('635',@LIDER,'0'), #Bates

#Ascendido Kheb
('652',@ESPECIAL,'0'), #Ascendido

########################################################
# Capturas............................................
######################################################

('451',@COMBATE,'0'), #Recluta Jaffa
('452',@COMBATE,'0'), #Lo\'taur
('453',@COMBATE,'0'), #Comando Atlantis
('454',@COMBATE,'0'), #Jaffa Guardián
('455',@COMBATE,'0'), #Wraith Iratus
('457',@COMBATE,'0'), #Guerrero Origen
('440',@COMBATE,'0'), #Guardia Real

('458',@OFICIAL,'0'), #Jaffa SGC
('417',@OFICIAL,'0'), #Soldado Goauld
('77' ,@OFICIAL,'0'), #Wraith Goauld
('145',@OFICIAL,'0'), #Antiguo espectro
('459',@OFICIAL,'0'), #Jaffa Cónsul
('460',@OFICIAL,'0'), #Wraith Centinela
('200',@OFICIAL,'0'), #Humanoide replicante
('461',@OFICIAL,'0'), #Converso
('436',@OFICIAL,'0'), #Antiguo anfitrion
('347',@OFICIAL,'0'), #Adoradores wraith


('54',@OFICIAL,'0'), #Arqueologo Goauld
('55',@OFICIAL,'0'), #Cientifico Goauld
('56',@OFICIAL,'0'), #Militar Goauld
('58',@OFICIAL,'0'), #Reina de apophis
('66',@OFICIAL,'0'), #Primado
('67',@OFICIAL,'0'), #Principe de abydos
('70',@OFICIAL,'0'), #Orici capturada
('72',@OFICIAL,'0'), #Reina Goauld
('151',@OFICIAL,'0'), #Teniente Michael Kenmore
('179',@OFICIAL,'0'), #Humano Iratus
('180',@OFICIAL,'0'), #Reina Athosiana
('348',@OFICIAL,'0'), #Especialista Satedano
('213',@OFICIAL,'0'), #Prior Tauri
('215',@OFICIAL,'0'), #Prior Jaffa
('336',@OFICIAL,'0'); #Sacerdotisa


#############################################################################################################################################
## Defensas
#############################################################################################################################################
INSERT INTO defensa (idUnidad, idTipoDefensa, autodestruye, tiempoMover) VALUES

########################################################
# Tauri.................................................
########################################################
('29',@STARGATE,0,NULL), #Iris
('30',@TERRESTRE,0,'900'), #Comando de defensa
('31',@AEREA,0,'12600'), #LanzaCohetes
('32',@ORBITAL,1,NULL), #Cohetes balisticos

('415',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos

########################################################
# Goauld................................................
########################################################
('79',@STARGATE,0,NULL), #Campo de fuerza
('80',@TERRESTRE,0,'1200'), #Lanzadera pesada
('81',@AEREA,0,NULL), #Torreta
('82',@ORBITAL,0,NULL), #Satelite Goauld

########################################################
# Asgard................................................
########################################################
('101',@STARGATE,0,NULL), #Martillo de Thor
('102',@STARGATE,0,NULL), #Martillo de defensa
('103',@ORBITAL,0,'36000'), #Satelite Asgard

########################################################
# Jaffa.................................................
########################################################
('130',@STARGATE,0,NULL), #Campo de fuerza
('131',@TERRESTRE,0,'1200'), #Lanzadera pesada
('132',@AEREA,0,NULL), #Atalaya
('133',@ORBITAL,1,NULL), #Mina orbital

('411',@DEFENSAESPECIAL,0,NULL), #Arma de Dakara

########################################################
# Atlantis..............................................
########################################################
('160',@STARGATE,0,NULL), #Campo de fuerza
('161',@TERRESTRE,0,'900'), #Comando de defensa
('162',@AEREA,0,'3600'), #Cañon raíl
('164',@ORBITAL,0,NULL), #Satelite antiguo

########################################################
# Wraith................................................
########################################################
('184',@STARGATE,0,NULL), #Campo deflector
('185',@TERRESTRE,1,'60'), #Insecto iratus
('186',@TERRESTRE,0,'60'), #Xenomorfo

########################################################
# Replicantes...........................................
########################################################
('357',@STARGATE,0,NULL), #Replicante Iris

########################################################
# Ori...................................................
########################################################
('219',@STARGATE,0,NULL), #Campo de fuerza
('220',@TERRESTRE,0,'1200'), #Comando de defensa
('221',@ORBITAL,0,NULL), #Satelite Ori

('416',@DEFENSAESPECIAL,0,NULL), #Cupula planetaria
('509',@DEFENSAESPECIAL,0,NULL), #Superstargate

########################################################
# Sin raza..............................................
########################################################
('163',@DEFENSAESPECIAL,0,NULL), #Canon antiaereo antiguo
('288',@AEREA,0,'900'), #Canon artesano
('289',@TERRESTRE,0,'900'), #Caballero Negro
('290',@TERRESTRE,0,'900'), #Ente lantiana
('291',@TERRESTRE,0,'3600'), #Canon flotante
('292',@TERRESTRE,0,NULL), #Torre de minidrones
('293',@TERRESTRE,0,'1000'), #Ente
('294',@AEREA,0,NULL), #Dragon
('295',@ORBITAL,0,NULL), #Canon de iones Tollano
('296',@STARGATE,0,NULL), #Campo de defensa Eurondano
('300',@AEREA,0,'900'), #Caza teledirigido
('419',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos
('420',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos
('421',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos
('422',@DEFENSAESPECIAL,0,NULL), #Arma de Dakara
('423',@DEFENSAESPECIAL,0,NULL), #Centinela
('425',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos
('428',@DEFENSAESPECIAL,0,NULL), #Sillon de los antiguos
('438',@STARGATE,0,NULL), #Iris Praxyon
('661',@STARGATE,0,NULL), #vengador
('439',@ORBITAL,0,NULL), #Satelite Geldar
('651',@TERRESTRE,0,'60'); #Xenomorfo especial

#############################################################################################################################################
## Heroes
#############################################################################################################################################
INSERT INTO unidadHeroe (idUnidad)
VALUES

########################################################
# Tauri.................................................
######################################################
('8'), #Daniel Jackson
('9'), #Daniel Jackson ascendido
('10'), #Janet Fraiser
('11'), #Mayor Carter
('12'), #Jonas Quin
('13'), #Vala Mal Doran
('14'), #Paul Davies
('15'), #Louis Ferreti
('16'), #Charles Kawalsky
('17'), #Cameron Mitchell
('18'), #Coronel Jack Oneill
('19'), #General jack Oneill
('20'), #Coronel Harry Maybourne
('21'), #Rey Arkhan
('22'), #Agente Malcom Barret
('23'), #Agente Burke
('24'), #Caroline Lam
('25'), #Jay Felger
('26'), #Kurt Rusell
('27'), #Nicholas Rush
('28'), #George Hammond
('37'), #Prometeo
('38'), #Korolev
('39'), #Odisea
('40'), #Fenix
('310'), #General Landry
('318'), #William Lee
('319'), #Yuri Chekov
('339'), #USS George Hammond
('340'), #Sun Tzu
('356'), #BC-306 Clase Thor
('355'), #Destiny
('344'), #Eli
('385'), #Cassandra Fraiser
('390'), #Camile Wray
('395'), #David Telford
('400'), #Everett Young
('415'), #Sillon de los antiguos

########################################################
# Goauld................................................
########################################################
('53'), #Thot
('57'), #Herak
('59'), #Anubis
('60'), #Apophis
('61'), #Apophis Netu
('62'), #Baal
('63'), #Hathor
('64'), #Heruur
('65'), #Khalek
('68'), #Yu
('69'), #Nirrti
('71'), #Osiris
('73'), #Ra
('74'), #Tanith
('75'), #Sokar
('76'), #El unas
('78'), #Zipacna
('90'), #Sequito de Baal
('91'), #Nave imperial de Yu
('92'), #Nodriza de Apophis
('93'), #Palacio de Ra
('94'), #Estacion Hassara
('95'), #Beelzebuth
('230'), #Seth
('317'), #Bastet
('329'), #Escuadron Katano
('371'), #Camulus
('380'), #Valar
('383'), #Cronus
('408'), #Nave de Anubis
('442'), #Nave Heruur
('443'), #Atenea

########################################################
# Asgard................................................
########################################################
('99'), #Thor
('101'), #Martillo de Thor
('108'), #Heimdall
('109'), #Valhalla
('110'), #Aeronave Hermiod
('111'), #Nave de Kvasir
('112'), #Comandante supremo Thor
('330'), #Carro de Thor
('358'), #Vanir
('405'), #Freyr
('406'), #Penegal
('407'), #Vanir
('409'), #Palacio de Valaskjalf

########################################################
# Jaffa.................................................
########################################################
('120'), #Raknor
('121'), #Aron
('122'), #Arkad
('123'), #Ishta
('124'), #Jolan
('125'), #Gerak
('126'), #Katano
('127'), #Tealc
('128'), #Maestro Tealc
('129'), #Maestro Bratac
('139'), #Consejero Tolok
('140'), #Líder del consejo
('141'), #Talpat Ryn
('285'), #Oma DeSala
('333'), #Ryac
('369'), #Dreyac
('370'), #Shanauc
('411'), #Arma de Dakara
('427'), #Mzel

########################################################
# Atlantis..............................................
########################################################
('147'), #Jeanie Miller
('148'), #Carson Beckett
('149'), #Carson Beckett Clon
('150'), #Jennifer Keller
('152'), #Aiden Ford
('153'), #Aiden Ford dopado
('154'), #Zelenka
('155'), #Mckay
('156'), #Evan Lorne
('157'), #Teyla
('158'), #Ronon Dex
('159'), #Coronel John Sheppard
('163'), #Canon Antiarero Antiguo
('169'), #Dedalo
('170'), #Apollo
('171'), #Orion
('277'), #Larrin
('287'), #Morgana Le Fay
('311'), #Dra. Weir
('312'), #Wolsey
('325'), #Coronel Samantha Carter
('335'), #Atlantis
('349'), #F.R.A.N.
('354'), #BC-305 Clase Excalibur
('388'), #Kanaan

########################################################
# Wraith................................................
########################################################
('176'), #Cazador Bob
('177'), #Tyre
('178'), #Guardiana
('181'), #Rey
('182'), #Michael
('183'), #Todd
('191'), #Colmena Comandante
('192'), #Colmena Reina
('193'), #Colmena Michael
('194'), #Colmena de Todd
('195'), #La Primera
('323'), #Steve
('324'), #Comandante Primera
('326'), #James
('327'), #Reina Mayor
('331'), #Kenny
('338'), #SuperColmena
('345'), #Brian
('387'), #El Exiliado
('410'), #Wraith sobrealimentado

########################################################
# Replicantes...........................................
########################################################
('199'), #Replicante madre
('202'), #Reese
('203'), #Quinto
('204'), #Primero
('205'), #Replicarter
('208'), #Nave de quinto
('320'), #Segundo
('321'), #Tercero
('322'), #Cuarto
('412'), #Godzilla
('413'), #Replicante planetoide

########################################################
# Ori...................................................
########################################################
('212'), #El administrador
('214'), #Tomin
('216'), #Orici
('217'), #Doci
('218'), #Orici Ascendida
('225'), #Nave insiginia
('226'), #Supernave Orici
('313'), #Líder prior
('328'), #Prior invocador
('334'), #Damaris
('509'), #Superstargate
('401'), #Prior Ver Eger
('403'), #Prior Vía Láctea
('416'), #Cupula planetaria

########################################################
# Sin raza..............................................
########################################################
('264'), #Lucius Lavin
('265'), #Harlan
('266'), #Linea
('267'), #Shaure
('268'), #Machelo
('269'), #Anise
('270'), #Martouf
('271'), #Skaara
('272'), #Kasuf
('273'), #Omal
('274'), #Narim
('275'), #Jolinar
('276'), #Chaka
('278'), #Warrick
('279'), #Aris Bosh
('280'), #Jacob Carter
('281'), #Kiryck
('282'), #Acastus Colya
('283'), #Furlings
('284'), #Nox
('286'), #Orlin
('294'), #Dragon
('296'), #Campo de defensa eurondano
('301'), #Seberus
('304'), #Nave de Martin Lloyd
('302'), #Impulsion
('305'), #Nebulosa V
('307'), #Serenity
('308'), #Crucero Katana
('309'), #Aurora de Larrin
('314'), #Chaya Sar
('337'), #Neeva Casol
('343'), #Ladon Radim
('346'), #Khonsu
('352'), #El guarda
('368'), #Jonas Hanson
('372'), #Jared Kane
('373'), #Merlin
('374'), #Meurik
('375'), #Cowen
('376'), #Burrock
('377'), #Gairwyn
('378'), #Iron Shirt
('379'), #Omoc
('381'), #Mollem
('382'), #Halling
('384'), #Egeria
('386'), #Allina
('391'), #Kiva
('392'), #Netan
('393'), #Simeon
('394'), #Ginn
('396'), #Varro
('397'), #Tenat & Jup
('398'), #Nave de Netan
('402'), #Seevis
('404'), #Katana Labrea
('418'), #Ciudad Nox
('419'), #Sillon de los antiguos
('420'), #Sillon de los antiguos
('421'), #Sillon de los antiguos
('422'), #Arma de Dakara
('423'), #Centinela
('424'), #Arturo
('425'), #Sillon de los antiguos
('428'), #Sillon de los antiguos
('430'), #Rod
('431'), #Terraformador
('432'), #Comandante
('433'), #Nave ursini
('435'), #Sombra
('437'), #Sora
('438'), #Praxyon
('444'), #Haikon
('445'), #Volnek
('446'), #Apophis
('447'), #Loki
('448'), #Xels
('449'), #Dixon
('450'), #TimeJumper

########################################################
# Unidades de los especiales............................
########################################################
('602'), #Tealc aliados Jaffa
('666'), #Agente Bates
('660'), #Oneill para Atlantis
('663'), #Ronon jaffa
('341'), #Tealc El continuo
('614'), #Oneill Aliados Tauri Asgard
('621'); #Oneill Aliados Tauri Jaffa

#############################################################################################################################################
## Costes
#############################################################################################################################################
INSERT INTO recursoUnidad (idUnidad, idTipoRecurso, cantidad)
VALUES
########################################################
# Tauri.................................................
########################################################
###Tropas...............................................
#UCAV
('1', @PRIMARIO,'15'),
('1', @SECUNDARIO,'16'),
#Ingenieros
('2', @PRIMARIO,'25'),
('2', @SECUNDARIO,'29'),
#Comando SG
('3', @PRIMARIO,'65'),
('3', @SECUNDARIO,'93'),
#Oficial SG
('6', @PRIMARIO,'180'),
('6', @SECUNDARIO,'387'),
#Dr Daniel Jackson
('8', @PRIMARIO,'200'),
('8', @SECUNDARIO,'400'),
('8', @ENERGIA,'1500'),
#Dra. Janet Frasier
('10', @PRIMARIO,'200'),
('10', @SECUNDARIO,'400'),
('10', @ENERGIA,'1500'),
#Mayor Samantha Carter
('11', @PRIMARIO,'200'),
('11', @SECUNDARIO,'400'),
('11', @ENERGIA,'1500'),
#Coronel Jack Oneill
('18', @PRIMARIO,'200'),
('18', @SECUNDARIO,'400'),
('18', @ENERGIA,'1500'),

###Naves.................................................
#X-301
('33', @PRIMARIO,'200'),
('33', @SECUNDARIO,'500'),
('33', @ENERGIA,'250'),
#F-3020
('34', @PRIMARIO,'177'),
('34', @SECUNDARIO,'500'),
('34', @ENERGIA,'305'),
#BC-303
('35', @PRIMARIO,'1605'),
('35', @SECUNDARIO,'300'),
('35', @ENERGIA,'3200'),
#BC-304
('36', @PRIMARIO,'2078'),
('36', @SECUNDARIO,'5000'),
('36', @ENERGIA,'5800'),
#Prometeo
('37', @PRIMARIO,'3000'),
('37', @SECUNDARIO,'7000'),
('37', @ENERGIA,'5000'),
#Odisea
('39', @PRIMARIO,'3000'),
('39', @SECUNDARIO,'7000'),
('39', @ENERGIA,'5000'),
#USS George Hammond
('339', @PRIMARIO,'3000'),
('339', @SECUNDARIO,'7000'),
('339', @ENERGIA,'5000'),

###Defensas..............................................
#Iris
('29', @PRIMARIO,'1000'),
('29', @SECUNDARIO,'25000'),
('29', @ENERGIA,'49600'),
#Comando de defensa
('30', @PRIMARIO,'100'),
('30', @SECUNDARIO,'190'),
('30', @ENERGIA,'50'),
#Lanzacohetes
('31', @PRIMARIO,'200'),
('31', @SECUNDARIO,'500'),
('31', @ENERGIA,'190'),
#Cohete balistico
('32', @PRIMARIO,'180'),
('32', @SECUNDARIO,'500'),
('32', @ENERGIA,'200'),

########################################################
# Goauld................................................
########################################################
###Tropas...............................................
#Droide de reconocimiento
('41', @PRIMARIO,'25'),
('41', @SECUNDARIO,'13'),
#Guerreros Jaffa
('42', @PRIMARIO,'50'),
('42', @SECUNDARIO,'30'),
#Guardia personal
('43', @PRIMARIO,'150'),
('43', @SECUNDARIO,'97'),
#Guerreros Kull
('50', @PRIMARIO,'538'),
('50', @SECUNDARIO,'300'),
('50', @ENERGIA,'230'),
#Thoth
('53', @PRIMARIO,'400'),
('53', @SECUNDARIO,'200'),
('53', @ENERGIA,'1500'),
#Herak
('57', @PRIMARIO,'400'),
('57', @SECUNDARIO,'200'),
('57', @ENERGIA,'1500'),
#Apophis
('60', @PRIMARIO,'400'),
('60', @SECUNDARIO,'200'),
('60', @ENERGIA,'1500'),
#Baal
('62', @PRIMARIO,'400'),
('62', @SECUNDARIO,'200'),
('62', @ENERGIA,'1500'),

###Naves.................................................
#Planeador de la muerte
('83', @PRIMARIO,'448'),
('83', @SECUNDARIO,'205'),
('83', @ENERGIA,'178'),
#Aguja afilada
('84', @PRIMARIO,'720'),
('84', @SECUNDARIO,'190'),
('84', @ENERGIA,'380'),
#Alkesh
('86', @PRIMARIO,'1925'),
('86', @SECUNDARIO,'850'),
('86', @ENERGIA,'1600'),
#Hatak
('88', @PRIMARIO,'4425'),
('88', @SECUNDARIO,'1700'),
('88', @ENERGIA,'4150'),
#Nave Nodriza
('89', @PRIMARIO,'6500'),
('89', @SECUNDARIO,'3086'),
('89', @ENERGIA,'6000'),
#Estacion Hassara
('94', @PRIMARIO,'7000'),
('94', @SECUNDARIO,'3000'),
('94', @ENERGIA,'5000'),
#Beelzebuth
('95', @PRIMARIO,'7000'),
('95', @SECUNDARIO,'3000'),
('95', @ENERGIA,'5000'),


###Defensas..............................................
#Campo de fuerza
('79', @PRIMARIO,'45000'),
('79', @SECUNDARIO,'5000'),
('79', @ENERGIA,'77250'),
#Lanzadera pesada
('80', @PRIMARIO,'250'),
('80', @SECUNDARIO,'20'),
('80', @ENERGIA,'90'),
#Torreta
('81', @PRIMARIO,'750'),
('81', @SECUNDARIO,'80'),
('81', @ENERGIA,'120'),
#Satelite Goauld
('82', @PRIMARIO,'4225'),
('82', @SECUNDARIO,'200'),
('82', @ENERGIA,'1200'),

########################################################
# Asgard................................................
########################################################
###Tropas...............................................
#Sonda de exploracion
('98', @PRIMARIO,'15'),
('98', @SECUNDARIO,'30'),
#Thor
('99', @PRIMARIO,'200'),
('99', @SECUNDARIO,'400'),
('99', @ENERGIA,'1500'),
#Supersoldado
('100', @PRIMARIO,'325'),
('100', @SECUNDARIO,'525'),
('100', @ENERGIA,'550'),
#Vanir
('358', @PRIMARIO,'900'),
('358', @SECUNDARIO,'1400'),
('358', @ENERGIA,'1000'),

###Naves................................................
#Nave de asalto
('104', @PRIMARIO,'5'),
('104', @SECUNDARIO,'80'),
('104', @ENERGIA,'500'),
#Beliksner
('105', @PRIMARIO,'123'),
('105', @SECUNDARIO,'1500'),
('105', @ENERGIA,'1650'),
#Jackson
('106', @PRIMARIO,'602'),
('106', @SECUNDARIO,'2800'),
('106', @ENERGIA,'3600'),
#Oneill
('107', @PRIMARIO,'1000'),
('107', @SECUNDARIO,'6040'),
('107', @ENERGIA,'7000'),
#Heimdall
('108', @PRIMARIO,'3000'),
('108', @SECUNDARIO,'7000'),
('108', @ENERGIA,'5000'),
#Valhalla
('109', @PRIMARIO,'3000'),
('109', @SECUNDARIO,'7000'),
('109', @ENERGIA,'5000'),
#Comandante supremo Thor
('112', @PRIMARIO,'3000'),
('112', @SECUNDARIO,'7000'),
('112', @ENERGIA,'5000'),

###Defensas.............................................
#Martillo de Thor
('101', @PRIMARIO,'1000'),
('101', @SECUNDARIO,'20000'),
('101', @ENERGIA,'8000'),
#Martillo de defensa
('102', @PRIMARIO,'2000'),
('102', @SECUNDARIO,'42500'),
('102', @ENERGIA,'50000'),
#Satelite Asgard
('103', @PRIMARIO,'150'),
('103', @SECUNDARIO,'4750'),
('103', @ENERGIA,'1750'),

########################################################
# Jaffa.................................................
########################################################
###Tropas...............................................
#Sacerdote Jaffa
('113', @PRIMARIO,'20'),
('113', @SECUNDARIO,'12'),
#Rebeldes Jaffa
('114', @PRIMARIO,'25'),
('114', @SECUNDARIO,'50'),
#Distra
('118', @PRIMARIO,'182'),
('118', @SECUNDARIO,'265'),
#Guerreros Sodan
('119', @PRIMARIO,  '200'),
('119', @SECUNDARIO,'280'),
('119', @ENERGIA,   '150'),
#Raknor
('120', @PRIMARIO,'200'),
('120', @SECUNDARIO,'400'),
('120', @ENERGIA,'1500'),
#Jolan
('124', @PRIMARIO,'200'),
('124', @SECUNDARIO,'400'),
('124', @ENERGIA,'1500'),
#Tealc
('127', @PRIMARIO,'200'),
('127', @SECUNDARIO,'400'),
('127', @ENERGIA,'1500'),
#Maestro Bratac
('129', @PRIMARIO,'200'),
('129', @SECUNDARIO,'400'),
('129', @ENERGIA,'1500'),

###Naves................................................
#Udajeet
('134', @PRIMARIO,'75'),
('134', @SECUNDARIO,'250'),
('134', @ENERGIA,'250'),
#Teltak
('135', @PRIMARIO,'150'),
('135', @SECUNDARIO,'800'),
('135', @ENERGIA,'585'),
#Alkesh
('136', @PRIMARIO,'380'),
('136', @SECUNDARIO,'1205'),
('136', @ENERGIA,'1200'),
#Hatak
('137', @PRIMARIO,'727'),
('137', @SECUNDARIO,'3000'),
('137', @ENERGIA,'3535'),
#Nave Nodriza
('138', @PRIMARIO,'2020'),
('138', @SECUNDARIO,'8000'),
('138', @ENERGIA,'7600'),
#Consejero Tolok
('139', @PRIMARIO,'3000'),
('139', @SECUNDARIO,'7000'),
('139', @ENERGIA,'5000'),
#Líder del consejo
('140', @PRIMARIO,'3000'),
('140', @SECUNDARIO,'7000'),
('140', @ENERGIA,'5000'),
#Talpat Ryn
('141', @PRIMARIO,'3000'),
('141', @SECUNDARIO,'7000'),
('141', @ENERGIA,'5000'),

###Defensas.............................................
#Campo de fuerza
('130', @PRIMARIO,'4000'),
('130', @SECUNDARIO,'49340'),
('130', @ENERGIA,'75000'),
#Lanzadera pesada
('131', @PRIMARIO,'40'),
('131', @SECUNDARIO,'252'),
('131', @ENERGIA,'70'),
#Atalaya
('132', @PRIMARIO,'41'),
('132', @SECUNDARIO,'500'),
('132', @ENERGIA,'140'),
#Mina orbital
('133', @PRIMARIO,'60'),
('133', @SECUNDARIO,'534'),
('133', @ENERGIA,'100'),

########################################################
# Atlantis..............................................
########################################################
###Tropas...............................................
#Comando de exploracion
('142', @PRIMARIO,'20'),
('142', @SECUNDARIO,'12'),
#Zapadores
('143', @PRIMARIO,'28'),
('143', @SECUNDARIO,'20'),
#Comando Atlantis
('144', @PRIMARIO,'70'),
('144', @SECUNDARIO,'200'),
#Marine
('146', @PRIMARIO,'115'),
('146', @SECUNDARIO,'271'),
('146', @ENERGIA,'70'),
#Dra. Jeniffer Keller
('150', @PRIMARIO,'200'),
('150', @SECUNDARIO,'400'),
('150', @ENERGIA,'1500'),
#Dr. Rodney Mckay
('155', @PRIMARIO,'200'),
('155', @SECUNDARIO,'400'),
('155', @ENERGIA,'1500'),
#Ronon Dex
('158', @PRIMARIO,'200'),
('158', @SECUNDARIO,'400'),
('158', @ENERGIA,'1500'),
#Coronel Jonh Sheppard
('159', @PRIMARIO,'200'),
('159', @SECUNDARIO,'400'),
('159', @ENERGIA,'1500'),

###Naves................................................
#F-302
('165', @PRIMARIO,'109'),
('165', @SECUNDARIO,'701'),
('165', @ENERGIA,'200'),
#Jumper
('166', @PRIMARIO,'200'),
('166', @SECUNDARIO,'1133'),
('166', @ENERGIA,'650'),
#BC-304
('167', @PRIMARIO,'2078'),
('167', @SECUNDARIO,'5000'),
('167', @ENERGIA,'5800'),
#Aurora
('168', @PRIMARIO,'3400'),
('168', @SECUNDARIO,'8518'),
('168', @ENERGIA,'7000'),
#Dedalo
('169', @PRIMARIO,'3000'),
('169', @SECUNDARIO,'7000'),
('169', @ENERGIA,'5000'),
#Orion
('171', @PRIMARIO,'3000'),
('171', @SECUNDARIO,'7000'),
('171', @ENERGIA,'5000'),

###Defensas.............................................
#Campo de fuerza
('160', @PRIMARIO,'5000'),
('160', @SECUNDARIO,'28333'),
('160', @ENERGIA,'100000'),
#Comando de defensa
('161', @PRIMARIO,'81'),
('161', @SECUNDARIO,'201'),
('161', @ENERGIA,'50'),
#Cañon raíl
('162', @PRIMARIO,'52'),
('162', @SECUNDARIO,'400'),
('162', @ENERGIA,'140'),
#Satelite Antiguo
('164', @PRIMARIO,'1000'),
('164', @SECUNDARIO,'5333'),
('164', @ENERGIA,'2400'),

########################################################
# Wraith................................................
########################################################
###Tropas...............................................
#Sonda Escaner
('172', @PRIMARIO,'20'),
('172', @SECUNDARIO,'3'),
#Guerrero Wraith
('173', @PRIMARIO,'80'),
('173', @SECUNDARIO,'25'),
#Oficial wraith
('174', @PRIMARIO,'704'),
('174', @SECUNDARIO,'125'),
('174', @ENERGIA,'25'),
#Cazador Bob
('176', @PRIMARIO,'200'),
('176', @SECUNDARIO,'400'),
('176', @ENERGIA,'1500'),
#Guardiana
('178', @PRIMARIO,'200'),
('178', @SECUNDARIO,'400'),
('178', @ENERGIA,'1500'),
#Rey
('181', @PRIMARIO,'200'),
('181', @SECUNDARIO,'400'),
('181', @ENERGIA,'1500'),
#Todd
('183', @PRIMARIO,'200'),
('183', @SECUNDARIO,'400'),
('183', @ENERGIA,'1500'),

###Naves................................................
#Dardo
('187', @PRIMARIO,'281'),
('187', @SECUNDARIO,'50'),
('187', @ENERGIA,'110'),
#Explorador
('188', @PRIMARIO,'302'),
('188', @SECUNDARIO,'83'),
('188', @ENERGIA,'100'),
#Crucero
('189', @PRIMARIO,'2167'),
('189', @SECUNDARIO,'900'),
('189', @ENERGIA,'750'),
#Nave colmena
('190', @PRIMARIO,'5575'),
('190', @SECUNDARIO,'2000'),
('190', @ENERGIA,'1600'),
#Colmena comandante
('191', @PRIMARIO,'7000'),
('191', @SECUNDARIO,'3000'),
('191', @ENERGIA,'5000'),
#Colmena reina
('192', @PRIMARIO,'7000'),
('192', @SECUNDARIO,'3000'),
('192', @ENERGIA,'5000'),
#Colmena de Todd
('194', @PRIMARIO,'7000'),
('194', @SECUNDARIO,'3000'),
('194', @ENERGIA,'5000'),

###Defensas.............................................
#Campo deflector
('184', @PRIMARIO,'40000'),
('184', @SECUNDARIO,'5000'),
('184', @ENERGIA,'100000'),
#Insecto iratus
('185', @PRIMARIO,'112'),
('185', @SECUNDARIO,'15'),
('185', @ENERGIA,'80'),

########################################################
# Replicantes...........................................
########################################################
###Tropas...............................................
#Replicante
('196', @PRIMARIO,'15'),
#Replicante avanzado
('197', @PRIMARIO,'35'),
('197', @SECUNDARIO,'2'),
#Replicante humanoide
('198', @PRIMARIO,'600'),
('198', @SECUNDARIO,'800'),
('198', @ENERGIA,'500'),
#Replicante madre
('199', @PRIMARIO,'5000'),
('199', @SECUNDARIO,'1000'),
('199', @ENERGIA,'1500'),
#Exoesqueleto
('201', @PRIMARIO,'600'),
('201', @SECUNDARIO,'800'),
('201', @ENERGIA,'500'),
#Reese
('202', @PRIMARIO,'3000'),
('202', @SECUNDARIO,'2000'),
('202', @ENERGIA,'1500'),
#Quinto
('203', @PRIMARIO,'1500'),
('203', @SECUNDARIO,'2000'),
('203', @ENERGIA,'1500'),
#RepliCarter
('205', @PRIMARIO,'1200'),
('205', @SECUNDARIO,'5000'),
('205', @ENERGIA,'2000'),

###Naves................................................
#Replicante Crucero
('206', @PRIMARIO,'1500'),
('206', @SECUNDARIO,'300'),
('206', @ENERGIA,'3100'),
#Replicante Nave
('207', @PRIMARIO,'3000'),
('207', @SECUNDARIO,'700'),
('207', @ENERGIA,'5000'),
#Nave de Quinto
('208', @PRIMARIO,'6000'),
('208', @SECUNDARIO,'1000'),
('208', @ENERGIA,'5000'),

###Defensas.............................................
#Replicante Iris
('357', @PRIMARIO,'1000'),
('357', @SECUNDARIO,'26000'),
('357', @ENERGIA,'140000'),

########################################################
# Ori..............................................
########################################################
###Tropas...............................................
#Prior
('209', @PRIMARIO,'40'),
('209', @SECUNDARIO,'20'),
#Guerreros Ori
('210', @PRIMARIO,'178'),
('210', @SECUNDARIO,'80'),
#Prior avanzado
('211', @PRIMARIO,'257'),
('211', @SECUNDARIO,'90'),
('211', @ENERGIA,'100'),
#Tomin
('214', @PRIMARIO,'400'),
('214', @SECUNDARIO,'200'),
('214', @ENERGIA,'1500'),
#Orici
('216', @PRIMARIO,'400'),
('216', @SECUNDARIO,'200'),
('216', @ENERGIA,'1500'),
#Doci
('217', @PRIMARIO,'400'),
('217', @SECUNDARIO,'200'),
('217', @ENERGIA,'1500'),
#Prior Invocador
('328', @PRIMARIO,'500'),
('328', @SECUNDARIO,'300'),
('328', @ENERGIA,'1700'),

###Naves................................................
#Caza de incursion
('222', @PRIMARIO,'615'),
('222', @SECUNDARIO,'80'),
('222', @ENERGIA,'310'),
#Nave de guerra
('223', @PRIMARIO,'11850'),
('223', @SECUNDARIO,'5000'),
('223', @ENERGIA,'12000'),
#Nave insignia
('225', @PRIMARIO,'7000'),
('225', @SECUNDARIO,'3000'),
('225', @ENERGIA,'5000'),
#Supernave de Orici
('226', @PRIMARIO,'7000'),
('226', @SECUNDARIO,'3000'),
('226', @ENERGIA,'5000'),
#Pieza del superstargate
('332', @PRIMARIO,'100000'),
('332', @SECUNDARIO,'50000'),
('332', @ENERGIA,'20000'),

###Defensas.............................................
#Campo de fuerza
('219', @PRIMARIO,'60700'),
('219', @SECUNDARIO,'400'),
('219', @ENERGIA,'100000'),
#Comando de defensa
('220', @PRIMARIO,'200'),
('220', @SECUNDARIO,'150'),
('220', @ENERGIA,'80'),
#Satelite Ori
('221', @PRIMARIO,'5742'),
('221', @SECUNDARIO,'150'),
('221', @ENERGIA,'2400'),
#SuperStargate
('509', @ENERGIA,'1000000');

#Constantes con la energia
SET @ENERGIA_OFICIAL   = (SELECT ROUND(AVG(cost.cantidad)) FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id in ('6','50','100','119','146','198','211','174'));
SET @ENERGIA_BC303     = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '35'), 0));
SET @ENERGIA_BC304T    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '36'), 0));
SET @ENERGIA_ALKESHG   = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '87'), 0));
SET @ENERGIA_HATAKG    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '88'), 0));
SET @ENERGIA_NODRIZAG  = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '89'), 0));
SET @ENERGIA_BELIK     = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '105'), 0));
SET @ENERGIA_JACKSON   = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '106'), 0));
SET @ENERGIA_ONEILL    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '107'), 0));
SET @ENERGIA_ALKESHJ   = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '136'), 0));
SET @ENERGIA_HATAKJ    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '137'), 0));
SET @ENERGIA_NODRIZAJ  = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '138'), 0));
SET @ENERGIA_BC304A    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '167'), 0));
SET @ENERGIA_AURORA    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '168'), 0));
SET @ENERGIA_DARDO     = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '187'), 0));
SET @ENERGIA_CRUCERW   = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '189'), 0));
SET @ENERGIA_COLMENA   = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '190'), 0));
SET @ENERGIA_INCURS    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '222'), 0));
SET @ENERGIA_GUERRA    = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '223'), 0));
SET @ENERGIA_NAZIS     = (SELECT IFNULL((SELECT cost.cantidad FROM unidad as u JOIN recursoUnidad as cost ON u.id = cost.idUnidad WHERE cost.idTipoRecurso = '3' AND u.id =  '306'), 0));

INSERT INTO recursoUnidad (idUnidad, idTipoRecurso, cantidad)
VALUES
########################################################
# Sin raza..............................................
########################################################

#############Capturas
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#<<<<<<<<<Tropas Combate
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#Guardia Hathor
('440', @ENERGIA,'25'),
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#<<<<<<<<<Tropas oficiales
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#Jaffa SGC
('458', @ENERGIA, @ENERGIA_OFICIAL),
#Soldado Goauld
('417', @ENERGIA, @ENERGIA_OFICIAL),
#Wraith Goauld
('77', @ENERGIA, @ENERGIA_OFICIAL),
#Wraith humano
('145', @ENERGIA, @ENERGIA_OFICIAL),
#Jaffa Consul
('459', @ENERGIA, @ENERGIA_OFICIAL),
#Wraith centinela
('460', @ENERGIA, @ENERGIA_OFICIAL),
#Humanoide replicante
('200', @ENERGIA, @ENERGIA_OFICIAL),
#Converso
('461', @ENERGIA, @ENERGIA_OFICIAL),
#.
#Antiguo anfitrion
('436', @ENERGIA, @ENERGIA_OFICIAL),
#Adoradores
('347', @ENERGIA, @ENERGIA_OFICIAL),
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#<<<<<<<<<Tropas de heroes
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#Daniel J. Goauld
('54', @ENERGIA,'100'),
#Carter Goauld
('55', @ENERGIA,'100'),
#Kawalsky Goauld
('56', @ENERGIA,'100'),
#Share Goauld
('58', @ENERGIA,'100'),
#Imotep
('66', @ENERGIA,'100'),
#Orici Goauld
('70', @ENERGIA,'100'),
#vala Goauld
('72', @ENERGIA,'100'),
#Michael humano
('151', @ENERGIA,'100'),
#Sheppard Wraith
('179', @ENERGIA,'100'),
#Teyla Wraith
('180', @ENERGIA,'100'),
#Ronon Wraith
('348', @ENERGIA,'100'),
#Daniel J. Prior
('213', @ENERGIA,'100'),
#Vala Prior
('336', @ENERGIA,'100'),
#Gerak Prior
('215', @ENERGIA,'100'),
#Androide ONeill
('350', @ENERGIA,'100'),
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#<<<<<<<<<Naves capturadas
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#Dedalo Goauld
('96', @ENERGIA, ((@ENERGIA_BC304T + @ENERGIA_BC304A)/2)),
#Nave ori Goauld
('97', @ENERGIA, @ENERGIA_GUERRA),
#Dedalo Wraith
('351', @ENERGIA, ((@ENERGIA_BC304T + @ENERGIA_BC304A)/2)),
#Hatak Ori
('224', @ENERGIA, ((@ENERGIA_HATAKJ + @ENERGIA_HATAKG)/2)),
#Prometeos
('667', @ENERGIA, @ENERGIA_BC303),
#Odiseas
('668', @ENERGIA, ((@ENERGIA_BC304T + @ENERGIA_BC304A)/2)),
#Hatak
('669', @ENERGIA, ((@ENERGIA_HATAKJ + @ENERGIA_HATAKG)/2)),
#Nodriza
('670', @ENERGIA, ((@ENERGIA_NODRIZAJ + @ENERGIA_NODRIZAG)/2)),
#Jackson
('671', @ENERGIA, @ENERGIA_JACKSON), 
#Oneill
('672', @ENERGIA, @ENERGIA_ONEILL),  
#Aurora
('673', @ENERGIA, @ENERGIA_AURORA),
#Ori
('674', @ENERGIA, @ENERGIA_GUERRA),
#?
('675', @ENERGIA, @ENERGIA_NAZIS),
#Nave colmena
('676', @ENERGIA, @ENERGIA_COLMENA),
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#<<<<<<<<<Naves Replicantes
#<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#Prometeos
('359', @ENERGIA, @ENERGIA_BC303),
#Odiseas
('360', @ENERGIA, ((@ENERGIA_BC304T + @ENERGIA_BC304A)/2)),
#Hatak
('361', @ENERGIA, ((@ENERGIA_HATAKJ + @ENERGIA_HATAKG)/2)),
#Nodriza
('362', @ENERGIA, ((@ENERGIA_NODRIZAJ + @ENERGIA_NODRIZAG)/2)),
#Jackson
('364', @ENERGIA, @ENERGIA_JACKSON), 
#Oneill
('365', @ENERGIA, @ENERGIA_ONEILL),  
#Aurora
('366', @ENERGIA, @ENERGIA_AURORA),
#Ori
('367', @ENERGIA, @ENERGIA_GUERRA),
#?
('441', @ENERGIA, @ENERGIA_NAZIS),



#############Otros
#Jonas Quin
('12', @PRIMARIO,'600'),
('12', @SECUNDARIO,'450'),
('12', @ENERGIA,'1500'),
#Vala Mal Doran
('13', @PRIMARIO,'400'),
('13', @SECUNDARIO,'700'),
('13', @ENERGIA,'1500'),
#Mayor Paul Davies
('14', @PRIMARIO,'250'),
('14', @SECUNDARIO,'600'),
('14', @ENERGIA,'1500'),
#Mayor Ferreti
('15', @PRIMARIO,'150'),
('15', @SECUNDARIO,'900'),
('15', @ENERGIA,'1500'),
#Mayor Kawalsky
('16', @PRIMARIO,'300'),
('16', @SECUNDARIO,'800'),
('16', @ENERGIA,'1500'),
#Coronel Cameron Mitchell
('17', @PRIMARIO,'400'),
('17', @SECUNDARIO,'800'),
('17', @ENERGIA,'1500'),
#General Jack Oneill
('19', @PRIMARIO,'900'),
('19', @SECUNDARIO,'1200'),
('19', @ENERGIA,'2500'),
#Harry Maybourne
('20', @PRIMARIO,'600'),
('20', @SECUNDARIO,'300'),
('20', @ENERGIA,'1500'),
#Rey Arkhan
('21', @PRIMARIO,'1300'),
('21', @SECUNDARIO,'500'),
('21', @ENERGIA,'1500'),
#Agente Malcom Barret
('22', @PRIMARIO,'600'),
('22', @SECUNDARIO,'300'),
('22', @ENERGIA,'1500'),
#Agente Burke
('23', @PRIMARIO,'150'),
('23', @SECUNDARIO,'900'),
('23', @ENERGIA,'1500'),
#Dra. Carolym Lam
('24', @PRIMARIO,'700'),
('24', @SECUNDARIO,'200'),
('24', @ENERGIA,'1500'),
#Dr. Jay Felger
('25', @PRIMARIO,'1000'),
('25', @SECUNDARIO,'100'),
('25', @ENERGIA,'1500'),
#Kurt Rusell
('26', @PRIMARIO,'1000'),
('26', @SECUNDARIO,'1000'),
('26', @ENERGIA,'1500'),
#Dr. Rush
('27', @PRIMARIO,'1000'),
('27', @SECUNDARIO,'1000'),
('27', @ENERGIA,'1500'),
#General George Hammond
('28', @PRIMARIO,'600'),
('28', @SECUNDARIO,'700'),
('28', @ENERGIA,'1500'),
#Fenix
('40', @PRIMARIO,'6000'),
('40', @SECUNDARIO,'8000'),
('40', @ENERGIA,'6000'),
#Eli Wallace
('344', @PRIMARIO,'800'),
('344', @SECUNDARIO,'900'),
('344', @ENERGIA,'1200'),
#Dave Dixon
('449', @PRIMARIO,'800'),
('449', @SECUNDARIO,'900'),
('449', @ENERGIA,'1200'),
#Jacob Carter
('280', @PRIMARIO, '1000'),
('280', @SECUNDARIO,'700'),
('280', @ENERGIA,  '1000'),
#General Landry
('310', @PRIMARIO, '800'),
('310', @SECUNDARIO,'1100'),
('310', @ENERGIA,'1500'),

#Apophis de Netu
('61', @PRIMARIO,'700'),
('61', @SECUNDARIO,'1000'),
('61', @ENERGIA,'2000'),
#Hathor
('63', @PRIMARIO,'500'),
('63', @SECUNDARIO,'900'),
('63', @ENERGIA,'2000'),
#Herur
('64', @PRIMARIO,'600'),
('64', @SECUNDARIO,'1200'),
('64', @ENERGIA,'2000'),
#Khalek
('65', @PRIMARIO,'1300'),
('65', @SECUNDARIO,'200'),
('65', @ENERGIA,'2000'),
#Yu
('68', @PRIMARIO,'1000'),
('68', @SECUNDARIO,'600'),
('68', @ENERGIA,'2000'),
#Nirrti
('69', @PRIMARIO,'800'),
('69', @SECUNDARIO,'900'),
('69', @ENERGIA,'2000'),
#Osiris
('71', @PRIMARIO,'600'),
('71', @SECUNDARIO,'600'),
('71', @ENERGIA,'1500'),
#Ra
('73', @PRIMARIO,'500'),
('73', @SECUNDARIO,'1000'),
('73', @ENERGIA,'2000'),
#Tanith
('74', @PRIMARIO,'500'),
('74', @SECUNDARIO,'600'),
('74', @ENERGIA,'1500'),
#Sokar
('75', @PRIMARIO,'1200'),
('75', @SECUNDARIO,'500'),
('75', @ENERGIA,'2000'),
#El unas
('76', @PRIMARIO,'500'),
('76', @SECUNDARIO,'500'),
('76', @ENERGIA,'1500'),
#Zipacna
('78', @PRIMARIO,'900'),
('78', @SECUNDARIO,'600'),
('78', @ENERGIA,'2000'),
#Nave Heruur
('442', @PRIMARIO,'7000'),
('442', @SECUNDARIO,'3000'),
('442', @ENERGIA,'5000'),
#Cronus
('383', @PRIMARIO, '900'),
('383', @SECUNDARIO, '900'),
('383', @ENERGIA, '1500'),
#Atenea
('443', @PRIMARIO, '900'),
('443', @SECUNDARIO, '900'),
('443', @ENERGIA, '1500'),
#Apophis
('446', @PRIMARIO, '900'),
('446', @SECUNDARIO, '900'),
('446', @ENERGIA, '1500'),
#Seth
('230', @PRIMARIO, '900'),
('230', @SECUNDARIO, '900'),
('230', @ENERGIA, '1500'),

#Aeronave de Hermiod
('110', @PRIMARIO,'3000'),
('110', @SECUNDARIO,'8000'),
('110', @ENERGIA,'8000'),
#Nave de Kvasir
('111', @PRIMARIO,'3000'),
('111', @SECUNDARIO,'9000'),
('111', @ENERGIA,'8000'),
#Nave de Loki
('447', @PRIMARIO,'3000'),
('447', @SECUNDARIO,'9000'),
('447', @ENERGIA,'8000'),



#Aron
('121', @PRIMARIO,'300'),
('121', @SECUNDARIO,'700'),
('121', @ENERGIA,'1500'),
#Arkad
('122', @PRIMARIO,'400'),
('122', @SECUNDARIO,'800'),
('122', @ENERGIA,'1500'),
#Ishta
('123', @PRIMARIO,'300'),
('123', @SECUNDARIO,'900'),
('123', @ENERGIA,'1500'),
#Gerak
('125', @PRIMARIO,'300'),
('125', @SECUNDARIO,'900'),
('125', @ENERGIA,'1500'),
#Katano
('126', @PRIMARIO,'700'),
('126', @SECUNDARIO,'500'),
('126', @ENERGIA,'1500'),
#Maestro Tealc
('128', @PRIMARIO,'1000'),
('128', @SECUNDARIO,'2000'),
('128', @ENERGIA,'2500'),
#Mzel
('427', @PRIMARIO,'300'),
('427', @SECUNDARIO,'700'),
('427', @ENERGIA,'1500'),
#Haikon
('444', @PRIMARIO,'300'),
('444', @SECUNDARIO,'700'),
('444', @ENERGIA,'1500'),
#Volnek
('445', @PRIMARIO,'300'),
('445', @SECUNDARIO,'700'),
('445', @ENERGIA,'1500'),


#Dra. Jeanie Miller
('147', @PRIMARIO,'300'),
('147', @SECUNDARIO,'400'),
('147', @ENERGIA,'1500'),
#Dr. Carson beckett
('148', @PRIMARIO,'400'),
('148', @SECUNDARIO,'500'),
('148', @ENERGIA,'1500'),
#Clon de Dr. Carson Beckett
('149', @PRIMARIO,'600'),
('149', @SECUNDARIO,'600'),
('149', @ENERGIA,'1500'),
#Teniente Aiden Ford
('152', @PRIMARIO,'300'),
('152', @SECUNDARIO,'1000'),
('152', @ENERGIA,'1500'),
#Ford Dopado
('153', @PRIMARIO,'700'),
('153', @SECUNDARIO,'800'),
('153', @ENERGIA,'1500'),
#Radek Zelenka
('154', @PRIMARIO,'1000'),
('154', @SECUNDARIO,'1000'),
('154', @ENERGIA,'1500'),
#Mayor Evan lorne
('156', @PRIMARIO,'1000'),
('156', @SECUNDARIO,'700'),
('156', @ENERGIA,'1500'),
#Teyla Emmagan
('157', @PRIMARIO,'1100'),
('157', @SECUNDARIO,'1200'),
('157', @ENERGIA,'1500'),
#Cañon Antiaereo antiguo
('163', @PRIMARIO, '10000'),
('163', @SECUNDARIO, '25000'),
('163', @ENERGIA, '10000'),
#Apollo
('170', @PRIMARIO,'4000'),
('170', @SECUNDARIO,'9000'),
('170', @ENERGIA,'7000'),
#Dr. Rodney Mckay
('430', @PRIMARIO,'200'),
('430', @SECUNDARIO,'400'),
('430', @ENERGIA,'1500'),
#Dra. Weir
('311', @PRIMARIO,'1000'),
('311', @SECUNDARIO,'900'),
('311', @ENERGIA,'1500'),
#Wolsey
('312', @PRIMARIO,'1200'),
('312', @SECUNDARIO,'900'),
('312', @ENERGIA,'1500'),


#Tyre
('177', @PRIMARIO,'300'),
('177', @SECUNDARIO,'600'),
('177', @ENERGIA,'1500'),
#Michael
('182', @PRIMARIO,'1500'),
('182', @SECUNDARIO,'800'),
('182', @ENERGIA,'1500'),
#Colmena de Michael
('193', @PRIMARIO,'10000'),
('193', @SECUNDARIO,'10000'),
('193', @ENERGIA,'5000'),
#La Primera
('195', @PRIMARIO,'20000'),
('195', @SECUNDARIO,'20000'),
('195', @ENERGIA,'7000'),

#Primero
('204', @PRIMARIO,'1800'),
('204', @SECUNDARIO,'1800'),
('204', @ENERGIA,'1500'),

#El administrador
('212', @PRIMARIO,'300'),
('212', @SECUNDARIO,'700'),
('212', @ENERGIA,'1500'),


########################################################
# Sin raza..............................................
########################################################

########################################  Exploradores  ####################################################################################
#Reol
('228', @PRIMARIO,  '30'),
('228', @SECUNDARIO,'30'),
#Ursini
('434', @PRIMARIO,  '30'),
('434', @SECUNDARIO,'30'),
########################################  Recolectores  ####################################################################################
#Mastadge
('231', @PRIMARIO,  '100'),
('231', @SECUNDARIO,'100'),
#Athosianos
('233', @PRIMARIO,  '30'),
('233', @SECUNDARIO,'20'),
#Amazonas Jaffa
('115', @PRIMARIO,  '30'),
('115', @SECUNDARIO,'20'),
#Androide
('261', @PRIMARIO,  '30'),
('261', @SECUNDARIO,'20'),
########################################  Combate  ########################################################################################
#Impuros
('227', @PRIMARIO,  '70'),
('227', @SECUNDARIO,'60'),
#Whisper
('250', @PRIMARIO,  '60'),
('250', @SECUNDARIO,'50'),
('250', @ENERGIA,    '5'),
#Guerreros de arkhan
('315', @PRIMARIO,  '70'),
('315', @SECUNDARIO,'60'),
#Guerrero de Kera
('316', @PRIMARIO,  '70'),
('316', @SECUNDARIO,'60'),
#Salish
('232', @PRIMARIO,  '70'),
('232', @SECUNDARIO,'60'),

#Guerrero de Juna
('235', @PRIMARIO, '100'),
('235', @SECUNDARIO,'95'),
#Comando Tokra
('240', @PRIMARIO, '100'),
('240', @SECUNDARIO,'95'),
#Prisionero olesiano
('245', @PRIMARIO, '100'),
('245', @SECUNDARIO,'95'),
#Rebeldes antiori
('236', @PRIMARIO, '100'),
('236', @SECUNDARIO,'95'),
#Guerrilla de abydos
('244', @PRIMARIO, '100'),
('244', @SECUNDARIO,'95'),
#Bola Kai
('238', @PRIMARIO, '100'),
('238', @SECUNDARIO,'95'),
#Guerrero Vikingo
('234', @PRIMARIO, '100'),
('234', @SECUNDARIO,'95'),

#Milicia de Rand y Caledonia
('243', @PRIMARIO,  '110'),
('243', @SECUNDARIO,'110'),
#Comando Genii
('239', @PRIMARIO,  '110'),
('239', @SECUNDARIO,'110'),
#Comando SG Ruso
('4', @PRIMARIO,  '110'),
('4', @SECUNDARIO,'110'),
#Saqueador del NID
('5', @PRIMARIO,  '110'),
('5', @SECUNDARIO,'110'),
#Guerrilleros langarianos
('237', @PRIMARIO,  '110'),
('237', @SECUNDARIO,'110'),

#Sodlado Bedrosiano
('251', @PRIMARIO,  '120'),
('251', @SECUNDARIO,'120'),
#Sodlado Eurondano
('252', @PRIMARIO,  '120'),
('252', @SECUNDARIO,'120'),
#Guarda tontolano
('253', @PRIMARIO,  '120'),
('253', @SECUNDARIO,'120'),
#Miliciano de Hallona
('242', @PRIMARIO,  '120'),
('242', @SECUNDARIO,'120'),
#Prisioneros de Netu
('255', @PRIMARIO,  '120'),
('255', @SECUNDARIO,'120'),
#Guerrero Sherakin
('249', @PRIMARIO,  '120'),
('249', @SECUNDARIO,'120'),
#Guardio Horus
('46', @PRIMARIO,  '120'),
('46', @SECUNDARIO,'120'),
#Guardia de Baal
('47', @PRIMARIO,  '120'),
('47', @SECUNDARIO,'120'),
#Guardia de Sokar
('48', @PRIMARIO,  '120'),
('48', @SECUNDARIO,'120'),

#Jaffa Ninja
('116', @PRIMARIO,  '130'),
('116', @SECUNDARIO,'130'),
#Jaffas de Imhotep
('117', @PRIMARIO,  '130'),
('117', @SECUNDARIO,'130'),
#Stragoth
('229', @PRIMARIO,  '130'),
('229', @SECUNDARIO,'130'),
#Unas silvestre
('247', @PRIMARIO,  '130'),
('247', @SECUNDARIO,'130'),
#Unas Goauld
('248', @PRIMARIO,  '130'),
('248', @SECUNDARIO,'130'),

#Reetou
('246', @PRIMARIO,  '150'),
('246', @SECUNDARIO,'150'),
('246', @ENERGIA,   '25'),
#Guerrilla de ford
('258', @PRIMARIO,  '150'),
('258', @SECUNDARIO,'150'),
('258', @ENERGIA,   '25'),
#? Nazis del espacio
('260', @PRIMARIO,  '150'),
('260', @SECUNDARIO,'150'),
('260', @ENERGIA,   '25'),
#Guardia chacal
('45', @PRIMARIO,  '150'),
('45', @SECUNDARIO,'150'),
('45', @ENERGIA,   '20'),
#Hibrido
('175', @PRIMARIO,  '150'),
('175', @SECUNDARIO,'150'),
('175', @ENERGIA,   '25'),
#Moto goauld
('429', @PRIMARIO,  '150'),
('429', @SECUNDARIO,'150'),
('429', @ENERGIA,    '30'),
#Bestia
('389', @PRIMARIO,   '200'),
('389', @SECUNDARIO, '200'),
('389', @ENERGIA,     '35'),
########################################  Oficiales  ########################################################################################
#Illac Renin
('353', @PRIMARIO,  '150'),
('353', @SECUNDARIO,'150'),

#Miliciano de la coalicion
('241', @PRIMARIO,  '160'),
('241', @SECUNDARIO,'160'),

#Oficial SG Ruso
('7', @PRIMARIO,  '220'),
('7', @SECUNDARIO,'220'),

#Oficial Genii
('262', @PRIMARIO,  '180'),
('262', @SECUNDARIO,'200'),
('262', @ENERGIA,    '30'),

#Oficiales satedanos
('259', @PRIMARIO,  '190'),
('259', @SECUNDARIO,'200'),
('259', @ENERGIA,    '70'),

#Lucian mercenario
('399', @PRIMARIO,  '250'),
('399', @SECUNDARIO,'250'),
('399', @ENERGIA,    '90'),
#Humanos mutados
('254', @PRIMARIO,  '300'),
('254', @SECUNDARIO,'300'),
('254', @ENERGIA,   '100'),

#Monje de Kheb
('256', @PRIMARIO,  '400'),
('256', @SECUNDARIO,'400'),
('256', @ENERGIA,   '300'),

########################################  Asesino  ##########################################################################################
#Guerreros Sodan
('414', @PRIMARIO,  '250'),
('414', @SECUNDARIO,'250'),
('414', @ENERGIA,    '90'),
#Asesino Tokra
('263', @PRIMARIO,  '300'),
('263', @SECUNDARIO,'300'),
('263', @ENERGIA,    '70'),
#Guardia Dragon
('426', @PRIMARIO,  '400'),
('426', @SECUNDARIO,'400'),
('426', @ENERGIA,   '100'),
#Ashrak
('52', @PRIMARIO,  '400'),
('52', @SECUNDARIO,'400'),
('52', @ENERGIA,   '100'),
########################################  Heroes Tropa  ######################################################################################
#Lucius Lavin
('264', @PRIMARIO,  '900'),
('264', @SECUNDARIO,'900'),
('264', @ENERGIA,  '1000'),
#Harlan
('265', @PRIMARIO,  '900'),
('265', @SECUNDARIO,'900'),
('265', @ENERGIA,  '1000'),
#Linea
('266', @PRIMARIO,  '900'),
('266', @SECUNDARIO,'900'),
('266', @ENERGIA,  '1000'),
#Shaure
('267', @PRIMARIO,  '900'),
('267', @SECUNDARIO,'900'),
('267', @ENERGIA,  '1000'),
#Machelo
('268', @PRIMARIO,  '900'),
('268', @SECUNDARIO,'900'),
('268', @ENERGIA,  '1000'),
#Anise
('269', @PRIMARIO,  '900'),
('269', @SECUNDARIO,'900'),
('269', @ENERGIA,  '1000'),
#Martouf
('270', @PRIMARIO,  '900'),
('270', @SECUNDARIO,'900'),
('270', @ENERGIA,  '1000'),
#Skaraa
('271', @PRIMARIO,  '900'),
('271', @SECUNDARIO,'900'),
('271', @ENERGIA,  '1000'),
#Kasuf
('272', @PRIMARIO,  '900'),
('272', @SECUNDARIO,'900'),
('272', @ENERGIA,  '1000'),
#Omal
('273', @PRIMARIO,  '900'),
('273', @SECUNDARIO,'900'),
('273', @ENERGIA,  '1000'),
#Narim
('274', @PRIMARIO,  '900'),
('274', @SECUNDARIO,'900'),
('274', @ENERGIA,  '1000'),
#Jolinar
('275', @PRIMARIO,  '900'),
('275', @SECUNDARIO,'900'),
('275', @ENERGIA,  '1000'),
#Chaka
('276', @PRIMARIO,  '900'),
('276', @SECUNDARIO,'900'),
('276', @ENERGIA,  '1000'),
#Larrin
('277', @PRIMARIO,  '900'),
('277', @SECUNDARIO,'900'),
('277', @ENERGIA,  '1000'),
#Warrick
('278', @PRIMARIO,  '900'),
('278', @SECUNDARIO,'900'),
('278', @ENERGIA,  '1000'),
#Aris Boch
('279', @PRIMARIO,  '900'),
('279', @SECUNDARIO,'900'),
('279', @ENERGIA,  '1000'),
#Kynk
('281', @PRIMARIO,  '900'),
('281', @SECUNDARIO,'900'),
('281', @ENERGIA,  '1000'),
#Kolya
('282', @PRIMARIO,  '900'),
('282', @SECUNDARIO,'900'),
('282', @ENERGIA,  '1000'),
#Furlings
('283', @PRIMARIO,  '900'),
('283', @SECUNDARIO,'900'),
('283', @ENERGIA,  '1000'),
#Nox
('284', @PRIMARIO,  '900'),
('284', @SECUNDARIO,'900'),
('284', @ENERGIA,  '1000'),
#Orlin
('286', @PRIMARIO,  '900'),
('286', @SECUNDARIO,'900'),
('286', @ENERGIA,  '1000'),
#Chaya Sar
('314', @PRIMARIO,  '900'),
('314', @SECUNDARIO,'900'),
('314', @ENERGIA,  '1000'),
#Neeva Casol
('337', @PRIMARIO,  '900'),
('337', @SECUNDARIO,'900'),
('337', @ENERGIA,  '1000'),
#Ladom Radin
('343', @PRIMARIO,  '900'),
('343', @SECUNDARIO,'900'),
('343', @ENERGIA,  '1000'),
#Khonsu
('346', @PRIMARIO,  '900'),
('346', @SECUNDARIO,'900'),
('346', @ENERGIA,  '1000'),
#El guarda
('352', @PRIMARIO,  '900'),
('352', @SECUNDARIO,'900'),
('352', @ENERGIA,  '1000'),
#Jonas Hanson
('368', @PRIMARIO,   '900'),
('368', @SECUNDARIO, '900'),
('368', @ENERGIA,   '1000'),
#Jared Kane
('372', @PRIMARIO,   '900'),
('372', @SECUNDARIO, '900'),
('372', @ENERGIA,   '1000'),
#Merlin
('373', @PRIMARIO,   '900'),
('373', @SECUNDARIO, '900'),
('373', @ENERGIA,   '1000'),
#Meurik
('374', @PRIMARIO,   '900'),
('374', @SECUNDARIO, '900'),
('374', @ENERGIA,   '1000'),
#Cowen
('375', @PRIMARIO,   '900'),
('375', @SECUNDARIO, '900'),
('375', @ENERGIA,   '1000'),
#Burrock
('376', @PRIMARIO,   '900'),
('376', @SECUNDARIO, '900'),
('376', @ENERGIA,   '1000'),
#Gairwyn
('377', @PRIMARIO,   '900'),
('377', @SECUNDARIO, '900'),
('377', @ENERGIA,   '1000'),
#Iron shirt
('378', @PRIMARIO,   '900'),
('378', @SECUNDARIO, '900'),
('378', @ENERGIA,   '1000'),
#Omoc
('379', @PRIMARIO,   '900'),
('379', @SECUNDARIO, '900'),
('379', @ENERGIA,   '1000'),
#Mollem
('381', @PRIMARIO,   '900'),
('381', @SECUNDARIO, '900'),
('381', @ENERGIA,   '1000'),
#Hallina
('382', @PRIMARIO,   '900'),
('382', @SECUNDARIO, '900'),
('382', @ENERGIA,   '1000'),
#Egeria
('384', @PRIMARIO,   '900'),
('384', @SECUNDARIO, '900'),
('384', @ENERGIA,   '1000'),
#Allina
('386', @PRIMARIO,   '900'),
('386', @SECUNDARIO, '900'),
('386', @ENERGIA,   '1000'),
#Kiva
('391', @PRIMARIO,   '900'),
('391', @SECUNDARIO, '900'),
('391', @ENERGIA,   '1000'),
#Netan
('392', @PRIMARIO,   '900'),
('392', @SECUNDARIO, '900'),
('392', @ENERGIA,   '1000'),
#Simeon
('393', @PRIMARIO,   '900'),
('393', @SECUNDARIO, '900'),
('393', @ENERGIA,   '1000'),
#Ginn
('394', @PRIMARIO,   '900'),
('394', @SECUNDARIO, '900'),
('394', @ENERGIA,   '1000'),
#Varro
('396', @PRIMARIO,   '900'),
('396', @SECUNDARIO, '900'),
('396', @ENERGIA,   '1000'),
#Tenat & Jup
('397', @PRIMARIO,   '900'),
('397', @SECUNDARIO, '900'),
('397', @ENERGIA,   '1000'),
#Seevis
('402', @PRIMARIO,   '900'),
('402', @SECUNDARIO, '900'),
('402', @ENERGIA,   '1000'),
#Katana Labrea
('404', @PRIMARIO,   '900'),
('404', @SECUNDARIO, '900'),
('404', @ENERGIA,   '1000'),


#Lider Prior
('313', @PRIMARIO,'1200'),
('313', @SECUNDARIO,'1100'),
('313', @ENERGIA,'1500'),
#Bastet
('317', @PRIMARIO,'130'),
('317', @SECUNDARIO,'200'),
('317', @ENERGIA,'1500'),
#Dr. Lee
('318', @PRIMARIO,'1000'),
('318', @SECUNDARIO,'1200'),
('318', @ENERGIA,'1500'),
#Coronel Chekov
('319', @PRIMARIO,'1000'),
('319', @SECUNDARIO,'1100'),
('319', @ENERGIA,'1500'),
#Segundo
('320', @PRIMARIO,'1300'),
('320', @SECUNDARIO,'2000'),
('320', @ENERGIA,'1500'),
#Tercero
('321', @PRIMARIO,'1000'),
('321', @SECUNDARIO,'2500'),
('321', @ENERGIA,'1500'),
#Cuarto
('322', @PRIMARIO,'1000'),
('322', @SECUNDARIO,'2500'),
('322', @ENERGIA,'1500'),
#Steve
('323', @PRIMARIO,'900'),
('323', @SECUNDARIO,'500'),
('323', @ENERGIA,'1500'),
#Comandante de La primera
('324', @PRIMARIO,'1200'),
('324', @SECUNDARIO,'1000'),
('324', @ENERGIA,'1500'),
#Coronel Carter
('325', @PRIMARIO,'1300'),
('325', @SECUNDARIO,'1200'),
('325', @ENERGIA,'1500'),
#James
('326', @PRIMARIO,'1400'),
('326', @SECUNDARIO,'1100'),
('326', @ENERGIA,'1500'),
#Reina Mayor
('327', @PRIMARIO,'1300'),
('327', @SECUNDARIO,'1100'),
('327', @ENERGIA,'1500'),
#Escuadron de Katano
('329', @PRIMARIO,'7000'),
('329', @SECUNDARIO,'7000'),
('329', @ENERGIA,'6000'),
#El carro de Thor
('330', @PRIMARIO,'6000'),
('330', @SECUNDARIO,'6000'),
('330', @ENERGIA,'5000'),
#Kenny
('331', @PRIMARIO,'1300'),
('331', @SECUNDARIO,'1000'),
('331', @ENERGIA,'1500'),
#Ryac
('333', @PRIMARIO,'1000'),
('333', @SECUNDARIO,'900'),
('333', @ENERGIA,'1500'),
#Damaris
('334', @PRIMARIO,'1800'),
('334', @SECUNDARIO,'1300'),
('334', @ENERGIA,'1500'),
#Sun TZu
('340', @PRIMARIO,'20000'),
('340', @SECUNDARIO,'20000'),
('340', @ENERGIA,'8000'),
#Brian
('345', @PRIMARIO,'800'),
('345', @SECUNDARIO,'900'),
('345', @ENERGIA,'1500'),
#Adoradores wraith
('347', @PRIMARIO,'500'),
('347', @SECUNDARIO,'250'),
#F.R.A.N.
('349', @PRIMARIO,'1100'),
('349', @SECUNDARIO,'1000'),
('349', @ENERGIA,'1300'),
#Dreyauc
('369', @PRIMARIO, '900'),
('369', @SECUNDARIO, '900'),
('369', @ENERGIA, '1500'),
#Shanauc
('370', @PRIMARIO, '900'),
('370', @SECUNDARIO, '900'),
('370', @ENERGIA, '1500'),
#Camulus
('371', @PRIMARIO, '900'),
('371', @SECUNDARIO, '900'),
('371', @ENERGIA, '1500'),
#Valar
('380', @PRIMARIO, '900'),
('380', @SECUNDARIO, '900'),
('380', @ENERGIA, '1500'),
#Cassandra Frasier
('385', @PRIMARIO, '900'),
('385', @SECUNDARIO, '900'),
('385', @ENERGIA, '1500'),
#El Exiliado
('387', @PRIMARIO, '900'),
('387', @SECUNDARIO, '900'),
('387', @ENERGIA, '1500'),
#Kanaan
('388', @PRIMARIO, '900'),
('388', @SECUNDARIO, '900'),
('388', @ENERGIA, '1500'),
#Camile Wray
('390', @PRIMARIO, '900'),
('390', @SECUNDARIO, '900'),
('390', @ENERGIA, '1500'),
#Coronel David Telford
('395', @PRIMARIO, '900'),
('395', @SECUNDARIO, '900'),
('395', @ENERGIA, '1500'),
#Coronel Everett Young
('400', @PRIMARIO, '900'),
('400', @SECUNDARIO, '900'),
('400', @ENERGIA, '1500'),
#Prior Ver Erger
('401', @PRIMARIO, '900'),
('401', @SECUNDARIO, '900'),
('401', @ENERGIA, '1500'),
#Prior de la Vía Láctea
('403', @PRIMARIO, '900'),
('403', @SECUNDARIO, '900'),
('403', @ENERGIA, '1500'),
#Alto consejero Freyr
('405', @PRIMARIO, '900'),
('405', @SECUNDARIO, '900'),
('405', @ENERGIA, '1500'),
#Alto consejero Penegal
('406', @PRIMARIO, '900'),
('406', @SECUNDARIO, '900'),
('406', @ENERGIA, '1500'),
#Escuadron Vanir
('407', @PRIMARIO, '900'),
('407', @SECUNDARIO, '900'),
('407', @ENERGIA, '1500'),

#Sora
('437', @PRIMARIO,   '900'),
('437', @SECUNDARIO, '900'),
('437', @ENERGIA,   '1000'),
#Xels
('448', @PRIMARIO,   '900'),
('448', @SECUNDARIO, '900'),
('448', @ENERGIA,   '1000'),
########################################  Caza Pesado  ######################################################################################
#Cosechadora Ashen
('297', @PRIMARIO,  '25'),
('297', @SECUNDARIO,'25'),
('297', @ENERGIA,   '30'),
#? Nazis del espacio caza
('299', @PRIMARIO,  '400'),
('299', @SECUNDARIO,'400'),
('299', @ENERGIA,   '300'),
#Caza bedrosiano
('298', @PRIMARIO,  '400'),
('298', @SECUNDARIO,'400'),
('298', @ENERGIA,   '300'),
#Caza de osiris
('85', @PRIMARIO,  '350'),
('85', @SECUNDARIO,'450'),
('85', @ENERGIA,   '350'),
########################################  Crucero  ##########################################################################################
#Alkesh de carga
('87', @PRIMARIO, '1200'),
('87', @SECUNDARIO,'900'),
('87', @ENERGIA,  '1600'),
#Nave Olesiana
('342', @PRIMARIO, '1300'),
('342', @SECUNDARIO,'900'),
('342', @ENERGIA,  '1600'),
#Crucero traveller
('303', @PRIMARIO,  '1500'),
('303', @SECUNDARIO,'1000'),
('303', @ENERGIA,   '1600'),
########################################  Nodriza  ##########################################################################################
#? Nazis del espacio
('306', @PRIMARIO,  '2750'),
('306', @SECUNDARIO,'4500'),
('306', @ENERGIA,   '5000'),
########################################  Heroes Nave  ######################################################################################
#TimeJumper
('450', @PRIMARIO,'1000'),
('450', @SECUNDARIO,'800'),
('450', @ENERGIA,'1500'),
#------------------------
#Serenity
('307', @PRIMARIO,'1000'),
('307', @SECUNDARIO,'1000'),
('307', @ENERGIA,'1000'),
#Crucero de katana
('308', @PRIMARIO,'1600'),
('308', @SECUNDARIO,'1100'),
('308', @ENERGIA,'2000'),
#Seberus
('301', @PRIMARIO,'1000'),
('301', @SECUNDARIO,'1000'),
('301', @ENERGIA,'1000'),
#Terraformador
('431', @PRIMARIO,'3000'),
('431', @SECUNDARIO,'3000'),
('431', @ENERGIA,'1500'),
#------------------------
#Nave de Martin Lloyd
('304', @PRIMARIO,'1400'),
('304', @SECUNDARIO,'1400'),
('304', @ENERGIA,'1500'),
#Comandante
('432', @PRIMARIO,'3000'),
('432', @SECUNDARIO,'3000'),
('432', @ENERGIA,'1500'),
#------------------------
#Nave de propulsion lantiana
('302', @PRIMARIO,'4000'),
('302', @SECUNDARIO,'4000'),
('302', @ENERGIA,'3000'),
#Nave de la nebulosa
('305', @PRIMARIO,'10000'),
('305', @SECUNDARIO,'10000'),
('305', @ENERGIA,'7000'),
#Aurora de Larrin
('309', @PRIMARIO,'2200'),
('309', @SECUNDARIO,'1800'),
('309', @ENERGIA,'2000'),
#Sombra
('435', @PRIMARIO,'3000'),
('435', @SECUNDARIO,'3000'),
('435', @ENERGIA,'1500'),
#Nave ursini
('433', @PRIMARIO,'3000'),
('433', @SECUNDARIO,'3000'),
('433', @ENERGIA,'1500'),
#------------------------
#Nave Nox
('418', @PRIMARIO, '250000'),
('418', @SECUNDARIO, '250000'),
('418', @ENERGIA, '50000'),
########################################  Defensa Stargate  ######################################################################################
#Campode defensa eurondano
('296', @PRIMARIO,  '10000'),
('296', @SECUNDARIO,'10000'),
('296', @ENERGIA,   '50000'),
#Praxyon
('438', @PRIMARIO,  '10000'),
('438', @SECUNDARIO,'10000'),
('438', @ENERGIA,   '50000'),
########################################  Defensa Terrestre  ######################################################################################
#Canon flotante
('291', @PRIMARIO,  '117'),
('291', @SECUNDARIO,'180'),
('291', @ENERGIA,    '80'),
#Ente Lantiana
('290', @PRIMARIO,  '120'),
('290', @SECUNDARIO,'200'),
('290', @ENERGIA,    '80'),
#Ente
('293', @PRIMARIO,  '140'),
('293', @SECUNDARIO,'220'),
('293', @ENERGIA,    '80'),
#Xenomorfo
('186', @PRIMARIO,  '160'),
('186', @SECUNDARIO,'240'),
('186', @ENERGIA,    '90'),
#Caballero negro
('289', @PRIMARIO,  '180'),
('289', @SECUNDARIO,'250'),
('289', @ENERGIA,    '90'),
#Torre de minidrones
('292', @PRIMARIO,  '200'),
('292', @SECUNDARIO,'260'),
('292', @ENERGIA,   '100'),
########################################  Defensa Aerea  ######################################################################################
#Canon artesano
('288', @PRIMARIO,  '150'),
('288', @SECUNDARIO,'200'),
('288', @ENERGIA,    '50'),
#Caza teledirigido
('300', @PRIMARIO,  '300'),
('300', @SECUNDARIO,'300'),
('300', @ENERGIA,   '100'),
#Dragon
('294', @PRIMARIO,  '1500'),
('294', @SECUNDARIO,'2000'),
('294', @ENERGIA,    '600'),
#Canon de iones Tollano
('295', @PRIMARIO,  '3000'),
('295', @SECUNDARIO,'3000'),
('295', @ENERGIA,   '2000'),
########################################  Defensa orbital  ######################################################################################
#Satelite Geldar
('439', @PRIMARIO,  '2000'),
('439', @SECUNDARIO,'2000'),
('439', @ENERGIA,   '1500');

#############################################################################################################################################
## Costes de unidades
#############################################################################################################################################
INSERT INTO unidadRequerida (idUnidadRequerida, idUnidadRequiere, cantidad)
VALUES
(197,196,3),  #Un replicante avanzado requiere 4 replicantes
(199,196,20), #Un replicante madre requiere 40 replicantes
(203,196,30), #Quinto requiere 90 replicantes
(205,196,50), #Replicarter requiere 90 replicantes
(206,196,10), #Un replicante crucero requiere 50 replicantes
(207,196,15), #Un replicante nave requiere 90 replicantes
(208,196,70), #La nave de Quinto requiere 90 replicantes

####################Heroes Tauri#################
(12,   8, 1), #Jonas Quin requiere Daniel Jackson
(13,   8, 1), #Vala requiere Daniel Jackson
(16,   8, 1), #Kawalsky requiere Daniel
(17,  18, 1), #Mitchell requiere ONeill
(22,  11, 1), #Barrett requiere Carter
(23,  18, 1), #Burke requiere ONeill
(24,  10, 1), #Lam requiere Fraiser
(25,  11, 1), #Felger requiere Carter
(26,  18, 1), #Kurt Rusell ONeill requiere ONeill
(390,  8, 1), #Wray requiere Daniel Jackson
(319, 18, 1), #Chekov requiere ONeill
(385, 10, 1), #Cassandra requiere Fraiser
(340, 39, 1), #Sun tzu requiere odisea
(40, 339, 1), #Phoenix requiere Hammond
(40,  11, 1), #Phoenix requiere Carter
(280, 11, 1), #Jacob requiere Carter
(318, 11, 1), #Lee requiere Carter
(395, 18, 1), #Telford requiere ONeill
(449, 18, 1), #Dixon requiere ONeill
#...Cruzados...#
#Base Alpha & Base Beta
(28,  18, 1), #Hammond requiere ONeill
(15,  28, 1), #Ferretti requiere Gen. Hammond
(310, 18, 1), #Landry requiere ONeill
(14, 310, 1), #Davies requiere Gen. Landry
#La Tierra & Base Icaro
(27,   8, 1), #Rush requiere Daniel Jackson
(344, 27, 1), #Eli requiere Rush
(19,  18, 1), #General ONeill requiere ONeill
(400, 19, 1), #Young requiere Gen. ONeill

####################Heroes Goauld#################
(63,  60, 1), #Hathor requiere Apophis
(64,  60, 1), #Herur requiere Apophis
(64,  53, 1), #Kalel requiere Thot
(68,  60, 1), #Yu requiere Apophis
(69,  60, 1), #Nirrti requiere Apophis
(71,  60, 1), #Osiris requiere Apophis
(73,  62, 1), #Ra requiere Baal
(74,  53, 1), #Tanith requiere Thot
(75,  62, 1), #Sokar requiere Baal
(76,  53, 1), #Unas requiere Thot
(78,  60, 1), #Zipacna requiere Apophis
(317, 60, 1), #Bastet requiere Apophis
(371, 60, 1), #Camulus requiere Apophis
(383, 60, 1), #Cronus requiere Apophis
(61,  60,  1), #Aphosis Netu requiere Apophis
(442, 95, 1), #Nave Heruur requiere Estacion
(443, 62, 1), #Atenea requiere Baal
(446, 60, 1), #Apophis requiere Apophis
(230, 60, 1), #Seth requiere Apophis

####################Heroes Asgard#################
(110, 108, 1), #Hermiod requiere Heimdall
(111, 109, 1), #Kvasir requiere Valhalla
(330, 109, 1), #Carro de Thor requiere Valhalla
(405, 109, 1), #Freyr requiere Valhalla
(406, 109, 1), #Penegal requiere Valhalla
(407, 109, 1), #Vanir requiere Valhalla
(447, 109, 1), #Loki requiere Valhalla

####################Heroes Jaffa#################
(121, 127, 1), #Aron requiere Tealc
(123, 127, 1), #Ishta requiere Tealc
(125, 129, 1), #Gerak requiere Bratac
(126, 127, 1), #Ktano requiere Tealc
(333, 127, 1), #Ryac requiere Tealc
(369, 127, 1), #Dreyac requiere Tealc
(370, 127, 1), #Shanauc requiere Tealc
(380, 127, 1), #Valar requiere Tealc
(128, 127, 1), #Maestro Tealc requiere Tealc
(427, 124, 1), #Mzel requiere Raknor
(329, 126, 1), #Esc. Ktano requiere Ktano
(444, 124, 1), #Haikon requiere Jolan
(445, 124, 1), #Volnek requiere Jolan

####################Heroes Atlantis#################
(147, 155, 1), #Miller requiere Mckay
(148, 155, 1), #Carson requiere Mckay
(149, 155, 1), #Carson Cl. requiere Mckay
(154, 155, 1), #Zelenka requiere McKay
(156, 158, 1), #Lorne requiere Ronon
(157, 159, 1), #Teyla requiere Sheppard
(311, 155, 1), #Weir requiere Sheppard
(312, 155, 1), #Woolsey requiere McKay
(170, 169, 1), #Apollo requiere Dedalo
(325, 159, 1), #Coronel Carter requiere Sheppard
(430, 155, 1), #Rod requiere Mckay
#...Cruzados...#
#Lantis & Planeta Ford
(152, 159, 1), #Tnte. Ford requiere Sheppard
(153, 152, 1), #Ford requiere Tnte. Ford

####################Heroes Wraith#################
(177, 176, 1), #Tyre requiere Cazador
(182, 181, 1), #Michael requiere Rey
(193, 181, 1), #Colm. Micha requiere Rey
(195, 192, 1), #La Primera requiere Reina
(323, 176, 1), #Steve requiere Cazador
(324, 176, 1), #Comandante Primera requiere Cazador
(326, 176, 1), #James requiere Cazador
(327, 178, 1), #Reina requiere Guardiana
(331, 176, 1), #Kenny requiere Cazador
(345, 183, 1), #Brian requiere Todd
(387, 176, 1), #Wraith podrido requiere Cazador

####################Heroes Replicante#################
(204, 203, 1), #Primero requiere Quinto
(320, 203, 1), #Segundo requiere Quinto
(321, 203, 1), #Tercero requiere Quinto
(322, 203, 1), #Cuarto requiere Quinto

####################Heroes Ori#################
(212, 216, 1), #Profeta requiere Orici
(313, 216, 1), #Lider requiere Orici
(334, 216, 1), #Damaris requiere Orici
(401, 216, 1), #Prior Ver eger requiere Orici
(403, 216, 1), #Prior Ver eger requiere Orici

(509,332,100), #SuperStargate requiere 100 piezas
(509,328,1), #SuperStargate requiere Prior Invocador

####################Heroes Planetas#################
(21, 20, 1), #Arkham requiere Meybourne
(418,283,1), #Ciudad Nox requiere Nox
(418,284,1), #Ciudad Nox requiere Furlings
(429,43,1), #Moto requiere Guardia personal
#...Cruzados...#
#Alianza Luciana
(393, 392, 1), #Simeon requiere Netan
(396, 391, 1), #Varro requiere Kiva

#Travellers
(309, 277, 1), #Nave de Larrin requiere Larrin
(308, 404, 1); #Nave de Katana requiere Katana


#############################################################################################################################################
## Capturas de unidades por raza
#############################################################################################################################################
INSERT INTO `razaCapturaUnidad` (`idRaza`, `idUnidadCapturada`, `idUnidadConvertida`, `porcentaje`) 
VALUES 
(@REPLICANTES,35,359,50), #Prometeos
(@REPLICANTES,36,360,40), #Odiseas
(@REPLICANTES,88,361,50), #Hatak g
(@REPLICANTES,89,362,40), #Nodriza g
(@REPLICANTES,96,360,40), #Odiseas g
(@REPLICANTES,97,367,30), #Ori g
(@REPLICANTES,106,364,55), #Jackson
(@REPLICANTES,107,365,50), #Oneill
(@REPLICANTES,137,361,50), #Hatak j
(@REPLICANTES,138,362,40), #Nodriza j
(@REPLICANTES,167,360,40), #Odiseas
(@REPLICANTES,168,366,35), #Aurora
(@REPLICANTES,223,367,30), #Ori
(@REPLICANTES,224,361,50), #Hatak j ori
(@REPLICANTES,351,360,80), #Odiseas Wraith
(@REPLICANTES,306,441,80), #?
(@REPLICANTES,667,359,50), #Prometeos capt.
(@REPLICANTES,668,360,40), #Odiseas capt.
(@REPLICANTES,669,361,50), #Hatak g capt.
(@REPLICANTES,670,362,40), #Nodriza g capt.
(@REPLICANTES,671,364,55), #Jackson capt.
(@REPLICANTES,672,365,50), #Oneill capt.
(@REPLICANTES,673,366,35), #Aurora capt.
(@REPLICANTES,674,367,30), #Ori capt.
(@REPLICANTES,675,441,80); #? capt.
