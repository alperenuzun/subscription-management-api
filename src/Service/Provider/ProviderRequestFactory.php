<?php

namespace App\Service\Provider;

use App\Entity\Device;
use App\Service\Interfaces\ProviderRequestInterface;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderRequestFactory
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getProvider(string $operatingSystem): ProviderRequestInterface
    {
        if ($operatingSystem === Device::OS_ANDROID) {
            return new GoogleProviderRequest($this->client);
        } elseif ($operatingSystem === Device::OS_IOS) {
            return new GoogleProviderRequest($this->client);
        }

        throw new InvalidArgumentException('invalid argument!');
    }
}
