<?php

namespace App\EventSubscriber;

use App\Controller\TokenAuthenticatedController;
use App\Helper\RequestBodyResolver;
use App\Service\Interfaces\TokenServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface
{
    /** @var TokenServiceInterface */
    private $tokenService;

    public function __construct(TokenServiceInterface $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof TokenAuthenticatedController) {
            $tokenParameter = RequestBodyResolver::resolve($event->getRequest())->get('client_token');

            if (!$tokenParameter || !$this->tokenService->exists($tokenParameter)) {
                throw new AccessDeniedHttpException('Please give a valid token!');
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
