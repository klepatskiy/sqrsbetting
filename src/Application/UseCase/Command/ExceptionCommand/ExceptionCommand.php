<?php

declare(strict_types=1);

namespace App\Application\UseCase\Command\ExceptionCommand;

use App\Application\DTO\Request\BetPlaceEntryDTO;
use App\Application\Enum\WlSlug;
use App\Application\UseCase\Command\CommandInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class ExceptionCommand implements CommandInterface
{
    public function __construct(
        public Uuid $uuid,
    ) {
    }
}
