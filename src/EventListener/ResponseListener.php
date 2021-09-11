<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ResponseListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $message = json_encode(['message' => $event->getThrowable()->getMessage()]);

        $response = new Response($message);

        $event->setResponse($response);
    }
}
