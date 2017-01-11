<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple;

interface Booking
{
    public function bookAccommodation(int $accommodationId, int $customerId);
}