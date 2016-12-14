<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Accommodation", mappedBy="place")
     */
    private $accommodations;

    public function getName()
    {
        return $this->name;
    }

    public function getAccommodations()
    {
        return $this->accommodations;
    }
}
