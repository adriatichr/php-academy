<?php

namespace Adriatic\PHPAkademija\Test\SolidPrinciples\DependencyInversionPrinciple;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\ReservationServiceImpl;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\SmsProviderNotifier;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\InitialSolution\ReservationServiceImpl as InitialReservationServiceImpl;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\SmsService;
use PHPUnit\Framework\TestCase;

class DIPTest extends TestCase
{
    public function setUp()
    {
        $this->initialReservationService = new InitialReservationServiceImpl();
        $this->reservationServiceWithDip = new ReservationServiceImpl(new SmsProviderNotifier(new SmsService()));
    }

    /** @test */
    public function bookingAccommodationShouldSendSMSToProvider()
    {
        $this->expectOutputString('Poruka sadržaja "Prihvaćate li rezervaciju smještaja?" poslana na 091 234 5678');
        $this->initialReservationService->bookAccommodation(1, 42);
    }

    /** @test */
    public function bookingAccommodationShouldSendSMSToProviderImplementationUsingDIP()
    {
        $this->expectOutputString('Poruka sadržaja "Prihvaćate li rezervaciju smještaja?" poslana na 091 234 5678');
        $this->reservationServiceWithDip->bookAccommodation(1, 42);
    }
}
