<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    Symfony\Bundle\DebugBundle\DebugBundle::class => ['dev' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    HarmBandstra\SwaggerUiBundle\HBSwaggerUiBundle::class => ['all' => true],
    Fresh\CentrifugoBundle\FreshCentrifugoBundle::class => ['all' => true],
    Baldinof\RoadRunnerBundle\BaldinofRoadRunnerBundle::class => ['all' => true],
];
