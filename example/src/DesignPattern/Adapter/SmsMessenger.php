<?php

namespace Adriatic\PHPAkademija\DesignPattern\Adapter;

interface SmsMessenger
{
    public function send(string $message, string $number);
}
