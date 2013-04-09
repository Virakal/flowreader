<?php

namespace Flow\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chapter
 */
class Chapter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $chapter_no;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pages;

    /**
     * @var \Series
     */
    private $series;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set chapter_no
     *
     * @param integer $chapterNo
     * @return Chapter
     */
    public function setChapterNo($chapterNo)
    {
        $this->chapter_no = $chapterNo;
    
        return $this;
    }

    /**
     * Get chapter_no
     *
     * @return integer 
     */
    public function getChapterNo()
    {
        return $this->chapter_no;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Chapter
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
     * Set date
     *
     * @param \DateTime $date
     * @return Chapter
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add pages
     *
     * @param \Page $pages
     * @return Chapter
     */
    public function addPage(\Page $pages)
    {
        $this->pages[] = $pages;
    
        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Page $pages
     */
    public function removePage(\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set series
     *
     * @param \Series $series
     * @return Chapter
     */
    public function setSeries(\Series $series = null)
    {
        $this->series = $series;
    
        return $this;
    }

    /**
     * Get series
     *
     * @return \Series 
     */
    public function getSeries()
    {
        return $this->series;
    }
}
