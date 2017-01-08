<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator;

class ConcreteAggregate implements Aggregate
{
    private $someArray;

    public function __construct(array $array)
    {
        $this->someArray = $array;
    }

    public function iterator() : Iterator
    {
        return new ConcreteIterator($this->someArray);
    }
}
