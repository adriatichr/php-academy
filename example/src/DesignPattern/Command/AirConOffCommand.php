<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command;

use Adriatic\PHPAkademija\DesignPattern\Command\Command;
use Adriatic\PHPAkademija\DesignPattern\Command\Receiver\AirCon;

abstract class AirConOffCommand implements Command
{
    protected $airCon;

    public function __construct(AirCon $airCon)
    {
        $this->airCon = $airCon;
    }
}
