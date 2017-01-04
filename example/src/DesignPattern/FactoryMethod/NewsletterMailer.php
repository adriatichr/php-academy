<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod;

abstract class NewsletterMailer
{
    public function send(string $recipientName, string $email)
    {
        $newsletter = $this->createNewsletter($recipientName);
        $newsletter->setSender('no-reply@adriatic.hr');
        $newsletter->setRecipient($email);

        $this->mailNewsletter($newsletter);
    }

    abstract protected function createNewsletter(string $recipientName) : Newsletter;

    private function mailNewsletter(Newsletter $newsletter)
    {
        echo sprintf(
            'Newsletter sa sadržajem "%s" je poslan na email %s sa adrese %s!<br />',
            $newsletter->getContent(),
            $newsletter->getRecipient(),
            $newsletter->getSender()
        );
    }
}
