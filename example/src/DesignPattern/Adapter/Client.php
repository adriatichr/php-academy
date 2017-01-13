<?php

namespace Adriatic\PHPAkademija\DesignPattern\Adapter;

class Client
{
    private $messenger;

    public function __construct(SmsMessenger $messenger)
    {
        $this->messenger = $messenger;
    }

    public function doSuffAndSendSms()
    {
        // doing some stuff ...

        $this->messenger->send('Just FYI, stuff was done.', '0912345678');
    }
}
