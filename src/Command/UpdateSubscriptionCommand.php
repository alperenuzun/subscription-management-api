<?php

namespace App\Command;

use App\Entity\Subscription;
use App\Modules\Purchase\Parameters\PurchaseParameters;
use App\Repository\Interfaces\SubscriptionRepositoryInterface;
use App\Service\Provider\ProviderRequestFactory;
use App\Service\SubscriptionStatusService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSubscriptionCommand extends Command
{
    private const ROW_COUNT = 10000;

    protected static $defaultName = 'subscription:update:command';

    /** @var ProviderRequestFactory */
    private $providerRequest;

    /** @var SubscriptionStatusService */
    private $subscriptionStatusService;

    /** @var SubscriptionRepositoryInterface */
    private $subscriptionRepository;

    public function __construct(
        ProviderRequestFactory $providerRequest,
        SubscriptionStatusService $subscriptionStatusService,
        SubscriptionRepositoryInterface $subscriptionRepository
    ) {
        $this->providerRequest = $providerRequest;
        $this->subscriptionStatusService = $subscriptionStatusService;
        $this->subscriptionRepository = $subscriptionRepository;

        parent::__construct(null);
    }

    public function configure()
    {
        $this->setDescription('Update subscription table to obtain their current status');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $subscriptions = $this->subscriptionRepository->getExpiredSubscriptions(self::ROW_COUNT);

        /** @var Subscription $subscription */
        foreach ($subscriptions as $subscription) {
            $operatingSystem = $subscription->getClient()->getDevice()->getOperatingSystem();

            $provider = $this->providerRequest->getProvider($operatingSystem);
            $response = $provider->checkSubscription('test1231');

            $status = $this->subscriptionStatusService->getStatus(
                (new PurchaseParameters())->setResult($response)->setStatus($response->getStatus())
            );
            $expireDate = $response->getExpireDate() ?? new \DateTime();

            $subscription
                ->setStatus($status)
                ->setExpireDate($expireDate)
                ->setCreatedAt(new \DateTime());
        }

        $this->subscriptionStatusService->flush();

        return 0;
    }
}
