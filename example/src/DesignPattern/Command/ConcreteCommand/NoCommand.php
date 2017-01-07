<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand;

use Adriatic\PHPAkademija\DesignPattern\Command\Command;

class NoCommand implements Command
{
    public function execute()
    {
        // Do nothing
    }
}
