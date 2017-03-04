<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Genus
 *
 * @author Neuro
 */
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRepository")
 * @ORM\Table(name="genus")
 */
class Genus {
    //put your code here
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer") 
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubFamily")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $subFamily;
    
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     minMessage = "Negativ Species! Come on..."
     * )
     */
    private $speciesCount;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $funFact;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true;
    
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $firstDiscoveredAt;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="GenusNote", mappedBy="genus")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $notes;
    
    public function __construct()
    {
    	$this->notes = new ArrayCollection();
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSubFamily()
    {
        return $this->subFamily;
    }

    public function setSubFamily($subFamily)
    {
        $this->subFamily = $subFamily;
        return $this;
    }

    public function getSpeciesCount()
    {
        return $this->speciesCount;
    }

    public function setSpeciesCount($speciesCount)
    {
        $this->speciesCount = $speciesCount;
        return $this;
    }

    public function getFunFact()
    {
        return $this->funFact;
    }

    public function setFunFact($funFact)
    {
        $this->funFact = $funFact;
        return $this;
    }
    
    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0, 100).' days');
    }

    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
        return $this;
    }
    
    /**
     * 
     * @return ArrayCollection|GenusNote
     */
	public function getNotes() {
		return $this->notes;
	}
	public function getIsPublished() {
		return $this->isPublished;
	}
	public function getFirstDiscoveredAt() {
		return $this->firstDiscoveredAt;
	}
	public function setFirstDiscoveredAt($firstDiscoveredAt) {
		$this->firstDiscoveredAt = $firstDiscoveredAt;
		return $this;
	}
    public function getId()
    {
        return $this->id;
    }
 
	
	
    
}
