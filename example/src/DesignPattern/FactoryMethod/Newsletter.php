<?php

namespace Adriatic\PHPAkademija\DesignPattern\FactoryMethod;

abstract class Newsletter
{
    protected $recipientName;
    private $sender;
    private $recipient;

    public function __construct(string $recipientName)
    {
        $this->recipientName = $recipientName;
    }

    abstract public function getContent() : string;

    public function setSender(string $email)
    {
        $this->sender = $email;
    }

    public function setRecipient(string $email)
    {
        $this->recipient = $email;
    }

    public function getRecipient() : string
    {
        return $this->recipient;
    }

    public function getSender() : string
    {
        return $this->sender;
    }
}
