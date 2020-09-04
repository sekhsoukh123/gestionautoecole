<?php

namespace App\Repository;

use App\Entity\CarteGrise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteGrise|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteGrise|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteGrise[]    findAll()
 * @method CarteGrise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteGriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteGrise::class);
    }

    // /**
    //  * @return CarteGrise[] Returns an array of CarteGrise objects
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
    public function findOneBySomeField($value): ?CarteGrise
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
