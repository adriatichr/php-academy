<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

interface Driveable
{
    public function steerLeft();

    public function steerRight();

    public function driveForward();

    public function driveReverse();

    public function brake();
}
