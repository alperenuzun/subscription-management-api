<?php

namespace App\Modules\Abstracts;

use Throwable;

abstract class AbstractChainParameters
{
    /** @var Throwable|null */
    private $lastException = null;

    /**
     * @return Throwable|null
     */
    public function getLastException(): ?Throwable
    {
        return $this->lastException;
    }

    /**
     * @param Throwable|null $lastException
     */
    public function setLastException(?Throwable $lastException): void
    {
        $this->lastException = $lastException;
    }
}
