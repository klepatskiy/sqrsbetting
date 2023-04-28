<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Bus;

use Symfony\Component\Messenger\Exception\HandlerFailedException;

trait BusExceptionTrait
{
    public function throwException(HandlerFailedException $exception): void
    {
        while ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        throw $exception;
    }
}
