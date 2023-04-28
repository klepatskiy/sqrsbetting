<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $confDir = $this->getProjectDir() . '/config';

        $container->parameters()->set('container.dumper.inline_class_loader', true);
        $container->parameters()->set('container.dumper.inline_factories', true);

        $container->import($confDir . '/{packages}/*' . self::CONFIG_EXTS);
        $container->import($confDir . '/{packages}/' . $this->environment . '/*' . self::CONFIG_EXTS);
        $container->import($confDir . '/{services}' . self::CONFIG_EXTS);
        $container->import($confDir . '/{services}_' . $this->environment . self::CONFIG_EXTS);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $confDir = $this->getProjectDir() . '/config';

        $routes->import($confDir . '/{routes}/' . $this->environment . '/*' . self::CONFIG_EXTS);
        $routes->import($confDir . '/{routes}/*' . self::CONFIG_EXTS);
        $routes->import($confDir . '/{routes}' . self::CONFIG_EXTS);
    }
}
