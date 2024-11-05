<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Uid\Uuid;

final readonly class OperationStamp implements StampInterface
{
    public function __construct(
        public Uuid $operationUuid,
    ) {
    }
}
