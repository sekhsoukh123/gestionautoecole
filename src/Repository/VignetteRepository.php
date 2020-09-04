<?php

namespace App\Repository;

use App\Entity\Vignette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vignette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vignette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vignette[]    findAll()
 * @method Vignette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VignetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vignette::class);
    }

    // /**
    //  * @return Vignette[] Returns an array of Vignette objects
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
    public function findOneBySomeField($value): ?Vignette
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
