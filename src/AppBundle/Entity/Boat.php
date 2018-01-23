<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boat
 *
 * @ORM\Table(name="boat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BoatRepository")
 */
class Boat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sailor", mappedBy="Boat")
     */
    private $crew;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Weapon", mappedBy="Boat", cascade={"persist"})
     */
    private $weapons;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Boat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->crew = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add crew
     *
     * @param \AppBundle\Entity\Sailor $crew
     *
     * @return Boat
     */
    public function addCrew(\AppBundle\Entity\Sailor $crew)
    {
        $this->crew[] = $crew;

        return $this;
    }

    /**
     * Remove crew
     *
     * @param \AppBundle\Entity\Sailor $crew
     */
    public function removeCrew(\AppBundle\Entity\Sailor $crew)
    {
        $this->crew->removeElement($crew);
    }

    /**
     * Get crew
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCrew()
    {
        return $this->crew;
    }

    /**
     * Add weapon
     *
     * @param \AppBundle\Entity\Weapon $weapon
     *
     * @return Boat
     */
    public function addWeapon(\AppBundle\Entity\Weapon $weapon)
    {
        $this->weapons[] = $weapon;

        return $this;
    }

    /**
     * Remove weapon
     *
     * @param \AppBundle\Entity\Weapon $weapon
     */
    public function removeWeapon(\AppBundle\Entity\Weapon $weapon)
    {
        $this->weapons->removeElement($weapon);
    }

    /**
     * Get weapons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWeapons()
    {
        return $this->weapons;
    }
}
