<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class Healthcheck
{
    #[Route(path: '/healthcheck', methods: 'GET')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['result' => 'ok']);
    }
}
