<?php

namespace App\Repository;

use App\Entity\Ctheorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ctheorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ctheorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ctheorique[]    findAll()
 * @method Ctheorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtheoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ctheorique::class);
    }

    // public function getRest($candidat) {
    //
    //     return $this->getEntityManager()
    //       ->createQuery('SELECT SUM(c.montant) FROM App:Ctheorique c WHERE c.candidat = :candidat AND c.deleted = 0')
    //       ->setParameter('candidat', $candidat)
    //       ->getSingleScalarResult();
    //
    //     }


    // /**
    //  * @return Ctheorique[] Returns an array of Ctheorique objects
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
    public function findOneBySomeField($value): ?Ctheorique
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
