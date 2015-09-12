<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="lastname", type="string")
     */
    private $lastname;

    /**
     * @var string
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Le nom de votre rue doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de votre rue ne peut pas être plus long que {{ limit }} caractères"
     * )     
     *
     * @ORM\Column(name="street", type="string")
     */
    private $street;

    /**
     * @var string
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Le nom de votre ville doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de votre ville ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="city", type="string")
     */
    private $city;

    /**
     * @var integer
     * @Assert\Range(
     *      min = 01,
     *      max = 99,
     *      minMessage = "Votre code postal ne doit comporter que 2 chiffres de 01 à 99",
     *      maxMessage = "Votre code postal ne doit comporter que 2 chiffres de 01 à 99"
     * )
     *
     * @ORM\Column(name="postcode", type="integer")
     */
    private $postcode;

    /**
     * @var integer
     * @Assert\Range(
     *      min = 0000000000,
     *      max = 9999999999,
     *      minMessage = "Votre numéro de téléphone doit comporter 10 chiffres",
     *      maxMessage = "Votre numéro de téléphone doit comporter 10 chiffres"
     * )
     *
     * @ORM\Column(name="phoneNumber", type="integer")
     */
    private $phoneNumber;

     /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="savedAt", type="datetime")
     */
    private $savedAt;

     /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateUpdated", type="datetime", nullable = true)
     */
    private $dateUpdated;

     /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", mappedBy="candidat", cascade={"remove"})
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
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", mappedBy="candidat", cascade={"remove"})
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

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Candidat
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
