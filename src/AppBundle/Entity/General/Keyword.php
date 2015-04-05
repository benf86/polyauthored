<?php

namespace AppBundle\Entity\General;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 *
 * @ORM\Table(name="keywords")
 * @ORM\Entity
 */
class Keyword
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
     * @ORM\Column(name="keyword", type="string", length=255)
     */
    private $keyword;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Story\Story", mappedBy="keywords", fetch="EAGER")
     */
    private $stories;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Story\Post", mappedBy="keywords", fetch="EAGER")
     */
    private $posts;


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
     * Set keyword
     *
     * @param string $keyword
     * @return Keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stories
     *
     * @param \AppBundle\Entity\Story\Story $stories
     * @return Keyword
     */
    public function addStory(\AppBundle\Entity\Story\Story $stories)
    {
        $this->stories[] = $stories;

        return $this;
    }

    /**
     * Remove stories
     *
     * @param \AppBundle\Entity\Story\Story $stories
     */
    public function removeStory(\AppBundle\Entity\Story\Story $stories)
    {
        $this->stories->removeElement($stories);
    }

    /**
     * Get stories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStories()
    {
        return $this->stories;
    }

    /**
     * Add posts
     *
     * @param \AppBundle\Entity\Story\Post $posts
     * @return Keyword
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
}
