<?php

namespace AppBundle\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashPasswordListener implements EventSubscriber
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoder $passwordEncoder )
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    
    /**
    * {@inheritDoc}
    * @see \Doctrine\Common\EventSubscriber::getSubscribedEvents()
    */
    public function getSubscribedEvents() 
    {
        return ['prePersist', 'preUpdate'];
    
    }
    
    /**
     * 
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args )
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
        
        $this->encodePassword ( $entity );
    }
    
    /**
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args )
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
    
        $this->encodePassword ( $entity );
        
        // necessary to force the update to see the change
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }
    
    /**
     * @param entity
     */
    private function encodePassword($entity)
    {
        $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
    }


}