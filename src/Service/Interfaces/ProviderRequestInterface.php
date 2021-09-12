<?php

namespace App\Service\Interfaces;

use App\Schema\ProviderResponseSchema;

interface ProviderRequestInterface
{
    public function checkSubscription(string $receipt): ?ProviderResponseSchema;
}
