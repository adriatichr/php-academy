CREATE DATABASE IF NOT EXISTS php_academy_examples;
# Prije korištenja naredbi za definiranje tablica moramo prvo odabrati bazu podataka u kojoj želimo mijenjati tablice.
USE php_academy_examples;

# Osnovni podaci potrebni za tablicu su naziv kolone njezin tip (data type).
# Ako nije specificirano drugačije, tablica koristi charset i collation od baze.
CREATE TABLE student (id INT);

# Za brisanje tablice iz baze koristimo naredbu DROP TABLE. IF EXISTS se može dodati kako bi spriječili grešku ako
# tablica ne postoji.
DROP TABLE student;

# Nakon definicije tipa kolone mogu se definirati i opcionalni atributi
DROP TABLE IF EXISTS student;
CREATE TABLE IF NOT EXISTS student (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	created DATETIME NOT NULL COMMENT 'Datum upisa studenta' DEFAULT NOW()
);

# Za izmjenu redaka u tablici koristi se ALTER TABLE
# Primijetiti da je redoslijed izmjena bitan
ALTER TABLE student
	CHANGE name full_name VARCHAR(100) NOT NULL,
	DROP surname,
	# Kolonu created premještamo iza id kolone (sve ostale vrijednosti moraju ostati iste)
	CHANGE created created DATETIME NOT NULL COMMENT 'Datum upisa studenta' DEFAULT NOW() AFTER id,
	ADD modified DATETIME NOT NULL AFTER created,
	ADD group_id INT UNSIGNED AFTER full_name;

# ALTER TABLE se može koristiti i za promijenu naziva tablice:
ALTER TABLE student RENAME studenti;
# RENAME TABLE radi istu stvar:
RENAME TABLE studenti TO student;

# Za TRUNCATE TABLE primjer trebamo dodati par redaka u tablicu
INSERT INTO student (modified, full_name, group_id) VALUES (NOW(), 'Ana Anić', 1), (NOW(), 'Ante Antić', 2);
# Zatim pozovemo naredbu
TRUNCATE TABLE student;

# TRUNCATE neće raditi na tablicama ako postoji referenca na njih preko stranog ključa u nekoj drugoj tablici.
# Stoga ćemo stvoriti tablicu grupa u koje se studenti mogu upisati.
# Primjetiti da je naziv tablice stavljen u tzv. backticks ` navodnike (Alt Gr + 7). Ovo je potrebno jer je GROUP ključna
# riječ u MySQL-u
CREATE TABLE IF NOT EXISTS `group` (
	id INT UNSIGNED NOT NULL,
	name VARCHAR(60) NOT NULL,
	PRIMARY KEY (id)
);
INSERT INTO `group` (id, name) VALUES (1, 'Matematika'), (2, 'Računarstvo');
# Sada u tablicu studenti dodajemo strani ključ koji je refenca na id grupe:
ALTER TABLE student
	ADD CONSTRAINT student_group_id FOREIGN KEY (group_id) REFERENCES `group` (id);
# i dodajemo par studenata, po jednog u svaku grupu:
INSERT INTO student (modified, full_name, group_id) VALUES (NOW(), 'Ana Anić', 1), (NOW(), 'Ante Antić', 2);
# TRUNCATE naredba za `group` tablicu će javiti grešku:
TRUNCATE TABLE `group`;
# TRUNCATE student tablice i dalje radi:
TRUNCATE TABLE student;