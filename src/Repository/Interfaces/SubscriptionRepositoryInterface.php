<?php

namespace App\Repository\Interfaces;

use App\Entity\Subscription;

interface SubscriptionRepositoryInterface
{
    public function getSubscription(int $clientId): ?Subscription;

    public function save(Subscription $subscription): void;

    public function flush(): void;
}
