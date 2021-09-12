<?php

namespace App\Schema;

use DateTime;

class TokenResponseSchema
{
    /** @var null|string */
    private $uid;

    /** @var null|string */
    private $token;

    /** @var null|DateTime */
    private $expireDate;

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @param string|null $uid
     * @return TokenResponseSchema
     */
    public function setUid(?string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return TokenResponseSchema
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getExpireDate(): ?DateTime
    {
        return $this->expireDate;
    }

    /**
     * @param DateTime|null $expireDate
     * @return TokenResponseSchema
     */
    public function setExpireDate(?DateTime $expireDate): self
    {
        $this->expireDate = $expireDate;

        return $this;
    }
}
