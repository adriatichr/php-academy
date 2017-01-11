<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple;

interface ReservationManagment
{
    public function acceptReservation(int $reservationId);
    public function refuseReservation(int $reservationId);
}