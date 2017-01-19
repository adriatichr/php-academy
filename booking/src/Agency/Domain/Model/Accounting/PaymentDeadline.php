<?php

namespace Agency\Domain\Model\Accounting;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_deadline")
 */
class PaymentDeadline
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

     /**
     * Vrsta roka dospijeca.
     *
     * @var PaymentDeadlineType
     * @ORM\Column(name="deadline_type", type="string")
     */
    private $deadlineType;

    /**
     * Vrijeme roka.
     *
     * @var DateTime
     * @ORM\Column(name="deadline_time", type="datetime", nullable=true)
     */
    private $deadlineTime;

    /**
     * Instancira rok placanja.
     *
     * @param PaymentDeadlineType $paymentDeadlineType
     */
    public function __construct(PaymentDeadlineType $deadlineType)
    {
        $this->deadlineType = $deadlineType;
    }

    /**
     * Postavlja vrstu roka placanja.
     *
     * @param PaymentDeadlineType $deadlineType
     *
     * @return PaymentDeadline
     */
    public function setDeadlineType(PaymentDeadlineType $deadlineType)
    {
        $this->deadlineType = $deadlineType;

        return $this;
    }

    /**
     * Postavlja vrijeme roka placanja.
     *
     * @param DateTime $deadlineTime
     *
     * @return PaymentDeadline
     */
    public function setDeadlineTime(\DateTimeImmutable $deadlineTime)
    {
        $this->deadlineTime = $deadlineTime;

        return $this;
    }
}

