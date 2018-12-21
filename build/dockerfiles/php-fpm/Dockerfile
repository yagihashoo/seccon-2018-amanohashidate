FROM php:7.3.0-fpm

RUN docker-php-ext-install opcache pdo_mysql mysqli mbstring fileinfo pcntl

COPY conf/php.ini /etc/php/php.ini

CMD php artisan queue:work --queue=verify,default --tries 2
