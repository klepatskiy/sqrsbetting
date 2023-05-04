<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\BetPlace;

use App\Application\DTO\Request\BetPlaceEntryDTO;
use App\Application\Enum\WlSlug;
use App\Application\UseCase\Command\CommandInterface;

readonly class BetPlaceCommand implements CommandInterface
{
    public function __construct(
        public WlSlug $wlSlug,
        public BetPlaceEntryDTO $betPlaceDTO,
    ) {
    }
}
