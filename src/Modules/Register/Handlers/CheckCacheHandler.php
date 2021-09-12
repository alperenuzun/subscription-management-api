<?php

namespace App\Modules\Register\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Register\Parameters\RegisterParameters;
use App\Repository\Interfaces\TokenRepositoryInterface;

class CheckCacheHandler extends AbstractChainHandler
{
    private $tokenRepository;

    /**
     * @param TokenRepositoryInterface $tokenRepository
     */
    public function __construct(TokenRepositoryInterface $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var RegisterParameters $chainParameters */
        $uid = $chainParameters->getParameters()->get('uid');

        $token = $this->tokenRepository->getToken($uid);

        if ($token) {
            $chainParameters->setToken($token->getToken());
        }

        return $chainParameters;
    }
}
