<?php

namespace Adriatic\PHPAkademija\Test\MySQL;

use Adriatic\PHPAkademija\Test\MySQL\InitialState;
use Db;
use PHPUnit\Framework\TestCase;

class DatabaseTestCase extends TestCase
{
    protected static $pdo;
    private static $pdoNotFound = false;
    private static $pdoNotFoundFailMessage = '';

    public static function setUpBeforeClass()
    {
        try {
            self::$pdo = Db::createPDO();
        } catch (\PDOException $e) {
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
        InitialState::setup(self::$pdo);
    }
}
