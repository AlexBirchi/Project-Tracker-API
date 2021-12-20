<?php

namespace App\Repository;

use App\Entity\ItemPriority;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemPriority|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPriority|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPriority[]    findAll()
 * @method ItemPriority[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPriorityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPriority::class);
    }

    // /**
    //  * @return ItemPriority[] Returns an array of ItemPriority objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemPriority
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
