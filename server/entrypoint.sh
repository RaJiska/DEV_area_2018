#! /bin/sh
php-fpm7
mysqld --user=mysql >/dev/null 2>&1&
nginx -g 'daemon off;'