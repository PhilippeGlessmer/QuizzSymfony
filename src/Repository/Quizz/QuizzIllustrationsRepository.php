<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzIllustrations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzIllustrations>
 *
 * @method QuizzIllustrations|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzIllustrations|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzIllustrations[]    findAll()
 * @method QuizzIllustrations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzIllustrationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzIllustrations::class);
    }

//    /**
//     * @return QuizzIllustrations[] Returns an array of QuizzIllustrations objects
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

//    public function findOneBySomeField($value): ?QuizzIllustrations
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
