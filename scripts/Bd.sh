#!/bin/sh

#Obtenemos el directorio
SCRIPTPATH="${BASH_SOURCE[0]}"
ACTUALPATH="$(pwd)"
PATH="$(dirname $ACTUALPATH/$SCRIPTPATH)"

if [ $1 ]
then
	echo "--------------------------"
	echo "Reconstruyendo base de datos"
	echo "--------------------------"
	#Instalando la base de datos
	echo "1/7 Instalando las tablas de la Base de Datos"
	cd $PATH/../documentacion/bd/
	/usr/bin/mysql -h sgcommander-db -u root -pp4ssw0rd < $PATH/../documentacion/bd/instalar.sql
	
	echo "2/7 Rellenando la base de datos con la informacion necesaria del sistema"
	cd $PATH/../documentacion/bd/generadorPlanetas/
	/usr/bin/php $PATH/../documentacion/bd/generadorPlanetas/class.GeneradorGalaxia.php
	
	#echo "3/7 Agregando los usuarios de la version de desarrollo"
	#/usr/bin/mysql -h sgcommander-db -u root -pp4ssw0rd < $PATH/documentacion/bd/usuarios.sql
	
	#echo "4/7 Enviando mensaje de bienvenida"
	#/usr/bin/php /var/www-data/$version/public_html/documentacion/bd/generadorPlanetas/bienvenida.php
	
	#echo "5/7 Dopando a los jugadores"
	#/usr/bin/php $PATH/documentacion/bd/generadorPlanetas/doping.php

	echo "Terminado"
	
else
 	echo "Debe especificar un entorno (Ejemplo: dev, sg1)"
fi
