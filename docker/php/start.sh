#!/bin/sh

# Start processes
echo "Starting services..."
php -d display_errors=1 -d error_reporting=E_ALL artisan serve --host 0.0.0.0 --no-ansi -vvv &
#php /usr/local/bin/watch.php &

# Wait for any child to exit or signal
trap  "exit" SIGTERM SIGINT SIGQUIT TERM; while true; do sleep 1; done
