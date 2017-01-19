<?php

namespace Agency\Domain\Model\Accounting;

use Agency\Domain\Model\Offer\Accommodation;
use Agency\Domain\Model\Order\Reservation;

class PaymentScheduleFactory
{
	const STANDARD_SMALL_AMOUNT_ORDER = 300;
    const STANDARD_SHORT_TERM_DAYS = 15;

	public function fromReservationAndAccommodation(
		Reservation $reservation,
		Accommodation $accommodation)
	{
		$paymentSchedule = new PaymentSchedule();
		$paymentSchedule->setReservation($reservation->getId());

		$days = $reservation->getEndDate()->diff($reservation->getStartDate())->format('%a');
        $pricePerDay = $accommodation->getPricePerDay();
        $totalPrice = $pricePerDay * $days;
        $reservationStart = $reservation->getStartDate();

        // Ako je pocetak termina nije prerano (za 15 dana)
        // i iznos nije premali (manji od 300)
        // gost placa u dva dijela (50/50)
        //

        // Granicno vrijeme - ako je vremenska tocka prije ovog vremena, uvjeti su normalni
        $shortTerm = clone $reservationStart;
        $shortTerm = $shortTerm->sub(new \DateInterval('P'.self::STANDARD_SHORT_TERM_DAYS.'D'));

         // Da li je dolazak gosta preblizu
        $isSortTerm = $shortTerm < new \DateTime();

        $isSmallAmount = $totalPrice < self::STANDARD_SMALL_AMOUNT_ORDER;

        if($isSortTerm || $isSmallAmount) {
            $ordinal = 0;
            $payment = new Payment($ordinal,new PayerType('AGENCY'));

            $paymentAmount = new PaymentAmount($totalPrice, 'EUR');
            $payment->addAmount($paymentAmount);

            $paymentDeadline = new PaymentDeadline(new PaymentDeadlineType('ON_CONFIRMATION'));
            $payment->setPaymentDeadline($paymentDeadline);

            $paymentSchedule->addPayment($payment);
        } else {
        	$halfTotalPrice = $totalPrice/2;

            $ordinal = 0;
            $payment = new Payment($ordinal,new PayerType('AGENCY'));

            $paymentAmount = new PaymentAmount($halfTotalPrice, 'EUR');
            $payment->addAmount($paymentAmount);

            $paymentDeadline = new PaymentDeadline(new PaymentDeadlineType('ON_CONFIRMATION'));
            $payment->setPaymentDeadline($paymentDeadline);

            $paymentSchedule->addPayment($payment);

            $ordinal = 1;
            $payment = new Payment($ordinal,new PayerType('PROVIDER'));

            $paymentAmount = new PaymentAmount($halfTotalPrice, 'EUR');
            $payment->addAmount($paymentAmount);

            $paymentDeadline = new PaymentDeadline(new PaymentDeadlineType('ON_DATE'));
            $deadlineDate = $reservationStart;
            $payment->setPaymentDeadline($paymentDeadline);

            $paymentSchedule->addPayment($payment);
        }

        return $paymentSchedule;
	}
}