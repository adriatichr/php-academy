<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand;

use Adriatic\PHPAkademija\DesignPattern\Command\AirConOnCommand;

class CoolingOnCommand extends AirConOnCommand
{
    public function execute()
    {
        $this->airCon->coolingOn($this->temp);
    }
}
