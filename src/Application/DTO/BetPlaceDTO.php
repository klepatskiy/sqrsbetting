<?php

declare(strict_types=1);

namespace App\Application\DTO;
use Symfony\Component\Validator\Constraints as Assert;

readonly class BetPlaceDTO
{
    public function __construct(
        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Regex(pattern: '/^[0-9]+$/', message: 'BetId should contain only digits')]
        public string $betId,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        public string $clientId,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        public ?string $transactionId,

        #[Assert\Type(type: 'integer')]
        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?int $transactionAmount,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Choice(choices: ['SINGLE', 'MULTIPLE', 'SYSTEM'], message: 'Invalid betType value')]
        public string $betType,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Choice(choices: ['INSTANT', 'ORDER'], message: 'Invalid betTransactionType value')]
        public string $betTransactionType,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Choice(choices: ['YES', 'UP', 'NO', 'DOWN'], message: 'Invalid acceptOddsChanges value')]
        public string $acceptOddsChanges,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Choice(choices: ['YES', 'UP', 'NO'], message: 'Invalid acceptParameterChanges value')]
        public ?string $acceptParameterChanges,

        #[Assert\Type(type: 'float')]
        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?float $odds,

        #[Assert\Type(type: 'float')]
        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?float $betOdds,

        #[Assert\Type(type: 'string')]
        #[Assert\NotNull]
        #[Assert\Choice(choices: [
            'UNSETTLED',
            'WIN',
            'LOSE',
            'CANCELLED',
            'VOID',
            'CASH_OUT'
        ], message: 'Invalid betStatus value')]
        public string $betStatus,

        #[Assert\Type(type: 'string')]
        public ?string $prematchFinCategoryName,

        #[Assert\Type(type: 'string')]
        public ?string $prematchGameStyleCategoryName,

        #[Assert\Type(type: 'string')]
        public ?string $liveFinCategoryName,

        #[Assert\Type(type: 'string')]
        public ?string $liveGameStyleCategoryName,

        #[Assert\Type(type: 'integer')]
        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?int $settleTime,

        #[Assert\Type(type: 'integer')]
        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?int $createTime,
    ) {
    }
}