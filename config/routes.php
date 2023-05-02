<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes) {
    $apiVersionPrefix = '/api/v1';

    $routes->import(__DIR__ . '/../src/UI/Http/Controller/', 'annotation')
        ->prefix("$apiVersionPrefix/")
    ;

    $routes->import('@HBSwaggerUiBundle/Resources/config/routing.yml')->prefix('/api/docs/');
};
