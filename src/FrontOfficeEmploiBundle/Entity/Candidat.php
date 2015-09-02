<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\CandidatRepository")
 */
class Candidat
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="postcode", type="integer")
     */
    private $postcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="phoneNumber", type="integer")
     */
    private $phoneNumber;

     /**
     * @var datetime
     *
     * @ORM\Column(name="savedAt", type="datetime")
     */
    private $savedAt;

     /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", mappedBy="candidat")
     */
    private $cuvitae;

    /**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", mappedBy="candidat")
     */
    private $jobOffer;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", mappedBy="candidat")
     */
    private $motivationLetter;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="FrontOfficeUserBundle\Entity\User", mappedBy="candidat")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
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
     * Set firstname
     *
     * @param string $firstname
     * @return Candidat
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Candidat
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Candidat
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Candidat
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     * @return Candidat
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return integer 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     * @return Candidat
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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
     * @param \FrontOfficeEmploiBundle\Entity\FrontOfficeEmploiBundle $cuvitae
     * @return Candidat
     */
    public function addCuvitae(\FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae)
    {
        $this->cuvitae[] = $cuvitae;

        return $this;
    }

    /**
     * Remove cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\FrontOfficeEmploiBundle $cuvitae
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
     * Add jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     * @return Candidat
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
     * Add motivationLetter
     *
     * @param \FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter
     * @return Candidat
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
     * Set user
     *
     * @param \FrontOfficeUserBundle\Entity\User $user
     * @return Candidat
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
     * Set savedAt
     *
     * @param \DateTime $savedAt
     * @return Candidat
     */
    public function setSavedAt($savedAt)
    {
        $this->savedAt = $savedAt;

        return $this;
    }

    /**
     * Get savedAt
     *
     * @return \DateTime 
     */
    public function getSavedAt()
    {
        return $this->savedAt;
    }
}
