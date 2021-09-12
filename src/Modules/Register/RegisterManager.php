<?php

namespace App\Modules\Register;

use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Register\Handlers\CheckCacheHandler;
use App\Modules\Register\Handlers\TokenHandler;

class RegisterManager
{
    /** @var CheckCacheHandler */
    private $checkCacheHandler;

    /** @var TokenHandler */
    private $tokenHandler;

    private $initHandler;

    public function __construct(
        CheckCacheHandler $checkCacheHandler,
        TokenHandler $tokenHandler
    ) {
        $this->checkCacheHandler = $checkCacheHandler;
        $this->tokenHandler = $tokenHandler;
    }

    public function register(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        return $this->getInitHandler()->handle($chainParameters);
    }

    /**
     * @required
     */
    public function prepareHandlers()
    {
        $this->checkCacheHandler->setNextHandler($this->tokenHandler);

        $this->setInitHandler($this->checkCacheHandler);
    }

    /**
     * @return mixed
     */
    public function getInitHandler()
    {
        return $this->initHandler;
    }

    /**
     * @param mixed $initHandler
     */
    public function setInitHandler($initHandler): void
    {
        $this->initHandler = $initHandler;
    }
}
