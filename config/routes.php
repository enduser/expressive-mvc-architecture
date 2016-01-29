<?php

return [
    // Dependencies invokables & factories
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Controller\PingController::class => App\Controller\PingController::class,
        ],
        'factories' => [
            App\Controller\IndexController::class => App\Controller\IndexController::class,
        ],
    ],
    // Routes settings
    'routes' => [
        [
            'name' => 'home',
            'path' => '/home',
            'middleware' => App\Controller\IndexController::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'ping',
            'path' => '/',
            'middleware' => App\Controller\PingController::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
