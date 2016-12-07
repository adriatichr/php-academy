# Za dodavanje novih redaka u tablicu koristimo INSERT naredbu
DROP TABLE IF EXISTS student;
CREATE TABLE IF NOT EXISTS student (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	created DATETIME NOT NULL COMMENT 'Datum upisa studenta' DEFAULT NOW()
);

# U MySQL-u postoje tri verzije INSERT naredbi
#
# Prvi oblik (INSERT ... VALUES)
INSERT INTO student VALUES (1, 'Ana', 'Anić', NOW());	# Poredak vrijednosti mora odgovarati poretku kolona
INSERT INTO student (name, surname) VALUES ('Mate', 'Matić');
# Ova sintaksa se može koristiti za ubacivanje više redaka odjednom:
INSERT INTO student (name, surname) VALUES ('Ivo', 'Ivić'), ('Ivana', 'Ivić');

# Drugi oblik (INSERT ... SET)
INSERT INTO student	SET name='Šime', surname='Anić';

# Treći oblik (INSERT ... SELECT) se koristi kada je potrebno ubaciti vrijednosti iz druge tablice
CREATE TABLE IF NOT EXISTS siblings (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
);
# U siblings tablicu ubacujemo sve studente sa prezimenom 'Anić'
INSERT INTO siblings (name, surname)
	SELECT name, surname FROM student WHERE surname='Anić';


-- INSERT i primarni ključ --
# Ako preko INSERT naredbe pokušamo ubaciti redak sa primarnim ključem koji već postoji u tablici, MySQL će javiti grešku
INSERT INTO student VALUES (1, 'Jure', 'Jurić', NOW());


-- INSERT i strani ključ --
# Ako u tablicu sa stranim ključem pokušamo ubaciti redak čiji strani ključ referencira na redak koji ne postoji u parent
# tablici, MySQL će zabraniti unos i javiti grešku.
CREATE TABLE IF NOT EXISTS `group` (
	id INT UNSIGNED NOT NULL,
	name VARCHAR(60) NOT NULL,
	PRIMARY KEY (id)
);
INSERT INTO `group` (id, name) VALUES (1, 'Matematika'), (2, 'Računarstvo');
ALTER TABLE student
	ADD group_id INT UNSIGNED,
	ADD CONSTRAINT student_group_id FOREIGN KEY (group_id) REFERENCES `group` (id);
# Rezultira greškom "SQL Error (1452): Cannot add or update a child row: a foreign key constraint fails"
INSERT INTO student SET name='Student iz', surname='Nepoznate grupe', group_id=3;
# Ipak, ako je za strani ključ dopušten NULL, može se ubaciti redak za koji group_id nije definiran
INSERT INTO student SET name='Student iz', surname='Nepoznate grupe';


-- INSERT ... ON DUPLICATE KEY UPDATE --
# Ako za redak koji ubacujemo već postoji redak u tablici sa istim primarnim ključem ili jedinstvenim indeksom, MySQL će
# izvršiti UPDATE na postojećem retku sa vrijednostima novog retka:
INSERT INTO `group` (id, name) VALUES
	(2, 'Informatika'),
	(3, 'Fizika')
ON DUPLICATE KEY UPDATE name=CONCAT(name, ' ili po novom: ', VALUES(name));
