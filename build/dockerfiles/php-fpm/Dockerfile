FROM php:7.4.20-fpm

RUN apt-get update
RUN apt-get install -y busybox-static
RUN docker-php-ext-install opcache pdo_mysql mysqli mbstring fileinfo pcntl

COPY conf/php.ini /etc/php/php.ini
COPY laravel-schedule /var/spool/cron/crontabs/root

COPY init.sh /init.sh
RUN chmod +x /init.sh

CMD ["/init.sh"]
