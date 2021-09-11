<?php

namespace App\Modules\ProviderSubscription\Handlers;

use App\Helper\RequestBodyResolver;
use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\ProviderSubscription\Parameters\ProviderSubscriptionParameters;
use Doctrine\ORM\Cache\LockException;

class RateLimitHandler extends AbstractChainHandler
{
    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var ProviderSubscriptionParameters $chainParameters */
        $request = $chainParameters->getRequest();

        $parameters = RequestBodyResolver::resolve($request);

        $receipt = $parameters->get('receipt', '');
        $chainParameters->setReceipt($receipt);

        $lastNumber = (int)substr($receipt, -2);

        if ($lastNumber % 6 === 0) {
            throw new LockException('The rate limit is over!');
        }

        return $chainParameters;
    }
}
