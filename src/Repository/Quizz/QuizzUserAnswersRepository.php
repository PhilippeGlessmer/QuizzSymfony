<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzUserAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzUserAnswers>
 *
 * @method QuizzUserAnswers|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzUserAnswers|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzUserAnswers[]    findAll()
 * @method QuizzUserAnswers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzUserAnswersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzUserAnswers::class);
    }

//    /**
//     * @return QuizzUserAnswers[] Returns an array of QuizzUserAnswers objects
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

//    public function findOneBySomeField($value): ?QuizzUserAnswers
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
