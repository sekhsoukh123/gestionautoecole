<?php

namespace App\Repository;

use App\Entity\Cpayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cpayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cpayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cpayment[]    findAll()
 * @method Cpayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cpayment::class);
    }

    public function getRest($candidat) {

        return $this->getEntityManager()
          ->createQuery('SELECT SUM(c.montant) FROM App:Cpayment c WHERE c.candidat = :candidat AND c.deleted = 0')
          ->setParameter('candidat', $candidat)
          ->getSingleScalarResult();

        }


    // /**
    //  * @return Cpayment[] Returns an array of Cpayment objects
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
    public function findOneBySomeField($value): ?Cpayment
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
