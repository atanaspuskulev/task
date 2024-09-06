FROM php:8.3-fpm

# Install necessary packages
RUN apt-get update && apt-get install -y \
    gosu \
    git \
    unzip \
    libmariadb-dev \
    && docker-php-ext-install pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

USER root
# Copy and set permissions for the start-env.sh script

RUN chmod -R 777 /var/www/html


CMD ["php-fpm"]
