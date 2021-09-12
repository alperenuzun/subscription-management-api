<?php

namespace App\Repository\Interfaces;

use App\Entity\Application;

interface ApplicationRepositoryInterface
{
    public function getApplicationById(int $id): ?Application;

    public function save(Application $application): void;
}
