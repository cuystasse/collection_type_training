<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sailor
 *
 * @ORM\Table(name="sailor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SailorRepository")
 */
class Sailor
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Role")
     */
    private $role;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Boat", inversedBy="crew")
     */
    private $Boat;


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
     * @return Sailor
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
     * Set level
     *
     * @param integer $level
     *
     * @return Sailor
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return Sailor
     */
    public function setRole(\AppBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set boat
     *
     * @param \AppBundle\Entity\Boat $boat
     *
     * @return Sailor
     */
    public function setBoat(\AppBundle\Entity\Boat $boat = null)
    {
        $this->Boat = $boat;

        return $this;
    }

    /**
     * Get boat
     *
     * @return \AppBundle\Entity\Boat
     */
    public function getBoat()
    {
        return $this->Boat;
    }

    public function describe()
    {
        return 'Crew member :' . $this->getName() . ' (level:' . $this->getLevel() . ') [' . $this->getRole()->describe() .']';
    }
}
