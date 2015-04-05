<?php

namespace AppBundle\Entity\General;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comments")
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
     * @ORM\Column(name="points", type="bigint", nullable=true)
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\World\WorldEntity", inversedBy="comments", fetch="EAGER")
     */
    private $entityParent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\World\World", inversedBy="comments", fetch="EAGER")
     */
    private $worldParent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Story\Post", inversedBy="comments", fetch="EAGER")
     */
    private $postParent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="commentsReceived", fetch="EAGER")
     */
    private $userParent;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="commentChildren", fetch="EAGER")
     */
    private $commentParent;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="commentParent", fetch="EAGER")
     */
    private $commentChildren;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="commentsMade", fetch="EAGER")
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

    /**
     * Set postParent
     *
     * @param \AppBundle\Entity\Story\Post $postParent
     * @return Comment
     */
    public function setPostParent(\AppBundle\Entity\Story\Post $postParent = null)
    {
        $this->postParent = $postParent;

        return $this;
    }

    /**
     * Get postParent
     *
     * @return \AppBundle\Entity\Story\Post 
     */
    public function getPostParent()
    {
        return $this->postParent;
    }

    /**
     * Set commentParent
     *
     * @param \AppBundle\Entity\General\Comment $commentParent
     * @return Comment
     */
    public function setCommentParent(\AppBundle\Entity\General\Comment $commentParent = null)
    {
        $this->commentParent = $commentParent;

        return $this;
    }

    /**
     * Get commentParent
     *
     * @return \AppBundle\Entity\General\Comment 
     */
    public function getCommentParent()
    {
        return $this->commentParent;
    }

    /**
     * Add commentChildren
     *
     * @param \AppBundle\Entity\General\Comment $commentChildren
     * @return Comment
     */
    public function addCommentChild(\AppBundle\Entity\General\Comment $commentChildren)
    {
        $this->commentChildren[] = $commentChildren;

        return $this;
    }

    /**
     * Remove commentChildren
     *
     * @param \AppBundle\Entity\General\Comment $commentChildren
     */
    public function removeCommentChild(\AppBundle\Entity\General\Comment $commentChildren)
    {
        $this->commentChildren->removeElement($commentChildren);
    }

    /**
     * Get commentChildren
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentChildren()
    {
        return $this->commentChildren;
    }
}
