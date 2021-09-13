<?php

namespace App\Service;

use App\Entity\Subscription;
use App\Modules\Purchase\Parameters\PurchaseParameters;
use App\Repository\Interfaces\SubscriptionRepositoryInterface;
use App\Service\Interfaces\SubscriptionStatusInterface;

class SubscriptionStatusService implements SubscriptionStatusInterface
{
    /** @var SubscriptionRepositoryInterface */
    private $subscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function getSubscription(int $clientId): ?Subscription
    {
        return $this->subscriptionRepository->getSubscription($clientId);
    }

    public function getStatus(PurchaseParameters $chainParameters): int
    {
        $now = new \DateTime();

        if (!$chainParameters->getStatus()) {
            return Subscription::CANCELED_STATUS;
        } elseif ($chainParameters->getResult()->getExpireDate() > $now) {
            return Subscription::RENEWED_STATUS;
        }
        return Subscription::STARTED_STATUS;
    }

    public function save(Subscription $subscription): void
    {
        $this->subscriptionRepository->save($subscription);
    }

    public function flush(): void
    {
        $this->subscriptionRepository->flush();
    }
}
