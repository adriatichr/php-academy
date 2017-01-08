<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Iterator;

use Adriatic\PHPAkademija\DesignPattern\Iterator\ConcreteAggregate;
use Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations\GeneratorAggregate;
use Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations\PhpIteratorAggregate;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase
{
    /** @test */
    public function iteratingUsingOurOwnIteratorInterface()
    {
        $aggregate = new ConcreteAggregate(['objekt 1', 'objekt 2', 'objekt 3?']);
        $iterator = $aggregate->iterator();

        $actualIteratedElements = [];
        while ($iterator->hasNext()) {
            $actualIteratedElements[] = $iterator->next();
        }

        $this->assertEquals(['objekt 1', 'objekt 2', 'objekt 3?'], $actualIteratedElements);
    }

    /** @test */
    public function iteratingUsingGenerator()
    {
        $aggregate = new GeneratorAggregate(['objekt 1', 'objekt 2', 'objekt 3?']);
        $this->assertEquals(['objekt 1', 'objekt 2', 'objekt 3?'],
            $this->getAllIteratorElements($aggregate->iterator()));
    }

    /** @test */
    public function iteratingUsingPhpIteratorInterface()
    {
        $aggregate = new PhpIteratorAggregate(['objekt 1', 'objekt 2', 'objekt 3?']);
        $this->assertEquals(['objekt 1', 'objekt 2', 'objekt 3?'],
            $this->getAllIteratorElements($aggregate->iterator()));
    }

    public function getAllIteratorElements(\Iterator $iterator) : array
    {
        $actualIteratedElements = [];
        foreach ($iterator as $value) {
            $actualIteratedElements[] = $value;
        }

        return $actualIteratedElements;
    }
}
