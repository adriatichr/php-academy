<?php

namespace Adriatic\PHPAkademija\DesignPattern\Observer;

interface Subject
{
    public function add(Observer $observer);
    public function remove(Observer $observer);
    public function notify();
}
