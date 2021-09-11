<?php

namespace App\Modules;

use App\Modules\Interfaces\ChainParametersInterface;
use Throwable;

abstract class AbstractChainHandler
{
    /** @var AbstractChainHandler|null */
    private $nextHandler = null;

    abstract public function process(ChainParametersInterface $chainParameters): ChainParametersInterface;

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return true;
    }

    public function handle(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        try {
            if ($this->isProcessable($chainParameters)) {
                $chainParameters = $this->process($chainParameters);
            }

            if ($this->getNextHandler()) {
                $chainParameters = $this->getNextHandler()->handle($chainParameters);
            }

            return $chainParameters;
        } catch (Throwable $exception) {
            $chainParameters->setLastException($exception);

            throw $exception;
        }
    }

    public function getNextHandler(): ?AbstractChainHandler
    {
        return $this->nextHandler;
    }

    public function setNextHandler(?AbstractChainHandler $nextHandler): AbstractChainHandler
    {
        $this->nextHandler = $nextHandler;

        return $this;
    }
}
