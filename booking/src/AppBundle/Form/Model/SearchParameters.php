<?php
namespace AppBundle\Form\Model;

use AppBundle\Validator\Constraints as AcmeAssert;

/**
 * @AcmeAssert\ConstraintPrice
 */
class SearchParameters
{
	public $priceFrom;

	public $priceTo;

	public $place;
}