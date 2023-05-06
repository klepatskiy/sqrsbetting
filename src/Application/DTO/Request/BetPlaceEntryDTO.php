<?php

declare(strict_types=1);

namespace App\Application\DTO\Request;

use App\Application\DTO\BetPlaceDTO;
use Symfony\Component\Validator\Constraints as Assert;

readonly class BetPlaceEntryDTO
{
    public function __construct(
        #[Assert\Valid]
        public BetPlaceDTO $bet,
    ) {
    }
}
