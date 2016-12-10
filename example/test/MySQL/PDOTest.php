<?php

use Adriatic\PHPAkademija\Test\MySQL\DatabaseTestCase;

class PDOTest extends DatabaseTestCase
{
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

}
