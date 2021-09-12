<?php

namespace App\Modules\Register\Parameters;

use App\Modules\Abstracts\AbstractChainParameters;
use App\Modules\Interfaces\ChainParametersInterface;
use App\Schema\TokenResponseSchema;
use Symfony\Component\HttpFoundation\ParameterBag;

class RegisterParameters extends AbstractChainParameters implements ChainParametersInterface
{
    /** @var null|ParameterBag */
    private $parameters = null;

    /** @var null|string */
    private $token = null;

    /** @var null|TokenResponseSchema */
    private $result = null;

    /**
     * @return ParameterBag|null
     */
    public function getParameters(): ?ParameterBag
    {
        return $this->parameters;
    }

    /**
     * @param ParameterBag|null $parameters
     * @return RegisterParameters
     */
    public function setParameters(?ParameterBag $parameters): self
    {
        $this->parameters = $parameters;

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
     * @return RegisterParameters
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return TokenResponseSchema|null
     */
    public function getResult(): ?TokenResponseSchema
    {
        return $this->result;
    }

    /**
     * @param TokenResponseSchema|null $result
     * @return RegisterParameters
     */
    public function setResult(?TokenResponseSchema $result): self
    {
        $this->result = $result;

        return $this;
    }
}