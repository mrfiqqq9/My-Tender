FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    git \
    unzip \
    zip \
    && docker-php-ext-install intl pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

EXPOSE 80
