<?php

namespace App\Repository;

use App\Entity\MinuteTestEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MinuteTestEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MinuteTestEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MinuteTestEntity[]    findAll()
 * @method MinuteTestEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinuteTestEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MinuteTestEntity::class);
    }

    // /**
    //  * @return MinuteTestEntity[] Returns an array of MinuteTestEntity objects
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
    public function findOneBySomeField($value): ?MinuteTestEntity
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
