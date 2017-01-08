<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator\PhpImplementations;

interface Aggregate
{
    public function iterator() : \Iterator;
}
