FROM php:8.2-apache

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y zlib1g-dev libwebp-dev libpng-dev libzip-dev && \
    docker-php-ext-install gd zip pdo_mysql

RUN a2enmod rewrite && \
    a2enmod autoindex

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN echo "auto_prepend_file='/var/www/html/init.php'" >> /usr/local/etc/php/conf.d/auto_prepend.ini

RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www

EXPOSE 80