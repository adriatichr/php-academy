<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator;

class ConcreteIterator implements Iterator
{
    private $currentIndex;
    private $arrayToIterate;

    public function __construct(array $arrayToIterate)
    {
        $this->arrayToIterate = $arrayToIterate;
        $this->currentIndex = 0;
    }

    public function next()
    {
        return $this->arrayToIterate[$this->currentIndex++];
    }

    public function hasNext() : bool
    {
        return isset($this->arrayToIterate[$this->currentIndex]);
    }
}
