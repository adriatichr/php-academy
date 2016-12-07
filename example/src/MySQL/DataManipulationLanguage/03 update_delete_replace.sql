# NAPOMENA: koriste iste radne tablice sa početka "02 select.sql" file-a.

-- UPDATE --
# Ažurira vrijednosti u zadanim kolonama za postojeće retke u tablici
UPDATE student SET group_id = 3 WHERE group_id IS NULL;

# Vrijede ista ograničenja primarnog i stranog ključa kao i za INSERT naredbu:
UPDATE student SET id = 3 WHERE id = 2;
UPDATE student SET group_id = 7 WHERE age > 20;

# Update sintaksa podržava i izraze
UPDATE student SET age = age + 1;	# kada nema WHERE klauzule ažuriraju se svi retci u tablici
UPDATE student SET name = CONCAT('Student ', name);
UPDATE student SET name = SUBSTR(name, 9);
UPDATE student SET surname = CONCAT(surname, ' (', age, ')');

# Ažuriranje vrijednosti jedne tablice sa vrijednostima iz druge tablice
UPDATE student AS s, `group` AS g
SET s.name = CONCAT(s.name, ' (', g.name, ')')
WHERE s.group_id = g.id;

-- DELETE --
# Briše retke iz tablice
DELETE FROM student; # Briše sve retke iz tablice, TRUNCATE TABLE je brži ali se ne može koristiti unutar transakcije.
DELETE FROM student WHERE age < 20;


-- REPLACE --
# Radi identično kao i INSERT osim što se kod dodavanja redaka za koje u tablici već postoji redak sa istim primarnim
# ključem ili jedinstvenim indeksom, stari redak se briše prije dodavanja novog.
REPLACE INTO student (id, name, surname, age) VALUES (1, 'Novi', 'Student', 21);
