<?php

declare(strict_types=1);

use Symfony\Config\Framework\Cache\PoolConfig;
use Symfony\Config\FrameworkConfig;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

return static function (FrameworkConfig $frameworkConfig) {
    $cacheConfig = $frameworkConfig->cache();
    $project = env('PROJECT');
    $cacheConfig->defaultRedisProvider(param('redis_url'))
        ->prefixSeed($project)
        ->app('cache.adapter.redis')
        ->pool(
            $project . '_pool',
            (new PoolConfig())
                ->adapters('cache.adapter.redis')
                ->provider($project . '_pool.redis_provider')
        )
    ;
};