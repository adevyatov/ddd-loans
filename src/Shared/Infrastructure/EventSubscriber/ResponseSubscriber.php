<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }

    public function onKernelView(ViewEvent $event): void
    {
        /** @psalm-var mixed $result */
        $result = $event->getControllerResult();

        if ($result instanceof JsonResponse) {
            return;
        }

        $response = new JsonResponse([
            'result' => $result,
        ]);

        $event->setResponse($response);
    }
}
