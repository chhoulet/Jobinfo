<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Formation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeHomepageBundle\Entity\FormationRepository")
 */
class Formation
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
     * @ORM\Column(name="formationName", type="string", length=255)
     */
    private $formationName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="organism", type="string", length=255)
     */
    private $organism;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="formationType", type="string", length=255)
     */
    private $formationType;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="beginingDate", type="datetime")
     */
    private $beginingDate;

     /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="endingDate", type="datetime")
     */
    private $endingDate;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime() 
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "100",
     *      max = "580",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="formationDescription", type="text")
     */
    private $formationDescription;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Forum", inversedBy="formation")
     * @ORM\JoinTable(name="forum_formation")
     */
    private $forum;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="formation")
     * @ORM\JoinTable(name="candidat_formation")
     */
    private $candidat;
 
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeHomepageBundle\Entity\Etablissement", inversedBy="formation")
     * @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id", nullable=true)
     */
    private $etablissement;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="formation")
     * @ORM\JoinTable(name="user_formation")
     */
    private $inscrits;
    

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
     * Set formationName
     *
     * @param string $formationName
     * @return Formation
     */
    public function setFormationName($formationName)
    {
        $this->formationName = $formationName;

        return $this;
    }

    /**
     * Get formationName
     *
     * @return string 
     */
    public function getFormationName()
    {
        return $this->formationName;
    }

    /**
     * Set formationType
     *
     * @param string $formationType
     * @return Formation
     */
    public function setFormationType($formationType)
    {
        $this->formationType = $formationType;

        return $this;
    }

    /**
     * Get formationType
     *
     * @return string 
     */
    public function getFormationType()
    {
        return $this->formationType;
    }

    /**
     * Set formationDescription
     *
     * @param string $formationDescription
     * @return Formation
     */
    public function setFormationDescription($formationDescription)
    {
        $this->formationDescription = $formationDescription;

        return $this;
    }

    /**
     * Get formationDescription
     *
     * @return string 
     */
    public function getFormationDescription()
    {
        return $this->formationDescription;
    }
   
    /**
     * Set etablissement
     *
     * @param \FrontOfficeHomepageBundle\Entity\Etablissement $etablissement
     * @return Formation
     */
    public function setEtablissement(\FrontOfficeHomepageBundle\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \FrontOfficeHomepageBundle\Entity\Etablissement 
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Formation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subscriber = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Formation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set organism
     *
     * @param string $organism
     * @return Formation
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;

        return $this;
    }

    /**
     * Get organism
     *
     * @return string 
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * Add inscrits
     *
     * @param \FrontOfficeUserBundle\Entity\User $inscrits
     * @return Formation
     */
    public function addInscrit(\FrontOfficeUserBundle\Entity\User $inscrits)
    {
        $this->inscrits[] = $inscrits;

        return $this;
    }

    /**
     * Remove inscrits
     *
     * @param \FrontOfficeUserBundle\Entity\User $inscrits
     */
    public function removeInscrit(\FrontOfficeUserBundle\Entity\User $inscrits)
    {
        $this->inscrits->removeElement($inscrits);
    }

    /**
     * Get inscrits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }

    /**
     * Set beginingDate
     *
     * @param \DateTime $beginingDate
     * @return Formation
     */
    public function setBeginingDate($beginingDate)
    {
        $this->beginingDate = $beginingDate;

        return $this;
    }

    /**
     * Get beginingDate
     *
     * @return \DateTime 
     */
    public function getBeginingDate()
    {
        return $this->beginingDate;
    }

    /**
     * Set endingDate
     *
     * @param \DateTime $endingDate
     * @return Formation
     */
    public function setEndingDate($endingDate)
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * Get endingDate
     *
     * @return \DateTime 
     */
    public function getEndingDate()
    {
        return $this->endingDate;
    }    

   

    /**
     * Add forum
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $forum
     * @return Formation
     */
    public function addForum(\FrontOfficeHomepageBundle\Entity\Forum $forum)
    {
        $this->forum[] = $forum;

        return $this;
    }

    /**
     * Remove forum
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $forum
     */
    public function removeForum(\FrontOfficeHomepageBundle\Entity\Forum $forum)
    {
        $this->forum->removeElement($forum);
    }

    /**
     * Get forum
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Add candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return Formation
     */
    public function addCandidat(\FrontOfficeEmploiBundle\Entity\Candidat $candidat)
    {
        $this->candidat[] = $candidat;

        return $this;
    }

    /**
     * Remove candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     */
    public function removeCandidat(\FrontOfficeEmploiBundle\Entity\Candidat $candidat)
    {
        $this->candidat->removeElement($candidat);
    }

    /**
     * Get candidat
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCandidat()
    {
        return $this->candidat;
    }
}
