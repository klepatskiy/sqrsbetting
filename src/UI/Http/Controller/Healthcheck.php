<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Healthcheck
{
    #[Route(path: '/healthcheck', methods: 'GET')]
    public function __invoke(): Response
    {
        return new Response('dsadasdsa');
    }
}
