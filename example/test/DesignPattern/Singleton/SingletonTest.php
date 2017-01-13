<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Singleton;

use Adriatic\PHPAkademija\DesignPattern\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    /** @test */
    public function singletonAlwaysSameInstance()
    {
        $singleton = Singleton::getInstance();
        $this->assertSame($singleton, Singleton::getInstance());
    }

    /** @test */
    public function cantCloneSingletonObject()
    {
        $singleton = Singleton::getInstance();
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Kloniranje Singleton objekta nije dopusteno.');
        $clonedSingleton = clone $singleton;
    }


}
