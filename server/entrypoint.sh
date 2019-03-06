#! /bin/sh
php-fpm7
mysqld --user=mysql >/dev/null 2>&1&
composer require abraham/twitteroauth -d /var/www/html
/tmp/triggerCheck.sh&
echo "Starting Nginx"
nginx -g 'daemon off;'