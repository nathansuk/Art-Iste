<?php

namespace App\Repository;

use App\Entity\ArtisanPhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtisanPhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtisanPhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtisanPhotos[]    findAll()
 * @method ArtisanPhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisanPhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtisanPhotos::class);
    }

    // /**
    //  * @return ArtisanPhotos[] Returns an array of ArtisanPhotos objects
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
    public function findOneBySomeField($value): ?ArtisanPhotos
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
