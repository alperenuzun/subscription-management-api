<?php

namespace App\Modules\Register\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Register\Parameters\RegisterParameters;
use App\Repository\Interfaces\TokenRepositoryInterface;
use App\Service\Interfaces\TokenServiceInterface;

class TokenHandler extends AbstractChainHandler
{
    private $tokenService;

    private $tokenRepository;

    /**
     * @param TokenServiceInterface $tokenService
     * @param TokenRepositoryInterface $tokenRepository
     */
    public function __construct(TokenServiceInterface $tokenService, TokenRepositoryInterface $tokenRepository)
    {
        $this->tokenService = $tokenService;
        $this->tokenRepository = $tokenRepository;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return !$chainParameters->getToken();
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var RegisterParameters $chainParameters */
        $uid = $chainParameters->getParameters()->get('uid');

        $tokenResponse = $this->tokenService->generateToken($uid);
        $chainParameters->setToken($tokenResponse->getToken());

        // cache'e uid için token'ı yaz
        $this->tokenRepository->saveToken($tokenResponse);

        // client tablosuna eklemek için event fırlat (varsa ekleme)

        return $chainParameters;
    }
}
