<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator;

interface Aggregate
{
    public function iterator() : Iterator;
}
