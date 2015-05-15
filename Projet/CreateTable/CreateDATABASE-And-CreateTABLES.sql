CREATE DATABASE IF NOT EXISTS sitephp DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS sitephp.students(
	matricule			INTEGER		PRIMARY KEY,
	first_name			CHAR(15) 					NOT NULL,
	last_name			CHAR(15) 					NOT NULL,
	password			CHAR(40)					NULL,
	last_connection		DATETIME					NULL
)ENGINE=InnoDB;

INSERT INTO sitephp.students (matricule, first_name, last_name, password)
VALUES ('1','1','1',sha1('1'));

CREATE TABLE IF NOT EXISTS sitephp.teachers(
	login				VARCHAR(15) 	PRIMARY KEY,
	first_name			CHAR(15)	NOT NULL,
	last_name			CHAR(15)	NOT NULL,
	password			CHAR(40)	NULL
)ENGINE=InnoDB;

INSERT INTO sitephp.teachers (login, first_name, last_name, password)
VALUES ('philippe', 'philippe', 'romain', sha1('romain'));

CREATE TABLE IF NOT EXISTS sitephp.levels(
	level 				INTEGER			auto_increment PRIMARY KEY,
	num_level 			INTEGER			NOT NULL,
	label				VARCHAR(50)		NOT NULL
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.exercises(
	number				INTEGER			AUTO_INCREMENT PRIMARY KEY,
	theme				VARCHAR(60)		NULL,
	statement			VARCHAR(400)	NOT NULL,
	query				VARCHAR(1000)	NOT NULL,
	nb_lines			VARCHAR(40)			NOT NULL,
	last_modification	DATETIME		NULL,
	num_exercise		INTEGER			NOT NULL,
	author				VARCHAR(15)			NULL,
	num_level			INTEGER			NOT NULL,

	FOREIGN KEY fk_author(author)		REFERENCES teachers(login),
	FOREIGN KEY fk_num_level(num_level)	REFERENCES levels(level)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sitephp.students_answers(
	number				INTEGER			auto_increment PRIMARY KEY,
	answer_query		VARCHAR(1000)	NULL,
	exercise 			INTEGER			NOT NULL,
	student 			INTEGER			NOT NULL,

	FOREIGN KEY fk_exercise(exercise)	REFERENCES exercises(number),
	FOREIGN KEY fk_student(student)		REFERENCES students(matricule)
  ON DELETE CASCADE
  ON UPDATE CASCADE

)ENGINE=InnoDB;

-- Vérifier la relation qu'il faut entre students_answer et exercises.(	et donc si number doit également être FK)

CREATE DATABASE IF NOT EXISTS bd1 DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS bd1.albums
(isbn char(14) PRIMARY KEY,
  titre varchar(50) NOT NULL,
  serie varchar(20),
  scenariste varchar(20),
  dessinateur varchar(20),
  coloriste varchar(20),
  editeur varchar(20) NOT NULL,
  pays character(1),
  annee_edition integer,
  prix double precision NOT NULL
  )ENGINE=InnoDB; 


CREATE DATABASE IF NOT EXISTS bd2 DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS bd2.editeurs
(num  integer  primary key,
 nom  varchar(20) not NULL,
 adresse varchar(30) ,
 pays char (1) not NULL)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bd2.albums
(isbn character(14)   PRIMARY KEY,
 titre character varying(50) NOT NULL,
  serie character varying(20),
  scenariste character varying(20),
  dessinateur character varying(20),
  coloriste character varying(20),
  num_editeur integer NOT NULL ,
  annee_edition integer,
  prix double precision NOT NULL,
   FOREIGN KEY fk_edi(num_editeur)
   REFERENCES bd2.editeurs(num)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
  )ENGINE=InnoDB;

CREATE DATABASE IF NOT EXISTS bd3 DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS bd3.editeurs
(num  integer  primary key,
 nom        varchar(20) not NULL,
 adresse      varchar(30) ,
 pays       char(1) not NULL)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bd3.albums
(isbn     char(14)  PRIMARY KEY,
 titre    varchar(50)   NOT NULL ,
 serie    varchar(20)   ,
 num_editeur  integer   not NULL references bd3.editeurs(num),
 annee_edition  INTEGER ,
  prix double precision NOT NULL,
     FOREIGN KEY fk_edi(num_editeur)
   REFERENCES bd3.editeurs(num)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
  )ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bd3.auteurs
(num  integer  primary key,
nom varchar(20),
adresse varchar(30) ,
e_mail  varchar(30) not NULL)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bd3.participations
(isbn char(14) not NULL,
num_auteur integer not NULL ,
participe char(1)  not NULL,
primary key  (isbn,num_auteur,participe),
FOREIGN KEY fk_alb(isbn)
   REFERENCES bd3.albums(isbn)
   ON UPDATE CASCADE
   ON DELETE RESTRICT,
       FOREIGN KEY fk_aut(num_auteur)
   REFERENCES bd3.auteurs(num)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
 )ENGINE=InnoDB;

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-055-9','Joyeux Noël, May',NULL,'Cosey','Cosey','Cosey','Dupuis','b',1998,7);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-03043-4','La fiancée de Lucky Luke','Lucky Luke','Guy Vidal','Morris',NULL,'Dargaud','f',1985,5);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-88257-000-4','Nitroglycérine','Lucky Luke','Guy Vidal','Morris',NULL,'Dargaud','f',1987,5);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00585-5','Ma Dalton','Lucky Luke','Goscinny','Morris',NULL,'Dargaud','f',1980,5);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00920-6','La guérison des Dalton','Lucky Luke','Goscinny','Morris',NULL,'Dargaud','f',1978,5);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00105-4','L''Oreille Cassée','Tintin','Hergé','Hergé','Hergé','Casterman','b',1979,8);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00103-8','Les Cigares du Pharaon','Tintin','Hergé','Hergé','Hergé','Casterman','b',1955,8);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00107-0','Le Sceptre d''Ottokar','Tintin','Hergé','Hergé','Hergé','Casterman','b',1947,8);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-908-46271-0','FAITES GAFFE A LAGAFFE','Gaston','Franquin','Franquin','Fanny','Dupuis','b',1996,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0955-6','LA SAGA DES GAFFES','Gaston','Franquin','Franquin',NULL,'Dupuis','b',1982,6);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0091-5','LE CAS LAGAFFE','Gaston',NULL,'Franquin',NULL,'Dupuis','b',1977,6);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0019-2','Spirou et les hommes-bulles','Spirou','Franquin','Franquin',NULL,'Dupuis','b',1989,7);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0018-4','L''ombre du Z','Spirou','Jidehem','Franquin',NULL,'Dupuis','b',1976,7);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0017-6','Z comme Zorglub','Spirou',NULL,'Franquin',NULL,'Dupuis','b',1977,7);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-0015-X','Le voyageur du mésozoïque','Spirou',NULL,'Franquin',NULL,'Dupuis','b',1977,7);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-895-000123','Idées Noires',NULL,NULL,'Franquin',NULL,'Fluide Glacial','f',1981,10);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8035-0029-9','Modeste et Pompon','Modeste',NULL,'Franquin',NULL,'Magic Strip','b',1981,12);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-86497-004-X','L''odyssée d''Astérix','Astérix','Uderzo','Uderzo',NULL,'Albert René','f',1981,6);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00096-9','Astérix le gaulois','Astérix','Goscinny','Uderzo',NULL,'Dargaud','f',1975,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00600-2','Les lauriers de César','Astérix','Goscinny','Uderzo',NULL,'Dargaud','f',1978,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00230-9','Astérix légionnaire','Astérix','Goscinny','Uderzo',NULL,'Dargaud','f',1976,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-017-X','Les 3 Formules du Professeur Sato','Blake et Mortimer','Jacobs','de Moor','de Moor','Blake et Mortimer','b',1990,12);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-152-12345-X','Les aventures complètes d''Oumpah-Pah','oumpah pah','Goscinny','Uderzo',NULL,'Le Lombard','b',1979,12);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00109-0','Coke en Stock','Tintin','Hergé','Hergé','Hergé','Casterman','b',1958,8);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-01150-2','Astérix chez les Belges','Astérix','Goscinny','Uderzo','Uderzo','Dargaud','f',1979,4);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-009-9','Le mystère de la grande pyramide','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1987,10);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-008-0','Le mystère de la grande pyramide','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1986,10);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-010-2','La marque jaune','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1987,9);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-043-9','L''Affaire Françis Blake','Blake et Mortimer','Benoît','Van Hamme',NULL,'Blake et Mortimer','b',1996,14);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-052-8','La Machination Voronov','Blake et Mortimer','Sente','Juilliard','DeMille','Blake et Mortimer','b',2000,14);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8001-2900-x','Zeke raconte des histoires',NULL,'Cosey','Cosey','Cosey','Dupuis','b',1999,14);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8021-3900-x','Spirou et Fantasio à Tokyo','Dupuis',NULL,'Benoît',NULL,'Dargaud','f',2001,14);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-8031-3900-6','Une dernière aventure d''Astérix','Astérix',NULL,'Dupuis',NULL,'Dargaud','f',2006,14);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00123-2','Tintin et les Picaros','Tintin','Hergé','Hergé','Hergé','Casterman','b',1976,8);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-00117-8','L''Affaire Tournesol','Tintin','Hergé','Hergé','Hergé','Casterman','b',1956,8);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-203-12345-6','Vol 714 pour Sydney','Tintin','Hergé','Hergé','Hergé','Casterman','b',1968,8);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-002-1','Le Secret de l''Espadon tome 1','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1984,9);

INSERT INTO bd1.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-004-8','Le Secret de L''Espadon tome 2','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1985,9);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-87097-005-6','Le Secret de L''Espadon tome 3','Blake et Mortimer','Jacobs','Jacobs',NULL,'Blake et Mortimer','b',1986,9);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00921-4','Obélix et compagnie','Astérix','Goscinny','Uderzo',NULL,'Le Lombard','b',1976,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-86497-020-1','Astérix chez Rahazade','Astérix','Uderzo','Uderzo',NULL,'Albert René','f',1987,6);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-01144-8','Le Fil qui chante','Lucky Luke','Goscinny','Morris',NULL,'Dargaud','f',1977,5);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-205-00517-0','Canyon Apache','Lucky Luke','Goscinny','Morris',NULL,'Dargaud','f',1975,8);

INSERT INTO bd1.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,editeur,pays,annee_edition,prix)
values
('2-258-03431-0','Adieu Monde Cruel!','Calvin et Hobbes',NULL,NULL,NULL,'Watterson','a',1991,9);

INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (1, 'Albert René',NULL,'f');

INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (2, 'Dargaud',NULL,'f');
INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (3, 'Blake et Mortimer',NULL,'b');
INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (4, 'Dupuis','Marcinelle','b');

INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (5, 'Magic Strip','Bruxelles','b');
INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (6, 'Le Lombard','Bruxelles','b');
INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (7, 'Casterman',NULL,'b');
INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (8, 'Fluide glacial',NULL,'f');

INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (9, 'Watterson',NULL,'a');

INSERT INTO bd2.editeurs (num,nom,adresse , pays)
values (10, 'Jacobs',NULL,'a');

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-055-9','Joyeux Noël, May',NULL,'Cosey','Cosey','Cosey',4,1998,7);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-03043-4','La fiancée de Lucky Luke','Lucky Luke','Guy Vidal','Morris',NULL,2,1985,5);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-88257-000-4','Nitroglycérine','Lucky Luke','Guy Vidal','Morris',NULL,2,1987,5);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00585-5','Ma Dalton','Lucky Luke','Goscinny','Morris',NULL,2,1980,5);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00920-6','La guérison des Dalton','Lucky Luke','Goscinny','Morris',NULL,2,1978,5);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00105-4','L''Oreille Cassée','Tintin','Hergé','Hergé','Hergé',7,1979,8);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00103-8','Les Cigares du Pharaon','Tintin','Hergé','Hergé','Hergé',7,1955,8);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00107-0','Le Sceptre d''Ottokar','Tintin','Hergé','Hergé','Hergé',7,1947,8);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-908-46271-0','FAITES GAFFE A LAGAFFE','Gaston','Franquin','Franquin','Fanny',4,1996,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0955-6','LA SAGA DES GAFFES','Gaston','Franquin','Franquin',NULL,4,1982,6);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0091-5','LE CAS LAGAFFE','Gaston',NULL,'Franquin',NULL,4,1977,6);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0019-2','Spirou et les hommes-bulles','Spirou','Franquin','Franquin',NULL,4,1989,7);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0018-4','L''ombre du Z','Spirou','Jidehem','Franquin',NULL,4,1976,7);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0017-6','Z comme Zorglub','Spirou',NULL,'Franquin',NULL,4,1977,7);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-0015-X','Le voyageur du mésozoïque','Spirou',NULL,'Franquin',NULL,4,1977,7);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-895-000123','Idées Noires',NULL,NULL,'Franquin',NULL,8,1981,10);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8035-0029-9','Modeste et Pompon','Modeste',NULL,'Franquin',NULL,5,1981,12);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-86497-004-X','L''odyssée d''Astérix','Astérix','Uderzo','Uderzo',NULL,1,1981,6);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00096-9','Astérix le gaulois','Astérix','Goscinny','Uderzo',NULL,2,1975,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00600-2','Les lauriers de César','Astérix','Goscinny','Uderzo',NULL,2,1978,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00230-9','Astérix légionnaire','Astérix','Goscinny','Uderzo',NULL,2,1976,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-017-X','Les 3 Formules du Professeur Sato','Blake et Mortimer','Jacobs','de Moor','de Moor',3,1990,12);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-152-12345-X','Les aventures complètes d''Oumpah-Pah','Oumpah Pah','Goscinny','Uderzo',NULL,6,1979,12);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00109-0','Coke en Stock','Tintin','Hergé','Hergé','Hergé',7,1958,8);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-01150-2','Astérix chez les Belges','Astérix','Goscinny','Uderzo','Uderzo',2,1979,4);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-009-9','Le mystère de la grande pyramide','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1987,10);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-008-0','Le mystère de la grande pyramide','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1986,10);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-010-2','La marque jaune','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1987,9);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-043-9','L''Affaire Françis Blake','Blake et Mortimer','Benoît','Van Hamme',NULL,3,1996,14);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-052-8','La Machination Voronov','Blake et Mortimer','Sente','Juilliard','DeMille',3,2000,14);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8001-2900-x','Zeke raconte des histoires',NULL,'Cosey','Cosey','Cosey',4,1999,14);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8021-3900-x','Spirou et Fantasio à Tokyo','Dupuis',NULL,'Benoît',NULL,2,2001,14);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-8031-3900-6','Une dernière aventure d''Astérix','Astérix',NULL,'Dupuis',NULL,2,2006,14);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00123-2','Tintin et les Picaros','Tintin','Hergé','Hergé','Hergé',7,1976,8);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-00117-8','L''Affaire Tournesol','Tintin','Hergé','Hergé','Hergé',7,1956,8);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-203-12345-6','Vol 714 pour Sydney','Tintin','Hergé','Hergé','Hergé',7,1968,8);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-002-1','Le Secret de l''Espadon tome 1','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1984,9);

INSERT INTO bd2.albums
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-004-8','Le Secret de L''Espadon tome 2','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1985,9);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-87097-005-6','Le Secret de L''Espadon tome 3','Blake et Mortimer','Jacobs','Jacobs',NULL,3,1986,9);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00921-4','Obélix et compagnie','Astérix','Goscinny','Uderzo',NULL,6,1976,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-86497-020-1','Astérix chez Rahazade','Astérix','Uderzo','Uderzo',NULL,1,1987,6);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-01144-8','Le Fil qui chante','Lucky Luke','Goscinny','Morris',NULL,2,1977,5);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-205-00517-0','Canyon Apache','Lucky Luke','Goscinny','Morris',NULL,2,1975,8);

INSERT INTO bd2.albums 
(isbn,titre,serie,scenariste,dessinateur,coloriste,num_editeur,annee_edition,prix)
values
('2-258-03431-0','Adieu Monde Cruel!','Calvin et Hobbes',NULL,NULL,NULL,9,1991,9);


INSERT INTO bd3.auteurs(num,nom,e_mail)
values(1,'Uderzo','uderzo@hotmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(2,'Goscinny','gosciny@gmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(3,'Hergé','Tintin@hotmail.be');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(4,'Franquin','franquin@yahoo.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(5,'Jacobs','jacobs@yahoo.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(6,'de Moor','de_moor@yahoo.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(7,'Sente','sente@yahoo.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(8,'Juilliard','juilliard@gmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(9,'DeMille','de_mille@gmail.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(10,'Benoît','benoit@yahoo.fr');
INSERT INTO bd3.auteurs(num,nom,e_mail,adresse)
values(11,'Van Hamme','van_hamme@hotmail.com','Bruxelles');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(12,'Fanny','fanny@gmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(13,'Jidehem','jidehem@gmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(14,'Cosey','cosey@hotmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(15,'Morris','morris@gmail.com');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(16,'Guy Vidal','guy.vidal@hotmail.be');
INSERT INTO bd3.auteurs(num,nom,e_mail)
values(17,'Dupuis','Dupuis@gmail.com');



INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (1, 'Albert René',NULL,'f');

INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (2, 'Dargaud',NULL,'f');
INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (3, 'Blake et Mortimer',NULL,'b');
INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (4, 'Dupuis','Marcinelle','b');

INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (5, 'Magic Strip','Bruxelles','b');
INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (6, 'Le Lombard','Bruxelles','b');
INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (7, 'Casterman',NULL,'b');
INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (8, 'Fluide Glacial',NULL,'f');

INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (9, 'Watterson',NULL,'a');

INSERT INTO bd3.editeurs (num,nom,adresse , pays)
values (10, 'Jacobs',NULL,'a');

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-055-9','Joyeux Noël, May',NULL,4,1998,7);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-03043-4','La fiancée de Lucky Luke','Lucky Luke',2,1985,5);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-88257-000-4','Nitroglycérine','Lucky Luke',2,1987,5);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00585-5','Ma Dalton','Lucky Luke',2,1980,5);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00920-6','La guérison des Dalton','Lucky Luke',2,1978,5);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00105-4','L''Oreille Cassée','Tintin',7,1979,8);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00103-8','Les Cigares du Pharaon','Tintin',7,1955,8);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00107-0','Le Sceptre d''Ottokar','Tintin',7,1947,8);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-908-46271-0','FAITES GAFFE A LAGAFFE','Gaston',4,1996,6);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0955-6','LA SAGA DES GAFFES','Gaston',4,1982,6);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0091-5','LE CAS LAGAFFE','Gaston',4,1977,6);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0019-2','Spirou et les hommes-bulles','Spirou',4,1989,7);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0018-4','L''ombre du Z','Spirou',4,1976,7);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0017-6','Z comme Zorglub','Spirou',4,1977,7);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-0015-X','Le voyageur du mésozoïque','Spirou',4,1977,7);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-895-000123','Idées Noires',NULL,8,1981,10);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8035-0029-9','Modeste et Pompon','Modeste',5,1981,12);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-86497-004-X','L''odyssée d''Astérix','Astérix',1,1981,6);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00096-9','Astérix le gaulois','Astérix',2,1975,6);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00600-2','Les lauriers de César','Astérix',2,1978,6);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00230-9','Astérix légionnaire','Astérix',2,1976,6);


INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-017-X','Les 3 Formules du Professeur Sato','Blake et Mortimer',3,1990,12);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-152-12345-X','Les aventures complètes d''Oumpah-Pah','Oumpah Pah',6,1979,12);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00109-0','Coke en Stock','Tintin',7,1958,8);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-01150-2','Astérix chez les Belges','Astérix',2,1979,4);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-009-9','Le mystère de la grande pyramide','Blake et Mortimer',3,1987,10);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-008-0','Le mystère de la grande pyramide','Blake et Mortimer',3,1986,10);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-010-2','La marque jaune','Blake et Mortimer',3,1987,9);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-043-9','L''Affaire Françis Blake','Blake et Mortimer',3,1996,14);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-052-8','La Machination Voronov','Blake et Mortimer',3,2000,14);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8001-2900-x','Zeke raconte des histoires',NULL,4,1999,14);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8021-3900-x','Spirou et Fantasio à Tokyo','Dupuis',2,2001,14);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-8031-3900-6','Une dernière aventure d''Astérix','Astérix',2,2006,14);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00123-2','Tintin et les Picaros','Tintin',7,1976,8);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-00117-8','L''Affaire Tournesol','Tintin',7,1956,8);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-203-12345-6','Vol 714 pour Sydney','Tintin',7,1968,8);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-002-1','Le Secret de l''Espadon tome 1','Blake et Mortimer',3,1984,9);

INSERT INTO bd3.albums
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-004-8','Le Secret de L''Espadon tome 2','Blake et Mortimer',3,1985,9);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-87097-005-6','Le Secret de L''Espadon tome 3','Blake et Mortimer',3,1986,9);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00921-4','Obélix et compagnie','Astérix',6,1976,6);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-86497-020-1','Astérix chez Rahazade','Astérix',1,1987,6);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-01144-8','Le Fil qui chante','Lucky Luke',2,1977,5);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-205-00517-0','Canyon Apache','Lucky Luke',2,1975,8);

INSERT INTO bd3.albums 
(isbn,titre,serie,num_editeur,annee_edition,prix)
values
('2-258-03431-0','Adieu Monde Cruel!','Calvin et Hobbes',9,1991,9);




INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-055-9',14,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-055-9',14,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-055-9',14,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-03043-4',16,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-03043-4',15,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-88257-000-4',16,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-88257-000-4',15,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00585-5',2,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00585-5',15,'d');  


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00920-6',2,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00920-6',15,'d');  


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00105-4',3,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00105-4',3,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00105-4',3,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00103-8',3,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00103-8',3,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00103-8',3,'c'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00107-0',3,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00107-0',3,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00107-0',3,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-908-46271-0',4,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-908-46271-0',4,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe)
values ('2-908-46271-0',12,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0955-6',4,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0955-6',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0091-5',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0019-2',4,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0019-2',4,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0018-4',13,'s');  
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0018-4',4,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0017-6',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-0015-X',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-895-000123',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8035-0029-9',4,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-86497-004-X',1,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-86497-004-X',1,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00096-9',2,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00096-9',1,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00600-2',1,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00600-2',2,'s'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00230-9',1,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00230-9',2,'s'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-017-X',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-017-X',6,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-017-X',6,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-152-12345-X',1,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-152-12345-X',2,'s');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00109-0',3,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00109-0',3,'c'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00109-0',3,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-01150-2',1,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-01150-2',2,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-01150-2',1,'c'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-009-9',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-009-9',5,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-008-0',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-008-0',5,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-010-2',5,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-010-2',5,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-043-9',10,'s');  
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-043-9',11,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-052-8',7,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-052-8',8,'d');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-052-8',9,'c');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-2900-x',14,'s');  
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-2900-x',14,'d'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8001-2900-x',14,'c'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8021-3900-x',10,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-8031-3900-6',17,'d');


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00921-4',2,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00921-4',1,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-86497-020-1',1,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-86497-020-1',1,'d');



INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-002-1',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-002-1',5,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-004-8',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-004-8',5,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-005-6',5,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-87097-005-6',5,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00517-0',2,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-00517-0',15,'d');  


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-01144-8',2,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-205-01144-8',15,'d');  


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00117-8',3,'s');
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00117-8',3,'c'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00117-8',3,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00123-2',3,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00123-2',3,'c'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-00123-2',3,'d'); 


INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-12345-6',3,'s'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-12345-6',3,'c'); 
INSERT INTO bd3.participations (isbn,num_auteur,participe) 
values ('2-203-12345-6',3,'d'); 

