<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand;

use Adriatic\PHPAkademija\DesignPattern\Command\AirConOnCommand;

class HeatingOnCommand extends AirConOnCommand
{
    public function execute()
    {
        $this->airCon->heatingOn($this->temp);
    }
}
