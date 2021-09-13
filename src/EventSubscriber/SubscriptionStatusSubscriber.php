<?php

namespace App\EventSubscriber;

use App\Event\SubscriptionStatusChangedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SubscriptionStatusSubscriber implements EventSubscriberInterface
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SubscriptionStatusChangedEvent::class => 'statusChanged'
        ];
    }

    public function statusChanged(SubscriptionStatusChangedEvent $statusChangedEvent): void
    {
        $this->client->request('POST', 'http://localhost:8080', [
            'json' => [
                'appId' => $statusChangedEvent->appId,
                'deviceId' => $statusChangedEvent->deviceId,
                'status' => $statusChangedEvent->status
            ]
        ]);
    }
}
