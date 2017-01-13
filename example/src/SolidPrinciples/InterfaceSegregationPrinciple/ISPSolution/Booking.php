<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\InterfaceSegregationPrinciple\ISPSolution;

interface Booking
{
    public function bookAccommodation(int $accommodationId, int $customerId);
}