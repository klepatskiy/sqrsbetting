<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Bus;

use App\Application\UseCase\Command\CommandBusInterface;
use App\Application\UseCase\Command\CommandInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CommandBus implements CommandBusInterface
{
    use BusExceptionTrait;

    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly LoggerInterface $appLogger,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function handle(CommandInterface $command)
    {
        try {
            $envelope = $this->messageBus->dispatch($command);
            $stamp = $envelope->last(HandledStamp::class);

            if ($stamp) {
                return $stamp->getResult();
            }
        } catch (HandlerFailedException $e) {
            $this->throwException($e);
        }
    }
}
