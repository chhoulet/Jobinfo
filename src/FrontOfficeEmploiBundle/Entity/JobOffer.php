<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="descriptionJob", type="string", length=400)
     */
    private $descriptionJob;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="contract", type="string", length=400)
     */
    private $contract;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateSelected", type="datetime", nullable = true)
     */
    private $dateSelected;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateApplyed", type="datetime", nullable = true)
     */
    private $dateApplyed;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateDesactivation", type="datetime", nullable = true)
     */
    private $dateDesactivation;


    /**
    * @var boolean
    *
    * @ORM\Column(name="activeToPurchase", type="boolean")
    */
    private $activeToPurchase;

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
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", mappedBy="jobOffer")
     */
    private $motivationLetter;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Society", inversedBy="jobOffer")
     * @ORM\JoinColumn(name="society_id", referencedColumnName="id")
     */
    private $society;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", mappedBy="jobOffer")
     */
    private $responseJobOffer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="jobOffer")
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id")
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="jobOffers")
     * @ORM\JoinTable(name="users_jobOffers")
     */
    private $user;


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

    /**
     * Add motivationLetter
     *
     * @param \FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter
     * @return JobOffer
     */
    public function addMotivationLetter(\FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter)
    {
        $this->motivationLetter[] = $motivationLetter;

        return $this;
    }

    /**
     * Remove motivationLetter
     *
     * @param \FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter
     */
    public function removeMotivationLetter(\FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter)
    {
        $this->motivationLetter->removeElement($motivationLetter);
    }

    /**
     * Get motivationLetter
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMotivationLetter()
    {
        return $this->motivationLetter;
    }

    /**
     * Set society
     *
     * @param \FrontOfficeEmploiBundle\Entity\Society $society
     * @return JobOffer
     */
    public function setSociety(\FrontOfficeEmploiBundle\Entity\Society $society = null)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \FrontOfficeEmploiBundle\Entity\Society 
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set contract
     *
     * @param string $contract
     * @return JobOffer
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return string 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Add responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     * @return JobOffer
     */
    public function addResponseJobOffer(\FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer)
    {
        $this->responseJobOffer[] = $responseJobOffer;

        return $this;
    }

    /**
     * Remove responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     */
    public function removeResponseJobOffer(\FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer)
    {
        $this->responseJobOffer->removeElement($responseJobOffer);
    }

    /**
     * Get responseJobOffer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponseJobOffer()
    {
        return $this->responseJobOffer;
    }

    /**
     * Set candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return JobOffer
     */
    public function setCandidat(\FrontOfficeEmploiBundle\Entity\Candidat $candidat = null)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \FrontOfficeEmploiBundle\Entity\Candidat 
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * Add user
     *
     * @param \FrontOfficeUserBundle\Entity\User $user
     * @return JobOffer
     */
    public function addUser(\FrontOfficeUserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \FrontOfficeUserBundle\Entity\User $user
     */
    public function removeUser(\FrontOfficeUserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Set dateSelected
     *
     * @param \DateTime $dateSelected
     * @return JobOffer
     */
    public function setDateSelected($dateSelected)
    {
        $this->dateSelected = $dateSelected;

        return $this;
    }

    /**
     * Get dateSelected
     *
     * @return \DateTime 
     */
    public function getDateSelected()
    {
        return $this->dateSelected;
    }

    /**
     * Set dateApplyed
     *
     * @param \DateTime $dateApplyed
     * @return JobOffer
     */
    public function setDateApplyed($dateApplyed)
    {
        $this->dateApplyed = $dateApplyed;

        return $this;
    }

    /**
     * Get dateApplyed
     *
     * @return \DateTime 
     */
    public function getDateApplyed()
    {
        return $this->dateApplyed;
    }

    /**
     * Set activeToPurchase
     *
     * @param boolean $activeToPurchase
     * @return JobOffer
     */
    public function setActiveToPurchase($activeToPurchase)
    {
        $this->activeToPurchase = $activeToPurchase;

        return $this;
    }

    /**
     * Get activeToPurchase
     *
     * @return boolean 
     */
    public function getActiveToPurchase()
    {
        return $this->activeToPurchase;
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set dateDesactivation
     *
     * @param \DateTime $dateDesactivation
     * @return JobOffer
     */
    public function setDateDesactivation($dateDesactivation)
    {
        $this->dateDesactivation = $dateDesactivation;

        return $this;
    }

    /**
     * Get dateDesactivation
     *
     * @return \DateTime 
     */
    public function getDateDesactivation()
    {
        return $this->dateDesactivation;
    }
}
