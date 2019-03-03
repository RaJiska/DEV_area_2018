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
	token_secret VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY(id)
);

CREATE TABLE triggers (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(8) UNSIGNED NOT NULL,
	action_service_id INT(8) UNSIGNED NOT NULL,
	reaction_service_id INT(8) UNSIGNED NOT NULL,
	action VARCHAR(255) NOT NULL,
	reaction VARCHAR(255) NOT NULL,
	action_params TEXT NOT NULL,
	reaction_params TEXT NOT NULL,
	enabled TINYINT(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(id)
);

INSERT INTO users (login, pass, token, enabled) VALUES ('Foo', 'a', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1);
INSERT INTO users (login, pass, token, enabled) VALUES ('Bar', 'b', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 1);
INSERT INTO services (name) VALUES ('facebook');
INSERT INTO services (name) VALUES ('imgur');
INSERT INTO services (name) VALUES ('yammer');
INSERT INTO services (name) VALUES ('twitter');
INSERT INTO services (name) VALUES ('github');
INSERT INTO tokens (user_id, service_id, token, token_secret) VALUES (1, 4, "1094546485037944832-FtWJ3t2gdaggCxR1pTC3C421Q9hNT6", "");
INSERT INTO tokens (user_id, service_id, token) VALUES (1, 2, "bbbb");
INSERT INTO tokens (user_id, service_id, token) VALUES (1, 3, "cccc");
INSERT INTO tokens (user_id, service_id, token) VALUES (2, 1, "dddd");
INSERT INTO tokens (user_id, service_id, token) VALUES (2, 2, "eeee");