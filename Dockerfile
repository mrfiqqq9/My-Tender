FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql

# 🔥 FORCE CLEAN MPM
RUN a2dismod mpm_event || true \
    && a2dismod mpm_worker || true \
    && a2dismod mpm_prefork || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
