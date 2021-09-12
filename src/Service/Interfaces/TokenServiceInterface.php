<?php

namespace App\Service\Interfaces;

use App\Entity\Token;
use App\Schema\TokenResponseSchema;

interface TokenServiceInterface
{
    public function generateToken(string $uid): TokenResponseSchema;

    public function getToken(string $uid): ?Token;

    public function exists(string $token): bool;

    public function saveToken(TokenResponseSchema $tokenResponseSchema): void;
}
