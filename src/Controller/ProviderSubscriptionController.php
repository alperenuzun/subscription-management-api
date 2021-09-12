<?php

namespace App\Controller;

use App\Modules\ProviderSubscription\ProviderSubscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderSubscriptionController extends AbstractController
{
    /** @var ProviderSubscription */
    private $providerSubscription;

    public function __construct(ProviderSubscription $providerSubscription)
    {
        $this->providerSubscription = $providerSubscription;
    }

    /**
     * @Route("/google/check-subscription", name="google_check_subscription", methods={"POST"})
     */
    public function checkSubscriptionGoogle(Request $request): JsonResponse
    {
        $result = $this->providerSubscription->check($request);

        return new JsonResponse($result, Response::HTTP_OK);
    }

    /**
     * @Route("/ios/check-subscription", name="ios_check_subscription", methods={"POST"})
     */
    public function checkSubscriptionIos(Request $request): JsonResponse
    {
        $result = $this->providerSubscription->check($request);

        return new JsonResponse($result, Response::HTTP_OK);
    }
}
