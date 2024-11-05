<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command;

use Symfony\Component\Uid\Uuid;
use Throwable;

interface CommandBusInterface
{
    /**
     * @throws Throwable
     */
    public function handle(CommandInterface $command): Uuid;
}
