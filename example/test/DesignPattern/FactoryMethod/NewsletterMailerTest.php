<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\FactoryMethod;

use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\InitialSolution\NewsletterMailer as InitialNewsletterMailer;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\DiscountNewsletterMailer;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\GiveawayNewsletterMailer;
use Adriatic\PHPAkademija\DesignPattern\FactoryMethod\MailerImplementations\WhatsNewNewsletterMailer;
use PHPUnit\Framework\TestCase;

class NewsletterMailerTest extends TestCase
{
    /** @test */
    public function sendDiscountNewsletter()
    {
        $mailer = new DiscountNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, iskoristi popuste!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com');
    }

    /** @test */
    public function sendGiveawayNewsletter()
    {
        $mailer = new GiveawayNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, nagradna igra!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com');
    }

    /** @test */
    public function sendWhatsNewNewsletter()
    {
        $mailer = new WhatsNewNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, novosti za tebe!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com');
    }

    /** @test */
    public function lameSolutionForSendingDiscountNewsletters()
    {
        $mailer = new InitialNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, iskoristi popuste!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com', 'discount');
    }

    /** @test */
    public function lameInitialSolutionForSendingGiveawayNewsletters()
    {
        $mailer = new InitialNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, nagradna igra!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com', 'giveaway');
    }

    /** @test */
    public function lameInitialSolutionForSendingWhatsNewNewsletters()
    {
        $mailer = new InitialNewsletterMailer();
        $this->expectOutputString('Newsletter sa sadržajem "Mate Matić, novosti za tebe!" je poslan na email potencijalni.kupac@gmail.com sa adrese no-reply@adriatic.hr!<br />');
        $mailer->send('Mate Matić', 'potencijalni.kupac@gmail.com', 'whats_new');
    }
}
