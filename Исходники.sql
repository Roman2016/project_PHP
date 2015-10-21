-- database registration

create database if not exists USERS;

use USERS;

-- table datareg

ALTER TABLE datareg MODIFY number INT NOT NULL;

desc datareg;

ALTER TABLE datareg MODIFY number INT NOT NULL, MODIFY login varchar(20) NOT NULL,MODIFY postaddress varchar(25) NOT NULL;


create table datareg 
	( id int not null primary key auto_increment,
	login varchar(15) not null,
	password varchar(15) not null,
	name varchar(15) not null,
	country varchar(15) not null,
	email varchar(20) not null
	);
	

	create table datareg 
	( id int not null primary key auto_increment,
	login varchar(15) not null UNIQUE,
	password varchar(128) not null,
	name varchar(15) not null,
	country varchar(15) not null,
	email varchar(30) not null UNIQUE,
	solt varchar(128)
	);	
	
	
INSERT INTO datareg (login, password, name, country, email) 
VALUES ('3','3','3','3','3');


create table words 
	( id int not null primary key auto_increment,
	word varchar(15) not null UNIQUE
	);
	
INSERT INTO words (word) 
VALUES ('room'),
		('desk'),
		('account'),
		('registration'),
		('beautiful');
		

create table letters 
	( id int not null primary key,
	letter varchar(3) not null UNIQUE
	);
