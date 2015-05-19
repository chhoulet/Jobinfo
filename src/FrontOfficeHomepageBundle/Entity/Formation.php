<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="formationName", type="string", length=255)
     */
    private $formationName;

    /**
     * @var string
     *
     * @ORM\Column(name="formationType", type="string", length=255)
     */
    private $formationType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


    /**
     * @var string
     *
     * @ORM\Column(name="formationDescription", type="text")
     */
    private $formationDescription;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeHomepageBundle\Entity\Forum", inversedBy="formation")
     * JoinColumn(name="forum_id" referencedColumnName="id")
     */
    private $forum;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeHomepageBundle\Entity\Etablissement", inversedBy="formation")
     * JoinColumn(name="etablissement_id", referencedColumnName="id")
     */
    private $etablissement;





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
     * Set forum
     *
     * @param \FrontOfficeHomepageBundle\Entity\Forum $forum
     * @return Formation
     */
    public function setForum(\FrontOfficeHomepageBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return \FrontOfficeHomepageBundle\Entity\Forum 
     */
    public function getForum()
    {
        return $this->forum;
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
}
