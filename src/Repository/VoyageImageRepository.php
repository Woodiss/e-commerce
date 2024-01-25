<?php

namespace App\Repository;

use App\Entity\VoyageImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoyageImage>
 *
 * @method VoyageImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageImage[]    findAll()
 * @method VoyageImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageImage::class);
    }

//    /**
//     * @return VoyageImage[] Returns an array of VoyageImage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VoyageImage
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
