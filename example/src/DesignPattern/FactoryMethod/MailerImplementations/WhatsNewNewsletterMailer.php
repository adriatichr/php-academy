<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\NewsletterMailer;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\Newsletter;

class WhatsNewNewsletterMailer extends NewsletterMailer
{
    protected function createNewsletter(string $recipientName) : Newsletter
    {
        return new WhatsNewNewsletter($recipientName);
    }
}
