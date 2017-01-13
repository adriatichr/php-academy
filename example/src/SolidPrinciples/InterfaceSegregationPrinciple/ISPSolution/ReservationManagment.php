<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\InterfaceSegregationPrinciple\ISPSolution;

interface ReservationManagment
{
    public function acceptReservation(int $reservationId);
    public function refuseReservation(int $reservationId);
}