<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge;

interface Tv
{
    public function on();
    public function off();
    public function tuneChannel(int $channel);
}
