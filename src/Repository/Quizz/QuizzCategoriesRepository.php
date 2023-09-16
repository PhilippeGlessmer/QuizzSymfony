<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzCategories>
 *
 * @method QuizzCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzCategories[]    findAll()
 * @method QuizzCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzCategories::class);
    }

//    /**
//     * @return QuizzCategories[] Returns an array of QuizzCategories objects
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

//    public function findOneBySomeField($value): ?QuizzCategories
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
