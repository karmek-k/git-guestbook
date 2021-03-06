<?php

namespace App\Repository;

use App\Entity\GuestbookEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GuestbookEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method GuestbookEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method GuestbookEntry[]    findAll()
 * @method GuestbookEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestbookEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GuestbookEntry::class);
    }

    // /**
    //  * @return GuestbookEntry[] Returns an array of GuestbookEntry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GuestbookEntry
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
