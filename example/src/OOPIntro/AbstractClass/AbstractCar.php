<?php

namespace Adriatic\PHPAkademija\OOPIntro\AbstractClass;

abstract class AbstractCar
{
    abstract public function driveForward();

    public function steer($direction)
    {
        if ('left' === $direction) {
            return 'Skrećem lijevo';
        }

        if ('right' === $direction) {
            return 'Skrećem desno';
        }
    }
}
