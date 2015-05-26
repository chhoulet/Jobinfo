<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobSector
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class JobSector
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
     * @ORM\Column(name="nameSector", type="string", length=255)
     */
    private $nameSector;


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
     * Set nameSector
     *
     * @param string $nameSector
     * @return JobSector
     */
    public function setNameSector($nameSector)
    {
        $this->nameSector = $nameSector;

        return $this;
    }

    /**
     * Get nameSector
     *
     * @return string 
     */
    public function getNameSector()
    {
        return $this->nameSector;
    }
}
