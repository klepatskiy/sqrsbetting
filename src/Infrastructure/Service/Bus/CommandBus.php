<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Bus;

use App\Application\UseCase\Command\CommandBusInterface;
use App\Application\UseCase\Command\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public function handle(CommandInterface $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
