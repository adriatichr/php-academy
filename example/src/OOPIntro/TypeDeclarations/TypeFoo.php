<?php

namespace Adriatic\PHPAkademija\OOPIntro\TypeDeclarations;

class TypeFoo
{
    public function sum($a, $b)
    {
        return $a + $b;
    }

    public function sumStrict(int $a, int $b)
    {
        return $a + $b;
    }

    public function implicitIntegerConversion(int $a)
    {
        return $a;
    }

    public function implicitStringConversion(string $a)
    {
        return $a;
    }

    public function implicitFloatConversion(float $a)
    {
        return $a;
    }

    public function implicitBoolConversion(bool $a)
    {
        return $a;
    }
}
