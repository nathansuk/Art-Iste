<?php

namespace App\Repository;

use App\Entity\ArtisansJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtisansJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtisansJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtisansJob[]    findAll()
 * @method ArtisansJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisansJobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtisansJob::class);
    }

    // /**
    //  * @return ArtisansJob[] Returns an array of ArtisansJob objects
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
    public function findOneBySomeField($value): ?ArtisansJob
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
