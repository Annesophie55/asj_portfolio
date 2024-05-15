<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    //    /**
    //     * @return Project[] Returns an array of Project objects
    //     */
       public function findByTechnology($techno_id): array
       {
           return $this->createQueryBuilder('p')
                ->join('p.technologies', 't')
               ->andWhere('t.id = :techno_id')
               ->setParameter('techno_id', $techno_id)
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Project
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
