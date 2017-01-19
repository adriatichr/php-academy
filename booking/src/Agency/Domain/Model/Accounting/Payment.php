<?php

namespace Agency\Domain\Model\Accounting;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment")
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * PaymentSchedule kojem pripada Payment.
     *
     * @var PaymentSchedule
     * @ORM\ManyToOne(targetEntity="PaymentSchedule", inversedBy="payments")
     * @ORM\JoinColumn(name="payment_schedule_id", referencedColumnName="id")
     */
    protected $paymentSchedule;

    /**
     * Redni broj placanja.
     *
     * @var int
     * @ORM\Column(name="ordinal", type="integer")
     */
    protected $ordinal;

    /**
     * Tko prima placanje.
     *
     * @var PayerType
     * @ORM\Column(name="payment_to", type="string")
     */
    protected $to;

    /**
     * Iznos placanja.
     *
     * @var PaymentAmount[]
     * @ORM\OneToMany(targetEntity="PaymentAmount", mappedBy="payment", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $amounts;

    /**
     * Rok plaćanja.
     *
     * @var PaymentDeadline
     * @ORM\OneToOne(targetEntity="PaymentDeadline", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="deadline_id")
     */
    private $deadline;

    public function __construct($ordinal, PayerType $to)
    {
        $this->ordinal = $ordinal;
        $this->to = $to->name();
        $this->amounts = new ArrayCollection();
    }

    /**
     * Postavlja PaymentSchedule kojem pripada Payment.
     *
     * @param PaymentSchedule $paymentSchedule
     *
     * @return BasePayment
     */
    public function setPaymentSchedule(PaymentSchedule $paymentSchedule)
    {
        $this->paymentSchedule = $paymentSchedule;

        return $this;
    }

    /**
     * Postavlja rok placanja.
     *
     * @param PaymentDeadline $paymentDeadline rok placanja
     *
     * @return BasePayment
     */
    public function setPaymentDeadline(PaymentDeadline $paymentDeadline)
    {
        $this->deadline = $paymentDeadline;

        return $this;
    }

    /**
     * Dodaje iznos placanja.
     *
     * @param PaymentAmount $paymentAmount Iznos placanja
     *
     * @return BasePayment
     */
    public function addAmount(PaymentAmount $paymentAmount)
    {
        $paymentAmount->setPayment($this);
        $this->amounts->add($paymentAmount);
        return $this;
    }

    /**
     * Dohvaća iznose placanja.
     *
     * @return PaymentAmount[] iznos placanja
     */
    public function getAmounts()
    {
        return $this->amounts;
    }

}

