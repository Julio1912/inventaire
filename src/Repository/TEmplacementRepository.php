<?php

namespace App\Repository;

use App\Entity\TEmplacement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TEmplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TEmplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TEmplacement[]    findAll()
 * @method TEmplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TEmplacementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TEmplacement::class);
    }

    // /**
    //  * @return TEmplacement[] Returns an array of TEmplacement objects
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
    public function findOneBySomeField($value): ?TEmplacement
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findCountEmplacement()
    {
        return $this->createQueryBuilder('e')
        ->select ('count(e.id)')
        ->getQuery()
        ->getSingleScalarResult();

    }
}
