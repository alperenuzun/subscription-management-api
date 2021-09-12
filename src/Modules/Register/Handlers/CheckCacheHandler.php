<?php

namespace App\Modules\Register\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Register\Parameters\RegisterParameters;
use App\Repository\Interfaces\TokenRepositoryInterface;
use App\Schema\TokenResponseSchema;
use App\Service\Interfaces\TokenServiceInterface;
use DateTime;

class CheckCacheHandler extends AbstractChainHandler
{
    private $tokenService;

    /**
     * @param TokenServiceInterface $tokenService
     */
    public function __construct(TokenServiceInterface $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var RegisterParameters $chainParameters */
        $uid = $chainParameters->getParameters()->get('uid');

        $token = $this->tokenService->getToken($uid);

        if ($token) {
            $chainParameters->setToken($token->getToken());
            $chainParameters->setResult(
                (new TokenResponseSchema())
                    ->setToken($token->getToken())
                    ->setUid($token->getUid())
                    ->setExpireDate(new DateTime($token->getExpireDate()->format('Y-m-d H:i:s')))
            );
        }

        return $chainParameters;
    }
}
