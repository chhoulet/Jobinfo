<?php
// src/Acme/UserBundle/Entity/User.php

namespace FrontOfficeUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /*protected $candidat;
    protected $society;*/

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", mappedBy="candidat")
     */
    private $cuvitae;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", mappedBy="candidat")
     */
    private $motivationLetter;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", mappedBy="candidat")
     */
    private $responseJobOffer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Society", inversedBy="users")
     * @ORM\JoinColumn(name="society_id", referencedColumnName="id")
     */
    private $society;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Article", mappedBy="author")
     */
    private $articles;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Add articles
     *
     * @param \FrontOfficeHomepageBundle\Entity\Article $articles
     * @return User
     */
    public function addArticle(\FrontOfficeHomepageBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \FrontOfficeHomepageBundle\Entity\Article $articles
     */
    public function removeArticle(\FrontOfficeHomepageBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set society
     *
     * @param \FrontOfficeEmploiBundle\Entity\Society $society
     * @return User
     */
    public function setSociety(\FrontOfficeEmploiBundle\Entity\Society $society = null)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \FrontOfficeEmploiBundle\Entity\Society 
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Add cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae
     * @return User
     */
    public function addCuvitae(\FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae)
    {
        $this->cuvitae[] = $cuvitae;

        return $this;
    }

    /**
     * Remove cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae
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
     * Add motivationLetter
     *
     * @param \FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter
     * @return User
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
     * Add responseJobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\ResponseJobOffer $responseJobOffer
     * @return User
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
}
