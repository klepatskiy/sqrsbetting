<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command;

use App\Application\Enum\WlSlug;
use Throwable;

interface CommandBusInterface
{
    /**
     * @throws Throwable
     */
    public function handle(CommandInterface $command): void;
}
