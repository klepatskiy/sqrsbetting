<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Bet;

use App\Application\UseCase\Command\BetPlace\BetPlaceCommand;
use App\Application\UseCase\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

readonly class BetPlaceController
{
    public function __construct(
        private CommandBusInterface $bus
    ) {
    }

    #[Route(path: '/{wlSlug}/billing/bet:place', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] BetPlaceCommand $command): JsonResponse
    {
        $this->bus->handle($command);

        return new JsonResponse();
    }
}
