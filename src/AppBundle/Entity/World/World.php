<?php

namespace AppBundle\Entity\World;

use Doctrine\ORM\Mapping as ORM;

/**
 * World:World
 *
 * @ORM\Table(name="worlds")
 * @ORM\Entity
 */
class World
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User\User", inversedBy="worldsModerating", fetch="EAGER")
     */
    private $moderators;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="worldsOwning", fetch="EAGER")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="name")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="WorldEntity", mappedBy="world", fetch="EAGER")
     */
    private $worldEntities;


    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moderators = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add moderators
     *
     * @param \AppBundle\Entity\User\User $moderators
     * @return World
     */
    public function addModerator(\AppBundle\Entity\User\User $moderators)
    {
        $this->moderators[] = $moderators;

        return $this;
    }

    /**
     * Remove moderators
     *
     * @param \AppBundle\Entity\User\User $moderators
     */
    public function removeModerator(\AppBundle\Entity\User\User $moderators)
    {
        $this->moderators->removeElement($moderators);
    }

    /**
     * Get moderators
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModerators()
    {
        return $this->moderators;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User\User $owner
     * @return World
     */
    public function setOwner(\AppBundle\Entity\User\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return World
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
     * Set description
     *
     * @param string $description
     * @return World
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add worldEntities
     *
     * @param \AppBundle\Entity\World\WorldEntity $worldEntities
     * @return World
     */
    public function addWorldEntity(\AppBundle\Entity\World\WorldEntity $worldEntities)
    {
        $this->worldEntities[] = $worldEntities;

        return $this;
    }

    /**
     * Remove worldEntities
     *
     * @param \AppBundle\Entity\World\WorldEntity $worldEntities
     */
    public function removeWorldEntity(\AppBundle\Entity\World\WorldEntity $worldEntities)
    {
        $this->worldEntities->removeElement($worldEntities);
    }

    /**
     * Get worldEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWorldEntities()
    {
        return $this->worldEntities;
    }
}
