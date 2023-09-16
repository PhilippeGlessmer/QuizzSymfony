<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzChoices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzChoices>
 *
 * @method QuizzChoices|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzChoices|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzChoices[]    findAll()
 * @method QuizzChoices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzChoicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzChoices::class);
    }

//    /**
//     * @return QuizzChoices[] Returns an array of QuizzChoices objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuizzChoices
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
