<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Uid\Uuid;

final readonly class OperationStamp implements StampInterface
{
    public Uuid $operationUuid;

    public function __construct(
        ?Uuid $operationUuid = null,
    ) {
        $this->operationUuid = $operationUuid ?? Uuid::v7();
    }
}
