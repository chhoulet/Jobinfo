<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Forum
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeHomepageBundle\Entity\ForumRepository")
 */
class Forum
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
     * @ORM\Column(name="forumName", type="string", length=255)
     */
    private $forumName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="forumType", type="string", length=255)
     */
    private $forumType;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="forumDate", type="date")
     */
    private $forumDate;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="forumAdress", type="string", length=255)
     */
    private $forumAdress;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "50",
     *      max = "700",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="forumDescription", type="text")
     */
    private $forumDescription;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Formation", mappedBy="forum")
     */
    private $formation;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="forum")
     * @ORM\JoinTable(name="forum_candidat")
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Society", inversedBy="forum")
     * @ORM\JoinTable(name="forum_society")
     */
    private $society;

     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="forum")
     * @ORM\JoinTable(name="user_forum")
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
     * Set forumName
     *
     * @param string $forumName
     * @return Forum
     */
    public function setForumName($forumName)
    {
        $this->forumName = $forumName;

        return $this;
    }

    /**
     * Get forumName
     *
     * @return string 
     */
    public function getForumName()
    {
        return $this->forumName;
    }

    /**
     * Set forumType
     *
     * @param string $forumType
     * @return Forum
     */
    public function setForumType($forumType)
    {
        $this->forumType = $forumType;

        return $this;
    }

    /**
     * Get forumType
     *
     * @return string 
     */
    public function getForumType()
    {
        return $this->forumType;
    }

    /**
     * Set forumDate
     *
     * @param \DateTime $forumDate
     * @return Forum
     */
    public function setForumDate($forumDate)
    {
        $this->forumDate = $forumDate;

        return $this;
    }

    /**
     * Get forumDate
     *
     * @return \DateTime 
     */
    public function getForumDate()
    {
        return $this->forumDate;
    }

    /**
     * Set forumAdress
     *
     * @param string $forumAdress
     * @return Forum
     */
    public function setForumAdress($forumAdress)
    {
        $this->forumAdress = $forumAdress;

        return $this;
    }

    /**
     * Get forumAdress
     *
     * @return string 
     */
    public function getForumAdress()
    {
        return $this->forumAdress;
    }

    /**
     * Set forumDescription
     *
     * @param string $forumDescription
     * @return Forum
     */
    public function setForumDescription($forumDescription)
    {
        $this->forumDescription = $forumDescription;

        return $this;
    }

    /**
     * Get forumDescription
     *
     * @return string 
     */
    public function getForumDescription()
    {
        return $this->forumDescription;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add society
     *
     * @param \FrontOfficeEmploiBundle\Entity\Society $society
     * @return Forum
     */
    public function addSociety(\FrontOfficeEmploiBundle\Entity\Society $society)
    {
        $this->society[] = $society;

        return $this;
    }

    /**
     * Remove society
     *
     * @param \FrontOfficeEmploiBundle\Entity\Society $society
     */
    public function removeSociety(\FrontOfficeEmploiBundle\Entity\Society $society)
    {
        $this->society->removeElement($society);
    }

    /**
     * Get society
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Add inscrits
     *
     * @param \FrontOfficeUserBundle\Entity\User $inscrits
     * @return Forum
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
     * Add formation
     *
     * @param \FrontOfficeHomepageBundle\Entity\Formation $formation
     * @return Forum
     */
    public function addFormation(\FrontOfficeHomepageBundle\Entity\Formation $formation)
    {
        $this->formation[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \FrontOfficeHomepageBundle\Entity\Formation $formation
     */
    public function removeFormation(\FrontOfficeHomepageBundle\Entity\Formation $formation)
    {
        $this->formation->removeElement($formation);
    }

    /**
     * Get formation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return Forum
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
