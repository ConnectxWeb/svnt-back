<?php

namespace App\EventSubscriber;

use App\Entity\Gpx;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['BeforeEntityPersisted'],
            BeforeEntityUpdatedEvent::class => ['BeforeEntityUpdated'],
//            BeforeEntityUpdatedEvent::class => ['updateOperateur'],
        ];
    }

    public function BeforeEntityPersisted(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

//        if ($entity instanceof Gpx) {
//            $entity->setIsValid(false);
//
//            return;
//        }
    }

    public function BeforeEntityUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Gpx) {
            $entity->setIsValid(false); //force file to be checked if updated

            return;
        }
    }

//    public function updateOperateur(BeforeEntityUpdatedEvent $event)
//    {
//        $entity = $event->getEntityInstance();
//        if (!($entity instanceof Operateur)) {
//            return;
//        }
//        $this->setOperateurTemp($entity);
//    }
//
//    public function addUser(BeforeEntityPersistedEvent $event)
//    {
//        $entity = $event->getEntityInstance();
//
//        if (!($entity instanceof User)) {
//            return;
//        }
//        $this->setPassword($entity);
//    }

//    /**
//     * @param User $entity
//     */
//    public function setPassword(User $entity): void
//    {
//        $pass = $entity->getPassword();
//
//        $entity->setPassword(
//            $this->passwordEncoder->encodePassword(
//                $entity,
//                $pass
//            )
//        );
//        $this->entityManager->persist($entity);
//        $this->entityManager->flush();
//    }

    /**
     * @param Operateur $entity
     */
    public function setOperateurTemp(Operateur $entity): void
    {
        $operator_temp = new OperateurTemp();

        $operator_temp->setName($entity->getName());
        $operator_temp->setDescription($entity->getDescription());
        $operator_temp->setLatitude($entity->getLatitude());
        $operator_temp->setLongitude($entity->getLongitude());

        var_dump($entity);
        var_dump($operator_temp);

        $this->entityManager->persist($operator_temp);
        $this->entityManager->flush();
    }
}