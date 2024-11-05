<?php

declare(strict_types=1);

namespace App\Application\Exception;

class NotFoundAppException extends AppException
{
    public function __construct(string $message)
    {
        $message = "Not found " . $message;

        parent::__construct(
            $message,
            404,
        );
    }
}
