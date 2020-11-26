#!/bin/sh

echo "--------------------------"
echo " BASE DE DATOS"
echo "--------------------------"
#Instalando la base de datos
echo "- 1/4 Creando la Base de Datos ------------"
cd /var/www/documentacion/bd/

#Eliminamos y creamos la BBDD
if [ $DB_CREATE = true ]
then
    SQL="DROP SCHEMA IF EXISTS $DB_DATABASE;
    CREATE SCHEMA IF NOT EXISTS $DB_DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
    USE $DB_DATABASE;"

    mysql --default-character-set=utf8 -h $DB_HOST -u $DB_USERROOT -p$DB_PASSWORDROOT -e "$SQL"
else
    echo "La Base de Datos no se creará"
fi

echo "- 2/4 Rellenando la Base de Datos ---------"
mysql --default-character-set=utf8 -h $DB_HOST -u $DB_USERROOT -p$DB_PASSWORDROOT -D $DB_DATABASE < /var/www/documentacion/bd/instalar.sql

echo "- 3/4 Generando el universo ---------------"
cd /var/www/documentacion/bd/generadorPlanetas/
php /var/www/documentacion/bd/generadorPlanetas/class.GeneradorGalaxia.php

#echo "3/7 Agregando los usuarios de la version de desarrollo"
#mysql --default-character-set=utf8 -h $DB_HOST -u $DB_USERROOT -p$DB_PASSWORDROOT -D $DB_DATABASE < /var/www/documentacion/bd/usuarios.sql

#echo "4/7 Enviando mensaje de bienvenida"
#php /var/www/documentacion/bd/generadorPlanetas/bienvenida.php

echo "- 4/4 Dopando a los jugadores -------------"
if [ $DOPING = true ]
then
    php /var/www/documentacion/bd/generadorPlanetas/doping.php
else
    echo "El dopaje está desactivado"
fi