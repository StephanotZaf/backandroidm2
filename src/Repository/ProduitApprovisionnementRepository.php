<?php

namespace App\Repository;

use App\Entity\ProduitApprovisionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitApprovisionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitApprovisionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitApprovisionnement[]    findAll()
 * @method ProduitApprovisionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitApprovisionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitApprovisionnement::class);
    }

    // /**
    //  * @return ProduitApprovisionnement[] Returns an array of ProduitApprovisionnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitApprovisionnement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
