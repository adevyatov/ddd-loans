<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventSubscriber;

use DomainException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var class-string[]
     */
    private const array ALLOWED_EXCEPTIONS = [
        DomainException::class,
        HttpException::class,
    ];

    /**
     * @var array<class-string, int>
     */
    private const array EXCEPTION_STATUSES = [
        DomainException::class => Response::HTTP_BAD_REQUEST,
        HttpException::class => Response::HTTP_BAD_REQUEST,
    ];

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpException && $exception->getPrevious() instanceof ValidationFailedException) {
            $this->handleValidationException($event, $exception->getPrevious());

            return;
        }

        $this->handleBaseException($event, $exception);
    }

    private function handleValidationException(ExceptionEvent $event, ValidationFailedException $exception): void
    {
        $violations = $exception->getViolations();
        /** @var array{field: string, message: string}[] $errors */
        $errors = [];

        foreach ($violations as $violation) {
            $errors[] = [
                'message' => $violation->getMessage(),
                'field' => $violation->getPropertyPath(),
            ];
        }

        $event->setResponse(new JsonResponse(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    private function handleBaseException(ExceptionEvent $event, Throwable $exception): void
    {
        $message = $this->getExceptionMessage($exception);
        $statusCode = $this->getExceptionStatusCode($exception);

        $event->setResponse(new JsonResponse(['error' => $message], $statusCode));
    }

    private function getExceptionMessage(Throwable $exception): string
    {
        foreach (self::ALLOWED_EXCEPTIONS as $allowedException) {
            if ($exception instanceof $allowedException) {
                return $exception->getMessage();
            }
        }

        return 'Internal Server Error';
    }

    private function getExceptionStatusCode(Throwable $exception): int
    {
        foreach (self::EXCEPTION_STATUSES as $exceptionClass => $statusCode) {
            if ($exception instanceof $exceptionClass) {
                return $statusCode;
            }
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
