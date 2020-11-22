##
## Especiales
##

#especial
INSERT INTO especial (idEspecial, nombre, descripcion, especificacion, tiempoRecarga, tiempoDuracion, activo)
VALUES

#.............................................
#.................Tauri.......................
#.............................................

(1  ,'Refuerzos del SGC'
    ,'El Stargate Command es el lugar donde está situado el Stargate de La Tierra. Si se lo solicitan, puede enviar representantes para evaluar una situación o mandar refuerzos en caso de emergencia.'
    ,'Aumenta la producción de refuerzos y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(2  ,'Aliados Jaffa'
    ,'Los Jaffa y los Tau\'ri mantienen una fuerte alianza desde la unión de Teal\'c al SG-1. Ambos se han ayudado mutuamente en su lucha contra los Goa\'uld y los Ori pero sobre todo en la liberación del pueblo Jaffa del yugo de los Señores del Sistema'
    ,'Teal\'c y los guerreros jaffa a sus órdenes estarán disponibles durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(3  ,'Tácticas militares'
    ,'Los miembros, tanto civiles como militares del SGC son sometidos a los más duros entrenamientos para asegurar su gran forma física y su pericia en combate.'
    ,'Aumenta el ataque, escudos y resistencia de todas las tropas mientras este activo.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(4  ,'Tretonina'
    ,'La Tretonina es una droga extraída de simbiontes Goa\'uld que reproduce la habilidad del simbionte de curar a su anfitrión, casi mágicamente, de los daíos físicos, dentro de un período corto de tiempo, además de aumentar drásticamente su resistencia para enfermar. Sin embargo provoca que un usuario de tretonina tenga que depender de la droga para el resto de su vida.'
    ,'Provee la posibilidad de que, cuando tropas Jaffa enemigas sean derrotadas en batalla, se unan a tu bando convertidas en Reclutas Jaffa (Combate) y Jaffas SGC (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(5  ,'Ascendido'
    ,'Los seres ascendidos han adquirido la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Éstos tienen prohibido interactuar con planos de existencia más bajos ya que pueden cambiar el curso de los acontecimientos.'
    ,'La forma ascendida de Daniel Jackson estará disponible.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(6  ,'Depósito del Conocimiento Antiguo'
    ,'Dispositivo que contiene una biblioteca del conocimiento de los antiguos, los constructores de la red de Stargates. Esta diseñado para acceder a la mente de un receptor y descargar en él todos los conocimientos de los Lantianos.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(7  ,'Comando de captura de naves'
    ,'El comando Stargate entrena equipos para infiltrarse en naves enemigas y tomar posesión de ellas para anexionarlas a la flota terrestre.'
    ,'Al destruir una nave enemiga de tamaño igual o superior al tipo Nodriza, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(8  ,'Legado Asgard'
    ,'Los Asgard y los Tau\'ri formaron una poderosa alianza para derrocar el poder opresor Goa\'uld en la Vía Láctea. Juntando la supremacía aérea de los Asgard en naves y la tenacidad de los Tau\'ri en tierra, los Goa\'uld vieron mermada su potencial en pocos aíos.'
    ,'Un conjunto de naves Asgard se unirá a tu flota durante un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(9  ,'Núcleo Asgard'
    ,'Cuando los Asgard de la Vía Láctea decidieron que su existencia no era posible, decidieron acabar con sus vidas no sin antes legar su tecnología y conocimientos a los Tau\'ri, a los que consideraban la futura raza dominante.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(10 ,'Sillón de los Antiguos'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(11,'Desfase Tollano'
   ,'Los Tollanos están muy desarrollados tecnológicamente. Tienen dispositivos capaces de hacer que quien lo usa, pueda atravesar objetos sólidos.'
   ,'Tus unidades atraviesan defensas de Stargate por un tiempo.'
    ,345600,900,1),  #Dura 15 minutos, recarga en 5 dias
#...................................................................................................................................................................
(12,'Lealtad Tok\'ra'
   ,'La Tok\'a es una alianza de Goa\'lds que no han sido influenciados por la memoria genética de sus hermanos, por lo que no están expuestos a su maldad y codicia. Son unos buenos aliados de la Tierra y el comando Staragte, colaborando con ellos en varias campañas.'
   ,'Disponibles unidades de la Tok\'ra durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(13,'Manto de Arturo'
   ,'Dispositivo creado por el lantiano Mirding que servía de comunicación entre dimensiones. Transporta cualquier objeto que interactúe con él a otra dimensión, lo que le hace invisible.'
   ,'Hace invisibles todas tus unidades durante un tiempo.'
    ,864000,86400,1),  #Dura 24 horas, recarga en 10 dias
#...................................................................................................................................................................
(14,'Módulo de Punto Cero'
   ,'Un Módulo de Punto Cero, es una fuente de energía creada por los Antiguos basada en el concepto de la energía del punto cero. El MPC extrae la energía de un pequeío subespacio creado artificialmente. Los Tau\'ri la usaron para potenciar el Stargate y llamar a otras galaxias.'
   ,'Durante un corto periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,864000,900,1),  #Dura 15 minutos, recarga en 10 dias
#...................................................................................................................................................................


(500,'Uso de Naquadriah'
    ,'Es un isotopo inestable del Naquadah que puede ser usado para alimentar motores de hiperespacio con cantidades mucho menores que con Naqahdah, y la gran cantidad de energía producida permite viajes intergalácticos, en tiempos de viaje razonables. El Naqahdriah se forma a partir de Naquahdah que es sometido a una reacción en cadena de modo artificial. El único planeta conocido que contiene Naquadriah es Langara, donde yacen grandes depósitos creados hace cientos de años por el Goa\'uld Thanos, con otros depósitos que han sido creados por los Kelownans cuando detonaron una bomba de Naqahdriah, un incidente que casi termina con toda la vida sobre el planeta. La exposición sin protección al Naquadriah produce daño cerebral, alucinaciones o esquizofrenia.'
    ,'Aumenta el ataque, los escudos y la velocidad de las naves durante un tiempo.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(501,'Martillo y Hoz'
    ,'Tras los EEUU, Rusia es la segunda potencia terrestre en controlar el Stargate. Tienen grupos de exploración propios y oficiales repartidos por los equipos del SGC además de una nave de clase BC304 llamada Korolev.'
    ,'La Nave Korolev se te une durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(502,'Noveno Chevron'
    ,'El proyecto de la base Icaro comenzó siendo un ambicioso experimento científico para lograr marcar el chevron nueve. Tras un ataque, la dirección de nueve símbolos mandó a los habitantes de la base a una antiugua nave lantiana que llevaba miles de años en funcionamiento.'
    ,'La nave Destiny se unirá a tu flota por un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(503,'Otra forma de proteger la Tierra'
    ,'El Coronel Harry Maybourne no estaba de acuerdo con la política moderada del Comando Stargate, así que decidió formar su propio grupo de trabajo ajeno, que operaba clandestinamente.'
    ,'Varios renagados del NID se te unirán durante un tiempo.'
    ,259200,43200,0),  #Dura 12 horas, recarga en 3 dias
#...................................................................................................................................................................
(504,'Suministros médicos'
    ,'Cheyenne Mountain cuenta con los avances médicos más modernos de la Tierra. Los mejores médicos del mundo se encuentran allí, liderados por la Doctora Lam.'
    ,'Mejora el ataque, resistencia y escudos de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(558,'Clase Thor'
    ,'Los Tau\'ri consiguieron replicar la tecnología aeroespacial Asgard para crear una nave híbrida, a medio camino entre la Clase Dédalo y la clase O\'Neill.'
    ,'La nave hibrida BC306 se unirá a tu flota por un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(564,'Extracción'
    ,'Una larva Goa\'uld adulta puede poseer completamente un cuerpo humano adheriéndose a su espina dorsal. La Tok\'Ra utiliza potente tecnología de teletransporte para extraer de forma segura a la larva del anfitrión. Los antiguos anfitriones poseen naquadah suficiente en su sangre como para poder utilizar la tecnología Goa\'uld.'
    ,'Provee la posibilidad de que, cuando tropas Goa\'uld enemigas sean derrotadas en batalla, se unan a ti como Antiguos Anfitriones (Combate).'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(565,'Vengador 2.0'
    ,'El vengador 2.0 es un virus creado por el doctor Jay Felger que bloquea un Stargate e impide que nadie llame a él. El virus se carga en un módulo especial que es conectado directamente al DHD.'
    ,'Dispones del módulo de carga del Vengador 2.0, que es una defensa de Stargate, durante un tiempo.'
    ,259200,43200,0),  #Dura 12 horas, recarga en 3 dias
#...................................................................................................................................................................
(567,'IOA Field Operations Division'
    ,'El International Oversight Advisory es una organización creada por varios gobiernos terrícolas para supervisar el Comando Stargate y la Base Atlantis. Poseen una división especial militarizada para operaciones de campo, dirigida por el agente especial Bates, uno de los miembros originales de la expedición Atlantis.'
    ,'Bates y varios agentes especiales se unirán durante un tiempo a tus tropas.'
    ,259200,43200,0),  #Dura 12 horas, recarga en 3 dias
#...................................................................................................................................................................
(569,'Pillaje espacial'
    ,'Vala Maldoran se ganó la vida como ladrona durante su tiempo como contrabandista. Muchos de los robos que realizó fueron de pequeñas naves que posteriormente vendía a miembros de la Alianza Lucian.'
    ,'Al destruir una nave enemiga del tipo Caza, Caza Pesado y Crucero, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................

#.............................................
#.................Goauld......................
#.............................................

(15 ,'Conquista planetaria'
    ,'El principal sustento de los Goa\'uld son los anfitriones que van recogiendo por toda la galaxia. Cualquier planeta que se interponga en sus intereses, es brutalmente arrasado por sus legiones Jaffa.'
    ,'Aumenta la producción de naquadah y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(16 ,'Amenaza Invisible'
    ,'Los Ashrak son Goa\'ulds que sirven a sus señores como asesinos. Son entrenados en el arte del sigilo y la lucha cuerpo a cuerpo para poder realizar encargos y permanecer ocultos durante largos periodos de tiempo en territorio enemigo.'
    ,'Pone un destacamento de Ashrak a tu servicio durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(17 ,'Sarcófago'
    ,'El sarcófago es una cámara con forma de ataúd que ,cuando se activa, cura a una persona viva o revive a una muerta dentro de la cámara. El primer sarcófago fue creado por un antiguo Goa\'uld conocido como Telchak, mediante un derivado del Dispositivo de Curación Antiguo, una tecnología demasiado poderosa para ser usada en humanos normales. Sin embargo un sarcófago no sólo es conocido por dar vida, si no también para sostenerla en una forma de éxtasis durante varios miles de años. Los Goa\'uld usan el dispositivo en prisioneros cuando sus métodos de tortura matan a sus víctimas accidentalmente o intencionalmente.'
    ,'Mejora el ataque, escudos y resistencia de las tropas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(18 ,'Implantación'
    ,'Una larva Goa\'uld adulta puede poseer completamente un cuerpo humano adheriéndose a su espina dorsal. Los Goa\'uld son muy selectivos a la hora de elegir anfitriones para sus miembros más importantes. Así, suelen elegir los más fuertes de entre un pueblo como anfitriones.'
    ,'Provee la posibilidad de que, cuando tropas humanas enemigas (incluidos ciertos héroes) sean derrotadas en batalla, se unan a ti convertidas en Lotaur (Combate) y Soldados Goa\'uld (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(19 ,'SemiAscendido'
    ,'Anubis fue un ser ascendido algún tiempo y como tal adquirió la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Sin embargo, debido a su oscuro corazón, fue desterrado a un plano intermedio entre las dos existencias.'
    ,'Anubis disponible durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(20 ,'Conocimiento del Universo'
    ,'Cuando Anubis ascendió tuvo acceso al conocimiento del universo que ello implica. A ser degradado, su cuerpo quedó atrapado en una forma incorpórea pero su conocimiento quedó intacto por lo que desarrollo novedosa tecnología que pilló desprevenidos a sus enemigos.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(21 ,'Nish\'ta'
    ,'El Nish\'ta es una droga que sirve a los Señores del Sistema como fuente para obtener súbditos. Al inocularla, esta droga afecta de forma hipnótica al sujeto, haciéndole siervo de aquel que la ha liberado.'
    ,'Al destruir una nave enemiga de tamaño igual o superior al tipo Nodriza (incluidos algunos héroes),  existe la posibilidad de capturarla para uso propio.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(22 ,'Concilio de los Señores del Sistema'
    ,'El Concilio de los Señores del Sistema es la organización política más alta para los Goa\'uld. Son determinantes las decisiones que toman para cambiar el curso de las guerras.'
    ,'Pone a tu servicio la flota conjunta de los Señores del Sistema durante un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(23 ,'El Ojo de Ra'
    ,'Cuando Anubis fue derrocado, el arma destructora más poderosa que poseía fue dividido en seis partes y entregado a Ra, Apophis, Baal, Balor, Osiris y Tiamat. Cuando Anubis regreso volvió a reunir las piezas, conocidas como Ojos, de su arma definitiva.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves durante un tiempo.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(24 ,'Nave de Tecnología Antigua'
    ,'Anubis utilizó la tecnología lantiana para mandar construir una poderosa nave nodriza más fuerte que el resto de Ha\'Tak. Cargó una superarma al volver a unir las partes que fueron repartidas entre los Seíores del Sistema cuando fue desterrado.'
    ,'La poderosa nave de Anubis estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(25 ,'Ocultación espacial'
    ,'Tras hacerse Señor de Netu, Apophis accedió a las investigaciones de Sokar. Entre ellas, descubrió la forma de ocultar su entera flota de naves Ha\'Tak a los ojos del enemigo creando así una perfecta emboscada.'
    ,'Hace invisible a todas tus unidades durante un tiempo.'
    ,864000,86400,1),  #Dura 24 horas, recarga en 10 dias
#...................................................................................................................................................................
(26 ,'Marcacion del Chappa\'ai'
    ,'Ba\'al utilizó alta tecnología para manipular el sistema de Stargates de Vía Láctea y usarlo a su favor para atacar a sus enemigos entre el resto de los Goa\'uld y los Tau\'ri.'
    ,'Durante un corto periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,864000,900,1),  #Dura 15 minutos, recarga en 10 dias
#...................................................................................................................................................................
(505,'Clonación'
    ,'Ba\'al uso la tecnología Asgard para clonar su cuerpo y usarlo para dominar la Galaxia. Los Jaffa y los Tau\'ri consiguieron descubrir muchos de los clones pero Ba\'al consiguió llevar a cabo su plan final para conseguir modificar la línea temporal.'
    ,'Varios clones de Ba\'al se unen un tiempo. Los clones son unidades temporales y no heroicas, aunque así lo parezca.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................


(506,'Investigaciones Hok\'Taur'
    ,'En su intento por encontrar un anfitrión perfecto, Nirrti convirtió a los habitantes de un pacifico planeta en horribles humanos deformes, aunque con poderes tales como la telequinesis y la telepatía.'
    ,'Cada unidad humana asesinada tiene probabilidades de convertirse en un Ho\'Taur (Combate) a tu servicio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(507,'Feromonas'
    ,'Hathor es la reina suprema de todos los Goa\'uld. Tiene el poder de convertir a cualquier ser humano en incubadora jaffa y así servirle como guerrero.'
    ,'Cada unidad humana asesinada tiene probabilidades de convertirse en un Jaffa de Hathor (Combate) a tu servicio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(508,'Laboratorio de investigación'
    ,'Anubis consiguió encontrar la forma de clonar su cuerpo y transferir toda su memoria genética a su llamado hijo. Ka\'lelh posee ADN Goa\'uld pero no es poseído por una larva. Los Hok\'Taur son unos humanoides muy poderosos.'
    ,'Reduce los tiempos de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(509,'El Continuo'
    ,'El plan más ambicioso de Ba\'al consistió en hacerse con un antiguo dispositivo de control de manchas solares para poder viajar en el tiempo. Ba\'al distorsiono a su gusto la línea de tiempo para hacerse Señor Supremo del Sistema y así conocer de ante mano todos los sucesos ocurridos, incluido el control de la Rebelión Jaffa para su propio beneficio.'
    ,'Disponible Teal\'c y varios de sus Jaffa durante un tiempo.'
    ,259200,43200,0),  #Dura 12 horas, recarga en 3 dias
#...................................................................................................................................................................
(510,'La Piramide del Dios Sol'
    ,'Ra posee una Nave Nodriza propia más grande que las naves corrientes y mucho más poderosa. La usa a modo de palacio y mansión pero también es un arma mortífera en batalla.'
    ,'Dispones de la nave de Ra durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(511,'Séquito Oscuro'
    ,'Sokar posee un sequito de naves propias con mucho más poder que cualquier Señor del Sistema.'
    ,'Dispones de la nave de Sokar durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(512,'Primera dinastía'
    ,'Yu posee una Nave Nodriza propia más grande que las naves corrientes y mucho más poderosa. La usa a modo de palacio y mansión pero también es un arma mortífera en batalla.'
    ,'Dispones de la nave de Yu durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(513,'Dios Serpiente de Netu'
    ,'Apophis construyó el primer prototipo de Nave Nodriza propia similar a la de su hermano Ra. La usa a modo de palacio y mansión pero también es un arma mortífera en batalla.'
    ,'Dispones de la nave de Apophis durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(570,'Saqueo Celta'
    ,'Camulus adoctrinó a sus adoradores más próximos para que arrasaran todas las localizaciones enemigas hasta las cenizas. Muchos de los botines de guerra que sus tropas acostumbraban a recoger eran pequeñas naves de ataque que eran posteriormente incorporadas a su ejército.'
    ,'Al destruir una nave enemiga del tipo Caza, Caza Pesado y Crucero, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(474,'El TRUST'
    ,'El TRUST es una organización de Goa\'uld que se infiltraron en La Tierra comandados por el Señor del Sistema Ba\'al y Atenea, usando al empresa de aeronautica Farrow-Marshall Aeronautics como tapadera. Usaron el virus de huéspedes para atacar mundos Jaffa y Tok\'Ra de la rebelión y acabar con toda vida en esos planetas.'
    ,'Disponibles varios agentes del TRUST durante un tiempo.'
    ,259200,43200,0),  #Dura 12 horas, recarga en 3 dias
#...................................................................................................................................................................

#.............................................
#.................Asgard......................
#.............................................

(27 ,'Investigación Genética'
    ,'El cuerpo clónico de los Asgard esta expuesto a una enfermedad degenerativa que los esta matando. Por ello, los científicos Asgard estudian a sus antepasados con el objetivo de descubrir la forma de conseguir más cuerpos clónicos en los que alojar sus mentes.'
    ,'Aumenta la producción de clones y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(28 ,'La Quinta Raza'
    ,'Los Tau\'Ri han colaborado estrechamente con los Asgards desde que descubrieron el funcionamiento de su Stargate. Las incursiones por tierra de los soldados de la Tierra han sido vitales para conseguir victorias contra los replicantes.'
    ,'O\'Neill y varios comandos Tau\'ri se te unen por un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(29 ,'Ragnarok'
    ,'Las naves Asgard son las más potentes de la Vía Láctea pero pueden verse superadas si van en solitario. Cuando los Asgard se concentran para atacar un objetivo son casi indestructibles.'
    ,'Mejora el ataque, la resistencia y los escudos de todas tus naves.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(30 ,'La otra extirpe'
    ,'La gran raza de los asgard se dividió en distintas extirpes, que se extendieron por distintas galaxias, una de estas extirpes se refugió en la galaxia Pegasus.'
    ,'Varios Supersoldados de Pegasus se te unen por un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(31 ,'Camuflaje Nox'
    ,'Los Nox son una raza aliada de los Asgard tecnológicamente avanzada que protege en todo momento a los seres vivos y a la naturaleza con su supercamuflaje.'
    ,'Hace invisibles todas tus unidades durante un tiempo.'
    ,864000,86400,1),  #Dura 24 horas, recarga en 10 dias
#...................................................................................................................................................................
(32 ,'Dilatador Temporal Asgard'
    ,'En su intento por atrapar a los replicantes, los Asgard crearon un dispositivo que creaba una burbuja temporal, donde pasaba el tiempo mucho más despacio. Sin embargo, el dispositivo fué alterado por los replicantes para hacer el efecto contrario, y así poder evolucionar a un estado casi humano.'
    ,'Reduce los tiempos de construcción.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(33 ,'Biblioteca de la Cuatro Razas'
    ,'Heliópolis fue la cuna de la sabiduría durante el gobierno de las Cuatro Grandes Razas. Un lugar donde se conjuntaba toda la sabiduría de la galaxia.'
    ,'Reduce los tiempos de investigación.'
    ,604800,3600,1),  #Dura 1 horas, recarga en 7 dias
#...................................................................................................................................................................
(34 ,'Consejo Asgard'
    ,'El sabio Consejo Asgard es la organización política mas alta para los Asgard. Son determinantes las decisiones que toman para cambiar el curso de las guerras.'
    ,'Varias naves del consejo Asgard se te unen por un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(35 ,'Núcleo Asgard'
    ,'Cuando los Asgard de la Vía Láctea decidieron que su existencia no era posible, decidieron acabar con sus vidas no sin antes legar su tecnología y conocimientos a los Tau\'ri, a los que consideraban la futura raza dominante.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(36 ,'Palacio de Valaskjálf'
    ,'Valaskjálf es uno de los palacios del Asgard Odín, una gran nave-palacio construida y blindada. En el puente de mando, Hli�skjálf, Odín comanda la estacion liderando las naves asgard en combate.'
    ,'El Palacio de Valaskjálf estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias

#.............................................
#.................Jaffa.......................
#.............................................

(37 ,'Refuerzos del Consejo Jaffa'
    ,'El Consejo Jaffa está formado por los jaffas más sabios y valientes de la galaxia. Sus decisiones son decisivas en el devenir de la Nación Libre Jaffa de Dakara y pueden mandar refuerzos de rebeldes a todas las bases avanzadas.'
    ,'Aumenta la producción de rebeldes y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(38 ,'Ne\'Semmour Tau\'Ri'
    ,'Los Jaffa y los Tau\'Ri mantienen una fuerte alianza desde la unión de Teal\'c al SG-1. Ambos se han ayudado mutuamente en su lucha contra los Goa\'uld y los Ori pero sobre todo en la liberación del pueblo Jaffa del jugo de los Señores del Sistema'
    ,'Jack O\'Neill y unos comandos de asalto se te unen un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(39 ,'Kel\'no\'reem'
    ,'El Kel\'no\'reem es una técnica de meditación Jaffa en la que los guerreros buscan la calma y la paz interior para hacerse más fuertes en su día a día.'
    ,'Aumenta el ataque, resistencia y escudo de las tropas durante un tiempo.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(40 ,'¡¡Rebelión!!'
    ,'La Rebelión Jaffa que dio lugar a la Nación Libre empezó de forma furtiva y clandestina en Chulak. Pronto, miles de Jaffas se liberaron del yugo de los Señores del Sistema y empezaron a luchar contra ellos codo con codo con sus hermanos.'
    ,'Provee la posibilidad de que, cuando tropas jaffa y Goa\'uld enemigas sean derrotadas en batalla, se unan a ti convertidas en Jaffas Guardián (Combate) y Jaffas Cónsul (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(41 ,'Ascendido'
    ,'Los seres ascendidos han adquirido la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Éstos tienen prohibido interactuar con planos de existencia más bajos ya que pueden cambiar el curso de los acontecimientos.'
    ,'Oma DeSala disponible un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(42 ,'Biblioteca de Dakara'
    ,'Los Antiguos construyeron una galería subterránea debajo del Templo de Dakara dónde se encontraban varios laboratorios de investigación y bibliotecas de conocimiento lantianas.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(43 ,'Botines de Guerra'
    ,'Los Jaffa surgieron como nación a la sombra de los Goa\'uld por lo que no pudieron diseíar y construir naves propias a corto plazo. Por ello, ocupaban naves espaciales derribadas en batalla para su uso propio.'
    ,'Al destruir una nave enemiga de tamaño igual o superior al tipo Nodriza, existe la posibilidad de capturarla para uso propio.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(44 ,'Flota del Consejo Jaffa'
    ,'El Consejo Jaffa se encarga de tomar las decisiones de la Nación Libre. Sus acciones pueden cambiar el curso de las guerras.'
    ,'Varias naves del consejo Jaffa se te unen por un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(45 ,'El Ojo de Ra'
    ,'El arma destructora más poderosa que poseía Anubis fue dividido en seis partes y dividido entre los Señores del Sistema. Cuando Anubis regreso volvió a reunir las piezas, conocidas como Ojos, de su arma definitiva.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(46 ,'Arma de Dakara'
    ,'La superarma de Dakara  es un dispositivo oculto capaz de reducir toda la materia a sus componentes elementales básicos. Está localizada en el Templo del planeta Dakara, un lugar santo para la Nación Libre Jaffa y el lugar de su nuevo gobierno. El dispositivo puede reestructurar al parecer la materia; según Anubis, se usó una vez por los Antiguos para crear a los precursores de toda la vida actual en la galaxia (realmente, recrearlos, después de la plaga). Juzgándolo así como una arma es discutible. '
    ,'La poderosa arma de Dakara estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(47 ,'Hermandad Sodan'
    ,'Los Sodan son un grupo de Jaffas rebeldes que, hace algo más de 5.000 aíos, comprendió que los Goa\'uld  no eran dioses y se rebelaron contra su Goa\'uld gobernante, el Seíor del Sistema Ishkur. Como fueron considerados traidores por los Goa\'uld, empezaron a viajar a través de la galaxia y buscaron Kheb. Finalmente se establecieron en un planeta oculto que aparentemente había sido una localización de los Antiguos y encontraron gran cantidad de tecnología Antigua, incluso un dispositivo de teletransporte que los transporta al otro lugar del planeta, estando seguros.'
    ,'Varios guerreros Sodan se unirá a tu campaña durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................


(514,'Liderazgo de Hierro'
    ,'K\'tano se alzó como revolucionario en Cal Mah contra su dios Imhotep. Allí creo una base fuertemente fortificada y muy difícil de penetrar.'
    ,'Mejora el ataque, la resistencia y los escudos de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(566,'Lejanas Alianzas'
    ,'Durante su estancia en la ciudad de Atlantis, Teal\'c conoció al satedano Ronon Dex. Aunque tuvieron sus diferencias, pronto entablaron amistad y juntos desbarataron un ataque de los wraith al Comando Stargate vía Midway.'
    ,'Ronon Dex y un grupo de marines se te unen un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(571,'Hurto Silencioso'
    ,'M\'zel, antiguo soldado de Herur, fue un jaffa que encabezaba pequeños escuadrones para robar naves de asalto durante las batallas.'
    ,'Al destruir una nave enemiga del tipo Caza, Caza Pesado y Crucero, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................


#.............................................
#.................Atlantis....................
#.............................................

(48 ,'Refuerzos del IOA'
    ,'El IOA mantiene en constante inspección a la Base Atlantis, enviando representantes para evaluar la situación y enviar refuerzos en caso de emergencia.'
    ,'Mejora la producción de refuerzos y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(49 ,'Suministros médicos'
    ,'La Base Atlantis cuenta con los avances médicos más modernos de la Tierra. Los mejores médicos del mundo se encuentran allí, liderados por la Doctora Keller.'
    ,'Aumenta el ataque, resistencia y escudo de las tropas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(50 ,'Pueblos de Pegasus'
    ,'La expedición Atlantis formó varias alianzas con varios pueblos humanos de Pegasus. Los Satedanos que habían sobrevivido a la destrucción de su planeta y los Genii , que desertaron de la tiranía de Cowen y apoyaron a Ladon Radim, se unieron en varias campañas a los marines de Atlantis. Igualmente La Coalición de planetas humanos ayudó en la lucha frente a los Wraith.'
    ,'Un conjunto de soldados de los planetas de Pegasus se te unen por un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(51 ,'Retrovirus'
    ,'Los Wraith son una hibridación genética de los humanos y del insecto Iratus. Experimentos genéticos realizados en la Base Atlantis han podido determinar que, eliminando la parte iratus del genoma wraith, éstos pueden convertirse en humanos.'
    ,'Cada soldado wraith abatido tiene probabilidades de transformarse en un Comando Atlantis (Combate) y Humanos Espectro (Oficial) que estarán a tu servicio.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(52 ,'Ascendido'
    ,'Los seres ascendidos han adquirido la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Éstos tienen prohibido interactuar con planos de existencia más bajos ya que pueden cambiar el curso de los acontecimientos.'
    ,'Morgana LaFey disponible un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(53 ,'Depósito del Conocimiento Antiguo'
    ,'Dispositivo que contiene una biblioteca del conocimiento de los antiguos, los constructores de la red de Stargates. Está diseñado para acceder a la mente de un receptor y descargar en él todos los conocimientos de los Lantianos.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(54 ,'Comando de captura de naves'
    ,'Equipos Atlantis entrenados especialmente para infiltrarse en naves enemigas y tomar posesión de ellas para anexionarlas a la flota terrestre.'
    ,'Al destruir una nave enemiga de tamaño superior al tipo Nodriza existe la posibilidad de capturarla para uso propio.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(55 ,'Trotamundos espaciales'
    ,'Los Travellers o Viajeros son una grupo de nómadas espaciales que viven en sus naves, construidas con repuestos de otras naves y que viajan de planeta en planeta para comerciar.'
    ,'Dispones de una flota de Travellers durante un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(56 ,'Núcleo Asgard'
    ,'Cuando los Asgard de la Vía Láctea decidieron que su existencia no era posible, decidieron acabar con sus vidas no sin antes legar su tecnología y conocimientos a los Tau\'ri, a los que consideraban la futura raza dominante.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(57 ,'Ciudad Nave de Atlantis'
    ,'La Base Atlantis es una enorme nave nodriza de impulsión lantiana con un poder de fuego inmenso y que puede realizar viajes hiperespaciales a otras galaxias en muy poco tiempo.'
    ,'Hace despegar la ciudad para que actué como una unidad héroe durante un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(58 ,'Módulo de Punto Cero'
    ,'Un Módulo de Punto Cero, es una fuente de energía creada por los Antiguos basada en el concepto de la energía del punto cero. El MPC extrae la energía de un pequeío subespacio creado artificialmente. Los Tau\'ri la usaron para potenciar el Stargate y llamar a otras galaxias.'
    ,'Durante un corto periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,864000,900,1),  #Dura 15 minutos, recarga en 10 dias
#...................................................................................................................................................................
(59 ,'Proyecto Arcturus'
    ,'El Proyecto Arcturus es un dispositivo generador de energía creado por los Antiguos, capaz de generar cantidades astronómicas de energía. Al contrario que el Módulo de Punto Cero que utiliza una región del subespacio creada artificialmente para extraer la energía del punto cero, Proyecto Arcturus fue el resultado de extraer la energía de punto cero de nuestro propio universo.'
    ,'Aumenta el ataque, resistencia y escudo de las defensas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................


(515,'Enzima Wraith'
    ,'Los Wraith contienen una enzima situada en su antebrazo que funciona de una forma parecida a la adrenalina para que su víctima no muera en el proceso de alimentación. Sin embargo, esta enzima también puede ser usada por los humanos como droga para acelerar el sistema nervioso y motor y ganar fuerza, velocidad y astucia.'
    ,'Mejora el ataque, resistencia y escudo de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(516,'Mr. McKay & Mss. Miller'
    ,'En uno de sus trabajos conjuntos, el Doctor Mckay y su hermana la Doctora Miller consiguieron extraer energía del subespacio para los MPCs de Atlantis.'
    ,'Reduce los tiempos de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(517,'Entrenamiento Athosiano'
    ,'Como pueblo guerrero, los Athosianos entrenan duramente todos los días para conseguir un mayor poder de combate y una forma física para afrontar adversidades.'
    ,'Mejora el ataque, resistencia y escudo de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(518,'InZenyrství'
    ,'La aportación de científicos de diversas nacionalidades amplió el número de ideas que se tenían para potenciar los artefactos de la Base Atlantis.'
    ,'Aumenta el ataque, los escudos y la velocidad de las naves durante un tiempo.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(519,'La gran viajera'
    ,'Larrin es una líder muy admirada entre los Travellers. Sus campañas han conseguido anexionar tecnología y nuevas naves-hogar para sus hermanos.'
    ,'Dispones de un grupo de apoyo de naves Travellers durante un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(559,'Clase Excalibur'
    ,'Los Tau\'ri consiguieron replicar la tecnología aeroespacial Asgard para crear una nave híbrida, a medio camino entre la Clase Dédalo y la clase O\'Neill.'
    ,'La nave hibrida BC305 se unirá a tu flota por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(563,'El Comando Stargate'
    ,'La base Atlantis se encuentra en la galaxia Pegasus y para conseguir marcar a La Tierra es necesaria una gran cantidad de energía. Cada cierto tiempo, el comando Stargate envía personal de cobate para defender la base de ataques enemigos.'
    ,'O\'Neill y varios comandos Tau\'ri se te unen por un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................    
(568,'IOA Field Operations Division'
    ,'El International Oversight Advisory es una organización creada por varios gobiernos terrícolas para supervisar el Comando Stargate y la Base Atlantis. Poseen una división especial militarizada para operaciones de campo, dirigida por el agente especial Bates, uno de los miembros originales de la expedición Atlantis.'
    ,'Bates y varios agentes especiales se unirán durante un tiempo a tus tropas.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(572,'Naves de Vuelo ligero'
    ,'Atlantis posee varias dependencias para albergar pequeñas naves para proteger la ciudad. La expedición a menudo recupera naves enemigas de las batallas que libran.'
    ,'Al destruir una nave enemiga del tipo Caza, Caza Pesado y Crucero, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
    
#.............................................
#.................Wraith......................
#.............................................

(60 ,'Clonadora'
    ,'La superioridad numérica de los Wraith fue la que les hizo ganar la guerra contra los Lantianos. Esto fue debido a una estación clonadora, alimentada por varios MPC, que triplicaba diariamente la cantidad de guerreros wraith.'
    ,'Mejora la producción de biomateria y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(61 ,'Partida de caza'
    ,'Los Wraith utilizan a humanos capacitados como corredores para perseguirlos como deporte. Los Wraith cazadores entrenan mucho tiempo para perseguir a los corredores por toda la galaxia y son admirados por el resto de la comunidad espectro.'
    ,'Te provee de un grupo de cazadores durante un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(62 ,'Succionadores de almas'
    ,'Los Wraith se alimentan de la fuerza vital de los humanos mediante una ventosa que tienen en la palma de su mano y por la que, literalmente, absorben la vida de su víctima. Esto hace al Wraith casi indestructible y le da un enorme poder de curación y ataque.'
    ,'Mejora el ataque y la resistencia de las tropas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(63 ,'Legado Iratus'
    ,'Los Wraith son una hibridación genética de los humanos y del insecto Iratus. Experimentos genéticos Wraith han podido determinar que, añadiendo la parte iratus al genoma humano, éstos pueden convertirse en wraith.'
    ,'Provee la posibilidad de que, cuando tropas humanas enemigas (incluidos ciertos héroes) sean derrotadas en batalla, se unan a ti convertidas en Wraith Iratus (Combate) y Wraith Centinela (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(65 ,'Bestia Wraith'
    ,'Los Wraith se alimentan de la fuerza vital de los seres vivos a los que atacan. Una leyenda entre las comunidades wraith habla del Wraith primigenio, un espectro que fue el primero de su especie en alimentarse de un humano sano. Debido a fallos genéticos, el Wraith primigenio sufrió una mutación que le proporciono triple fuerza vital. Por contra, los fallos genéticos acabaron degradando su ADN, matándolo paulatinamente. Sin embargo mientras estuvo en pie, fue prácticamente indestructible. '
    ,'Una poderosa unidad estará disponible un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(66 ,'Información Lantiana'
    ,'Tras ser liberado de los Genii, Todd se alió con Atlantis en busca de una forma de derrotar a los Asuranos. Allí, encontró información que le era muy útil a su facción.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(67 ,'Comando de captura'
    ,'La mayoría de los oficiales wraith tienen un alto conocimiento científico que les ayuda a salir de situaciones delicadas. Son capaces de aturdir a toda la tripulación de una nave enemiga y colar un virus informático encriptado en los núcleos centrales para inutilizar o manejar a su antojo sus funciones.'
    ,'Cada nave enemiga destruida mayor o igual que el tipo Nodriza tiene probabilidades de unirse a tu flota como nave semi-inorgánica.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(68 ,'Despertar'
    ,'Durante los periodos de sequía de humanos, los Wraith entran en éxtasis durante años, esperando que la vida vuelva a resurgir para poder recolectarla. Facciones enteras pueden estar aún hibernando.'
    ,'Una flota de naves wraith se te unen durante un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(69 ,'Crecimiento biológico'
    ,'Las naves Wraith hacen que su casco crezca constantemente, haciéndose más fuertes en el proceso. Sin embargo, necesitan una fuente de energía constante que los wraith a duras penas pueden poseer, a pesar de sus conocimientos científicos. Por ello, cuando una colmena encuentra una fuente de energía potente toma cierta ventaja con respecto a sus enemigas.'
    ,'Aumenta el ataque y resistencia de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(70 ,'Súper Nave Colmena'
    ,'El gran talón de Aquiles de la tecnología Wraith es su carencia de velocidad intergaláctica. Para ello, Todd junto con un grupo de científicos wraith, consiguió acoplar varios MPC a una nave colmena, acelerando y mejorando el crecimiento de ésta y dotándola de características muy por encima de cualquier otra nave de la Galaxia. Con ella, se pueden realizar viajes hiperespaciales e intergalácticos en espacios de tiempo ridículamente cortos.'
    ,'Una súper nave colmena estará disponible durante un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(71 ,'Semilla'
    ,'Las naves wraith son de carácter orgánico en su gran mayoría. Para crecer, necesitan un organismo incubadora vivo que de alimento a la semilla de la nave durante su generación.'
    ,'Cada tropa humana eliminada tiene probabilidad de convertirse en una nave colmena.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(72 ,'Hackeo Wraith'
    ,'Los conocimientos científicos de los oficiales wraith son amplios. Fueron capaces de manipular los DHD de los Stargates para acceder a la base terrícola de Midway y acceder a la Vía Láctea.'
    ,'Durante un corto periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,864000,900,1),  #Dura 15 minutos, recarga en 10 dias
#...................................................................................................................................................................


(520,'Evolución Forzada'
    ,'En uno de sus experimentos, Michael consiguió una evolución de los insectos iratus haciéndolos más fieros, temibles y peligrosos. Tuvo que abandonarlos ya que eran demasiado incontrolables.'
    ,'Varias defensas de Xenoformes se unen por un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(521,'Adoración'
    ,'Los wraith son muy poco comprensivos con los humanos, sin embargo hay excepciones. Muchas veces reclutan forzosamente a grupos de ellos para que les hagan el trabajo sucio a cambio de darles longevidad y fuerza vital. Estos humanos son conocidos como adoradores wraith y perseguidos por las comunidades humanas.'
    ,'Convierte a los humanos abatidos en Adoradores (Combate).'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(522,'Las Vegas Tour'
    ,'Las autoridades terrestres tuvieron muchos problemas con un wraith que se infiltró en la Tierra después de una ataque. Dicho wraith asesinaba a civiles para alimentarse, pero además usaba su poder mental para hacer trampas en los casinos de Las Vegas jugando al póker para conseguir dinero para sus propios planes.'
    ,'Mejora la producción de biomateria y la velocidad de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(523,'Terapia genética'
    ,'Dado que los Wraith son únicamente una mutación genética de los seres humanos, se puede volver a alterar su ADN para cambiar ciertos aspectos de la mutación. Todd  y los líderes de la alianza aceptaron someterse a un tratamiento por el que eliminarían la necesidad de alimentarse de humanos y poder digerir comida con su aparato digestivo normal.'
    ,'Mejora el ataque y la resistencia de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(573,'Tácticas de vuelo enemigas'
    ,'Los Wraith usan Dardos para abrumar al enemigo en batalla, sin embargo, muchos de ellos han sido adiestrados para pilotar otro tipo de aeronaves enemigas robadas en batalla.'
    ,'Al destruir una nave enemiga del tipo Caza, Caza Pesado y Crucero, existe la posibilidad de capturarla y convertirla para uso propio.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................

#.............................................
#.................Ori.........................
#.............................................

(73 ,'Origen'
    ,'El libro de Origen relata pequeños cuentos populares en los que los Ori muestran el verdadero camino a la ascensión para los mortales. Su sabiduría ha hecho que muchos pueblos a lo largo de la galaxia sigan sus enseñanzas.'
    ,'Mejora la producción de naquadah y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(74 ,'Doctrina'
    ,'Los Ori expandieron su religión hacia la Vía Láctea, donde fueron recibidos como dioses tras la caída de los Goa\'uld. Esta debilidad mental fué aprovechada para anexionar mundos a su credo.'
    ,'Te provee de una avanzada de unidades de planetas de la Vía Láctea durante un tiempo'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(75 ,'Cruzada'
    ,'Cuando los Tau\'Ri, los Asgard y la Tok\'Ra junto a otras razas de la Vía Láctea decidieron no abrazar el camino de Origen, los Ori decidieron comenzar una cruzada bélica contra ellos a través del SupeStargate.'
    ,'Mejora el ataque, resistencia y escudos de tus tropas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(76 ,'El poder de Celestis'
    ,'El Doci es el prior supremo de la Cruzada. Tiene la capacidad de convertir a cualquier persona, incluso infieles a la causa, en priores que comulgan con Origen.'
    ,'Provee la posibilidad de que, cuando tropas enemigas (incluidos ciertos héroes) sean derrotadas en batalla, se unan a ti convertidas en Guerreros de Origen (Combate) y Conversos (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(77 ,'Ascendido'
    ,'Los seres ascendidos han adquirido la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Éstos tienen prohibido interactuar con planos de existencia más bajos ya que pueden cambiar el curso de los acontecimientos.'
    ,'Adria ascendida disponible un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(78 ,'¡Alabados sean los Ori!'
    ,'Los Ori nunca tienen contacto directo con los humanos mortales, sino que hablan a través del sumo prior: el Doci. Si alguien osara asomarse a su morada, en Celestis podría ver antes de morir, todos los conocimientos e historia que los Ori han acumulado a lo largo de su longeva existencia.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(79 ,'El Camino de Origen'
    ,'Para tomar el control de la Vía Láctea, los Ori enviarán gradualmente naves para combatir a todo el mundo que ose interponerse en el camino de Origen.'
    ,'Varias naves Ori se te unen un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(80 ,'Biblioteca de Celestis'
    ,'Celestis es la ciudad capital de los Ori, allí se encuentran las formas incorpóreas de los propios Ori y allí dictan sus designios a sus seguidores por medio del Doci.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(81 ,'Cúpula Planetaria'
    ,'Los Ori necesitaban una poderosa fuente de energía para generar el agujero de gusano del SuperStargate. Para ello, mandaron un prior al planeta Kallana, que fue cubierto por un densísimo escudo que cubrió el planeta entero y lo protegió del exterior mientras la tecnología Ori hacia que el núcleo del planeta se colapsase.'
    ,'Te provee de miles de módulos de la Cúpula planetaria un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(82 ,'SuperStargate'
    ,'Protegidos por una Cúpula, los priores pueden enviar a través del Stargate las piezas necesarias para formar un Stargate orbital gigante que, usando la energía de la explosión de un planeta puede comunicar dos galaxias separadas por años luz de distancia y así enviar sus naves a la cruzada.'
    ,'Aumenta mucho la velocidad de las naves.'
    ,259200,300,1),  #Dura 5 minutos, recarga en 3 dias
#...................................................................................................................................................................
(83 ,'Lealtad Jaffa'
    ,'Tras convertir a Gerak, líder del consejo jaffa, en prior de la causa Ori, muchos Jaffas se unieron a la cruzada contra los infieles de la Vía Láctea.'
    ,'Varias tropas Jaffa se te unen un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(84 ,'Exploración Intergaláctica'
    ,'La Orici es una humana creada por los Ori. Con sus poderes psíquicos puede manipular el DHD de un Stargate para hacer marcaciones rapidísimas y potenciar la llamada de la puerta.'
    ,'Durante un corto periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,259200,900,1),  #Dura 15 minutos, recarga en 3 dias
#...................................................................................................................................................................

(524,'Terroristas Jaffa'
    ,'Muchos Jaffa se unieron a un grupo terrorista llamado Illac Renin que apoyaba a los Ori y cometieron violentos crímenes contra sus iguales por no seguir las enseñanzas del libro de Origen.'
    ,'Los soldados Jaffa que abatas se convertirán en Illac Renin.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................

#.............................................
#.................Replicantes..........
#.............................................

(85 ,'Actualización subespacial'
    ,'Todos los replicantes de la galaxia están interconectados por una red común por la que comparten conocimientos y nuevos destinos. Un sólo replicante puede mandar información de una punta a otra de la galaxia en pocos segundos.'
    ,'Mejora la producción de piezas y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(86 ,'Combatientes Humanoides'
    ,'Los esqueletos de replicantes son la primera versión de los humanoides. Son básicamente estructuras de piezas con vaga forma humana que andan de forma bípeda y con una agresividad muy patente.'
    ,'Varios esqueletos humanoides se unen por un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(87 ,'Aleación de nuevos materiales'
    ,'Los replicantes están diseñados con el poder reorganizador de moléculas del androide Reese. Son capaces de deshacer cualquier material inerte para convertirlo en piezas funcionales replicantes.'
    ,'Mejora el ataque, resistencia y escudos de tus tropas.'
    ,259200,21600,1),  #Dura 6 horas, recarga en 3 dias
#...................................................................................................................................................................
(88 ,'Asimilación orgánica'
    ,'Los replicantes asimilan materiales con una voracidad extrema. Son capaces de atacar humanos para controlarlos mecánicamente y sustituir sus componentes vitales por aleaciones replicantes y crear unidades con forma humana.'
    ,'Provee la posibilidad de que, cuando tropas humanas enemigas del tipo Oficial sean derrotadas en batalla, se unan a ti convertidas en Humanoides replicantes (Oficial).'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................
(89 ,'Unidad gigantesca'
    ,'Los replicantes pueden unirse formando cualquier estructura física solo conociendo algunos patrones estructurales. Incluso potentes unidades gigantescas para arrasar ciudades y bases.'
    ,'Una poderosa unidad estará disponible un tiempo.'
    ,518400,43200,0),  #Dura 12 horas, recarga en 6 dias
#...................................................................................................................................................................
(90 ,'Dilatador Temporal Replicante'
    ,'En su intento por atrapar a los replicantes, los Asgard crearon un dispositivo que creaba una burbuja temporal, donde pasaba el tiempo mucho más despacio. Sin embargo, el dispositivo fué alterado por los replicantes para hacer el efecto contrario, y así poder evolucionar a un estado casi humano.'
    ,'Reduce los tiempos de investigación.'
    ,864000,3600,1),  #Dura 1 horas, recarga en 10 dias
#...................................................................................................................................................................
(91 ,'Convocatoria subespacial'
    ,'Los Replicantes se comunican entre sí por una densa red subespacial. Pueden enviar información o pedir ayuda a años luz de distancia.'
    ,'Varias naves replicantes se te unen un tiempo.'
    ,691200,86400,0),  #Dura 24 horas, recarga en 8 dias
#...................................................................................................................................................................
(92 ,'Sobrecarga del sistema'
    ,'Un número grande de replicantes puede absorber tal cantidad de energía que es capaz de potenciar los motores de hiperpropulsión de cualquier nave para aumentar 500 veces su velocidad y llegar a cualquier parte.'
    ,'Aumenta el ataque, resistencia y escudos de todas tus naves.'
    ,604800,3600,1),  #Dura 1 hora, recarga en 7 dias
#...................................................................................................................................................................
(93 ,'Estación Espacial Replicante'
    ,'Los replicantes se adecuan perfectamente a sus necesidades durante los conflictos bélicos en los que toman parte. Pueden unirse formando una enorme estructura espacial para asediar enclaves desde el espacio.'
    ,'Una poderosa estación espacial replicante estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(94 ,'Desmolecularización'
    ,'Los replicantes más avanzados son capaces de desligar sus conexiones internas hasta niveles micromoleculares para así atravesar otros materiales sólidos. Incluso defensas de Stargate y escudos.'
    ,'Permite atravesar las defensas de stargate.'
    ,345600,900,1),  #Dura 15 minutos, recarga en 5 dias
#...................................................................................................................................................................
(95 ,'Despiece'
    ,'Los replicantes pueden utilizar cualquier material inorgánico para crear más piezas replicantes y así crear más unidades replicantes. Los pequeños replicantes están programados exclusivamente para ésta función.'
    ,'Provee la posibilidad de que, cuando algunas defensas enemigas y sondas de exploración sean derrotadas en batalla, se unan a ti como unidades replicantes.'
    ,604800,86400,1),  #Dura 24 horas, recarga en 7 dias
#...................................................................................................................................................................

(525,'La Familia'
    ,'Dentro de la cámara de dilatación de tiempo, los replicantes evolucionaron hasta adoptar forma humana. Cinco modelos fueron creados, cada uno mejor que el anterior, siempre supervisados por el Primero.'
    ,'Una avanzada de Replicantes humanoides se unirá a tí durante un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................

#.............................................
#.................Heroes......................
#.............................................
(526,'Túnel de Cristal de Martouf'
    ,'La Tok\'Ra utiliza túneles subterráneos de cristal autogenerados para ocultarse. Los túneles responden a las órdenes de la Tok\'Ra, pudiendo reconstruirse a su antojo.'
    ,'Hace invisibles a todas tus unidades.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(527,'Minas de Abydos'
    ,'Abydos fue el planeta elegido por el Señor Supremo Ra para la extracción del Naquadad. Tiene las minas más grandes y abundantes de toda la galaxia'
    ,'Mejora la producción de recursos y reduce los tiempos de construcción.'
    ,432000,43200,1),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(528,'Diplomacia Unas de Chaka'
    ,'Los Unas son unos seres pobremente desarrollados pero muy potentes en combate. Su colaboración suele ser vital en infiltraciones por tierra.'
    ,'Varios Unas se te unen un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(529,'Camuflaje Nox'
    ,'Los Nox son una raza tecnológicamente avanzada que protege en todo momento a los seres vivos y a la naturaleza con su supercamuflaje.'
    ,'Hace invisibles todas tus unidades durante un tiempo.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(530,'Portal Furling'
    ,'Los Furlings llevan años ocultos del resto de los mortales de la Vía Lactea. En algunos de sus planetas aún se pueden encontrar portales para esconderse.'
    ,'Hace invisibles todas tus unidades durante un tiempo.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(531,'Brazaletes Atoniek'
    ,'Los Brazaletes de Atoneik proporcionan a su usuario unas habilidades sobrehumanas, hipervelocidad e hiperfuerza.'
    ,'Mejora el ataque, resistencia y escudos de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(532,'Inventos de Ma\'Chelo'
    ,'El inventor Ma\'chelo fue una vez un gran problema para los Goa\'uld. Sus investigaciones fueron clave en algunas batallas.'
    ,'Reduce los tiempos de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(533,'Desfase Tollano'
    ,'Los Tollanos están muy desarrollados tecnológicamente. Tienen dispositivos capaces de hacer que quien lo usa, pueda atravesar objetos sólidos.'
    ,'Tus tropas atraviesan defensas de Stargate por un tiempo.'
    ,432000,900,1),  #Dura 15 minutos, recarga en 5 dias
#...................................................................................................................................................................
(534,'El Rizo de Kon Garat'
    ,'En Hebridan se celebra la gran carrera de Kon Garat, también conocido como El Rizo. Allí se dan cita los más potentes motores de toda la Galaxia.'
    ,'Mejora el ataque, resistencia, escudos y velocidad de las naves.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(535,'¡¡Comtraya!'
    ,'La tecnología de replicación de los altairanos es la más sofisticada de la galaxia. Harlan, es capaz de crear un duplicado robótico idéntico a cualquier ser vivo e incluso traspasar su mente para que le ayude en su fábrica.' 
    ,'Provee la posibilidad de que, cuando algunas tropas humanas enemigas sean derrotadas en batalla, se unan a ti como Androides (Combate).'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(536,'Todos amamos a Lucius'
    ,'Lucius Lavin es un personaje peculiar. Panadero de profesión, un buen día encontró una hierba con la que hizo una pócima capaz de hacer que todo el mundo a su alrededor le quisiese y se hiciese su más íntimo amigo.'
    ,'Provee la posibilidad de que, cuando algunas tropas humanas enemigas sean derrotadas en batalla, se unan a ti como Milicianos de la Coalición (Oficial).'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................    
(562,'Drones Berzerker'
    ,'Los drones berzerker son unas unidades robóticas creadas por una raza desconocida que atacan en masa a naves enemigas cuando están guiados por una Nave Comandante. Los drones son no tripulados además de ser muy rápidos y ágiles. Individualmente, tienen poca integridad pero un ataque continuo devastador y desde todos los ángulos concebibles.'
    ,'Se te proporciona una oleada de Drones Berzerker durante un tiempo.'
    ,345600,86400,0); #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................

#Especiales de planetas..............................................................................
INSERT INTO especial (idEspecial, nombre, descripcion, especificacion, tiempoRecarga, tiempoDuracion, activo)
VALUES
(537,'Calavera de Cristal'
    ,'La calavera de cristal es un curioso artefacto de origen desconocido que tiene la capacidad de desfasar a cualquiera que lo toca. Al estar en otra dimensión diferente, es invisible en la nuestra.'
    ,'Hace invisibles a todas tus unidades.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(538,'Aparato de Tel\'Chak'
    ,'Tel\'Chak fue un Goa\'uld que descubrió un aparato que servía para revivir temporalmente a los seres muertos. Con ayuda de otro Goa\'uld, Thot, lo uso para crear el primer sarcófago. Sin embargo, el aparato regeneraba de tal forma los cuerpos muertos, que lo convertía en seres muy primarios y agresivos.'
    ,'Cada tropa enemiga abatida tiene probabilidad de ponerse a tu servicio como un zombie.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(539,'Colonia Unas de Iron Shrirt'
    ,'Los Unas son unos seres pobremente desarrollados pero muy potentes en combate. Su colaboración suele ser vital en infiltraciones por tierra.'
    ,'Varios Unas se unen a tu causa un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(540,'Astilleros espaciales'
    ,'La Base Fabrica de Apophis es un complejo industrial fortificado donde se desarrolla tecnología espacial. Su nave nodriza fue desarrollada en él, aunque el primer prototipo fue destruido por el SG-1 utilizando los brazaletes Atoniek.'
    ,'Reduce los tiempos de construcción.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(541,'Manto de Arturo de Castiana'
    ,'Dispositivo creado por el lantiano Mirding que servía de comunicación entre dimensiones. Transporta cualquier objeto que interactúe con él a otra dimensión, lo que le hace invisible.'
    ,'Hace invisibles todas tus unidades.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(542,'Ciudad de Cristal'
    ,'La Tok\'Ra utiliza túneles subterráneos de cristal autogenerados para ocultarse. Los túneles responden a las órdenes de la Tok\'Ra, pudiendo reconstruirse a su antojo.'
    ,'Hace invisibles a todas tus unidades.'
    ,345600,86400,1),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(543,'Depósito del Conocimiento Planetario'
    ,'Dispositivo que contiene una biblioteca del conocimiento de los antiguos, los constructores de la red de Stargates. Esta diseñado para acceder a la mente de un receptor y descargar en él todos los conocimientos de los Lantianos.'
    ,'Reduce los tiempos de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(544,'Biblioteca de la Cuatro Razas de Heliópolis'
    ,'Heliópolis fue la cuna de la sabiduría durante el gobierno de las Cuatro Grandes Razas. Un lugar donde se conjuntaba toda la sabiduría de la galaxia.'
    ,'Reduce los tiempos de investigación.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................
(545,'Ascendido de Kheb'
    ,'Los seres ascendidos han adquirido la cultura y la sabiduría de la historia de la Galaxia con su ascensión a un plano de existencia superior. Éstos tienen prohibido interactuar con planos de existencia más bajos ya que pueden cambiar el curso de los acontecimientos.'
    ,'Una forma ascendida estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(546,'Fábrica de Tartaro'
    ,'Anubis tras volver a este plano de existencia como semiascendido, utilizo sus conocimientos de ascendido para crear un gran ejercito de guerreros Kull que uso para doblegar a los señores del sistema.'
    ,'Pone un varios Siervos Kull a tu servicio un tiempo.'
    ,432000,43200,0),  #Dura 12 horas, recarga en 5 dias
#...................................................................................................................................................................
(547,'Entrenamiento de Athos'
    ,'Como pueblo guerrero, los Athosianos entrenan duramente todos los días para conseguir un mayor poder de combate y una forma física para afrontar adversidades.'
    ,'Mejora el ataque, resistencia y escudos de las tropas.'
    ,86400,21600,1),  #Dura 6 horas, recarga en 1 dias
#...................................................................................................................................................................
(548,'Dilatador Temporal de Halla'
    ,'En su intento por atrapar a los replicantes, los Asgard crearon un dispositivo que creaba una burbuja temporal, donde pasaba el tiempo mucho mas despacio. Sin embargo, el dispositivo fue alterado por los replicantes para hacer el efecto contrario, y así poder evolucionar a un estado casi humano.'
    ,'Reduce los tiempos de construcción.'
    ,345600,3600,1),  #Dura 1 hora, recarga en 5 dias
#...................................................................................................................................................................    
(549,'Sillón de Lantea'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(550,'Sillón de Lantis'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(551,'Plataforma de Proclarush Taonas'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(552,'Arma de Dakara planetaria'
    ,'La superarma de Dakara  es un dispositivo oculto capaz de reducir toda la materia a sus componentes elementales básicos. Está localizada en el Templo del planeta Dakara, un lugar santo para la Nación Libre Jaffa y el lugar de su nuevo gobierno. El dispositivo puede reestructurar al parecer la materia; según Anubis, se usó una vez por los Antiguos para crear a los precursores de toda la vida actual en la galaxia (realmente, recrearlos, después de la plaga). Juzgándolo así como una arma es discutible. '
    ,'La poderosa arma de Dakara estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(553,'El Centinela'
    ,'El Centinela es un dispositivo de defensa planetario creado por los Latonianos hace 500 años para defender su planeta de invasiones. Crea un haz de luz enorme que hiere a las unidades enemigas que atacan el planeta.'
    ,'La Torre Centinela estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias  
#...................................................................................................................................................................
(554,'El Rey de Camelot'
    ,'Ambrosio Aureliano fue un caudillo romano de origen britano que dirigió  la defensa de Bretaña frente a los invasores sajones a comienzos del siglo VI. Posteriormente se convirtio en rey de Bretaña y estableció  un imperio en las Islas Británicas. Viendo su potencial, el lantiano Merlín, que había descendido de un plano existencial superior, se convirtió  en su consejero y le enseño los secretos del universo y el uso del Stargate. Arturo fue un héroe de leyenda en La Tierra y Camelot. Tras salir victorioso de su batalla final contra su enemigo Mordred en Camlann, salió  en busca del Sangreal, que habia sido robado por Morgana, junto con sus caballeros.'
    ,'La forma ascendida del Rey Arturo estará disponible un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(555,'Plataforma de armas de la Antártida'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(556,'Puente Intergaláctico McKay-Carter'
    ,'El puente de puertas intergaláctico McKay-Carter (nombrado por sus creadores, Rodney McKay, reconociendo a Samantha Carter por su idea original) consiste en diecisiete Stargates de la red de Pegaso y otros diecisiete de la red de la Vía Láctea. Un programa macro escrito por McKay y agregado a los sistemas operativos de las puertas antes marcar almacena la materia entrante en los buffers, permitiendo a los viajeros saltar de una puerta a la siguiente a través del puente, en lugar de surgir fuera de la puerta como se llama normalmente.'
    ,'Durante un periodo de tiempo, tus tropas pueden usar el Stargate para viajar entre galaxias.'
    ,259200,86400,1),  #Dura 24 horas, recarga en 3 dias 
#...................................................................................................................................................................
(557,'Flota de la Alianza Lucian'
    ,'La Alianza Lucian es una poderosa organización criminal compuesta por traficantes y mercenarios. Formaron la Alianza para llenar el vacío de poder en la galaxia producto del debilitamiento de los Goa\'uld. Su flota está compuesta en gran parte de naves Goa\'uld, que consta de varios Ha\'tak y Al\'kesh,'
    ,'Varias naves de la Alianza Lucian se te unen un tiempo.'
    ,345600,86400,0),  #Dura 24 horas, recarga en 5 dias
#...................................................................................................................................................................
(560,'Plataforma de Gohari'
    ,'La Silla de Control Antigua es un dispositivo de control Antiguo que funciona como una interfaz mental para aquellos que tengan el gen ATA. La silla se ha encontrado en diversos puestos avanzados Antiguos, como el del planeta Gohari que se encontraba en enterrado bajo la arena.'
    ,'Disponible defensa Sillón de los Antiguos por un tiempo.'
    ,604800,43200,0),  #Dura 12 horas, recarga en 7 dias
#...................................................................................................................................................................
(561,'El Arca de la Verdad'
    ,'El Armeria Verimas o Arca de la Verdad es un dispositivo alterano que tiene la capacidad de convencer a la gente la &#34;verdad&#34; que este programada en la misma, lo que hace que esencialmente sea un dispositivo de lavado de cerebro. Para activarlo alguien debe escribir la contraseña en el dispositivo de control en la parte superior del Arca. Si es correcta, el cristal rojo de la parte superior se enciende y un rayo cegador de luz que proviene de él afecta a cualquier persona en los alrededores. Fue utilizado por los Tauri para convencer a todos los seguidores de Origen de que abandonaran dicha creencia, haciendo así que el poder de los Ori desapareciera.'
    ,'Capturas todas las unidades Ori que aniquiles en batalla a excepción de los héroes, los campos de fuerza, las piezas del Superstargate y el propio Superstargate.'
    ,1036800,86400,1); #Dura 24 horas, recarga en 12 dias 
#...................................................................................................................................................................

##############################################
########### Seguimiento de ids ###############
#####Id Especiales propios            --> 95
#####Id Especiales Otros              --> 574
##############################################

#especiaRequierelUnidadEspecial
INSERT INTO especialRequiereUnidadHeroe (idEspecial, idUnidadHeroe)
VALUES

#TauRi..................................................................
(2,   8), #Aliados Jaffa requiere Daniel Jackson
(7,   8), #Comando de Captura requiere Daniel Jackson
(7,  11), #Comando de Captura requiere Sam
(7,  18), #Comando de Captura requiere ONeill
(8,  39), #Aliados Asgard requiere Odisea
(12, 11), #Aliados Tokra requiere Sam

(500,  12), #Uso de Naquiadria requiere Jonas
(501, 319), #Martillo y Hoz requiere Chekov
(502,  19), #Noveno Chevon requiere Gen. ONeill
(502,  27), #Noveno Chevon requiere Dr. Rush
(502, 339), #Noveno Chevon requiere USS Hammond
(502, 344), #Noveno Chevon requiere Eli
(502, 400), #Noveno Chevon requiere Young
(503,  20), #Otra forma de proteger la Tierra requiere Coronel Maybourne
(504,  24), #Suministros requiere Dr. Lam
(558,  28), #Clase Thor requiere Gen. Hammond
(558,  14), #Clase Thor requiere May. Davies
(558,  15), #Clase Thor requiere May. Ferreti
(558, 310), #Clase Thor requiere Gen. Landry
(564,  11), #Extraccion requiere Carter
(564, 275), #Extraccion requiere Jolinar
(565,  25), #Vengador requiere Felger
(567, 390), #IOA requiere Camile Wray
(569,  13), #Pillaje requiere Vala

#Goauld.................................................................
(16,  53), #Amenaza invisible requiere Thot
(21,  57), #Nishta requiere Herak
(21,  60), #Nishta requiere Apophis
(22,  94), #Concilio requiere Estacion
(25,  60), #Ocultacion espacial requiere Apophis
(505, 62), #Clonacion requiere Baal

(506,  69), #Investigaciones HokTaur requiere Nirrti
(507,  63), #Feromonas requiere Hathor
(508,  65), #Laboratorio de investigacion requiere Kalhel
(509,  62), #El Continuo requiere Baal
(509, 438), #El Continuo requiere Prayxon
(510,  73), #La Piramide del Dios Sol requiere Ra
(511,  75), #Sequito Oscuro requiere Sokar
(512,  68), #Primera dinastia requiere Yu
(513,  61), #Dios Serpiente de Netu requiere Apophis rojo
(570, 371), #Saqueo Celta requiere Camulus
(474, 443), #TRUST requiere Atenea

#Asgard.................................................................
(28,  99), #La Quinta raza requiere Thor
(33, 108), #Biblioteca requiere Heimdall
(33, 109), #Biblioteca requiere Valhalla
(34, 109), #Consejo Asgard requiere Valhalla

#Jaffa..................................................................
(38, 120), #Aliados Tauri requiere Raknor
(43, 120), #Capturar naves requiere Raknor
(43, 124), #Capturar naves requiere Jolan
(43, 127), #Capturar naves requiere Tealc
(44, 140), #Flota Consejo requiere Lider Consejo
(47, 129), #Hermandad Sodan requiere Bratac

(514, 126), #Liderazgo de Hierro requiere Ktano
(566, 128), #Lejanas alianzas requiere maestro Tealc
(571, 427), #Hurto silencioso requiere Mzel

#Atlantis...............................................................
(49, 150), #Suministros medicos requiere Dr. Keller
(54, 155), #Comando captura requiere Mckay
(54, 158), #Comando captura requiere Ronon
(55, 169), #Trotamundos requiere Dedalo

(515, 153), #Enzima Wraith requiere Ford dopado
(516, 155), #Mckay Miller requiere Mckay
(516, 147), #Mckay Miller requiere Miller
(517, 157), #Entrenamiento Athosiano requiere Teyla
(518, 154), #Ingenieria Checa requiere Zelenka
(559, 311), #Clase Excalibur requiere Weir
(563, 325), #Comando Stargate requiere Carter
(568, 312), #IOA requiere Woolsey
(572, 156), #Roba Cazas requiere Lorne

#Wraith.................................................................
(61, 176), #Partida de Caza requiere Cazador
(67, 183), #Comando Captura requiere Todd
(68, 192), #Despertar requiere Reina

(520, 182), #Evolucion forzada requiere Michael
(521, 177), #Adoracion requiere Tyre
(523, 331), #Terapia requiere Kenny
(523, 183), #Terapia requiere Todd
(522, 345), #Las Vegas requiere Brian
(573, 326), #Roba Cazas requiere James

#Ori....................................................................
(74, 214), #Doctrina requiere Tomin
(79, 225), #El Camino de Origen requiere Lider Prior
(82, 509), #Superstargate requiere Superstargate
(83, 217), #Lealtad Jaffa requiere Doci

(524, 122), #Terroristas requiere Arkad

#Replicantes............................................................
(86, 202), #Combatientes humanoides requiere Reese
(91, 208), #Convocar flota requiere nave de Quinto
(94, 205), #Desmolecularizacion requiere Replicarter

(525, 204), #Familia requiere Primero
(525, 320), #Familia requiere Segundo
(525, 321), #Familia requiere Tercero
(525, 322), #Familia requiere Cuarto
(525, 203), #Familia requiere Quinto

#Otros..................................................................
(526, 270), #Tuneles requiere Martouf
(527, 272), #Minas de Abydos requiere Kasuf
(528, 276), #Alianza Unas requiere Chaka
(529, 284), #Camuflaje Nox requiere Nox.
(530, 283), #Portal Furling requiere Furlings
(531, 269), #Atoniek requiere Anise
(532, 268), #Inventos de Machelo requiere Machelo
(533, 274), #Desfase Tollano requiere Narim
(534, 278), #El Rizo de Kon Garat requiere Warrick
(535, 265), #Comtraya requiere Harlan.
(536, 264), #Todo el mundo quiere a Lucius requiere Lucius
(562, 432), #Drones Berzerker requiere Nave comandante
(519, 404), #Flota de Travellers requiere Katana
(519, 277), #Flota de Travellers requiere Larrin
(519, 308), #Flota de Travellers requiere Nave Katana
(519, 309), #Flota de Travellers requiere Nave Larrin
(557, 391), #Flota de la Alianza Lucian requiere Kiva
(557, 392), #Flota de la Alianza Lucian requiere Netan
(557, 393), #Flota de la Alianza Lucian requiere Simeon
(557, 396); #Flota de la Alianza Lucian requiere Varro

#Unidades temporales que te dan los especiales
INSERT INTO especialUnidad (idEspecial, idUnidad, cantidad)
VALUES

#Tauri..................................................................
(2, 600, 7.5), #Aliados Jaffa da a Guardia Personal
(2, 601, 2.5), #Aliados Jaffa da a Distra
(2, 602, NULL), #Aliados Jaffa da a Tealc

(5, 9, NULL), #Ascendido te da a Daniel Ascendido

(8, 605, 2.5), #Legado Asgard te da Beliksner
(8, 606, 1), #Legado Asgard te da Jackson
(8, 607, 0.3), #Legado Asgard te da ONeill

(10, 415, NULL), #Sillon de los Antiguos te da Sillon

(12, 603, 7.5), #Tokra te da comandos Tokra
(12, 604, 2.5), #Tokra te da Asesinos Tokra

#--- Planetas
(501, 38,  NULL), #Martillo y Hoz te da Korolev
#--
(502, 355, NULL), #Noveno Chevron te da Destiny
#--
(503, 649, 10), #Otra forma de proteger la Tierra te da NID
#--
(558, 356, NULL), #Clase Thor te da BC306
#--
(565, 661, NULL), #Vengador te da Vengador
#--
(567, 665, 10), #IOA te da a Oficial de IOA
(567, 666, NULL), #IOA te da a Bates

#Goauld.................................................................
(16, 608, 4), #Amenaza invisible te da Ashrak

(505, 51, 4), #Clonacion te da Clones de Baal

(19, 59, NULL), #SemiAscendido te da a Anubis
(24, 408, NULL), #Nave de tec. te da Nave de tecn.

(22, 609, 4), #Concilio da alkesh
(22, 610, 2.5), #Concilio da hatak
(22, 611, 0.7), #Concilio da nodrizas

#--
(509, 664, 10),   #El Continuo te da Distras
(509, 341, NULL), #El Continuo te da Tealc
#--
(510, 93,  NULL), #La Piramide del Dios Sol te da nave de Ra
#--
(511, 90,  NULL), #Sequito de la lluvia y la guerra te da nave de Baal
#--
(512, 91,  NULL), #Primera dinastia te da nave de Yu
#--
(513, 92,  NULL), #Dios Serpiente de Netu te da nave de Apophis
#--
(474, 49,  10), #TRUST te da Oficiales del TRUST

#Asgard.................................................................
(28, 612, 7.5), #La Quinta Raza te da a Comandos SG
(28, 613, 2.5), #La Quinta Raza te da a Oficiales SG
(28, 614, NULL), #La Quinta Raza te da a ONeill

(30, 615, 4), #La Otra Extirpe te da supersoldados

(34,616, 2.5), #Consejo te da Beliksner
(34,617, 1), #Consejo te da Jackson
(34,618, 0.3), #Consejo te da Oneill

(36, 409, NULL), #Palacio de Val... te da Palacio

#Jaffa..................................................................
(38, 619, 7.5), #NeSemmour TauRi te da a Comandos SG
(38, 620, 2.5), #NeSemmour TauRi te da a Oficiales SG
(38, 621, NULL), #NeSemmour TauRi te da a ONeill

(41, 285, NULL), #Ascendido te da a Oma deSala
(46, 411, NULL), #Dakara te da Arma de Dakara

(44, 623, 4), #Consejo Jaffa te da Alkesh
(44, 624, 2.5), #Consejo Jaffa te da Hataks
(44, 625, 0.7), #Consejo Jaffa te da Nodrizas

(47, 622, 3), #Hermandad te da Sodan

#--
(566, 662, 12),    #Lejanas alianzas te da a Marines
(566, 663, NULL), #Lejanas alianzas te da a Ronon

#Atlantis...............................................................

(50, 626, 7.5), #Pueblos de Pegasus te da Milicianos Pegasus
(50, 627, 2.5), #Pueblos de Pegasus te da Satedanos

(52, 287, NULL), #Ascensido te da Morgana LaFey
(57, 335, NULL), #Ciudad Nave te da una Ciudad Nave

(55, 629, 4), #Trotamundos te da cruceros traveller
(55, 630, 0.7), #Trotamundos te da Aurora

(559, 354, NULL), #Clase Excalibur te da BC305

#--
(563, 658, 20),    #Comando Stargate te da a Comandos SG
(563, 659, 10),    #Comando Stargate te da a Oficiales SG
(563, 660, NULL), #Comando Stargate te da a ONeill

(568, 628, 12), #IOA te da a Oficial de IOA
(568, 635, NULL), #IOA te da a Bates

#Wraith.................................................................

(61, 631, 4), #Partida de Caza te da cazadores

(65, 410, NULL), #Bestia Wraith te da Wraith sobrealimentado
(70, 338, NULL), #Supercolmena da supercolmena

(68, 632, 25), #Despertar te da Dardos
(68, 633, 4), #Despertar te de Cruceros
(68, 634, 2), #Despertar te de Colmenas

#--
(520, 651 ,20), #Evolucion forzada te da aliens

#Ori....................................................................

(74, 636, 7.5), #Cruzada te da guerreros vikingos
(74, 637, 2.5), #Cruzada te da guerreros reetou

(79, 640, 4), #El Camino de Origen te da cazas
(79, 641, 0.2), #El Camino de Origen te da naves

(83, 638, 7.5), #Lealtad Jaffa te da Horus
(83, 639, 2.5), #Lealtad Jaffa te da Distra

(81, 416, 100), #Cupula te da 10000 cupulas
(77, 218, NULL), #Ascendido te da orici ascen.

#Replicantes............................................................
(86, 642, 4), #Combatientes humanoides te da esqueletos

(89, 412, NULL), #Godzilla te da un godzilla

(91, 643, 5), #Convocatoria te da cruceros
(91, 644, 2), #Convocatoria te da nodrizas

(93, 413, NULL), #Planetoide te da un Planetoide

#--
(525, 650, 12), #Familia te da replicantes humanoides

#Otros............................................................
(528, 645, 15), #Alianza Unas te de Unas

#Planetas
(519, 655, 8), #La gran viajera da Cruceros Traveller
(519, 656, 1.4), #La gran viajera da Auroras

(539, 646, 15), #Alianza Unas te de ? Unas

(546, 647, 10), #El plan de Anubis te da Guerreros Kull

(545, 652, NULL), #Kheb da ascendido

(549, 419, NULL), #Sillon de los Antiguos te da Sillon
(550, 420, NULL), #Sillon de los Antiguos te da Sillon
(551, 421, NULL), #Sillon de los Antiguos te da Sillon

(552, 422, NULL), #Dakara te da Arma de Dakara

(553, 423, NULL), #centinela te da centinela

(554, 424, NULL), #El Rey Arturo da Arturo

(555, 425, NULL), #Sillon de los Antiguos te da Sillon

(557, 653, 8), #Flota de la Alianza Lucian da Alkesh
(557, 654, 5), #Flota de la Alianza Lucian da Hatak
(557, 398, NULL), #Flota de la Alianza Lucian da Hatak Netan

(562, 657, 15), #Drones te da Drones

(560, 428, NULL); #Sillon de los Antiguos te da Sillon

INSERT INTO especialCapturaUnidad (idUnidad, idEspecial, idUnidadConvertir, probabilidad)
VALUES

#Tauri..................................................................
(115,  4, 451, 70),  #Tretonina convierte Amazonas
( 42,  4, 451, 70),  #Tretonina convierte Guerreros Jaffa
( 43,  4, 451, 65),  #Tretonina convierte Guardia Personal
( 44,  4, 451, 70),  #Tretonina convierte Infiltrados Apophis
( 45,  4, 451, 65),  #Tretonina convierte Guardia Chacal
( 46,  4, 451, 70),  #Tretonina convierte Guardia Horus
( 47,  4, 451, 70),  #Tretonina convierte Guardia Baal
( 48,  4, 451, 70),  #Tretonina convierte Guardia Sokar
(114,  4, 451, 65),  #Tretonina convierte Rebeldes Jaffa
(116,  4, 451, 65),  #Tretonina convierte Ninjas
(117,  4, 451, 65),  #Tretonina convierte Jaffas Imhotep
(118,  4, 451, 65),  #Tretonina convierte Distra
(119,  4, 458, 65),  #Tretonina convierte Sodan
(215,  4, 458, 65),  #Tretonina convierte Jaffa Prior
(353,  4, 458, 65),  #Tretonina convierte Illac Renin
(426,  4, 458, 65),  #Tretonina convierte Jaffas Dragon
(440,  4, 451, 65),  #Tretonina convierte Jaffas Hathor
(451,  4, 451, 50),  #Tretonina convierte Jaffas Recluta
(458,  4, 458, 50),  #Tretonina convierte Jaffas SGC
(459,  4, 458, 50),  #Tretonina convierte Jaffa Consul

(35,  7,   667, 70),   #Comando de Captura consigue BC-303
(36,  7,   668, 60),   #Comando de Captura consigue BC-304
(88,  7,   669, 60),   #Comando de Captura consigue Hatak
(89,  7,   670, 40),   #Comando de Captura consigue Palacio Nodriza
(96,  7,   668, 60),   #Comando de Captura consigue Dedalo Goauld
(97,  7,   674, 30),   #Comando de Captura consigue Nave Ori de Baal
(106, 7,   671, 50),   #Comando de Captura consigue Jackson
(107, 7,   672, 40),   #Comando de Captura consigue ONeill
(137, 7,   669, 60),   #Comando de Captura consigue Hatak Jaffa
(138, 7,   670, 40),   #Comando de Captura consigue Nave Nodriza
(167, 7,   668, 60),   #Comando de Captura consigue BC304
(168, 7,   673, 40),   #Comando de Captura consigue Aurora
(190, 7,   676, 60),   #Comando de Captura consigue Nave Colmena
(223, 7,   674, 30),   #Comando de Captura consigue Nodrizas Ori
(224, 7,   669, 60),   #Comando de Captura consigue Hatak Ori
(306, 7,   675, 60),   #Comando de Captura consigue ?
(351, 7,   668, 60),   #Comando de Captura consigue Dedalo Wraith
(667, 7,   667, 70),   #Comando de Captura consigue BC-303 capt.
(668, 7,   668, 60),   #Comando de Captura consigue BC-304 capt.
(669, 7,   669, 60),   #Comando de Captura consigue Hatak capt.
(670, 7,   670, 40),   #Comando de Captura consigue Palacio Nodriza capt.
(671, 7,   671, 50),   #Comando de Captura consigue Jackson capt.
(672, 7,   672, 40),   #Comando de Captura consigue ONeill capt.
(673, 7,   673, 40),   #Comando de Captura consigue Aurora capt.
(676, 7,   676, 60),   #Comando de Captura consigue Nave Colmena capt.
(674, 7,   674, 30),   #Comando de Captura consigue Nodrizas Ori capt.
(675, 7,   675, 60),   #Comando de Captura consigue ? capt.

(48,  564, 436,  75), #Extraccion Guardias Netu
(49,  564, 436,  75), #Extraccion Trust
(52,  564, 436,  75), #Extraccion Ashrak 
(54,  564, 436,  75), #Extraccion Arqueologo
(55,  564, 436,  75), #Extraccion Cientifico 
(56,  564, 436,  75), #Extraccion Militar
(58,  564, 436,  75), #Extraccion Reina
(66,  564, 436,  75), #Extraccion Primado
(67,  564, 436,  75), #Extraccion Principe
(70,  564, 436,  75), #Extraccion Orici
(72,  564, 436,  75), #Extraccion Quetesh
(255, 564, 436,  75), #Extraccion Prisioneros
(417, 564, 436,  75), #Extraccion Soldados

(33, 569, 33, 80), #Pillaje ---> X301
(34, 569, 34, 80), #Pillaje ---> X302
(83, 569, 83, 80), #Pillaje ---> Planeador
(84, 569, 84, 80), #Pillaje ---> Aguja
(85, 569, 85, 80), #Pillaje ---> Osiris
(86, 569, 86, 80), #Pillaje ---> Alkesh
(87, 569, 87, 80), #Pillaje ---> Alkesh carga
(104,569, 104,80), #Pillaje ---> Caza Vanir
(105,569, 105,60), #Pillaje ---> Beliksner
(134,569, 134,80), #Pillaje ---> Udajeet
(135,569, 135,80), #Pillaje ---> Teltak
(136,569, 136,80), #Pillaje ---> Alkesh Jaffa
(165,569, 165,80), #Pillaje ---> F301
(166,569, 166,80), #Pillaje ---> Jumper
(187,569, 187,80), #Pillaje ---> Dardos
(188,569, 188,80), #Pillaje ---> Explorador
(189,569, 189,60), #Pillaje ---> Crucero Wraith
(222,569, 222,80), #Pillaje ---> Caza Ori
(297,569, 297,80), #Pillaje ---> Cosechadora
(298,569, 298,80), #Pillaje ---> Caza Bedrosiano
(299,569, 299,80), #Pillaje ---> Caza ?
(303,569, 303,80), #Pillaje ---> Crucero traveller
(342,569, 342,80), #Pillaje ---> Olesiano

#Goauld.................................................................
(2,     18, 452,   70),  #Implantacion... Ingenieros --> Soldado Goauld
(3,     18, 452,   70),  #Implantacion... Comando SG --> Soldado Goauld
(4,     18, 452,   70),  #Implantacion... Comando ruso --> Soldado Goauld
(5,     18, 452,   70),  #Implantacion... NIDs --> Soldado Goauld
(6,     18, 417,   60),  #Implantacion... Oficial SG --> Soldado Goauld
(7,     18, 417,   60),  #Implantacion... Oficial ruso --> Soldado Goauld
(8,     18,  54,  100), #Implantacion... Daniel Jackson --> Arqueologo Goauld
(11,    18,  55,  100), #Implantacion... Carter --> Cientifico Goauld
(13,    18,  72,  100), #Implantacion... Vala --> Qetesh
(16,    18,  56,  100), #Implantacion... Kawalsky --> Militar Goauld
(126,   18,  66,  100), #Implantacion... KTano --> Imhotep
(143,   18, 452,   70),  #Implantacion... Zapadores --> Soldado Goauld
(144,   18, 452,   70),  #Implantacion... Comando Atlantis --> Soldado Goauld
(145,   18, 417,   60),  #Implantacion... Antiguo Espectro --> Soldado Goauld
(146,   18, 417,   60),  #Implantacion... Marine --> Soldado Goauld
(151,   18, 417,   60),  #Implantacion... Michael Ken. --> Soldado Goauld
(173,   18,  77,   70), #Implantacion... Guerreros Wraith --> Wraith Goauld
(174,   18,  77,   70), #Implantacion... Oficial Wraith --> Wraith Goauld
(175,   18, 417,   60), #Implantacion... Hibrido --> Wraith Goauld
(179,   18,  77,  100), #Implantacion... Sheppard wraith --> Wraith Goauld
(180,   18,  77,  100), #Implantacion... Teyla --> Wraith Goauld
(210,   18, 452,   70), #Implantacion... Guerreros --> Soldado Goauld
(216,   18,  70,  100), #Implantacion... Orici --> Orici Goauld
(232,   18, 452,   70), #Implantacion... Salish --> Soldado Goauld
(233,   18, 452,   70), #Implantacion... Athosianos --> Soldado Goauld
(234,   18, 452,   70),  #Implantacion... Vikingos --> Soldado Goauld
(235,   18, 452,   70),  #Implantacion... Juna --> Soldado Goauld
(236,   18, 452,   70),  #Implantacion... Anti-Ori --> Soldado Goauld
(237,   18, 452,   70),  #Implantacion... Soldado Lang. --> Soldado Goauld
(238,   18, 452,   70),  #Implantacion... Bola Kai --> Soldado Goauld
(239,   18, 452,   70),  #Implantacion... Comando Genii --> Guardia Personal
(240,   18, 452,   70),  #Implantacion... Comando Tokra --> Guardia Personal
(241,   18, 417,   60),  #Implantacion... Milicia --> Soldado Goauld
(242,   18, 452,   70),  #Implantacion... Gera --> Soldado Goauld
(243,   18, 452,   70),  #Implantacion... RandCaledonia --> Soldado Goauld
(244,   18, 452,   70),  #Implantacion... Milicia Abydos --> Soldado Goauld
(245,   18, 452,   70),  #Implantacion... Prisioneros --> Soldado Goauld
(247,   18, 248,   75), #Implantacion... Unas Silvestres --> Unas Goauld
(251,   18, 452,   70),  #Implantacion... Bedrosianos --> Soldado Goauld
(252,   18, 452,   70),  #Implantacion... Euronda --> Soldado Goauld
(253,   18, 452,   70),  #Implantacion... Tollanos --> Soldado Goauld
(258,   18, 452,   70),  #Implantacion... Ford --> Soldado Goauld
(259,   18, 417,   60),  #Implantacion... Satedanos --> Soldado Goauld
(262,   18, 417,   60),  #Implantacion... Oficial Genii --> Soldado Goauld
(267,   18,  58,  100),  #Implantacion... Share --> Amaonet
(271,   18,  67,  100), #Implantacion convierte a Skaara en Klorel
(315,   18, 452,   70),  #Implantacion... Arkham --> Soldado Goauld
(316,   18, 452,   70),  #Implantacion... Ford --> Soldado Goauld
(325,   18,  55,  100), #Implantacion... Carter --> Cientifico Goauld
(336,   18,  72,   80), #Implantacion... Sacerdotisas --> Qetesh
(347,   18, 417,   60),  #Implantacion... Adoradores --> Soldado Goauld
(348,   18, 417,   60),  #Implantacion... Corredores --> Soldado Goauld
(399,   18, 417,   60),  #Implantacion... Lucian --> Soldado Goauld
(457,   18, 452,   70),  #Implantacion... GuerreroOri --> Soldado Goauld
(460,   18,  77,   70),  #Implantacion... Wraith Guardian --> Wraith Goauld

(35,  21,   667, 70),   #Nishta consigue BC-303
(36,  21,    96, 60),   #Nishta consigue BC-304
(88,  21,   669, 60),   #Nishta consigue Hatak
(89,  21,   670, 40),   #Nishta consigue Palacio Nodriza
(96,  21,    96, 60),   #Nishta consigue Dedalo Goauld
(97,  21,    97, 30),   #Nishta consigue Nave Ori de Baal
(106, 21,   671, 50),   #Nishta consigue Jackson
(107, 21,   672, 40),   #Nishta consigue ONeill
(137, 21,   669, 60),   #Nishta consigue Hatak Jaffa
(138, 21,   670, 40),   #Nishta consigue Nave Nodriza
(167, 21,    96, 60),   #Nishta consigue BC304
(168, 21,   673, 40),   #Nishta consigue Aurora
(190, 21,   676, 60),   #Nishta consigue Nave Colmena
(223, 21,    97, 30),   #Nishta consigue Nodrizas Ori
(224, 21,   669, 60),   #Nishta consigue Hatak Ori
(306, 21,   675, 60),   #Nishta consigue ?
(351, 21,    96, 60),   #Nishta consigue Dedalo Wraith
(667, 21,   667, 70),   #Nishta consigue BC-303 capt.
(668, 21,    96, 60),   #Nishta consigue BC-304 capt.
(669, 21,   669, 60),   #Nishta consigue Hatak capt.
(670, 21,   670, 40),   #Nishta consigue Palacio Nodriza capt.
(671, 21,   671, 50),   #Nishta consigue Jackson capt.
(672, 21,   672, 40),   #Nishta consigue ONeill capt.
(673, 21,   673, 40),   #Nishta consigue Aurora capt.
(676, 21,   676, 60),   #Nishta consigue Nave Colmena capt.
(674, 21,    97, 30),   #Nishta consigue Nodrizas Ori capt.
(675, 21,   675, 60),   #Nishta consigue ? capt.

(2,     506, 254, 70),  #Invest. Hokt... Ingenieros --> Humanos mutados
(3,     506, 254, 70),  #Invest. Hokt... Comando SG --> Humanos mutados
(4,     506, 254, 70),  #Invest. Hokt... Comando ruso --> Humanos mutados
(5,     506, 254, 70),  #Invest. Hokt... NIDs --> Humanos mutados
(6,     506, 254, 70),  #Invest. Hokt... Oficial SG --> Humanos mutados
(7,     506, 254, 70),  #Invest. Hokt... Oficial ruso --> Humanos mutados
(142,   506, 254, 70),  #Invest. Hokt... com. Explo --> Humanos mutados
(143,   506, 254, 70),  #Invest. Hokt... Zapadores --> Humanos mutados
(144,   506, 254, 70),  #Invest. Hokt... Comando Atlantis --> Humanos mutados
(145,   506, 254, 70),  #Invest. Hokt... Antiguo Espectro --> Humanos mutados
(146,   506, 254, 70),  #Invest. Hokt... Marine --> Humanos mutados
(151,   506, 254, 100),  #Invest. Hokt... Michael Ken. --> Humanos mutados
(210,   506, 254, 70), #Invest. Hokt... Guerreros --> Humanos mutados
(232,   506, 254, 75), #Invest. Hokt... Salish --> Humanos mutados
(233,   506, 254, 75), #Invest. Hokt... Athosianos --> Humanos mutados
(234,   506, 254, 70),  #Invest. Hokt... Vikingos --> Humanos mutados
(235,   506, 254, 70),  #Invest. Hokt... Juna --> Humanos mutados
(236,   506, 254, 70),  #Invest. Hokt... Anti-Ori --> Humanos mutados
(237,   506, 254, 70),  #Invest. Hokt... Soldado Lang. --> Humanos mutados
(238,   506, 254, 70),  #Invest. Hokt... Bola Kai --> Humanos mutados
(239,   506, 254, 70),  #Invest. Hokt... Comando Genii --> Humanos mutados
(240,   506, 254, 70),  #Invest. Hokt... Comando Tokra --> Humanos mutados
(241,   506, 254, 70),  #Invest. Hokt... Milicia --> Humanos mutados
(242,   506, 254, 70),  #Invest. Hokt... Gera --> Humanos mutados
(243,   506, 254, 70),  #Invest. Hokt... RandCaledonia --> Humanos mutados
(244,   506, 254, 70),  #Invest. Hokt... Milicia Abydos --> Humanos mutados
(245,   506, 254, 70),  #Invest. Hokt... Prisioneros --> Humanos mutados
(251,   506, 254, 70),  #Invest. Hokt... Bedrosianos --> Humanos mutados
(252,   506, 254, 70),  #Invest. Hokt... Euronda --> Humanos mutados
(253,   506, 254, 70),  #Invest. Hokt... Tollanos --> Humanos mutados
(258,   506, 254, 70),  #Invest. Hokt... Ford --> Humanos mutados
(259,   506, 254, 70),  #Invest. Hokt... Satedanos --> Humanos mutados
(262,   506, 254, 70),  #Invest. Hokt... Oficial Genii --> Humanos mutados
(315,   506, 254, 70),  #Invest. Hokt... Arkham --> Humanos mutados
(316,   506, 254, 70),  #Invest. Hokt... Ford --> Humanos mutados
(336,   506, 254, 80), #Invest. Hokt... Sacerdotisas --> Humanos mutados
(347,   506, 254, 70),  #Invest. Hokt... Adoradores --> Humanos mutados

(2,     507, 440, 70),  #Feromonas... Ingenieros --> Guardia Horus
(3,     507, 440, 70),  #Feromonas... Comando SG --> Guardia Horus
(4,     507, 440, 70),  #Feromonas... Comando ruso --> Guardia Horus
(5,     507, 440, 70),  #Feromonas... NIDs --> Guardia Horus
(6,     507, 440, 70),  #Feromonas... Oficial SG --> Guardia Horus
(7,     507, 440, 70),  #Feromonas... Oficial ruso --> Guardia Horus
(142,   507, 440, 70),  #Feromonas... com. Explo --> Guardia Horus
(143,   507, 440, 70),  #Feromonas... Zapadores --> Guardia Horus
(144,   507, 440, 70),  #Feromonas... Comando Atlantis --> Guardia Horus
(145,   507, 440, 70),  #Feromonas... Antiguo Espectro --> Guardia Horus
(146,   507, 440, 70),  #Feromonas... Marine --> Guardia Horus
(151,   507, 440, 100),  #Feromonas... Michael Ken. --> Guardia Horus
(210,   507, 440, 70), #Feromonas... Guerreros --> Guardia Horus
(232,   507, 440, 75), #Feromonas... Salish --> Guardia Horus
(233,   507, 440, 75), #Feromonas... Athosianos --> Guardia Horus
(234,   507, 440, 70),  #Feromonas... Vikingos --> Guardia Horus
(235,   507, 440, 70),  #Feromonas... Juna --> Guardia Horus
(236,   507, 440, 70),  #Feromonas... Anti-Ori --> Guardia Horus
(237,   507, 440, 70),  #Feromonas... Soldado Lang. --> Guardia Horus
(238,   507, 440, 70),  #Feromonas... Bola Kai --> Guardia Horus
(239,   507, 440, 70),  #Feromonas... Comando Genii --> Guardia Horus
(240,   507, 440, 70),  #Feromonas... Comando Tokra --> Guardia Horus
(241,   507, 440, 70),  #Feromonas... Milicia --> Guardia Horus
(242,   507, 440, 70),  #Feromonas... Gera --> Guardia Horus
(243,   507, 440, 70),  #Feromonas... RandCaledonia --> Guardia Horus
(244,   507, 440, 70),  #Feromonas... Milicia Abydos --> Guardia Horus
(245,   507, 440, 70),  #Feromonas... Prisioneros --> Guardia Horus
(251,   507, 440, 70),  #Feromonas... Bedrosianos --> Guardia Horus
(252,   507, 440, 70),  #Feromonas... Euronda --> Guardia Horus
(253,   507, 440, 70),  #Feromonas... Tollanos --> Guardia Horus
(258,   507, 440, 70),  #Feromonas... Ford --> Guardia Horus
(259,   507, 440, 70),  #Feromonas... Satedanos --> Guardia Horus
(262,   507, 440, 70),  #Feromonas... Oficial Genii --> Guardia Horus
(315,   507, 440, 70),  #Feromonas... Arkham --> Guardia Horus
(316,   507, 440, 70),  #Feromonas... Ford --> Guardia Horus
(336,   507, 440, 80), #Feromonas... Sacerdotisas --> Guardia Horus
(347,   507, 440, 70),  #Feromonas... Adoradores --> Guardia Horus
(348,   507, 440, 70),  #Feromonas... Corredores --> Guardia Horus
(399,   507, 440, 70),  #Feromonas... Lucian --> Guardia Horus
(440,   507, 440, 70),  #Feromonas... 

(33, 570, 33, 80), #Saqueo Celta ---> X301
(34, 570, 34, 80), #Saqueo Celta ---> X302
(83, 570, 83, 80), #Saqueo Celta ---> Planeador
(84, 570, 84, 80), #Saqueo Celta ---> Aguja
(85, 570, 85, 80), #Saqueo Celta ---> Osiris
(86, 570, 86, 80), #Saqueo Celta ---> Alkesh
(87, 570, 87, 80), #Saqueo Celta ---> Alkesh carga
(104,570, 104,80), #Saqueo Celta ---> Caza Vanir
(105,570, 105,60), #Saqueo Celta ---> Beliksner
(134,570, 134,80), #Saqueo Celta ---> Udajeet
(135,570, 135,80), #Saqueo Celta ---> Teltak
(136,570, 136,80), #Saqueo Celta ---> Alkesh Jaffa
(165,570, 165,80), #Saqueo Celta ---> F301
(166,570, 166,80), #Saqueo Celta ---> Jumper
(187,570, 187,80), #Saqueo Celta ---> Dardos
(188,570, 188,80), #Saqueo Celta ---> Explorador
(189,570, 189,60), #Saqueo Celta ---> Crucero Wraith
(222,570, 222,80), #Saqueo Celta ---> Caza Ori
(297,570, 297,80), #Saqueo Celta ---> Cosechadora
(298,570, 298,80), #Saqueo Celta ---> Caza Bedrosiano
(299,570, 299,80), #Saqueo Celta ---> Caza ?
(303,570, 303,80), #Saqueo Celta ---> Crucero traveller
(342,570, 342,80), #Saqueo Celta ---> Olesiano

#Jaffa...................................................................
(42,  40, 454, 75),  #Rebelion!! convierte Guerreros Jaffa
(43,  40, 454, 75),  #Rebelion!! convierte Guardia Personal
(44,  40, 454, 75),  #Rebelion!! convierte Infiltrados Apophis
(45,  40, 454, 75),  #Rebelion!! convierte Guardia Chacal
(46,  40, 454, 75),  #Rebelion!! convierte Guardia Horus
(47,  40, 454, 75),  #Rebelion!! convierte Guardia Baal
(48,  40, 454, 75),  #Rebelion!! convierte Guardia Sokar
(114, 40, 454, 75),  #Rebelion!! convierte Rebeldes Jaffa
(115, 40, 454, 75),  #Rebelion!! convierte Amazonas
(116, 40, 454, 75),  #Rebelion!! convierte Ninjas
(117, 40, 454, 75),  #Rebelion!! convierte Jaffas Imhotep
(118, 40, 454, 75),  #Rebelion!! convierte Distra
(119, 40, 459, 75),  #Rebelion!! convierte Sodan
(215, 40, 459, 75),  #Rebelion!! convierte Jaffa Prior
(353, 40, 459, 75),  #Rebelion!! convierte Illac Renin
(440, 40, 454, 75),  #Rebelion!! convierte Guardia Real
(426, 40, 459, 75),  #Rebelion!! convierte Jaffas Dragon

(35,  43,   667, 70),   #Botin de guerra consigue BC-303
(36,  43,   668, 60),   #Botin de guerra consigue BC-304
(88,  43,   669, 60),   #Botin de guerra consigue Hatak
(89,  43,   670, 40),   #Botin de guerra consigue Palacio Nodriza
(96,  43,   668, 60),   #Botin de guerra consigue Dedalo Goauld
(97,  43,   674, 30),   #Botin de guerra consigue Nave Ori de Baal
(106, 43,   671, 50),   #Botin de guerra consigue Jackson
(107, 43,   672, 40),   #Botin de guerra consigue ONeill
(137, 43,   669, 60),   #Botin de guerra consigue Hatak Jaffa
(138, 43,   670, 40),   #Botin de guerra consigue Nave Nodriza
(167, 43,   668, 60),   #Botin de guerra consigue BC304
(168, 43,   673, 40),   #Botin de guerra consigue Aurora
(190, 43,   676, 60),   #Botin de guerra consigue Nave Colmena
(223, 43,   674, 30),   #Botin de guerra consigue Nodrizas Ori
(224, 43,   669, 60),   #Botin de guerra consigue Hatak Ori
(306, 43,   675, 60),   #Botin de guerra consigue ?
(351, 43,   668, 60),   #Botin de guerra consigue Dedalo Wraith
(667, 43,   667, 70),   #Botin de guerra consigue BC-303 capt.
(668, 43,   668, 60),   #Botin de guerra consigue BC-304 capt.
(669, 43,   669, 60),   #Botin de guerra consigue Hatak capt.
(670, 43,   670, 40),   #Botin de guerra consigue Palacio Nodriza capt.
(671, 43,   671, 50),   #Botin de guerra consigue Jackson capt.
(672, 43,   672, 40),   #Botin de guerra consigue ONeill capt.
(673, 43,   673, 40),   #Botin de guerra consigue Aurora capt.
(676, 43,   676, 60),   #Botin de guerra consigue Nave Colmena capt.
(674, 43,   674, 30),   #Botin de guerra consigue Nodrizas Ori capt.
(675, 43,   675, 60),   #Botin de guerra consigue ? capt.

(33, 571, 33, 80), #Hurto Silencioso ---> X301
(34, 571, 34, 80), #Hurto Silencioso ---> X302
(83, 571, 83, 80), #Hurto Silencioso ---> Planeador
(84, 571, 84, 80), #Hurto Silencioso ---> Aguja
(85, 571, 85, 80), #Hurto Silencioso ---> Osiris
(86, 571, 86, 80), #Hurto Silencioso ---> Alkesh
(87, 571, 87, 80), #Hurto Silencioso ---> Alkesh carga
(104,571, 104,80), #Hurto Silencioso ---> Caza Vanir
(105,571, 105,60), #Hurto Silencioso ---> Beliksner
(134,571, 134,80), #Hurto Silencioso ---> Udajeet
(135,571, 135,80), #Hurto Silencioso ---> Teltak
(136,571, 136,80), #Hurto Silencioso ---> Alkesh Jaffa
(165,571, 165,80), #Hurto Silencioso ---> F301
(166,571, 166,80), #Hurto Silencioso ---> Jumper
(187,571, 187,80), #Hurto Silencioso ---> Dardos
(188,571, 188,80), #Hurto Silencioso ---> Explorador
(189,571, 189,60), #Hurto Silencioso ---> Crucero Wraith
(222,571, 222,80), #Hurto Silencioso ---> Caza Ori
(297,571, 297,80), #Hurto Silencioso ---> Cosechadora
(298,571, 298,80), #Hurto Silencioso ---> Caza Bedrosiano
(299,571, 299,80), #Hurto Silencioso ---> Caza ?
(303,571, 303,80), #Hurto Silencioso ---> Crucero traveller
(342,571, 342,80), #Hurto Silencioso ---> Olesiano

#Atlantis...............................................................
(77,  51, 145,  85), #Retrovirus convierte a los Wraith Goauld en Antiguos Espectros
(173, 51, 453,  85), #Retrovirus convierte a los Guerreros Wraith en Antiguos Espectros
(174, 51, 145,  85), #Retrovirus convierte a los Oficiales Wraith en Antiguos Espectros
(182, 51, 151, 100), #Retrovirus convierte a los Michael en Teniente

(35,  54,   667, 70),   #Comando de Captura consigue BC-303
(36,  54,   668, 60),   #Comando de Captura consigue BC-304
(88,  54,   669, 60),   #Comando de Captura consigue Hatak
(89,  54,   670, 40),   #Comando de Captura consigue Palacio Nodriza
(96,  54,   668, 60),   #Comando de Captura consigue Dedalo Goauld
(97,  54,   674, 30),   #Comando de Captura consigue Nave Ori de Baal
(106, 54,   671, 50),   #Comando de Captura consigue Jackson
(107, 54,   672, 40),   #Comando de Captura consigue ONeill
(137, 54,   669, 60),   #Comando de Captura consigue Hatak Jaffa
(138, 54,   670, 40),   #Comando de Captura consigue Nave Nodriza
(167, 54,   668, 60),   #Comando de Captura consigue BC304
(168, 54,   673, 40),   #Comando de Captura consigue Aurora
(190, 54,   676, 60),   #Comando de Captura consigue Nave Colmena
(223, 54,   674, 30),   #Comando de Captura consigue Nodrizas Ori
(224, 54,   669, 60),   #Comando de Captura consigue Hatak Ori
(306, 54,   675, 60),   #Comando de Captura consigue ?
(351, 54,   668, 60),   #Comando de Captura consigue Dedalo Wraith
(667, 54,   667, 70),   #Comando de Captura consigue BC-303 capt.
(668, 54,   668, 60),   #Comando de Captura consigue BC-304 capt.
(669, 54,   669, 60),   #Comando de Captura consigue Hatak capt.
(670, 54,   670, 40),   #Comando de Captura consigue Palacio Nodriza capt.
(671, 54,   671, 50),   #Comando de Captura consigue Jackson capt.
(672, 54,   672, 40),   #Comando de Captura consigue ONeill capt.
(673, 54,   673, 40),   #Comando de Captura consigue Aurora capt.
(676, 54,   676, 60),   #Comando de Captura consigue Nave Colmena capt.
(674, 54,   674, 30),   #Comando de Captura consigue Nodrizas Ori capt.
(675, 54,   675, 60),   #Comando de Captura consigue ? capt.

(33, 572, 33, 80), #Naves de vuelo ligera ---> X301
(34, 572, 34, 80), #Naves de vuelo ligera ---> X302
(83, 572, 83, 80), #Naves de vuelo ligera ---> Planeador
(84, 572, 84, 80), #Naves de vuelo ligera ---> Aguja
(85, 572, 85, 80), #Naves de vuelo ligera ---> Osiris
(86, 572, 86, 80), #Naves de vuelo ligera ---> Alkesh
(87, 572, 87, 80), #Naves de vuelo ligera ---> Alkesh carga
(104,572, 104,80), #Naves de vuelo ligera ---> Caza Vanir
(105,572, 105,60), #Naves de vuelo ligera ---> Beliksner
(134,572, 134,80), #Naves de vuelo ligera ---> Udajeet
(135,572, 135,80), #Naves de vuelo ligera ---> Teltak
(136,572, 136,80), #Naves de vuelo ligera ---> Alkesh Jaffa
(165,572, 165,80), #Naves de vuelo ligera ---> F301
(166,572, 166,80), #Naves de vuelo ligera ---> Jumper
(187,572, 187,80), #Naves de vuelo ligera ---> Dardos
(188,572, 188,80), #Naves de vuelo ligera ---> Explorador
(189,572, 189,60), #Naves de vuelo ligera ---> Crucero Wraith
(222,572, 222,80), #Naves de vuelo ligera ---> Caza Ori
(297,572, 297,80), #Naves de vuelo ligera ---> Cosechadora
(298,572, 298,80), #Naves de vuelo ligera ---> Caza Bedrosiano
(299,572, 299,80), #Naves de vuelo ligera ---> Caza ?
(303,572, 303,80), #Naves de vuelo ligera ---> Crucero traveller
(342,572, 342,80), #Naves de vuelo ligera ---> Olesiano

#Replicantes............................................................
(6,     88, 200, 70),  #Asimilacion organica... Oficial SG --> Humanoide Replicante
(7,     88, 200, 70),  #Asimilacion organica... Oficial ruso --> Humanoide Replicante
(145,   88, 200, 70),  #Asimilacion organica... Antiguo Espectro --> Humanoide Replicante
(146,   88, 200, 70),  #Asimilacion organica... Marine --> Humanoide Replicante
(151,   88, 200, 100),  #Asimilacion organica... Michael Ken. --> Humanoide Replicante
(241,   88, 200, 70),  #Asimilacion organica... Milicia --> Humanoide Replicante
(259,   88, 200, 70),  #Asimilacion organica... Satedanos --> Humanoide Replicante
(262,   88, 200, 70),  #Asimilacion organica... Oficial Genii --> Humanoide Replicante
(336,   88, 200, 80), #Asimilacion organica... Sacerdotisas --> Humanoide Replicante
(347,   88, 200, 70),  #Asimilacion organica... Adoradores --> Humanoide Replicante
(348,   88, 200, 70),  #Asimilacion organica... Corredores --> Humanoide Replicante
(350,   88, 200, 100),  #Asimilacion organica... Oneill --> Oneill
(399,   88, 200, 70),  #Asimilacion organica... Lucian --> Humanoide Replicante

(1,   95, 196, 95), #Despiece convierte UCAV en Replicante
(41,  95, 196, 95), #Despiece convierte Droide de reconoc. en Replicante
(31,  95, 198, 95), #Despiece convierte Lanzacohetes en Replicante humanoide
(80,  95, 197, 95), #Despiece convierte Lanzadera en Replicante avanazado
(81,  95, 197, 95), #Despiece convierte Torretas en Replicante avanazado
(82,  95, 198, 95), #Despiece convierte Satelite en Replicante humanoide
(98,  95, 196, 95), #Despiece convierte Sonda en Replicante
(101, 95, 198, 95), #Despiece convierte Martillo en Replicante humanoide
(102, 95, 198, 95), #Despiece convierte Martillo en Replicante humanoide
(131, 95, 197, 95), #Despiece convierte Lanzadera en Replicante avanazado
(132, 95, 197, 95), #Despiece convierte Torretas en Replicante avanazado
(162, 95, 197, 95), #Despiece convierte Canyon rail en Replicante avanazado
(163, 95, 197, 95), #Despiece convierte Canyon rail en Replicante avanazado
(164, 95, 198, 95), #Despiece convierte Satelite en Replicante humanoide
(172, 95, 196, 95), #Despiece convierte Sonda escaner en Replicante
(221, 95, 198, 95), #Despiece convierte Satelite en Replicante humanoide
(261, 95, 197, 95), #Despiece convierte Androides en Replicante avanazado
(288, 95, 197, 95), #Despiece convierte Canon artesano en Replicante avanazado
(295, 95, 197, 95), #Despiece convierte Canyon rail en Replicante avanazado
(332, 95, 332, 95), #Despiece convierte Pieza del SSG en Pieza del SSG

#Ori....................................................................
(8,     76, 213, 100), #El Poder de Celestis convierte en Daniel Jackson en Prior
(213,   76, 213,  50), #El Poder de Celestis convierte en Daniel Jackson Prior
(13,    76, 336, 100), #El Poder de Celestis convierte a Vala en Vala
(336,   76, 336,  50), #El poder de Celestis... Sacerdotisas --> Prior Avanzado
(125,   76, 215, 100), #El Poder de Celestis convierte a Gerak en Prior
(215,   76, 215,  50), #El Poder de Celestis convierte a Gerak en Prior
(140,   76, 224, 100), #El Poder de Celestis convierte a Lider del Consejo
(2,     76, 457, 70),  #El poder de Celestis... Ingenieros --> Prior Avanzado
(3,     76, 457, 70),  #El poder de Celestis... Comando SG --> Prior Avanzado
(4,     76, 457, 70),  #El poder de Celestis... Comando ruso --> Prior Avanzado
(5,     76, 457, 70),  #El poder de Celestis... NIDs --> Prior Avanzado
(6,     76, 461, 70),  #El poder de Celestis... Oficial SG --> Prior Avanzado
(7,     76, 461, 70),  #El poder de Celestis... Oficial ruso --> Prior Avanzado
(143,   76, 457, 70),  #El poder de Celestis... Zapadores --> Prior Avanzado
(144,   76, 457, 70),  #El poder de Celestis... Comando Atlantis --> Prior Avanzado
(145,   76, 461, 70),  #El poder de Celestis... Antiguo Espectro --> Prior Avanzado
(146,   76, 461, 70),  #El poder de Celestis... Marine --> Prior Avanzado
(151,   76, 461, 100),  #El poder de Celestis... Michael Ken. --> Prior Avanzado
(210,   76, 457, 70), #El poder de Celestis... Guerreros --> Prior Avanzado
(232,   76, 457, 75), #El poder de Celestis... Salish --> Prior Avanzado
(233,   76, 457, 75), #El poder de Celestis... Athosianos --> Prior Avanzado
(234,   76, 457, 70),  #El poder de Celestis... Vikingos --> Prior Avanzado
(235,   76, 457, 70),  #El poder de Celestis... Juna --> Prior Avanzado
(236,   76, 457, 70),  #El poder de Celestis... Anti-Ori --> Prior Avanzado
(237,   76, 457, 70),  #El poder de Celestis... Soldado Lang. --> Prior Avanzado
(238,   76, 457, 70),  #El poder de Celestis... Bola Kai --> Prior Avanzado
(239,   76, 457, 70),  #El poder de Celestis... Comando Genii --> Prior Avanzado
(240,   76, 457, 70),  #El poder de Celestis... Comando Tokra --> Prior Avanzado
(241,   76, 461, 70),  #El poder de Celestis... Milicia --> Prior Avanzado
(242,   76, 457, 70),  #El poder de Celestis... Gera --> Prior Avanzado
(243,   76, 457, 70),  #El poder de Celestis... RandCaledonia --> Prior Avanzado
(244,   76, 457, 70),  #El poder de Celestis... Milicia Abydos --> Prior Avanzado
(245,   76, 457, 70),  #El poder de Celestis... Prisioneros --> Prior Avanzado
(251,   76, 457, 70),  #El poder de Celestis... Bedrosianos --> Prior Avanzado
(252,   76, 457, 70),  #El poder de Celestis... Euronda --> Prior Avanzado
(253,   76, 457, 70),  #El poder de Celestis... Tollanos --> Prior Avanzado
(258,   76, 457, 70),  #El poder de Celestis... Ford --> Prior Avanzado
(259,   76, 461, 70),  #El poder de Celestis... Satedanos --> Prior Avanzado
(262,   76, 461, 70),  #El poder de Celestis... Oficial Genii --> Prior Avanzado
(315,   76, 457, 70),  #El poder de Celestis... Arkham --> Prior Avanzado
(316,   76, 457, 70),  #El poder de Celestis... Ford --> Prior Avanzado
(347,   76, 461, 70),  #El poder de Celestis... Adoradores --> Prior Avanzado
(348,   76, 461, 70),  #El poder de Celestis... Corredores --> Prior Avanzado
(399,   76, 461, 70),  #El poder de Celestis... Lucian --> Prior Avanzado

(42,  524, 353, 65), #Terroristas jaffa convierte Guerreros Jaffa
(43,  524, 353, 65), #Terroristas jaffa convierte Guardia Personal
(45,  524, 353, 65), #Terroristas jaffa convierte  Guardia Chacal
(46,  524, 353, 65), #Terroristas jaffa convierte Horus al 75%
(47,  524, 353, 65), #Terroristas jaffa convierte Guardia Baal al 75%
(113, 524, 353, 65), #Terroristas jaffa convierte Sacerdotes Jaffa (Jaffa) al 95%
(114, 524, 353, 65), #Terroristas jaffa convierte Rebeldes Jaffa al 95%
(115, 524, 353, 65), #Terroristas jaffa convierte Amazonas Jaffa al 80%
(116, 524, 353, 65), #Terroristas jaffa convierte Ninjas Jaffa al 80%
(117, 524, 353, 65), #Terroristas jaffa convierte Jaffas de Imhotep al 75%
(118, 524, 353, 65), #Terroristas jaffa convierte Distras al 80%
(119, 524, 353, 65), #Terroristas jaffa convierte Sodan al 70%

#Wraith.................................................................
(159,   63, 179, 100), #Legado Iratus... Sheppard
(179,   63, 179,  50), #Legado Iratus... Sheppard
(157,   63, 180, 100), #Legado Iratus... Teyla
(180,   63, 180,  50), #Legado Iratus... Teyla

(2,     63, 455, 70),  #Legado iratus... Ingenieros --> Oficial Wraith
(3,     63, 455, 70),  #Legado iratus... Comando SG --> Oficial Wraith
(4,     63, 455, 70),  #Legado iratus... Comando ruso --> Oficial Wraith
(5,     63, 455, 70),  #Legado iratus... NIDs --> Oficial Wraith
(6,     63, 460, 70),  #Legado iratus... Oficial SG --> Oficial Wraith
(7,     63, 460, 70),  #Legado iratus... Oficial ruso --> Oficial Wraith
(143,   63, 455, 70),  #Legado iratus... Zapadores --> Oficial Wraith
(144,   63, 455, 70),  #Legado iratus... Comando Atlantis --> Oficial Wraith
(145,   63, 460, 70),  #Legado iratus... Antiguo Espectro --> Oficial Wraith
(146,   63, 460, 70),  #Legado iratus... Marine --> Oficial Wraith
(151,   63, 460, 100),  #Legado iratus... Michael Ken. --> Oficial Wraith
(210,   63, 455, 70), #Legado iratus... Guerreros --> Oficial Wraith
(232,   63, 455, 75), #Legado iratus... Salish --> Oficial Wraith
(233,   63, 455, 75), #Legado iratus... Athosianos --> Oficial Wraith
(234,   63, 455, 70),  #Legado iratus... Vikingos --> Oficial Wraith
(235,   63, 455, 70),  #Legado iratus... Juna --> Oficial Wraith
(236,   63, 455, 70),  #Legado iratus... Anti-Ori --> Oficial Wraith
(237,   63, 455, 70),  #Legado iratus... Soldado Lang. --> Oficial Wraith
(238,   63, 455, 70),  #Legado iratus... Bola Kai --> Oficial Wraith
(239,   63, 455, 70),  #Legado iratus... Comando Genii --> Oficial Wraith
(240,   63, 455, 70),  #Legado iratus... Comando Tokra --> Oficial Wraith
(241,   63, 460, 70),  #Legado iratus... Milicia --> Oficial Wraith
(242,   63, 455, 70),  #Legado iratus... Gera --> Oficial Wraith
(243,   63, 455, 70),  #Legado iratus... RandCaledonia --> Oficial Wraith
(244,   63, 455, 70),  #Legado iratus... Milicia Abydos --> Oficial Wraith
(245,   63, 455, 70),  #Legado iratus... Prisioneros --> Oficial Wraith
(251,   63, 455, 70),  #Legado iratus... Bedrosianos --> Oficial Wraith
(252,   63, 455, 70),  #Legado iratus... Euronda --> Oficial Wraith
(253,   63, 455, 70),  #Legado iratus... Tollanos --> Oficial Wraith
(258,   63, 455, 70),  #Legado iratus... Ford --> Oficial Wraith
(259,   63, 460, 70),  #Legado iratus... Satedanos --> Oficial Wraith
(262,   63, 460, 70),  #Legado iratus... Oficial Genii --> Oficial Wraith
(315,   63, 455, 70),  #Legado iratus... Arkham --> Oficial Wraith
(316,   63, 455, 70),  #Legado iratus... Ford --> Oficial Wraith
(336,   63, 460, 80), #Legado iratus... Sacerdotisas --> Oficial Wraith
(347,   63, 460, 70),  #Legado iratus... Adoradores --> Oficial Wraith
(348,   63, 460, 70),  #Legado iratus... Corredores --> Oficial Wraith
(399,   63, 460, 70),  #Legado iratus... Lucian --> Oficial Wraith

(2,     71, 676, 3),  #Semilla... Ingenieros --> Colmena
(3,     71, 676, 3),  #Semilla... Comando SG --> Colmena
(4,     71, 676, 3),  #Semilla... Comando ruso --> Colmena
(5,     71, 676, 3),  #Semilla... NIDs --> Colmena
(6,     71, 676, 3),  #Semilla... Oficial SG --> Colmena
(7,     71, 676, 3),  #Semilla... Oficial ruso --> Colmena
(142,   71, 676, 3),  #Semilla... com. Explo --> Colmena
(143,   71, 676, 3),  #Semilla... Zapadores --> Colmena
(144,   71, 676, 3),  #Semilla... Comando Atlantis --> Colmena
(145,   71, 676, 3),  #Semilla... Antiguo Espectro --> Colmena
(146,   71, 676, 3),  #Semilla... Marine --> Colmena
(151,   71, 676, 3),  #Semilla... Michael Ken. --> Colmena
(210,   71, 676, 3), #Semilla... Guerreros --> Colmena
(232,   71, 676, 3), #Semilla... Salish --> Colmena
(233,   71, 676, 3), #Semilla... Athosianos --> Colmena
(234,   71, 676, 3),  #Semilla... Vikingos --> Colmena
(235,   71, 676, 3),  #Semilla... Juna --> Colmena
(236,   71, 676, 3),  #Semilla... Anti-Ori --> Colmena
(237,   71, 676, 3),  #Semilla... Soldado Lang. --> Colmena
(238,   71, 676, 3),  #Semilla... Bola Kai --> Colmena
(239,   71, 676, 3),  #Semilla... Comando Genii --> Colmena
(240,   71, 676, 3),  #Semilla... Comando Tokra --> Colmena
(241,   71, 676, 3),  #Semilla... Milicia --> Colmena
(242,   71, 676, 3),  #Semilla... Gera --> Colmena
(243,   71, 676, 3),  #Semilla... RandCaledonia --> Colmena
(244,   71, 676, 3),  #Semilla... Milicia Abydos --> Colmena
(245,   71, 676, 3),  #Semilla... Prisioneros --> Colmena
(251,   71, 676, 3),  #Semilla... Bedrosianos --> Colmena
(252,   71, 676, 3),  #Semilla... Euronda --> Colmena
(253,   71, 676, 3),  #Semilla... Tollanos --> Colmena
(258,   71, 676, 3),  #Semilla... Ford --> Colmena
(259,   71, 676, 3),  #Semilla... Satedanos --> Colmena
(262,   71, 676, 3),  #Semilla... Oficial Genii --> Colmena
(315,   71, 676, 3),  #Semilla... Arkham --> Colmena
(316,   71, 676, 3),  #Semilla... Ford --> Colmena
(336,   71, 676, 3), #Semilla... Sacerdotisas --> Colmena
(347,   71, 676, 3),  #Semilla... Adoradores --> Colmena
(348,   71, 676, 3),  #Semilla... Corredores --> Colmena
(399,   71, 676, 3),  #Semilla... Lucian --> Colmena

(35,  67,   667, 70),   #Comando de Captura consigue BC-303
(36,  67,   351, 60),   #Comando de Captura consigue BC-304
(88,  67,   669, 60),   #Comando de Captura consigue Hatak
(89,  67,   670, 40),   #Comando de Captura consigue Palacio Nodriza
(96,  67,   668, 60),   #Comando de Captura consigue Dedalo Goauld
(97,  67,   674, 30),   #Comando de Captura consigue Nave Ori de Baal
(106, 67,   671, 50),   #Comando de Captura consigue Jackson
(107, 67,   672, 40),   #Comando de Captura consigue ONeill
(137, 67,   669, 60),   #Comando de Captura consigue Hatak Jaffa
(138, 67,   670, 40),   #Comando de Captura consigue Nave Nodriza
(167, 67,   351, 60),   #Comando de Captura consigue BC304
(168, 67,   673, 40),   #Comando de Captura consigue Aurora
(190, 67,   676, 60),   #Comando de Captura consigue Nave Colmena
(223, 67,   674, 30),   #Comando de Captura consigue Nodrizas Ori
(224, 67,   669, 60),   #Comando de Captura consigue Hatak Ori
(306, 67,   675, 60),   #Comando de Captura consigue ?
(351, 67,   351, 60),   #Comando de Captura consigue Dedalo Wraith
(667, 67,   667, 70),   #Comando de Captura consigue BC-303 capt.
(668, 67,   351, 60),   #Comando de Captura consigue BC-304 capt.
(669, 67,   669, 60),   #Comando de Captura consigue Hatak capt.
(670, 67,   670, 40),   #Comando de Captura consigue Palacio Nodriza capt.
(671, 67,   671, 50),   #Comando de Captura consigue Jackson capt.
(672, 67,   672, 40),   #Comando de Captura consigue ONeill capt.
(673, 67,   673, 40),   #Comando de Captura consigue Aurora capt.
(676, 67,   676, 60),   #Comando de Captura consigue Nave Colmena capt.
(674, 67,   674, 30),   #Comando de Captura consigue Nodrizas Ori capt.
(675, 67,   675, 60),   #Comando de Captura consigue ? capt.

(2,     521, 347, 70),  #Adoracion... Ingenieros --> Adorador
(3,     521, 347, 70),  #Adoracion... Comando SG --> Adorador
(4,     521, 347, 70),  #Adoracion... Comando ruso --> Adorador
(5,     521, 347, 70),  #Adoracion... NIDs --> Adorador
(6,     521, 347, 70),  #Adoracion... Oficial SG --> Adorador
(7,     521, 347, 70),  #Adoracion... Oficial ruso --> Adorador
(142,   521, 347, 70),  #Adoracion... com. Explo --> Adorador
(143,   521, 347, 70),  #Adoracion... Zapadores --> Adorador
(144,   521, 347, 70),  #Adoracion... Comando Atlantis --> Adorador
(145,   521, 347, 70),  #Adoracion... Antiguo Espectro --> Adorador
(146,   521, 347, 70),  #Adoracion... Marine --> Adorador
(151,   521, 347, 70),  #Adoracion... Michael Ken. --> Adorador
(158,   521, 348, 100),  #Adoracion... Ronon
(210,   521, 347, 70), #Adoracion... Guerreros --> Adorador
(232,   521, 347, 70), #Adoracion... Salish --> Adorador
(233,   521, 347, 70), #Adoracion... Athosianos --> Adorador
(234,   521, 347, 70),  #Adoracion... Vikingos --> Adorador
(235,   521, 347, 70),  #Adoracion... Juna --> Adorador
(236,   521, 347, 70),  #Adoracion... Anti-Ori --> Adorador
(237,   521, 347, 70),  #Adoracion... Soldado Lang. --> Adorador
(238,   521, 347, 70),  #Adoracion... Bola Kai --> Adorador
(239,   521, 347, 70),  #Adoracion... Comando Genii --> Adorador
(240,   521, 347, 70),  #Adoracion... Comando Tokra --> Adorador
(241,   521, 347, 70),  #Adoracion... Milicia --> Adorador
(242,   521, 347, 70),  #Adoracion... Gera --> Adorador
(243,   521, 347, 70),  #Adoracion... RandCaledonia --> Adorador
(244,   521, 347, 70),  #Adoracion... Milicia Abydos --> Adorador
(245,   521, 347, 70),  #Adoracion... Prisioneros --> Adorador
(251,   521, 347, 70),  #Adoracion... Bedrosianos --> Adorador
(252,   521, 347, 70),  #Adoracion... Euronda --> Adorador
(253,   521, 347, 70),  #Adoracion... Tollanos --> Adorador
(258,   521, 347, 70),  #Adoracion... Ford --> Adorador
(259,   521, 347, 70),  #Adoracion... Satedanos --> Adorador
(262,   521, 347, 70),  #Adoracion... Oficial Genii --> Adorador
(315,   521, 347, 70),  #Adoracion... Arkham --> Adorador
(316,   521, 347, 70),  #Adoracion... Ford --> Adorador
(336,   521, 347, 70), #Adoracion... Sacerdotisas --> Adorador
(347,   521, 347, 70),  #Adoracion... Adoradores --> Adorador
(348,   521, 348, 70),  #Adoracion... Corredores --> Corredores
(399,   521, 347, 70),  #Adoracion... Lucian --> Adorador

(33, 573, 33, 80), #Tacticas enemigas ---> X301
(34, 573, 34, 80), #Tacticas enemigas ---> X302
(83, 573, 83, 80), #Tacticas enemigas ---> Planeador
(84, 573, 84, 80), #Tacticas enemigas ---> Aguja
(85, 573, 85, 80), #Tacticas enemigas ---> Osiris
(86, 573, 86, 80), #Tacticas enemigas ---> Alkesh
(87, 573, 87, 80), #Tacticas enemigas ---> Alkesh carga
(104,573, 104,80), #Tacticas enemigas ---> Caza Vanir
(105,573, 105,60), #Tacticas enemigas ---> Beliksner
(134,573, 134,80), #Tacticas enemigas ---> Udajeet
(135,573, 135,80), #Tacticas enemigas ---> Teltak
(136,573, 136,80), #Tacticas enemigas ---> Alkesh Jaffa
(165,573, 165,80), #Tacticas enemigas ---> F301
(166,573, 166,80), #Tacticas enemigas ---> Jumper
(187,573, 187,80), #Tacticas enemigas ---> Dardos
(188,573, 188,80), #Tacticas enemigas ---> Explorador
(189,573, 189,60), #Tacticas enemigas ---> Crucero Wraith
(222,573, 222,80), #Tacticas enemigas ---> Caza Ori
(297,573, 297,80), #Tacticas enemigas ---> Cosechadora
(298,573, 298,80), #Tacticas enemigas ---> Caza Bedrosiano
(299,573, 299,80), #Tacticas enemigas ---> Caza ?
(303,573, 303,80), #Tacticas enemigas ---> Crucero traveller
(342,573, 342,80), #Tacticas enemigas ---> Olesiano

#Otros..................................................................
(2,     538, 257, 85),  #Telchak... Ingenieros --> Zombie
(3,     538, 257, 85),  #Telchak... Comando SG --> Zombie
(4,     538, 257, 85),  #Telchak... Comando ruso --> Zombie
(5,     538, 257, 85),  #Telchak... NIDs --> Zombie
(6,     538, 257, 85),  #Telchak... Oficial SG --> Zombie
(7,     538, 257, 85),  #Telchak... Oficial ruso --> Zombie
(142,   538, 257, 85),  #Telchak... com. Explo --> Zombie
(143,   538, 257, 85),  #Telchak... Zapadores --> Zombie
(144,   538, 257, 85),  #Telchak... Comando Atlantis --> Zombie
(145,   538, 257, 85),  #Telchak... Antiguo Espectro --> Zombie
(146,   538, 257, 85),  #Telchak... Marine --> Zombie
(151,   538, 257, 85),  #Telchak... Michael Ken. --> Zombie
(210,   538, 257, 85), #Telchak... Guerreros --> Zombie
(232,   538, 257, 85), #Telchak... Salish --> Zombie
(233,   538, 257, 85), #Telchak... Athosianos --> Zombie
(234,   538, 257, 85),  #Telchak... Vikingos --> Zombie
(235,   538, 257, 85),  #Telchak... Juna --> Zombie
(236,   538, 257, 85),  #Telchak... Anti-Ori --> Zombie
(237,   538, 257, 85),  #Telchak... Soldado Lang. --> Zombie
(238,   538, 257, 85),  #Telchak... Bola Kai --> Zombie
(239,   538, 257, 85),  #Telchak... Comando Genii --> Zombie
(240,   538, 257, 85),  #Telchak... Comando Tokra --> Zombie
(241,   538, 257, 85),  #Telchak... Milicia --> Zombie
(242,   538, 257, 85),  #Telchak... Gera --> Zombie
(243,   538, 257, 85),  #Telchak... RandCaledonia --> Zombie
(244,   538, 257, 85),  #Telchak... Milicia Abydos --> Zombie
(245,   538, 257, 85),  #Telchak... Prisioneros --> Zombie
(251,   538, 257, 85),  #Telchak... Bedrosianos --> Zombie
(252,   538, 257, 85),  #Telchak... Euronda --> Zombie
(253,   538, 257, 85),  #Telchak... Tollanos --> Zombie
(258,   538, 257, 85),  #Telchak... Ford --> Zombie
(259,   538, 257, 85),  #Telchak... Satedanos --> Zombie
(262,   538, 257, 85),  #Telchak... Oficial Genii --> Zombie
(315,   538, 257, 85),  #Telchak... Arkham --> Zombie
(316,   538, 257, 85),  #Telchak... Ford --> Zombie
(336,   538, 257, 85), #Telchak... Sacerdotisas --> Zombie
(347,   538, 257, 85),  #Telchak... Zombiees --> Zombie
(348,   538, 257, 85),  #Telchak... Corredores --> Zombie
(399,   538, 257, 85),  #Telchak... Lucian --> Zombie

(2,     535, 261, 85),  #Comtraya... Ingenieros --> Androide
(3,     535, 261, 85),  #Comtraya... Comando SG --> Androide
(4,     535, 261, 85),  #Comtraya... Comando ruso --> Androide
(5,     535, 261, 85),  #Comtraya... NIDs --> Androide
(6,     535, 261, 85),  #Comtraya... Oficial SG --> Androide
(7,     535, 261, 85),  #Comtraya... Oficial ruso --> Androide
(142,   535, 261, 85),  #Comtraya... com. Explo --> Androide
(143,   535, 261, 85),  #Comtraya... Zapadores --> Androide
(144,   535, 261, 85),  #Comtraya... Comando Atlantis --> Androide
(145,   535, 261, 85),  #Comtraya... Antiguo Espectro --> Androide
(146,   535, 261, 85),  #Comtraya... Marine --> Androide
(151,   535, 261, 85),  #Comtraya... Michael Ken. --> Androide
(210,   535, 261, 85), #Comtraya... Guerreros --> Androide
(232,   535, 261, 85), #Comtraya... Salish --> Androide
(233,   535, 261, 85), #Comtraya... Athosianos --> Androide
(234,   535, 261, 85),  #Comtraya... Vikingos --> Androide
(235,   535, 261, 85),  #Comtraya... Juna --> Androide
(236,   535, 261, 85),  #Comtraya... Anti-Ori --> Androide
(237,   535, 261, 85),  #Comtraya... Soldado Lang. --> Androide
(238,   535, 261, 85),  #Comtraya... Bola Kai --> Androide
(239,   535, 261, 85),  #Comtraya... Comando Genii --> Androide
(240,   535, 261, 85),  #Comtraya... Comando Tokra --> Androide
(241,   535, 261, 85),  #Comtraya... Milicia --> Androide
(242,   535, 261, 85),  #Comtraya... Gera --> Androide
(243,   535, 261, 85),  #Comtraya... RandCaledonia --> Androide
(244,   535, 261, 85),  #Comtraya... Milicia Abydos --> Androide
(245,   535, 261, 85),  #Comtraya... Prisioneros --> Androide
(251,   535, 261, 85),  #Comtraya... Bedrosianos --> Androide
(252,   535, 261, 85),  #Comtraya... Euronda --> Androide
(253,   535, 261, 85),  #Comtraya... Tollanos --> Androide
(258,   535, 261, 85),  #Comtraya... Ford --> Androide
(259,   535, 261, 85),  #Comtraya... Satedanos --> Androide
(262,   535, 261, 85),  #Comtraya... Oficial Genii --> Androide
(315,   535, 261, 85),  #Comtraya... Arkham --> Androide
(316,   535, 261, 85),  #Comtraya... Ford --> Androide
(336,   535, 261, 85), #Comtraya... Sacerdotisas --> Androide
(347,   535, 261, 85),  #Comtraya... Androidees --> Androide
(348,   535, 261, 85),  #Comtraya... Corredores --> Androide
(399,   535, 261, 85),  #Comtraya... Lucian --> Androide
(299,   535, 350, 100), #Comtraya convierte a Oneill en Androide Oneill

(2,     536, 241, 85),  #Lucius... Ingenieros --> Milicia
(3,     536, 241, 85),  #Lucius... Comando SG --> Milicia
(4,     536, 241, 85),  #Lucius... Comando ruso --> Milicia
(5,     536, 241, 85),  #Lucius... NIDs --> Milicia
(6,     536, 241, 85),  #Lucius... Oficial SG --> Milicia
(7,     536, 241, 85),  #Lucius... Oficial ruso --> Milicia
(142,   536, 241, 85),  #Lucius... com. Explo --> Milicia
(143,   536, 241, 85),  #Lucius... Zapadores --> Milicia
(144,   536, 241, 85),  #Lucius... Comando Atlantis --> Milicia
(145,   536, 241, 85),  #Lucius... Antiguo Espectro --> Milicia
(146,   536, 241, 85),  #Lucius... Marine --> Milicia
(151,   536, 241, 85),  #Lucius... Michael Ken. --> Milicia
(210,   536, 241, 85), #Lucius... Guerreros --> Milicia
(232,   536, 241, 85), #Lucius... Salish --> Milicia
(233,   536, 241, 85), #Lucius... Athosianos --> Milicia
(234,   536, 241, 85),  #Lucius... Vikingos --> Milicia
(235,   536, 241, 85),  #Lucius... Juna --> Milicia
(236,   536, 241, 85),  #Lucius... Anti-Ori --> Milicia
(237,   536, 241, 85),  #Lucius... Soldado Lang. --> Milicia
(238,   536, 241, 85),  #Lucius... Bola Kai --> Milicia
(239,   536, 241, 85),  #Lucius... Comando Genii --> Milicia
(240,   536, 241, 85),  #Lucius... Comando Tokra --> Milicia
(241,   536, 241, 85),  #Lucius... Milicia --> Milicia
(242,   536, 241, 85),  #Lucius... Gera --> Milicia
(243,   536, 241, 85),  #Lucius... RandCaledonia --> Milicia
(244,   536, 241, 85),  #Lucius... Milicia Abydos --> Milicia
(245,   536, 241, 85),  #Lucius... Prisioneros --> Milicia
(251,   536, 241, 85),  #Lucius... Bedrosianos --> Milicia
(252,   536, 241, 85),  #Lucius... Euronda --> Milicia
(253,   536, 241, 85),  #Lucius... Tollanos --> Milicia
(258,   536, 241, 85),  #Lucius... Ford --> Milicia
(259,   536, 241, 85),  #Lucius... Satedanos --> Milicia
(262,   536, 241, 85),  #Lucius... Oficial Genii --> Milicia
(315,   536, 241, 85),  #Lucius... Arkham --> Milicia
(316,   536, 241, 85),  #Lucius... Ford --> Milicia
(336,   536, 241, 85), #Lucius... Sacerdotisas --> Milicia
(347,   536, 241, 85),  #Lucius... Miliciaes --> Milicia
(348,   536, 241, 85),  #Lucius... Corredores --> Milicia
(399,   536, 241, 85),  #Lucius... Lucian --> Milicia

(209,   561, 209, 100),  #Arca de la Verdad... Prior
(210,   561, 210, 100),  #Arca de la Verdad... Guerreros ori
(211,   561, 211, 100),  #Arca de la Verdad... Prior avanzado
(213,   561, 213, 100),  #Arca de la Verdad... Prior Daniel
(215,   561, 215, 100),  #Arca de la Verdad... Prior Gerak
(222,   561, 222, 100),  #Arca de la Verdad... Caza Incursion
(223,   561, 223, 100),  #Arca de la Verdad... Nave de Guerra
(224,   561, 224, 100),  #Arca de la Verdad... Hatak j ori
(220,   561, 220, 100),  #Arca de la Verdad... Pelotones de defensa
(221,   561, 221, 100),  #Arca de la Verdad... Satelite Ori
(457,   561, 457, 100),  #Arca de la Verdad... Guerrero Origen
(461,   561, 461, 100);  #Arca de la Verdad... Converso

#especialMejora
INSERT INTO especialMejora (idEspecial, idMejora)
VALUES

#Tauri..................................................................
('1','1001'),   #Refuerzos del SGC
('3','1003'),   #Tacticas militares
('6','1006'),   #Deposito del Conocimiento Antiguo
('9','1009'),   #Nucleo Asgard
('11','1011'),  #Desfase tontolano
('13','1013'),  #Manto de Arturo
('14','1014'),  #Modulo punto cero

('500','1500'), #Uso de Naquadriah
('504','1504'), #Suministros medicos

#Goauld.................................................................
('15','1015'),  #Conquista planetaria
('17','1017'),  #Sarcofago
('20','1020'),  #Conocimiento del universo
('23','1023'),  #El Ojo de Ra
('25','1025'),  #Ocultacion espacial
('26','1026'),  #Marcacion del Chappahai

('508','1508'), #Laboratorio de investigacion

#Asgard.................................................................
('27','1027'), #Investigacion Genetica
('29','1029'), #Ragnarok
('31','1031'), #Camuflaje Nox
('32','1032'), #Dilatador Temporal
('33','1033'), #Biblioteca de las 4 razas
('35','1035'), #Nucleo Asgard

#Jaffa.................................................................
('37','1037'), #Refuerzos del Consejo Jaffa
('39','1039'), #Kelnoreem
('42','1042'), #Biblioteca de Dakara
('45','1045'), #El Ojo de Ra

('514','1514'), #Liderazgo de Hierro

#Atlantis...............................................................
('48','1048'), #Refuerzos del IOA
('49','1049'), #Suministros medicos
('53','1053'), #Deposito del Conocimiento Antiguo
('56','1056'), #Nucleo Asgard
('58','1058'), #Modulo punto cero
('59','1059'), #Proyecto Arcturus

('515','1515'), #Enzima Wraith
('516','1516'), #Mr. McKay & Mss. Miller
('517','1517'), #Entrenamiento Athosiano
('518','1518'), #Ingeniería Checa

#Wraith.................................................................
('60','1060'), #Clonadora
('62','1062'), #Succionadores de almas
('66','1066'), #Información Lantiana
('69','1069'), #Crecimiento biologico
('72','1072'), #Hackeo Wraith

('522','1522'), #Las vegas Tour
('523','1523'), #Terapia genetica

#Ori....................................................................
('73','1073'), #Origen
('75','1075'), #Cruzada
('78','1078'), #Alabados sean los ori
('80','1080'), #Biblioteca de Celestis
('82','1082'), #Superstargate
('84','1084'), #Exploracion Intergalactica

#Replicantes............................................................
('85','1085'), #Actualizacion subespacial
('87','1087'), #Aleación de nuevos materiales
('90','1090'), #Dilatador Temporal
('92','1092'), #Sobrecarga del sistema
('94','1094'), #Desmolecularizacion

#Heroes planetas.......................................................
('526','1526'), #Tuneles de Cristal
('527','1527'), #Minas de Abydos
('529','1529'), #Camuflaje Nox
('530','1530'), #Portal Furling
('531','1531'), #Brazaletas Atoniek
('532','1532'), #Inventos de MaChelo
('533','1533'), #Desfase Tollano
('534','1534'), #El Rizo de Kon Garat

#Planetas...............................................................
('537','1537'), #Calavera de Cristal
('541','1541'), #Manto de Arturo
('542','1542'), #Tuneles de Cristal
('543','1543'), #Deposito de Conocimiento Antiguo
('544','1544'), #Biblioteca de la Cuatro Razas
('547','1547'), #Entrenamiento Athosiano
('548','1548'), #Dilatador temporal de Halla
('540','1549'), #Astilleros
('556','1556'); #Puente intergalactico


#############################################################################################################################################
## Requisitos de mejoras de los especiales
#############################################################################################################################################
INSERT INTO especialRequiereMejoraNormal (idEspecial, idMejora, nivel)
VALUES

########################################################
# Tauri.................................................
########################################################

(1,1,5), #Refuerzos del comite requiere Refuerzos a nivel 5
(1,2,5), #Refuerzos del comite requiere Transporte a nivel 5

(3,1,7), #Tacticas militares requiere Refuerzos a nivel 7
(3,4,8), #Tacticas militares requiere Armas de Fuego a nivel 8
(3,5,8), #Tacticas militares requiere Polimero de Ceramica a nivel 8

(4,4,10), #Tretonina requiere Armas de fuego a nivel 10
(4,5,10), #Tretonina requiere Polimero de ceramica a nivel 10
(4,1,9), #Tretonina requiere Refuerzos a nivel 9

(5,1,11), #Ascendido requiere Refuerzos a nivel 11
(5,4,12), #Ascendido requiere Armas de Fuego a nivel 12
(5,5,12), #Ascendido requiere Polimero de Ceramica a nivel 12

(6,1,14), #Deposito del Conocimiento Antiguo requiere Refuerzos a nivel 14
(6,2,13), #Deposito del Conocimiento Antiguo requiere Transporte a nivel 13
(6,3,12), #Deposito del Conocimiento Antiguo requiere Reactor a nivel 12

(11,1,16), #Desfase Tollano requiere Refuerzos nivel 16
(11,2,15), #Desfase Tollano requiere Transporte nivel 15
(11,3,15), #Desfase Tollano requiere Reactor nivel 15

(9,3,16), #Nucleo Asgard requiere Reactor a nivel 16
(9,6,17), #Nucleo Asgard requiere Armas de las naves a nivel 17
(9,7,17), #Nucleo Asgard requiere Escudos de las naves a nivel 17
(9,8,17), #Nucleo Asgard requiere Hiperpropulsion a nivel 17
(9,9,17), #Nucleo Asgard requiere Casco de las naves a nivel 17

(13,1,18), #Manto de Arturo requiere Refuerzos a nivel 18
(13,3,17), #Manto de Arturo requiere Reactor a nivel 17

(14,83, 16), #MPC requiere Logistica nivel 16
(14, 3,19), #MPC requiere Reactor nivel 19

(10,1,20), #Sillon de los Antiguos requiere Refuerzos a nivel 20
(10,3,20), #Sillon de los Antiguos requiere Reactor a nivel 20
(10,10,18), #Sillon de los Antiguos requiere Cabeza de Naquadah a nivel 18
(10,11,18), #Sillon de los Antiguos requiere Aleación Defensas a nivel 18

########################################################
# Goauld................................................
########################################################

(15,12,5), #Conquista planetaria requiere Minas a nivel 6
(15,13,5), #Conquista planetaria requiere Esclavitud a nivel 6

(17,12,7), #Sarcofago requiere Minas a nivel 7
(17,15,8), #Sarcofago requiere Armas Jaffa a nivel 8
(17,16,8), #Sarcofago requiere Armadura Jaffa a nivel 8
(17,17,8), #Sarcofago requiere Escudo Personal a nivel 8

(18,12,8),  #Implantacion requiere Minas a nivel 8
(18,15,10), #Implantacion requiere Armas Jaffa a nivel 10
(18,16,10), #Implantacion requiere Armadura Jaffa a nivel 10
(18,17,10), #Implantacion requiere Escudo Personal a nivel 10

(19,12,10), #SemiAscendido requiere Minas a nivel 10
(19,15,12), #SemiAscendido requiere Armas Jaffa a nivel 12
(19,16,12), #SemiAscendido requiere Armadura Jaffa a nivel 12
(19,17,12), #SemiAscendido requiere Escudo personal a nivel 12

(20,12,14), #Conocimiento Antiguo requiere Minas a nivel 14
(20,13,13), #Conocimiento Antiguo requiere Esclavitud a nivel 13
(20,14,12), #Conocimiento Antiguo requiere Reactor a nivel 12

(23,14,16), #El Ojo de Ra requiere Reactor a nivel 16
(23,18,17), #El Ojo de Ra requiere Armas de las naves a nivel 17
(23,19,17), #El Ojo de Ra requiere Escudos de las naves a nivel 17
(23,20,17), #El Ojo de Ra requiere Hiperpropulsion a nivel 17
(23,21,17), #El Ojo de Ra requiere Casco de las naves a nivel 17

(26,14,18), #MPC requiere Reactor nivel 19
(26,84,13), #MPC requiere Logistica nivel 13

(24,14,19), #Supernave requiere Reactor a nivel 19
(24,18,20), #Supernave requiere Armas de las naves a nivel 20
(24,19,20), #Supernave requiere Escudos de las naves a nivel 20
(24,20,20), #Supernave requiere Hiperpropulsion a nivel 20
(24,21,20), #Supernave requiere Casco de las naves a nivel 20

########################################################
# Asgard................................................
########################################################

(27,24,5), #Investigacion Genetica requiere Clonacion a nivel 6
(27,25,5), #Investigacion Genetica requiere Teletransporte a nivel 6

(29,24,8), #Ragnarok requiere Clonacion a nivel 8
(29,27,7), #Ragnarok requiere Armas de las naves a nivel 7
(29,28,7), #Ragnarok requiere Escudos de las naves a nivel 7
(29,29,7), #Ragnarok requiere Hiperpropulsion a nivel 7
(29,30,7), #Ragnarok requiere Casco a nivel 7

(30,24,10), #La Otra Extirpe requiere Clonacion al 10
(30,92,10), #La Otra Extirpe requiere Armas Tropas
(30,93,10), #La Otra Extirpe requiere Armadura tropas
(30,94,10), #La Otra Extirpe requiere Escudos Tropas
(30,26,10), #La Otra Extirpe requiere Reactor

(31,24,10), #Camuflaje Nox requiere Clonacion al 11
(31,25,10), #Camuflaje Nox requiere Teletransporte al 12
(31,26,10), #Camuflaje Nox requiere Reactor al 12

(32,24,14), #Dilatador Temporal requiere Clonacion a nivel 14
(32,25,14), #Dilatador Temporal requiere Teletransporte a nivel 14
(32,26,14), #Dilatador Temporal requiere Reactor a nivel 14

(35,26,16), #Nucleo Asgard requiere Reactor a nivel 16
(35,27,17), #Nucleo Asgard requiere Armas de las naves a nivel 17
(35,28,17), #Nucleo Asgard requiere Escudos de las naves a nivel 17
(35,29,17), #Nucleo Asgard requiere Hiperpropulsion a nivel 17
(35,30,17), #Nucleo Asgard requiere Casco de las naves a nivel 17

(36,26,19), #Palacio requiere Reactor a nivel 16
(36,27,20), #Palacio requiere Armas de las naves a nivel 17
(36,28,20), #Palacio requiere Escudos de las naves a nivel 17
(36,29,20), #Palacio requiere Hiperpropulsion a nivel 17
(36,30,20), #Palacio requiere Casco de las naves a nivel 17

########################################################
# Jaffa.................................................
########################################################
(37,33,5), #Refuerzos del Consejo Jaffa requiere Rebelion a nivel 5
(37,34,5), #Refuerzos del Consejo Jaffa requiere Transporte a nivel 5

(39,33,7), #Kelnoreem requiere Rebelion a nivel 7
(39,36,8), #Kelnoreem requiere Armas de Energia a nivel 8
(39,37,8), #Kelnoreem requiere Armadura Jaffa a nivel 8

(40,33,9), #��Rebelion!! requiere Rebelion a nivel 9
(40,36,10), #��Rebelion!! requiere Armas de Energia a nivel 10
(40,37,10), #��Rebelion!! requiere Armadura Jaffa a nivel 10

(41,33,11), #Ascendido requiere Rebelion a nivel 11
(41,36,12), #Ascendido requiere Armas de Fuego a nivel 12
(41,37,12), #Ascendido requiere Armadura Jaffa a nivel 12

(42,33,14), #Biblioteca requiere Rebelion a nivel 14
(42,34,14), #Biblioteca requiere Transporte a nivel 14
(42,35,14), #Biblioteca requiere Reactor a nivel 14

(45,35,16), #El Ojo de Ra requiere Reactor a nivel 16
(45,38,17), #El Ojo de Ra requiere Armas de las naves a nivel 17
(45,39,17), #El Ojo de Ra requiere Escudos de las naves a nivel 17
(45,40,17), #El Ojo de Ra requiere Hiperpropulsion a nivel 17
(45,41,17), #El Ojo de Ra requiere Casco de las naves a nivel 17

(46,33,20), #Dakara requiere Rebelion a nivel 20
(46,35,20), #Dakara requiere Reactor a nivel 20
(46,42,18), #Dakara requiere Ataque de las defensas a nivel 18
(46,43,18), #Dakara requiere Integridad de las defensas a nivel 18

########################################################
# Atlantis..............................................
########################################################
(48,44,5), #Refuerzos del IOA requiere Refuerzos a nivel 5
(48,45,5), #Refuerzos del IOA requiere Transporte a nivel 5

(50,44,9),  #Pueblos Pegasus requiere Refuerzos a nivel 9
(50,47,10), #Pueblos Pegasus requiere Armas de fuego a nivel 10
(50,48,10), #Pueblos Pegasus requiere Polimero de ceramica a nivel 10
(50,49,9),  #Pueblos Pegasus requiere Escudo Personal Antiguo a nivel 9

(51,44,9), #Retrovirus requiere Refuerzos a nivel 9
(51,47,10), #Retrovirus requiere Armas a nivel 10
(51,48,10), #Retrovirus requiere Polimero a nivel 10
(51,49,9),  #Retrovirus requiere Escudo Personal Antiguo a nivel 9

(52,44,11), #Ascendido requiere Refuerzos a nivel 11
(52,47,12), #Ascendido requiere Armas de Fuego a nivel 12
(52,48,12), #Ascendido requiere Polimero de Ceramica a nivel 12
(52,49,10), #Ascendido requiere Escudo Personal Antiguo a nivel 10

(53,44,14), #Deposito del Conocimiento Antiguo requiere Refuerzos a nivel 14
(53,45,14), #Deposito del Conocimiento Antiguo requiere Transporte a nivel 10
(53,46,14), #Deposito del Conocimiento Antiguo requiere MPC a nivel 13

(56,46,16), #Nucleo Asgard requiere Reactor a nivel 16
(56,50,17), #Nucleo Asgard requiere Armas de las naves a nivel 17
(56,51,17), #Nucleo Asgard requiere Escudos de las naves a nivel 17
(56,52,17), #Nucleo Asgard requiere Hiperpropulsion a nivel 17
(56,53,17), #Nucleo Asgard requiere Casco de las naves a nivel 17

(57,44,19), #Ciudad Nave de Atlantis requiere Refuerzos a nivel 19
(57,50,20), #Ciudad Nave de Atlantis requiere Armas de las naves a nivel 20
(57,51,20), #Ciudad Nave de Atlantis requiere Escudos de las naves a nivel 20
(57,52,20), #Ciudad Nave de Atlantis requiere Hiperpropulsión a nivel 20
(57,53,20), #Ciudad Nave de Atlantis requiere Casco a nivel 20

(58,46,19), #MPC requiere Logistica nivel 13
(58,87,13), #MPC requiere Reactor nivel 19

(59,44,15), #Arcturus requiere Refuerzos nivel 14
(59,54,15), #Arcturus requiere Armas defensas nivel 14
(59,55,15), #Arcturus requiere Escudo defensas nivel 14

########################################################
# Wraith................................................
########################################################

(60,56,5), #Clonadora requiere Minas a nivel 5
(60,57,5), #Clonadora requiere Teletransporte a nivel 5

(62,56,7),  #Succionadores de almas requiere Minas a nivel 7
(62,59,8),  #Succionadores de almas requiere Paralizaores a nivel 8
(62,60,8),  #Succionadores de almas requiere Alimentacion a nivel 8

(63,56,9), #Legado Iratus requiere Minas a nivel 9
(63,59,10), #Legado Iratus requiere Paralizadores a nivel 10
(63,60,10), #Legado Iratus requiere Alimentacion a nivel 10

(68,56,15), #Despertar requiere Minas a nivel 15
(68,58,14), #Despertar requiere Reactor a nivel 14
(68,61,15), #Despertar requiere Armas de las naves a nivel 15
(68,63,15), #Despertar requiere Hiperpropulsión a nivel 15
(68,64,12), #Despertar requiere Casco a nivel 12

(65,56,11), #Bestia requiere Minas a nivel 11
(65,59,12), #Bestia requiere Armas a nivel 12
(65,60,12), #Bestia requiere Alimentacion a nivel 12

(66,56,14), #Informacion Lantiana requiere Refuerzos a nivel 14
(66,57,14), #Informacion Lantiana requiere Transporte a nivel 10
(66,58,14), #Informacion Lantiana requiere Reactor a nivel 13

(69,58,16), #Crec. Biologico requiere Reactor a nivel 16
(69,61,17), #Crec. Biologico requiere Armas de las naves a nivel 17
(69,63,17), #Crec. Biologico requiere Hiperpropulsion a nivel 17
(69,64,17), #Crec. Biologico requiere Casco de las naves a nivel 17

(71,59,16), #Semilla requiere Armas a nivel 16
(71,60,16), #Semilla requiere Alimentacion a nivel 16
(71,58,16), #Semilla requiere Reactor a nivel 16
(71,61,16), #Semilla requiere Armas de las naves a nivel 16
(71,63,16), #Semilla requiere Hiperpropulsion a nivel 16
(71,64,16), #Semilla requiere Casco a nivel 16

(70,58,19), #SuperColmena requiere Reactor a nivel 19
(70,61,20), #SuperColmena requiere Armas de las naves a nivel 20
(70,63,20), #SuperColmena requiere Hiperpropulsion a nivel 20
(70,64,20), #SuperColmena requiere Casco a nivel 20

(72,88,13), #Hackeo requiere Logistica nivel 13
(72,58,13), #Hackeo requiere Reactor nivel 13

########################################################
# Ori...................................................
########################################################

(73,72,5), #Origen requiere Conversión a nivel 6
(73,73,5), #Origen requiere Minas de Naquadah a nivel 6

(75,74,7), #Cruzada requiere Minas de Naquadah a nivel 7
(75,75,8), #Cruzada requiere Armas de Energia a nivel 8
(75,76,8), #Cruzada requiere Armadura a nivel 8
(75,77,8), #Cruzada requiere Escudo Personal a nivel 8

(76,74,9),  #Poder de Celestis requiere Minas a nivel 9
(76,75,10), #Poder de Celestis requiere Armas a nivel 10
(76,76,10), #Poder de Celestis requiere Armadura a nivel 10
(76,77,9),  #Poder de Celestis requiere Escudo Personal a nivel 9

(77,74,11), #Ascendido requiere Minas a nivel 11
(77,75,12), #Ascendido requiere Armas de Fuego a nivel 12
(77,76,12), #Ascendido requiere Armadura a nivel 12
(77,77,10), #Ascendido requiere Escudo Personal a nivel 10

(78,72,14), #Alabados sean los Ori!!! requiere Refuerzos a nivel 14
(78,73,14), #Alabados sean los Ori!!! requiere Transporte a nivel 10
(78,74,14), #Alabados sean los Ori!!! requiere Reactor a nivel 13

(80,74,16), #Biblioteca Celestis requiere Reactor a nivel 16
(80,78,17), #Biblioteca Celestis requiere Armas de las naves a nivel 17
(80,79,17), #Biblioteca Celestis requiere Escudos de las naves a nivel 17
(80,80,17), #Biblioteca Celestis requiere Hiperpropulsion a nivel 17
(80,81,17), #Biblioteca Celestis requiere Casco de las naves a nivel 17

(81,72,20), #Cupula planetaria requiere Conversion a nivel 20
(81,73,20), #Cupula planetaria requiere Reactor a nivel 20
(81,82,19), #Cupula planetaria requiere Defensas de energia a nivel 19

(84,90,5), #Exp. Interg. requiere Conexion psíquica nivel 5
(84,72,6), #Exp. Interg. requiere Conversión nivel 6

########################################################
# Replicantes...........................................
########################################################

(85,66,5), #Actualizacion requiere Replicacion a nivel 5
(85,67,5), #Actualizacion requiere Reactor Replicante a nivel 5

(87,66,7), #Aleacion requiere Replicacion a nivel 7
(87,67,8), #Aleacion requiere Reactor Replicante a nivel 10
(87,68,8), #Aleacion requiere Acido a nivel 8

(88,66,9), #Asimilacion requiere Replicacion a nivel 7
(88,67,10), #Asimilacion requiere Reactor Replicante a nivel 10
(88,68,10), #Asimilacion requiere Acido a nivel 8

(89,66,12), #Godzilla requiere Replicacion a nivel 12
(89,67,12), #Godzilla requiere Reactor Replicante a nivel 12
(89,68,12), #Godzilla requiere Acido a nivel 12

(90,66,14), #Dilatador Temporal requiere Replicacion a nivel 14
(90,67,14), #Dilatador Temporal requiere Reactor Replicante a nivel 14

(92,67,16), #Sobrecarga requiere Reactor a nivel 16
(92,70,17), #Sobrecarga requiere Armas de las naves a nivel 17
(92,66,17), #Sobrecarga requiere Escudos de las naves a nivel 17
(92,71,17), #Sobrecarga requiere Hiperpropulsion a nivel 17

(93,67,19), #Planetoide requiere Reactor a nivel 19
(93,70,20), #Planetoide requiere Armas de las naves a nivel 20
(93,66,20), #Planetoide requiere Escudos de las naves a nivel 20
(93,71,20), #Planetoide requiere Hiperpropulsion a nivel 20

(95,66,18), #Asimilacion requiere Replicacion de nivel 18
(95,68,18); #Asimilacion requiere Acido a nivel 18
