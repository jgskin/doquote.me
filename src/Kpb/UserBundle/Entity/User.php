<?php

namespace Kpb\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Kpb\UserBundle\Entity\User
 *
 * @ORM\Table(name="kpb_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Kpb\QuoteBundle\Entity\Quote", mappedBy="author")
     */
    protected $quotes;
    
    function __construct()
    {
      $this->quotes = new ArrayCollection();
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
     * Add quotes
     *
     * @param Kpb\QuoteBundle\Entity\Quote $quotes
     */
    public function addQuote(\Kpb\QuoteBundle\Entity\Quote $quotes)
    {
        $this->quotes[] = $quotes;
    }

    /**
     * Get quotes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getQuotes()
    {
        return $this->quotes;
    }
}