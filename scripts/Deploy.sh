#!/bin/bash

SCRIPTPATH="${BASH_SOURCE[0]}"
ACTUALPATH="$(pwd)"
PATH="$(dirname $ACTUALPATH/$SCRIPTPATH)"

if [ $1 ]
then
	echo "--------------------------"
	echo "Subiendo a producción"
	echo "--------------------------"
	/usr/bin/rsync --progress -artzC --force --delete --exclude-from=$PATH/rsync_exclude.txt -e "/usr/bin/ssh -p 22" $PATH/* root@0.0.0.0:/home/www/$1
	echo "Subida terminada"
	
else
 	echo "Debe especificar un entorno (Ejemplo: dev, sg1)"
fi


