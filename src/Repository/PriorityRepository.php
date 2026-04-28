<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Priority;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Response;

/**
 * @extends ServiceEntityRepository<Priority>
 */
class PriorityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Priority::class);
    }
    public function newPriority(User $user, ?string $priority = null)
    {
        $qb = $this ->createQueryBuilder('t')
        ->addSelect()
        ->where('t.user =:user')
        ->setParameter('user',$user);
    
        if($priority){
            $qb->leftJoin('u.priority','p')
            ->andWhere('P.name = :priority')
            ->setParameter('priority',$priority);
        }



    }
    //    /**
    //     * @return Priority[] Returns an array of Priority objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Priority
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
