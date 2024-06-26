<?php

namespace App\Repository;

use App\Entity\DeliveryAdresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliveryAdresse>
 *
 * @method DeliveryAdresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryAdresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryAdresse[]    findAll()
 * @method DeliveryAdresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryAdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryAdresse::class);
    }

//    /**
//     * @return DeliveryAdresse[] Returns an array of DeliveryAdresse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DeliveryAdresse
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
