<?php

declare(strict_types=1);

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints as Assert;

readonly class BetPlaceDTO
{
    /**
     * @param string[]|null $outcomes
     * @param string[]|null $bonuses
     */
    public function __construct(
        #[Assert\Regex(pattern: '/^[0-9]+$/', message: 'BetId should contain only digits')]
        public string $betId,

        #[Assert\Regex(pattern: '/^[0-9]+$/', message: 'ClientId should contain only digits')]
        public string $clientId,

        #[Assert\Regex(pattern: '/^[0-9]+$/', message: 'TransactionId should contain only digits')]
        public string $transactionId,

        #[Assert\PositiveOrZero]
        public float $transactionAmount,

        #[Assert\Choice(choices: ['SINGLE'], message: 'Invalid bet type')]
        public string $betType,

        #[Assert\Choice(choices: ['INSTANT'], message: 'Invalid bet transaction type')]
        public string $betTransactionType,

        #[Assert\Choice(choices: ['UP', 'DOWN', 'NONE'], message: 'Invalid odds change type')]
        public string $acceptOddsChanges,

        #[Assert\Choice(choices: ['YES', 'NO'], message: 'Invalid parameter change type')]
        public string $acceptParameterChanges,

        #[Assert\PositiveOrZero]
        public float $odds,

        #[Assert\PositiveOrZero]
        public float $betOdds,

        #[Assert\Choice(choices: ['WIN', 'LOSE', 'VOID'], message: 'Invalid bet status')]
        public string $betStatus,

        public ?string $prematchFinCategoryName,

        public ?string $prematchGameStyleCategoryName,

        public ?string $liveFinCategoryName,

        public ?string $liveGameStyleCategoryName,

        public int $settleTime,

        public int $createTime,

        public int $updateTime,

        #[Assert\Valid]
        public BetPlaceMoneyDTO $betMoney,

        public string $cashOutReason,

        public string $locale,

        public string $betSportService,

        public int $winCombinationSize,

        public ?array $outcomes,

        public ?array $bonuses,
    ) {
    }
}