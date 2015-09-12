<?php
// src/Acme/UserBundle/Entity/User.php

namespace FrontOfficeUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="FrontOfficeUserBundle\Entity\UserRepository")
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

     /**
     * @var boolean
     *
     * @ORM\Column(name="personnalSpaceActive", type="boolean")
     */
    private $personnalSpaceActive;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Comment", mappedBy="author")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Society", cascade={"persist","remove"})
     */
    private $society;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Candidat", inversedBy="user", cascade={"persist","remove"})
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Article", mappedBy="author")
     */
    private $articles;     

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\ResponseJobOffer", mappedBy="user")
     */
    private $responseJobOffer;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", mappedBy="user", cascade={"remove"})
     */
    private $motivationLetter;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", mappedBy="user", cascade={"remove"})
     */
    private $cuvitae;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", mappedBy="user")
     * @ORM\JoinTable(name="users_jobOffers")
     */
    private $jobOffers;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Forum", mappedBy="inscrits")
     */
    private $forum;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeHomepageBundle\Entity\Formation", mappedBy="inscrits")
     */
    private $formation;


    public function __construct()
    {
        parent::__construct();
        $this->setPersonnalSpaceActive(false);
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
     * Set candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return User
     */
    public function setCandidat(\FrontOfficeEmploiBundle\Entity\Candidat $candidat = null)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \FrontOfficeEmploiBundle\Entity\Candidat 
     */
    public function getCandidat()
    {
        return $this->candidat;
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
     * Get jobOffers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobOffers()
    {
        return $this->jobOffers;
    }

    /**
     * Add jobOffers
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffers
     * @return User
     */
    public function addJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffers)
    {
        $this->jobOffers[] = $jobOffers;

        return $this;
    }

    /**
     * Remove jobOffers
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffers
     */
    public function removeJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffers)
    {
        $this->jobOffers->removeElement($jobOffers);
    }

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
     * Add formation
     *
     * @param \FrontOfficeHomepageBundle\Entity\Formation $formation
     * @return User
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
     * Set type
     *
     * @param string $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add comment
     *
     * @param \FrontOfficeHomepageBundle\Entity\Comment $comment
     * @return User
     */
    public function addComment(\FrontOfficeHomepageBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \FrontOfficeHomepageBundle\Entity\Comment $comment
     */
    public function removeComment(\FrontOfficeHomepageBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set personnalSpaceActive
     *
     * @param boolean $personnalSpaceActive
     * @return User
     */
    public function setPersonnalSpaceActive($personnalSpaceActive)
    {
        $this->personnalSpaceActive = $personnalSpaceActive;

        return $this;
    }

    /**
     * Get personnalSpaceActive
     *
     * @return boolean 
     */
    public function getPersonnalSpaceActive()
    {
        return $this->personnalSpaceActive;
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

    /**
     * Add messages
     *
     * @param \FrontOfficeHomepageBundle\Entity\Message $messages
     * @return User
     */
    public function addMessage(\FrontOfficeHomepageBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \FrontOfficeHomepageBundle\Entity\Message $messages
     */
    public function removeMessage(\FrontOfficeHomepageBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
