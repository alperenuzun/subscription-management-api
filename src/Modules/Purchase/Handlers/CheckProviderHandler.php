<?php

namespace App\Modules\Purchase\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Purchase\Parameters\PurchaseParameters;
use App\Repository\Interfaces\DeviceRepositoryInterface;
use App\Service\Interfaces\TokenServiceInterface;
use App\Service\Provider\ProviderRequestFactory;

class CheckProviderHandler extends AbstractChainHandler
{
    /** @var ProviderRequestFactory */
    private $providerRequest;

    /** @var TokenServiceInterface */
    private $tokenService;

    /** @var DeviceRepositoryInterface */
    private $deviceRepository;

    public function __construct(
        ProviderRequestFactory $providerRequest,
        TokenServiceInterface $tokenService,
        DeviceRepositoryInterface $deviceRepository
    ) {
        $this->providerRequest = $providerRequest;
        $this->tokenService = $tokenService;
        $this->deviceRepository = $deviceRepository;
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var PurchaseParameters $chainParameters */
        $token = $chainParameters->getToken();
        $receipt = $chainParameters->getReceipt();

        $tokenEntity = $this->tokenService->getTokenByToken($token);
        $device = $this->deviceRepository->getDeviceByUid($tokenEntity->getUid());

        $provider = $this->providerRequest->getProvider($device->getOperatingSystem());
        $response = $provider->checkSubscription($receipt);

        $chainParameters
            ->setResult($response)
            ->setStatus($response->getStatus())
            ->setDeviceId($device->getId())
            ->setAppId(0);

        return $chainParameters;
    }
}
