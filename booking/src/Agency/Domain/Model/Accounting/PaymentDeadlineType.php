<?php

namespace Agency\Domain\Model\Accounting;

class PaymentDeadlineType
{
    /**
     * Naziv trenutačne opcije
     *
     * @var string
     */
    private $name;

    /**
     * @param string $name Naziv opcije
     * @throws InvalidArgumentException Ako zadana opcije nije ispravna
     */
    public function __construct($name)
    {
        if (!in_array((string)$name, static::names()))
            throw new InvalidArgumentException(
                sprintf('Opcija "%s" nije podržana u "%s"', (string)$name, get_class($this)));
        $this->name = (string)$name;
    }

    public function __toString()
    {
        return $this->name();
    }

    /**
     * Dohvaća naziv
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Je li trenutačna opcija jednaka zadanoj
     *
     * @param self|string $other Opcija ili naziv opcije (ako nije opcija, vrši se pretvaranje u string)
     * @return bool
     */
    public function equals($other)
    {
        $otherName = $other instanceof static ? $other->name : (string)$other;
        return $this->name == $otherName;
    }

     /**
     * Provjerava radi li se o placanju po potvrdi.
     *
     * @return bool
     */
    public function isOnConfirmation()
    {
        return $this->equals('ON_CONFIRMATION');
    }

    /**
     * Provjerava radi li se o placanju do odredenog vremena.
     *
     * @return bool
     */
    public function isUntilTime()
    {
        return $this->equals('UNTIL_TIME');
    }

    /**
     * Provjerava radi li se o placanju na odreden dan.
     *
     * @return bool
     */
    public function isOnDate()
    {
        return $this->equals('ON_DATE');
    }

    protected static function names()
    {
        return [
            'ON_CONFIRMATION', // 24 sata po potvrdi raspolozivosti
            'UNTIL_TIME', // do odredenog vremena
            'ON_DATE', // na odreden dan
            ];
    }
}

