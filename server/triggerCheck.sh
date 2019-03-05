#! /bin/sh
cd /var/www/html
while true; do
	php7 scripts/checkTrigger.php
	sleep 15
done
