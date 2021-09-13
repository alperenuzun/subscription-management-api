<?php

namespace App\Modules\Purchase\Handlers;

use App\Entity\Subscription;
use App\Event\SubscriptionStatusChangedEvent;
use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Purchase\Parameters\PurchaseParameters;
use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Service\Interfaces\SubscriptionStatusInterface;
use App\Traits\EventDispatcherTrait;

class PurchaseActionHandler extends AbstractChainHandler
{
    use EventDispatcherTrait;

    /** @var SubscriptionStatusInterface */
    private $subscriptionStatusService;

    /** @var ClientRepositoryInterface */
    private $clientRepositoryInterface;

    public function __construct(
        SubscriptionStatusInterface $subscriptionStatusService,
        ClientRepositoryInterface $clientRepositoryInterface
    ) {
        $this->subscriptionStatusService = $subscriptionStatusService;
        $this->clientRepositoryInterface = $clientRepositoryInterface;
    }

    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        /** @var PurchaseParameters $chainParameters */
        $client = $this->clientRepositoryInterface->getClient(
            $chainParameters->getDeviceId(),
            $chainParameters->getAppId()
        );

        if ($client) {
            $status = $this->subscriptionStatusService->getStatus($chainParameters);
            $expireDate = $chainParameters->getResult()->getExpireDate() ?? new \DateTime();

            $subscription = $this->subscriptionStatusService->getSubscription($client->getId());

            if (!$subscription) {
                $subscriptionEntity = (new Subscription())
                    ->setClient($client)
                    ->setStatus($status)
                    ->setExpireDate($expireDate)
                    ->setCreatedAt(new \DateTime());

                $this->subscriptionStatusService->save($subscriptionEntity);
            } else {
                $subscription
                    ->setStatus($status)
                    ->setExpireDate($expireDate)
                    ->setCreatedAt(new \DateTime());

                $this->subscriptionStatusService->flush();
            }

            $this->getEventDispatcher()->dispatch(
                new SubscriptionStatusChangedEvent(
                    $status,
                    $chainParameters->getAppId(),
                    $chainParameters->getDeviceId()
                )
            );
        }

        return $chainParameters;
    }
}
