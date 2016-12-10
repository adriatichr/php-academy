<?php

namespace Adriatic\PHPAkademija\Test\MySQL;

class InitialState
{
    /**
     * Postavlja bazu u početno stanje.
     *
     * Način korištenja: pozvati prije svakog testa.
     *
     * @param \PDO $pdo
     */
    public static function setup(\PDO $pdo)
    {
        $initialState = <<<SQL
            DROP TABLE IF EXISTS student;
            DROP TABLE IF EXISTS `group`;
            CREATE TABLE `group` (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
SQL;

        $pdo->query($initialState);
    }
}
