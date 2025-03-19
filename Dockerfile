FROM php:8.2-fpm

# Install system dependencies, nginx, and supervisor
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    netcat-openbsd \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip mbstring exif pcntl bcmath xml

# Copy your custom Nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy Supervisor configuration (we’ll create this next)
COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 80 (Render expects your container to listen on this port)
EXPOSE 80

# Copy entrypoint script and make it executable
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set the entrypoint
ENTRYPOINT ["/entrypoint.sh"]
