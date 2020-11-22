#!/bin/sh

#Obtenemos el directorio
SCRIPTPATH="${BASH_SOURCE[0]}"
ACTUALPATH="$(pwd)"
PATH="$(dirname $ACTUALPATH/$SCRIPTPATH)"


echo "--------------------------"
echo "Limpiando Cache"
echo "--------------------------"
/bin/rm $PATH/../templates/default/cache/*
echo 'Limpieza terminada'
