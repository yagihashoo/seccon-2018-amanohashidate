#!/usr/bin/env bash
busybox crond -b -L /dev/stderr
php-fpm
