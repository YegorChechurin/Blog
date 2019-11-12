<?php

namespace App\Repository;

use App\Entity\ExternalIdTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExternalIdTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalIdTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalIdTest[]    findAll()
 * @method ExternalIdTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalIdTestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExternalIdTest::class);
    }

    // /**
    //  * @return ExternalIdTest[] Returns an array of ExternalIdTest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExternalIdTest
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*'select count(*) from table t1 inner join table t2 
    on t1.id<>t2.id 
    and t1.status_code=1 
    and t2.status_code=1 
    and t1.external_id=t2.external_id 
    group by t1.external_id, t2.external_id'*/
}
