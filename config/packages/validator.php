<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'validation' => [
            'email_validation_mode' => 'html5',
            'enable_annotations' => true,
            'cache' => 'sqrsbetting.redis_provider',
        ],
    ]);

    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('framework', [
            'validation' => [
                'not_compromised_password' => false,
            ],
        ]);
    }
};
