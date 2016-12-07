<?php

use PHPUnit\Framework\TestCase;

class PDOTest extends TestCase
{
    private static $pdo;
    private static $pdoNotFound = false;
    private static $pdoNotFoundFailMessage = '';

    public static function setUpBeforeClass()
    {
        try {
            $config = Db::createDbConnectionParams();

            self::$pdo = new PDO(
                sprintf('mysql:dbname=%s;host=%s;port:%s;charset=UTF8', $config->db_name, $config->host, $config->port),
                $config->user, $config->password,
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
        } catch (PDOException $e) {
            self::$pdoNotFound = true;
            self::$pdoNotFoundFailMessage = $e->getMessage() . "\n\n" . $e->getTraceAsString();
        }
    }

    public function setUp()
    {
        if (self::$pdoNotFound) {
            $this->markTestSkipped("Baza podataka nije pronađena, preskačem PDO testove. Stack trace\n:"
                . self::$pdoNotFoundFailMessage);
        }
        self::setupInitialState();
    }

    /** @test */
    public function rollbackTransactionExample()
    {
        $this->assertTrue(self::$pdo->beginTransaction());
        self::$pdo->query('UPDATE student SET year_of_study=year_of_study + 1');
        $this->assertTrue(self::$pdo->rollback());

        $this->assertEquals([1, 1, 2, 1], $this->getStudentsColumn('year_of_study'));

        $this->assertTrue(self::$pdo->beginTransaction());
        self::$pdo->query('UPDATE student SET year_of_study=year_of_study + 1');
        $this->assertTrue(self::$pdo->commit());

        $this->assertEquals([2, 2, 3, 2], $this->getStudentsColumn('year_of_study'));
    }

    /** @test */
    public function killScriptBeforeTransactionEnds()
    {
        $this->markTestSkipped('Zakomentirati ovu liniju ako želimo testirati što se dogodi kada prekinemo skriptu usred transakcije');
        $this->assertTrue(self::$pdo->beginTransaction());
        self::$pdo->query('UPDATE student SET year_of_study=year_of_study + 1');
        exit();
    }

    /** @test */
    public function SQLInjectionAttack()
    {
        $userInput = $this->benevolentUserInput();
        self::$pdo->query(
            sprintf("INSERT INTO student (id, name, surname, group_id, year_of_study) VALUES (100, '%s', '%s', %s, %s)",
                $userInput['name'], $userInput['surname'], $userInput['group_id'], $userInput['year_of_study']));
        $this->assertEquals($userInput, $this->getStudentById(100));
        $this->assertTrue($this->tableExists('student'));

        $maliciousUserInput = $this->maliciousUserInput();
        self::$pdo->query(
            sprintf("INSERT INTO student (name, surname, group_id, year_of_study) VALUES ('%s', '%s', %s, %s)",
                $maliciousUserInput['name'], $maliciousUserInput['surname'], $maliciousUserInput['group_id'], $maliciousUserInput['year_of_study']));
        $this->assertFalse($this->tableExists('student'));
    }

    /** @test */
    public function PDOPreparedStatement()
    {
        $userInput = $this->benevolentUserInput();

        $statement = self::$pdo->prepare(
            'INSERT INTO student (id, name, surname, group_id, year_of_study) VALUES (100, :name, :surname, :group_id, :year_of_study)');
        $statement->bindParam(':name', $userInput['name']);
        $statement->bindParam(':surname', $userInput['surname']);
        $statement->bindParam(':group_id', $userInput['group_id']);
        $statement->bindParam(':year_of_study', $userInput['year_of_study']);
        $statement->execute();

        $this->assertEquals($userInput, $this->getStudentById(100));
    }

    /** @test */
    public function PDOPreparedStatementVSSQLInjectionAttack()
    {
        $maliciousUserInput = $this->maliciousUserInput();

        $statement = self::$pdo->prepare(
            'INSERT INTO student (id, name, surname, group_id, year_of_study) VALUES (100, :name, :surname, :group_id, :year_of_study)');
        $statement->bindParam(':name', $maliciousUserInput['name']);
        $statement->bindParam(':surname', $maliciousUserInput['surname']);
        $statement->bindParam(':group_id', $maliciousUserInput['group_id']);
        $statement->bindParam(':year_of_study', $maliciousUserInput['year_of_study']);
        $statement->execute();

        $this->assertTrue($this->tableExists('student'));
        $this->assertEquals($maliciousUserInput, $this->getStudentById(100));
        $this->assertEquals('\', 1, 1); DROP TABLE student; --', $this->getStudentById(100)['surname']);
    }

    private function getStudentsColumn($columnName)
    {
        $students = [];
        foreach (self::$pdo->query('SELECT * FROM student ORDER BY id') as $row) {
            $students[] = $row[$columnName];
        }

        return $students;
    }

    private function getStudentById($id)
    {
        return self::$pdo->query('SELECT s.name, s.surname, s.group_id, s.year_of_study FROM student AS s WHERE id=' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    private function benevolentUserInput()
    {
        return [
            'name' => 'Alice',
            'surname' => 'A.',
            'group_id' => 1,
            'year_of_study' => 1,
        ];
    }

    private function maliciousUserInput()
    {
        return [
            'name' => 'Oscar',
            'surname' => '\', 1, 1); DROP TABLE student; --',
            'group_id' => 1,
            'year_of_study' => 1,
        ];
    }

    public function tableExists($tableName)
    {
        try {
            $result = (bool)self::$pdo->query('SELECT 1 FROM ' . $tableName . ' LIMIT 1');
        } catch (\Exception $e) {
            return false;
        }

        return $result;
    }

    private static function setupInitialState()
    {
        $initialState = <<<SQL
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
SQL;

        self::$pdo->query($initialState);
    }
}
