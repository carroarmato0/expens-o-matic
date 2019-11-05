<?php

namespace App\Repository;

use App\Entity\Expense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\FetchMode;

/**
 * @method Expense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expense[]    findAll()
 * @method Expense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expense::class);
    }

  /**
   * @param $year string The year from which monthly expense totals are summed up
   * @param $approved bool Only show the approved expenses
   * @return mixed[]
   * @throws \Doctrine\DBAL\DBALException
   */
    public function getMonthlyTotalExpenses($year, $approved = true) {
      $conn = $this->getEntityManager()->getConnection();
      $sql = '
        SELECT MONTH(date) as month, ROUND(SUM(amount),2) as amount
        FROM expense
        WHERE approved IS NULL and YEAR(date) = :year
        GROUP BY YEAR(date),MONTH(date)
      ';

      $statement = $conn->prepare($sql);
      $statement->bindValue('year', $year);
      $statement->execute();
      $statement->setFetchMode(FetchMode::ASSOCIATIVE);
      return array_column($statement->fetchAll(), 'amount', 'month');
    }

    // /**
    //  * @return Expense[] Returns an array of Expense objects
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
    public function findOneBySomeField($value): ?Expense
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
