<?php

use PHPUnit\Framework\TestCase;

class AutoloadingTest extends TestCase
{
    /** @test */
    public function createAWithoutInclude()
    {
        spl_autoload_register(function ($className) {
            if (strlen($className) === 1) {
                require __DIR__ . '/../../src/Autoloading/library/' . $className . '.php';
            }
        });

        $a = new A();
        $this->assertEquals('Something done!', $a->doSomething());

        $b = new B();
        $this->assertEquals('Did nothing.', $b->doNothing());
    }
}
