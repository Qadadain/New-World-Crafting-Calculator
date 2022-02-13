<?php

namespace App\Repository;

use App\Entity\TradeSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TradeSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method TradeSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method TradeSkill[]    findAll()
 * @method TradeSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TradeSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TradeSkill::class);
    }

    // /**
    //  * @return TradeSkill[] Returns an array of TradeSkill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TradeSkill
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
