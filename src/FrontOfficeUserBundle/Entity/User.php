<?php
// src/Acme/UserBundle/Entity/User.php

namespace FrontOfficeUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
}
