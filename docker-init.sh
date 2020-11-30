#!/bin/sh

RESULT=`mysql --default-character-set=utf8 -h $DB_HOST -u $DB_USERROOT -p$DB_PASSWORDROOT --skip-column-names -e "SELECT COUNT(*) FROM information_schema.TABLES WHERE table_schema='$DB_DATABASE' AND table_name='fuegoSoldadoSoldado';"`

# Initial config
if [ $RESULT = 1 ]
then
    echo "Ya se realizó la configuración inicial"
else
    echo "Initializing container"

    echo "Permissions"
    /var/www/scripts/Permissions.sh

    echo "Database"
    /var/www/scripts/ReconstruirBD.sh
fi

# Daemon
php /var/www/app/eventosDaemon.php

exec "$@"