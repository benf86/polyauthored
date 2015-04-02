<?php

namespace AppBundle\Entity\General;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment
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
     * @var integer
     *
     * @ORM\Column(name="points", type="bigint")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\World\WorldEntity", inversedBy="comments")
     */
    private $entityParent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\World\World", inversedBy="comments")
     */
    private $worldParent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="commentsReceived")
     */
    private $userParent;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="children", fetch="EAGER")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parent", fetch="EAGER")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="commentsMade")
     */
    private $author;

    /**
     * @var  string
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->getId();
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
     * Set points
     *
     * @param integer $points
     * @return Comment
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
     * Set entityParent
     *
     * @param \AppBundle\Entity\World\WorldEntity $entityParent
     * @return Comment
     */
    public function setEntityParent(\AppBundle\Entity\World\WorldEntity $entityParent = null)
    {
        $this->entityParent = $entityParent;

        return $this;
    }

    /**
     * Get entityParent
     *
     * @return \AppBundle\Entity\World\WorldEntity 
     */
    public function getEntityParent()
    {
        return $this->entityParent;
    }

    /**
     * Set worldParent
     *
     * @param \AppBundle\Entity\World\World $worldParent
     * @return Comment
     */
    public function setWorldParent(\AppBundle\Entity\World\World $worldParent = null)
    {
        $this->worldParent = $worldParent;

        return $this;
    }

    /**
     * Get worldParent
     *
     * @return \AppBundle\Entity\World\World 
     */
    public function getWorldParent()
    {
        return $this->worldParent;
    }

    /**
     * Set userParent
     *
     * @param \AppBundle\Entity\User\User $userParent
     * @return Comment
     */
    public function setUserParent(\AppBundle\Entity\User\User $userParent = null)
    {
        $this->userParent = $userParent;

        return $this;
    }

    /**
     * Get userParent
     *
     * @return \AppBundle\Entity\User\User 
     */
    public function getUserParent()
    {
        return $this->userParent;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\General\Comment $parent
     * @return Comment
     */
    public function setParent(\AppBundle\Entity\General\Comment $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\General\Comment 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \AppBundle\Entity\General\Comment $children
     * @return Comment
     */
    public function addChild(\AppBundle\Entity\General\Comment $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \AppBundle\Entity\General\Comment $children
     */
    public function removeChild(\AppBundle\Entity\General\Comment $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User\User $author
     * @return Comment
     */
    public function setAuthor(\AppBundle\Entity\User\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
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
}