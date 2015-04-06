<?php

namespace AppBundle\Entity\Story;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 */
class Post
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
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="string", length=255)
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\General\Comment", mappedBy="postParent", fetch="EAGER")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\General\Keyword", inversedBy="posts", fetch="EAGER")
     */
    private $keywords;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="postsOwning", fetch="EAGER")
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="Post", inversedBy="postParents", fetch="EAGER")
     */
    private $postChildren;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="postChildren", fetch="EAGER")
     */
    private $postParents;

    /**
     * @ORM\ManyToOne(targetEntity="Story", inversedBy="posts", fetch="EAGER")
     */
    private $story;

    public function __toString()
    {
        return $this->getTitle();
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
     * @return Post
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
     * Set content
     *
     * @param string $content
     * @return Post
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
     * Set synopsis
     *
     * @param string $synopsis
     * @return Post
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->keywords = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postChildren = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postParents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\General\Comment $comments
     * @return Post
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

    /**
     * Add keywords
     *
     * @param \AppBundle\Entity\General\Keyword $keywords
     * @return Post
     */
    public function addKeyword(\AppBundle\Entity\General\Keyword $keywords)
    {
        $this->keywords[] = $keywords;

        return $this;
    }

    /**
     * Remove keywords
     *
     * @param \AppBundle\Entity\General\Keyword $keywords
     */
    public function removeKeyword(\AppBundle\Entity\General\Keyword $keywords)
    {
        $this->keywords->removeElement($keywords);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User\User $owner
     * @return Post
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
     * Add postChildren
     *
     * @param \AppBundle\Entity\Story\Post $postChildren
     * @return Post
     */
    public function addPostChild(\AppBundle\Entity\Story\Post $postChildren)
    {
        $this->postChildren[] = $postChildren;

        return $this;
    }

    /**
     * Remove postChildren
     *
     * @param \AppBundle\Entity\Story\Post $postChildren
     */
    public function removePostChild(\AppBundle\Entity\Story\Post $postChildren)
    {
        $this->postChildren->removeElement($postChildren);
    }

    /**
     * Get postChildren
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostChildren()
    {
        return $this->postChildren;
    }

    /**
     * Add postParents
     *
     * @param \AppBundle\Entity\Story\Post $postParents
     * @return Post
     */
    public function addPostParent(\AppBundle\Entity\Story\Post $postParents)
    {
        $this->postParents[] = $postParents;

        return $this;
    }

    /**
     * Remove postParents
     *
     * @param \AppBundle\Entity\Story\Post $postParents
     */
    public function removePostParent(\AppBundle\Entity\Story\Post $postParents)
    {
        $this->postParents->removeElement($postParents);
    }

    /**
     * Get postParents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostParents()
    {
        return $this->postParents;
    }

    /**
     * Set story
     *
     * @param \AppBundle\Entity\Story\Story $story
     * @return Post
     */
    public function setStory(\AppBundle\Entity\Story\Story $story = null)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return \AppBundle\Entity\Story\Story 
     */
    public function getStory()
    {
        return $this->story;
    }
}
