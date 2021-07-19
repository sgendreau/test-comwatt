<?php

namespace App\Repository;

use App\Entity\RefTypeProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RefTypeProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefTypeProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefTypeProduit[]    findAll()
 * @method RefTypeProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefTypeProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefTypeProduit::class);
    }

    // /**
    //  * @return RefTypeProduit[] Returns an array of RefTypeProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RefTypeProduit
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
