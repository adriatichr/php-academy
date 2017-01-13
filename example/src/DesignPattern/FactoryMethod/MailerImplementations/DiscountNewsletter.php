<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\Newsletter;

class DiscountNewsletter extends Newsletter
{
    public function getContent() : string
    {
        return $this->recipientName . ', iskoristi popuste!';
    }
}
