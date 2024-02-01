<?php

namespace App\Repository;

use App\Entity\RepasMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RepasMenu>
 *
 * @method RepasMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepasMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepasMenu[]    findAll()
 * @method RepasMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepasMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepasMenu::class);
    }

//    /**
//     * @return RepasMenu[] Returns an array of RepasMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RepasMenu
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
