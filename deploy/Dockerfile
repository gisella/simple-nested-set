FROM php:8.2-apache

RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY deploy/xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

# Assicura che www-data possa leggere i file
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# composer requirements
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y unzip p7zip-full
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
