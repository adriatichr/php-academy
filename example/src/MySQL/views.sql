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
	group_id INT UNSIGNED NULL DEFAULT NULL,
	year_of_study TINYINT UNSIGNED NOT NULL,
	INDEX student_group_id (group_id),
	CONSTRAINT student_group_id FOREIGN KEY (group_id) REFERENCES `group` (id)
);
INSERT INTO `group` (id, name) VALUES (1, 'Računarstvo'), (2, 'Matematika'), (3, 'Matematika i Računarstvo');
INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('Ana', 'Anić', 1, 1);
INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('Iva', 'Ivić', 3, 1);
INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('Mate', 'Matić', 2, 2);
INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('Šime', 'Anić', 1, 1);
-- KRAJ PRIPREME RADNIH TABLICA --

# MySQL Views su spremljeni upiti koji funkcioniraju kao virtualna tablica.
# View se stvara pomoću naredbe CREATE VIEW
CREATE OR REPLACE VIEW freshman_student
AS SELECT s.id, s.name, s.surname, s.group_id, g.name AS group_name
	FROM student AS s
	JOIN `group` AS g ON s.group_id = g.id
	WHERE s.year_of_study = 1;

# Napomena, CREATE VIEW je ddl naredba, što znači da uzrokuje implicitni commit

# Nakon što smo stvorili view, možemo na njemu vršiti upite kao i na svakoj drugoj tablici:
SELECT * FROM freshman_student
WHERE group_id = 1;

# View se može stvoriti iz drugog view-a:
CREATE OR REPLACE VIEW freshman_computing_student
AS SELECT *	FROM freshman_student AS s WHERE s.group_id = 1;

# Bilo koje promjene u podacima tablice iz koje smo stvorili view-a se odmah vide u samom view-u:
INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('Martin', 'Fowler', 1, 1);
SELECT * FROM freshman_student;
SELECT * FROM freshman_computing_student;
