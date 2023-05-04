<?php

declare(strict_types=1);

namespace App\Application\DTO\Request;

use App\Application\DTO\BetPlaceDTO;

readonly class BetPlaceEntryDTO
{
    public function __construct(
        public BetPlaceDTO $bet,
    ) {
    }
}
