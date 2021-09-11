<?php

namespace App\Modules\ProviderSubscription\Parameters;

use App\Modules\Abstracts\AbstractChainParameters;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Schema\ProviderResponseSchema;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ProviderSubscriptionParameters extends AbstractChainParameters implements ChainParametersInterface
{
    /** @var null|Request */
    private $request = null;

    /** @var null|string */
    private $receipt = null;

    /** @var null|ProviderResponseSchema */
    private $result = null;

    /**
     * @return Request|null
     */
    public function getRequest(): ?Request
    {
        return $this->request;
    }

    /**
     * @param Request|null $request
     * @return ProviderSubscriptionParameters
     */
    public function setRequest(?Request $request): self
    {
        $this->request = $request;

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
     * @return ProviderSubscriptionParameters
     */
    public function setReceipt(?string $receipt): self
    {
        $this->receipt = $receipt;

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
     * @return ProviderSubscriptionParameters
     */
    public function setResult(?ProviderResponseSchema $result): self
    {
        $this->result = $result;

        return $this;
    }
}
