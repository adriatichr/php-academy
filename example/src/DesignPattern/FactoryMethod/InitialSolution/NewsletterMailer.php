<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod\InitialSolution;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\DiscountNewsletter;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\GiveawayNewsletter;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\WhatsNewNewsletter;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\Newsletter;

class NewsletterMailer
{
    public function send(string $recipientName, string $email, string $type)
    {
        if($type === 'discount')
            $newsletter = new DiscountNewsletter($recipientName);
        elseif($type === 'giveaway')
            $newsletter = new GiveawayNewsletter($recipientName);
        elseif($type === 'whats_new')
            $newsletter = new WhatsNewNewsletter($recipientName);
        else
            throw new \InvalidArgumentException('Nepodržani tip newslettera ' . $type);

        $newsletter->setSender('no-reply@adriatic.hr');
        $newsletter->setRecipient($email);

        $this->mailNewsletter($newsletter);
    }

    private function mailNewsletter(Newsletter $newsletter)
    {
        echo sprintf('Newsletter sa sadržajem "%s" je poslan na email %s sa adrese %s!<br />',
            $newsletter->getContent(),
            $newsletter->getRecipient(),
            $newsletter->getSender()
        );
    }
}
