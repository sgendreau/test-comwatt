<?php

namespace App\Repository;

use App\Entity\RefTypeGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RefTypeGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefTypeGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefTypeGenre[]    findAll()
 * @method RefTypeGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefTypeGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefTypeGenre::class);
    }

    // /**
    //  * @return RefTypeGenre[] Returns an array of RefTypeGenre objects
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
    public function findOneBySomeField($value): ?RefTypeGenre
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
