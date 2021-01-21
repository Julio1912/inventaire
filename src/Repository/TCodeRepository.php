<?php

namespace App\Repository;

use App\Entity\TCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method TCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method TCode[]    findAll()
 * @method TCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TCodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TCode::class);
    }

    // /**
    //  * @return TCode[] Returns an array of TCode objects
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
    public function findOneBySomeField($value): ?TCode
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findCountCode()
    {
        return $this->createQueryBuilder('c')
        ->select ('count(c.id)')
        ->getQuery()
        ->getSingleScalarResult();

    }
}
