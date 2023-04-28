<?php

declare(strict_types=1);

namespace App\Infrastructure\Event;

use App\Infrastructure\Service\ExceptionFormatter;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Throwable;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $errorLogger,
        private readonly ExceptionFormatter $exceptionFormatter,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException'],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = $this->exceptionFormatter->format($event);
        $this->log($exception);
        $event->setResponse($response);
    }

    private function log(Throwable $e): void
    {
        $this->errorLogger->error(
            'error',
            [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]
        );
    }
}
