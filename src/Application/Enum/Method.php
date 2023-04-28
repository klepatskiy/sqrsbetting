<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum Method: string
{
    case PUT = 'PUT';
    case POST = 'POST';
    case GET = 'GET';
}
