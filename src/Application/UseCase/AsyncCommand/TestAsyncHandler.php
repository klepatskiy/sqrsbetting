<?php

declare(strict_types=1);

namespace App\Application\UseCase\AsyncCommand;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class TestAsyncHandler implements AsyncCommandHandlerInterface
{
    public const NAME = 'kekw';
    public function __construct(private readonly LoggerInterface  $logger)
    {
    }

    public function __invoke(TestAsyncMsg $msg)
    {
        dump($msg);
        $this->logger->alert('123');
    }
}