<?php

namespace AppBundle\Entity\Story;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table(name="stories")
 * @ORM\Entity
 */
class Story
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\World\World", inversedBy="stories", fetch="EAGER")
     */
    private $world;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="story", fetch="EAGER")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\General\Comment", mappedBy="worldParent", fetch="EAGER")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\General\Keyword", inversedBy="stories", fetch="EAGER")
     */
    private $keywords;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="storiesOwning", fetch="EAGER")
     */
    private $owner;

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
     * @return Story:Story
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
     * Set title
     *
     * @param string $title
     * @return Story:Story
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
     * Set content
     *
     * @param string $content
     * @return Story:Story
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
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->keywords = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set world
     *
     * @param \AppBundle\Entity\World\World $world
     * @return Story
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
     * Add posts
     *
     * @param \AppBundle\Entity\Story\Post $posts
     * @return Story
     */
    public function addPost(\AppBundle\Entity\Story\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \AppBundle\Entity\Story\Post $posts
     */
    public function removePost(\AppBundle\Entity\Story\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\General\Comment $comments
     * @return Story
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
     * @return Story
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
     * @return Story
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
}
