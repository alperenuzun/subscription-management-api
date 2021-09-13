<?php

namespace App\Modules\Purchase\Parameters;

use App\Modules\Abstracts\AbstractChainParameters;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Schema\ProviderResponseSchema;

class PurchaseParameters extends AbstractChainParameters implements ChainParametersInterface
{
    /** @var null|string */
    private $token = null;

    /** @var null|string */
    private $receipt = null;

    /** @var int */
    private $deviceId = 0;

    /** @var int  */
    private $appId = 0;

    /** @var null|ProviderResponseSchema */
    private $result = null;

    /** @var bool */
    private $status = false;

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return PurchaseParameters
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReceipt(): ?string
    {
        return $this->receipt;
    }

    /**
     * @param string|null $receipt
     * @return PurchaseParameters
     */
    public function setReceipt(?string $receipt): self
    {
        $this->receipt = $receipt;

        return $this;
    }

    /**
     * @return int
     */
    public function getDeviceId(): int
    {
        return $this->deviceId;
    }

    /**
     * @param int $deviceId
     * @return PurchaseParameters
     */
    public function setDeviceId(int $deviceId): self
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAppId(): int
    {
        return $this->appId;
    }

    /**
     * @param int $appId
     * @return PurchaseParameters
     */
    public function setAppId(int $appId): self
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * @return ProviderResponseSchema|null
     */
    public function getResult(): ?ProviderResponseSchema
    {
        return $this->result;
    }

    /**
     * @param ProviderResponseSchema|null $result
     * @return PurchaseParameters
     */
    public function setResult(?ProviderResponseSchema $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return PurchaseParameters
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}