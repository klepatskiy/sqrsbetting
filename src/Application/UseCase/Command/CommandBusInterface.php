<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command;

use Throwable;

interface CommandBusInterface
{
    /**
     * @throws Throwable
     */
    public function handle(CommandInterface $command);
}
