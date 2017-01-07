<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\Receiver;

class Light
{
    public function on()
    {
        echo "Uključeno svjetlo\n";
    }

    public function off()
    {
        echo "Isključeno svjetlo\n";
    }
}
