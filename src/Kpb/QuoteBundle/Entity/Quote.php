<?php

namespace Kpb\QuoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kpb\QuoteBundle\Entity\Quote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Quote
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    public $content;

    /**
     * @ORM\ManyToOne(targetEntity="Kpb\UserBundle\Entity\User", inversedBy="quotes")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    protected $author;

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
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param Kpb\UserBundle\Entity\User $author
     */
    public function setAuthor(\Kpb\UserBundle\Entity\User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return Kpb\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}