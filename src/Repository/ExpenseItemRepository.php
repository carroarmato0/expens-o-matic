<?php

namespace App\Repository;

use App\Entity\ExpenseItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExpenseItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpenseItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpenseItem[]    findAll()
 * @method ExpenseItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpenseItem::class);
    }

    // /**
    //  * @return ExpenseItem[] Returns an array of ExpenseItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExpenseItem
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
