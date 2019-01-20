create user 'uwarebot'@'localhost' identified by '<sua senha>';
create database uwarebot;
use uwarebot;
ALTER DATABASE `uwarebot` CHARSET = UTF8 COLLATE = utf8_general_ci;

create table logs(
	id int auto_increment not null,
	data datetime not null,
	user_id int not null,
	name varchar(100) not null,
	action varchar(200) not null,
	primary key(id)
);

grant insert,select on uwarebot.logs to 'uwarebot'@'localhost';

create table posts(
	id int auto_increment not null,
	data datetime not null,
	url varchar(300) not null,
	post varchar(500) not null,
	owner varchar(100) not null,
	primary key(id)
);

grant all privileges on uwarebot.posts to 'uwarebot'@'localhost';

create table hits(
	id int auto_increment not null,
	data datetime not null,
	ip varchar(50) not null,
	primary key(id)
);

grant insert,select on uwarebot.hits to 'uwarebot'@'localhost';