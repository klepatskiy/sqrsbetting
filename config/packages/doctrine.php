<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'url' => '%env(resolve:DATABASE_URL)%',
        ],
        'orm' => [
            'auto_generate_proxy_classes' => true,
            'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
            'auto_mapping' => true,
        ],
    ]);
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('doctrine', [
            'dbal' => [
                'dbname_suffix' => '_test%env(default::TEST_TOKEN)%',
            ],
        ]);
    }
    if ($containerConfigurator->env() === 'dev') {
        $containerConfigurator->extension('doctrine', [
            'orm' => [
                'query_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'cache.app',
                ],
                'metadata_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'cache.app',
                ],
                'result_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'cache.system',
                ],
            ],
        ]);
    }
    if ($containerConfigurator->env() === 'prod') {
        $containerConfigurator->extension('doctrine', [
            'orm' => [
                'auto_generate_proxy_classes' => false,
                'query_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'sqrsbetting.doctrine_pool',
                ],
                'metadata_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'sqrsbetting.doctrine_pool',
                ],
                'result_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'sqrsbetting.doctrine_pool',
                ],
            ],
        ]);
    }
};
