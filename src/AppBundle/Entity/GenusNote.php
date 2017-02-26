<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenusNote
 *
 * @ORM\Table(name="genus_note")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusNoteRepository")
 */
class GenusNote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $username;
    
    /**
     * @ORM\Column(type="string")
     */
    private $userAvatarFilename;
    
    /**
     * @ORM\Column(type="text")
     */
    private $note;
    
    /**
     * @ORM\Column(type="datetime")
     */
	private $createdAt;
	
	/**
	 * 
	 * @ORM\ManyToOne(targetEntity="Genus", inversedBy="notes")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $genus;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
	

    /**
     * Set username
     *
     * @param string $username
     *
     * @return GenusNote
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set userAvatarFilename
     *
     * @param string $userAvatarFilename
     *
     * @return GenusNote
     */
    public function setUserAvatarFilename($userAvatarFilename)
    {
        $this->userAvatarFilename = $userAvatarFilename;

        return $this;
    }

    /**
     * Get userAvatarFilename
     *
     * @return string
     */
    public function getUserAvatarFilename()
    {
        return $this->userAvatarFilename;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return GenusNote
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GenusNote
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
    
	public function getGenus() {
		return $this->genus;
	}
	
	/**
	 * 
	 * @param Genus $genus
	 * @return \AppBundle\Entity\GenusNote
	 */
	public function setGenus(Genus $genus) {
		$this->genus = $genus;
		return $this;
	}
	
}
