<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activity>
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

       /**
        * @return Activity[] Returns an array of Activity objects
        */
       public function findByCategory($categoryId): array
       {
            return $this->createQueryBuilder('a')
                ->leftJoin('a.categories', 'c')
                ->andWhere('c.id IN(:val)')
                ->setParameter('val', $categoryId)
                ->getQuery()
                ->getResult()
            ;
       }

    //    public function findOneBySomeField($value): ?Activity
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
