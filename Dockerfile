FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip mbstring exif pcntl bcmath xml


# Install Xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-scripts --no-interaction

# Create a user with the host's UID (default to 1000 if not specified)
ARG USER_ID=1000
RUN useradd -u ${USER_ID} -ms /bin/bash appuser

# Configure PHP-FPM to run as appuser
RUN sed -i 's/user = www-data/user = appuser/' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/group = www-data/group = appuser/' /usr/local/etc/php-fpm.d/www.conf

# Copy and set up the start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Use the start script as the command
CMD ["/start.sh"]