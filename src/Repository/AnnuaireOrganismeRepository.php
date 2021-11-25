<?php

namespace App\Repository;

use App\Entity\AnnuaireOrganisme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnnuaireOrganisme|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnuaireOrganisme|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnuaireOrganisme[]    findAll()
 * @method AnnuaireOrganisme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnuaireOrganismeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnuaireOrganisme::class);
    }

    // /**
    //  * @return AnnuaireOrganisme[] Returns an array of AnnuaireOrganisme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnnuaireOrganisme
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
