<?php

namespace App\Controller;

use App\Modules\Purchase\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController implements TokenAuthenticatedController
{
    /**
     * @Route("/purchase", name="purchase", methods={"POST"})
     */
    public function purchase(Request $request, Purchase $purchase): JsonResponse
    {
        $status = $purchase->purchase($request);

        return new JsonResponse(['status' => $status]);
    }
}
