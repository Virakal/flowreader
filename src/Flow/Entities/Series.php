<?php

namespace Flow\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 */
class Series
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $chapters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chapters = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Series
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
     * Add chapters
     *
     * @param \Chapter $chapters
     * @return Series
     */
    public function addChapter(\Chapter $chapters)
    {
        $this->chapters[] = $chapters;
    
        return $this;
    }

    /**
     * Remove chapters
     *
     * @param \Chapter $chapters
     */
    public function removeChapter(\Chapter $chapters)
    {
        $this->chapters->removeElement($chapters);
    }

    /**
     * Get chapters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChapters()
    {
        return $this->chapters;
    }
}
