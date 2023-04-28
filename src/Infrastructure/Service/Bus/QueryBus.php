<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Bus;

use App\Application\UseCase\Query\QueryBusInterface;
use App\Application\UseCase\Query\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class QueryBus implements QueryBusInterface
{
    use BusExceptionTrait;

    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {
    }

    /**
     * @throws Throwable
     */
    public function ask(QueryInterface $query): mixed
    {
        try {
            $envelope = $this->messageBus->dispatch($query);

            return $envelope->last(HandledStamp::class)?->getResult();
        } catch (HandlerFailedException $e) {
            $this->throwException($e);
        }
    }
}
