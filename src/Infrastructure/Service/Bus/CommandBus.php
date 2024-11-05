<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Bus;

use App\Application\UseCase\Command\CommandBusInterface;
use App\Application\UseCase\Command\CommandInterface;
use App\Infrastructure\Service\Stamp\OperationStamp;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;
use Throwable;

readonly class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private LoggerInterface $logger,
    ) {
    }

    public function handle(CommandInterface $command): Uuid
    {
        $operation = new OperationStamp(Uuid::v7());

        try {
            $this->messageBus->dispatch($command, [$operation]);
        } catch (Throwable $e) {
            $this->logger->error('Ошибка при обработке команды', [
                'operation_id' => $operation->operationUuid,
                'error' => $e->getMessage(),
            ]);
        }

        return $operation->operationUuid;
    }
}
