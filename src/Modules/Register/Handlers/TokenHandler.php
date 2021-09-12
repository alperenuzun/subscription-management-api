<?php

namespace App\Modules\Register\Handlers;

use App\Event\RegisterEvent;
use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Register\Parameters\RegisterParameters;
use App\Service\Interfaces\TokenServiceInterface;
use App\Traits\EventDispatcherTrait;

class TokenHandler extends AbstractChainHandler
{
    use EventDispatcherTrait;

    private $tokenService;

    /**
     * @param TokenServiceInterface $tokenService
     */
    public function __construct(TokenServiceInterface $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return !$chainParameters->getToken();
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var RegisterParameters $chainParameters */
        $uid = $chainParameters->getParameters()->get('uid');
        $appId = $chainParameters->getParameters()->get('app_id');
        $language = $chainParameters->getParameters()->get('language');
        $operatingSystem = $chainParameters->getParameters()->get('operating_system');

        $tokenResponse = $this->tokenService->generateToken($uid);
        $chainParameters->setToken($tokenResponse->getToken());
        $chainParameters->setResult($tokenResponse);

        // cache'e uid için token'ı yaz
        $this->tokenService->saveToken($tokenResponse);

        // client tablosuna eklemek için event fırlat (varsa ekleme)
        $this->getEventDispatcher()->dispatch(
            new RegisterEvent($tokenResponse->getUid(), (int)$appId, $language, $operatingSystem)
        );

        return $chainParameters;
    }
}
