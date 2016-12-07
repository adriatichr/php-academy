-- PRIPREMA RADNIH TABLICA --
DROP TABLE IF EXISTS student;
CREATE TABLE student (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	year_of_study TINYINT UNSIGNED NOT NULL,
	age TINYINT UNSIGNED
);
INSERT INTO student (name, surname, year_of_study, age) VALUES ('Ana', 'Anić', 1, NULL);
INSERT INTO student (name, surname, year_of_study, age) VALUES ('Iva', 'Ivić', 4, 23);
INSERT INTO student (name, surname, year_of_study, age) VALUES ('Mate', 'Matić', 2, 22);
INSERT INTO student (name, surname, year_of_study, age) VALUES ('Jure', 'Jurić', 2, 0);
INSERT INTO student (name, surname, year_of_study, age) VALUES ('Šime', 'Anić', 1, NULL);
-- KRAJ PRIPREME RADNIH TABLICA --

# NULL se smatra manjom vrijednošću po ORDER BY klauzuli
SELECT * FROM student ORDER BY age ASC;

# Ova naredba neće vratiti studente za koje godina nije definirana
SELECT * FROM student WHERE age < 23;
# Ako želimo i NULL vrijednosti moramo to eksplicitno specificirati
SELECT * FROM student WHERE age < 23 OR age IS NULL;

# NULL nije isto što i 0 (česta greška u početnika)
SELECT * FROM student WHERE age = 0;
SELECT * FROM student WHERE age = 0 OR age IS NULL;
