<?php

return [
    // Dependencies invokables & factories
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Controller\PingController::class => App\Controller\PingController::class,
        ],
        'factories' => [
            App\Controller\IndexController::class => App\Controller\IndexFactory::class,
        ],
    ],
    // Routes settings
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Controller\IndexController::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'ping',
            'path' => '/ping',
            'middleware' => App\Controller\PingController::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
