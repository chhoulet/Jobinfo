<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="gradeOne", type="string", length=255)
     */
    private $gradeOne;

    /**
     * @var string
     *
     * @ORM\Column(name="gradeTwo", type="string", length=255)
     */
    private $gradeTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="languages", type="string", length=255)
     */
    private $languages;

    /**
     * @var string
     *
     * @ORM\Column(name="workExperience1", type="string", length=400)
     */
    private $workExperience1;

    /**
     * @var string
     *
     * @ORM\Column(name="workExperience2", type="string", length=400)
     */
    private $workExperience2;

    /**
     * @var string
     *
     * @ORM\Column(name="skills", type="string", length=350)
     */
    private $skills;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="cuvitae")
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id")
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", inversedBy="cuvitae")
     * ORM\JoinTable(name="jobOffer_cuvitae")
     */
    private $jobOffer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", inversedBy="cuvitae")
     * @ORM\JoinColumn(name="responseJobOffer_id", referencedColumnName="id")
     */
    private $responseJobOffer;


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
     * Set responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     * @return Cuvitae
     */
    public function setResponseJobOffer(\FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer = null)
    {
        $this->responseJobOffer = $responseJobOffer;

        return $this;
    }

    /**
     * Get responseJobOffer
     *
     * @return \FrontOfficeEmploiBundle\Entity\ResponseJobOffer 
     */
    public function getResponseJobOffer()
    {
        return $this->responseJobOffer;
    }
}
