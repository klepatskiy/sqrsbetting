<?php

declare(strict_types=1);

namespace App\Application\Exception;

use Exception;
use Throwable;

class NotUniqException extends Exception
{
    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}
