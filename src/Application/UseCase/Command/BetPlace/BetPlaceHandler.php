<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\BetPlace;

use App\Application\UseCase\Command\CommandHandlerInterface;

readonly class BetPlaceHandler implements CommandHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(BetPlaceCommand $command): void
    {
        dump($command->betPlaceDTO);
    }
}
