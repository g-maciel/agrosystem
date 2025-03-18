#!/bin/bash

# Fix permissions for storage and bootstrap/cache directories
chown -R appuser:appuser /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM
php-fpm