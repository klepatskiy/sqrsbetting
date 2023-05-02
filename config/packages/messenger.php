<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'messenger' => [
            'default_bus' => 'messenger.bus.command',
            'transports' => null,
            'buses' => [
                'messenger.bus.command' => [
                    'default_middleware' => false,
                    'middleware' => [
                        'send_message',
                        'handle_message',
                        'failed_message_processing_middleware',
                    ],
                ],
                'messenger.bus.query' => [
                    'default_middleware' => false,
                    'middleware' => [
                        'handle_message',
                        'failed_message_processing_middleware',
                    ],
                ],
            ],
            'routing' => null,
        ],
    ]);
};
