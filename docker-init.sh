#!/bin/sh

# Initial config
if [ ! -f /var/.initialized ]; then
    echo "Initializing container"

    echo "Permissions"
    /var/www/scripts/Permissions.sh

    echo "Database"
    /var/www/scripts/ReconstruirBD.sh

    touch /var/.initialized
fi

# Daemons
php /var/www/app/eventosServer.php

exec "$@"