<?php

namespace App\Modules\Purchase;

use App\Modules\Interfaces\ChainParametersInterface;
use App\Modules\Purchase\Handlers\CheckProviderHandler;
use App\Modules\Purchase\Handlers\PurchaseActionHandler;

class PurchaseManager
{
    /** @var CheckProviderHandler */
    private $checkProviderHandler;

    /** @var PurchaseActionHandler */
    private $purchaseActionHandler;

    private $initHandler;

    public function __construct(
        CheckProviderHandler $checkProviderHandler,
        PurchaseActionHandler $purchaseActionHandler
    ) {
        $this->checkProviderHandler = $checkProviderHandler;
        $this->purchaseActionHandler = $purchaseActionHandler;
    }

    public function purchase(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        return $this->getInitHandler()->handle($chainParameters);
    }

    /**
     * @required
     */
    public function prepareHandlers()
    {
        $this->checkProviderHandler->setNextHandler($this->purchaseActionHandler);

        $this->setInitHandler($this->checkProviderHandler);
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
