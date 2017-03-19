<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true)
     */
    private $email;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $password;
    
    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     */
    private $plainPassword;


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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
     */
    public function getUsername()
    {
        return $this->email;    
    }
    
 /**
  * {@inheritDoc}
  * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
  */
 public function getRoles() 
 {
  return ['ROLE_USER'];

 }

 /**
  * {@inheritDoc}
  * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
  */
 public function getPassword() 
 {
  return $this->password;

 }

 /**
  * {@inheritDoc}
  * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
  */
 public function getSalt() 
 {
  // TODO: Auto-generated method stub

 }

 /**
  * {@inheritDoc}
  * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
  */
 public function eraseCredentials() 
 {
  $this->plainPassword = null;

 }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
        return $this;
    }
 
 

}

