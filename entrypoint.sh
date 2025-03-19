#!/bin/bash

# echo "Waiting for database connection..."
# until nc -z -v -w30 $DB_HOST $DB_PORT; do
#     echo "Waiting for database connection..."
#     sleep 2
# done

# echo "Database is ready!"

php artisan migrate --force

php artisan serve --host=0.0.0.0 --port=8000