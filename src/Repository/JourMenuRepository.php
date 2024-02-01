<?php

namespace App\Repository;

use App\Entity\JourMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JourMenu>
 *
 * @method JourMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourMenu[]    findAll()
 * @method JourMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JourMenu::class);
    }

//    /**
//     * @return JourMenu[] Returns an array of JourMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JourMenu
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
