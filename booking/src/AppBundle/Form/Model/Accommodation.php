<?php
namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Accommodation
{
	/**
     * @Assert\Length(
     *      min = 5,
     *      max = 20,
     *      minMessage = "Naziv mora sadržavati minimalno {{ limit }} znakova",
     *      maxMessage = "Naziv mora sadržavati maksimalno {{ limit }} znakova"
     * )
     * @AcmeAssert\ConstraintAccommodationName
     */
	public $name;

	public $category = 3;

	public $pricePerDay;

	public $place;
}