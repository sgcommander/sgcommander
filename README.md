# Stargate: Galactic Commander

Este proyecto contiene todo lo necesario para correr una instancia de un universo del juego.

![Screenshot](documentacion/screenshot01.png?raw=true "Stargate: Galactic Commander Tau'ri Home")

![Screenshot](documentacion/screenshot02.png?raw=true "Stargate: Galactic Commander Goauld Home")

## Comenzando 🚀

Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

### Pre-requisitos 📋

Necesitarás instalar [Docker](https://www.docker.com/) y Docker Compose para arrancar el proyecto.

### Instalación 🔧

Copia y renombra el fichero de configuración de Docker para crear tu fichero de configuración para el proyecto:

```
cp .env.docker .env
```

Este fichero contiene las configuraciones para arrancar el proyecto en Docker, deberás modificarlas para desplegar el proyecto en otro servidor.

### Ejecución ⚙️

Para ejecutar el proyecto con Docker Compose situate en el directorio raiz del proyecto y ejecuta:

```
docker-compose -f docker-compose.yml up
```

Después debes ejecutar una instancia de la [página principal del juego](https://github.com/sgcommander/homepage) para realizar el registros de cuentas y el login.

Una vez ejecutados ambos proyectos abre en tu navegador [http://localhost:8888](http://localhost:8888).

## Construido con 🛠️

* [HTML_TEMPLATE_SIGMA](https://pear.php.net/package/HTML_Template_Sigma)
* [MooTools](https://github.com/mootools)
* [Milkbox](https://github.com/GerHobbelt/milkbox)
* [system_daemon](https://github.com/kvz/system_daemon)

## Autores ✒️

* **David** - [damarte](https://github.com/damarte)
* **Rodrigo** - [rodrimtz](https://github.com/rodrimtz)
* **Iván** - [ivoroz](https://github.com/ivoroz)
* **Jose Manuel** - Loki

## Agradecimientos 🎁

* **Matías** - Por moderar el foro con mano de hierro
* **Javi** - Por las horas y horas de pruebas
* **KingCerdo** - Por mantener el terror en el juego

## Licencia 📄

Este proyecto está bajo la Licencia GNU General Public License - mira el archivo [LICENSE.md](LICENSE.md) para detalles