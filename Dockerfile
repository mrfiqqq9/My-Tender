FROM php:8.3-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Set document root to CakePHP webroot
ENV APACHE_DOCUMENT_ROOT /var/www/html/webroot

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
