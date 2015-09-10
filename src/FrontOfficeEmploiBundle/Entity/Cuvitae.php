<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cuvitae
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\CuvitaeRepository")
 */
class Cuvitae
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
     * @Assert\Length(
     *      min = "15",
     *      max = "255",
     *      minMessage = "Votre diplôme doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre diplôme ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="gradeOne", type="string", length=255)
     */
    private $gradeOne;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "0",
     *      max = "50",
     *      maxMessage = "Votre diplôme ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="gradeTwo", type="string", length=255)
     */
    private $gradeTwo;

    /**
     * @var string
     *
      * @Assert\Length(
     *      min = "0",
     *      max = "150",
     *      maxMessage = "Votre liste de langues parlées ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="languages", type="string", length=255)
     */
    private $languages;

    /**
     * @var string
     *
      * @Assert\Length(
     *      min = "0",
     *      max = "500",
     *      maxMessage = "La description de votre expérience professionnelle ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="workExperience1", type="string", length=400)
     */
    private $workExperience1;

    /**
     * @var string
     *
      * @Assert\Length(
     *      min = "0",
     *      max = "50",
     *      maxMessage = "La description de votre expérience professionnelle ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="workExperience2", type="string", length=400)
     */
    private $workExperience2;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "0",
     *      max = "500",
     *      maxMessage = "La liste de vos compétences ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="skills", type="string", length=350)
     */
    private $skills;

    /**
     * @var datetime
     *      
     * @ORM\Column(name="dateUpdated", type="datetime", nullable = true)
     */
    private $dateUpdated;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="cuvitae")
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id", nullable = true)
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", inversedBy="cuvitae")
     * ORM\JoinTable(name="jobOffer_cuvitae", nullable = true)
     */
    private $jobOffer;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", mappedBy="cuvitae")
     */
    private $responseJobOffer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="cuvitae")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable = true)
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
     * Set gradeOne
     *
     * @param string $gradeOne
     * @return Cuvitae
     */
    public function setGradeOne($gradeOne)
    {
        $this->gradeOne = $gradeOne;

        return $this;
    }

    /**
     * Get gradeOne
     *
     * @return string 
     */
    public function getGradeOne()
    {
        return $this->gradeOne;
    }

    /**
     * Set gradeTwo
     *
     * @param string $gradeTwo
     * @return Cuvitae
     */
    public function setGradeTwo($gradeTwo)
    {
        $this->gradeTwo = $gradeTwo;

        return $this;
    }

    /**
     * Get gradeTwo
     *
     * @return string 
     */
    public function getGradeTwo()
    {
        return $this->gradeTwo;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return Cuvitae
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return string 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set workExperience1
     *
     * @param string $workExperience1
     * @return Cuvitae
     */
    public function setWorkExperience1($workExperience1)
    {
        $this->workExperience1 = $workExperience1;

        return $this;
    }

    /**
     * Get workExperience1
     *
     * @return string 
     */
    public function getWorkExperience1()
    {
        return $this->workExperience1;
    }

    /**
     * Set workExperience2
     *
     * @param string $workExperience2
     * @return Cuvitae
     */
    public function setWorkExperience2($workExperience2)
    {
        $this->workExperience2 = $workExperience2;

        return $this;
    }

    /**
     * Get workExperience2
     *
     * @return string 
     */
    public function getWorkExperience2()
    {
        return $this->workExperience2;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return Cuvitae
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Cuvitae
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
     * Set candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return Cuvitae
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
     * @return Cuvitae
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

    /**
     * Add responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     * @return Cuvitae
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

    public function __toString()
    {
        return $this -> title;
    }

    /**
     * Set user
     *
     * @param \FrontOfficeUserBundle\Entity\User $user
     * @return Cuvitae
     */
    public function setUser(\FrontOfficeUserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FrontOfficeUserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Cuvitae
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}
