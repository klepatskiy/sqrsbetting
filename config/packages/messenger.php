<?php

declare(strict_types=1);

use App\Application\UseCase\AsyncCommand\TestAsyncHandler;
use App\Application\UseCase\AsyncCommand\TestAsyncMsg;
use Symfony\Config\FrameworkConfig;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function (FrameworkConfig $cfg): void {

    $mesCfg = $cfg->messenger();
    $mesCfg->defaultBus('messenger.bus.command');

    $testTransport = $mesCfg->transport(TestAsyncHandler::NAME);
    $testTransport->dsn(env('MESSENGER_TRANSPORT_DSN'));
    $mesCfg->routing(TestAsyncMsg::class)->senders([TestAsyncHandler::NAME]);

    $mesCfg->bus('messenger.bus.command', [
        'default_middleware' => false,
        'middleware' => [
            'send_message',
            'handle_message',
            'failed_message_processing_middleware',
        ],
    ]);

    $mesCfg->bus('messenger.bus.query', [
        'default_middleware' => false,
        'middleware' => [
            'handle_message',
            'failed_message_processing_middleware',
        ],
    ]);
};
