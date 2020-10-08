<?php

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Persistence\Mapping\MappingException;
use ReflectionException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordSubscriber implements EventSubscriber
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getSubscribedEvents(): array
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $user = $args->getEntity();

        if (!$user instanceof User) {
            return;
        }

        $this->encodePassword($user);
    }

    private function encodePassword(User $user): void
    {
        if (!$user->getPlainPassword()) {
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword(
            $user,
            $user->getPlainPassword()
        );

        $user->setPassword($encoded);
        $user->eraseCredentials();
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $user = $args->getEntity();

        if (!$user instanceof User) {
            return;
        }

        $this->encodePassword($user);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($user));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
    }
}
