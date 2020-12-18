<?php

namespace App\Repository;

use App\Entity\Maraude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Maraude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maraude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maraude[]    findAll()
 * @method Maraude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaraudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maraude::class);
    }

    // /**
    //  * @return Maraude[] Returns an array of Maraude objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Maraude
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
