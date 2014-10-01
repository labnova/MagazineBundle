<?php

namespace Lynda\MagazineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Issue
 *
 * @ORM\Table(name="issues")
 * @ORM\Entity(repositoryClass="Lynda\MagazineBundle\Entity\IssueRepository")
 */
class Issue
{   
    /*
     * @var Publication
     * 
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="issues")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     * 
     * 
     */
    
    
    private $publication;
    
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
     * @ORM\Column(name="number", type="integer")
     * 
     * @Assert\Range(
     *  min=1,
     *  minMessage="Devi specificare Issue 1 o superiore."
     * )
     * 
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="date")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=true)
     */
    private $cover;


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
     * Set number
     *
     * @param integer $number
     * @return Issue
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Issue
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return Issue
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }
    
    
    /*
 * 
 * Get web path to upload directory
 *
 * @return string
 * Relative path.
 */

protected function getUploadPath() 
{
    return 'uploads/covers';
}

function getUploadAbsolutePath()
{
    return __DIR__.'/../../../../web/'.$this->getUploadPath();
}

function getCoverWeb() {
    return NULL=== $this->getCover()
            ? NULL
            : $this->getUploadPath().'/'.$this->getCover();
}

function getCoverAbsolute() {
    return NULL=== $this->getCover()
            ? NULL
            : $this->getUploadAbsolutePath().'/'.$this->getCover();
}

/*
 * Assert\File(maxSize="1000000")
 */
private $file;

public function setFile(UploadedFile $file=NULL) {
    $this->file=$file;
}

public function getFile() {
    return $this->file;
}

public function upload() {
    if(NULL=== $this->getFile()) {
        return;
    }
    
    $filename= $this->getFile()->getClientOriginalName();
    
    $this->getFile()->move(
            $this->getUploadAbsolutePath(),
            $filename
            );
    
            $this->setCover($filename);
            
            
}
    
}

