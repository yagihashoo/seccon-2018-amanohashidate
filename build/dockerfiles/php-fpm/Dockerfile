FROM php:7.2.10-fpm-alpine

RUN docker-php-ext-install opcache pdo_mysql mysqli mbstring fileinfo pcntl

COPY conf/php.ini /etc/php/php.ini
