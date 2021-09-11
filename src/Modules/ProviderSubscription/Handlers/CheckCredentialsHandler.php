<?php

namespace App\Modules\ProviderSubscription\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\ProviderSubscription\Parameters\ProviderSubscriptionParameters;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckCredentialsHandler extends AbstractChainHandler
{
    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var ProviderSubscriptionParameters $chainParameters */
        $request = $chainParameters->getRequest();

        $username = $request->headers->get('username');
        $password = $request->headers->get('password');

        if (!$username || !$password) {
            throw new UnauthorizedHttpException('', 'Please check your credentials!');
        }

        return $chainParameters;
    }
}
