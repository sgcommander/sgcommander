#!/bin/sh

echo "--------------------------"
echo "ACTUALIZANDO BASE DE DATOS"
echo "--------------------------"
#Instalando la base de datos
echo "1/7 Instalando las tablas de la Base de Datos"
cd /var/www/documentacion/bd/
mysql --default-character-set=utf8 -h sgcommander-db -u root -pp4ssw0rd < /var/www/documentacion/bd/instalar.sql

echo "2/7 Rellenando la base de datos con la informacion necesaria del sistema"
cd /var/www/documentacion/bd/generadorPlanetas/
php /var/www/documentacion/bd/generadorPlanetas/class.GeneradorGalaxia.php

#echo "3/7 Agregando los usuarios de la version de desarrollo"
#mysql --default-character-set=utf8 -h sgcommander-db -u root -pp4ssw0rd < /var/www/documentacion/bd/usuarios.sql

#echo "4/7 Enviando mensaje de bienvenida"
#php /var/www/documentacion/bd/generadorPlanetas/bienvenida.php

echo "5/7 Dopando a los jugadores"
php /var/www/documentacion/bd/generadorPlanetas/doping.php