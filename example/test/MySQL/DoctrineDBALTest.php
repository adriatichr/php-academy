<?php

use Adriatic\PHPAkademija\Test\MySQL\DatabaseTestCase;

class DoctrineDBALTest extends DatabaseTestCase
{
    private $conn;

    public function setUp()
    {
        parent::setUp();
        $this->conn = Db::createDoctrineDbalConnection();
    }

    /** @test */
    public function standardTransactionExample()
    {
        $this->conn->beginTransaction();
        try
        {
            $this->conn->createQueryBuilder()
                ->insert('`group`')
                ->values(['name' => '?'])
                ->setParameter(0, 'Fizika')
                ->execute();
            $this->conn->commit();
        }
        catch (\Exception $e)
        {
            $this->conn->rollback();
        }

        $this->assertNewGroupAdded('Fizika');
    }

    /** @test */
    public function transactionalExample()
    {
        $this->conn->transactional(function($conn) {
            $conn->createQueryBuilder()
                ->insert('`group`')
                ->values(['name' => '?'])
                ->setParameter(0, 'Fizika')
                ->execute();
        });

        $this->assertNewGroupAdded('Fizika');
    }

    /** @test */
    public function transactionalRollbacksAutomaticallyInCaseOfError()
    {
        try {
            /**
             * Ako dođe do greške unutar transactional metode, doctrine će za nas rollback-ati transakciju.
             */
            $this->conn->transactional(function($conn) {
                $conn->createQueryBuilder()
                    ->insert('`group`')
                    ->values(['name' => '?'])
                    ->setParameter(0, 'Fizika')
                    ->execute();

                throw new \Exception('Neka greška');
            });
        } catch (\Exception $e) {}

        $this->assertGroupNotAdded('Fizika');
    }

    private function assertNewGroupAdded($groupName)
    {
        $this->assertEquals($groupName,
            $this->conn->query('SELECT * FROM `group` WHERE name="' . $groupName . '"')->fetch(PDO::FETCH_ASSOC)['name']);
    }

    private function assertGroupNotAdded($groupName)
    {
        $this->assertNull($this->conn->query('SELECT * FROM `group` WHERE name="' . $groupName . '"')->fetch(PDO::FETCH_ASSOC)['name']);
    }
}
