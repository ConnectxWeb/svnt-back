<?php

namespace App\Repository;

use App\Entity\Gpx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gpx|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gpx|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gpx[]    findAll()
 * @method Gpx[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GpxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gpx::class);
    }

    // /**
    //  * @return Gpx[] Returns an array of Gpx objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gpx
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
