<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MotivationLetter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\MotivationLetterRepository")
 */
class MotivationLetter
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
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

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
     * @ORM\Column(name="dateUpdated", type="datetime", nullable = true)
     */
    private $dateUpdated;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="content", type="string", length=1000)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", inversedBy="motivationLetter")
     * @ORM\JoinColumn(name="jobOffer_id", referencedColumnName="id", nullable = true)
     */
    private $jobOffer;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", mappedBy="motivationLetter", cascade={"remove"})
     */
    private $responseJobOffer;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="motivationLetter", cascade={"persist"})
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id", nullable = true)
     */
    private $candidat;

     /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="motivationLetter", cascade={"persist"})
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
     * Set subject
     *
     * @param string $subject
     * @return MotivationLetter
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return MotivationLetter
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
     * Set content
     *
     * @param string $content
     * @return MotivationLetter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return MotivationLetter
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
     * Set jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     * @return MotivationLetter
     */
    public function setJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer = null)
    {
        $this->jobOffer = $jobOffer;

        return $this;
    }

    /**
     * Get jobOffer
     *
     * @return \FrontOfficeEmploiBundle\Entity\JobOffer 
     */
    public function getJobOffer()
    {
        return $this->jobOffer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responseJobOffer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     * @return MotivationLetter
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
        return $this ->id . ': ' .$this ->subject . ' (' . $this->dateCreated->format('d/m/Y') . ')';
    }

    /**
     * Set user
     *
     * @param \FrontOfficeUserBundle\Entity\User $user
     * @return MotivationLetter
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
     * @return MotivationLetter
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
