<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findLatestReviews(int $limit = 10): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function save(Review $review, bool $flush = true): void
    {
        $this->getEntityManager()->persist($review);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}