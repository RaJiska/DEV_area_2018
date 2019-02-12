FROM alpine:3.8

EXPOSE 80

# Nginx Installation
RUN \
	apk update && \
	apk upgrade && \
	apk add php7-fpm php7-mcrypt php7-soap php7-openssl php7-gmp \
		php7-json php7-pdo php7-zip php7-mysqli php7-gd php7-pdo_mysql \
		php7-gettext php7-xmlreader php7-xmlrpc php7-bz2 php7-iconv \
		php7-curl php7-session composer nginx mariadb mariadb-client && \
	adduser -D -g 'www' www && \
	rm /etc/nginx/conf.d/default.conf && \
	mkdir -p /run/nginx && \
	mkdir -p /var/www && \
	rm -rf /var/www/*
ADD nginx/default.conf /etc/nginx/conf.d

ADD database.sql /tmp/database.sql
RUN \
	mkdir -p /run/mysqld && \
	chown mysql /run/mysqld && \
	mysql_install_db --user=mysql --datadir=/var/lib/mysql && \
	mysqld --user=mysql >/dev/null 2>&1& sleep 10 && \
	mysql -u root < /tmp/database.sql

ADD composer.json /tmp/composer.json
ADD entrypoint.sh /tmp/entrypoint.sh
RUN chmod 700 /tmp/entrypoint.sh
ENTRYPOINT ["/tmp/entrypoint.sh"]