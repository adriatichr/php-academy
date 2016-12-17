<?php
namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;


class User
{
	/**
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Ime mora sadržavati minimalno {{ limit }} slova",
     *      maxMessage = "Ime mora sadržavati maksimalno {{ limit }} slova",
     *      groups={"tekst"}
     * )
     * @Assert\Range(
     *      min = 120,
     *      max = 180,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter",
     *      groups={"broj"}
     * )
     */
	public $firstname;
	public $lastname;
	public $age;
	public $gender;
	public $doner = true;
	public $addressHome;
	public $addressWork;
	/**
	 * @var string[]
	 */
	public $phones = [null, null, null, null, null, null];

	public function __construct()
	{
		$this->addressHome = new Address();
		$this->addressWork = new Address();
	}
}