<?php

namespace Adriatic\PHPAkademija\DesignPattern\Adapter;

/**
 * Predstavlja 3rd Party library za slanje SMS-ova iz vendor direktorija. Mi ne smijemo mijenjati ovu klasu.
 */
class VendorSmsMessenger
{
    public function sendSms(string $phone, string $message)
    {
        echo sprintf('Poruka "%s" je poslana na broj %s.', $message, $phone);
    }
}
