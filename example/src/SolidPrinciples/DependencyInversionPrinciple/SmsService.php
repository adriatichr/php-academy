<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple;

class SmsService
{
    public function sendSms(string $phoneNumber, string $message)
    {
        echo sprintf('Poruka sadržaja "%s" poslana na %s', $message, $phoneNumber);
    }
}
