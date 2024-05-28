FROM php:8.0-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    libpq-dev

# Install PHP extensions


RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
#RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install pdo pdo_pgsql

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

ENV COMPOSER_ALLOW_SUPERUSER=1

# Set working directory
WORKDIR /var/www/html

# Copy php.ini
COPY docker/php/php.ini /usr/local/etc/php/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
