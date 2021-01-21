<?php

namespace App\Repository;

use App\Entity\TBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method TBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method TBase[]    findAll()
 * @method TBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TBase::class);
    }

    public function findAllBaseJoinedToCode($id)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT b,c
            FROM App\Entity\TBase b
            INNER JOIN b.CodeComplet c
            where b.id = :id'
        )->setParameter('CodeComplet' , $id); 
        return $query->execute();
    }

    // /**
    //  * @return TBase[] Returns an array of TBase objects
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
    public function findOneBySomeField($value): ?TBase
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findCountBase()
    {
        return $this->createQueryBuilder('b')
        ->select ('count(b.id)')
        ->getQuery()
        ->getSingleScalarResult();

    }

    public function findBaseCode()
    {
        return $this->createQueryBuilder('b')
        ->innerjoin('b.CodeComplet' , 'c')
        ->getQuery()
        ->getResult() ; 

    }



}
