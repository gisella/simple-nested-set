FROM php:8.2-apache

RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Assicura che www-data possa leggere i file
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
