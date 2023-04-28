<?php

declare(strict_types=1);

namespace App\Application\Exception;

use Throwable;

class NotFoundException extends ApiException
{
    public function __construct(string $content, string $message, int $code, ?Throwable $previous)
    {
        parent::__construct(404, $content, $message, $code, $previous);
    }
}
