<?php

namespace App\Repository;

use App\Entity\CrafterComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CrafterComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrafterComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrafterComponent[]    findAll()
 * @method CrafterComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrafterComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrafterComponent::class);
    }

    // /**
    //  * @return CrafterComponent[] Returns an array of CrafterComponent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CrafterComponent
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
