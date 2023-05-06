<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\BetPlace;

use App\Application\DTO\Request\BetPlaceEntryDTO;
use App\Application\Enum\WlSlug;
use App\Application\UseCase\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class BetPlaceCommand implements CommandInterface
{
    public function __construct(
        public WlSlug $wlSlug,
        #[Assert\Valid]
        public BetPlaceEntryDTO $betPlaceDTO,
    ) {
        dump($betPlaceDTO);
    }
}
