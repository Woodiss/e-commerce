<?php

namespace App\Repository;

use App\Entity\BillingAdresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BillingAdresse>
 *
 * @method BillingAdresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method BillingAdresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method BillingAdresse[]    findAll()
 * @method BillingAdresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillingAdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BillingAdresse::class);
    }

//    /**
//     * @return BillingAdresse[] Returns an array of BillingAdresse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BillingAdresse
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
