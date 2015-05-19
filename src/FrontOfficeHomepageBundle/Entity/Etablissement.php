<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeHomepageBundle\Entity\EtablissementRepository")
 */
class Etablissement
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
     * @ORM\Column(name="etablissementName", type="string", length=255)
     */
    private $etablissementName;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissementAdress", type="string", length=255)
     */
    private $etablissementAdress;

    /**
     * @var integer
     *
     * @ORM\Column(name="etablissementPhone", type="integer")
     */
    private $etablissementPhone;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Formation", mappedBy="etablissement")
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
     * Set etablissementName
     *
     * @param string $etablissementName
     * @return Etablissement
     */
    public function setEtablissementName($etablissementName)
    {
        $this->etablissementName = $etablissementName;

        return $this;
    }

    /**
     * Get etablissementName
     *
     * @return string 
     */
    public function getEtablissementName()
    {
        return $this->etablissementName;
    }

    /**
     * Set etablissementAdress
     *
     * @param string $etablissementAdress
     * @return Etablissement
     */
    public function setEtablissementAdress($etablissementAdress)
    {
        $this->etablissementAdress = $etablissementAdress;

        return $this;
    }

    /**
     * Get etablissementAdress
     *
     * @return string 
     */
    public function getEtablissementAdress()
    {
        return $this->etablissementAdress;
    }

    /**
     * Set etablissementPhone
     *
     * @param integer $etablissementPhone
     * @return Etablissement
     */
    public function setEtablissementPhone($etablissementPhone)
    {
        $this->etablissementPhone = $etablissementPhone;

        return $this;
    }

    /**
     * Get etablissementPhone
     *
     * @return integer 
     */
    public function getEtablissementPhone()
    {
        return $this->etablissementPhone;
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
     * @param \FrontOfficeHomepageBundle\Entity\Formation $formation
     * @return Etablissement
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
}
