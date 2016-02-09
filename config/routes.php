<?php

return [
    // Dependencies invokables & factories
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            App\Controller\IndexController::class => App\Controller\Factory\ControllerFactory::class,
            App\Controller\PingController::class => App\Controller\Factory\ControllerFactory::class,
            App\Controller\UserController::class => App\Controller\Factory\ControllerFactory::class,
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
        [
            'name' => 'dump',
            'path' => '/dump',
            'middleware' => App\Controller\PingController::class,
            'allowed_methods' => ['GET']
        ],
        [
            'name' => 'user',
            'path' => '/user',
            'middleware' => App\Controller\UserController::class,
            'allowed_methods' => ['GET']
        ],
    ],
];