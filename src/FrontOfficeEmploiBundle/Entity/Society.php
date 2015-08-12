<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Society
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\SocietyRepository")
 */
class Society
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="activity", type="string", length=400)
     */
    private $activity;

    /**
     * @var string
     *
      * @Assert\Length(
     *      min = "10",
     *      max = "800",
     *      minMessage = "La description de votre activité doit faire au moins {{ limit }} caractères",
     *      maxMessage = "La description de votre activité ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="description", type="string", length=800)
     */
    private $description;

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
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @var boolean
     *
     * @Assert\Type(type="boolean", message="La valeur {{ value }} n'est pas un type {{ type }} valide.")
     * @ORM\Column(name="hiringState", type="boolean")
     */
    private $hiringState;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Forum", mappedBy="society")
     */
    private $forum;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", mappedBy="society")
     */
    private $jobOffer;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeUserBundle\Entity\User", mappedBy="society")
     * @ORM\JoinTable(name="user_society")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="societies")
     * @ORM\JoinColumn(name="jobSector_id", referencedColumnName="id")
     */
    private $jobSector;
    
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
     * Set name
     *
     * @param string $name
     * @return Society
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set activity
     *
     * @param string $activity
     * @return Society
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Society
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set hiringState
     *
     * @param boolean $hiringState
     * @return Society
     */
    public function setHiringState($hiringState)
    {
        $this->hiringState = $hiringState;

        return $this;
    }

    /**
     * Get hiringState
     *
     * @return boolean 
     */
    public function getHiringState()
    {
        return $this->hiringState;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forum = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forum
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $forum
     * @return Society
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
     * Add jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     * @return Society
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Society
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add users
     *
     * @param \FrontOfficeUserBundle\Entity\User $users
     * @return Society
     */
    public function addUser(\FrontOfficeUserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \FrontOfficeUserBundle\Entity\User $users
     */
    public function removeUser(\FrontOfficeUserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Society
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
     * Set jobSector
     *
     * @param \FrontOfficeUserBundle\Entity\User $jobSector
     * @return Society
     */
    public function setJobSector(\FrontOfficeUserBundle\Entity\User $jobSector = null)
    {
        $this->jobSector = $jobSector;

        return $this;
    }

    /**
     * Get jobSector
     *
     * @return \FrontOfficeUserBundle\Entity\User 
     */
    public function getJobSector()
    {
        return $this->jobSector;
    }
}
