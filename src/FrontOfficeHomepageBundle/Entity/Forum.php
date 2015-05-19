<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="forumName", type="string", length=255)
     */
    private $forumName;

    /**
     * @var string
     *
     * @ORM\Column(name="forumType", type="string", length=255)
     */
    private $forumType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="forumDate", type="date")
     */
    private $forumDate;

    /**
     * @var string
     *
     * @ORM\Column(name="forumAdress", type="string", length=255)
     */
    private $forumAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="forumDescription", type="text")
     */
    private $forumDescription;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Forum", mappedBy="forum")
     */
    private $formation;


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
     * Add formation
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $formation
     * @return Forum
     */
    public function addFormation(\FrontOfficeHomepageBundle\Entity\Forum $formation)
    {
        $this->formation[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $formation
     */
    public function removeFormation(\FrontOfficeHomepageBundle\Entity\Forum $formation)
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
}
