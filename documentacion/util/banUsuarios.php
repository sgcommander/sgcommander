#!/usr/bin/php
<?php
        //Usuarios a banear
        $users = Array();

        define('DB_HOST', 'localhost');
        define('DB_USER', 'sg1');
        define('DB_PASS', 'w38j9rc34hcrn46cnqw4jrdh43drjkh3cj');
        define('DB_NAME', 'sg1');

        //Conexion a la base de datos
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        /* BANEAMOS LOS USUARIOS */
        $sql = '
UPDATE
        jugador
SET
        bloqueado = DATE_ADD( NOW( ), INTERVAL 4 YEAR )
WHERE
        idUsuario IN ( '. implode( ',', $users ) .' )';

        $db->query( $sql );

        /* ELIMINAMOS SUS SESIONES PARA QUE NO SIGAN JUGADNO */
        $sql ='
SELECT sessId FROM

usuario

WHERE id IN ( '. implode( ',', $users ) .' );
';
        $consulta = $db->query($sql);

        while( $row = $consulta->fetch_row() )
        {
                $file = '/var/lib/php5/sess_' . $row[0];
                @unlink( $file );
        }
?>