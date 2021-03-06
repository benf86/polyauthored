<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_users")
 * @ORM\Entity
 */
class User extends BaseUser
{    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var  string
     *
     * @ORM\Column(name="name")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\World\World", mappedBy="moderators", fetch="EAGER")
     */
    private $worldsModerating;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\World\World", mappedBy="owner", fetch="EAGER")
     */
    private $worldsOwning;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\World\WorldEntity", mappedBy="owner", fetch="EAGER")
     */
    private $entitiesOwning;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Story\Story", mappedBy="owner", fetch="EAGER")
     */
    private $storiesOwning;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Story\Post", mappedBy="owner", fetch="EAGER")
     */
    private $postsOwning;

    /**
     * @var integer
     * 
     * @ORM\Column(name="points", type="bigint", nullable=true)
     */
    private $points;

    /**
     * @var boolean
     *
     * @ORM\Column(name="shadowbanned", type="boolean", options={"default"=false})
     */
    private $shadowBanned;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\General\Comment", mappedBy="userParent", fetch="EAGER")
     */
    private $commentsReceived;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\General\Comment", mappedBy="author", fetch="EAGER")
     */
    private $commentsMade;

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
     * Set points
     *
     * @param integer $points
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Add worldsModerating
     *
     * @param \AppBundle\Entity\World\World $worldsModerating
     * @return User
     */
    public function addWorldsModerating(\AppBundle\Entity\World\World $worldsModerating)
    {
        $this->worldsModerating[] = $worldsModerating;

        return $this;
    }

    /**
     * Remove worldsModerating
     *
     * @param \AppBundle\Entity\World\World $worldsModerating
     */
    public function removeWorldsModerating(\AppBundle\Entity\World\World $worldsModerating)
    {
        $this->worldsModerating->removeElement($worldsModerating);
    }

    /**
     * Get worldsModerating
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWorldsModerating()
    {
        return $this->worldsModerating;
    }

    /**
     * Add worldsOwning
     *
     * @param \AppBundle\Entity\World\World $worldsOwning
     * @return User
     */
    public function addWorldsOwning(\AppBundle\Entity\World\World $worldsOwning)
    {
        $this->worldsOwning[] = $worldsOwning;

        return $this;
    }

    /**
     * Remove worldsOwning
     *
     * @param \AppBundle\Entity\World\World $worldsOwning
     */
    public function removeWorldsOwning(\AppBundle\Entity\World\World $worldsOwning)
    {
        $this->worldsOwning->removeElement($worldsOwning);
    }

    /**
     * Get worldsOwning
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWorldsOwning()
    {
        return $this->worldsOwning;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Add entitiesOwning
     *
     * @param \AppBundle\Entity\World\WorldEntity $entitiesOwning
     * @return User
     */
    public function addEntitiesOwning(\AppBundle\Entity\World\WorldEntity $entitiesOwning)
    {
        $this->entitiesOwning[] = $entitiesOwning;

        return $this;
    }

    /**
     * Remove entitiesOwning
     *
     * @param \AppBundle\Entity\World\WorldEntity $entitiesOwning
     */
    public function removeEntitiesOwning(\AppBundle\Entity\World\WorldEntity $entitiesOwning)
    {
        $this->entitiesOwning->removeElement($entitiesOwning);
    }

    /**
     * Get entitiesOwning
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntitiesOwning()
    {
        return $this->entitiesOwning;
    }

    /**
     * Set shadowBanned
     *
     * @param boolean $shadowBanned
     * @return User
     */
    public function setShadowBanned($shadowBanned)
    {
        $this->shadowBanned = $shadowBanned;

        return $this;
    }

    /**
     * Get shadowBanned
     *
     * @return boolean 
     */
    public function getShadowBanned()
    {
        return $this->shadowBanned;
    }

    /**
     * Add commentsReceived
     *
     * @param \AppBundle\Entity\General\Comment $commentsReceived
     * @return User
     */
    public function addCommentsReceived(\AppBundle\Entity\General\Comment $commentsReceived)
    {
        $this->commentsReceived[] = $commentsReceived;

        return $this;
    }

    /**
     * Remove commentsReceived
     *
     * @param \AppBundle\Entity\General\Comment $commentsReceived
     */
    public function removeCommentsReceived(\AppBundle\Entity\General\Comment $commentsReceived)
    {
        $this->commentsReceived->removeElement($commentsReceived);
    }

    /**
     * Get commentsReceived
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentsReceived()
    {
        return $this->commentsReceived;
    }

    /**
     * Add commentsMade
     *
     * @param \AppBundle\Entity\General\Comment $commentsMade
     * @return User
     */
    public function addCommentsMade(\AppBundle\Entity\General\Comment $commentsMade)
    {
        $this->commentsMade[] = $commentsMade;

        return $this;
    }

    /**
     * Remove commentsMade
     *
     * @param \AppBundle\Entity\General\Comment $commentsMade
     */
    public function removeCommentsMade(\AppBundle\Entity\General\Comment $commentsMade)
    {
        $this->commentsMade->removeElement($commentsMade);
    }

    /**
     * Get commentsMade
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentsMade()
    {
        return $this->commentsMade;
    }

    /**
     * Add storiesOwning
     *
     * @param \AppBundle\Entity\Story\Story $storiesOwning
     * @return User
     */
    public function addStoriesOwning(\AppBundle\Entity\Story\Story $storiesOwning)
    {
        $this->storiesOwning[] = $storiesOwning;

        return $this;
    }

    /**
     * Remove storiesOwning
     *
     * @param \AppBundle\Entity\Story\Story $storiesOwning
     */
    public function removeStoriesOwning(\AppBundle\Entity\Story\Story $storiesOwning)
    {
        $this->storiesOwning->removeElement($storiesOwning);
    }

    /**
     * Get storiesOwning
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStoriesOwning()
    {
        return $this->storiesOwning;
    }

    /**
     * Add postsOwning
     *
     * @param \AppBundle\Entity\Story\Post $postsOwning
     * @return User
     */
    public function addPostsOwning(\AppBundle\Entity\Story\Post $postsOwning)
    {
        $this->postsOwning[] = $postsOwning;

        return $this;
    }

    /**
     * Remove postsOwning
     *
     * @param \AppBundle\Entity\Story\Post $postsOwning
     */
    public function removePostsOwning(\AppBundle\Entity\Story\Post $postsOwning)
    {
        $this->postsOwning->removeElement($postsOwning);
    }

    /**
     * Get postsOwning
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostsOwning()
    {
        return $this->postsOwning;
    }
}
