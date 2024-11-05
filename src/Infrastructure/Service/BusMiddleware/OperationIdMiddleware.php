<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\BusMiddleware;

use App\Infrastructure\Service\Stamp\OperationStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

final readonly class OperationIdMiddleware implements MiddlewareInterface
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        /** @var OperationStamp|null $operation */
        $operation = $envelope->last(OperationStamp::class);
        $operationId = $operation?->operationUuid;

        try {
            $envelope = $stack->next()->handle($envelope, $stack);

            return $envelope;
        } catch (Throwable $e) {
            if ($operationId !== null) {
                $this->logger->error('Произошла ошибка в процессе выполнения команды', [
                    'operation_id' => $operationId->toRfc4122(),
                    'exception' => $e,
                ]);


                // todo dispatch error message
                throw new HttpException(500, 'Произошла ошибка. Идентификатор операции: ' . $operationId, $e);
            }

            throw $e;
        }
    }
}
