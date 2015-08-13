<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeHomepageBundle\Entity\CommentRepository")
 */
class Comment
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
     * @Assert\Blank()
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $userName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validAdmin", type="boolean")
     */
    private $validAdmin;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "20",
     *      max = "500",
     *      minMessage = "Votre message doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre message ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeHomepageBundle\Entity\Article", inversedBy="comment")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $article;


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
     * Set userName
     *
     * @param string $userName
     * @return Comment
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Comment
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

    /**
     * Set article
     *
     * @param \FrontOfficeHomepageBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\FrontOfficeHomepageBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \FrontOfficeHomepageBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set validAdmin
     *
     * @param boolean $validAdmin
     * @return Comment
     */
    public function setValidAdmin($validAdmin)
    {
        $this->validAdmin = $validAdmin;

        return $this;
    }

    /**
     * Get validAdmin
     *
     * @return boolean 
     */
    public function getValidAdmin()
    {
        return $this->validAdmin;
    }
}
