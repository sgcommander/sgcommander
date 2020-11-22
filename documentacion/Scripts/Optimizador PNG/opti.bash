#!/bin/bash

######NOTA:
#
#  En la misma carpeta que este bash se debe encontrar:
#    1.- Archivo pngout.exe (se debe tener wine instalado)
#    2.- Todos los archivos a optimizar
#
#  Ademas se requiere tener instalado el optipng, el cual
#  ubuntu proporciona através de el gestor de paquetes Synaptec
#
#################################################################

for i in $( ls *.png ); do
	optipng –o3 $i
	wine pngout.exe ./$i
	optipng –o7 $i
done

