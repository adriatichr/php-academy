<?php

namespace Adriatic\PHPAkademija\DesignPattern\Observer;

class DepartmentHead implements Subject
{
    private $observers = [];

    private $atWork = false;

    public function add(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function remove(Observer $observer)
    {
        $index = array_search($observer, $this->observers);

        if(false !== $index)
            unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function setAtWork(bool $atWork)
    {
        $this->atWork = $atWork;
        $this->notify();
    }

    public function isAtWork() : bool
    {
        return $this->atWork;
    }
}
