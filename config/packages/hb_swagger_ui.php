<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('hb_swagger_ui', [
        'directory' => '%kernel.project_dir%/public/swagger/',
        'files' => [
            'app-openapi.yaml',
        ],
    ]);
};
