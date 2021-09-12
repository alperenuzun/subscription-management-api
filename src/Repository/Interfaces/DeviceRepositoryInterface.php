<?php

namespace App\Repository\Interfaces;

use App\Entity\Device;

interface DeviceRepositoryInterface
{
    public function getDeviceByUid(int $uId): ?Device;

    public function save(Device $device): void;
}
