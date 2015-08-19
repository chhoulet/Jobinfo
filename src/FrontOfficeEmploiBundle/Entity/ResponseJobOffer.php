<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ResponseJobOffer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeEmploiBundle\Entity\ResponseJobOfferRepository")
 */
class ResponseJobOffer
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
     * @Assert\Length(
     *      min = "20",
     *      max = "500",
     *      minMessage = "Votre réponse  doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre réponse ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="string", length=500)
     */
    private $content;

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
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\Cuvitae", inversedBy="responseJobOffer")
     * @ORM\JoinColumn(name="cuvitae_id", referencedColumnName="id")
     */
    private $cuvitae;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\MotivationLetter", inversedBy="responseJobOffer")
     * @ORM\JoinColumn(name="motivation_letter_id", referencedColumnName="id")
     */
    private $motivationLetter;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeUserBundle\Entity\User", inversedBy="responseJobOffer")
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id", nullable = true)
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeEmploiBundle\Entity\JobOffer", inversedBy="responseJobOffer", cascade={"remove"})
     * @ORM\JoinColumn(name="jobOffer_id", referencedColumnName="id")
     */
    private $jobOffer;

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
     * Set content
     *
     * @param string $content
     * @return ResponseJobOffer
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set candidat
     *
     * @param \FrontOfficeEmploiBundle\Entity\Candidat $candidat
     * @return ResponseJobOffer
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return ResponseJobOffer
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
     * Set jobOffer
     *
     * @param \FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer
     * @return ResponseJobOffer
     */
    public function setJobOffer(\FrontOfficeEmploiBundle\Entity\JobOffer $jobOffer = null)
    {
        $this->jobOffer = $jobOffer;

        return $this;
    }

    /**
     * Get jobOffer
     *
     * @return \FrontOfficeEmploiBundle\Entity\JobOffer 
     */
    public function getJobOffer()
    {
        return $this->jobOffer;
    }

    /**
     * Set motivationLetter
     *
     * @param \FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter
     * @return ResponseJobOffer
     */
    public function setMotivationLetter(\FrontOfficeEmploiBundle\Entity\MotivationLetter $motivationLetter = null)
    {
        $this->motivationLetter = $motivationLetter;

        return $this;
    }

    /**
     * Get motivationLetter
     *
     * @return \FrontOfficeEmploiBundle\Entity\MotivationLetter 
     */
    public function getMotivationLetter()
    {
        return $this->motivationLetter;
    }

    /**
     * Set cuvitae
     *
     * @param \FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae
     * @return ResponseJobOffer
     */
    public function setCuvitae(\FrontOfficeEmploiBundle\Entity\Cuvitae $cuvitae = null)
    {
        $this->cuvitae = $cuvitae;

        return $this;
    }

    /**
     * Get cuvitae
     *
     * @return \FrontOfficeEmploiBundle\Entity\Cuvitae 
     */
    public function getCuvitae()
    {
        return $this->cuvitae;
    }
}
