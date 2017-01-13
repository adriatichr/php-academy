<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\Newsletter;

class GiveawayNewsletter extends Newsletter
{
    public function getContent() : string
    {
        return $this->recipientName . ', nagradna igra!';
    }
}
