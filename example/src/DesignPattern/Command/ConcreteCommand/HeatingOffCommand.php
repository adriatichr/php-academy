<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand;

use Adriatic\PHPAkademija\DesignPattern\Command\AirConOffCommand;

class HeatingOffCommand extends AirConOffCommand
{
    public function execute()
    {
        $this->airCon->heatingOff();
    }
}
