<?php

namespace Adriatic\PHPAkademija\Test\TestDouble;

use Adriatic\PHPAkademija\TestDouble\LoginService;
use Adriatic\PHPAkademija\TestDouble\ReservationService;
use PHPUnit\Framework\TestCase;

class StubTest extends TestCase
{
    /** @test */
    public function customerCanBookReservationOnlyIfLoggedIn()
    {
        $loginService = new LoginServiceStub();
        $loginService->setLoggedInCustomer(42);

        $reservationService = new ReservationService($loginService);
        $this->assertEquals('Smještaj 15 je bookiran', $reservationService->bookAccommodation(15, 42));
    }

    /** @test */
    public function customerCanBookReservationOnlyIfLoggedInUsingHardCodedTestStub()
    {
        $reservationService = new ReservationService(new AcceptingLoginServiceStub());
        $this->assertEquals('Smještaj 15 je bookiran', $reservationService->bookAccommodation(15, 42));
    }

}


class LoginServiceStub implements LoginService
{
    private $loggedInCustomer;

    public function setLoggedInCustomer(int $customerId)
    {
        $this->loggedInCustomer = $customerId;
    }

    public function isLoggedIn(int $customerId) : bool
    {
        return $this->loggedInCustomer === $customerId;
    }
}


class AcceptingLoginServiceStub implements LoginService
{
    public function isLoggedIn(int $customerId) : bool
    {
        return true;
    }
}
