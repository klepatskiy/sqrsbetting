<?php

declare(strict_types=1);

namespace App\Application\Exception;

use Exception;
use Throwable;

class ApiException extends Exception
{
    public function __construct(
        private readonly int $statusCode,
        private readonly string $content,
        string $message,
        int $code,
        ?Throwable $previous
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
