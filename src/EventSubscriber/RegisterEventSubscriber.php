<?php

namespace App\EventSubscriber;

use App\Entity\Application;
use App\Entity\Client;
use App\Entity\Device;
use App\Event\RegisterEvent;
use App\Repository\Interfaces\ApplicationRepositoryInterface;
use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Repository\Interfaces\DeviceRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegisterEventSubscriber implements EventSubscriberInterface
{
    /** @var ClientRepositoryInterface */
    private $clientRepository;

    /** @var DeviceRepositoryInterface */
    private $deviceRepository;

    /** @var ApplicationRepositoryInterface */
    private $applicationRepository;

    /**
     * @param ClientRepositoryInterface $clientRepository
     * @param DeviceRepositoryInterface $deviceRepository
     * @param ApplicationRepositoryInterface $applicationRepository
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        DeviceRepositoryInterface $deviceRepository,
        ApplicationRepositoryInterface $applicationRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->deviceRepository = $deviceRepository;
        $this->applicationRepository = $applicationRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RegisterEvent::class => 'registerAction'
        ];
    }

    public function registerAction(RegisterEvent $registerEvent): void
    {
        $device = $this->deviceRepository->getDeviceByUid($registerEvent->uid);

        if (!$device) {
            $deviceEntity = (new Device())
                ->setUid($registerEvent->uid)
                ->setLanguage($registerEvent->language)
                ->setOperatingSystem($registerEvent->operatingSystem);

            $this->deviceRepository->save($deviceEntity);
            $device = $deviceEntity;
        }

        $application = $this->applicationRepository->getApplicationById($registerEvent->appId);

        if (!$application) {
            $applicationEntity = (new Application())
                ->setName('test')
                ->setGoogleUser('test')
                ->setGooglePassword('test')
                ->setIosUser('test')
                ->setIosPassword('test');

            $this->applicationRepository->save($applicationEntity);
            $application = $applicationEntity;
        }

        if ($device && $application) {
            $client = $this->clientRepository->getClient($device->getId(), $application->getId());

            if (!$client) {
                $clientEntity = (new Client())->setApp($application)->setDevice($device);

                $this->clientRepository->save($clientEntity);
            }
        }
    }
}
