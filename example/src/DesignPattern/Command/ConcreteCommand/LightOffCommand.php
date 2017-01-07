<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand;

use Adriatic\PHPAkademija\DesignPattern\Command\Command;
use Adriatic\PHPAkademija\DesignPattern\Command\Receiver\Light;

class LightOffCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->off();
    }
}
