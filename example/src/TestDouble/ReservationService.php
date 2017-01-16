<?php

namespace Adriatic\PHPAkademija\TestDouble;

class ReservationService
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function bookAccommodation(int $accommodationId, int $customerId) : string
    {
        if($this->loginService->isLoggedIn($customerId))
            return sprintf('Smještaj %s je bookiran', $accommodationId);
    }
}
