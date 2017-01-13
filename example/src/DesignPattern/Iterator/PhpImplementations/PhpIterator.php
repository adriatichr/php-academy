<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations;

class PhpIterator implements \Iterator
{
    private $currentIndex;
    private $arrayToIterate;

    public function __construct(array $arrayToIterate)
    {
        $this->arrayToIterate = $arrayToIterate;
        $this->currentIndex = 0;
    }

    public function current()
    {
        return $this->arrayToIterate[$this->currentIndex];
    }

    public function key()
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid() : bool
    {
        return isset($this->arrayToIterate[$this->currentIndex]);
    }
}
