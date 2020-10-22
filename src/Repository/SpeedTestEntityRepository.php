<?php

namespace App\Repository;

use App\Entity\ProjectTest\SpeedTestEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpeedTestEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpeedTestEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpeedTestEntity[]    findAll()
 * @method SpeedTestEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpeedTestEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpeedTestEntity::class);
    }

    // /**
    //  * @return SpeedTestEntity[] Returns an array of SpeedTestEntity objects
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
    public function findOneBySomeField($value): ?SpeedTestEntity
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
