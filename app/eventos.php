#!/usr/bin/php -q
<?php
/**
 * System_Daemon turns PHP-CLI scripts into daemons.
 *
 * PHP version 5
 *
 * @category  System
 * @package   System_Daemon
 * @author    Kevin <kevin@vanzonneveld.net>
 * @copyright 2008 Kevin van Zonneveld
 * @license   http://www.opensource.org/licenses/bsd-license.php
 * @link      http://github.com/kvz/system_daemon
 */
 
/**
 * System_Daemon Example Code
 *
 * If you run this code successfully, a daemon will be spawned
 * but unless have already generated the init.d script, you have
 * no real way of killing it yet.
 *
 * In this case wait 3 runs, which is the maximum for this example.
 *
 *
 * In panic situations, you can always kill you daemon by typing
 *
 * killall -9 eventos.php
 * OR:
 * killall -9 php
 *
 */

// Allowed arguments & their defaults
$runmode = array(
    'no-daemon' => false,
    'help' => false,
    'write-initd' => false,
);
 
// Scan command line attributes for allowed arguments
foreach ($argv as $k=>$arg) {
    if (substr($arg, 0, 2) == '--' && isset($runmode[substr($arg, 2)])) {
        $runmode[substr($arg, 2)] = true;
    }
}

// Help mode. Shows allowed argumentents and quit directly
if ($runmode['help'] == true) {
    echo 'Usage: '.$argv[0].' [runmode]' . "\n";
    echo 'Available runmodes:' . "\n";
    foreach ($runmode as $runmod=>$val) {
        echo ' --'.$runmod . "\n";
    }
    die();
}

// Make it possible to test in source directory
// This is for PEAR developers only
ini_set('include_path', ini_get('include_path').':..');

// Include Class
error_reporting(E_STRICT);
require_once 'libs/Daemon.php';

// Setup
$options = array(
    'appName' => 'eventos',
    'appDir' => dirname(__FILE__),
    'appDescription' => 'Resuelve eventos de Stargate: Galactic Commander',
    'authorName' => 'damarte',
    'authorEmail' => 'damarte86@gmail.com',
    'sysMaxExecutionTime' => '0',
    'sysMaxInputTime' => '0',
    'sysMemoryLimit' => '512M',
    'appRunAsGID' => 1000,
    'appRunAsUID' => 1000,
);
 
System_Daemon::setOptions($options);
 
// This program can also be run in the forground with runmode --no-daemon
if (!$runmode['no-daemon']) {
    // Spawn Daemon
    System_Daemon::start();
}
 
// With the runmode --write-initd, this program can automatically write a
// system startup file called: 'init.d'
// This will make sure your daemon will be started on reboot
if (!$runmode['write-initd']) {
    System_Daemon::info('not writing an init.d script this time');
} else {
    if (($initd_location = System_Daemon::writeAutoRun()) === false) {
        System_Daemon::notice('unable to write init.d script');
    } else {
        System_Daemon::info(
            'sucessfully written startup script: %s',
            $initd_location
        );
    }
}
 
// Run your code
// Here comes your own actual code
 
// This variable gives your own code the ability to breakdown the daemon:
$runningOkay = true;
 
// This variable keeps track of how many 'runs' or 'loops' your daemon has
// done so far. For example purposes, we're quitting on 3.
$cnt = 1;
 
// While checks on 3 things in this case:
// - That the Daemon Class hasn't reported it's dying
// - That your own code has been running Okay

/**
 * Clase base para la creacion de controladores
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../libs/ControllerBase.php');

/**
 * Clase base para la creacion de modelos
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../libs/ModelBase.php');

/**
 * Clase con variadas funciones para dar soporte.
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../libs/Funciones.php');

/**
 * Clase de configuracion
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../constants.php');
include(dirname(__FILE__).'/../libs/Config.php');
include(dirname(__FILE__).'/../config.php');


/**
 * Clase para conectar a la bd
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../libs/SPDO.php');

/**
 * Clase de templates
 * @author David & Jose
 * @since 27/01/2009
 */
include(dirname(__FILE__).'/../libs/HTML_Template_Sigma.php');

//Clases para resolver eventos
include(dirname(__FILE__).'/../libs/Firma.php');
include(dirname(__FILE__).'/../libs/Mision/UnidadMision.php');
include(dirname(__FILE__).'/../libs/Mision/JugadorMision.php');
include(dirname(__FILE__).'/../libs/Mision/BandoMision.php');
include(dirname(__FILE__).'/../libs/Mision/BatallaMision.php');
include(dirname(__FILE__).'/../libs/Mision/MisionModelLib.php');
include(dirname(__FILE__).'/../libs/Mision/MisionViewLib.php');
include(dirname(__FILE__).'/../libs/Mision/Mision.php');
include(dirname(__FILE__).'/../app/models/RecursosModel.php');
include(dirname(__FILE__).'/../app/models/UnidadModel.php');
include(dirname(__FILE__).'/../app/models/NaveModel.php');
include(dirname(__FILE__).'/../app/models/ResumirEventosModel.php');
include(dirname(__FILE__).'/../app/controllers/ResumirEventosController.php');

//Objeto para resolver eventos
System_Daemon::info('-- Creando demonio de SGCommander --');
$actualizacion = new ResumirEventosController();
System_Daemon::info('Escuchando eventos...');

while (!System_Daemon::isDying() && $runningOkay) {
    // What mode are we in?
    $mode = '"'.(System_Daemon::isInBackground() ? '' : 'non-' ).
        'daemon" mode';
 
    // Resolvemos el siguiente evento
    $runningOkay = $actualizacion->resolverEventoSiguiente();
 
    // Si falla paramos el demonio
    if (!$runningOkay) {
        System_Daemon::err('Error, '.
            'so this will be my last run');
    }
 
    // Relax the system by sleeping for a little bit
    // iterate also clears statcache
    System_Daemon::iterate(0.1);
 
    $cnt++;
}
 
// Shut down the daemon nicely
// This is ignored if the class is actually running in the foreground
System_Daemon::stop();