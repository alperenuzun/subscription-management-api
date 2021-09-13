<?php

namespace App\Service\Interfaces;

use App\Entity\Subscription;
use App\Modules\Purchase\Parameters\PurchaseParameters;

interface SubscriptionStatusInterface
{
    public function getSubscription(int $clientId): ?Subscription;

    public function getStatus(PurchaseParameters $chainParameters): int;

    public function save(Subscription $subscription): void;

    public function flush(): void;
}
