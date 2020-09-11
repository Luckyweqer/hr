<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserHashPasswordListener implements EventSubscriber
{
    private $securityEncoderFactory;

    public function __construct(EncoderFactoryInterface $securityEncoderFactory)
    {
        $this->securityEncoderFactory = $securityEncoderFactory;
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
        $encoded = $this->securityEncoderFactory->getEncoder(
            $entity
        );
        $password = $encoded->encodePassword($entity->getPlainPassword(), $entity->getSalt());
        $entity->setPassword($password);
        $this->encodePassword($entity);
    }

    private function encodePassword(User $entity)
    {
        if (!$entity instanceof User) {
            return;
        }
        $encoded = $this->securityEncoderFactory->getEncoder(
            $entity
        );
        $password = $encoded->encodePassword($entity->getPlainPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }

        if($entity->getPlainPassword()) {
            $this->encodePassword($entity);
        }

        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }
}