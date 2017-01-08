<?php

namespace Adriatic\PHPAkademija\DesignPattern\Iterator;

interface Iterator
{
    public function next();
    public function hasNext() : bool;
}
