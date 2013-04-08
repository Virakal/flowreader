<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 */
class Page
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var integer
     */
    private $chapter_id;

    /**
     * @var integer
     */
    private $page_no;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var integer
     */
    private $width;


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
     * Set filename
     *
     * @param string $filename
     * @return Page
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    
        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set chapter_id
     *
     * @param integer $chapterId
     * @return Page
     */
    public function setChapterId($chapterId)
    {
        $this->chapter_id = $chapterId;
    
        return $this;
    }

    /**
     * Get chapter_id
     *
     * @return integer 
     */
    public function getChapterId()
    {
        return $this->chapter_id;
    }

    /**
     * Set page_no
     *
     * @param integer $pageNo
     * @return Page
     */
    public function setPageNo($pageNo)
    {
        $this->page_no = $pageNo;
    
        return $this;
    }

    /**
     * Get page_no
     *
     * @return integer 
     */
    public function getPageNo()
    {
        return $this->page_no;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Page
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Page
     */
    public function setWidth($width)
    {
        $this->width = $width;
    
        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }
    /**
     * @var \chapter
     */
    private $chapter;


    /**
     * Set chapter
     *
     * @param \chapter $chapter
     * @return Page
     */
    public function setChapter(\chapter $chapter = null)
    {
        $this->chapter = $chapter;
    
        return $this;
    }

    /**
     * Get chapter
     *
     * @return \chapter 
     */
    public function getChapter()
    {
        return $this->chapter;
    }
}