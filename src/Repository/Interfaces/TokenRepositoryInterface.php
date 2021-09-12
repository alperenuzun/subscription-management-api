<?php

namespace App\Repository\Interfaces;

use App\Entity\Token;
use App\Schema\TokenResponseSchema;

interface TokenRepositoryInterface
{
    public function getToken(string $uid): ?Token;

    public function exists(string $token): bool;

    public function saveToken(TokenResponseSchema $tokenResponseSchema): void;
}
