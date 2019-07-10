<?php

namespace App\Repository;

use App\Entity\StoragePlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StoragePlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method StoragePlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method StoragePlace[]    findAll()
 * @method StoragePlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoragePlaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StoragePlace::class);
    }

    // /**
    //  * @return StoragePlace[] Returns an array of StoragePlace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StoragePlace
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
