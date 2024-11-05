<?php

declare(strict_types=1);

namespace App\Application\DTO\Request;

use Symfony\Component\Uid\Uuid;

readonly class ExceptionCommandEntryDTO
{
    public function __construct(
        public Uuid $uuid,
    ) {
    }
}
