<?php

declare(strict_types=1);

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints as Assert;

readonly class BetPlaceMoneyDTO
{
    public function __construct(
        public string $currency,

        #[Assert\PositiveOrZero]
        public float $betAmount,

        #[Assert\PositiveOrZero]
        public float $liability,

        #[Assert\PositiveOrZero]
        public float $winAmount,

        #[Assert\PositiveOrZero]
        public float $payout,
    ) {
    }
}
