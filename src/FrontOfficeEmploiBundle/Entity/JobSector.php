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
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", mappedBy="jobSector")
     */
    private $jobOffer;


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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobOffer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     * @return JobSector
     */
    public function addJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer)
    {
        $this->jobOffer[] = $jobOffer;

        return $this;
    }

    /**
     * Remove jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     */
    public function removeJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer)
    {
        $this->jobOffer->removeElement($jobOffer);
    }

    /**
     * Get jobOffer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobOffer()
    {
        return $this->jobOffer;
    }

    public function __toString()
    {
        return $this ->nameSector;
    }
}
