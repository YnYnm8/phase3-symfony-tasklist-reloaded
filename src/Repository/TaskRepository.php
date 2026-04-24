<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

   public function findAllOrderedByStatus(): array
{
    return $this->createQueryBuilder('t')
        ->addSelect('CASE 
            WHEN t.status = \'pending\' THEN 1
            WHEN t.status = \'completed\' THEN 2
            WHEN t.status = \'archived\' THEN 3
            ELSE 4
            END AS HIDDEN statusOrder')
//              それ以外  → 4  ← ELSE 4
//              CASE ... END → これに'statusOrder'という名前をつける
// HIDDEN       → Twigには表示しない（裏側だけで使う）
        ->orderBy('statusOrder', 'ASC')
        // ASC  → 1,2,3の順（小さい順）
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Task[] Returns an array of Task objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Task
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
