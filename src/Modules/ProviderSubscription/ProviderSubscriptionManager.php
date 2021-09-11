<?php

namespace App\Modules\ProviderSubscription;

use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\ProviderSubscription\Handlers\CheckCredentialsHandler;
use App\Modules\ProviderSubscription\Handlers\CheckSubscriptionHandler;
use App\Modules\ProviderSubscription\Handlers\RateLimitHandler;

class ProviderSubscriptionManager
{
    /** @var CheckCredentialsHandler */
    private $checkCredentialsHandler;

    /** @var RateLimitHandler */
    private $rateLimitHandler;

    /** @var CheckSubscriptionHandler */
    private $checkSubscriptionHandler;

    private $initHandler;

    public function __construct(
        CheckCredentialsHandler $checkCredentialsHandler,
        RateLimitHandler $rateLimitHandler,
        CheckSubscriptionHandler $checkSubscriptionHandler
    ) {
        $this->checkCredentialsHandler = $checkCredentialsHandler;
        $this->rateLimitHandler = $rateLimitHandler;
        $this->checkSubscriptionHandler = $checkSubscriptionHandler;
    }

    public function checkSubscription(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        return $this->getInitHandler()->handle($chainParameters);
    }

    /**
     * @required
     */
    public function prepareHandlers()
    {
        $this->checkCredentialsHandler->setNextHandler($this->rateLimitHandler);
        $this->rateLimitHandler->setNextHandler($this->checkSubscriptionHandler);

        $this->setInitHandler($this->checkCredentialsHandler);
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
