<?php

namespace App\Repository;

use App\Entity\RoleAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RoleAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleAssignment[]    findAll()
 * @method RoleAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleAssignmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoleAssignment::class);
    }

    // /**
    //  * @return RoleAssignment[] Returns an array of RoleAssignment objects
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
    public function findOneBySomeField($value): ?RoleAssignment
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
