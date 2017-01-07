<?php

namespace Adriatic\PHPAkademija\DesignPattern\Observer;

class DepartmentEmployee implements Observer
{
    private $state;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function update(Subject $subject)
    {
        if($subject->isAtWork()) {
            $this->backToWork();
        } else {
            $this->partyTime();
        }
    }

    public function getState()
    {
        return $this->state;
    }

    private function backToWork()
    {
        $this->state = 'I am working';
    }

    private function partyTime()
    {
        $this->state = 'To the party room!';
    }
}
