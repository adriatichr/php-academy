<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command;

use Adriatic\PHPAkademija\DesignPattern\Command\Command;
use Adriatic\PHPAkademija\DesignPattern\Command\Receiver\AirCon;

abstract class AirConOnCommand implements Command
{
    protected $airCon;
    protected $temp;

    public function __construct(AirCon $airCon, $temp)
    {
        $this->airCon = $airCon;
        $this->temp = $temp;
    }
}
