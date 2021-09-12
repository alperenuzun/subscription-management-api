<?php

namespace App\Controller;

use App\Helper\RequestBodyResolver;
use App\Modules\Register\Register;
use App\Service\Interfaces\TokenServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController implements TokenAuthenticatedController
{
    /**
     * @Route("/check-subscription", name="check_subscription", methods={"POST"})
     */
    public function checkSubscription(Request $request, TokenServiceInterface $tokenService): JsonResponse
    {
        $parameters = RequestBodyResolver::resolve($request);

        $exist = $tokenService->exists($parameters->get('client_token'));

        return new JsonResponse(['status' => $exist]);
    }
}
