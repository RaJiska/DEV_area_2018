CREATE DATABASE area;
GRANT ALL PRIVILEGES ON area.* TO 'area'@'localhost' IDENTIFIED BY 'hello';

USE area;
CREATE TABLE users (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	login VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	token CHAR(32) NOT NULL DEFAULT '',
	enabled TINYINT(1) NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(login)
);

CREATE TABLE services (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE tokens (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(8) UNSIGNED NOT NULL,
	service_id INT(8) UNSIGNED NOT NULL,
	token VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY(id)
);

INSERT INTO users (login, pass, token, enabled) VALUES ('Foo', 'a', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1);
INSERT INTO users (login, pass, token, enabled) VALUES ('Bar', 'b', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 1);
INSERT INTO services (name) VALUES ('Facebook');
INSERT INTO services (name) VALUES ('Imgur');
INSERT INTO services (name) VALUES ('Yammer');
INSERT INTO tokens (user_id, service_id, token) VALUES (1, 1, "aaaa");
INSERT INTO tokens (user_id, service_id, token) VALUES (1, 2, "bbbb");
INSERT INTO tokens (user_id, service_id, token) VALUES (1, 3, "cccc");
INSERT INTO tokens (user_id, service_id, token) VALUES (2, 1, "dddd");
INSERT INTO tokens (user_id, service_id, token) VALUES (2, 2, "eeee");