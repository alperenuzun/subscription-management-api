<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"GET"})
     */
    public function register()
    {
        return new JsonResponse(['token' => 'asd']);
    }
}
