<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

interface State
{
    public function stop() : string;
    public function walk() : string;
    public function run() : string;
    public function jump() : string;
}
