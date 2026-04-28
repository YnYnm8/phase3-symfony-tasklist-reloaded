<?php

namespace App\Repository;

use App\Entity\User;
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

    public function findAllOrderedByStatus(User $user, ?string $status = null, ?string $priority = null): array
    {
        $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.priority', 'p')
                  //        ↑            ↑
                //     Taskのpriority  別名を'p'にする
                // priority_idだけじゃ名前がわからない → 結合が必要 2つのテーブルを結合するという意味です。
            ->addSelect('CASE 
            WHEN t.status = \'pending\' THEN 1
            WHEN t.status = \'completed\' THEN 2
            WHEN t.status = \'archived\' THEN 3
            ELSE 4
            END AS HIDDEN statusOrder')
            //              それ以外  → 4  ← ELSE 4
            //              CASE ... END → これに'statusOrder'という名前をつける
            // HIDDEN       → Twigには表示しない（裏側だけで使う）
            ->where('t.user = :user')      // 「userが○○のものだけ」
            ->setParameter('user', $user);  // 「○○」= ログインユーザー


        // 本来であればこのように記入するがIFの中ではー＞は使えないので記入の仕方が異なる。
        // if ($status) {
        //     ->andWhere('t.status = :status')
        //     ->setParameter('status', $status)
        // }
        // if ($priority) {
        //     // priorityの条件も追加
        //     ->andWhere('t.priority =:priority')
        //     ->setparemeter('priority',$priority)
        // }

        if ($status) {
            $qb->andWhere('t.status = :status')
                ->setParameter('status', $status);
        }
        if ($priority) {
            $qb->andWhere('p.name = :priority')
                ->setParameter('priority', $priority);
        }

        return $qb->orderBy('t.isPinned', 'DESC')
            ->addOrderBy('statusOrder', 'ASC')
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
