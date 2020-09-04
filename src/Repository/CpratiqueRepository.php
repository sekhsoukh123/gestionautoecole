<?php

namespace App\Repository;

use App\Entity\Cpratique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cpratique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cpratique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cpratique[]    findAll()
 * @method Cpratique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpratiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cpratique::class);
    }

    // public function getRest($candidat) {
    //
    //     return $this->getEntityManager()
    //       ->createQuery('SELECT SUM(c.montant) FROM App:Cpratique c WHERE c.candidat = :candidat AND c.deleted = 0')
    //       ->setParameter('candidat', $candidat)
    //       ->getSingleScalarResult();
    //
    //     }


    // /**
    //  * @return Cpratique[] Returns an array of Cpratique objects
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
    public function findOneBySomeField($value): ?Cpratique
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
