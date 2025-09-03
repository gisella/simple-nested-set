FROM php:8.2-apache

ARG XDEBUG_VERSION="xdebug-3"

RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
#RUN echo "ServerName php-apache" | tee /etc/apache2/conf-available/servername.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./deploy/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Assicura che www-data possa leggere i file
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#RUN mv composer.phar /usr/local/bin/composer
