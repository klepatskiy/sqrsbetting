<?php

declare(strict_types=1);

namespace App\Application\UseCase\AsyncCommand;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

#[AsMessageHandler]
interface AsyncCommandHandlerInterface
{

}