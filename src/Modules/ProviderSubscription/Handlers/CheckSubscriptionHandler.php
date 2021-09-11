<?php

namespace App\Modules\ProviderSubscription\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\ProviderSubscription\Parameters\ProviderSubscriptionParameters;
use App\Schema\ProviderResponseSchema;

class CheckSubscriptionHandler extends AbstractChainHandler
{
    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var ProviderSubscriptionParameters $chainParameters */
        $receipt = $chainParameters->getReceipt();

        $lastNumber = (int)substr($receipt, -1);

        if ($lastNumber % 2 === 1) {
            $now = new \DateTime();
            $result = (new ProviderResponseSchema())
                ->setStatus(true)
                ->setExpireDate(
                    $now->modify('+1 day')->setTimezone(new \DateTimeZone('UTC'))
                );

            $chainParameters->setResult($result);
        }

        return $chainParameters;
    }
}
