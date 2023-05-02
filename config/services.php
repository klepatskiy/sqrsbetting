<?php

declare(strict_types=1);

use App\Application\UseCase\Command\CommandHandlerInterface;
use App\Application\UseCase\Query\QueryHandlerInterface;
use App\Infrastructure\Service\Bus\CommandBus;
use App\Infrastructure\Service\Bus\QueryBus;
use App\UI\Console\LinkCommand;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('redis_url', 'redis://%env(REDIS_PASSWORD)%@%env(REDIS_HOST)%:%env(REDIS_PORT)%');

    $parameters->set('redis_doctrine_url', '%redis_url%/1');

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(CommandHandlerInterface::class)
        ->public()
        ->tag('messenger.message_handler', [
        'bus' => 'messenger.bus.command',
    ]);

    $services->instanceof(QueryHandlerInterface::class)
        ->public()
        ->tag('messenger.message_handler', [
        'bus' => 'messenger.bus.query',
    ]);

    $services->load('App\\', __DIR__ . '/../src/')
        ->exclude([
        __DIR__ . '/../src/DependencyInjection/',
        __DIR__ . '/../src/Domain/Project/Entity',
        __DIR__ . '/../src/Domain/Branch/DTO',
        __DIR__ . '/../src/Infrastructure/Persistence/Http/Gitlab/ActionsV4',
        __DIR__ . '/../src/Infrastructure/Persistence/Action.php',
        __DIR__ . '/../src/Kernel.php',
    ]);

    $services->load('App\UI\Http\Controller\\', __DIR__ . '/../src/UI/Http/Controller')
        ->tag('controller.service_arguments');

    $services->set('sqrsbetting.redis_provider', Redis::class)
        ->factory([
        RedisAdapter::class,
        'createConnection',
    ])
        ->args([
        '%redis_url%',
    ]);

    $services->set('sqrsbetting.doctrine.redis_provider', Redis::class)
        ->factory([
        RedisAdapter::class,
        'createConnection',
    ])
        ->args([
        '%redis_doctrine_url%',
    ]);

    $services->set(CommandBus::class)
        ->public()
        ->args([
        service('messenger.bus.command'),
    ])
        ->tag('sqrsbetting.messenger.query_bus');

    $services->set(QueryBus::class)
        ->args([
        service('messenger.bus.query'),
    ])
        ->tag('sqrsbetting.messenger.query_bus');

    $services->set(LinkCommand::class)
        ->args([param('kernel.project_dir')])
    ;
};
