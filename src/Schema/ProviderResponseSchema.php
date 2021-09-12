<?php

namespace App\Schema;

use App\Traits\JsonSerializableTrait;
use DateTime;

class ProviderResponseSchema implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var bool $status */
    private $status = false;

    /** @var null|DateTime $expireDate */
    private $expireDate = null;

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return ProviderResponseSchema
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
     * @return ProviderResponseSchema
     */
    public function setExpireDate(?DateTime $expireDate): self
    {
        $this->expireDate = $expireDate;

        return $this;
    }
}
