<?php

namespace App\Modules\ProviderSubscription;

use App\Modules\ProviderSubscription\Parameters\ProviderSubscriptionParameters;
use App\Schema\ProviderResponseSchema;
use Symfony\Component\HttpFoundation\Request;

class ProviderSubscription
{
    /** @var ProviderSubscriptionManager */
    private $providerSubscriptionManager;

    public function __construct(ProviderSubscriptionManager $providerSubscriptionManager)
    {
        $this->providerSubscriptionManager = $providerSubscriptionManager;
    }

    public function check(Request $request): ?ProviderResponseSchema
    {
        $chainParameters = (new ProviderSubscriptionParameters())->setRequest($request);

        /** @var ProviderSubscriptionParameters $chainParameters */
        $chainParameters = $this->providerSubscriptionManager->checkSubscription($chainParameters);

        return $chainParameters->getResult();
    }
}
