# SELECT naredba se koristi za dohvaćanje redaka iz jedne ili više tablica
#
# Prvo pripremimo tablice na kojima ćemo testirati SELECT naredbe:
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
INSERT INTO student (name, surname, group_id, age) VALUES ('Šime', 'Anić', 2, 19);
INSERT INTO student (name, surname, group_id, age) VALUES ('Student iz', 'Nepoznate grupe', NULL, 22);
INSERT INTO student (name, surname, group_id, age) VALUES ('Još jedan student iz', 'Nepoznate grupe', NULL, 24);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivo', 'Ivić', 1, 18);
INSERT INTO student (name, surname, group_id, age) VALUES ('Ivana', 'Ivić', 1, 25);
INSERT INTO student (name, surname, group_id, age) VALUES ('Matko', 'Matić', 3, 22);
-- KRAJ PRIPREME RADNIH TABLICA --


# Možemo eksplicitno definirati koje kolone želimo:
SELECT id, name FROM student;
# ili možemo dohvatiti sve kolone u tablici:
SELECT * FROM student;


-- SELECT ... WHERE --
# U gornjem primjeru smo dohvatili sve retke iz student tablice, ali možemo dodatno filtrirati retke koje dohvaćamo preko
# WHERE naredbe:
SELECT * FROM student WHERE surname='Anić';	# Samo studenti čije je prezime 'Anić'
SELECT * FROM student WHERE id > 2; # Samo studenti čiji je id veći od 2
# Uvjeti u WHERE naredbi se mogu kombinirati pomoću veznika AND i OR
SELECT * FROM student WHERE surname='Anić' AND id > 2;
SELECT * FROM student WHERE surname='Anić' OR group_id = 2; # Studenti čije je prezime 'Anić' ili su u grupi 'Matematika'

# Popis operatora:
# http://dev.mysql.com/doc/refman/5.7/en/non-typed-operators.html
#
# Za informacije koji operatori imaju prednost pogledati:
# http://dev.mysql.com/doc/refman/5.7/en/operator-precedence.html
#
# Prednost operatora se može eskplicitno naznačiti koristeći obične zagrade: ()


-- SELECT ... JOIN --
# U student tablici su grupe kojima studenti pripadaju označene sa id-jem grupe, što nije baš informativno
# Ipak, pomoću JOIN naredbe možemo povezati student i group naredbe preko stranog ključa group_id:
SELECT student.name, surname, `group`.name
FROM student
JOIN `group` ON `group`.id = student.group_id;

# MySQL podržava da tablice i kolone referenciramo po drugačijim nazivima koristeći aliase. Ovo nam pomaže u rješavanju
# konflikata u imenima tablica i kolona. Gornji primjer koristeći alias:
SELECT s.name, s.surname, g.name
FROM student AS s
JOIN `group` AS g ON g.id = s.group_id;

# LEFT JOIN vs INNER JOIN
# U gornjem primjeru možemo primjetiti da studenti sa nedefiniranim grupama (group_id je NULL) nisu prikazani za JOIN
# naredbu. Ovo je zato jer je JOIN u MySQL-u ekvivalent INNER JOIN naredbi u standardnom SQL-u.
# INNER JOIN ignorira retke u child tablici za koje je strani ključ nedefiniran (NULL).
# LEFT JOIN prikazuje i retke u child tablici za koje je strani ključ nedefiniran (NULL).
SELECT s.name, s.surname, g.name
FROM student AS s
LEFT JOIN `group` AS g ON g.id = s.group_id;

# RIGHT JOIN je ekvivalent LEFT JOIN naredbi gdje je redoslije tablica obrnut. Obično se uvijek preferira LEFT JOIN.
# Gornji primjer preko RIGHT JOIN-a:
SELECT s.name, s.surname, g.name
FROM `group` AS g
RIGHT JOIN student AS s ON g.id = s.group_id;

# GROUP BY se koristi u kombinaciji sa nekom od agregatnih funkcija:
# http://dev.mysql.com/doc/refman/5.7/en/group-by-functions.html
#
# Primjer: želimo izračunati prosječnu starost svih studenata po grupama:
SELECT s.group_id, AVG(s.age) AS prosjecna_starost
FROM student AS s
GROUP BY s.group_id; # grupiramo studente po grupama

# Agregatne funkcije se mogu koristiti bez GROUP BY klauzule.
# Primjer: broj studenata na kampusu
SELECT count(*) FROM student;
# Ako želimo broj studenata u grupi 'Matematika':
SELECT count(*) FROM student WHERE group_id = 2;
# Ako želimo ukupan broj različitih prezimena studenata:
SELECT count(DISTINCT surname) FROM student;

-- HAVING vs. WHERE --
# Još jedan način filtriranja rezultata je HAVING klauzula.
# Naizgled HAVING i WHERE imaju isti učinak:
SELECT * FROM student HAVING group_id = 2;
SELECT * FROM student WHERE group_id = 2;
# Razlika je u tome što se WHERE filtriranje izvršava prije GROUP BY naredbe, a HAVING poslije.
# Ovo znači da HAVING može filtrirati rezultate SELECT naredbe po agregatnim kolonama.
# Primjer: želimo samo grupe čija je prosječna starost veća od 20 godina:
SELECT s.group_id, AVG(s.age) AS prosjecna_starost
FROM student AS s
GROUP BY s.group_id
HAVING prosjecna_starost > 20; # WHERE bi u ovom slučaju bacio grešku jer ne može raditi na agregatnim kolonama

# Ako ne trebamo filtrirati po agregatnim vrijednostima, uvijek je bolje koristit WHERE kaluzulu.


# ORDER BY klauzula određuje poredak rezultata SELECT upita:
SELECT * FROM student ORDER BY age ASC; # Poredak od manjeg prema većem (ASC) je zadani poredak
SELECT * FROM student ORDER BY age DESC;
# Rezultate možemo sortirati po više kolona (za svaku se može odrediti poredak)
# Ovaj primjer prvo sortira po godini, a zatim po id-ju:
SELECT * FROM student ORDER BY age DESC, id DESC;


-- Subquery --
# MySQL podržava SELECT unutar neke druge naredbe, na primjer unutar WHERE klauzule druge SELECT naredbe.
# Primjer: želimo dohvatiti sve studente koji u nazivu svoje grupe imaju riječ 'Matematika'
SELECT * FROM student AS s WHERE s.group_id IN (SELECT g.id FROM `group` AS g WHERE g.name LIKE '%Matematika%');
# Ovo je ekvivalent naredbi:
SELECT s.* FROM student AS s
JOIN `group` AS g ON g.id = s.group_id
WHERE g.name LIKE '%Matematika%';


# UNION kombinira rezultate iz dvaju različitih tablica
#
# Detaljna dokumentacija:
# http://dev.mysql.com/doc/refman/5.7/en/union.html
SELECT s.name FROM student AS s UNION SELECT g.name FROM `group` AS g;
SELECT s.surname FROM student AS s UNION SELECT g.name FROM `group` AS g;
SELECT s.age FROM student AS s UNION SELECT g.name FROM `group` AS g;
