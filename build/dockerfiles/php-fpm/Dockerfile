FROM php:7.3.0-fpm

RUN docker-php-ext-install opcache pdo_mysql mysqli mbstring fileinfo pcntl
RUN nohup php artisan queue:work --queue=verify,default --tries 2 &

COPY conf/php.ini /etc/php/php.ini
