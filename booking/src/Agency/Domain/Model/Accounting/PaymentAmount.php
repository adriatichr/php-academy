<?php

namespace Agency\Domain\Model\Accounting;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PaymentAmount
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="Payment", inversedBy="paymentAmounts")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     */
    private $payment;

    /**
     * Iznos.
     *
     * @var float
     * @ORM\Column(name="amount_value", type="decimal", scale=2, nullable=true)
     */
    private $amountValue;

    /**
     * Oznaka valute.
     *
     * @var string
     * @ORM\Column(name="amount_currency", type="string", length=3, nullable=true)
     */
    private $amountCurrency;

    /**
     * Instancira iznos placanja.
     *
     * @param float $amountValue
     * @param string $amountCurrency
     */
    public function __construct($amountValue, $amountCurrency)
    {
        $this->amountValue = is_int($amountValue) ? $amountValue : round((float) $amountValue, 2);
        $this->amountCurrency = $amountCurrency;
    }

    /**
     * Dohvaća iznos.
     *
     * @return int|float
     */
    public function getAmount()
    {
        return (float) $this->amountValue;
    }

    /**
     * Postavlja Payment kojem pripada PaymentAmount.
     *
     * @param Payment $payment placanje kojem pripada ovaj iznos
     *
     * @return PaymentAmount
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Postavlja iznos.
     *
     * @param int|float
     *
     * @return PaymentAmount
     */
    public function setAmount($value)
    {
        $this->amountValue = $value;

        return $this;
    }

}

