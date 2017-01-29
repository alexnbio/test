<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Genus
 *
 * @author Neuro
 */
/**
 * @ORM\Entity
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
     */
    private $name;
}
