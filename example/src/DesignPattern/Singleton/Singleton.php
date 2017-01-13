<?php

namespace Adriatic\PHPAkademija\DesignPattern\Singleton;

class Singleton
{
    static private $instance;

    private function __construct() {}

    public static function getInstance()
    {
        if(null === self::$instance)
            self::$instance = new self();

        return self::$instance;
    }

    public function __clone()
    {
        throw new \LogicException('Kloniranje Singleton objekta nije dopusteno.');
    }
}
