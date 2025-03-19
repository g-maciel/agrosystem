#!/bin/sh
set -e

# Fix permissions for storage and cache directories
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Run migrations on container startup
php artisan migrate --force

# (Optional) Clear caches if needed
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Start Supervisor to run both php-fpm and nginx
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisor.conf
