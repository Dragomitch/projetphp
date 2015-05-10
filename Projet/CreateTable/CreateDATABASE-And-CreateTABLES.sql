﻿CREATE DATABASE IF NOT EXISTS sitephp DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS sitephp.students(
	matricule			INTEGER		auto_increment	PRIMARY KEY,
	first_name			CHAR(15) 					NOT NULL,
	last_name			CHAR(15) 					NOT NULL,
	password			CHAR(40)					NULL,
	last_connection		DATETIME					NULL
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.teachers(
	login				VARCHAR(15) 	PRIMARY KEY,
	first_name			CHAR(15)	NOT NULL,
	last_name			CHAR(15)	NOT NULL,
	password			CHAR(40)	NULL
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.levels(
	level 				INTEGER			auto_increment PRIMARY KEY,
	num_level 			INTEGER			NOT NULL,
	label				VARCHAR(50)		NOT NULL
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.exercises(
	number				INTEGER			AUTO_INCREMENT PRIMARY KEY,
	theme				VARCHAR(60)		NULL,
	statement			VARCHAR(400)	NOT NULL,
	query				VARCHAR(100)	NOT NULL,
	nb_lines			VARCHAR(40)			NOT NULL,
	label				VARCHAR(35)		NOT NULL,
	last_modification	DATETIME		NULL,
	num_exercise		INTEGER			NOT NULL,
	author				VARCHAR(15)			NULL,
	num_level			INTEGER			NOT NULL,

	FOREIGN KEY fk_author(author)		REFERENCES teachers(login),
	FOREIGN KEY fk_num_level(num_level)	REFERENCES levels(level)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.students_answers(
	number				INTEGER			auto_increment PRIMARY KEY,
	answer_query		VARCHAR(1000)	NULL,
	exercise 			INTEGER			NOT NULL,
	student 			INTEGER			NOT NULL,

	FOREIGN KEY fk_exercise(exercise)	REFERENCES exercises(number),
	FOREIGN KEY fk_student(student)		REFERENCES students(matricule)

)ENGINE=InnoDB;

-- Changer dans answer_students le Char(100) en VARCHAR(1000)
-- Vérifier la relation qu'il faut entre students_answer et exercises.(	et donc si number doit également être FK)
-- Un exercice peut être ne pas avoir de niveau attribué ? Obligatoirement
-- Un author peut être null dans exercises. Enlever NN et gras.
-- Supprimer la FK  de levels
-- Rajouter un numero d'excercice dans exercises pour pouvoir différencier deux exercices de même niveau qui doit être renseigné ( NN)