#!/bin/sh
set -e

# Fix permissions for the storage and cache directories
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Run migrations (if desired)
php artisan migrate --force

# Clear caches
php artisan config:clear
php artisan cache:clear

# Start PHP-FPM
exec php-fpm
