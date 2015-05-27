<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobOffer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\JobOfferRepository")
 */
class JobOffer
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionJob", type="string", length=400)
     */
    private $descriptionJob;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\JobSector", inversedBy="jobOffer")
     * @ORM\JoinColumn(name="jobSector_id", referencedColumnName="id")
     */
    private $jobSector;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", mappedBy="jobOffer")
     */
    private $cuvitae;




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
     * Set title
     *
     * @param string $title
     * @return JobOffer
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
     * Set descriptionJob
     *
     * @param string $descriptionJob
     * @return JobOffer
     */
    public function setDescriptionJob($descriptionJob)
    {
        $this->descriptionJob = $descriptionJob;

        return $this;
    }

    /**
     * Get descriptionJob
     *
     * @return string 
     */
    public function getDescriptionJob()
    {
        return $this->descriptionJob;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return JobOffer
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set jobSector
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobSector $jobSector
     * @return JobOffer
     */
    public function setJobSector(\FrontOfficeEmploiBundle\Entity\JobSector $jobSector = null)
    {
        $this->jobSector = $jobSector;

        return $this;
    }

    /**
     * Get jobSector
     *
     * @return \FrontOfficeEmploiBundle\Entity\JobSector 
     */
    public function getJobSector()
    {
        return $this->jobSector;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuvitae = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae
     * @return JobOffer
     */
    public function addCuvitae(\FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae)
    {
        $this->cuvitae[] = $cuvitae;

        return $this;
    }

    /**
     * Remove cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae
     */
    public function removeCuvitae(\FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae)
    {
        $this->cuvitae->removeElement($cuvitae);
    }

    /**
     * Get cuvitae
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuvitae()
    {
        return $this->cuvitae;
    }
}
