<?php

declare(strict_types=1);

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/vendor/autoload.php';

function reloadDatabase(string $env, bool $debug): void
{
    $kernel = new Kernel($env, $debug);
    $application = new Application($kernel);
    $application->setAutoExit(false);

    try {
        $output = new BufferedOutput();

        $application->run(
            new ArrayInput([
                'command' => 'doctrine:database:drop',
                '--if-exists' => '1',
                '--force' => '1',
            ]),
            $output
        );

        $application->run(
            new ArrayInput([
                'command' => 'doctrine:database:create',
            ]),
            $output
        );

        $application->run(
            new ArrayInput([
                'command' => 'doctrine:migrations:migrate',
                '--no-interaction' => '1',
                '--quiet' => '1',
            ]),
            $output
        );
    } catch (Exception $exception) {
        $message = sprintf('Error init test environment: %s', $exception);

        throw new RuntimeException($message, $exception->getCode());
    } finally {
        $kernel->shutdown();
    }
}

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}

$env = $_ENV['APP_ENV'];
$debug = (bool) $_ENV['APP_DEBUG'];

if ($env !== 'test') {
    throw new RuntimeException("env must be test, passed: {$env}");
}

// ensure a fresh cache when debug mode is disabled
(new Filesystem())->remove(__DIR__ . '/../var/cache/test');

reloadDatabase($env, $debug);
