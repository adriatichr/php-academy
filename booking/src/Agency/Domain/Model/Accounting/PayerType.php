<?php

namespace Agency\Domain\Model\Accounting;

/**
 * Vrste platitelja ili primatelja uplate.
 */
class PayerType
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
     * Provjerava radi li se o agenciji.
     *
     * @return bool
     */
    public function isAgency()
    {
        return $this->equals('AGENCY');
    }

    /**
     * Provjerava radi li se o iznajmljivaču.
     *
     * @return bool
     */
    public function isProvider()
    {
        return $this->equals('PROVIDER');
    }

    protected static function names()
    {
        return [
            'AGENCY', // adriatic.hr
            'PROVIDER', // iznajmljivač
            ];
    }
}
