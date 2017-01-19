<?php

namespace Agency\Domain\Model\Offer;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Agency\Infrastructure\Doctrine\AccommodationRepositoryImpl")
 * @ORM\HasLifecycleCallbacks koristi se za pokretanje određenih događaja svaki put kada entitet doživi neki lifecycle
 * event (npr. update ili flush). U našem slučaju ovo koristimo za ažuriranje modified datuma kod svake promjene podataka
 * u bazi.
 * @see self::updateModified()
 * @link http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html#lifecycle-callbacks
 */
class Accommodation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

    /** @ORM\Column(type="decimal") */
    private $pricePerDay;

    /** @ORM\Column(type="integer") */
    private $category;

    /** @ORM\Column(type="text") */
    private $description;

    /** @ORM\Column(type="datetime") */
    private $created;

    /** @ORM\Column(type="datetime") */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="Agency\Domain\Model\User\User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Agency\Domain\Model\Offer\Place", inversedBy="accommodations")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $place;

    public function __construct()
    {
        $this->created = new \DateTimeImmutable();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setCategory(int $category)
    {
        $this->category = $category;
    }

    public function setPricePerDay($pricePerDay)
    {
        $this->pricePerDay = $pricePerDay;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace(Place $place)
    {
        $this->place = $place;
    }

    public function getPricePerDay()
    {
        return $this->pricePerDay;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateModified()
    {
        $this->modified = new \DateTimeImmutable('now');
    }
}
