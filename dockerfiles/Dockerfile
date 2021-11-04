FROM php:7.4.3-apache
RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
#RUN echo "ServerName php-apache" | tee /etc/apache2/conf-available/servername.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

##RUN docker-php-ext-enable pdo pdo_mysql

#RUN mv composer.phar /usr/local/bin/composer

# RUN pecl install redis-5.1.1 \
#     && pecl install xdebug-2.8.1 \
#     && docker-php-ext-enable redis xdebug