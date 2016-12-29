<?php
namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    public $street;
    public $postCode;
    public $place;
    public $county;
}
