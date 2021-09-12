<?php

namespace App\Modules\Purchase;

use App\Helper\RequestBodyResolver;
use App\Modules\Purchase\Parameters\PurchaseParameters;
use Symfony\Component\HttpFoundation\Request;

class Purchase
{
    /** @var PurchaseManager */
    private $purchaseManager;

    public function __construct(PurchaseManager $purchaseManager)
    {
        $this->purchaseManager = $purchaseManager;
    }

    public function purchase(Request $request): bool
    {
        $parameters = RequestBodyResolver::resolve($request);

        $chainParameters = (new PurchaseParameters())
            ->setToken($parameters->get('client_token'))
            ->setReceipt($parameters->get('receipt'));

        /** @var PurchaseParameters $chainParameters */
        $chainParameters = $this->purchaseManager->purchase($chainParameters);

        return $chainParameters->getStatus();
    }
}
