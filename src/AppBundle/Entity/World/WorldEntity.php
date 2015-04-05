<?php

namespace AppBundle\Entity\World;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorldEntity
 *
 * @ORM\Table(name="world_entities")
 * @ORM\Entity
 */
class WorldEntity
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", options={"default": false})
     */
    private $approved;

    /**
     * @ORM\ManyToOne(targetEntity="World", inversedBy="worldEntities", fetch="EAGER")
     */
    private $world;

    /**
     * @ORM\Column(name="name")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="entitiesOwning", fetch="EAGER")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\General\Comment", mappedBy="entityParent", fetch="EAGER")
     */
    private $comments;


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
     * Set type
     *
     * @param string $type
     * @return WorldEntity
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return WorldEntity
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return WorldEntity
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set world
     *
     * @param \AppBundle\Entity\World\World $world
     * @return WorldEntity
     */
    public function setWorld(\AppBundle\Entity\World\World $world = null)
    {
        $this->world = $world;

        return $this;
    }

    /**
     * Get world
     *
     * @return \AppBundle\Entity\World\World 
     */
    public function getWorld()
    {
        return $this->world;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WorldEntity
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
     * Set owner
     *
     * @param \AppBundle\Entity\User\User $owner
     * @return WorldEntity
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
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\General\Comment $comments
     * @return WorldEntity
     */
    public function addComment(\AppBundle\Entity\General\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\General\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\General\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
