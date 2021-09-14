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

    public function getExpiredSubscriptions(int $limit = 0)
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        $query = $this->createQueryBuilder('s')
            ->where('s.status != :canceled AND s.expireDate < :now')
            ->orderBy('s.expireDate', 'ASC')
            ->setParameter('canceled', Subscription::CANCELED_STATUS)
            ->setParameter('now', $now)
            ->getQuery();

        if ($limit) {
            $query->setMaxResults($limit);
        }

        return $query->getResult();
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
