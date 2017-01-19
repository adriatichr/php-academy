<?php

namespace Agency\Domain\Model\Accounting;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="payment_schedule")
 */
class PaymentSchedule
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="integer") */
    private $reservation;

    /** @ORM\OneToMany(targetEntity="Payment", mappedBy="paymentSchedule", cascade={"persist", "remove"}, orphanRemoval=true) */
    private $payments;

    public function __construct()
    {
        $this->reservation = null;
        $this->payments = new ArrayCollection();
    }

    /**
     * Postavlja rezervaciju kojoj pripada PaymentSchedule.
     *
     * @param int $reservation
     *
     * @return PaymentSchedule
     */
    public function setReservation(int $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

     /**
     * Dodaje placanje.
     *
     * @param Payment $payment Placanje
     *
     * @return PaymentSchedule
     */
    public function addPayment(Payment $payment)
    {
        $payment->setPaymentSchedule($this);
        $this->payments->add($payment);
        return $this;
    }

    /**
     * Vraca placanja.
     *
     * @return iterable<BasePayment>
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Vraca prvo placanje gosta agenciji.
     *
     * @return BasePayment|null
     */
    public function getFirstGuestToAgencyPayment()
    {
        return $this->getGuestToAgencyPaymentByOrdinal(0);
    }

    /**
     * Vraca placanje gosta agenciji za trazeni redni broj.
     *
     * @parm int $ordinal
     *
     * @return BasePayment|null
     */
    public function getGuestToAgencyPaymentByOrdinal($ordinal)
    {
        if ($this->payments) {
            foreach ($this->payments as $payment) {
                if ($payment->getPayee()->isAgency() &&
                $payment->getOrdinal() == $ordinal) {
                    return $payment;
                }
            }
        }

        return null;
    }

}