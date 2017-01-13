<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations;

class GeneratorAggregate implements Aggregate
{
    private $someArray;

    public function __construct(array $array)
    {
        $this->someArray = $array;
    }

    public function iterator() : \Iterator
    {
        yield from $this->someArray;
    }
}
