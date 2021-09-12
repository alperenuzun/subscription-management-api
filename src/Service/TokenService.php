<?php

namespace App\Service;

use App\Schema\TokenResponseSchema;
use App\Service\Interfaces\TokenServiceInterface;
use DateTime;
use Firebase\JWT\JWT;

class TokenService implements TokenServiceInterface
{
    public function generateToken(string $uid): TokenResponseSchema
    {
        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTime();
        $expire     = $issuedAt->modify('+12 hours')->getTimestamp();
        $serverName = "your.domain.name";

        $data = [
            'iat'  => $issuedAt->getTimestamp(),
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
            'data' => [
                'uid' => $uid,
            ]
        ];

        return (new TokenResponseSchema())
            ->setToken(JWT::encode($data, $secretKey, 'HS512'))
            ->setUid($uid)
            ->setExpireDate($issuedAt);
    }
}
