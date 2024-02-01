<?php

namespace App\Repository;

use App\Entity\SemaineResa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SemaineResa>
 *
 * @method SemaineResa|null find($id, $lockMode = null, $lockVersion = null)
 * @method SemaineResa|null findOneBy(array $criteria, array $orderBy = null)
 * @method SemaineResa[]    findAll()
 * @method SemaineResa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemaineResaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SemaineResa::class);
    }

//    /**
//     * @return SemaineResa[] Returns an array of SemaineResa objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SemaineResa
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
