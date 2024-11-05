<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Application\DTO\Request\ExceptionCommandEntryDTO;
use App\Application\UseCase\Command\CommandBusInterface;
use App\Application\UseCase\Command\ExceptionCommand\ExceptionCommand as ExCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionCommand
{
    #[Route(path: '/exception', methods: 'POST')]
    public function __invoke(
        #[MapRequestPayload]
        ExceptionCommandEntryDTO $entryDTO,
        CommandBusInterface $bus,
    ): JsonResponse {
        $operation = $bus->handle(new ExCommand($entryDTO->uuid));

        return new JsonResponse($operation->toRfc4122());
    }
}
