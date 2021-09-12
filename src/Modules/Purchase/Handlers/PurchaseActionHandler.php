<?php

namespace App\Modules\Purchase\Handlers;

use App\Modules\AbstractChainHandler;
use App\Modules\Interfaces\ChainParametersInterface;

class PurchaseActionHandler extends AbstractChainHandler
{
    public function process(ChainParametersInterface $chainParameters): ChainParametersInterface
    {
        // subscription tablosuna ekle

        // started, renewed, canceled event fırlat

        return $chainParameters;
    }
}
