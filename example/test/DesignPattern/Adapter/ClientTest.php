<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Adapter;

use Adriatic\PHPAkademija\DesignPattern\Adapter\VendorSmsMessenger;
use Adriatic\PHPAkademija\DesignPattern\Adapter\SmsMessengerAdapter;
use Adriatic\PHPAkademija\DesignPattern\Adapter\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function clientSendTheSms()
    {
        $vendorMessenger = new VendorSmsMessenger();
        $messengerAdapter = new SmsMessengerAdapter($vendorMessenger);
        $client = new Client($messengerAdapter);

        $this->expectOutputString('Poruka "Just FYI, stuff was done." je poslana na broj 0912345678.');
        $client->doSuffAndSendSms();
    }
}
