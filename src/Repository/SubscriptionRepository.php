<?php

namespace App\Repository;

use App\Entity\Subscription;
use App\Repository\Interfaces\SubscriptionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscription[]    findAll()
 * @method Subscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository implements SubscriptionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    public function getSubscription(int $clientId): ?Subscription
    {
        return $this->findOneBy(['clientId' => $clientId]);
    }

    public function save(Subscription $subscription): void
    {
        $this->_em->persist($subscription);
        $this->_em->flush();
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
