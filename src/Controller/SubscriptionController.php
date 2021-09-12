<?php

namespace App\Controller;

use App\Modules\Register\Register;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, Register $register): JsonResponse
    {
        $tokenResult = $register->register($request);

        return new JsonResponse($tokenResult);
    }

    /**
     * @Route("/check-subscription", name="check_subscription", methods={"POST"})
     */
    public function checkSubscription(Request $request): JsonResponse
    {
        return new JsonResponse([$request]);
    }
}
