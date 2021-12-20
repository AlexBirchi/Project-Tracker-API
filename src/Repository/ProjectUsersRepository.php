<?php

namespace App\Repository;

use App\Entity\ProjectUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectUsers[]    findAll()
 * @method ProjectUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectUsers::class);
    }

    // /**
    //  * @return ProjectUsers[] Returns an array of ProjectUsers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectUsers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
