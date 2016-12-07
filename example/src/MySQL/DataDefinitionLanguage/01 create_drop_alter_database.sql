-- CREATE & DROP DATABASE --

# Stvaranje baze (u MySQL-u SCHEMA i DATABASE su sinonimi)
CREATE DATABASE php_academy_examples;
# ili
CREATE SCHEMA php_academy_examples;

# Ako baza podataka već postoji MySQL javlja grešku. Ovo se može zaobići tako da se koristi naredba
CREATE DATABASE IF NOT EXISTS php_academy_examples;

DROP DATABASE php_academy_examples;
# ili (prikazuje upozorenje umjesto greške)
DROP DATABASE IF EXISTS php_academy_examples;



-- CHARACTER SETS AND COLLATIONS --

# Svaki charset može imati više collation-a, ali svaki collation vrijedi za najviše jedan charset

# Koristeći SHOW CHARACTER SET naredbu možemo pogledati sve charsete i njihove zadane collation-e
SHOW CHARACTER SET;
# ili na primjer:
SHOW CHARACTER SET WHERE CHARSET='utf8';

# Koristeći naredbu SHOW COLLATION možemo pregledati sve collation-e koji postoje
SHOW COLLATION;

DROP DATABASE IF EXISTS php_academy_examples;
# Stvaranje baze sa definiranim character set-om
# U ovom slučaju MySQL za collation uzima zadani za latin1 set znakova (latin1_swedish_ci)
CREATE DATABASE php_academy_examples
	CHARACTER SET latin1;

# Ako želimo vidjeti popis svih baza podataka na serveru i njihove charsete i collatione
SELECT s.SCHEMA_NAME, s.DEFAULT_CHARACTER_SET_NAME, s.DEFAULT_COLLATION_NAME
FROM information_schema.SCHEMATA AS s

# Stvaranje baze sa definiranim collation-om
# U ovom slučaju MySQL za charset uzima zadani za odabrani collation (u donjem slučaju to je latin2)
DROP DATABASE IF EXISTS php_academy_examples;
CREATE DATABASE php_academy_examples
	COLLATE latin2_general_ci;

# Stvaranje baze sa definiranim collation-om i charsetom
DROP DATABASE IF EXISTS php_academy_examples;
CREATE DATABASE php_academy_examples
	CHARACTER SET latin1
	COLLATE latin1_general_ci;

# Za promjenu charseta ili collation-a koristimo ALTER DATABASE
ALTER DATABASE php_academy_examples
	CHARACTER SET utf8
	COLLATE utf8_general_ci;
