<?php

namespace Lynda\MagazineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Publication
 *
 * @ORM\Table(name="Publications")
 * @ORM\Entity(repositoryClass="Lynda\MagazineBundle\Entity\PublicationRepository")
 */
class Publication
{
        /*
         * @var ArrayCollecton
         * 
         * @ORM\OneToMany(targetEntity="Issue", mappedBy="publication")
         * 
         */
    private $issues;
    
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    
    
    
    public function __construct() {
        $this->issues= new ArrayCollection();
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
     * @return Publication
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
    
    /*
     * Render a Publication as a string.
     * 
     * @return string
     */
    
    public function __toString() {
        return $this->getName();
    }
}



