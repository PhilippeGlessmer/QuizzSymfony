<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzQuestions>
 *
 * @method QuizzQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzQuestions[]    findAll()
 * @method QuizzQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzQuestions::class);
    }

//    /**
//     * @return QuizzQuestions[] Returns an array of QuizzQuestions objects
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

//    public function findOneBySomeField($value): ?QuizzQuestions
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
