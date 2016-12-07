# Transakcije nam omogućuju grupiranje više DML naredbi (eng. unit of work) koje se zajedno mogu primijeniti na bazu
# (eng. commit) ili povući (eng. rollback).
# Za transakcije vrijede ACID pravila.
#
-- PRIPREMA RADNIH TABLICA --
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
	id INT UNSIGNED NOT NULL PRIMARY KEY,
	name VARCHAR(60) NOT NULL
);
CREATE TABLE student (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	created DATETIME NOT NULL DEFAULT NOW() COMMENT 'Datum upisa studenta',
	group_id INT UNSIGNED NULL DEFAULT NULL,
	age TINYINT UNSIGNED NOT NULL,
	INDEX student_group_id (group_id),
	CONSTRAINT student_group_id FOREIGN KEY (group_id) REFERENCES `group` (id)
);
INSERT INTO `group` (id, name) VALUES (1, 'Računarstvo'), (2, 'Matematika'), (3, 'Matematika i Računarstvo');
INSERT INTO student (name, surname, group_id, age) VALUES ('Ana', 'Anić', 1, 19);
INSERT INTO student (name, surname, group_id, age) VALUES ('Mate', 'Matić', 2, 20);
INSERT INTO student (name, surname, group_id, age) VALUES ('Šime', 'Anić', 3, 19);
-- KRAJ PRIPREME RADNIH TABLICA --


# Početak transakcije se označava naredbom START TRANSACTION
# Rollback naredba poništava sve promjene koje smo napravili unutar transakcije
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
INSERT INTO student (name, surname, group_id, age) VALUES ('Matko', 'Matić', 3, 22);
ROLLBACK;

# Commit naredba sve promjene unutar transakcije trajno sprema u bazu
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
INSERT INTO student (name, surname, group_id, age) VALUES ('Matko', 'Matić', 3, 22);
COMMIT;

DELETE FROM student WHERE id > 3;

# Ako neka od naredbi unutar transakcije napravi grešku, ostale promjene napravljene unutar transakcije se izvršavaju.
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
# Kolona sa id-jem 1 već postoji pa će sljedeća naredba javiti grešku:
INSERT INTO student (id, name, surname, group_id, age) VALUES (1, 'Matko', 'Matić', 3, 22);
COMMIT; # Spremaju se rezultati prve dvije naredbe

DELETE FROM student WHERE id > 3;

# Ako se odspojimo od baze prije poziva COMMIT naredbe, vrši se automatski ROLLBACK
START TRANSACTION;
DELETE FROM student;
# Ako sada ugasimo konekciju na bazu (npr. ugasimo MySQL klijent), sadržaj student tablice neće biti izbrisan.

# Implicitni commit
# Većina DDL naredbi vrši implicitni commit do tada obavljenog posla prije nego se izvrši.
START TRANSACTION;
DELETE FROM student;
# DDL naredba
CREATE TABLE IF NOT EXISTS student (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY);
ROLLBACK; # nema učinka jer je sve prije CREATE TABLE naredbe commit-ano u bazu

# Ugniježđene transackije uzrokuju implicitni commit:
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
	START TRANSACTION; # u ovom trenutku se vrši implicitni commit gornjih naredbi
	DELETE FROM student;
	ROLLBACK; # poništava delete naredbu
ROLLBACK; # nema učinka jer je ugniježđena START TRANSACTION naredba uzrokovala COMMIT


-- SAVEPOINTS --

# Ugniježđene transakcije se mogu simulirati koristeći SAVEPOINT i ROLLBACK TO SAVEPOINT
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
	SAVEPOINT isprazni_student_tablicu;
	DELETE FROM student;
	ROLLBACK TO isprazni_student_tablicu; # poništava delete naredbu
ROLLBACK; # Poništava insert naredbe

# isti primjer koji na kraju transakcije vrši commit:
START TRANSACTION;
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
	SAVEPOINT isprazni_student_tablicu;
	DELETE FROM student;
	ROLLBACK TO isprazni_student_tablicu; # poništava delete naredbu
COMMIT; # Čini trajnim promjene koje dodaju retke u tablicu, ali ne i brisanje svih redaka unutar SAVEPOINT-a