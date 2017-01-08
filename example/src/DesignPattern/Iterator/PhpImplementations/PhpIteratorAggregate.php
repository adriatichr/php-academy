<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations;

class PhpIteratorAggregate implements Aggregate
{
    private $someArray;

    public function __construct(array $array)
    {
        $this->someArray = $array;
    }

    public function iterator() : \Iterator
    {
        return new PhpIterator($this->someArray);
    }
}
