#!/bin/sh
set -e

# Start the background keep-alive service (runs every 8 minutes)
if [ -f /var/www/html/services/keep_alive.php ]; then
    php /var/www/html/services/keep_alive.php &
fi

# Execute the default Apache command
exec apache2-foreground

