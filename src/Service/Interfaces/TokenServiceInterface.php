<?php

namespace App\Service\Interfaces;

use App\Schema\TokenResponseSchema;

interface TokenServiceInterface
{
    public function generateToken(string $uid): TokenResponseSchema;
}
