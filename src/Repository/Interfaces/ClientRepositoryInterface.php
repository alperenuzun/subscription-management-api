<?php

namespace App\Repository\Interfaces;

use App\Entity\Client;

interface ClientRepositoryInterface
{
    public function getClient(int $deviceId, int $appId): ?Client;

    public function save(Client $client): void;

    public function flush(): void;
}
