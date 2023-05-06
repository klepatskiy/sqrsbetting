<?php

declare(strict_types=1);

namespace App\UI\Console;

use App\Application\UseCase\AsyncCommand\TestAsyncMsg;
use App\Infrastructure\Service\Bus\AsyncCommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('test:command')]
class TestCommand extends Command
{
    public function __construct(private readonly AsyncCommandBus $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->bus->dispatch(new TestAsyncMsg());

        return Command::SUCCESS;
    }
}