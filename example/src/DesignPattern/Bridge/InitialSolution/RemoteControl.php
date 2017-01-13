<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge\InitialSolution;

interface RemoteControl
{
    public function on();
    public function off();
    public function setChannel(int $channel);
}
