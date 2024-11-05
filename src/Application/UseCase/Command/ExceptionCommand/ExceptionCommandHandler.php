<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\ExceptionCommand;

use App\Application\Exception\NotFoundAppException;
use App\Application\UseCase\Command\CommandHandlerInterface;

final readonly class ExceptionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
    ) {
    }

    public function __invoke(ExceptionCommand $command): void
    {
        throw new NotFoundAppException("exception id " . $command->uuid);
    }
}
