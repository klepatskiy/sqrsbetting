<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\BetPlace;

use App\Application\DTO\BetPlaceDTO;
use App\Application\Enum\WlSlug;
use App\Application\UseCase\Command\CommandInterface;

readonly class BetPlaceCommand implements CommandInterface
{
    public function __construct(
        public WlSlug $wlSlug,
        public BetPlaceDTO $betPlaceDTO,
    ) {
    }
}
