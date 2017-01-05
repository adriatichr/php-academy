<?php

namespace Adriatic\PHPAkademija\DesignPattern\Adapter;

class SmsMessengerAdapter implements SmsMessenger
{
    private $vendorMessenger;

    public function __construct(VendorSmsMessenger $vendorMessenger)
    {
        $this->vendorMessenger = $vendorMessenger;
    }

    public function send(string $message, string $number)
    {
        $this->vendorMessenger->sendSms($number, $message);
    }
}
