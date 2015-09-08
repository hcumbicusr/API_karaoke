create database if not exists bd_karaoke;
use bd_karaoke;

SET FOREIGN_KEY_CHECKS=0;




CREATE TABLE music_business
(
	id_music INT NOT NULL AUTO_INCREMENT,
	id_musicgenre INT NOT NULL,
	id_typemusic INT NOT NULL,
	name VARCHAR(250) NOT NULL,
	artist VARCHAR(200),
	album VARCHAR(200),
	description TEXT,
	year_album CHAR(4),
	likes INT NOT NULL,
	date_register TIMESTAMP NOT NULL,
	stat INT NOT NULL,
	PRIMARY KEY (id_music)
) 
;


CREATE TABLE music_genre
(
	id_musicgenre INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	PRIMARY KEY (id_musicgenre)
) 
;


CREATE TABLE orders
(
	id_order INT NOT NULL AUTO_INCREMENT,
	id_table INT NOT NULL,
	id_music INT NOT NULL,
	date_order TIMESTAMP NOT NULL,
	date_attetion TIMESTAMP NOT NULL,
	stat INT NOT NULL,
	PRIMARY KEY (id_order)
) 
;


CREATE TABLE suggested_music
(
	artist_group VARCHAR(250) NOT NULL,
	name VARCHAR(250) NOT NULL,
	date_register TIMESTAMP(0) NOT NULL,
	stat INT NOT NULL
) 
;


CREATE TABLE table_business
(
	id_table INT NOT NULL AUTO_INCREMENT,
	number VARCHAR(8) NOT NULL,
	date_register TIMESTAMP NOT NULL,
	stat INT NOT NULL,
	PRIMARY KEY (id_table)
) 
;


CREATE TABLE type_music
(
	id_typemusic INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	PRIMARY KEY (id_typemusic)
) 
;



SET FOREIGN_KEY_CHECKS=1;
