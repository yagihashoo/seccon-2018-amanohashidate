FROM php:7.2.1-fpm-alpine

RUN docker-php-ext-install opcache pdo_mysql mysqli mbstring fileinfo

COPY conf/php.ini /etc/php/php.ini
