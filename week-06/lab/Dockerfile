FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    vim \
 && docker-php-ext-install zip pdo pdo_mysql \
 && pecl install xdebug && docker-php-ext-enable xdebug \
 && a2enmod headers ssl rewrite \
 && apt-get clean && rm -rf /var/lib/apt/lists/* \
 && mkdir -p /etc/apache2/ssl

# Configure Xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy your application code into the container
COPY . /var/www/html

# Expose port 80
EXPOSE 80