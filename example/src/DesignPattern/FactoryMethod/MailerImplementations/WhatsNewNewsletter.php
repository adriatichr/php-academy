<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\Newsletter;

class WhatsNewNewsletter extends Newsletter
{
    public function getContent() : string
    {
        return $this->recipientName . ', novosti za tebe!';
    }
}
