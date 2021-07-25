<?php

namespace App\Repository;

use App\Entity\Receiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Receiver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Receiver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Receiver[]    findAll()
 * @method Receiver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceiverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Receiver::class);
    }

    public function add(Receiver $receiver, bool $flush = true): void
    {
        $this->getEntityManager()->persist($receiver);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
