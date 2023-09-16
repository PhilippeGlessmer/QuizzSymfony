<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzUser>
 *
 * @method QuizzUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzUser[]    findAll()
 * @method QuizzUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzUser::class);
    }

//    /**
//     * @return QuizzUser[] Returns an array of QuizzUser objects
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

//    public function findOneBySomeField($value): ?QuizzUser
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
